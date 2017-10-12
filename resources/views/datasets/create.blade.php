@extends('layouts.dashboard')

@section('page_heading','Create New Dataset')

@section('section')

<div class="col-sm-12">
	<div class="row">
		
		<div class="col-lg-2"></div>
		<div class="col-lg-6">
			@include('layouts.errors')
			{{ Form::open(array('route' => array('dataset.store'), 'files' => true)) }}
			<div>
    		<div class="form-group">
        		{{ Form::hidden('investigation_id', $investigation_id, array('class' => 'form-control')) }}
    		</div>
			<div class="form-group">
				{{ Form::label('description', 'Description') }}
				{{ Form::text('description', "", array('class' => 'form-control')) }}
			</div>
			<div class="form-group">
				{{ Form::label('target_name', 'Target Name') }}
				{{ Form::text('target_name', "", array('class' => 'form-control')) }}
			</div>
			<div class="form-group">
				{{ Form::label('file_name', 'File Name') }}
				{{ Form::text('file_name', "", array('class' => 'form-control')) }}
			</div>
			<div class="form-group">
    			{{ Form::submit('Save', array('class' => 'btn btn-success')) }}	
    		</div>
			{{ Form::close() }}
		</div>
		<div class="col-lg-4"></div>
	</div>
</div>

@endsection