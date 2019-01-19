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
					<h2>Class: FoodProduct</h2>
					<div class="panel panel-default">
    					<div class="panel-heading">A manufactured food product</div>
    					<div class="panel-body">
    						<div>
							    <h4>Property: food:code</h4>
							    <p>
							    <span class="term-label"><em>Identifier: usually a barcode such as EAN-13 (European Article Numbering) or UPC-A (Universal Product Code)</em></span>
							    </p>
								<dl>
							    <dt>URI:</dt>
							    <dd><a href="http://data.lirmm.fr/ontologies/food#code">http://data.lirmm.fr/ontologies/food#code</a></dd>
							    <dt>Domain:</dt>
							    <dd><a href="http://data.lirmm.fr/ontologies/food#FoodProduct">food:FoodProduct</a></dd>
								</dl>
							</div>
							<div>
							    <h4>Property: gr:hasManufacturer</h4>
							    <p>
							    <span class="term-label"><em>This object property links a gr:ProductOrService to the gr:BusinessEntity that produces it. Mostly used with gr:ProductOrServiceModel.</em></span>
							    </p>
								<dl>
							    <dt>URI:</dt>
							    <dd><a href="http://purl.org/goodrelations/v1#hasManufacturer">http://purl.org/goodrelations/v1#hasManufacturer</a></dd>
							    <dt>Domain:</dt>
							    <dd><a href="http://purl.org/goodrelations/v1#ProductOrService">gr:ProductOrService</a></dd>
								</dl>
							</div>
							<div>
							    <h4>Property: food:netWeight</h4>
							    <p>
							    <span class="term-label"><em>net weight of a food product (g) </em></span>
							    </p>
								<dl>
							    <dt>URI:</dt>
							    <dd><a href="http://data.lirmm.fr/ontologies/food#netWeight">http://data.lirmm.fr/ontologies/food#netWeight</a></dd>
								<dt>Range:</dt>
							    <dd><a href="http://www.w3.org/2000/01/rdf-schema#Literal">rdfs:Literal</a></dd>
								</dl>
							</div>
							<div>
							    <h4>Property: food:fatPer100g</h4>
							    <p>
							    <span class="term-label"><em>Nutrition data: fat (in g) per 100g (or 100ml for liquids)</em></span>
							    </p>
								<dl>
							    <dt>URI:</dt>
							    <dd><a href="http://data.lirmm.fr/ontologies/food#fatPer100g">http://data.lirmm.fr/ontologies/food#fatPer100g</a></dd>
							    <dt>Domain:</dt>
							    <dd><a href="http://data.lirmm.fr/ontologies/food#Food">food:Food</a></dd>
							    <dt>Range:</dt>
							    <dd><a href="http://www.w3.org/2001/XMLSchema#decimal">xsd:decimal</a></dd>
								</dl>
							</div>
							<div>
							    <h4>Property: food:saturatedFatPer100g</h4>
							    <p>
							    <span class="term-label"><em>Nutrition data: saturated fat (in g) per 100g (or 100ml for liquids)</em></span>
							    </p>
								<dl>
							    <dt>URI:</dt>
							    <dd><a href="http://data.lirmm.fr/ontologies/food#saturatedFatPer100g">http://data.lirmm.fr/ontologies/food#saturatedFatPer100g</a></dd>
							    <dt>Domain:</dt>
							    <dd><a href="http://data.lirmm.fr/ontologies/food#Food">food:Food</a></dd>
							    <dt>Range:</dt>
							    <dd><a href="http://www.w3.org/2001/XMLSchema#decimal">xsd:decimal</a></dd>
								</dl>
							</div>
							<div>
							    <h4>Property: food:sodiumPer100g</h4>
							    <p>
							    <span class="term-label"><em>Nutrition data: sodium (in g) per 100g (or 100ml for liquids)</em></span>
							    </p>
								<dl>
							    <dt>URI:</dt>
							    <dd><a href="http://data.lirmm.fr/ontologies/food#sodiumPer100g">http://data.lirmm.fr/ontologies/food#sodiumPer100g</a></dd>
							    <dt>Domain:</dt>
							    <dd><a href="http://data.lirmm.fr/ontologies/food#Food">food:Food</a></dd>
							    <dt>Range:</dt>
							    <dd><a href="http://www.w3.org/2000/01/rdf-schema#Literal">rdfs:Literal</a></dd>
								</dl>
							</div>
							<div>
							    <h4>Property: food:fiberPer100g</h4>
							    <p>
							    <span class="term-label"><em>Nutrition data: fiber (in g) per 100g (or 100ml for liquids)</em></span>
							    </p>
								<dl>
							    <dt>URI:</dt>
							    <dd><a href="http://data.lirmm.fr/ontologies/food#fiberPer100g">http://data.lirmm.fr/ontologies/food#fiberPer100g</a></dd>
							    <dt>Domain:</dt>
							    <dd><a href="http://data.lirmm.fr/ontologies/food#Food">food:Food</a></dd>
							    <dt>Range:</dt>
							    <dd><a href="http://www.w3.org/2000/01/rdf-schema#Literal">rdfs:Literal</a></dd>
								</dl>
							</div>
							<div>
							    <h4>Property: food:sugarsPer100g</h4>
							    <p>
							    <span class="term-label"><em>Nutrition data: sugars (in g) per 100g (or 100ml for liquids)</em></span>
							    </p>
								<dl>
							    <dt>URI:</dt>
							    <dd><a href="http://data.lirmm.fr/ontologies/food#sugarsPer100g">http://data.lirmm.fr/ontologies/food#sugarsPer100g</a></dd>
							    <dt>Domain:</dt>
							    <dd><a href="http://data.lirmm.fr/ontologies/food#Food">food:Food</a></dd>
							    <dt>Range:</dt>
							    <dd><a href="http://www.w3.org/2000/01/rdf-schema#Literal">rdfs:Literal</a></dd>
								</dl>
							</div>
							<div>
							    <h4>Property: food:proteinsPer100g</h4>
							    <p>
							    <span class="term-label"><em>Nutrition data: proteins (in g) per 100g (or 100ml for liquids)</em></span>
							    </p>
								<dl>
							    <dt>URI:</dt>
							    <dd><a href="http://data.lirmm.fr/ontologies/food#proteinsPer100g">http://data.lirmm.fr/ontologies/food#proteinsPer100g</a></dd>
							    <dt>Domain:</dt>
							    <dd><a href="http://data.lirmm.fr/ontologies/food#Food">food:Food</a></dd>
							    <dt>Range:</dt>
							    <dd><a href="http://www.w3.org/2001/XMLSchema#decimal">xsd:decimal</a></dd>
								</dl>
							</div>
							<div>
							    <h4>Property: food:vitaminAPer100g</h4>
							    <p>
							    </p>
							    <span class="term-label"><em>Nutrition data: vitamin A (in g) per 100g (or 100ml for liquids)</em></span>
								<dl>
							    <dt>URI:</dt>
							    <dd><a href="http://data.lirmm.fr/ontologies/food#vitaminAPer100g">http://data.lirmm.fr/ontologies/food#vitaminAPer100g</a></dd>
							    <dt>Domain:</dt>
							    <dd><a href="http://data.lirmm.fr/ontologies/food#Food">food:Food</a></dd>
							    <dt>Range:</dt>
							    <dd><a href="http://www.w3.org/2001/XMLSchema#decimal">xsd:decimal</a></dd>
								</dl>
							</div>
							<div>
							    <h4>Property: food:vitaminCPer100g</h4>
							    <p>
							    </p>
							    <span class="term-label"><em>Nutrition data: vitamin C (in g) per 100g (or 100ml for liquids)</em></span>
								<dl>
							    <dt>URI:</dt>
							    <dd><a href="http://data.lirmm.fr/ontologies/food#vitaminCPer100g">http://data.lirmm.fr/ontologies/food#vitaminCPer100g</a></dd>
							    <dt>Domain:</dt>
							    <dd><a href="http://data.lirmm.fr/ontologies/food#Food">food:Food</a></dd>
							    <dt>Range:</dt>
							    <dd><a href="http://www.w3.org/2001/XMLSchema#decimal">xsd:decimal</a></dd>
								</dl>
							</div>
							<div>
							    <h4>Property: food:containsIngredient</h4>
							    <p>
							    </p>
							    <span class="term-label"><em>Specifies an ingredient contained in the Food object - Value is an object of the class Ingredient so that we can specify the quantity, the unit, and the nature of the ingredient (string or other Food object) e.g. 1 clove of garlic -> quantity = 1, unit = clove, ingredient = garlic (or Food object for garlic)</em></span>
								<dl>
							    <dt>URI:</dt>
							    <dd><a href="
							http://data.lirmm.fr/ontologies/food#containsIngredient">
							http://data.lirmm.fr/ontologies/food#containsIngredient</a></dd>
							    <dt>Domain:</dt>
							    <dd><a href="http://data.lirmm.fr/ontologies/food#Food">food:Food</a></dd>
							    <dt>Range:</dt>
							    <dd><a href="http://data.lirmm.fr/ontologies/food#Ingredient">food:Ingredient</a></dd>
							  </dl>
							</div>
    					</div>
					</div>
					<h2>Class: Ingredient</h2>
					<div class="panel panel-default">
    					<div class="panel-heading">An ingredient : a certain quantity of food that is part of another food</div>
    					<div class="panel-body">
							<div>
							    <h4>Property: food:rank</h4>
							    <p>
							    <span class="term-label"><em>Rank of an ingredient in an ingredient list ordered by quantity (e.g. food products).</em></span>
							    </p>
								<dl>
							    <dt>URI:</dt>
							    <dd><a href="http://data.lirmm.fr/ontologies/food#rank">http://data.lirmm.fr/ontologies/food#rank</a></dd>
							    <dt>Domain:</dt>
							    <dd><a href="http://data.lirmm.fr/ontologies/food#Ingredient">food:Ingredient</a></dd>
								</dl>
							</div>
							<div>
							    <h4>Property: rdfs:comment</h4>
							    <p>
							    <span class="term-label"><em>A description of the subject resource.</em></span>
							    </p>
								<dl>
							    <dt>URI:</dt>
							    <dd><a href="https://www.w3.org/2000/01/rdf-schema#comment">https://www.w3.org/2000/01/rdf-schema#comment</a></dd>
							    <dt>Domain:</dt>
							    <dd><a href="https://www.w3.org/2000/01/rdf-schema#Resource">rdfs:Resource</a></dd>
								</dl>
							</div>
							<div>
							    <h4>Property: halalv:halal</h4>
							    <p>
							    <span class="term-label"><em>Describe that a food/beverage/ENumbers/food ingedient are allowed to be consumed in Islamic religious.</em></span>
							    </p>
								<dl>
							    <dt>URI:</dt>
							    <dd><a href="http://halal.addi.is.its.ac.id/halalv.ttl#halal">http://halal.addi.is.its.ac.id/halalv.ttl#halal</a></dd>
								</dl>
							</div>
    					</div>
    				</div>
    				<h2>Class: Manufacture</h2>
					<div class="panel panel-default">
    					<div class="panel-heading">Manufacture that make and distribute food product.</div>
    					<div class="panel-body">
    						
    					</div>
    				</div>
    				<h2>Class: Sources</h2>
					<div class="panel panel-default">
    					<div class="panel-heading">Source that conclude E-Number ingredient status.</div>
    					<div class="panel-body">
							<div>
							    <h4>Property: rdfs:comment</h4>
							    <p>
							    <span class="term-label"><em>A description of the subject resource.</em></span>
							    </p>
								<dl>
							    <dt>URI:</dt>
							    <dd><a href="https://www.w3.org/2000/01/rdf-schema#comment">https://www.w3.org/2000/01/rdf-schema#comment</a></dd>
							    <dt>Domain:</dt>
							    <dd><a href="https://www.w3.org/2000/01/rdf-schema#Resource">rdfs:Resource</a></dd>
								</dl>
							</div>
							<div>
							    <h4>Property: foaf:organization</h4>
							    <p>
							    <span class="term-label"><em>An organization.</em></span>
							    </p>
								<dl>
							    <dt>URI:</dt>
							    <dd><a href="http://xmlns.com/foaf/0.1/Organization">http://xmlns.com/foaf/0.1/Organization</a></dd>
								</dl>
							</div>
							<div>
							    <h4>Property: rdfs:seeAlso</h4>
							    <p>
							    <span class="term-label"><em>Further information about the subject resource.</em></span>
							    </p>
								<dl>
							    <dt>URI:</dt>
							    <dd><a href="https://www.w3.org/2000/01/rdf-schema#seeAlso">https://www.w3.org/2000/01/rdf-schema#seeAlso</a></dd>
							    <dt>Domain:</dt>
							    <dd><a href="https://www.w3.org/2000/01/rdf-schema#Resource">rdfs:Resource</a></dd>
								</dl>
							</div>
    					</div>
    				</div>
    				<h2>Class: HalalCertificate</h2>
					<div class="panel panel-default">
    					<div class="panel-heading">Halal Certificate that given to manufacuter that</div>
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
								</dl>
							</div>
    					</div>
    				</div>
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