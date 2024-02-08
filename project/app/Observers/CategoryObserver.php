<?php

namespace App\Observers;

use App\Models\Category;
use App\Models\Log;

class CategoryObserver
{
    /**
     * Handle the Category "created" event.
     */
    public function created(Category $category): void
    {
        $this->log('create', $category->id, $category->toArray());
    }

    /**
     * Handle the Category "updated" event.
     */
    public function updated(Category $category): void
    {
        if (!$category->wasChanged('deleted_at')) {
            $this->updateLog($category);
        }
    }

    public function updateLog(Category $category): void
    {
        $change = $category->getDirty();
        if (!empty($change)) {
            $data = [];
            foreach ($change as $key => $value) {
                $data[$key]['old'] = $category->getOriginal($key);
                $data[$key]['new'] = $value;
            }
            if (isset($data['updated_at']['old'])) {
                $data['updated_at']['old'] = $data['updated_at']['old']->toDateTimeString();
            }
            $this->log('update', $category->id, $data);
        }
    }

    /**
     * Handle the Category "deleted" event.
     */
    public function deleted(Category $category): void
    {
        $this->log('delete', $category->id, $category->toArray());
    }

    /**
     * Handle the Category "restored" event.
     */
    public function restored(Category $category): void
    {
        $this->log('restore', $category->id, $category->toArray());
    }

    /**
     * Handle the Category "force deleted" event.
     */
    public function forceDeleted(Category $category): void
    {
        $this->log('force_delete', $category->id, $category->toArray());
    }

    public function log(string $action, int $loggable_id, $data): void
    {
        Log::create([
            'user_id'       => auth()->guard('web')->id(),
            'action'        => $action,
            'data'          => json_encode($data),
            'loggable_id'   => $loggable_id,
            'loggable_type' => Category::class
        ]);
    }
}
