<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Repositories\PageRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class BusinessController extends Controller
{
    private $pageRepository;

    public function __construct(PageRepository $pageRepository)
    {
        $this->pageRepository = $pageRepository;
    }

    public function index()
    {
        $pagesBusiness = $this->getCachedPages();

        return view('site.business.index', compact('pagesBusiness'));
    }

    private function getCachedPages()
    {
        //if(Cache::get('pagesBusiness') == null) {
            $pagesBusiness = $this->getPages();

            $expiresAt = Carbon::now()->addDays(1);

            Cache::put('pagesBusiness', $pagesBusiness, $expiresAt);
        //}
        
        return Cache::get('pagesBusiness');
    }

    private function getPages()
    {
        return $this->pageRepository->findWhere(['page_category_id' => 2])->all();
    }
}
