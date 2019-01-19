@extends('layouts.v1.master')

@section('title', 'Welcome To Halal Nutrition Food')

@section('css')
    @parent
@endsection

@section('body')
    <div class="jumbotron">
        <div class="container">
            <h1>Halal nutrition food</h1>
            <p>Halal nutrition food is a website that give information halal certification and nutrition of a food product</p>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel with-nav-pills panel-primary">
                    <div class="panel-heading">
                        <ul class="nav nav-pills">
                            <li class="active"><a href="#foodproduct" data-toggle="tab">Food Product</a></li>
                            <li><a href="#additive" data-toggle="tab">Food Additive</a></li>
                            {{--<li><a href="#manufacture" data-toggle="tab">Food Manufacture</a></li>--}}
                        </ul>
                    </div>
                    <div class="panel-body">
                        <div class="tab-content">
                            <div class="tab-pane fade in active" id="foodproduct">
                                <form class="" role="search">
                                    <div class="form-group">
                                        <select name="foodProduct" class="form-control productName"></select>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane fade" id="additive">
                                <form class="" role="search">
                                    <div class="form-group">
                                        <select name="additive" class="form-control additive"></select>
                                    </div>
                                </form>
                            </div>
                            {{--<div class="tab-pane fade" id="manufacture">--}}
                                {{--<form class="" role="search">--}}
                                    {{--<div class="form-group">--}}
                                        {{--<input type="text" class="form-control" placeholder="Search by Food Manufacture">--}}
                                    {{--</div>--}}
                                {{--</form>--}}
                            {{--</div>--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <h1>What is Halal</h1>
                <p>Halal simply means permitted or lawful. So when we are talking about halal foods it means any foods that are allowed to be eaten according to Islamic Sharia law.</p>
                <p>There is some verse that explain how moeslem must eat halal food. "O mankind, eat from whatever is on earth [that is] lawful and good." Al-Baqarah[2:168]
                "Those who follow the Messenger, the unlettered prophet, whom they find written in what they have of the Torah and the Gospel, who enjoins upon them what is right and forbids them what is wrong and makes lawful for them the good things and prohibits for them the evil" Al-A'raf[7:157]</p>
            </div>
        </div>
    </div>
@endsection

@section('js')
    @parent
@endsection
