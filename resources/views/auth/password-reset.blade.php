@extends('layouts.main')

@section('head')
    {!! HTML::style('/assets/css/reset.css') !!}
@stop

@section('content')

        {!! Form::open(['url' => route('auth.password-post'), 'class' => 'form-signin' ] ) !!}

        @include('includes.status')

        <h2 class="form-signin-heading">Password Reset</h2>
        <label for="inputEmail" class="sr-only">Email address</label>
        {!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'Email address', 'required', 'autofocus', 'id' => 'inputEmail' ]) !!}

        <br />
        <button class="btn btn-lg btn-primary btn-block" type="submit">Send me a reset link</button>

        {!! Form::close() !!}

@stop