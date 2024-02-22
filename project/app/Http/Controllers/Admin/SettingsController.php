<?php

namespace App\Http\Controllers\Admin;

use App\Models\Settings;
use App\Traits\Loggable;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class SettingsController extends BaseController
{
    use Loggable;

    public function index()
    {
        $this->data['settings'] = Settings::query()->orderBy('created_at', 'asc')->get();
        $this->data['title'] = 'Settings';
        return view('admin.settings.index', $this->data);
    }

    public function update(Request $request)
    {
        try {
            DB::transaction(function () use ($request) {
                $post_data = $request->except('_token');
                $settings = Settings::all();
                $settings_array = $settings->pluck('key_value', 'id')->toArray();
                $changed_settings = [];
                foreach ($post_data['settings'] as $id => $value) {
                    $item_value = current($value);
                    if (gettype($item_value) == 'object' && $request->hasFile('settings.'.$id)) {
                        $item_key = array_key_first($value);
                        $item_file = current($request->file('settings.'.$id));
                        $upload_image = $this->upload_setting_image($item_file, $item_key);
                        $item_value = $upload_image->status ? $upload_image->path : '';
                    }
                    if (!isset($settings_array[$id]) || $settings_array[$id] !== $item_value) {
                        $changed_settings[key($value)]['old'] = $settings_array[$id];
                        $changed_settings[key($value)]['new'] = $item_value;
                    }
                    Settings::query()->where('id', $id)->update(['key_value' => $item_value]);
                }
                $this->log('settings', $settings->first(), 0, $changed_settings);
            });
            Cache::forget('settings');
        } catch (\Exception $e) {
            //alert()->error("Error", $e->getMessage())->showConfirmButton("OK");
            alert()->error("Error", "Any records could not be updated.")->showConfirmButton("OK");
            return redirect()->back()->exceptInput("_token", "files", "image");
        }
        alert()->success("Success", "Settings has been updated successfully.")->showConfirmButton("OK")
            ->autoClose(5000);
        return redirect()->back();
    }

    public function upload_setting_image(UploadedFile $image_file, $file_name): \stdClass
    {
        $response = new \stdClass();
        try {
            $folder = 'settings';
            $public_path = 'storage/'.$folder;
            $image_original_extension = $image_file->getClientOriginalExtension();
            $image_file_name = $file_name.'.'.$image_original_extension;
            $image_file->storeAs($folder, $image_file_name);
            $response->path = $public_path.'/'.$image_file_name;
            $response->status = true;
        } catch (\Exception $e) {
            $response->status = false;
        }
        return $response;
    }
}
