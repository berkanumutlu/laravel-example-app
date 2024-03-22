<?php

namespace App\Http\Middleware;

use App\Models\Article;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VisitedArticle
{
    public function __construct(public Article $article)
    {

    }

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $article = $this->article->query()->where('slug', $request->slug)->status(1)
            ->with([
                'category:id,name,slug', 'user:id,name,username,title,description,image,website',
                'user.socialsActive:id,social_id,user_id,link', 'user.socialsActive.social:id,name,icon',
                'likes:id,user_id', 'comments', 'comments.user:id,name,image', 'comments.children',
                'comments.children.user:id,name,image',
                'comments.currentUserLiked', 'comments.currentUserDisliked'
            ])
            ->select([
                'id', 'title', 'slug', 'body', 'image', 'tags', 'read_time', 'view_count', 'like_count', 'publish_date',
                'category_id', 'user_id', 'seo_keywords', 'seo_description'
            ])
            ->first();
        if (!empty($article)) {
            //$visited_articles = session()->get('visited_articles', []);
            $visited_articles = session()->get('visited_articles');
            if (empty($visited_articles)) {
                $visited_articles = [];
            }
            if (!in_array($article->id, $visited_articles)) {
                $visited_articles[] = $article->id;
                session()->put('visited_articles', $visited_articles);
            }
            session()->put('last_article', $article);
        }
        return $next($request);
    }
}
