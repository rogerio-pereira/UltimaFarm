<?php

namespace App\Http\Controllers\Blog;

use App\Criteria\Blog\ArchiveCriteria;
use App\Criteria\Blog\CategoryCriteria;
use App\Criteria\Blog\SearchCriteria;
use App\Http\Controllers\Controller;
use App\Repositories\PostRepository;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    private $repository;

    public function __construct(PostRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        $posts = $this->repository->orderBy('id','DESC')->paginate(12);

        return view('blog.index.index', compact('posts'));
    }

    public function show($title, $id)
    {
        $post = $this->repository->find($id);

        return view('blog.post.show', compact('post'));
    }

    public function search(Request $request)
    {
        $search = $request->all()['search'];

        $posts = $this->repository
                      ->pushCriteria(new SearchCriteria($search))
                      ->paginate(12);

        return view('blog.index.index', compact('posts'));
    }

    public function category($category, $id)
    {
        $posts = $this->repository->pushCriteria(new CategoryCriteria($id))->paginate(12);

        return view('blog.index.index', compact('posts'));
    }

    public function archive($year, $month)
    {
        $posts = $this->repository
                    ->pushCriteria(new ArchiveCriteria($year, $month))
                    ->paginate(12);

        return view('blog.index.index', compact('posts'));
    }
}
