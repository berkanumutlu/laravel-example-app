<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\CategoryStoreRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class CategoryController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        //$this->middleware('language');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //$records = Category::all();
        //$records = Category::all()->toArray();
        //$records = Category::all(['id', 'name']);
        //$records = Category::with('parentCategory')->get();
        //$records = Category::with('parentCategory:id,name,slug')->get();
        //$records = Category::with('parentCategory:id,name,slug')->select(['id', 'name', 'slug', 'description', 'order', 'parent_id', 'created_at'])->get()->makeVisible(['created_at']);
        //$records = Category::with(['parentCategory:id,name,slug', 'user:name'])->select(['id', 'name', 'slug', 'description', 'status', 'feature_status', 'order', 'parent_id', 'created_at'])->get();
        $records = Category::with(['parentCategory:id,name,slug'])->select([
            'id', 'name', 'slug', 'description', 'status', 'feature_status', 'order', 'parent_id', 'created_at'
        ])->orderBy('id', 'desc')->get();
        /*foreach ($records as $record) {
            $record->name = 'Berkan';
            if ($record->parentCategory) {
                dd($record);
            }
        }*/
        /**
         * paginate => Pagination için kullanılıyor, sayfa başı kaç veri göstermesini belirtiyor.
         */
        /*$records = Category::with(['parentCategory:id,name,slug'])->select([
            'id', 'name', 'slug', 'description', 'status', 'feature_status', 'order', 'parent_id', 'created_at'
        ])->orderBy('id', 'desc')->paginate(10);*/
        $this->data['records'] = $records;
        $this->data['columns'] = [
            'Id', 'Name', 'Slug', 'Description', 'Status', 'Feature Status', 'Order', 'Parent Category',
            'Creation Time', 'Actions'
        ];
        $this->data['title'] = 'Category List';
        return view('admin.category.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->data['category_list'] = Category::where('status', 1)->select(['id', 'name'])->get();
        $this->data['title'] = 'Add Category';
        return view('admin.category.add-edit', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryStoreRequest $request)
    {
        try {
            $category = new Category();
            $slug = !empty($request->slug) ? Str::slug($request->slug) : Str::slug($request->name);
            $category->name = $request->name;
            $category->slug = is_null($this->slug_check($slug)) ? $slug : Str::slug($slug.'-'.random_int(1, 9999));
            $category->description = $request->description;
            $category->status = isset($request->status) ? 1 : 0;
            $category->feature_status = isset($request->feature_status) ? 1 : 0;
            $category->parent_id = $request->parent_id;
            $category->seo_keywords = $request->seo_keywords;
            $category->seo_description = $request->seo_description;
            $category->order = $request->order;
            $category->save();
        } catch (\Exception $e) {
            abort(500, $e->getMessage());
        }
        alert()->success("Success", "Record successfully added.")
            ->showConfirmButton("OK")->autoClose(5000);
        return redirect()->back();
    }

    public function slug_check(string $slug)
    {
        return Category::where('slug', $slug)->first();
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
        $this->data['title'] = 'Category #'.$id.' Edit';
        $category = Category::where('id', $id)->first();
        if (is_null($category)) {
            alert()->error("Error", "Record not found.")->showConfirmButton("OK");
            return redirect()->route('admin.category.index');
        }
        $this->data['record'] = $category;
        $this->data['category_list'] = Category::where('status', 1)->select(['id', 'name'])->get();
        /*$validator = Validator::make(['id' => $id], [
            'id' => ['required', 'integer', 'exists:categories']
        ]);
        if ($validator->fails()) {
            $this->data['errors'] = $validator->errors();
        } else {
            $this->data['record'] = Category::where('id', $id)->first();
            $this->data['category_list'] = Category::where('status', 1)->select(['id', 'name'])->get();
        }
        $this->data['title'] = 'Category #'.$id.' Edit';*/
        return view('admin.category.add-edit', $this->data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $slug = Str::slug($request->slug);
        $slug_check = $this->slug_check($slug);
        $category = Category::find($id);
        if (is_null($slug_check) || (!is_null($slug_check) && $slug_check->id == $category->id)) {
            $category->slug = $slug;
        } else {
            $category->slug = Str::slug($slug.'-'.random_int(1, 9999));
        }
        $category->name = $request->name;
        $category->description = $request->description;
        $category->status = isset($request->status) ? 1 : 0;
        $category->feature_status = isset($request->feature_status) ? 1 : 0;
        $category->parent_id = $request->parent_id;
        $category->seo_keywords = $request->seo_keywords;
        $category->seo_description = $request->seo_description;
        $category->order = $request->order;
        try {
            $category->save();
        } catch (\Exception $e) {
            //abort(500, $e->getMessage());
            alert()->error("Error", "Record could not be updated.")
                ->showConfirmButton("OK")->autoClose(5000);
            return redirect()->back();
        }
        alert()->success("Success", "Record has been updated successfully.")
            ->showConfirmButton("OK")->autoClose(5000);
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request): \Illuminate\Http\JsonResponse
    {
        $result = ['status' => false, 'message' => null];
        $validator = Validator::make($request->all(), [
            'id' => ['required', 'integer', 'exists:categories']
        ]);
        if ($validator->fails()) {
            $result['message'] = collect($validator->errors()->all())->implode('<br>');
            $result['icon'] = 'info';
            return response()->json($result);
        }
        try {
            $record_id = $request->id;
            Category::where("id", $record_id)->delete();
            $result['status'] = true;
            $result['message'] = "Record(<strong>#".$record_id."</strong>) successfully deleted.";
            $result['icon'] = 'success';
            $result['timer'] = 4000;
        } catch (\Exception $e) {
            $result['message'] = "Could not save.";
            $result['icon'] = 'error';
        }
        return response()->json($result);
    }

    /**
     * @param  Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function change_status(Request $request): \Illuminate\Http\JsonResponse
    {
        $result = ['status' => false, 'message' => null];
        /*$request->validate([
            'id'   => ['required', 'integer', 'exists:categories'],
            'type' => ['required', 'string', Rule::in(['status', 'feature_status'])],
        ]);*/
        $validator = Validator::make($request->all(), [
            'id'   => ['required', 'integer', 'exists:categories'],
            'type' => ['required', 'string', Rule::in(['status', 'feature_status'])]
        ]);
        if ($validator->fails()) {
            $result['message'] = collect($validator->errors()->all())->implode('<br>');
            $result['icon'] = 'info';
            return response()->json($result);
        }
        $record_id = $request->id;
        $category = Category::where("id", $record_id)->first();
        if (!empty($category)) {
            try {
                $type = $request->type;
                $old_status_text = $category->$type ? 'Active' : 'Passive';
                $category->$type = !$category->$type;
                $category->save();
                $new_status_text = $category->$type ? 'Active' : 'Passive';
                $result['status'] = true;
                $result['message'] = "Record(<strong>#".$record_id."</strong>) <strong>".$request->typeText."</strong> value changed <strong>".$old_status_text."</strong> to <strong>".$new_status_text."</strong>.";
                $result['icon'] = 'success';
                $result['timer'] = 4000;
            } catch (\Exception $e) {
                //$result['system_message'] = $e->getMessage();
                $result['message'] = "Could not save.";
                $result['icon'] = 'error';
            }
        } else {
            $result['message'] = "Record not found.";
            $result['icon'] = 'error';
        }
        /*alert()->success("Success", "Record status value changed ".$old_status_text." to ".$new_status_text.".")
            ->showConfirmButton("OK")->autoClose(5000);*/
        //return redirect()->route('admin.category.index');
        //return redirect()->back();
        return response()->json($result);
    }
}
