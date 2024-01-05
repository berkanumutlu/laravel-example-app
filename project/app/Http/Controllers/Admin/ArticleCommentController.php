<?php

namespace App\Http\Controllers\Admin;

use App\Models\ArticleComments;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ArticleCommentController extends BaseController
{
    public function index(Request $request)
    {
        $this->data['users'] = User::query()->select(['id', 'name'])->orderBy('name', 'asc')->get();
        $this->data['records'] = ArticleComments::query()
            ->withTrashed()
            ->with(['article:id,title,slug', 'user:id,name', 'parent:id,comment'])
            ->select([
                'id', 'article_id', 'user_id', 'parent_id', 'comment', 'like_count', 'dislike_count', 'user_full_name',
                'user_email', 'ip_address', 'user_agent', 'status', 'created_at', 'deleted_at'
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
        $this->data['records'] = ArticleComments::query()->status(0)
            ->with(['article:id,title,slug', 'user:id,name', 'parent:id,comment'])
            ->select(['id', 'article_id', 'user_id', 'parent_id', 'comment', 'ip_address', 'user_agent', 'created_at'])
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

    /**
     * @param  Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function approve(Request $request): \Illuminate\Http\JsonResponse
    {
        $response = ['status' => false, 'message' => null];
        $validator = Validator::make($request->all(), [
            'id' => ['required', 'integer', 'exists:article_comments,id']
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

    /**
     * @param  Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function changeStatus(Request $request): \Illuminate\Http\JsonResponse
    {
        $response = ['status' => false, 'message' => null];
        $validator = Validator::make($request->all(), [
            'id'   => ['required', 'integer', 'exists:article_comments,id'],
            'type' => ['required', 'string', Rule::in(['status'])]
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
                $type = $request->type;
                $record_type = $article_comment->$type;
                $old_status_text = $record_type ? 'Active' : 'Passive';
                $article_comment->$type = !$record_type;
                $article_comment->save();
                $record_type = $article_comment->$type;
                $new_status_text = $record_type ? 'Active' : 'Passive';
                $response['status'] = true;
                $response['message'] = "Comment(<strong>#".$record_id."</strong>) <strong>".$request->typeText."</strong> value changed <strong>".$old_status_text."</strong> to <strong>".$new_status_text."</strong>.";
                $response['data'] = [
                    'recordStatus'     => $record_type,
                    'recordStatusText' => $new_status_text
                ];
                $response['notify'] = [
                    'message' => $response['message'],
                    'icon'    => 'success',
                    'timer'   => 4000
                ];
            } catch (\Exception $e) {
                $response['message'] = $e->getMessage();
                $response['notify'] = [
                    'message' => "Could not change.",
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

    /**
     * @param  Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request): \Illuminate\Http\JsonResponse
    {
        $response = ['status' => false, 'message' => null];
        $validator = Validator::make($request->all(), [
            'id' => ['required', 'integer', 'exists:article_comments,id']
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
            $record_id = $request->id;
            ArticleComments::where("id", $record_id)->delete();
            $response['status'] = true;
            $response['message'] = "Comment(<strong>#".$record_id."</strong>) successfully deleted.";
            $response['notify'] = [
                'message' => $response['message'],
                'icon'    => 'success',
                'timer'   => 4000
            ];
            $response['hideButton'] = true;
        } catch (\Exception $e) {
            $response['message'] = $e->getMessage();
            $response['notify'] = [
                'message' => "Could not delete.",
                'icon'    => 'error'
            ];
        }
        return response()->json($response);
    }

    /**
     * @param  Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function restore(Request $request): \Illuminate\Http\JsonResponse
    {
        $response = ['status' => false, 'message' => null];
        $validator = Validator::make($request->all(), [
            'id' => ['required', 'integer', 'exists:article_comments,id']
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
            $record_id = $request->id;
            ArticleComments::withTrashed()->where("id", $record_id)->restore();
            $response['status'] = true;
            $response['message'] = "Comment(<strong>#".$record_id."</strong>) successfully restored.";
            $response['notify'] = [
                'message' => $response['message'],
                'icon'    => 'success',
                'timer'   => 4000
            ];
        } catch (\Exception $e) {
            $response['message'] = $e->getMessage();
            $response['notify'] = [
                'message' => "Could not restore.",
                'icon'    => 'error'
            ];
        }
        return response()->json($response);
    }
}
