@extends('layouts.v2.master')

@section('title', 'Edit Food Addictive')

@section('css')
    @parent
@endsection

@section('body')
    <div class="container">
        <div class="row">
            <h1 class="page-header">Edit: {!! $additive->iName !!}</h1>
        </div>
        <div class="row">
            {!! Form::model($additive, ['method' => 'PATCH', 'route' => ['additive.update', $additive->id], 'id' => 'additiveForm', 'data-parsley-validate']) !!}
            @include('includes.errors')
            @include('additive.form', ['SubmitButtonText' => 'Edit Food Additive'])
            {!! Form::hidden('fVerify', 0) !!}
            {!! Form::close() !!}
        </div>
    </div>
    <br><br><br><br><br><br>
@endsection

@section('js')
    @parent
@endsection


