<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Customer;

use Laracasts\Flash\Flash;
use App\Http\Requests\CustomersRequest;

class CustomersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('customer');    
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->property);
        $customer = new Customer($request->all());
        $customer->save();
        $property[] = "1";
        //dd($property);
        $customer->properties()->sync($property);
        //dd('Se registro el cliente'.$customer->first_name);
        Flash::success('Usted '.$customer->first_name.' '.$customer->last_name.' ha sido registrado con Exito!!!');
        return redirect()->route('customers');
    }

    public function newCustomer(CustomersRequest $request)
    {
        //dd($request);
        if($request->ajax())
        {
            $customer = Customer::create($request->all()); 
            $property[] = $request->property;
            $customer->properties()->sync($property);           
            return response()->json($customer);            
        }
        
    }

     public function editCustomer(Request $request)
    {
        //dd($request);
        if($request->ajax())
        {   
            $customer = Customer::find($request->id); 
            $customer->first_name = $request->first_name;
            $customer->last_name = $request->last_name;
            $customer->phone = $request->phone;
            $customer->cell_phone = $request->cell_phone;
            $customer->email = $request->email;
            $customer->save();
            $property[] = $request->property;
            $customer->properties()->attach($property);           
            return response()->json($customer);            
        }
        
    }

    public function buscadorCustomer(Request $request)
    {
        $term = $request->term; //jquery
        $data = Customer::where('cell_phone','=',$term)->take(1)->get();
        $results=array();
        foreach ($data as $key => $v) {
            $results[]=['id'=>$v->id,'first_name'=>$v->first_name,'last_name'=>$v->last_name,'phone'=>$v->phone,'cell_phone'=>$v->cell_phone,'email'=>$v->email,'result'=>'Encontrado'];
        }
        if(!$results){
            $results[]=['result'=>'No Encontrado'];
        }
        return response()->json($results);
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
