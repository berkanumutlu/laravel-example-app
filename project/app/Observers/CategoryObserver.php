<?php

namespace App\Observers;

use App\Models\Category;
use App\Traits\Loggable;

class CategoryObserver
{
    use Loggable;

    /**
     * Handle the Category "created" event.
     */
    public function created(Category $category): void
    {
        $this->log('create', $category, $category->id, $category->toArray());
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

    /**
     * Handle the Category "deleted" event.
     */
    public function deleted(Category $category): void
    {
        $this->log('delete', $category, $category->id, $category->toArray());
    }

    /**
     * Handle the Category "restored" event.
     */
    public function restored(Category $category): void
    {
        $this->log('restore', $category, $category->id, $category->toArray());
    }

    /**
     * Handle the Category "force deleted" event.
     */
    public function forceDeleted(Category $category): void
    {
        $this->log('force_delete', $category, $category->id, $category->toArray());
    }
}
