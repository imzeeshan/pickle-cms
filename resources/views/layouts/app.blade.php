<!doctype html>
<!--
* Tabler - Premium and Open Source dashboard template with responsive and high quality UI.
* @version 1.0.0-beta19
* @link https://tabler.io
* Copyright 2018-2023 The Tabler Authors
* Copyright 2018-2023 codecalm.net Paweł Kuna
* Licensed under MIT (https://github.com/tabler/tabler/blob/master/LICENSE)
-->
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    @if(isset($site_title))
       <title>{!! $site_title !!}</title>
    @else
       <title>{{ config('app.name', 'Laravel') }}</title>
    @endif

    @if(isset($site_desc))
      <meta name="description" content="{!! $site_desc !!}"/>
    @endif

    <!-- CSS files -->
    <link href="{{ asset('css/tabler.min.css')}}" rel="stylesheet"/>
    <link href="{{ asset('css/tabler-flags.min.css')}}" rel="stylesheet"/>
    <link href="{{ asset('css/tabler-payments.min.css')}}" rel="stylesheet"/>
    <link href="{{ asset('css/tabler-vendors.min.css')}}" rel="stylesheet"/>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">

    <style>
      @import url('https://rsms.me/inter/inter.css');
      :root {
      	--tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
      }
      body {
      	font-feature-settings: "cv03", "cv04", "cv11";
      }
    </style>

  @yield('styles')

  </head>
  <body  class=" layout-fluid">
    <script src="{{ asset('js/demo-theme.min.js')}}"></script>
    <div class="page">
      <!-- Sidebar -->
      @if(Route::currentRouteName() != 'login' && Route::currentRouteName() != 'register')
        @include('layouts.sidebar')
      @endif
      
      <div class="page-wrapper">
        <!-- Page header -->
        @if(Route::currentRouteName() != 'login' && Route::currentRouteName() != 'register')
          @include('layouts.header')
        @endif

        <!-- Page body -->
        <div class="page-body">
          @yield('content')
        </div>

        @include('layouts.footer')
      </div>
    </div>    

    <!-- Tabler Core -->
    <script src="{{ asset('js/tabler.min.js')}}" defer></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    @yield('scripts')
    
  </body>
</html>
