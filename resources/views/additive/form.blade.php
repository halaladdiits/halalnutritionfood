<div class="row">
    <div class="col-md-12">
        {!! Form::hidden('user_id', Auth::user()->id ) !!}
        <div class="form-group">
            {!! Form::label('iName','Additive Name') !!}
            {!! Form::text('iName',null, [
                'class' => 'form-control',
                'placeholder' => 'Additive Name',
                'required',
                'minlength' => '3',
                
            ])!!}
        </div>
        <div class="form-group">
            {!! Form::label('eNumber','E-Number') !!}
            {!! Form::text('eNumber',null, [
                'class' => 'form-control eNumber',
                'placeholder' => 'E-Number',
                'required',
            ])!!}
        </div>
        <div>
            {!! Form::label('halalStatus','Halal Status') !!}
        </div>
        @if(isset($halalSource))
            @foreach($halalSource as $halal)
                <div class="col-lg-4 col-md-6 col-xs-12">
                    <div class="col-md-12">
                        {!! Form::label('halalSource','Halal Source') !!}
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            {!! Form::hidden('uhID[]',$halal->id) !!}
                            {!! Form::text('hOrganization[]', $halal->hOrganization, [
                                'class' => 'hOrganization form-control',
                                'placeholder' => 'Halal Organization',
                                'autocomplete' => 'off',
                                'minlength' => '3',
                            ]) !!}
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            {!! Form::select('hStatus[]', array('Halal','Masbooh','Haram'), $halal->hStatus, [
                                'class' => 'hStatus select2 form-control',
                                'placeholder' => 'Halal Status'
                            ]) !!}
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            {!! Form::textarea('hDescription[]', $halal->hDescription, [
                                'class' => 'hDescription form-control',
                                'placeholder' => 'Enter description here',
                                'rows' => '10', 'cols' => '3',
                                'data-parsley-trigger' => 'keyup',
                                'data-parsley-minlength' => '20',
                                'data-parsley-validation-threshold' => '10',
                            ]) !!}
                        </div>
                    </div>
                    <div class="col-lg-10 col-md-10 col-xs-10">
                        <div class="form-group">
                            {!! Form::url('hUrl[]', $halal->hUrl, [
                                'class' => 'hUrl form-control',
                                'placeholder' => 'Put URL here']) !!}
                        </div>
                    </div>
                    <div class="col-md-1">
                        <a class="btn btn-danger" href="{{route('halalSource.destroy', $halal->id)}}" data-method="delete" name="delete_item"><i class="fa fa-minus"></i></a>
                    </div>
                </div>
            @endforeach
        @endif
        <div class="col-lg-4 col-md-6 col-xs-12">
            <div class="col-md-12">
                {!! Form::label('halalSource','Halal Source') !!}
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    {!! Form::text('hOrganization[]', null, [
                        'class' => 'hOrganization form-control',
                        'placeholder' => 'Halal Organization',
                        'autocomplete' => 'off',
                        'minlength' => '3',
                    ]) !!}
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    {!! Form::select('hStatus[]', array('Halal','Masbooh','Haram'), null, [
                        'class' => ' hStatus select2 form-control',
                        'placeholder' => 'Halal Status'
                    ]) !!}
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    {!! Form::textarea('hDescription[]', null, [
                        'class' => 'hDescription form-control',
                        'placeholder' => 'Enter description here',
                        'rows' => '10', 'cols' => '3',
                        'data-parsley-trigger' => 'keyup',
                        'data-parsley-minlength' => '20',
                        'data-parsley-validation-threshold' => '10',
                    ]) !!}
                </div>
            </div>
            <div class="col-lg-10 col-md-10 col-xs-10">
                <div class="form-group">
                    {!! Form::url('hUrl[]', null, [
                        'class' => 'hUrl form-control',
                        'placeholder' => 'Put URL here']) !!}
                </div>
            </div>
            <div class="col-md-1">
                <a class="btn btn-success add_source" href="#"><i class="fa fa-plus"></i></a>
            </div>
        </div>
        <div class="input_fields_wrap "></div>
    </div>
</div>
{!! Form::submit($SubmitButtonText, ['class' => 'btn btn-primary pull-right']) !!}
