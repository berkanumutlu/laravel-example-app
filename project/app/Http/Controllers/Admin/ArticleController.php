<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\ArticleStoreRequest;
use App\Http\Requests\Admin\ArticleUpdateRequest;
use App\Models\Articles;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ArticleController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $categories = Category::where('status', 1)->select(['id', 'name'])->orderBy('name', 'asc')->get();
        $this->data['categories'] = $categories;
        $users = User::select(['id', 'name'])->orderBy('name', 'asc')->get();
        $this->data['users'] = $users;
        $records = Articles::query()->with(['category:id,name', 'user:id,name'])->select([
            'id', 'title', 'slug', 'body', 'image', 'status', 'read_time', 'view_count', 'like_count',
            'publish_date', 'category_id', 'user_id', 'created_at'
        ])
            //->where(function ($query) use ($category_id, $user_id) {
            //    if (!is_null($category_id)) {
            //        $query->where('category_id', $category_id);
            //    }
            //    if (!is_null($user_id)) {
            //        $query->where('user_id', $user_id);
            //    }
            //})
            //->where("category_id", $category_id)
            ->title($request->title)
            ->slug($request->slug)
            ->body($request->body)
            ->status($request->status)
            ->tag($request->tag)
            ->publishDate($request->publish_date)
            ->where(function ($query) use ($request) {
                if ($request->min_view_count) {
                    $query->where('view_count', '>=', (int) $request->min_view_count);
                }
                if ($request->max_view_count) {
                    $query->where('view_count', '<=', (int) $request->max_view_count);
                }
                if ($request->min_like_count) {
                    $query->where('like_count', '>=', (int) $request->min_like_count);
                }
                if ($request->max_like_count) {
                    $query->where('like_count', '<=', (int) $request->max_like_count);
                }
            })
            ->user($request->user_id)
            ->category($request->category_id)
            ->orderBy('id', 'desc')
            ->paginate(20)
            ->appends(request()->query());// Pagination'daki sayfa linklerine filtre parametrelerini eklemesini sağlıyor.
        $this->data['records'] = $records;
        $this->data['columns'] = [
            'Id', 'Title', 'Slug', 'Body', 'Image', 'Status', 'Read Time', 'Views', 'Likes', 'Publish Date',
            'Category', 'User', 'Creation Time', 'Actions'
        ];
        $this->data['title'] = 'Article List';
        return view('admin.article.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->data['category_list'] = Category::where('status', 1)->select(['id', 'name'])
            ->orderBy('name', 'asc')->get();
        $this->data['title'] = 'Add Article';
        return view('admin.article.add-edit', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ArticleStoreRequest $request)
    {
        $slug = !empty($request->slug) ? Str::slug($request->slug) : Str::slug($request->title);
        if (!is_null($this->check_slug(Articles::class, $slug))) {
            $slug = Str::slug($slug.'-'.random_int(1, 9999));
        }
        $data = [
            'title'           => trim($request->title),
            'slug'            => $slug,
            'body'            => $request->body,
            'category_id'     => $request->category_id,
            'read_time'       => $request->read_time,
            'publish_date'    => $request->publish_date,
            'status'          => isset($request->status) ? 1 : 0,
            'tags'            => is_array($request->tags) ? implode(',', $request->tags) : trim($request->tags),
            'seo_keywords'    => $request->seo_keywords,
            'seo_description' => $request->seo_description,
            'user_id'         => auth()->id()
            //'user_id'         => auth()->user()->id,
            //'user_id'         => Auth::id(),
            //'user_id'         => Auth::user()->id,
        ];
        if ($request->file('image')) {
            $folder = 'articles';
            $public_path = 'storage/'.$folder;
            $image_file = $request->file('image');
            $image_original_name = $image_file->getClientOriginalName();
            $image_original_extension = $image_file->getClientOriginalExtension();
            //$image_original_extension = $image_file->extension();
            $image_file_name = $data['slug'].'.'.$image_original_extension;
            $image_file_path = public_path($public_path.'/'.$image_file_name);
            /*if (file_exists($image_file_path)) {
                return redirect()->back()->withErrors([
                    'image' => 'This image file already uploaded.'
                ]);
            }*/
            try {
                /**
                 * store => Dosyayı kaydetmeyi sağlıyor. options parametresi .env dosyasındaki FILESYSTEM_DISK değerine göre işlem yapar.
                 * FILESYSTEM_DISK değeri config/filesystems.php içerisindeki disks değerlere göre alır.
                 * storeAs => Dosyaya isim vermek için kullanılıyor.
                 */
                //$image_file->store('articles', 'public');
                $image_file->storeAs($folder, $image_file_name);
                $data['image'] = $public_path.'/'.$image_file_name;
            } catch (\Exception $e) {

            }
        }
        try {
            Articles::create($data);
        } catch (\Exception $e) {
            //abort(500, $e->getMessage());
            //alert()->error("Error", $e->getMessage())->showConfirmButton("OK");
            if (isset($image_file_path) && file_exists($image_file_path)) {
                File::delete($image_file_path);
            }
            alert()->error("Error", "Record could not be added.")->showConfirmButton("OK");
            return redirect()->back();
        }
        alert()->success("Success", "Record has been added successfully.")->showConfirmButton("OK")->autoClose(5000);
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $article = Articles::where('id', $id)->first();
        if (is_null($article)) {
            alert()->error("Error", "Record not found.")->showConfirmButton("OK");
            return redirect()->route('admin.article.index');
        }
        $this->data['record'] = $article;
        $this->data['category_list'] = Category::where('status', 1)->select(['id', 'name'])
            ->orderBy('name', 'asc')->get();
        $this->data['title'] = 'Article #'.$id.' Edit';
        return view('admin.article.add-edit', $this->data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ArticleUpdateRequest $request, string $id)
    {
        $slug = !empty($request->slug) ? Str::slug($request->slug) : Str::slug($request->title);
        $data = [
            'title'           => trim($request->title),
            'slug'            => $slug,
            'body'            => $request->body,
            'category_id'     => $request->category_id,
            'read_time'       => $request->read_time,
            'publish_date'    => $request->publish_date,
            'status'          => isset($request->status) ? 1 : 0,
            'tags'            => is_array($request->tags) ? implode(',', $request->tags) : trim($request->tags),
            'seo_keywords'    => $request->seo_keywords,
            'seo_description' => $request->seo_description,
            'user_id'         => auth()->id()
        ];
        try {
            Articles::query()->where('id', $id)->update($data);
            if ($request->file('image')) {
                $record = Articles::query()->where('id', $id)->first();
                $folder = 'articles';
                $public_path = 'storage/'.$folder;
                $image_file = $request->file('image');
                $image_original_extension = $image_file->getClientOriginalExtension();
                $image_file_name = $data['slug'].'.'.$image_original_extension;
                try {
                    $image_file->storeAs($folder, $image_file_name);
                    Articles::query()->where('id', $id)->update(['image' => $public_path.'/'.$image_file_name]);
                    if (file_exists(public_path($record->image))) {
                        //Storage::delete($record->image); // DB'de image değerleri storage/... olarak tutulduğu için çalışmadı.
                        File::delete(public_path($record->image));
                    }
                } catch (\Exception $e) {

                }
            }
        } catch (\Exception $e) {
            alert()->error("Error", "Record could not be updated.")->showConfirmButton("OK");
            return redirect()->back();
        }
        alert()->success("Success", "Record has been updated successfully.")->showConfirmButton("OK")->autoClose(5000);
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
