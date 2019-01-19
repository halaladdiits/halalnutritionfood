@extends('layouts.v2.master')

@section('title', 'E-Numbers List')

@section('css')
    @parent

@endsection

@section('body')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @include('flash::message')
                <h1>E-Numbers List</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                @if(Auth::check() && Auth::user()->roles[0]->name == "administrator")
                <table class="table table-striped table-bordered table-hover" id="additive-tableAdmin">
                @else
                <table class="table table-striped table-bordered table-hover" id="additive-table">
                @endif
                    <thead>
                    <tr>
                        <th>E-Number</th>
                        <th>Name</th>
                        @if(Auth::check() && Auth::user()->roles[0]->name == "administrator")
                        <th>Action</th>
                        @endif
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('js')
    @parent
    <script type="text/javascript">

    </script>
@endsection
