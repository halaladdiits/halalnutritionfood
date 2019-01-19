@extends('layouts.v2.master')

@section('title', 'Profile')

<!--@section('css')
    @parent
@endsection-->

@section('body')
    <div class="container">
        <div class="row">
            <!--<div class="col-md-12">-->
            <!--    @include('flash::message')-->
            <!--    <h1>Profile</h1>-->
            <!--    <hr>-->
            <!--</div>-->
            <h1>Profile</h1>
        </div>
        
        
        
        <div class="row">
        	Jumlah entry total : {{ $totalEntry }}</br>
        	Jumlah entry terverifikasi : {{ $entryVerified }}</br>
        	Jumlah entry yang sudah diklaim : {{ $totalClaimed }}</br>
        	<!--
        	Saldo yang sudah diklaim : Rp {{ $totalClaimed * 500 }}</br>
        	Saldo tersedia : Rp {{ $entryVerified * 500 }} <br/>
        	Untuk proses redeem Saldo dapat dilakukan setelah mencapai 40 produk terverifikasi, pastikan produk yang Anda submit tidak ada dalam daftar produk yang sudah ada. Reedem dapat dilakukan dengan menghubungi email <a href="mailto:halaladdiits@gmail.com">halaladdiits@gmail.com</a>
        	-->
        	<hr>
            <div class="col-md-12">
                <div class="table-responsive">
                @if(Auth::check() && Auth::user()->roles[0]->name == "administrator")
                <table class="table table-striped table-bordered table-hover" id="foodProduct-tableAdminUser">
                @else
                <table class="table table-striped table-bordered table-hover" id="foodProduct-tableAdminUser">
                @endif
                    <thead>
                        <tr>
                            <th>Food Number</th>
                            <th>Food Name</th>
                            <th>Food Manufacture</th>
                            @if(Auth::check() && Auth::user()->roles[0]->name == "administrator")
                                <th>Verify</th>
                            @else
                            	<th>Verify</th>
                            @endif
                        </tr>
                    </thead>
                </table>
                </div>
            </div>
        </div>
    </div>
    <br><br><br><br><br><br>
@endsection

@section('js')
    @parent
@endsection
