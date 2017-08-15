<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Customer;
use Twilio\Rest\Client;

class SmsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Customer::orderBy('id','DESC')->paginate(15);

        return view('admin.sms.index')->with('customers', $customers);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function send($idcus)
    {
        $customer = Customer::find($idcus);
        
        //dd($customer->first_name);

        $sid = "ACbc6ee0588630552dc61d606365a53a0a"; // Your Account SID from www.twilio.com/console
        $token = "f216d2fd96b4f2ddb9b4877d8a54f900"; // Your Auth Token from www.twilio.com/console
        //dd('hasta aqui');
        $client = new Client($sid, $token);
        
        $message = $client->messages->create(
          '+591'.$customer->cell_phone, // Text this number
          array(
            'from' => '+12349013035', // From a valid Twilio number
            'body' => 'Hola '.$customer->first_name.' Orion B R le da la bienvenida!'            
          )
        );
        dd('Exito');
        //Oqk6bGL5Y7IgZTlIyfQIQn5hFGgvv15JIMhd1Su twilio
        //HnONzr2qSbxoHLTLTEkK5AZbxlvloel6sZ5ju99o

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
