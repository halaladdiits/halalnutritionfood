<div id="nutrition">
        <div itemprop="nutrition" itemscope="" itemtype="http://schema.org/NutritionInformation" class="nutritionLabel" style=" width: 260px;">
                <div class="title">Nutrition Facts</div>
                <div class="cf">
                        <div class="name inline"><% foodName %></div>
                </div><!-- closing class="cf" -->
                <div class="bar1"></div>
                <div class="line">
                        <div><b>Weight</b> <span itemprop="calories">{!! Form::input('number','weight',null, ['class' => 'unitInputBox', 'min'=>0, 'step'=>1, 'max'=>9999]) !!}g</span></div>
                </div>
                <div class="line">
                        <div><b>Calories</b> <span itemprop="calories">{!! Form::input('number','calories',null, ['class' => 'unitInputBox', 'min'=>0, 'step'=>1, 'max'=>9999]) !!}kkal</span></div>
                </div>
                <div class="bar2"></div>
                <div class="line ar"><b>% Daily Value<sup>*</sup></b></div>
                <div class="line">
                        <div class="dv"><b><% Math.round(+totalFat*100/65)%></b>%</div>
                        <b>Total Fat</b> <span itemprop="fatContent">{!! Form::input('number','totalFat',null, ['class' => 'unitInputBox', 'min'=>0, 'step'=>.1, 'max'=>999, 'ng-model'=>'totalFat']) !!}g
                </span></div>
                <div class="line indent">
                        <div class="dv"><b><% Math.round(+saturatedFat*100/20)%></b>%</div>
                        Saturated Fat <span itemprop="saturatedFatContent">{!! Form::input('number','saturatedFat',null, ['class' => 'unitInputBox', 'min'=>0, 'step'=>.1, 'max'=>999, 'ng-model'=>'saturatedFat']) !!}g
                </span></div>
                <div class="line indent">
                        <i>Trans</i> Fat <span itemprop="transFatContent">{!! Form::input('number','transFat',null, ['class' => 'unitInputBox', 'min'=>0, 'step'=>.1, 'max'=>999]) !!}g
                </span></div>
                <div class="line">
                        <div class="dv"><b><% Math.round(+cholesterol*100/300)%></b>%</div>
                        <b>Cholesterol</b> <span itemprop="cholesterolContent">{!! Form::input('number','cholesterol',null, ['class' => 'unitInputBox', 'min'=>0, 'step'=>.1, 'max'=>999, 'ng-model'=>'cholesterol']) !!}mg
                </span></div>
                <div class="line">
                        <div class="dv"><b><% Math.round(+sodium*100/2400)%></b>%</div>
                        <b>Sodium</b> <span itemprop="sodiumContent">{!! Form::input('number','sodium',null, ['class' => 'unitInputBox', 'min'=>0, 'step'=>.1, 'max'=>999,'ng-model'=>'sodium']) !!}mg
                </span></div>
                <div class="line">
                        <div class="dv"><b><% Math.round(+totalCarbohydrates*100/300)%></b>%</div>
                        <b>Total Carbohydrates</b> <span itemprop="carbohydrateContent">{!! Form::input('number','totalCarbohydrates',null, ['class' => 'unitInputBox', 'min'=>0, 'step'=>.1, 'max'=>999, 'ng-model'=>'totalCarbohydrates']) !!}g
                </span></div>
                <div class="line indent">
                        <div class="dv"><b><% Math.round(+dietaryFiber*100/25)%></b>%</div>
                        Dietary Fiber <span itemprop="fiberContent">{!! Form::input('number','dietaryFiber',null, ['class' => 'unitInputBox', 'min'=>0, 'step'=>.1, 'max'=>999, 'ng-model'=>'dietaryFiber']) !!}g
                </span></div>
                <div class="line indent">Sugars <span itemprop="sugarContent">{!! Form::input('number','sugar',null, ['class' => 'unitInputBox', 'min'=>0, 'step'=>.1, 'max'=>999]) !!}g</span></div>
                <div class="line"><b>Protein</b> <span itemprop="proteinContent">{!! Form::input('number','protein',null, ['class' => 'unitInputBox', 'min'=>0, 'step'=>.1, 'max'=>999]) !!}g</span></div>
                <div class="bar1"></div>
                <div class="line vitaminA">
                        <div class="dv">{!! Form::input('number','vitaminA',null, ['class' => 'unitInputBox', 'min'=>0, 'step'=>1, 'max'=>100]) !!}%</div>
                        Vitamin A
                </div>
                <div class="line vitaminC">
                        <div class="dv">{!! Form::input('number','vitaminC',null, ['class' => 'unitInputBox', 'min'=>0, 'step'=>1, 'max'=>100]) !!}%</div>
                        Vitamin C
                </div>
                <div class="line calcium">
                        <div class="dv">{!! Form::input('number','calcium',null, ['class' => 'unitInputBox', 'min'=>0, 'step'=>1, 'max'=>100]) !!}%</div>
                        Calcium
                </div>
                <div class="line iron">
                        <div class="dv">{!! Form::input('number','iron',null, ['class' => 'unitInputBox', 'min'=>0, 'step'=>1, 'max'=>100]) !!}%</div>
                        Iron
                </div>
                <div class="dvCalorieDiet line">
                        <div class="calorieNote">
                                <span class="star">*</span> Percent Daily Values are based on a 2000 calorie diet.
                                <br>
                                <span class="star">*</span> 1 gr = 1ml.
                        </div><!-- closing class="calorieNote" -->
                </div><!-- closing class="dvCalorieDiet line" -->
        </div><!-- closing class="nutritionLabel" -->
</div>
