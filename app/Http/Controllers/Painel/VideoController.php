<?php

namespace App\Http\Controllers\Painel;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Util\UrlController;
use App\Http\Controllers\Util\VideoController as VideoUtilController;
use App\Http\Requests\Painel\VideoRequest;
use App\Repositories\VideoRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Session;
use Spatie\Activitylog\Models\Activity;

class VideoController extends Controller
{
    private $repository;

    public function __construct(VideoRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Gate::denies('view-videos'))
            return redirect('/');

        $videos = $this->repository->paginate();

        return view('painel.videos.index', compact('videos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Gate::denies('create-videos'))
            return redirect('/');

        return view('painel.videos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(VideoRequest $request)
    {
        if(Gate::denies('create-videos'))
            return redirect('/');

        $data = $request->all();
        $data['image'] = str_replace("://painel.", '://', $data['image']);

        $this->repository->create($data);

        //Grava Log
        Activity::all()->last();

        Session::flash('message', ['Video salvo com sucesso!']); 
        Session::flash('alert-type', 'alert-success'); 

        return redirect('/videos');
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
        if(Gate::denies('update-videos'))
            return redirect('/');

        $video = $this->repository->find($id);

        return view('painel.videos.edit', compact('video'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(VideoRequest $request, $id)
    {
        if(Gate::denies('update-videos'))
            return redirect('/');

        $data = $request->all();
        $data['image'] = str_replace("://painel.", '://', $data['image']);

        $this->repository->update($data, $id);

        //Grava Log
        Activity::all()->last();

        Session::flash('message', ['Video alterado com sucesso!']); 
        Session::flash('alert-type', 'alert-success'); 

        return redirect()->route('videos.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Gate::denies('delete-videos'))
            return redirect('/');

        $this->repository->delete($id);

        //Grava Log
        Activity::all()->last();

        return redirect()->route('videos.index');
    }

    public function verifyShortenUrl(Request $request)
    {
        $data = $request->all();
        $url = $data['url'];

        return UrlController::unshorten_url($url);
    }

    public function verifyValidYoutubeUrl(Request $request)
    {
        $data = $request->all();
        $url = $data['url'];

        return VideoUtilController::isValidYoutubeURL($url);
    }

    public function getYoutubeThumb(Request $request)
    {
        $data = $request->all();
        $url = $data['url'];

        $id = VideoUtilController::getYoutubeId($url);

        return "http://img.youtube.com/vi/{$id}/0.jpg";
    }
}
