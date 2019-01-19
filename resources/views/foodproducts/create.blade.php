@extends('layouts.v2.master')

@section('title', 'Submit Food Product')

@section('css')
    @parent
@endsection

@section('body')
    <div class="container" ng-app="validationApp">
        <div class="row">
            <div class="col-md-12">
                <h1 class="page-header">Submit Food Product</h1>
            </div>
        </div>
        <div class="row" ng-controller="foodProductValidate">
            {!! Form::open(['route' => 'foodproduct.store', 'name'=>'foodForm', 'id' => 'foodProductForm', 'data-parsley-validate', 'data-parsley-excluded'=>'input[type=number]']) !!}
            @include('includes.errors')
            @include('foodproducts/form', ['SubmitButtonText' => 'Add Food Product'])
            {!! Form::close() !!}
        </div>
    </div>
    <br><br><br><br><br><br>
@endsection

@section('js')
    @parent
@endsection
