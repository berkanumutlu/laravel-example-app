<?php

namespace App\Http\Controllers\Admin;

use App\Models\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;

class LogController extends BaseController
{
    public function index()
    {
        $this->data['records'] = Log::query()->with(['loggable', 'user:id,name'])
            ->orderBy('id', 'desc')
            ->paginate(20);
        $this->data['columns'] = [
            'Id', 'User', 'Operation', 'Type', 'Creation Time', 'Actions'
        ];
        $this->data['title'] = 'Logs';
        return view('admin.log.index', $this->data);
    }

    public function show_ajax(Request $request)
    {
        $response = ['status' => false, 'message' => null];
        $validator = Validator::make($request->all(), [
            'id' => ['required', 'integer', 'exists:logs,id']
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
        $log = Log::query()->where("id", $record_id)->first();
        if (!empty($log)) {
            $data = json_decode($log->data, true);
            $response['status'] = true;
            $response['data']['raw'] = View::make('admin.log.log-view', ['data' => $data])->render();
        } else {
            $response['message'] = "Log not found.";
            $response['notify'] = [
                'message' => $response['message'],
                'icon'    => 'error'
            ];
        }
        return response()->json($response);
    }

    public function destroy(Request $request)
    {
        $response = ['status' => false, 'message' => null];
        $validator = Validator::make($request->all(), [
            'id' => ['required', 'integer', 'exists:logs']
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
            Log::query()->where("id", $record_id)->first()->delete();
            $response['status'] = true;
            $response['message'] = "Record(<strong>#".$record_id."</strong>) successfully deleted.";
            $response['notify'] = [
                'message' => $response['message'],
                'icon'    => 'success',
                'timer'   => 4000
            ];
        } catch (\Exception $e) {
            $response['message'] = $e->getMessage();
            $response['notify'] = [
                'message' => "Could not delete.",
                'icon'    => 'error'
            ];
        }
        return response()->json($response);
    }
}
