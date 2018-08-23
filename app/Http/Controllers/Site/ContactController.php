<?php

namespace App\Http\Controllers\Site;

use App\Criteria\Address\OrderByCategoryCriteria;
use App\Criteria\Util\ActiveCriteria;
use App\Http\Controllers\Controller;
use App\Repositories\AddressRepository;
use App\Repositories\EmailRepository;
use App\Repositories\TelephoneRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ContactController extends Controller
{
    private $addressRepository;
    private $telephoneRepository;
    private $emailRepository;

    public function __construct(
                                    AddressRepository $addressRepository,
                                    TelephoneRepository $telephoneRepository,
                                    EmailRepository $emailRepository
                                )
    {
        $this->addressRepository = $addressRepository;
        $this->telephoneRepository = $telephoneRepository;
        $this->emailRepository = $emailRepository;
    }

    public function index()
    {
        $contactTelephones = $this->getCachedContactTelephones();
        $contactAddresses = $this->getCachedContactAddress();
        $contactEmails = $this->getCachedContactEmails();

        return view('site.contact.index', compact('contactTelephones', 'contactAddresses', 'contactEmails'));
    }



    private function getCachedContactTelephones()
    {
        if(Cache::get('contactTelephones') == null) {
            $contactTelephones = $this->getContactTelephones();

            $expiresAt = Carbon::now()->addDays(1);

            Cache::put('contactTelephones', $contactTelephones, $expiresAt);
        }
        
        return Cache::get('contactTelephones');
    }

    private function getContactTelephones()
    {
        return $this
                    ->telephoneRepository
                    ->pushCriteria(OrderByCategoryCriteria::class)
                    ->pushCriteria(ActiveCriteria::class)
                    ->all();
    }



    private function getCachedContactAddress()
    {
        if(Cache::get('contactAddresses') == null) {
            $contactAddresses = $this->getContactAddress();

            $expiresAt = Carbon::now()->addDays(1);

            Cache::put('contactAddresses', $contactAddresses, $expiresAt);
        }
        
        return Cache::get('contactAddresses');
    }

    private function getContactAddress()
    {
        return $this
                    ->addressRepository
                    ->pushCriteria(OrderByCategoryCriteria::class)
                    ->all();
    }



    private function getCachedContactEmails()
    {
        if(Cache::get('contactEmails') == null) {
            $contactEmails = $this->getContactEmails();

            $expiresAt = Carbon::now()->addDays(1);

            Cache::put('contactEmails', $contactEmails, $expiresAt);
        }
        
        return Cache::get('contactEmails');
    }

    private function getContactEmails()
    {
        return $this
                    ->emailRepository
                    ->pushCriteria(ActiveCriteria::class)
                    ->all();
    }
}
