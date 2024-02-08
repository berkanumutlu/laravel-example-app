<?php

namespace App\Observers;

use App\Models\Article;
use App\Models\Log;

class ArticleObserver
{
    /**
     * Handle the Article "created" event.
     */
    public function created(Article $article): void
    {
        $this->log('create', $article->id, $article->toArray());
    }

    /**
     * Handle the Article "updated" event.
     */
    public function updated(Article $article): void
    {
        if (!$article->wasChanged('deleted_at')) {
            $this->updateLog($article);
        }
    }

    public function updateLog(Article $article): void
    {
        $change = $article->getDirty();
        if (!empty($change)) {
            $data = [];
            foreach ($change as $key => $value) {
                $data[$key]['old'] = $article->getOriginal($key);
                $data[$key]['new'] = $value;
            }
            if (isset($data['updated_at']['old'])) {
                $data['updated_at']['old'] = $data['updated_at']['old']->toDateTimeString();
            }
            $this->log('update', $article->id, $data);
        }
    }

    /**
     * Handle the Article "deleted" event.
     */
    public function deleted(Article $article): void
    {
        $this->log('delete', $article->id, $article->toArray());
    }

    /**
     * Handle the Article "restored" event.
     */
    public function restored(Article $article): void
    {
        $this->log('restore', $article->id, $article->toArray());
    }

    /**
     * Handle the Article "force deleted" event.
     */
    public function forceDeleted(Article $article): void
    {
        $this->log('force_delete', $article->id, $article->toArray());
    }

    public function log(string $action, int $loggable_id, $data): void
    {
        Log::create([
            'user_id'       => auth()->guard('web')->id(),
            'action'        => $action,
            'data'          => json_encode($data),
            'loggable_id'   => $loggable_id,
            'loggable_type' => Article::class
        ]);
    }
}
