<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class CategoryController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //$records = Category::all();
        //$records = Category::all()->toArray();
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
        $this->data['title'] = 'Add Category';
        return view('admin.category.add', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
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
