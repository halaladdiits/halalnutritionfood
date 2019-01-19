@extends('layouts.v2.master')

@section('title', 'Halal Nutrition Food | Request RDF Dump')

@section('css')
    @parent
@endsection

@section('body')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="term-node node teaser">
				    <h1>Data</h1>
				    <br>
				    <p>The Halal Food Nutrition database is available under the <a href="https://opendatacommons.org/licenses/odbl/1.0/" target="_blank">Open Database License</a>.</p>
					<p>The individual contents of the database are available under the <a href="https://opendatacommons.org/licenses/dbcl/1.0/" target="_blank">Database Contents License</a>.</p>
					<p>Our dataset is obtained from :</p>
					<ul>
						<li>Inserted by ourselves</li>
						<li>User entries</li>
						<li><a href="http://www.halalmui.org/" target="_blank">Institute For Foods, Drugs, And Cosmetics Indonesian Council  Of Ulama (LPPOM MUI)</a></li>
						<li><a href="http://www.halal.gov.my/" target="_blank">Halal Malaysia Portal</a></li>
					</ul>
					<p>We also integrate our data with <a href="https://www.ncbi.nlm.nih.gov/pubmed/" target="_blank">PUBMED</a>, <a href="https://www.ncbi.nlm.nih.gov/mesh" target="_blank">MESH</a> and <a href="http://wiki.dbpedia.org/" target="_blank">DBPedia</a>.</p>
				    <h3>How to Request RDF Dump?</h3>
				    <p class="summary">
				    	Please kindly send email to halaladdiits@gmail.com to get RDF Dump file. 
				    </p>
				 </div> 
            </div>
        </div>
    </div>
@endsection