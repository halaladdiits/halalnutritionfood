@extends('layouts.v2.master')

@section('title', 'Halal Nutrition Food | API Documentation')

@section('css')
    @parent
@endsection

@section('body')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="term-node node teaser">
				    <h3>API Documentation</h3>
				    <p class="summary">
				    <span class="term-label"><em>Use our API to get products, ingredients, foodcodes, or manufactures in JSON format. </em></span>
				    </p>
				  <dl class="term-details">
				    <dt>API End Point:</dt>
				    <dd><a href="http://halal.addi.is.its.ac.id/apiv2">http://halal.addi.is.its.ac.id/apiv2</a></dd>
				    <dt>Parameters:</dt>
				    <dd><b>q (String) :</b> Your keyword (products, ingredients, foodcodes, or manufactures) <br/>
				    <b>result (Number) :</b> Default number of this field is 20. This parameter represent the tumber of result which you want to show in JSON.</dd>
				    <br/>
				    <dt>Example :</dt>
				    <dd><a href="http://halal.addi.is.its.ac.id/apiv2?q=monosodium&result=3">http://halal.addi.is.its.ac.id/apiv2?q=monosodium&result=3</a></dd>
				    <dd>Wil have result :</dd>
				    <dd>
				    		<pre>

{
  "message": "Only results 3 total matching documents collected. Time: 312ms",
  "entityData": [
    {
      "score": 0.45571236930194187,
      "label": "Monosodium Glutamate",
      "statsScore": "Ss : 0.0 - DocScore : 4.335157 - NumbOfTerms : 2.0 - TFIEF : 2.1675785 - Spread : 1.3174603174603174 - Qs : 2.855698604432363 - Fs : 0.45571236930194187",
      "atribute": {
        "proteinsPer100g": "0.00",
        "code": "",
        "calcium": "0",
        "vitaminC": "0",
        "fiberPer100g": "0.00",
        "certificate": "2529",
        "calories": "0",
        "label": "Monosodium Glutamate",
        "type": "food#FoodProduct",
        "foodproductId": "38802",
        "path": "/var/www/halal/public/resources/foodproducts/Monosodium_Glutamate.ttl",
        "manufacture": "38802",
        "netWeight": "0",
        "fatPer100g": "0.00",
        "sugarsPer100g": "0.00",
        "iron": "0",
        "vitaminA": "0",
        "hasManufacturer": "Beijing FortuneStar S T Development Co Limited",
        "saturatedFatPer100g": "0.00"
      }
    },
    {
      "score": 0.2796210983039161,
      "label": "Monosodium Glutamate MSG ",
      "statsScore": "Ss : 0.0 - DocScore : 4.335157 - NumbOfTerms : 3.0 - TFIEF : 1.4450523 - Spread : 1.3174603174603174 - Qs : 1.903799017270406 - Fs : 0.2796210983039161",
      "atribute": {
        "proteinsPer100g": "0.00",
        "calcium": "0",
        "code": "",
        "vitaminC": "0",
        "fiberPer100g": "0.00",
        "certificate": "2481",
        "calories": "0",
        "label": "Monosodium Glutamate MSG ",
        "type": "food#FoodProduct",
        "foodproductId": "38803",
        "path": "/var/www/halal/public/resources/foodproducts/Monosodium_Glutamate_MSG_.ttl",
        "manufacture": "38803",
        "netWeight": "0",
        "sodiumPer100g": "0.00",
        "fatPer100g": "0.00",
        "sugarsPer100g": "0.00",
        "iron": "0",
        "vitaminA": "0",
        "hasManufacturer": "Daesang Corporation Korea"
      }
    },
    {
      "score": 0.15468237363796067,
      "label": "Food Additive Monosodium Phosphate",
      "statsScore": "Ss : 0.0 - DocScore : 4.335157 - NumbOfTerms : 4.0 - TFIEF : 1.0837892 - Spread : 1.3174603174603174 - Qs : 1.4278493022161816 - Fs : 0.15468237363796067",
      "atribute": {
        "proteinsPer100g": "0.00",
        "calcium": "0",
        "code": "",
        "vitaminC": "0",
        "fiberPer100g": "0.00",
        "certificate": "2892",
        "calories": "0",
        "label": "Food Additive Monosodium Phosphate",
        "type": "food#FoodProduct",
        "foodproductId": "41549",
        "path": "/var/www/halal/public/resources/foodproducts/Food_Additive_Monosodium_Phosphate.ttl",
        "manufacture": "41549",
        "sodiumPer100g": "0.00",
        "netWeight": "0",
        "sugarsPer100g": "0.00",
        "fatPer100g": "0.00",
        "iron": "0",
        "vitaminA": "0",
        "hasManufacturer": "Thermphos Lianyungang Food Ingredient Co Ltd ",
        "saturatedFatPer100g": "0.00"
      }
    }
  ]
}
							</pre>

				    </dd>
				  </dl>
				</div>
				
				* Score represent the score of the entity in result of query <br/>
				* statScore represent the detail of the score of entity  <br/>
				* atribute represent the atributes of entity  <br/>
				
            <br/>
            <br/>
            <br/>
            <br/>
        </div>
    </div>
    <br>
    <br>
    
@endsection