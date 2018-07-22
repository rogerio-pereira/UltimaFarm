<?php

namespace App\Http\Controllers\Painel;

use App\Http\Controllers\Controller;
use App\Http\Requests\Painel\User\UserCreateRequest;
use App\Http\Requests\Painel\User\UserUpdateRequest;
use App\Models\Permission;
use App\Repositories\PermissionRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Session;
use Spatie\Activitylog\Models\Activity;

class UserController extends Controller
{
    private $repository;
    private $pemissionRepository;
    private $permissionModel;

    public function __construct(
                                    UserRepository $repository,
                                    PermissionRepository $pemissionRepository,
                                    Permission $permissionModel
                                )
    {
        $this->repository = $repository;
        $this->pemissionRepository = $pemissionRepository;
        $this->permissionModel = $permissionModel;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Gate::denies('view-users'))
            return redirect('/');

        $users = $this->repository->paginate();

        return view('painel.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Gate::denies('create-users'))
            return redirect('/');

        $roles = [
            'Simples' => 'Simples', 
            'Administrador' => 'Administrador'
        ];

        $permissions = $this->pemissionRepository->all();
        $notShowPermissions = $this->permissionModel->notShowPermissions;

        return view('painel.users.create', compact('roles', 'permissions', 'notShowPermissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserCreateRequest $request)
    {
        if(Gate::denies('create-users'))
            return redirect('/');

        $data = $request->all();
        $data['password'] = bcrypt($data['password']);

        $user = $this->repository->create($data);

        //Grava Log
        Activity::all()->last();

        if(isset($data['permissions']))
            $user->permissions()->sync($data['permissions']);
        else
            $user->permissions()->sync([]);

            //Grava Log
        Activity::all()->last();

        Session::flash('message', ['Usuário salvo com sucesso!']); 
        Session::flash('alert-type', 'alert-success'); 

        return redirect('/users');
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
        if(Gate::denies('update-users'))
            $id = Auth::user()->id;

        $roles = [
            'Simples' => 'Simples', 
            'Administrador' => 'Administrador'
        ];

        $permissions = $this->pemissionRepository->all();
        $notShowPermissions = $this->permissionModel->notShowPermissions;

        $user = $this->repository->find($id);

        $permissionsUser = $user->permissions;
        $permissionsUser = $permissionsUser->toArray();

        return view('painel.users.edit', compact('user', 'roles', 'permissions', 'permissionsUser', 'notShowPermissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateRequest $request, $id)
    {
        if(Gate::denies('update-users'))
            return redirect('/');

        $data = $request->all();

        if(isset($data['password']))
            $data['password'] = bcrypt($data['password']);
        else 
            unset($data['password']);

        if($data['email'] == Auth::user()->email)
            unset($data['email']);

        $this->repository->update($data, $id);

        //Grava Log
        Activity::all()->last();

        $user = $this->repository->find($id);

        if(isset($data['permissions']))
            $user->permissions()->sync($data['permissions']);
        else
            $user->permissions()->sync([]);

        //Grava Log
        Activity::all()->last();

        //Faz Login Novamente
        $user = $this->repository->find($id);
        Auth::login($user);

        Session::flash('message', ['Usuário alterado com sucesso!']); 
        Session::flash('alert-type', 'alert-success'); 

        //return redirect()->route('users.index');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Gate::denies('delete-users'))
            return redirect('/');

        $this->repository->delete($id);

        //Grava Log
        Activity::all()->last();

        return redirect()->route('users.index');
    }
}
