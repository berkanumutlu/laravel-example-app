<?php

namespace App\Http\Controllers\Admin;

use App\Models\ArticleComments;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ArticleCommentController extends BaseController
{
    public function index(Request $request)
    {
        $this->data['users'] = User::query()->select(['id', 'name'])->orderBy('name', 'asc')->get();
        $this->data['records'] = ArticleComments::query()
            ->with(['article:id,title,slug', 'user:id,name', 'parent:id,comment'])
            ->select([
                'id', 'article_id', 'user_id', 'parent_id', 'comment', 'like_count', 'dislike_count', 'ip_address',
                'user_agent', 'status', 'created_at'
            ])
            ->user($request->user_id)
            ->createdAt($request->created_at)
            ->comment($request->comment)
            ->ipAddress($request->ip_address)
            ->orderBy('created_at', 'desc')
            ->paginate(20);
        $this->data['columns'] = [
            'Id', 'Article', 'User', 'Parent Comment', 'Comment', 'Likes', 'Dislikes', 'IP Address',
            'User Agent', 'Status', 'Creation Time',
            'Actions'
        ];
        $this->data['page'] = 'list';
        $this->data['title'] = 'Article Comment List';
        return view('admin.article.comments.index', $this->data);
    }

    public function pending(Request $request)
    {
        $this->data['users'] = User::query()->select(['id', 'name'])->orderBy('name', 'asc')->get();
        $this->data['records'] = ArticleComments::query()
            ->with(['article:id,title,slug', 'user:id,name', 'parent:id,comment'])
            ->select(['id', 'article_id', 'user_id', 'parent_id', 'comment', 'ip_address', 'user_agent', 'created_at'])
            ->Pending()
            ->user($request->user_id)
            ->createdAt($request->created_at)
            ->comment($request->comment)
            ->ipAddress($request->ip_address)
            ->orderBy('created_at', 'desc')
            ->paginate(20);
        $this->data['columns'] = [
            'Id', 'Article', 'User', 'Parent Comment', 'Comment', 'IP Address', 'User Agent', 'Creation Time', 'Actions'
        ];
        $this->data['page'] = 'pending';
        $this->data['title'] = 'Pending Article Comment List';
        return view('admin.article.comments.index', $this->data);
    }

    public function approve(Request $request)
    {
        $response = ['status' => false, 'message' => null];
        $validator = Validator::make($request->all(), [
            'id' => ['required', 'integer', 'exists:article_comments']
        ]);
        if ($validator->fails()) {
            $response['message'] = collect($validator->errors()->all())->implode('<br>');
            $response['notify'] = [
                'message' => $response['message'],
                'icon'    => 'info'
            ];
            return response()->json($response);
        }
        $record_id = $request->id;
        $article_comment = ArticleComments::query()->where("id", $record_id)->first();
        if (!empty($article_comment)) {
            try {
                $article_comment->status = 1;
                $article_comment->save();
                $response['status'] = true;
                $response['message'] = "Article Comment(<strong>#".$record_id."</strong>) approved.";
                $response['notify'] = [
                    'message' => $response['message'],
                    'icon'    => 'success',
                    'timer'   => 4000
                ];
            } catch (\Exception $e) {
                $response['message'] = $e->getMessage();
                $response['notify'] = [
                    'message' => "Could not approved.",
                    'icon'    => 'error'
                ];
            }
        } else {
            $response['message'] = "Comment not found.";
            $response['notify'] = [
                'message' => $response['message'],
                'icon'    => 'error'
            ];
        }
        return response()->json($response);
    }
}
