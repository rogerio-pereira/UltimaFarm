<?php

namespace App\Services\Painel;

use App\Mail\Painel\ClientCreateMail;
use App\Repositories\ClientRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Spatie\Activitylog\Models\Activity;

class ClientService
{
    private $clientRepository;
    private $userRepository;

    public function __construct(
                                    ClientRepository $clientRepository,
                                    UserRepository $userRepository
                                )
    {
        $this->clientRepository = $clientRepository;
        $this->userRepository = $userRepository;
    }

    public function store(array $data)
    {
        try
        {
            $user = $data['user'];
            unset($data['user']);

            //Sem Senha
            if(!isset($user['password'])) {
                $password = str_random(8);
                $user['password'] = bcrypt($password);
            }
            else
                $password = null;

            DB::beginTransaction();
                $user = $this->userRepository->create($user);

                $data['user_id']        = $user->id;
                $data['hashIndication'] = md5($user->email);

                if(isset($data['hashUser']) && $data['hashUser'] != '') {
                    $indicator = $this->clientRepository->findWhere(['hashIndication' => $data['hashUser']])->first();

                    $data['indication_id'] = $indicator->id;
                }

                $client = $this->clientRepository->create($data);

                //Grava Log
                Activity::all()->last();
            DB::commit();

            $this->sendMail($client, $password);

            return $user;
        }
        catch(\Exception $e)
        {
            DB::rollBack();
            dd($e);
            throw new \Exception($e->getMessage());
        }
    }

    private function sendMail($client, $password = null)
    {
        Mail::to($client->user->email)->send(new ClientCreateMail($client, $password));
    }
}