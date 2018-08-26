<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Repositories\FaqRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class FaqController extends Controller
{
    private $repository;

    public function __construct(FaqRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        $faqs = $this->getCachedFaq();

        return view('site.faq.index', compact('faqs'));
    }

    private function getCachedFaq()
    {
        if(Cache::get('faqs') == null) {
            $faqs = $this->getFaqs();

            $expiresAt = Carbon::now()->addDays(1);

            Cache::put('faqs', $faqs, $expiresAt);
        }
        
        return Cache::get('faqs');
    }

    private function getFaqs()
    {
        return $this->repository->all();
    }
}
