 <!--- Name Field --->
        <div class="form-group col-sm-4">
            {!! Form::label('title', 'Nombres:') !!}
            {!! Form::text('title', null, ['class' => 'form-control']) !!}
        </div>
        
 <!--- Name Field --->
        <div class="form-group col-sm-4">
            {!! Form::label('numero', 'Tiempo:') !!}
            {!! Form::text('numero', null, ['class' => 'form-control']) !!}
        </div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
</div>

