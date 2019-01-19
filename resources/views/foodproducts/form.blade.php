    <div class="col-md-4 col-sm-5">
        @include('foodproducts/nutrition')
    </div>
    <div class="col-md-8 col-sm-7">
        {!! Form::hidden('user_id', Auth::user()->id ) !!}
        <div class="form-group">
            {!! Form::label('fCode','Food Code') !!}
            {!! Form::text('fCode',null, [
                'class' => 'form-control form-code',
                'placeholder' => 'Food Code',
                'required',
                'minlength' => '8',
                'maxlength' => '13',
            ])!!}
        </div>
        <div class="form-group">
            {!! Form::label('fName','Food Name') !!}
            {!! Form::text('fName',null, [
                'class' => 'form-control',
                'placeholder' => 'Food Name',
                'autocomplete' => 'off',
                'required',
            ])!!}
        </div>
        <div class="form-group">
            {!! Form::label('fManufacture','Food Manufacture') !!}
            {!! Form::text('fManufacture',null, [
                'class' => 'fManufacture form-control',
                'placeholder' => 'Food Manufacture',
                'autocomplete' => 'off',
                'required',
                'minlength' => '3',
            ]) !!}
        </div>
        
        <div class="selectIngredient">
        <div class="form-group" id="formIngredient">
            {!! Form::label('ingredient_list','Food Ingredient') !!}
            @if(isset($foodProduct))
                {!! Form::select('ingredient_list[]', $foodProduct->ingredient->lists('iName','id'), $selected, [
                    'class' => 'form-control ingredient',
                    'multiple' => 'multiple',
                    'required',
                    'data-parsley-mincheck'=>'3',
                    'data-parsley-errors-container' => "#formIngredient",
                    'data-parsley-class-handler' => '.selectIngredient'
                ]) !!}
            @else
                {!! Form::select('ingredient_list[]', array(), null, [
                    'class' => 'form-control ingredient',
                    'multiple' => 'multiple',
                    'required',
                    'data-parsley-mincheck'=>'3',
                    'data-parsley-errors-container' => "#formIngredient",
                    'data-parsley-class-handler' => '.selectIngredient'
                ]) !!}
            @endif
        </div>
        </div>
        <div>
            {!! Form::label('certificate','Halal Certificate') !!}
        </div>
        @if(isset($certificate))
            @foreach($certificate as $cert)
            <div class="row">
                <div class="col-lg-3 col-md-4">
                    <div class="form-group">
                        {!! Form::hidden('ucID[]',$cert->id) !!}
                        {!! Form::text('cCode[]',$cert->cCode, [
                            'class' => 'form-control form-code cCode', 
                            'placeholder' => 'Code'
                        ]) !!}
                    </div>
                </div>
                <div class="col-lg-2 col-md-3">
                    <div class="form-group">
                        {!! Form::text('cExpire[]', $cert->cExpire->format('m-d-Y'), [
                            'class'=>'form-control form-date cExpire',
                            'id' => 'certexp', 
                            'placeholder' => 'dd-mm-yyyy'
                        ]) !!}
                    </div>
                </div>
                <div class="col-lg-3 col-md-4">
                    <div class="form-group">
                        {!! Form::select('cStatus[]', array('Development','New','Renew'), $cert->cStatus, [
                            'class' => 'form-control select2 cStatus', 
                            'placeholder' => 'Status'
                        ]) !!}
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-xs-11">
                    <div class="form-group">
                        {!! Form::text('cOrganization[]', $cert->cOrganization, [
                            'class' => 'halalcertorg form-control cOrganization', 
                            'placeholder' => 'Halal Organization', 
                            'autocomplete' => 'off'
                        ]) !!}
                    </div>
                </div>
                <div class="col-lg-1 col-md-1 col-xs-1">
                    <a class="btn btn-danger" href="{{route('certificate.destroy', $cert->id)}}" data-method="delete" name="delete_item"><i class="fa fa-minus"></i></a>
                </div>
            </div>
            @endforeach
        @endif
        <div class="row">
            <div class="col-lg-3 col-md-4">
                <div class="form-group">
                    {!! Form::text('cCode[]',null, [
                        'class' => 'form-control form-code cCode', 
                        'placeholder' => 'Code'
                    ]) !!}
                </div>
            </div>
            <div class="col-lg-2 col-md-2">
                <div class="form-group">
                    {!! Form::text('cExpire[]', null, [
                        'class'=>'form-control form-date cExpire',
                        'id' => 'certexp', 
                        'placeholder' => 'dd-mm-yyyy'
                    ]) !!}
                </div>
            </div>
            <div class="col-lg-3 col-md-3">
                <div class="form-group">
                    {!! Form::select('cStatus[]', array('Development','New','Renew'), null, [
                        'class' => 'form-control select2 cStatus', 
                        'placeholder' => 'Status'
                    ]) !!}
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-xs-10">
                <div class="form-group">
                    {!! Form::text('cOrganization[]', null, [
                        'class' => 'halalcertorg form-control cOrganization', 
                        'placeholder' => 'Halal Organization', 
                        'autocomplete' => 'off'
                    ]) !!}
                </div>
            </div>
            <div class="col-lg-1 col-md-1 col-xs-1">
                <a class="btn btn-success add_certificate" href="#"><i class="fa fa-plus"></i></a>
            </div>
        </div>
        <div class="input_fields_wrap "></div>
        {!! Form::submit($SubmitButtonText, ['class' => 'btn btn-primary pull-right']) !!}
    </div>
    

