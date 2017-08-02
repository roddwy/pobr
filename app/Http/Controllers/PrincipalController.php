<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Property;
use App\State;
use App\Zone;
use App\Category;
use App\Type_Property;

class PrincipalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $states = State::where('name','vendido')->orWhere('name','inactivo')->get();
        $statesid = array();
        foreach ($states as $state) {
            $statesid[] = array('state_id'=>$state->id);
        }
        $properties = Property::where('state_id','<>',$statesid[0])->where('state_id','<>',$statesid[1])->orderBy('id','DESC')->paginate(6);
        $coordenadas = array();
        foreach ($properties as $property) {
            $coordenadas[]= array('lat'=>$property->lat_map,'lng'=>$property->lng_map,'tipo'=>$property->type_property->name.' en '.$property->category->name,'image'=>$property->images->first()->name, 'idproperty'=>$property->id);
        }
        foreach ($properties as $property) {
            $coordenadasclusters[]= array('lat'=>$property->lat_map,'lng'=>$property->lng_map);
        }
        //dd($coordenadasclusters);
        //dd($properties);
        return view('welcome')->with('properties',$properties)->with('coordenadas',$coordenadas)->with('coordenadasclusters',$coordenadasclusters);
    }

    /**
     *Function search properties
    */
    public function search(Request $request)
    {
        $states = State::where('name','vendido')->orWhere('name','inactivo')->get();
        $statesid = array();
        foreach ($states as $state) {
            $statesid[] = array('state_id'=>$state->id);
        }
        //dd($statesid);

       $properties = Property::where('state_id','<>',$statesid[0])->where('state_id','<>',$statesid[1])
                    ->BusquedaPrecio2($request->sale_price,$request->sale_price2)->BusquedaZona($request->zone_id)->BusquedaCategoria($request->category_id)
                    ->BusquedaTipo($request->type_property_id)->orderBy('sale_price', 'ASC')->paginate(4);
       //$properties = property::all();
       //dd($properties);
       
       $zones = Zone::orderBy('name', 'ASC')->lists('name', 'id');
       $categories = Category::orderBy('name', 'ASC')->lists('name', 'id');
       $types = Type_Property::orderBy('name', 'ASC')->lists('name', 'id');
       //$state = State::orderBy('name', 'ASC')->lists('name', 'id');
        return view('search')->with('properties', $properties)->with('zones',$zones)->with('categories', $categories)->with('types', $types);
    }

    /**
     *  Function Oferta
    */

    public function sale()
    {
        //$properties = DB::table('properties')->get();
       //dd($properties);
        $states = State::where('name','oferta')->get();
        foreach ($states as $state) {
            $stateid = $state->id;
        }
        //dd($stateid);
        $properties = property::where('state_id',$stateid)->orderBy('id','DESC')->paginate(6);

        /*$properties = DB::table('states')
            ->leftJoin('properties', 'states.id', '=', 'properties.state_id')
            ->where('states.name','=','oferta')->get();
        dd($properties);*/ 
        //$state = State::orderBy('name', 'ASC')->lists('name', 'id');       
        return view('sale',['properties'=>$properties]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $property = Property::find($id);
        $property->images;        
        return view('detailproperty')->with('property',$property);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
