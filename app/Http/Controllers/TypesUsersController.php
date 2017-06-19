<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Type_User;
use Laracasts\Flash\Flash;
use App\Http\Requests\TypeUserRequest;

class TypesUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $typesusers = Type_User::orderBy('id','ASC')->paginate(5);
        //dd($typesusers);
        return view('admin.typeusers.index')->with('typesusers',$typesusers);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.typeusers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TypeUserRequest $request)
    {
        $typeuser = new Type_User($request->all());
        $typeuser->save();
        //dd("Se creo de manera correcta el tipo de usuario");
        Flash::success("Se ha registrado el tipo de usuario " . $typeuser->name ." de forma exitosa!");
        return redirect()->route('admin.typeusers.index');
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
        $typeuser = Type_User::find($id);
        //dd($typeuser);
        return view('admin.typeusers.edit')->with('typeuser',$typeuser);
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
        $typeuser = Type_User::find($id);
        $typeuser->fill($request->all());
        $typeuser->save();

        Flash::warning('El tipo usuario '.$typeuser->name.' ha sido actualizado!');
        return redirect()->route('admin.typeusers.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $typeuser = Type_User::find($id);
        //dd($typeuser);
        $typeuser->delete();

        Flash::error('El tipo usuario '.$typeuser->name.' ha sido eliminado');
        return redirect()->route('admin.typeusers.index');
    }
}
