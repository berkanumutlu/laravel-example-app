<?php

namespace App\Observers;

use App\Models\Article;
use App\Traits\Loggable;

class ArticleObserver
{
    use Loggable;

    /**
     * Handle the Article "created" event.
     */
    public function created(Article $article): void
    {
        $this->log('create', $article, $article->id, $article->toArray());
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

    /**
     * Handle the Article "deleted" event.
     */
    public function deleted(Article $article): void
    {
        $this->log('delete', $article, $article->id, $article->toArray());
    }

    /**
     * Handle the Article "restored" event.
     */
    public function restored(Article $article): void
    {
        $this->log('restore', $article, $article->id, $article->toArray());
    }

    /**
     * Handle the Article "force deleted" event.
     */
    public function forceDeleted(Article $article): void
    {
        $this->log('force_delete', $article, $article->id, $article->toArray());
    }
}
