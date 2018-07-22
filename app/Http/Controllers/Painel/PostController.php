<?php

namespace App\Http\Controllers\Painel;

use App\Http\Controllers\Controller;
use App\Http\Requests\Painel\PostRequest;
use App\Repositories\PostCategoryRepository;
use App\Repositories\PostRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Session;
use Spatie\Activitylog\Models\Activity;

class PostController extends Controller
{
    private $repository;
    private $categoryRepository;

    public function __construct(
                                    PostRepository $repository,
                                    PostCategoryRepository $categoryRepository
                                )
    {
        $this->repository = $repository;
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Gate::denies('view-posts'))
            return redirect('/');

        $posts = $this->repository->paginate();

        return view('painel.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Gate::denies('create-posts'))
            return redirect('/');

        $postCategories = $this->categoryRepository->comboboxList();

        return view('painel.posts.create', compact('postCategories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        if(Gate::denies('create-posts'))
            return redirect('/');

        $data = $request->all();
        $data['author_id'] = Auth::user()->id;
        $data['image'] = str_replace("://painel.", '://', $data['image']);

        $this->repository->create($data);

        //Grava Log
        Activity::all()->last();

        Session::flash('message', ['Post salvo com sucesso!']); 
        Session::flash('alert-type', 'alert-success'); 

        return redirect('/posts');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(Gate::denies('update-posts'))
            return redirect('/');

        $postCategories = $this->categoryRepository->comboboxList();
        $post = $this->repository->find($id);

        return view('painel.posts.edit', compact('post', 'postCategories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, $id)
    {
        if(Gate::denies('update-posts'))
            return redirect('/');

        $data = $request->all();
        $data['image'] = str_replace("://painel.", '://', $data['image']);

        $this->repository->update($data, $id);

        //Grava Log
        Activity::all()->last();

        Session::flash('message', ['Post alterado com sucesso!']); 
        Session::flash('alert-type', 'alert-success'); 

        return redirect()->route('posts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Gate::denies('delete-posts'))
            return redirect('/');

        $this->repository->delete($id);

        //Grava Log
        Activity::all()->last();

        return redirect()->route('posts.index');
    }
}
