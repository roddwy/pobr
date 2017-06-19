<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Type_Property;
use Laracasts\Flash\Flash;
use App\Http\Requests\TypesPropertiesRequest;

class TypesPropertiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $typesproperties = Type_Property::orderBy('id','DESC')->paginate(5);

        return view('admin.typesproperties.index')->with('typesproperties',$typesproperties);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //dd('hola esto es creacion de tipo de propiedad');
        return view('admin.typesproperties.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TypesPropertiesRequest $request)
    {
        $typeproperty = new Type_Property($request->all());
        $typeproperty->user_id = \Auth::user()->id;
        $typeproperty->save();

        Flash::success('Se ha registrado el tipo de propiedad '.$typeproperty->name.' Con exito!!!');
        return redirect()->route('admin.typesproperties.index');
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
        $typeproperty = Type_Property::find($id);
        return view('admin.typesproperties.edit')->with('typeproperty',$typeproperty);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TypesPropertiesRequest $request, $id)
    {
        $typeproperty = Type_Property::find($id);
        $typeproperty->fill($request->all());
        $typeproperty->save();

        Flash::warning('El Tipo de Propiedad '.$typeproperty->name.' ha sido actualizado!!!');
        return redirect()->route('admin.typesproperties.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $typeproperty = Type_Property::find($id);
        $typeproperty->delete();

        Flash::error('El tipo de propiedad '.$typeproperty->name.' Ha sido eliminado!!!');
        return redirect()->route('admin.typesproperties.index');
    }
}
