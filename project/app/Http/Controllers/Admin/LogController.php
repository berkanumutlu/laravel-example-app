<?php

namespace App\Http\Controllers\Admin;

use App\Models\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LogController extends BaseController
{
    public function index()
    {
        $this->data['records'] = Log::query()->with(['loggable', 'user:id,name'])
            ->orderBy('created_at', 'desc')->paginate(20);
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
            $response['status'] = true;
            $data = '<table style="width: 100%;"><thead><th colspan="2">Key</th><th>Value</th></thead><tbody>';
            if (!empty($log->data)) {
                $log->data = json_decode($log->data, true);
                if (is_array($log->data)) {
                    foreach ($log->data as $key => $value) {
                        $data .= '<tr><td colspan="2">'.$key.'</td><td>';
                        if (is_string($value)) {
                            $data .= $value;
                        } elseif (is_array($value)) {
                            if (isset($value['old']) || isset($value['new'])) {
                                $data .= ($value['old'] ?? 'null').' => '.($value['new'] ?? 'null');
                            } else {
                                foreach ($value as $item) {
                                    $data .= $item.' ';
                                }
                                $data = rtrim($data, ' ');
                            }
                        }
                        $data .= '</td></tr>';
                    }
                }
            }
            $data .= '</tbody></table>';
            $response['data']['raw'] = $data;
        } else {
            $response['message'] = "Log not found.";
            $response['notify'] = [
                'message' => $response['message'],
                'icon'    => 'error'
            ];
        }
        return response()->json($response);
    }
}
