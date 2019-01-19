@extends('layouts.v2.master',['nosignin' => true])

@section('css')
    @parent
@endsection

@section('body')

        {!! Form::open(['url' => route('auth.login-post'), 'class' => 'form-signin', 'data-parsley-validate' ] ) !!}
        @include('includes.status')
        <h2 class="form-signin-heading">Please sign in</h2>

        <label for="inputEmail" class="sr-only">Email address</label>
        {!! Form::email('email', null, [
            'class' => 'form-control',
            'placeholder' => 'Email address',
            'required',
            'id' => 'inputEmail',
            'data-parsley-required-message' => 'Email is required',
            'data-parsley-trigger' => 'change focusout',
            'data-parsley-type' => 'email'
        ]) !!}

        <label for="inputPassword" class="sr-only">Password</label>
        {!! Form::password('password', [
            'class' => 'form-control',
            'placeholder' => 'Password',
            'required',
            'id' => 'inputPassword',
            'data-parsley-required-message' => 'Password is required',
            'data-parsley-trigger' => 'change focusout',
            'data-parsley-minlength' => '6',
            'data-parsley-maxlength' => '20'
        ]) !!}

        <div class="checkbox">
            <label>
                {!! Form::checkbox('remember', 1) !!} Remember me
            </label>
        </div>
        <button class="btn btn-lg btn-primary btn-block login-btn" type="submit">Sign in</button>
        <!-- <p><a href="{{ route('auth.password') }}">Forgot password?</a></p> -->

        <p class="or-social">Or Use Social Login</p>

        <!--<a href="{{ route('social.redirect', ['provider' => 'facebook']) }}" class="btn btn-lg btn-primary btn-block facebook" type="submit">Facebook</a>-->
        <!--<a href="{{ route('social.redirect', ['provider' => 'twitter']) }}" class="btn btn-lg btn-primary btn-block twitter" type="submit">Twitter</a>-->
        <a href="{{ route('social.redirect', ['provider' => 'google']) }}" class="btn btn-lg btn-primary btn-block google" type="submit">Google</a>

        {!! Form::close() !!}

@endsection

@section('js')
    @parent
@endsection
