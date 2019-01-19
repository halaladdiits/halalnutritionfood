@extends('layouts.v2.master')

@section('title', 'Food Product List')

@section('css')
    @parent
@endsection

@section('body')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @include('flash::message')
                <h1>Food Product List</h1>
                <hr>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                @if(Auth::check() && Auth::user()->roles[0]->name == "administrator")
                <table class="table table-striped table-bordered table-hover" id="foodProduct-tableAdmin">
                @else
                <table class="table table-striped table-bordered table-hover" id="foodProduct-table">
                @endif
                    <thead>
                        <tr>
                            <th>Food Number</th>
                            <th>Food Name</th>
                            <th>Food Manufacture</th>
                            @if(Auth::check() && Auth::user()->roles[0]->name == "administrator")
                                <th>Verify</th>
                                <th>Action</th>
                            @endif
                        </tr>
                    </thead>
                </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    @parent
@endsection
