<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Type_User;
use App\User;
use Laracasts\Flash\Flash;
use App\Http\Requests\UsersRequest;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderBy('id', 'DESC')->paginate(10);
        $users->each(function($users){
            $users->type_user;
            $users->zones;
        });
        //dd($users);
        return view('admin.users.index')->with('users',$users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $typeusers = Type_User::orderBy('name', 'ASC')->lists('name', 'id');

        return view('admin.users.create')->with('typeusers', $typeusers);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UsersRequest $request)
    {
        $user = new User($request->all());
        $user->password = bcrypt($request->password);
        $user->save();
        Flash::success("Se ha registrado el usuario " . $user->first_name . " " .$user->last_name." de forma exitosa!");
        return redirect()->route('admin.users.index');
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
        $user = User::find($id);
        $typeusers = Type_User::orderBy('id','ASC')->lists('name', 'id');
        return view('admin.users.edit')->with('user',$user)->with('typeusers',$typeusers);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $user->fill($request->all());
        $user->save();

        Flash::warning('El usuario '.$user->first_name. ' '.$user->last_name.' ha sido actualizado!');
        return redirect()->route('admin.users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();

        Flash::error('El usuario '.$user->first_name.' '.$user->last_name.' ha sido eliminado');
        return redirect()->route('admin.users.index');
    }
}
