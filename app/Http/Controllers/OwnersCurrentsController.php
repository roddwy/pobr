<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Owner_Current;
use Laracasts\Flash\Flash;
use App\Http\Requests\OwnersCurrentsRequest;

class OwnersCurrentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $ownerscurrents = Owner_Current::searchPhoneCell($request->phone)->orderBy('id','DESC')->paginate(5);

        return view('admin.ownerscurrents.index')->with('ownerscurrents',$ownerscurrents);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.ownerscurrents.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OwnersCurrentsRequest $request)
    {
        $ownercurrent = new Owner_Current($request->all());
        $ownercurrent->user_id = \Auth::user()->id;
        $ownercurrent->save();
        
        Flash::success('Se ha registrado el propietario '.$ownercurrent->first_name.' '.$ownercurrent->last_name.' con Exito!!!');
        return redirect()->route('admin.ownerscurrents.index');
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
        $ownercurrent = Owner_Current::find($id);

        return view('admin.ownerscurrents.edit')->with('ownercurrent',$ownercurrent);
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
        $ownercurrent = Owner_Current::find($id);
        //dd($ownercurrent);
        $ownercurrent->fill($request->all());
        $ownercurrent->save();

        Flash::warning('El propietario '.$ownercurrent->first_name.' '.$ownercurrent->last_name.' se ha actualizado con Exito!!!');
        return redirect()->route('admin.ownerscurrents.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ownercurrent = Owner_Current::find($id);
        $ownercurrent->delete();

        Flash::error('El propietario '.$ownercurrent->first_name.' '.$ownercurrent->last_name.' ha sido eliminado');
        return redirect()->route('admin.ownerscurrents.index');
    }
}
