<?php

namespace App\Http\Controllers\Admin;

use App\Models\SocialMedia;
use App\Traits\Loggable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class SocialMediaController extends BaseController
{
    use Loggable;

    public function index()
    {
        $this->data['records'] = SocialMedia::query()->orderBy('sort', 'asc')->get();
        $this->data['title'] = 'Social Media';
        return view('admin.social-media.index', $this->data);
    }

    public function update(Request $request)
    {
        try {
            DB::transaction(function () use ($request) {
                $post_data = $request->except('_token');
                $social_media_list = SocialMedia::all();
                $changed_social_media_list = [];
                foreach ($post_data['socialMedia'] as $id => $attributes) {
                    $item_name = $attributes['name'];
                    $item_status = $attributes['status'];
                    $item_value = $attributes['link'];
                    $item = $social_media_list->where('id', $id)->first();
                    if (!empty($item)) {
                        if ($item->link !== $item_value) {
                            $changed_social_media_list[$item_name]['old'] = $item->link;
                            $changed_social_media_list[$item_name]['new'] = $item_value;
                        }
                        $item->link = $item_value;
                        $item->status = $item_status;
                        $item->sort = $attributes['sort'];
                        $item->save();
                        /*SocialMedia::query()->where('id', $id)->update([
                            'link' => $item_value, 'status' => $item_status, 'sort' => $attributes['sort']
                        ]);*/
                    }
                }
                $this->log('update', $social_media_list->first(), 0, $changed_social_media_list);
            });
            Cache::forget('socials');
        } catch (\Exception $e) {
            alert()->error("Error", "Any records could not be updated.")->showConfirmButton("OK");
            return redirect()->back();
        }
        alert()->success("Success", "Social medias has been updated successfully.")->showConfirmButton("OK")
            ->autoClose(5000);
        return redirect()->back();
    }
}
