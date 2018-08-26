<?php

namespace App\Http\Middleware\Blog;

use App\Models\PostCategory;
use Carbon\Carbon;
use Closure;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class Sidebar
{

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $this->cacheCategories();
        $this->cacheArchives();

        return $next($request);
    }

    private function cacheCategories()
    {
        if(!Cache::get('blogCategories'))
            $this->getCategories();

        View::share('blogCategories', Cache::get('blogCategories'));
    }

    private function cacheArchives()
    {
        if(!Cache::get('blogArchives'))
            $this->getArchives();

        View::share('blogArchives', Cache::get('blogArchives'));
    }

    private function getCategories()
    {
        $blogCategories = PostCategory::select('id', 'title')->get();

        $expiresAt = Carbon::now()->addDay(1);

        Cache::add('blogCategories', $blogCategories, $expiresAt);
    }

    private function getArchives()
    {
        $blogArchives = DB::table('posts')
                        ->select(DB::raw("
                            YEAR(created_at) as year, 
                            MONTH(created_at) as month
                        "))
                        ->groupBy('month')
                        ->groupBy('year')
                        ->orderBy('year', 'desc')
                        ->orderBy('month', 'desc')
                        ->get();

        $expiresAt = Carbon::now()->addDay(1);

        Cache::add('blogArchives', $blogArchives, $expiresAt);
    }
}
