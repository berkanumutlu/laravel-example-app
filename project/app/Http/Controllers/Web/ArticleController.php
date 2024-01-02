<?php

namespace App\Http\Controllers\Web;

use App\Models\Article;
use App\Models\ArticleComments;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ArticleController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->data['categories'] = Category::query()->where('status', 1)
            ->orderBy('order', 'asc')->orderBy('created_at', 'desc')->get();
    }

    public function index()
    {
        $this->data['records'] = Article::query()->status(1)
            ->with(['category:id,name,slug', 'user:id,name,username'])
            ->select(['id', 'title', 'slug', 'image', 'publish_date', 'read_time', 'category_id', 'user_id'])
            ->orderBy('publish_date', 'desc')
            ->paginate(15);
        $this->data['title'] = 'Article List';
        return view('web.article.index', $this->data);
    }

    public function show(string $slug)
    {
        $record = Article::query()->where('slug', $slug)->status(1)
            ->with([
                'category:id,name,slug', 'user:id,name,username,title,description,image',
                'comments', 'comments.user:id,name,image', 'comments.children', 'comments.children.user:id,name,image'
            ])
            ->select([
                'id', 'title', 'slug', 'body', 'image', 'tags', 'read_time', 'view_count', 'like_count', 'publish_date',
                'category_id', 'user_id'
            ])
            ->first();
        if (empty($record)) {
            abort(404);
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
        $this->data['record'] = $record;
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
        $this->data['title'] = $category->name.'  Article List';
        return view('web.article.index', $this->data);
    }

    public function post_comment(Request $request, Article $article)
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
                $data['user_id'] = auth()->id();
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
        } catch (\Exception $e) {
            $response['message'] = 'An error occurred while submitting your comment.';
        }
        return response()->json($response);
    }
}
