<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\ArticleUpdateStore;
use App\Http\Requests\Web\UserUpdatePasswordRequest;
use App\Http\Requests\Web\UserUpdateRequest;
use App\Http\Requests\Web\UserUpdateSocialsRequest;
use App\Models\Article;
use App\Models\Category;
use App\Models\User;
use App\Models\UserSocial;
use App\Traits\Loggable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{
    use Loggable;

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        $user = Auth::guard('web')->user();
        $user->load(['socialsActive:id,social_id,user_id,link', 'socialsActive.social:id,name,icon']);
        $title = 'User Profile';
        return view('web.user.index', compact(['title', 'user']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserUpdateRequest $request, string $id)
    {
        $user = User::findOrFail($id);
        $user_image = $user->image;
        //TODO: Kullanıcıya ait article listesi urlsi de değişeceği için eski username yeni username'e url redirect yapılması gerek.
        $user->username = Str::slug($request->username);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->title = $request->title;
        $user->description = $request->description;
        try {
            $user->save();
            if ($request->file('image')) {
                $folder = 'users';
                $public_path = 'storage/'.$folder;
                $image_file = $request->file('image');
                $image_original_extension = $image_file->getClientOriginalExtension();
                $image_file_name = $user->username.'.'.$image_original_extension;
                $image_new = $public_path.'/'.$image_file_name;
                try {
                    $image_file->storeAs($folder, $image_file_name);
                    User::query()->where('id', $id)->update(['image' => $image_new]);
                    if (file_exists(public_path($user_image))) {
                        File::delete(public_path($user_image));
                    }
                } catch (\Exception $e) {
                    //TODO: Hata loglanmalı
                }
            } elseif ($request->image_file_deleted == 1 && !empty($user_image)) {
                try {
                    User::query()->where('id', $id)->update(['image' => null]);
                    if (file_exists(public_path($user_image))) {
                        File::delete(public_path($user_image));
                    }
                } catch (\Exception $e) {
                    //TODO: Hata loglanmalı
                }
            }
        } catch (\Exception $e) {
            alert()->error("Error", "Your information could not be saved.")->showConfirmButton("OK");
            return redirect()->back()->exceptInput("_token", "files", "image");
        }
        alert()->success("Success", "Your information has been updated successfully.")
            ->showConfirmButton("OK")->autoClose(5000);
        return redirect()->back();
    }

    public function show_change_password()
    {
        $user = Auth::guard('web')->user();
        $title = 'Change Password';
        return view('web.user.change-password', compact(['title', 'user']));
    }

    public function update_password(UserUpdatePasswordRequest $request, User $user)
    {
        if (!Hash::check($request->current_password, $user->password)) {
            alert()->error("Error", "The current password is incorrect.")->showConfirmButton("OK");
            return redirect()->back()->onlyInput();
        }
        try {
            $user->password = Hash::make($request->new_password);
            $user->save();
            $this->log('logout', $user, $user->id);
            Auth::guard('web')->logout();
        } catch (\Exception $e) {
            alert()->error("Error", "Your password could not be saved.")->showConfirmButton("OK");
            return redirect()->back()->onlyInput();
        }
        alert()->success("Success", "Your password has been updated successfully.")
            ->showConfirmButton("OK")->autoClose(5000);
        return redirect()->route('login.index')->onlyInput();
    }

    public function update_socials(UserUpdateSocialsRequest $request, User $user)
    {
        try {
            $user->website = $request->website;
            $user->save();
            if (!empty($request->socials)) {
                $socials_array = UserSocial::query()->where('user_id', $user->id)
                    ->pluck('link', 'social_id')->toArray();
                $changed_socials = [];
                foreach ($request->socials as $social_item) {
                    UserSocial::updateOrCreate(['social_id' => $social_item['social_id'], 'user_id' => $user->id],
                        ['link' => $social_item['link']]);
                    if (!array_key_exists($social_item['social_id'],
                            $socials_array) || $socials_array[$social_item['social_id']] !== $social_item['link']) {
                        $changed_socials[$social_item['name']]['old'] = $socials_array[$social_item['social_id']];
                        $changed_socials[$social_item['name']]['new'] = $social_item['link'];
                    }
                }
                $this->log('update', UserSocial::class, $user->id, $changed_socials);
            }
        } catch (\Exception $e) {
            alert()->error("Error", "Your socials could not be saved.")->showConfirmButton("OK");
            return redirect()->back()->exceptInput("_token");
        }
        alert()->success("Success", "Your socials has been updated successfully.")
            ->showConfirmButton("OK")->autoClose(5000);
        return redirect()->back()->exceptInput("_token");
    }

    public function show_article_list()
    {
        $user = Auth::guard('web')->user();
        $article_list = Article::query()->user($user->id)
            ->with('category:id,name,slug')
            ->select(['id', 'title', 'slug', 'image', 'publish_date', 'read_time', 'category_id', 'status'])
            ->orderBy('publish_date', 'desc')
            ->paginate(15);
        $title = $user->name.'\'s Article List';
        return view('web.user.article-list', compact(['title', 'article_list']));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit_article(Article $article)
    {
        $user = Auth::guard('web')->user();
        if ($article->user_id != $user->id) {
            abort(403);
        }
        $article->load([
            'category:id,name,slug', 'user:id,name,username', 'comments', 'comments.user:id,name,image',
            'comments.children', 'comments.children.user:id,name,image'
        ]);
        $article->commentsCount = $article->comments?->count();
        $article->comments?->map(function ($item) use ($article) {
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
            }
            $article->commentsCount += $item->children?->count();
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
                    }
                });
            }
        });
        $category_list = Category::where('status', 1)->select(['id', 'name'])->orderBy('name', 'asc')->get();
        $userPage = true;
        $record = $article;
        $title = $record->title;
        $description = $record->seo_description;
        $keywords = $record->seo_keywords;
        // view('web.user.article-detail', compact(['title', 'record']));
        return view('web.article.detail',
            compact(['title', 'description', 'keywords', 'record', 'category_list', 'userPage']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update_article(ArticleUpdateStore $request, Article $article)
    {
        $user = Auth::guard('web')->user();
        if ($article->user_id != $user->id) {
            abort(403);
        }
        $article->title = trim($request->title);
        $article->slug = !empty($request->slug) ? Str::slug($request->slug) : Str::slug($request->title);
        $article->body = trim($request->body);
        $article->category_id = $request->category_id;
        $article->read_time = $request->read_time;
        $article->publish_date = $request->publish_date;
        $article->status = isset($request->status) ? 1 : 0;
        $article->tags = is_array($request->tags) ? implode(',', $request->tags) : trim($request->tags);
        $article->seo_keywords = trim($request->seo_keywords);
        $article->seo_description = trim($request->seo_description);
        try {
            $article->save();
        } catch (\Exception $e) {
            alert()->error("Error", "Record could not be updated.")->showConfirmButton("OK");
            return redirect()->back()->exceptInput("_token", "files", "image");
        }
        alert()->success("Success", "Record has been updated successfully.")->showConfirmButton("OK")->autoClose(5000);
        return redirect()->route('user.article.detail', ['article' => $article]);
    }
}
