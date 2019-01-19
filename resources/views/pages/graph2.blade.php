@extends('layouts.v1.master')

@section('title', 'Graph Partitioning Result | Halal Nutrition Food')

@section('css')
    @parent
@endsection

@section('body')
	<div class="container">
    <h2>Graph Partitioning Result</h2>
	<div id="mySidenav" class="sidenav">
		  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
		  <h4>Description</h4>
		  <p>There are 311.659 (from 389.145) food products dan 37.864 (from 222.024) ingredients graph (349.523 nodes dan 2.081.821 edges) partitioned using METIS Graph Partitioning. Then visualized in a pie chart.</p>
		<p>This visualization does not indicate the halal or haram status of products, but this visualization shows the food products/ingredients clusters, cluster name and the number of members of each cluster resulting from graph partitioning</p>
		</div>
			<script>
			function openNav() {
    			document.getElementById("mySidenav").style.width = "250px";
			}
			function closeNav() {
			    document.getElementById("mySidenav").style.width = "0";
			}
			</script>
		
    <span onclick="openNav()"><button style="background-color: #4CAF50;  color: white; padding: 10px 30px;">Description</button></span>
	
	<script src="https://www.amcharts.com/lib/3/amcharts.js"></script>
	<script src="https://www.amcharts.com/lib/3/pie.js"></script>
	<script src="https://www.amcharts.com/lib/3/themes/light.js"></script>
	<script src="https://www.amcharts.com/lib/3/plugins/dataloader/dataloader.min.js"></script>
	<div id="chartdiv"></div>	
	<script type="text/javascript">
	
	AmCharts.loadFile( "graphvis/graphvis2/hasilgppie.csv", {}, function( response ) {
	var data = AmCharts.parseCSV( response, {
	    "useColumnNames": true
	} );
	console.log(data);
	
	var chart = AmCharts.makeChart("chartdiv", {
		"type": "pie",
		"startDuration": 0,
		"theme": "light",
		"addClassNames": true,
		// "legend":{
	 //  		"position":"right",
	 //   	"marginRight":100,
	 //   	"autoMargins":false
		// },
		"innerRadius": "30%",
		"defs": {
	    	"filter": [{
	    	"id": "shadow",
	    	"width": "200%",
	    	"height": "200%",
	    	"feOffset": {
	        	"result": "offOut",
	        	"in": "SourceAlpha",
	        	"dx": 0,
	        	"dy": 0
	    	},
	    	"feGaussianBlur": {
	        	"result": "blurOut",
	        	"in": "offOut",
	        	"stdDeviation": 5
	    	},
	    	"feBlend": {
	        	"in": "SourceGraphic",
	        	"in2": "blurOut",
	        	"mode": "normal"
	    	}
	    	}]
		},
		"dataProvider": data,
		"valueField": "jumlahanggota",
		"titleField": "cluster",
		"export": {
	    	"enabled": true
		}
	});
	
	chart.addListener("init", handleInit);
	
	chart.addListener("rollOverSlice", function(e) {
	  handleRollOver(e);
	});
	
	function handleInit(){
	  chart.legend.addListener("rollOverItem", handleRollOver);
	}
	
	function handleRollOver(e){
	  var wedge = e.dataItem.wedge.node;
	  wedge.parentNode.appendChild(wedge);
	}
	});
	</script>
	
	<table id="example" class="display" style="width:100%">
        <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Cluster</th>
                
            </tr>
        </thead>
        <!--<tfoot>-->
        <!--    <tr>-->
        <!--        <th>Id</th>-->
        <!--        <th>Name</th>-->
        <!--        <th>Cluster</th>-->
                
        <!--    </tr>-->
        <!--</tfoot>-->
    </table>
	
	</div>
	
	
@endsection

@section('js')
	@parent
<script>
	$.fn.dataTable.pipeline = function ( opts ) {
    // Configuration options
    var conf = $.extend( {
        pages: 5,     // number of pages to cache
        url: '',      // script url
        data: null,   // function or object with parameters to send to the server
                      // matching how `ajax.data` works in DataTables
        method: 'GET' // Ajax HTTP method
    }, opts );
 
    // Private variables for storing the cache
    var cacheLower = -1;
    var cacheUpper = null;
    var cacheLastRequest = null;
    var cacheLastJson = null;
 
    return function ( request, drawCallback, settings ) {
        var ajax          = false;
        var requestStart  = request.start;
        var drawStart     = request.start;
        var requestLength = request.length;
        var requestEnd    = requestStart + requestLength;
         
        if ( settings.clearCache ) {
            // API requested that the cache be cleared
            ajax = true;
            settings.clearCache = false;
        }
        else if ( cacheLower < 0 || requestStart < cacheLower || requestEnd > cacheUpper ) {
            // outside cached data - need to make a request
            ajax = true;
        }
        else if ( JSON.stringify( request.order )   !== JSON.stringify( cacheLastRequest.order ) ||
                  JSON.stringify( request.columns ) !== JSON.stringify( cacheLastRequest.columns ) ||
                  JSON.stringify( request.search )  !== JSON.stringify( cacheLastRequest.search )
        ) {
            // properties changed (ordering, columns, searching)
            ajax = true;
        }
         
        // Store the request for checking next time around
        cacheLastRequest = $.extend( true, {}, request );
 
        if ( ajax ) {
            // Need data from the server
            if ( requestStart < cacheLower ) {
                requestStart = requestStart - (requestLength*(conf.pages-1));
 
                if ( requestStart < 0 ) {
                    requestStart = 0;
                }
            }
             
            cacheLower = requestStart;
            cacheUpper = requestStart + (requestLength * conf.pages);
 
            request.start = requestStart;
            request.length = requestLength*conf.pages;
 
            // Provide the same `data` options as DataTables.
            if ( typeof conf.data === 'function' ) {
                // As a function it is executed with the data object as an arg
                // for manipulation. If an object is returned, it is used as the
                // data object to submit
                var d = conf.data( request );
                if ( d ) {
                    $.extend( request, d );
                }
            }
            else if ( $.isPlainObject( conf.data ) ) {
                // As an object, the data given extends the default
                $.extend( request, conf.data );
            }
 
            settings.jqXHR = $.ajax( {
                "type":     conf.method,
                "url":      conf.url,
                "data":     request,
                "dataType": "json",
                "cache":    false,
                "success":  function ( json ) {
                    cacheLastJson = $.extend(true, {}, json);
 
                    if ( cacheLower != drawStart ) {
                        json.data.splice( 0, drawStart-cacheLower );
                    }
                    if ( requestLength >= -1 ) {
                        json.data.splice( requestLength, json.data.length );
                    }
                     
                    drawCallback( json );
                }
            } );
        }
        else {
            json = $.extend( true, {}, cacheLastJson );
            json.draw = request.draw; // Update the echo for each response
            json.data.splice( 0, requestStart-cacheLower );
            json.data.splice( requestLength, json.data.length );
 
            drawCallback(json);
        }
    }
};
 
// Register an API method that will empty the pipelined data, forcing an Ajax
// fetch on the next draw (i.e. `table.clearPipeline().draw()`)
$.fn.dataTable.Api.register( 'clearPipeline()', function () {
    return this.iterator( 'table', function ( settings ) {
        settings.clearCache = true;
    } );
} );
 
 
//
// DataTables initialisation
//
$(document).ready(function() {
    $('#example').DataTable( {
        "processing": true,
        "serverSide": true,
        "ajax": $.fn.dataTable.pipeline( {
            url: 'graphvis/graphvis2/ajax-cachepage.php',
            pages: 2 // number of pages to cache
        } )
    } );
} );
</script>
@endsection