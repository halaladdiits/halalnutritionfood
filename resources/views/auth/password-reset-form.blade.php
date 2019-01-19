@extends('layouts.main')

@section('head')
    {!! HTML::style('/assets/css/reset-form.css') !!}
@stop

@section('content')

        {!! Form::open(['url' => route('auth.reset-post', ['token' => $token ]), 'class' => 'form-signin' ] ) !!}

        @include('includes.errors')

        <h2 class="form-signin-heading">Set New Password</h2>


        <label for="inputPassword" class="sr-only">Password</label>
        {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Password', 'required',  'id' => 'inputPassword', 'autofocus' ]) !!}


        <label for="inputPasswordConfirmation" class="sr-only">Password Confirmation</label>
        {!! Form::password('password_confirmation', ['class' => 'form-control', 'placeholder' => 'Password confirmation', 'required',  'id' => 'inputPasswordConfirmation' ]) !!}


        <button class="btn btn-lg btn-primary btn-block" type="submit">Change</button>

        {!! Form::close() !!}

@stop