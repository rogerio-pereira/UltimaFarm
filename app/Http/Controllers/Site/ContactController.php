<?php

namespace App\Http\Controllers\Site;

use App\Criteria\Address\OrderByCategoryCriteria;
use App\Http\Controllers\Controller;
use App\Repositories\AddressRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ContactController extends Controller
{
    private $addressRepository;

    public function __construct(AddressRepository $addressRepository)
    {
        $this->addressRepository = $addressRepository;
    }

    public function index()
    {
        $contactAddresses = $this->getCachedContactAddress();

        return view('site.contact.index', compact('contactAddresses'));
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
}
