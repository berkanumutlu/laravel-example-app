<?php

namespace App\Traits;

use App\Models\Log;

trait Loggable
{
    public function log(string $action, $model, int $loggable_id, $data): void
    {
        Log::create([
            'user_id'       => auth()->id(),
            'action'        => $action,
            'data'          => json_encode($data),
            'loggable_id'   => $loggable_id,
            'loggable_type' => is_object($model) ? get_class($model) : $model
        ]);
    }

    public function updateLog($model): void
    {
        $change = $model->getDirty();
        if (!empty($change)) {
            $data = [];
            foreach ($change as $key => $value) {
                $data[$key]['old'] = $model->getOriginal($key);
                $data[$key]['new'] = $value;
            }
            if (isset($data['updated_at']['old'])) {
                $data['updated_at']['old'] = $data['updated_at']['old']->toDateTimeString();
            }
            $this->log('update', $model, $model->id, $data);
        }
    }
}
