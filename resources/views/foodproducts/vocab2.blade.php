@extends('layouts.v2.master')

@section('title', 'Halal Nutrition Food | Vocabulary')

@section('css')
    @parent
@endsection

@section('body')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
            	<div class="container">
					<h2>Namespace Declarations</h2>
					<br>
					<!--<dt><em>default namespace</em></dt>
					<dd><a href="http://purl.org/foodontology#">http://purl.org/foodontology#</a></dd>-->
					<dt>food</dt>
					<dd><a href="http://purl.org/foodontology#">http://purl.org/foodontology#</a></dd>
					<dt>foodlirm</dt>
					<dd><a href="http://data.lirmm.fr/ontologies/food#">http://data.lirmm.fr/ontologies/food#</a></dd>
					<dt>gr</dt>
					<dd><a href="http://purl.org/goodrelations/v1#">http://purl.org/goodrelations/v1#</a></dd>
					<dt>halalv</dt>
					<dd><a href="http://halal.addi.is.its.ac.id/halalv.ttl#">http://halal.addi.is.its.ac.id/halalv.ttl#</a></dd>
					
					<dt>halalf</dt>
					<dd><a href="http://halal.addi.is.its.ac.id/foodproduct/">http://halal.addi.is.its.ac.id/foodproduct/</a></dd>
					<dt>halali</dt>
					<dd><a href="http://halal.addi.is.its.ac.id/ingredient/">http://halal.addi.is.its.ac.id/ingredient/</a></dd>
					<dt>halalc</dt>
					<dd><a href="http://halal.addi.is.its.ac.id/certificate/">http://halal.addi.is.its.ac.id/certificate/</a></dd>
					<dt>halals</dt>
					<dd><a href="http://halal.addi.is.its.ac.id/source/">http://halal.addi.is.its.ac.id/source/</a></dd>
					
					<dt>owl</dt>
					<dd><a href="http://www.w3.org/2002/07/owl#">http://www.w3.org/2002/07/owl#</a></dd>
					<dt>rdf</dt>
					<dd><a href="http://www.w3.org/1999/02/22-rdf-syntax-ns#">http://www.w3.org/1999/02/22-rdf-syntax-ns#</a></dd>
					<dt>rdfs</dt>
					<dd><a href="http://www.w3.org/2000/01/rdf-schema#">http://www.w3.org/2000/01/rdf-schema#</a></dd>
					<dt>xsd</dt>
					<dd><a href="http://www.w3.org/2001/XMLSchema#">http://www.w3.org/2001/XMLSchema#</a></dd>
					<dt>foaf</dt>
					<dd><a href="http://xmlns.com/foaf/0.1/">http://xmlns.com/foaf/0.1/</a></dd>
					<br><br>
					<h2>Classes: FoodProduct, Ingredient, FoodAdditive, Sources, HalalCertificate</h2>
					<br><br>
					<h2>Class: FoodProduct</h2>
					<div class="panel panel-default">
    					<div class="panel-heading">A manufactured food product</div>
    					<div class="panel-body">
    						<div>
							    <dl>
									<dt>IRI : <a href="http://halal.addi.is.its.ac.id/halalv.ttl#FoodProduct">http://halal.addi.is.its.ac.id/halalv.ttl#FoodProduct</a></dt>
									<dd>superclass: <a href="http://data.lirmm.fr/ontologies/food#FoodProduct">foodlirmm:FoodProduct</a>, <a href="http://purl.org/foodontology#Food">food:Food</a></dd>
								</dl>								
							</div>
							<div>							
							    <h4>Property: halalv:certificate</h4>
							    <p>
							    <span class="term-label"><em>A FoodProduct certificate</em></span>
							    </p>
								<dl>
							    <dt>URI:</dt>
							    <dd><a href="http://halal.addi.is.its.ac.id/halalv.ttl#certificate">http://halal.addi.is.its.ac.id/halalv.ttl#certificate</a></dd>
							    <dt>Domain:</dt>
							    <dd><a href="http://halal.addi.is.its.ac.id/halalv.ttl#FoodProduct">halalv:FoodProduct</a></dd>
								</dl>
							</div>							
    					</div>
					</div>
					<h2>Class: Ingredient</h2>
					<div class="panel panel-default">
    					<div class="panel-heading">An ingredient : a certain quantity of food that is part of another food</div>
    					<div class="panel-body">
							<div>
							    <dl>
									<dt>IRI : <a href="http://halal.addi.is.its.ac.id/halalv.ttl#Ingredient">http://halal.addi.is.its.ac.id/halalv.ttl#Ingredient</a></dt>
									<dd>superclass: <a href="http://data.lirmm.fr/ontologies/food#Ingredient">foodlirmm:Ingredient</a>, <a href="http://purl.org/foodontology#Food">food:Food</a></dd>
								</dl>								
							</div>
							<div>
							    <h4>Property: halalv:halalSource</h4>
							    <p>
							    <span class="term-label"><em>Describe that a food/beverage/ENumbers/food ingedient are allowed to be consumed in Islamic religious.</em></span>
							    </p>
								<dl>
							    <dt>URI:</dt>
							    <dd><a href="http://halal.addi.is.its.ac.id/halalv.ttl#halalSource">http://halal.addi.is.its.ac.id/halalv.ttl#halalSource</a></dd>
							    <dt>Domain:</dt>
							    <dd><a href="http://halal.addi.is.its.ac.id/halalv.ttl#Ingredient">halalv:Ingridient</a></dd>
								<dt>Range:</dt>
							    <dd><a href="http://halal.addi.is.its.ac.id/halalv.ttl#Sources">halalv:Sources</a>, <a href="http://halal.addi.is.its.ac.id/halalv.ttl#Status">halalv:Status</a></dd>
								</dl>
							</div>							
    					</div>
    				</div>
    				<h2>Class: FoodAdditive</h2>
					<div class="panel panel-default">
    					<div class="panel-heading">Food Additive Enumber of Ingredient - Code given to additives that are used for food and beverage products.</div>
    					<div class="panel-body">
    						<div>
							    <dl>
									<dt>IRI : <a href="http://halal.addi.is.its.ac.id/halalv.ttl#FoodAdditive">http://halal.addi.is.its.ac.id/halalv.ttl#FoodAdditive</a></dt>
									<dd>superclass: <a href="http://halal.addi.is.its.ac.id/halalv.ttl#Ingredient">halalv:Ingredient</a></dd>
								</dl>								
							</div>							
    					</div>
    				</div>
    				<h2>Class: Sources</h2>
					<div class="panel panel-default">
    					<div class="panel-heading">Source that conclude E-Number ingredient status.</div>
    					<div class="panel-body">
							<div>
							    <h4>Property: halalv:Estatus</h4>
							    <p>
							    <span class="term-label"><em>A description of the food/beverage/ENumbers/food ingedient status to be consumed in Islamic religious</em></span>
							    </p>
								<dl>
							    <dt>URI:</dt>
							    <dd><a href="http://halal.addi.is.its.ac.id/halalv.ttl#Estatus">http://halal.addi.is.its.ac.id/halalv.ttl#Estatus</a></dd>
							    <dt>Domain:</dt>
							    <dd><a href="https://www.w3.org/2000/01/rdf-schema#Resource">rdfs:Resource</a></dd>
							    <dt>Range:</dt>
							    <dd>
							    	<a href="http://halal.addi.is.its.ac.id/halalv.ttl#halalv:halal">halalv:halal</a>,
							    	<a href="http://halal.addi.is.its.ac.id/halalv.ttl#halalv:mushbooh">halalv:mushbooh</a>,
							    	<a href="http://halal.addi.is.its.ac.id/halalv.ttl#halalv:haram">halalv:haram</a>
							    </dd>
								</dl>
							</div>
							<div>
							    <h4>Property: halalv:OrgSource</h4>
							    <p>
							    <span class="term-label"><em>An organization.</em></span>
							    </p>
								<dl>
							    <dt>URI:</dt>
							    <dd><a href="http://xmlns.com/foaf/0.1/Organization">http://xmlns.com/foaf/0.1/Organization</a></dd>
							    <dt>Domain:</dt>
							    <dd><a href="http://halal.addi.is.its.ac.id/halalv.ttl#Sources">halalv:Sources</a></dd>
							    <dt>Range:</dt>
							    <dd><a href="http://halal.addi.is.its.ac.id/halalv.ttl#Sources">halalv:Sources</a></dd>
								</dl>
							</div>							
    					</div>
    				</div>
    				<h2>Class: HalalCertificate</h2>
					<div class="panel panel-default">
    					<div class="panel-heading">Halal Certificate that given to manufacuter</div>
    					<div class="panel-body">
    						<div>
							    <h4>Property: halalv:halalCode</h4>
							    <p>
							    <span class="term-label"><em>Halal certificate number.</em></span>
							    </p>
								<dl>
							    <dt>URI:</dt>
							    <dd><a href="http://halal.addi.is.its.ac.id/halalv.ttl#halalCode">http://halal.addi.is.its.ac.id/halalv.ttl#halalCode</a></dd>
							    <dt>Domain:</dt>
							    <dd><a href="http://halal.addi.is.its.ac.id/halalv.ttl#HalalCertificate">halalv:HalalCertificate</a></dd>
								<dt>Range:</dt>
							    <dd><a href="http://www.w3.org/2001/XMLSchema#string">xsd:string</a></dd>
								</dl>
							</div>
							<div>
							    <h4>Property: halalv:halalExp</h4>
							    <p>
							    <span class="term-label"><em>Halal certificate expire date.</em></span>
							    </p>
								<dl>
							    <dt>URI:</dt>
							    <dd><a href="http://halal.addi.is.its.ac.id/halalv.ttl#halalExp">http://halal.addi.is.its.ac.id/halalv.ttl#halalExp</a></dd>
							    <dt>Domain:</dt>
							    <dd><a href="http://halal.addi.is.its.ac.id/halalv.ttl#HalalCertificate">halalv:HalalCertificate</a></dd>
								</dl>
								<dt>Range:</dt>
							    <dd><a href="http://www.w3.org/2001/XMLSchema#date">xsd:date</a></dd>
							</div>
							<div>
							    <h4>Property: halalv:halalStatus</h4>
							    <p>
							    <span class="term-label"><em>Halal certificate status.</em></span>
							    </p>
								<dl>
							    <dt>URI:</dt>
							    <dd><a href="http://halal.addi.is.its.ac.id/halalv.ttl#halalStatus">http://halal.addi.is.its.ac.id/halalv.ttl#halalStatus</a></dd>
							    <dt>Domain:</dt>
							    <dd><a href="http://halal.addi.is.its.ac.id/halalv.ttl#HalalCertificate">halalv:HalalCertificate</a></dd>
								</dl>
							</div>
							<div>
							    <h4>Property: halalv:OrgCert</h4>
							    <p>
							    <span class="term-label"><em>Organizations that issue halal certificates.</em></span>
							    </p>
								<dl>
							    <dt>URI:</dt>
							    <dd><a href="http://halal.addi.is.its.ac.id/halalv.ttl#OrgCert">http://halal.addi.is.its.ac.id/halalv.ttl#OrgCert</a></dd>
							    <dt>Domain:</dt>
							    <dd><a href="http://halal.addi.is.its.ac.id/halalv.ttl#HalalCertificate">halalv:HalalCertificate</a></dd>
							    <dt>Range:</dt>
							    <dd><a href="http://halal.addi.is.its.ac.id/halalv.ttl#Sources">halalv:Sources</a></dd>
								</dl>
							</div>							
    					</div>						
    				</div>
					<br>
					<h2>Example<h2>					
					<pre>
@prefix rdf: &lt;http://www.w3.org/1999/02/22-rdf-syntax-ns#&gt;.
@prefix rdfs: &lt;http://www.w3.org/2000/01/rdf-schema#&gt;.
@prefix owl: &lt;http://www.w3.org/2002/07/owl#&gt;.
@prefix xsd: &lt;http://www.w3.org/2001/XMLSchema#&gt;.
@prefix foaf: &lt;http://xmlns.com/foaf/0.1/&gt;.
@prefix halalv: &lt;http://halal.addi.is.its.ac.id/vocabulary#&gt;.
@prefix halalf: &lt;http://halal.addi.is.its.ac.id/foodproduct/&gt;.
@prefix halali: &lt;http://halal.addi.is.its.ac.id/ingredient/&gt;.
@prefix halalc: &lt;http://halal.addi.is.its.ac.id/certificate/&gt;.
@prefix halals: &lt;http://halal.addi.is.its.ac.id/source/&gt;.
@prefix food: &lt;http://purl.org/foodontology#&gt; .
@prefix foodlirmm: &lt;http://data.lirmm.fr/ontologies/food#&gt; .
@prefix gr: &lt;http://purl.org/goodrelations/v1#&gt;. 

halalf:Happy_Tos_Rasa_Jagung_Bakar  a halalv:FoodProduct;
    foodlirmm:code "08993027163764";
    rdfs:label "Happy Tos Rasa Jagung Bakar";
    gr:hasManufacturer halalm:1;
    food:containsIngredient halali:1, halali:2, halal:3, halali:4;
    food:ingredientsListAsText "Whole Corn, Palm Oil, Flavour Enhancer";
    foodlirmm:energyPer100g 280^xsd:integer;
    foodlirmm:fatPer100g 14^xsd:decimal;
    foodlirmm:saturatedFatPer100g 6^xsd:decimal
    foodlirmm:sodiumPer100g  0.12^xsd:decimal
    foodlirmm:carbohydratesPer100g 35^xsd:decimal;
    foodlirmm:fiberPer100g 4^xsd:decimal;
    foodlirmm:sugarsPer100g 1^xsd:decimal;
    foodlirmm:proteinsPer100g 4^xsd:decimal;
    halalv:certificate halalc:1.
    
halalm:1 a foaf:Organization;
    rdfs:label "PT. Sinar Kencana Agung".

halali:Whole_Corn a halalv:Ingredient;
    foodlirmm:rank 1^xsd:integer;
    rdfs:label "Whole Corn";
    halalv:halalSource halalv:Halal .

halali:Palm_Oil a halalv:Ingredient;
    foodlirmm:rank 2^xsd:integer;
    rdfs:label "Palm Oil"; 
 halalv:halalSource halalv:Halal .

halali:Monosodium_glutamate a halalv:FoodAdditive ;
    foodlirmm:rank 4^xsd:integer;
    rdfs:label "Monosodium glutamate";
    rdfs:comment "E621";
    halalv:halal halals:1.

halals:1 a halalv:Source;
    halalv:Estatus halalv:Mushbooh
    rdfs:comment "Miscellaneous - Flavour Enhancers. Suitable for vegetarian label on the package indicates the source of Monosodium Glutamate is from vegetable protein or it has to be under Halal or kosher certification.";
    halalv:OrgSource halals:Muslim_Customer_Group.
    
halalc:1 a halalv:HalalCertificate;
halalv:halalvStatus halalv:Halal;
    halalv:halalCode "00100061230412";
    halalv:halalExp "24-05-2018"^xsd:date;
    halalv:OrgCert halals:Majelis_Ulama_Indonesia.
					</pre>
				</div>
            </div>
        </div>
    </div>
    <br/>
            <br/>
            <br/>
            <br/>
            <br/>
            <br/>
@endsection