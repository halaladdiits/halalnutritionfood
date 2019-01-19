<div class="row">
    <div class="col-md-12">
        <h2 class="blog-title">Food Information</h2>
        <hr>
        {!! Form::hidden('user_id', Auth::user()->id ) !!}
        <div class="form-group" ng-class="{ 'has-error' : foodForm.fCode.$invalid && foodForm.fCode.$touched}">
            {!! Form::label('fCode','Food Code') !!}
            {!! Form::text('fCode',null, [
                'class' => 'form-control form-code',
                'ng-model' => 'foodCode',
                'ng-init'=>"foodCode='2233'",
                'ng-minlength' => '8',
                'ng-maxlength' => '13',
                'ng-model-options'=>"{ updateOn: 'blur' }",
                'placeholder' => 'Food Code',
                'required'=>'required'
            ])!!}
            <p ng-show="foodForm.fCode.$error.required && foodForm.fCode.$touched" class="help-block">Food code is required.</p>
            <p ng-show="foodForm.fCode.$error.minlength" class="help-block">Food code is too short.</p>
            <p ng-show="foodForm.fCode.$error.maxlength" class="help-block">Food code is too long.</p>
        </div>
        <div class="form-group" ng-class="{ 'has-error' : foodForm.fName.$invalid && foodForm.fName.$touched}">
            {!! Form::label('fName','Food Name') !!}
            {!! Form::text('fName',null, [
                'class' => 'form-control',
                'placeholder' => 'Food Name',
                'ng-model' => 'foodName',
                'ng-minlength' => '5',
                'ng-model-options'=>"{ updateOn: 'blur' }",
                'required'=>'required'
            ])!!}
            <p ng-show="foodForm.fName.$error.required && foodForm.fName.$touched" class="help-block">Food name is required.</p>
            <p ng-show="foodForm.fName.$error.minlength" class="help-block">Food name is too short.</p>
        </div>
        <div class="form-group" ng-class="{ 'has-error' : foodForm.fManufacture.$invalid && foodForm.fManufacture.$touched}">
            {!! Form::label('fManufacture','Food Manufacture') !!}
            {!! Form::text('fManufacture',null, [
                'class' => 'fManufacture form-control',
                'placeholder' => 'Food Manufacture',
                'ng-model' => 'foodManufacture',
                'ng-minlength' => '3',
                'ng-model-options'=>"{ updateOn: 'blur' }",
                'required'=>'required'
            ]) !!}
            <p ng-show="foodForm.fManufacture.$error.required && foodForm.fManufacture.$touched" class="help-block">Food manufacture is required.</p>
            <p ng-show="foodForm.fManufacture.$error.minlength" class="help-block">Food manufacture is too short.</p>
        </div>
        <div class="form-group">
            {!! Form::label('ingredient_list','Food Ingredient') !!}
            {!! Form::select('ingredient_list[]', array(), null, [
                'class' => 'form-control ingredient',
                'multiple' => 'multiple'
            ]) !!}
        </div>
        <div>
            {!! Form::label('certificate','Halal Certificate') !!}
        </div>
        <div class="row">
            <div class="col-lg-2 col-md-3">
                <div class="form-group">
                    {!! Form::text('cCode[]',null, ['class' => 'form-control form-code', 'placeholder' => 'Code']) !!}
                </div>
            </div>
            <div class="col-lg-3 col-md-4">
                <div class="form-group">
                    {!! Form::text('cExpire[]', null, ['class'=>'form-control form-date','id' => 'certexp', 'placeholder' => 'dd-mm-yyyy']) !!}
                </div>
            </div>
            <div class="col-lg-3 col-md-4">
                <div class="form-group">
                    {!! Form::select('cStatus[]', array('Development','New','Renew'), null, ['class' => 'form-control select2', 'placeholder' => 'Status']) !!}
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-xs-11">
                <div class="form-group">
                    {!! Form::text('cOrganization[]', null, ['class' => 'halalcertorg form-control', 'placeholder' => 'Halal Organization', 'autocomplete' => 'off']) !!}
                </div>
            </div>
            <div class="col-lg-1 col-md-1 col-xs-1">
                <a class="btn btn-success add_field_button" href="#"><i class="fa fa-plus"></i></a>
            </div>
        </div>
        <div class="input_fields_wrap "></div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <h2>Food Nutrition</h2>
        <hr>
    </div>
    <div class="col-md-3 col-sm-6">
        <div class="form-horizontal">
            <div class="form-group">
                {!! Form::label('weight','Weight (gr)', ['class' => 'col-sm-7 control-label']) !!}
                <div class="col-sm-5">
                    {!! Form::input('number','weight',0, ['class' => 'form-control', 'min'=>0, 'step'=>.1]) !!}
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('calories','Calories (kkal)', ['class' => 'col-sm-7 control-label']) !!}
                <div class="col-sm-5">
                    {!! Form::input('number','calories',0, ['class' => 'form-control', 'min'=>0, 'step'=>.1]) !!}
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('cholesterol','Cholesterol (mg)', ['class' => 'col-sm-7 control-label']) !!}
                <div class="col-sm-5">
                    {!! Form::input('number','cholesterol',0, ['class' => 'form-control', 'min'=>0, 'step'=>.1]) !!}
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('sodium','Sodium / Natrium', ['class' => 'col-sm-7 control-label']) !!}
                <div class="col-sm-5">
                    {!! Form::input('number','sodium',0, ['class' => 'form-control', 'min'=>0, 'step'=>.1]) !!}
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6">
        <div class="form-horizontal">
            <div class="form-group">
                {!! Form::label('totalFat','Total Fat (gr)', ['class' => 'col-sm-7 control-label']) !!}
                <div class="col-sm-5">
                    {!! Form::input('number','totalFat',0, ['class' => 'form-control', 'min'=>0, 'step'=>.1]) !!}
                </div>
            </div>
            <div class="form-group">
                <small>{!! Form::label('saturatedFat','Saturated Fat (gr)', ['class' => 'col-sm-7 control-label']) !!}</small>
                <div class="col-sm-5">
                    {!! Form::input('number','saturatedFat',0, ['class' => 'form-control', 'min'=>0, 'step'=>.1]) !!}
                </div>
            </div>
            <div class="form-group">
                <small>{!! Form::label('transFat','Trans Fat (gr)', ['class' => 'col-sm-7 control-label']) !!}</small>
                <div class="col-sm-5">
                    {!! Form::input('number','transFat',0, ['class' => 'form-control', 'min'=>0, 'step'=>.1]) !!}
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('protein','Protein (gr)', ['class' => 'col-sm-7 control-label']) !!}
                <div class="col-sm-5">
                    {!! Form::input('number','protein',0, ['class' => 'form-control', 'min'=>0, 'step'=>.1]) !!}
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6">
        <div class="form-horizontal">

            <div class="form-group">
                {!! Form::label('totalCarbohydrates','Carbohydrates (gr)', ['class' => 'col-sm-7 control-label']) !!}
                <div class="col-sm-5">
                    {!! Form::input('number','totalCarbohydrates',0, ['class' => 'form-control', 'min'=>0, 'step'=>.1]) !!}
                </div>
            </div>
            <div class="form-group">
                <small>{!! Form::label('dietaryFiber','Dietary Fiber (gr)', ['class' => 'col-sm-7 control-label']) !!}</small>
                <div class="col-sm-5">
                    {!! Form::input('number','dietaryFiber',0, ['class' => 'form-control', 'min'=>0, 'step'=>.1]) !!}
                </div>
            </div>
            <div class="form-group">
                <small>{!! Form::label('sugar','Sugar (gr)', ['class' => 'col-sm-7 control-label']) !!}</small>
                <div class="col-sm-5">
                    {!! Form::input('number','sugar',0, ['class' => 'form-control', 'min'=>0, 'step'=>.1]) !!}
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6">
        <div class="form-horizontal">
            <div class="form-group">
                {!! Form::label('vitaminA','Vitamin A (%)', ['class' => 'col-sm-7 control-label']) !!}
                <div class="col-sm-5">
                    {!! Form::input('number','vitaminA',0, ['class' => 'form-control', 'min'=>0, 'step'=>.1]) !!}
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('vitaminC','Vitamin C (%)', ['class' => 'col-sm-7 control-label']) !!}
                <div class="col-sm-5">
                    {!! Form::input('number','vitaminC',0, ['class' => 'form-control', 'min'=>0, 'step'=>.1]) !!}
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('calcium','Calcium (%)', ['class' => 'col-sm-7 control-label']) !!}
                <div class="col-sm-5">
                    {!! Form::input('number','calcium',0, ['class' => 'form-control', 'min'=>0, 'step'=>.1]) !!}
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('iron','Iron (%)', ['class' => 'col-sm-7 control-label']) !!}
                <div class="col-sm-5">
                    {!! Form::input('number','iron',0, ['class' => 'form-control', 'min'=>0, 'step'=>.1]) !!}
                </div>
            </div>
        </div>
    </div>
</div>
{!! Form::submit($SubmitButtonText, ['class' => 'btn btn-primary', 'ng-disabled'=>'foodForm.$invalid']) !!}
{!! Form::reset('Reset', ['class' => 'btn btn-default']) !!}