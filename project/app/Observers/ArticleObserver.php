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
        if (!$article->wasChanged('deleted_at') && !$article->wasChanged('view_count') && !$article->wasChanged('approve_status')) {
            $this->updateLog($article);
        }
        $changed_fields = $article->getDirty();
        if (!empty($changed_fields)) {
            if (\Illuminate\Support\Facades\Cache::has('popular_article_list')) {
                $cache = \Illuminate\Support\Facades\Cache::get('popular_article_list');
                $cache_record = $cache->where('id', $article->id)->first();
                if (!empty($cache_record)) {
                    foreach ($changed_fields as $field => $value) {
                        $cache_record->$field = $value;
                    }
                    \Illuminate\Support\Facades\Cache::put('popular_article_list', $cache);
                }
            }
            if (\Illuminate\Support\Facades\Cache::has('last_article_list')) {
                $cache = \Illuminate\Support\Facades\Cache::get('last_article_list');
                $cache_record = $cache->where('id', $article->id)->first();
                if (!empty($cache_record)) {
                    foreach ($changed_fields as $field => $value) {
                        $cache_record->$field = $value;
                    }
                    \Illuminate\Support\Facades\Cache::put('last_article_list', $cache);
                }
            }
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
