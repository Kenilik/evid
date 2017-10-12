@extends('layouts.dashboard')

@section('page_heading','Edit Dataset')

@section('section')

<div class="col-sm-12">
	<div class="row">
		
		<div class="col-lg-2"></div>
		<div class="col-lg-6">
			@include('layouts.errors')
			{{ Form::model($dataset, array('route' => array('dataset.update', $dataset->id), 'method' => 'PUT' ,'files' => true)) }}
			<div>
			<div class="form-group">
        		{{ Form::label('id', 'ID') }}
        		{{ Form::text('id', Request::old('id'), array('class' => 'form-control')) }}
    		</div>
    		<div class="form-group">
        		{{ Form::label('investigation_id', 'Investigation ID') }}
        		{{ Form::text('investigation_id', Request::old('investigation_id'), array('class' => 'form-control')) }}
    		</div>
			<div class="form-group">
				{{ Form::label('description', 'Description') }}
				{{ Form::text('description', Request::old('description'), array('class' => 'form-control')) }}
			</div>
			<div class="form-group">
				{{ Form::label('target_num', 'Target Num') }}
				{{ Form::text('target_num', Request::old('target_num'), array('class' => 'form-control')) }}
			</div>
			<div class="form-group">
				{{ Form::label('target_name', 'Target Name') }}
				{{ Form::text('target_name', Request::old('target_name'), array('class' => 'form-control')) }}
			</div>
			<div class="form-group">
				{{ Form::label('file_name', 'File Name') }}
				{{ Form::text('file_name', Request::old('file_name'), array('class' => 'form-control')) }}
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