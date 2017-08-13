<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\State;
use Laracasts\Flash\Flash;
use App\Http\Requests\StatesRequest;

class StateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $states = State::orderBy('id', 'DESC')->paginate(10);
        return view('admin.states.index')->with('states', $states);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.states.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StatesRequest $request)
    {
        $state = new State($request->all());
        $state->user_id = \Auth::user()->id;
        $state->save();

        Flash::success('Se ha registrado '.$state->name.' con Exito!!!');
        return redirect()->route('admin.states.index');
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
        $state = State::find($id);

        return view('admin.states.edit')->with('state',$state);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StatesRequest $request, $id)
    {
        $state = State::find($id);
        $state->fill($request->all());
        $state->save();

        Flash::warning('Se ha Actualizado el Estado de Inmueble '.$state->name.' con exito!!!');
        return redirect()->route('admin.states.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $state = State::find($id);
        $state->delete();

        Flash::error('El Estado de inmueble '.$state->name.' ha sido eliminado!!!');
        return redirect()->route('admin.states.index');
    }
}
