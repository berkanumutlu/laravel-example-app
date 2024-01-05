<?php

namespace App\Http\Controllers\Web;

use App\Models\Article;
use App\Models\ArticleComments;
use App\Models\ArticleCommentsUserLikes;
use App\Models\ArticleUserLikes;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ArticleController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->data['records'] = Article::query()->status(1)
            ->with(['category:id,name,slug', 'user:id,name,username'])
            ->select(['id', 'title', 'slug', 'image', 'publish_date', 'read_time', 'category_id', 'user_id'])
            ->orderBy('publish_date', 'desc')
            ->paginate(15);
        $this->data['categories'] = Category::query()->where('status', 1)
            ->orderBy('order', 'asc')->orderBy('created_at', 'desc')->get();
        $this->data['title'] = 'Article List';
        return view('web.article.index', $this->data);
    }

    public function show(string $slug)
    {
        $record = Article::query()->where('slug', $slug)->status(1)
            ->with([
                'category:id,name,slug', 'user:id,name,username,title,description,image', 'likes:id,user_id',
                'comments', 'comments.user:id,name,image', 'comments.children', 'comments.children.user:id,name,image',
                'comments.currentUserLiked', 'comments.currentUserDisliked'
            ])
            ->select([
                'id', 'title', 'slug', 'body', 'image', 'tags', 'read_time', 'view_count', 'like_count', 'publish_date',
                'category_id', 'user_id'
            ])
            ->first();
        if (empty($record)) {
            abort(404);
        }
        if (auth()->guard('web')->check()) {
            $this->data['userLike'] = $record->likes()->where('user_id', auth()->guard('web')->id())->exists();
        } else {
            $this->data['userLike'] = false;
        }
        $record->commentsCount = $record->comments?->count();
        $record->comments?->map(function ($item) use ($record) {
            if (!is_null($item->deleted_at)) {
                $item->comment = '(This message has been deleted.)';
                $item->is_deleted = true;
            } else {
                $item->is_deleted = false;
            }
            if (is_null($item->user?->name)) {
                $item->user = new User();
                $item->user->name = 'Guest';
            }
            if (!is_null($item->user?->image)) {
                $item->user->image = asset($item->user?->image);
            } else {
                $item->user->image = asset($this->data['settings']->image_default_author);
            }
            $record->commentsCount += $item->children?->count();
            if ($item->children?->count() > 0) {
                $item->children->map(function ($child) {
                    if (!is_null($child->deleted_at)) {
                        $child->comment = '(This message has been deleted.)';
                        $child->is_deleted = true;
                    } else {
                        $child->is_deleted = false;
                    }
                    if (is_null($child->user?->name)) {
                        $child->user = new User();
                        $child->user->name = 'Guest';
                    }
                    if (!is_null($child->user?->image)) {
                        $child->user->image = asset($child->user?->image);
                    } else {
                        $child->user->image = asset($this->data['settings']->image_default_author);
                    }
                });
            }
        });
        try {
            $record->increment('view_count');
            $record->save();
        } catch (\Exception $e) {

        }
        $this->data['record'] = $record;
        $this->data['categories'] = Category::query()->where('status', 1)
            ->orderBy('order', 'asc')->orderBy('created_at', 'desc')->get();
        $this->data['title'] = $record->title;
        return view('web.article.detail', $this->data);
    }

    //public function category(string $slug)
    /*public function category(Request $request, string $slug) {
        dd($request->slug);
    }*/
    public function category(Request $request, string $slug)
    {
        $category = Category::query()->with('articlesActive')
            ->select(['id', 'name'])
            ->where('slug', $slug)->first();
        $records = $category->articlesActive()
            ->select(['id', 'title', 'slug', 'image', 'publish_date', 'read_time', 'category_id', 'user_id'])
            ->orderBy('publish_date', 'desc')
            ->paginate(15);
        $records->load(['category:id,name,slug', 'user:id,name,username']);
        /*$records = $category->articlesActive()->with(['category:id,name,slug', 'user:id,name,username'])
            ->select(['id', 'title', 'image', 'publish_date', 'read_time', 'category_id', 'user_id'])
            ->paginate(15);*/
        /*$records = Article::query()->with(['category:id,name,slug', 'user:id,name,username'])
            ->select(['id', 'title', 'image', 'publish_date', 'read_time', 'category_id', 'user_id'])
            ->whereHas('category', function ($query) use ($slug) {
                $query->where('slug', $slug);
            })->paginate(15);*/
        $this->data['records'] = $records;
        $this->data['categories'] = Category::query()->where('status', 1)
            ->orderBy('order', 'asc')->orderBy('created_at', 'desc')->get();
        $this->data['title'] = $category->name.'  Article List';
        return view('web.article.index', $this->data);
    }

    /**
     * @param  Request  $request
     * @param  Article  $article
     * @return \Illuminate\Http\JsonResponse
     */
    public function post_comment(Request $request, Article $article): \Illuminate\Http\JsonResponse
    {
        $response = ['status' => false, 'message' => null];
        $response['token'] = csrf_token();
        $validator = Validator::make($request->all(), [
            'email'      => ['required', 'email'],
            'fullname'   => ['required', 'string'],
            'comment_id' => ['nullable', 'integer'],
            'comment'    => ['required', 'string'],
        ]);
        if ($validator->fails()) {
            $response['message'] = collect($validator->errors()->all())->implode('<br>');
            $response['notify'] = [
                'message' => $response['message'],
                'icon'    => 'info'
            ];
            return response()->json($response);
        }
        try {
            $data = $request->except('_token');
            if (auth()->guard('web')->check()) {
                $data['user_id'] = auth()->guard('web')->id();
            }
            if (isset($request->comment_id)) {
                $data['parent_id'] = $request->comment_id;
            }
            $data['article_id'] = $article->id;
            $data['ip_address'] = $request->ip();
            $data['user_agent'] = $request->userAgent();
            ArticleComments::create($data);
            $response['status'] = true;
            $response['message'] = 'Your comment has been sent successfully. Your comment will be published after the checks.';
            $response['notify'] = [
                'message' => $response['message'],
                'icon'    => 'success',
                'timer'   => 4000
            ];
        } catch (\Exception $e) {
            $response['message'] = 'An error occurred while submitting your comment.';
        }
        return response()->json($response);
    }

    /**
     * @param  Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function like(Request $request): \Illuminate\Http\JsonResponse
    {
        $response = ['status' => false, 'message' => null];
        if (!auth()->guard('web')->check()) {
            $response['notify'] = [
                'message' => 'You need to log in to like the article.',
                'icon'    => 'warning'
            ];
            return response()->json($response);
        }
        $validator = Validator::make($request->all(), [
            'recordId' => ['required', 'integer']
        ]);
        if ($validator->fails()) {
            $response['message'] = collect($validator->errors()->all())->implode('<br>');
            $response['notify'] = [
                'message' => $response['message'],
                'icon'    => 'info'
            ];
            return response()->json($response);
        }
        $article_id = $request->recordId;
        $user_id = auth()->guard('web')->id();
        $article = Article::query()->with([
            'likes' => function ($query) use ($user_id) {
                $query->where('user_id', $user_id);
            }
        ])->where('id', $article_id)->where('status', 1)->select(['id', 'like_count'])->first();
        try {
            if ($article->likes->count() > 0) {
                //$article->likes()->delete();
                ArticleUserLikes::query()->where([['article_id', $article_id], ['user_id', $user_id]])->delete();
                $article->like_count--;
                $response['data']['icon'] = 'favorite_border';
            } else {
                $article->like_count++;
                $data = [
                    'article_id' => $article_id,
                    'user_id'    => $user_id
                ];
                ArticleUserLikes::create($data);
                $response['data']['icon'] = 'favorite';
            }
            $article->save();
            $response['status'] = true;
            $response['data']['like_count'] = $article->like_count;
        } catch (\Exception $e) {
            $response['message'] = $e->getMessage();
            $response['notify'] = [
                'message' => 'An error occurred while liking the article.',
                'icon'    => 'error'
            ];
        }
        return response()->json($response);
    }

    /**
     * @param  Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function comment_like(Request $request): \Illuminate\Http\JsonResponse
    {
        $response = ['status' => false, 'message' => null];
        if (!auth()->guard('web')->check()) {
            $response['notify'] = [
                'message' => 'You need to logged in to take any action on the comment.',
                'icon'    => 'warning'
            ];
            return response()->json($response);
        }
        $validator = Validator::make($request->all(), [
            'recordId' => ['required', 'integer'],
            'type'     => ['required', 'string', Rule::in(['like', 'dislike'])]
        ]);
        if ($validator->fails()) {
            $response['message'] = collect($validator->errors()->all())->implode('<br>');
            $response['notify'] = [
                'message' => $response['message'],
                'icon'    => 'info'
            ];
            return response()->json($response);
        }
        $comment_id = $request->recordId;
        $type = $request->type;
        try {
            $comment_actions = ArticleCommentsUserLikes::query()->where('comment_id', $comment_id)
                ->select(['id', 'user_id', 'type'])->get();
            $user_id = auth()->guard('web')->id();
            $type_id = $type == 'like' ? 1 : 0;
            $user_like = $comment_actions->where('user_id', $user_id)->first();
            if (!empty($user_like)) {
                if ($user_like->type == $type_id) {
                    $user_like->delete();
                    $response['data']['iconClass'] = 'material-icons-outlined';
                    $response['data']['active'] = false;
                } else {
                    $user_like->type = $type_id;
                    $user_like->save();
                    $response['data']['iconClass'] = 'material-icons';
                    $response['data']['active'] = true;
                }
            } else {
                $data = [
                    'comment_id' => $comment_id,
                    'user_id'    => $user_id,
                    'type'       => $type_id
                ];
                ArticleCommentsUserLikes::create($data);
                $response['data']['iconClass'] = 'material-icons';
                $response['data']['active'] = true;
            }
            $response['status'] = true;
            $comment_actions = ArticleCommentsUserLikes::query()->where('comment_id', $comment_id)
                ->select(['id', 'user_id', 'type'])->get();
            $response['data']['dislike_count'] = $comment_actions->where('type', 0)->count();
            $response['data']['like_count'] = $comment_actions->where('type', 1)->count();
            $data = [
                'like_count'    => $response['data']['like_count'],
                'dislike_count' => $response['data']['dislike_count']
            ];
            ArticleComments::query()->where('id', $comment_id)->update($data);
        } catch (\Exception $e) {
            $response['message'] = $e->getMessage();
            $response['notify'] = [
                'message' => 'An error occurred while '.$type.' the comment.',
                'icon'    => 'error'
            ];
        }
        return response()->json($response);
    }
}
