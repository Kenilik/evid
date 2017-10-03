@extends('layouts.dashboard')

@section('page_heading','Investigations')

@section('section')

    <!-- /.row -->
    <div class="col-sm-12">
        <div class="row">

        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-9">
                @component('widgets.panel')
                    @slot('panelTitle', 'Active Investigations')
                    @slot('panelBody')
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Case</th>
                                    <th>Operation</th>
                                    <th>Description</th>
                                    <th>Last Edits</th>
                                    <th>Created</th>
                                    <th>Progress</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($invs as $inv)
                                <tr></a>
                                    <td><a href="{{ url ('/invs') }}/{{ $inv->id }}/items">{{ $inv->case_num }}</a></td>
                                    <td>{{ $inv->operation_name }}</td>
                                    <td>{{ $inv->description }}</td>
                                    <td>{{ $inv->updated_at }}</td>
                                    <td>{{ $inv->created_at }}</td>
                                    <td>@include('widgets.progress', array('class'=> '', 'value'=>'47'))</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                    @endslot
                @endcomponent
            </div>
            
            <!-- /.col-lg-8 -->

            <div class="col-lg-3">
                @component('widgets.panel')
                    @slot('panelTitle', 'Conversations')
                    @slot('panelBody')
                    @endslot
                @endcomponent

                @component('widgets.panel')
                    @slot('panelTitle', 'Search')
                    @slot('panelBody')
                    @endslot
                @endcomponent

                @component('widgets.panel')
                    @slot('panelTitle') Chat
                    @endslot
                    @slot('panelBody')
                    @endslot
                    @slot('panelFooter')
                    @endslot
                @endcomponent
            </div>
            <!-- /.col-lg-4 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.col-sm-12 -->

@endsection