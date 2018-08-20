<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Repositories\PostRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    private $postRepository;

    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function index()
    {
        $posts = $this->getCachedPosts();

        return view('site.index.index', compact('posts'));
    }

    private function getCachedPosts()
    {
        if(Cache::get('posts') == null) {
            $posts = $this->getPosts();

            $expiresAt = Carbon::now()->addDays(1);

            Cache::put('posts', $posts, $expiresAt);
        }
        
        return Cache::get('posts');
    }

    private function getPosts()
    {
        return $this->postRepository->orderBy('id', 'desc')->paginate(3);
    }
}
