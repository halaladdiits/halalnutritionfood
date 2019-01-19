<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" type="image/png" href="{{ asset('img/favicon.png') }}" />

    <!-- CSRF Token -->
    <meta name="_token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Styles -->
    <link rel="shortcut icon" href="halalnutritionfood.png">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/v2/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/datatables.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/nutrition-label/nutritionLabel.css') }}" rel="stylesheet">
    <link href="{{ asset('css/v2/custom.css') }}" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
	<link href="{{ asset('css/d3v4-selectable-zoomable-force-directed-graph.css') }}" rel="stylesheet">
</head>

<body>
    @include('layouts.v2.header') 
    
    @yield('body') 
    
    @include('layouts.v2.footer')
    
    @section('js')

            {!! Html::script('https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js') !!}
            {!! Html::script('js/vendor/bootstrap/bootstrap.min.js') !!}
            {!! Html::script('https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.5.5/angular.min.js') !!}
            {!! Html::script('https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.5.5/angular-route.min.js') !!}
            {!! Html::script(asset('vendor/nutrition-label/nutritionLabel-min.js')) !!}
            {!! Html::script('https://cdn.datatables.net/t/bs/dt-1.10.11/datatables.min.js') !!}
            {!! Html::script('js/vendor/select2/select2.min.js') !!}
            {!! Html::script('js/vendor/typeahead-bootstrap/bootstrap-typeahead.min.js') !!}
            {!! Html::script('js/vendor/jquery.inputmask/jquery.inputmask.bundle.min.js') !!}
            {!! Html::script('js/vendor/parsleyjs/parsley.min.js') !!}
            {!! Html::script('js/laroute.js') !!}
            {!! Html::script(elixir('js/plugins.js')) !!}
            {!! Html::script('https://d3js.org/d3.v4.min.js') !!}
            {!! Html::script('js/d3v4-selectable-force-directed-graph.js') !!}
            
        @show
</body>

</html>