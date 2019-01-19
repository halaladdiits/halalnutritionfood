@extends('layouts.v2.master')

@section('title', 'Welcome To Halal Nutrition Food')

@section('css')
    @parent
@endsection

@section('body')
    <div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>SPARQLer - An RDF Query Endpoint</h1>
        </div>
    </div>
    <div class="row">
        {!! Form::open(['method' => 'api.sparql']) !!}
        <div class="col-md-8">
            <div class="form-group">
                <label for="query">Insert Query Here</label>
                {!! Form::textarea('query', null, [
                    'class' => 'form-control',
                    'id' => 'query',
                    'placeholder' => 'Enter query here',
                    'rows' => '10', 'cols' => '3',
                ]) !!}
            </div>
            <div class="form-group">
                <p> <label for="output">Output</label> {!! Form::select('output', ['JSON'=>'JSON','XML'=>'XML','Text'=>'Text','CSV'=>'CSV','TSV'=>'TSV'], ['class' => 'form-control'] ) !!} </p>
            </div>
        </div>
        <div class="col-md-4">
            <h4>Example</h4>
            <ul>
                <li>
                    <a href="#" id="classes">HNF Linked Data Classes</a></br>
                    <p>Retrieve the list of distinct classes in HNF RDF.</p>
                </li>
                <li>
                    <a href="#" id="predicates">HNF Linked Data Predicates</a></br>
                    <p>Retrieve the list of distinct predicates in HNF RDF.</p>
                </li>
                <li>
                    <a href="#" id="product">Food Product Details</a></br>
                    <p>The food ingredient of Indomie and their labels.</p>
                </li>
                <li>
                    <a href="#" id="additive">Additive Details</a></br>
                    <p>The additive details and combine information on DBpedia.</p>
                </li>
            </ul>
        </div>
        </div>
        {!! Form::submit('Submit Query', ['class' => 'btn btn-primary pull-right']) !!}
        {!! Form::close() !!}
        </div>
    </div>
@endsection

@section('js')
    @parent
    <script>
        function enableTab(id) {
            var el = document.getElementById(id);
            el.onkeydown = function(e) {
                if (e.keyCode === 9) { // tab was pressed

                    // get caret position/selection
                    var val = this.value,
                        start = this.selectionStart,
                        end = this.selectionEnd;

                    // set textarea value to: text before caret + tab + text after caret
                    this.value = val.substring(0, start) + '\t' + val.substring(end);

                    // put caret at right position again
                    this.selectionStart = this.selectionEnd = start + 1;

                    // prevent the focus lose
                    return false;

                }
            };
        }

        $(document).ready(function(){
            enableTab('query');
            $("#classes").click(function(){
                $("#query").empty();
                $("#query").append("SELECT DISTINCT ?class \nWHERE { [] a ?class . } \nORDER BY ?class");
            });
            $("#predicates").click(function(){
                $("#query").empty();
                $("#query").append("SELECT DISTINCT ?p \nWHERE { ?s ?p ?o . } \nORDER BY ?p ");
            });
            $("#product").click(function(){
                $("#query").empty();
                $("#query").append("PREFIX halalv: {{ urldecode("%3C") }}http://halalnutritionfood.com/halalv.ttl#{{ urldecode("%3E") }}\nSELECT DISTINCT ?product ?ingredient \nWHERE { ?produk a halalv:FoodProduct; \n\t halalv:containsIngredient ?ingredient. } \nORDER BY ?product ");
            });
            $("#additive").click(function(){
                $("#query").empty();
                $("#query").append("PREFIX halalv: {{ urldecode("%3C") }}http://halalnutritionfood.com/halalv.ttl#{{ urldecode("%3E") }}\nPREFIX owl: {{ urldecode("%3C") }}http://www.w3.org/2002/07/owl#{{ urldecode("%3E") }}\nPREFIX dbo: {{ urldecode("%3C") }}http://dbpedia.org/ontology/{{ urldecode("%3E") }}\nSELECT ?resource ?abstract { \n\t?resource a halalv:FoodAdditive; \n\t\towl:sameAs ?additive \n\t{ SERVICE {{ urldecode("%3C") }}http://dbpedia.org/sparql{{ urldecode("%3E") }} \n\t\t{ SELECT ?additive ?abstract WHERE { \n\t\t\t?additive dbo:abstract ?abstract. \n\t\t\tFILTER ( lang (?abstract) = \"en\" ) \n\t\t\t} \n\t\t} \n\t} \nLIMIT 100");
            });

        });

    </script>
@endsection
