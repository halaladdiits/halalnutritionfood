{{--
 Created by Adnan Mauludin Fajriyadi
 "Peningkatan Relevansi Pencarian Produk Halal Dalam Aplikasi Halal Nutrition Food Menggunakan Algoritma OKAPI BM25F"

 April 2017
--}}

@extends('layouts.v2.master') 

@section('title', 'Welcome To Halal Nutrition Food') 

@section('body')
<div class="jumbotron">
    <div class="container">
        <center>
            <h1>Halal Nutrition Food</h1>
        </center>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
        {!! Form::open(array('method' => 'GET')) !!}
        <div class="input-group">
            {!! Form::text('q', Input::get('q'), array('class' => 'form-control input', 'placeholder' => 'Enter your search term')) !!}
            <span class="input-group-btn">
                {!! Form::submit('Search', array('class' => 'btn btn-primary')) !!}            
            </span>
        </div>
        {!! Form::close() !!}
        
        @if (isset($resultset) && isset($debugResult) && isset($s) && isset($handler)) 
        <br>
        <p>Your search took <strong>{{ $s }} seconds</strong> and yielded <strong>{{ $resultset->getNumFound() }}</strong> result(s) <span class="pull-right"><a href="{{ url('/') }}/json/?q={{ $debugResult->getQueryString() }}" target="_blank">raw output</a> - <a href="{{ url('/') }}:8983/solr/halal/{{ $handler }}/?q={{ $debugResult->getQueryString() }}&debugQuery=true" target="_blank">solr json</a></span></p>
        <hr />
            @if (count($resultset))
                @foreach ($resultset as $doc)
                <a href="{{ url('foodproduct', ['id' => $doc->id]) }}"><h3>{{ implode(', ', (array)$doc->food_name) }} ({{ implode(', ', (array)$doc->food_code) }})</h3></a>
                <small>{{ implode(', ', (array)$doc->food_man) }}</small><small class="pull-right">relevance score : <strong>{{ $doc->score }}</strong></small>
                <p style="margin-top:5px;font-style:italic">{{ implode(', ', (array)$doc->food_ing) }}</p>
                <hr/>
                @endforeach
            @else
                <h3>Maaf hasil pencarian tidak ditemukan.</h3>
                <small>Kata kunci <strong>{{ $debugResult->getQueryString() }}</strong> yang anda cari tidak ada dalam database.</small>
            @endif
        @endif
        <br>
        </div>
    </div>
</div>
@endsection 