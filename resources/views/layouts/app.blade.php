<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" >
@yield('css')
<style>
    a{
        text-decoration: none;
    }
</style>




    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Content -->
            <main>
                {{ $slot }}
                <div class="container mt-2">
                  @if(session()->has('success'))
                    <div class="alert alert-success">
                      {{ session()->get('success') }}
                    </div>
                  @endif
                  @if(session()->has('error'))
                    <div class="alert alert-danger">
                      {{ session()->get('error') }}
                    </div>
                  @endif

                  @yield('content')
                </div>
               
            </main>
        </div>

<script src="{{ asset('js/app.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
@yield('scripts')


 


    </body>
</html>
