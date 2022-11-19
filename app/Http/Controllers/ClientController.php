<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Booking;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('client.full');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('client.create');
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
        // Tamanho de las listas por dia.
        $min = 1;
        $max = 5;
        $fullBooking = ($max-$min)+1;
        if (Booking::where('status_booking', '=', 1)->exists() && Booking::where('status_booking', '=', 1)->count() > 1) {
                echo("desculpe temos un problema interno! Contacte com nosso soporte no Instagram");
            } else{
            $dayBooking = Booking::where('status_booking', '=', 1)->first();
            // Encontrar os tickets assignados diferente os ja cadastrados 

            if ($dayBooking->clients()->count() < $fullBooking) {
                do {
                    $ticket = mt_rand($min,$max);
                    } 
                //Enquanto a quantidade de clientes seja menor a da lista completa e o numero de ticket exista cria um novo numero. 
                // $dayBooking->clients()->where('ticket', $ticket)->exists() == true
                while ( $dayBooking->clients()->count() < $fullBooking && $dayBooking->clients()->where('ticket', $ticket)->exists() == true );

                // ticket novo criado, busca uma lista ativa para cadastrar o cliente 
                $activeBooking = Booking::where('status_booking', '=', 1)->first();
                
                // cria client novo
                $client = Client::create([
                    'name' => $request->name,
                    'lastname' => $request-> lastname,
                    'status_client' => 'Listado',
                    'ticket' => $ticket
                ]);

                //relaciona cliente com a lista ativa
                $client->bookings()->attach($activeBooking->id);

                //Mostra o ticket de entrada do cliente
                return redirect()->route('client.show', ['client' => $client->id]);

            }else {
                // A lista ativa esta cheia
                return view('client.full');
            }
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        //
        $booking = $client->bookings()->where('status_booking', '=', 1)->first();
        
        return view('client.show')->with(['client'=> $client, 'booking' => $booking]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
        //
        // dd($client);
        return view('client.edit')->with(['client'=> $client]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Client $client)
    {
        //editar cliente na lista ativa
        $client->name = $request->input('name');
        $client->lastname = $request->input('lastname');
        $client->update();

        //Mostra o ticket de entrada do cliente
        return redirect()->route('client.show', ['client' => $client->id]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        //eliminar registro
        $client->destroy($client->id);
        return view('client.create');

    }
}