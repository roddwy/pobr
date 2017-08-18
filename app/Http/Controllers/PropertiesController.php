<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Property;
use App\Owner_Current;
use App\Zone;
use App\Category;
use App\Type_Property;
use App\State;
use App\Image;
use Laracasts\Flash\Flash;

class PropertiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (\Auth::user()->type_user->name == 'Administrador') {
            $states = State::orderBy('name','ASC')->lists('name','id');
            $properties = Property::BusquedaState($request->state_id)->orderBy('id','DESC')->paginate(10);
            return view('admin.properties.index')->with('properties',$properties)->with('states',$states);
        }else{
            $userid = \Auth::user()->id;
            $properties = Property::where('user_id','=',$userid)->paginate(10);
            return view('admin.properties.index')->with('properties',$properties);
        }
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $ownercurrent = Owner_Current::find($id);
        //$zones = Zone::orderBy('name','ASC')->lists('name','id');
        $categories = Category::orderBy('name','ASC')->lists('name','id');
        $typesproperties = Type_Property::orderBy('name','ASC')->lists('name','id');
        if (\Auth::user()->type_user->name == 'Administrador') {
            $zones = Zone::orderBy('name','ASC')->lists('name','id');
        }else{
             $zones = Zone::where('user_id','=',\Auth::user()->id)->orderBy('name','ASC')->lists('name','id');
        }  
        if (\Auth::user()->type_user->name == 'Administrador') {
            $states = State::orderBy('name', 'ASC')->lists('name','id');
        }else{
            $states = State::where('name','=','Inactivo')->orderBy('name', 'ASC')->lists('name','id');
        }        
        return view('admin.properties.create')->with('ownercurrent',$ownercurrent)
                ->with('zones',$zones)->with('categories',$categories)
                ->with('typesproperties', $typesproperties)->with('states',$states);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $property = new Property($request->all());
        $property->user_id = \Auth::user()->id;
        $property->save();
        /*MANIPULACION DE IMAGENES*/
        $images = $request->file('image');
        if (!empty($images)) :

            foreach ($images as $image) :
                //$image = $request->file('image');
                $name = 'orion_' . time() . '.' . $image->getClientOriginalName();
                $path = public_path().'/images/properties';
                $image->move($path, $name);
                /*GUARDAMOS LA IMAGEN*/
                $image = new Image();
                $image->name = $name;
                $image->property()->associate($property);
                $image->save();
                /*FIN DE GUARDAR IMAGEN*/
            endforeach;           
        endif;
        /*FIN DE MANIPULACION DE IMAGENES*/
        Flash::success('Creacion del inmueble con exito!!!');
        return redirect()->route('admin.properties.index');
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
        $property = Property::find($id);
        $zones = Zone::orderBy('name','ASC')->lists('name','id');
        $categories = Category::orderBy('name','ASC')->lists('name','id');
        $typesproperties = Type_Property::orderBy('name','ASC')->lists('name','id');
        $states = State::orderBy('name', 'ASC')->lists('name','id');
        //dd($property);
        return view('admin.properties.edit')->with('property',$property)->with('zones',$zones)
                ->with('categories',$categories)->with('typesproperties',$typesproperties)->with('states',$states);
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
        $property = Property::find($id);
        $property->fill($request->all());
        $property->save();

        Flash::warning('La Propiedad del Propietario '.$property->owner_current->first_name.' '.$property->owner_current->last_name .' ha sido actualizado!');
        return redirect()->route('admin.properties.index');
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
