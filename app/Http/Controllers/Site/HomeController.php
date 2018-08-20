<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Repositories\PostRepository;
use App\Repositories\ProductRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    private $postRepository;
    private $productRepository;

    public function __construct(
                                    PostRepository $postRepository,
                                    ProductRepository $productRepository
                                )
    {
        $this->postRepository = $postRepository;
        $this->productRepository = $productRepository;
    }

    public function index()
    {
        $posts      = $this->getCachedPosts();
        $products   = $this->getCachedProducts();

        return view('site.index.index', compact('posts', 'products'));
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

    private function getCachedProducts()
    {
        //if(Cache::get('products') == null) {
            $products = $this->getProducts();

            $expiresAt = Carbon::now()->addDays(1);

            Cache::put('products', $products, $expiresAt);
        //}
        
        return Cache::get('products');
    }

    private function getProducts()
    {
        return $this->productRepository->paginate(6);
    }
}
