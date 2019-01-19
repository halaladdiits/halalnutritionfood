@extends('layouts.v2.master',['nosignin' => true])

@section('css')
    @parent
@endsection

@section('body')

    {!! Form::open(['url' => route('auth.register-post'), 'class' => 'form-signin', 'data-parsley-validate' ] ) !!}

    @include('includes.errors')

    <h2 class="form-signin-heading">Please register</h2>

    <label for="inputEmail" class="sr-only">Email address</label>
    {!! Form::email('email', null, [
        'class'                         => 'form-control',
        'placeholder'                   => 'Email address',
        'required',
        'id'                            => 'inputEmail',
        'data-parsley-required-message' => 'Email is required',
        'data-parsley-trigger'          => 'change focusout',
        'data-parsley-type'             => 'email'
    ]) !!}

    <label for="inputFirstName" class="sr-only">First name</label>
    {!! Form::text('first_name', null, [
        'class'                         => 'form-control',
        'placeholder'                   => 'First name',
        'required',
        'id'                            => 'inputFirstName',
        'data-parsley-required-message' => 'First Name is required',
        'data-parsley-trigger'          => 'change focusout',
        'data-parsley-pattern'          => '/^[a-zA-Z]*$/',
        'data-parsley-minlength'        => '2',
        'data-parsley-maxlength'        => '32'
    ]) !!}

    <label for="inputLastName" class="sr-only">Last name</label>
    {!! Form::text('last_name', null, [
        'class'                         => 'form-control',
        'placeholder'                   => 'Last name',
        'required',
        'id'                            => 'inputLastName',
        'data-parsley-required-message' => 'Last Name is required',
        'data-parsley-trigger'          => 'change focusout',
        'data-parsley-pattern'          => '/^[a-zA-Z]*$/',
        'data-parsley-minlength'        => '2',
        'data-parsley-maxlength'        => '32'
    ]) !!}


    <label for="inputPassword" class="sr-only">Password</label>
    {!! Form::password('password', [
        'class'                         => 'form-control',
        'placeholder'                   => 'Password',
        'required',
        'id'                            => 'inputPassword',
        'data-parsley-required-message' => 'Password is required',
        'data-parsley-trigger'          => 'change focusout',
        'data-parsley-minlength'        => '6',
        'data-parsley-maxlength'        => '20'
    ]) !!}


    <label for="inputPasswordConfirm" class="sr-only has-warning">Confirm Password</label>
    {!! Form::password('password_confirmation', [
        'class'                         => 'form-control',
        'placeholder'                   => 'Password confirmation',
        'required',
        'id'                            => 'inputPasswordConfirm',
        'data-parsley-required-message' => 'Password confirmation is required',
        'data-parsley-trigger'          => 'change focusout',
        'data-parsley-equalto'          => '#inputPassword',
        'data-parsley-equalto-message'  => 'Not same as Password',
    ]) !!}

    <div class="g-recaptcha" data-sitekey="{{ env('RE_CAP_SITE') }}"></div>

    <button class="btn btn-lg btn-primary btn-block register-btn" type="submit">Register</button>

    <p class="or-social">Or Use Social Login</p>

    <!--<a href="{{ route('social.redirect', ['provider' => 'facebook']) }}" class="btn btn-lg btn-primary btn-block facebook" type="submit">Facebook</a>-->
    <!--<a href="{{ route('social.redirect', ['provider' => 'twitter']) }}" class="btn btn-lg btn-primary btn-block twitter" type="submit">Twitter</a>-->
    <a href="{{ route('social.redirect', ['provider' => 'google']) }}" class="btn btn-lg btn-primary btn-block google" type="submit">Google</a>

    {!! Form::close() !!}
<br><br><br><br><br><br>
@endsection

@section('js')
    @parent
    <script src='https://www.google.com/recaptcha/api.js'></script>
@endsection
