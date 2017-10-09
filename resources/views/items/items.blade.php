@extends('layouts.dashboard')

@section('page_heading','Investigation Items')

@section('section')
    
    <!-- /.row -->
    <div class="col-sm-12">
        <input id="investigationID" type="hidden" value="{{ $investigation->id }}">
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-7">
                @include('items.timeline')
            </div>           
            <!-- /.col-lg-7 -->
            <div class="col-lg-5">
                {{ Form::open(array('route' => array('items', $investigation), 'class' => 'form-horizontal', 'method' => 'GET')) }}
                    <p class="error text-center alert alert-danger hidden"></p>
                    @include('items.tags')
                    @include('items.search')
                    @include('items.keywords')
                    @include('items.itemtypes')
                    @include('items.dates')
                    @include('items.contacts')
                    @include('items.datasets')
                {{ Form::close() }}
            </div>
            <!-- /.col-lg-5 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.col-sm-12 -->
    <script type="text/javascript" src="{{ asset('js/items.js') }}"></script>

@endsection