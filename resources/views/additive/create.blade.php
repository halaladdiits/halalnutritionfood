@extends('layouts.v2.master')

@section('title', 'Submit Food Additive')

@section('css')
    @parent
@endsection

@section('body')
    <div class="container">
        <div class="row">
            <h1 class="page-header">Submit Food Additive</h1>
        </div>
        <div class="row">
            {!! Form::open(['route' => 'additive.store', 'id' => 'additiveForm', 'data-parsley-validate']) !!}
            @include('includes.errors')
            @include('additive.form', ['SubmitButtonText' => 'Add Food Additive'])
            {!! Form::close() !!}
        </div>
    </div>
    <br><br><br><br><br><br>
@endsection

@section('js')
    @parent
@endsection
