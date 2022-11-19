<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Clandestino Bar School</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->
        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
    <body class="antialiased">
        <div class="relative flex items-top justify-center min-h-screen bg-amber-400 dark:bg-gradient-to-b from-amber-500 to-orange-700 sm:items-center py-4 sm:pt-0">

            <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 px-4">
                <div class="flex pb-8 justify-center sm:justify-start sm:pt-0 w-auto">
                    <img src="../logo.jpg" alt="logo clandestino" class="rounded-full w-1/3 ">
                </div>
                
                <h1 class="flex justify-center pt-8 sm:justify-start sm:pt-0 text-3xl text-white" >Clandestino Bar School</h1>
                <p class="flex justify-center pt-8 sm:justify-start sm:pt-0 text-md text-white">
                    A primeira e única escola de bartender com bar secreto do Morro de São Paulo...
                </p>

                <div class="mt-8 p-4 bg-white bg-gray-800 dark:bg-gray-800 overflow-hidden shadow rounded-lg text-gray-100">
                    <p>Seu Ticket na Lista do Dia {{$booking->date}}</p>
                    <div class="flex gap-4">
                        <div class="flex flex-col w-full">
                            <h1>Nome: {{$client->name}} {{$client->lastname}}</h1>
                            <h1>Ticket: {{$client->ticket}}</h1>
                            <h1>Processo: {{$client->status_client}}</h1>
                            <h1>Senha: ND</h1>
                        </div>
                        <div class="flex flex-col w-1/2 bg-gray-300 ">
                        {!! QrCode::size(120)->generate(route('client.show',[$client->id])) !!}
                        </div>
                    </div>
                </div>

                <div class="flex justify-center mt-4 sm:items-center sm:justify-between text-gray-600 dark:text-gray-100">
                    <div class="text-center text-sm sm:text-left">
                        <div class="flex items-center">
                            <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="ml-4 -mt-px w-5 h-5 ">
                                <path d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                            </svg>

                            <a href="https://www.instagram.com/clandestino.msp/" class="ml-1 underline">
                                Intagram
                            </a>
                        </div>
                    </div>

                    <div class="ml-4 text-center text-sm sm:text-right sm:ml-0">
                        <a href="{{route('client.create')}}" class="ml-1 underline">
                            Novo Cadastro
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </body>
    <script src="https://cdn.tailwindcss.com"></script>
</html>
