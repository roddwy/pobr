<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Zone;
use App\User;
use DB;
use Laracasts\Flash\Flash;
use App\Http\Requests\ZonesRequest;

class ZonesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $zones = Zone::orderBy('id','DESC')->paginate(10);
        return view('admin.zones.index')->with('zones', $zones);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.zones.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ZonesRequest $request)
    {
        $zone = new Zone($request->all());
        $zone->user_id = \Auth::user()->id;
        $zone->save();

        Flash::success('Se ha registrado la zona '.$zone->name.' con exito!!!');
        return redirect()->route('admin.zones.index');
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
        $zone = Zone::find($id);
        $users = User::select('id',DB::raw('CONCAT(first_name, " ", last_name) AS full_name'))
                //->join('types_users','types_users.id','=','users.type_user_id')
                //->where('type_user','=','Asesor de venta')
                ->orderBy('id','DESC')
                ->lists('full_name','id');
        //dd($users);
        return view('admin.zones.edit')->with('zone', $zone)->with('users', $users);
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
        $zone = Zone::find($id);
        //$zone->fill($request->all());
        $zone->name = $request->name;
        $zone->user_id = $request->user_id;
        $zone->save();

        Flash::warning('La zona '.$zone->name.' ha sido actualizada');
        return redirect()->route('admin.zones.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $zone = Zone::find($id);
        $zone->delete();

        Flash::error('La zona '.$zone->name.' ha sido eliminado!!!');
        return redirect()->route('admin.zones.index');
    }
}
