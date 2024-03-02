<?php

namespace App\Traits;

use App\Models\Log;

trait Loggable
{
    public function log(string $action, $model, int $loggable_id, $data = null): void
    {
        Log::create([
            'user_id'       => auth()->id() ?? $model->id,
            'action'        => $action,
            'data'          => !empty($data) ? json_encode($data) : null,
            'loggable_id'   => $loggable_id,
            'loggable_type' => is_object($model) ? get_class($model) : $model
        ]);
    }

    public function updateLog($model, $action = 'update'): void
    {
        $data = [];
        $change = $model->getDirty();
        if (!empty($change)) {
            foreach ($change as $key => $value) {
                $data[$key]['old'] = $model->getOriginal($key);
                $data[$key]['new'] = $value;
            }
            if (isset($data['updated_at']['old'])) {
                $data['updated_at']['old'] = $data['updated_at']['old']->toDateTimeString();
            }
        }
        $this->log($action, $model, $model->id, $data);
    }
}
