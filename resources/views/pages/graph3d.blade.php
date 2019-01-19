@extends('layouts.v1.master')

@section('title', 'Top 50 Haram Food Products | Halal Nutrition Food')

@section('css')
    @parent
@endsection

@section('body')
    <!--<div class="container">-->
    	<div id="mySidenav" class="sidenav">
		  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
		  <h4>Hints</h4>
		  <img src="graphvis/img/oldblue.jpg">= Food Product<br>
		  <img src="graphvis/img/youngblue.jpg">= Ingredient<br>
		  <img src="graphvis/img/red.jpg">= Haram Ingredient<br>
		  <!--<img src="graphvis/img/redline.jpg">= Connector form Food Product to Haram Ingredient</style>-->
		  <p>Scroll or double-click to zoom<br>Hover to show nodes name<br>Click a node to show connected nodes</p>
			<p>This graph visualization obtained from top 50 haram food products with the most ingredients. There are 389.145 food products in the database. This visualization only shows haram products. Haram Products indicated by contained ingredients like pork, alcohol and the other names of them.</p>
		</div>
			<script>
			function openNav() {
    			document.getElementById("mySidenav").style.width = "250px";
			}
			function closeNav() {
			    document.getElementById("mySidenav").style.width = "0";
			}
			</script>
        <div id="d3_selectable_force_directed_graph" style="width: 1226px; height: 550px; margin: auto;">
    		<img src="graphvis/img/green.jpg">= Food Product</img>&emsp;
		<img src="graphvis/img/blue.jpg">= Ingredient</img>&emsp;
		<img src="graphvis/img/red.jpg">= Haram Ingredient</img>
		&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
		Show : <select onchange="window.location=this.options[this.selectedIndex].value">
			  <option value="">40</option>
			  <option value="http://halal.addi.is.its.ac.id/graph3a">10</option>
			  <option value="http://halal.addi.is.its.ac.id/graph3b">20</option>
			  <option value="http://halal.addi.is.its.ac.id/graph3c">30</option>
			  <option value="http://halal.addi.is.its.ac.id/graph3">50</option>
		</select> Products&emsp;&emsp;&emsp;
		<span onclick="openNav()"><button style="background-color: #4CAF50;  color: white; padding: 10px 30px;">Show Hints</button></span>
    		<svg />
    	</div>
@endsection

@section('js')
	@parent
<script>
var svg = d3.select('#d3_selectable_force_directed_graph');

    d3.json('graphvis/graphvis3/graphvis3d.json', function(error, graph) {
        if (!error) {
            //console.log('graph', graph);
            createV4SelectableForceDirectedGraph(svg, graph);
        } else {
            console.error(error);
        }
    });
</script>
@endsection