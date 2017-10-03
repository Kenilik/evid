@component('widgets.panel')
        @slot('panelTitle', 'Search Text')
        @slot('panelBody')
        <div class="input-group custom-search-form">
            {{ Form::text('sText', $aCriteria['sText'], array('class' => 'form-control', 'placeholder' => 'Search text...'))}}
            <span class="input-group-btn">
                {{ Form::button('<i class="fa fa-search"></i>', ['class' => 'btn btn-default', 'type' => 'submit']) }}
            </span>
        </div>
    @endslot
@endcomponent