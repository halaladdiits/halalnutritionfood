@extends('layouts.v2.master')

@section('title', 'Halal Nutrition Food | Visualization')

@section('css')
    @parent
@endsection

@section('body')
    <div class="container">
        <h1>Visualization</h1>
        <br>
		<p>Choose Visualization :</p>
		<ul>
			<li><a href="http://halal.addi.is.its.ac.id/graph1">Top 50 Food Products with the Most Ingredients Graph Visualization</a></li>
			<li><a href="http://halal.addi.is.its.ac.id/graph2" >Graph Partitioning Result</a></li>
			<li><a href="http://halal.addi.is.its.ac.id/graph3" >Top 50 Haram Food Products Graph Visualization</a></li>
			<li><a href="http://halal.addi.is.its.ac.id/graph4" >Top 50 Food Products that Contain MSG Graph Visualization</a></li>
			<li><a href="http://halal.addi.is.its.ac.id/graph5" >Graph Partitioning Result - Halal Certified Product Only</a></li>
		</ul>
		
	<br>
	<br>
	<br>
	<br>
	<br>
    </div>
@endsection

@section('js')
	@parent

@endsection