<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Repositories\FaqRepository;
use App\Repositories\PageRepository;
use App\Repositories\VideoRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class InvestmentsController extends Controller
{
    private $pageRepository;
    private $videoRepository;

    public function __construct(
                                    PageRepository $pageRepository,
                                    VideoRepository $videoRepository
                                )
    {
        $this->pageRepository = $pageRepository;
        $this->videoRepository = $videoRepository;
    }

    public function index()
    {
        $pagesInvestments   = $this->getCachedPages();
        $video              = $this->getCachedVideo();

        return view('site.investments.index', compact('pagesInvestments', 'video'));
    }

    private function getCachedPages()
    {
        //if(Cache::get('pagesInvestments') == null) {
            $pagesInvestments = $this->getPages();

            $expiresAt = Carbon::now()->addDays(1);

            Cache::put('pagesInvestments', $pagesInvestments, $expiresAt);
        //}
        
        return Cache::get('pagesInvestments');
    }

    private function getPages()
    {
        return $this->pageRepository->findWhere(['page_category_id' => 3])->all();
    }

    private function getCachedVideo()
    {
        if(Cache::get('video') == null) {
            $video = $this->getVideo();

            $expiresAt = Carbon::now()->addDays(1);

            Cache::put('video', $video, $expiresAt);
        }
        
        return Cache::get('video');
    }

    private function getVideo()
    {
        return $this->videoRepository->orderBy('id', 'DESC')->first();
    }
}
