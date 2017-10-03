@component('widgets.panel')
    @slot('panelTitle', 'Keywords')
    @slot('panelBody')
        <div class="input-group custom-search-form">
            {{ Form::text('sKeywords', $aCriteria['sKeywords'], array('name' => 'sKeywords', 'class' => 'form-control', 'placeholder' => 'Highlight phrases...')) }}
            <span class="input-group-btn">
                {{ Form::button('<i class="fa fa-times"></i>', ['class' => 'btn btn-default', 'type' => 'button', 'onclick' => 'performUnmark()']) }}
            </span>
        </div>
    @endslot
@endcomponent