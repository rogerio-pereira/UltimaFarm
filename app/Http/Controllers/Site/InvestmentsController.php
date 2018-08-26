<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Repositories\DepoimentRepository;
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
    private $depoimentRepository;

    public function __construct(
                                    PageRepository $pageRepository,
                                    VideoRepository $videoRepository,
                                    DepoimentRepository $depoimentRepository
                                )
    {
        $this->pageRepository = $pageRepository;
        $this->videoRepository = $videoRepository;
        $this->depoimentRepository = $depoimentRepository;
    }

    public function index()
    {
        $pagesInvestments   = $this->getCachedPages();
        $videoInvestments   = $this->getCachedVideo();
        $depoiments         = $this->getCachedDepoiments();

        return view('site.investments.index', compact('pagesInvestments', 'videoInvestments', 'depoiments'));
    }

    private function getCachedPages()
    {
        if(Cache::get('pagesInvestments') == null) {
            $pagesInvestments = $this->getPages();

            $expiresAt = Carbon::now()->addDays(1);

            Cache::put('pagesInvestments', $pagesInvestments, $expiresAt);
        }
        
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

    private function getCachedDepoiments()
    {
        if(Cache::get('depoiment') == null) {
            $depoiment = $this->getDepoiment();

            $expiresAt = Carbon::now()->addDays(1);

            Cache::put('depoiment', $depoiment, $expiresAt);
        }
        
        return Cache::get('depoiment');
    }

    private function getDepoiment()
    {
        return $this->depoimentRepository->all();
    }
}
