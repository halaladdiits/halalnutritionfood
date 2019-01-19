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
        
        @if (isset($resultset) && isset($resultMessage)) 
        <br>
       
        <p>{{ $resultMessage }}</p>
        <hr />
            @if (count($resultset))
                @foreach ($resultset as $doc)
                
                @if (isset($doc['atribute']['foodproductId']))
			        <a href="{{ url('foodproduct', ['id' => $doc['atribute']['foodproductId']]) }}"><h3>@if(isset($doc['label'])) {{ $doc['label'] }} @endif</h3></a>
			    @elseif (isset($doc['atribute']['rank']))
			    	<a href="{{ url('additive', ['id' => $doc['atribute']['rank']]) }}"><h3>@if(isset($doc['label'])) {{ $doc['label'] }} @endif</h3></a>
			    
			    @endif
			    
                @if($doc['score'] != 0)
                <small class="pull-right">relevance score : <strong>{{ $doc['score'] }}</strong></small>
                @endif
                
                @if (isset($doc['atribute']['containsIngredient']))
			        {{ $doc['atribute']['containsIngredient'] }}
			    @else
			    	@if(isset($doc['atribute']['label'])) {{ $doc['atribute']['label'] }} @endif
			    
			    @endif
			    <br/>
			    @if($doc['score'] != 0)
			    <small>Score statistics : {{ $doc['statsScore'] }}</small>
			    @endif
                
                <p></p>
                <hr/>
                @endforeach
            @else
                <h3>Maaf hasil pencarian tidak ditemukan.</h3>
               
            @endif
        @endif
        
 
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        </div>
    </div>
    
    
</div>




@endsection 