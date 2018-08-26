<?php

namespace App\Http\Controllers\Painel;

use App\Http\Controllers\Controller;
use App\Http\Requests\Painel\PageRequest;
use App\Repositories\PageCategoryRepository;
use App\Repositories\PageRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Session;
use Spatie\Activitylog\Models\Activity;

class PageController extends Controller
{
    private $repository;
    private $categoryRepository;

    public function __construct(
                                    PageRepository $repository,
                                    PageCategoryRepository $categoryRepository
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
        if(Gate::denies('view-pages'))
            return redirect('/');

        $pages = $this->repository->orderBy('page_category_id')->paginate();

        return view('painel.pages.index', compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Gate::denies('create-pages'))
            return redirect('/');

        $pageCategories = $this->categoryRepository->comboboxList();

        return view('painel.pages.create', compact('pageCategories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PageRequest $request)
    {
        if(Gate::denies('create-pages'))
            return redirect('/');

        $data = $request->all();
        $data['image'] = str_replace("://painel.", '://', $data['image']);

        $this->repository->create($data);

        //Grava Log
        Activity::all()->last();

        $this->storeinCache();

        Session::flash('message', ['Página salva com sucesso!']); 
        Session::flash('alert-type', 'alert-success'); 

        return redirect('/pages');
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
        if(Gate::denies('update-pages'))
            return redirect('/');

        $page = $this->repository->find($id);
        $pageCategories = $this->categoryRepository->comboboxList();

        return view('painel.pages.edit', compact('page', 'pageCategories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PageRequest $request, $id)
    {
        if(Gate::denies('update-pages'))
            return redirect('/');

        $data = $request->all();
        $data['image'] = str_replace("://painel.", '://', $data['image']);

        $this->repository->update($data, $id);

        //Grava Log
        Activity::all()->last();

        $this->storeinCache();

        Session::flash('message', ['Página alterada com sucesso!']); 
        Session::flash('alert-type', 'alert-success'); 

        return redirect()->route('pages.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Gate::denies('delete-pages'))
            return redirect('/');

        $this->repository->delete($id);

        //Grava Log
        Activity::all()->last();

        $this->storeinCache();

        return redirect()->route('pages.index');
    }

    private function storeinCache()
    {
        $pages = $this->repository->findWhere(['page_category_id' => 1])->all();
        $pagesBusiness = $this->repository->findWhere(['page_category_id' => 2])->all();
        $pagesInvestments = $this->repository->findWhere(['page_category_id' => 3])->all();

        //Footer
        $footerBusinessPages = $this->repository->findWhere(['page_category_id' => 2])->all(['title', 'id']);
        $footerInvestmentPages = $this->repository->findWhere(['page_category_id' => 3])->all(['title', 'id']);

        $expiresAt = Carbon::now()->addDays(1);

        Cache::put('pagesBusiness', $pages, $expiresAt);
        Cache::put('pagesBusiness', $pagesBusiness, $expiresAt);
        Cache::put('pagesBusiness', $pagesInvestments, $expiresAt);
        Cache::put('footerBusinessPages', $footerBusinessPages, $expiresAt);
        Cache::put('footerInvestmentPages', $footerInvestmentPages, $expiresAt);
    }
}
