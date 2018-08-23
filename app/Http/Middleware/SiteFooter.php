<?php

namespace App\Http\Middleware;

use App\Criteria\Address\OrderByCategoryCriteria;
use App\Criteria\Util\ActiveCriteria;
use App\Repositories\BusinessInfoRepository;
use App\Repositories\EmailRepository;
use App\Repositories\PageRepository;
use App\Repositories\TelephoneRepository;
use Carbon\Carbon;
use Closure;
use Illuminate\Support\Facades\Cache;

class SiteFooter
{
    private $businessInfoRepository;
    private $telephoneRepository;
    private $emailRepository;
    private $pageRepository;

    public function __construct(
                                    BusinessInfoRepository $businessInfoRepository,
                                    TelephoneRepository $telephoneRepository,
                                    EmailRepository $emailRepository,
                                    PageRepository $pageRepository
                                )
    {
        $this->businessInfoRepository = $businessInfoRepository;
        $this->telephoneRepository = $telephoneRepository;
        $this->emailRepository = $emailRepository;
        $this->pageRepository = $pageRepository;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $this->getCachedBusinessInformation();
        $this->getCachedTelephones();
        $this->getCachedEmails();
        $this->getCacheBusinessPages();
        $this->getCacheInvestmentPages();

        return $next($request);
    }

    private function getCachedBusinessInformation()
    {
        if(Cache::get('businessInfo') == null) {
            $businessInfo = $this->getBusinessInfo();

            $expiresAt = Carbon::now()->addDays(1);

            Cache::put('businessInfo', $businessInfo, $expiresAt);
        }
        
        return Cache::get('businessInfo');
    }

    private function getBusinessInfo()
    {
        return $this->businessInfoRepository->find(1);
    }


    private function getCachedTelephones()
    {
        if(Cache::get('telephones') == null) {
            $telephones = $this->getTelephones();

            $expiresAt = Carbon::now()->addDays(1);

            Cache::put('telephones', $telephones, $expiresAt);
        }
        
        return Cache::get('telephones');
    }

    private function getTelephones()
    {
        return $this
                    ->telephoneRepository
                    ->pushCriteria(OrderByCategoryCriteria::class)
                    ->pushCriteria(ActiveCriteria::class)
                    ->all();
    }


    private function getCachedEmails()
    {
        if(Cache::get('emails') == null) {
            $emails = $this->getEmails();

            $expiresAt = Carbon::now()->addDays(1);

            Cache::put('emails', $emails, $expiresAt);
        }
        
        return Cache::get('emails');
    }

    private function getEmails()
    {
        return $this
                    ->emailRepository
                    ->pushCriteria(ActiveCriteria::class)
                    ->all();
    }


    private function getCacheBusinessPages()
    {
        if(Cache::get('footerBusinessPages') == null) {
            $footerBusinessPages = $this->getBusinessPages();

            $expiresAt = Carbon::now()->addDays(1);

            Cache::put('footerBusinessPages', $footerBusinessPages, $expiresAt);
        }
        
        return Cache::get('footerBusinessPages');
    }

    private function getBusinessPages()
    {
        return $this->pageRepository->findWhere(['page_category_id' => 2])->all(['title', 'id']);
    }


    private function getCacheInvestmentPages()
    {
        if(Cache::get('footerInvestmentPages') == null) {
            $footerInvestmentPages = $this->getInvestmentPages();

            $expiresAt = Carbon::now()->addDays(1);

            Cache::put('footerInvestmentPages', $footerInvestmentPages, $expiresAt);
        }
        
        return Cache::get('footerInvestmentPages');
    }

    private function getInvestmentPages()
    {
        return $this->pageRepository->findWhere(['page_category_id' => 3])->all(['title', 'id']);
    }
}
