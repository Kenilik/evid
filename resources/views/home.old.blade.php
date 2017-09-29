@extends('layouts.dashboard')

@section('page_heading','Dashboard')

@section('section')
    
    <!-- /.row -->
    <div class="col-sm-12">
        <div class="row">
        </div> 
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-8">
                @component('widgets.panel')
                    @slot('panelTitle', 'Conversation Timeline')
                    @slot('panelBody')
                        {{ $items->links() }}
                        <ul class="timeline">
                            @foreach($items as $item)
                                @if ($item->is_init_by_target === 0)
                                    <li>
                                @else
                                    <li class="timeline-inverted"> 
                                @endif
                                    <div class="timeline-panel">
                                        <div class="timeline-heading">
                                            <h4 class="timeline-title">From: {{ $item->from_num }} To: {{ $item->to_num }}</h4>
                                            <p>
                                            <small class="text-muted"><i class="fa fa-clock-o"></i>
                                                {{ $item->date_time }}
                                            </small>
                                            </p>
                                        </div>
                                        <div class="timeline-body">
                                            <pre>{{ $item->text_content}}</pre>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @endslot
                @endcomponent
                {{ $items->links() }}
            </div>
            
            <!-- /.col-lg-8 -->
            <div class="col-lg-4">
                {{ Form::open(array('route' => array('searchInvItems', $investigation), 'class' => 'form-horizontal', 'method' => 'GET')) }}
                    @component('widgets.panel')
                        @slot('panelBody')
                            <div class="input-group custom-search-form">
                                {{ Form::text('sText', $sCriteria['sText'], array('class' => 'form-control', 'placeholder' => 'Search text...'))}}
                                <span class="input-group-btn">
                                    {{ Form::button('<i class="fa fa-search"></i>', ['class' => 'btn btn-default', 'type' => 'submit']) }}
                                </span>
                            </div>
                        @endslot
                    @endcomponent

                    @component('widgets.panel')
                        @slot('panelTitle', 'Keywords')
                        @slot('panelBody')
                            <div class="input-group custom-search-form">
                                {{ Form::text('sKeywords', $sCriteria['sKeywords'], array('name' => 'keyword', 'class' => 'form-control', 'placeholder' => 'Highlight phrases...')) }}
                                <span class="input-group-btn">
                                    {{ Form::button('<i class="fa fa-times"></i>', ['class' => 'btn btn-default', 'type' => 'button', 'onclick' => 'performUnmark()']) }}
                                </span>
                            </div>
                        @endslot
                    @endcomponent

                    @component('widgets.panel')
                        @slot('panelTitle', 'Items')
                        @slot('panelBody')
                             <div class="input-group">
                                <label class="checkbox-inline">
                                    <input type="checkbox" name="sMsg" {{ $sCriteria['sMsg'] }} >Text Messages
                                </label>
                                <label class="checkbox-inline">
                                    <input type="checkbox" name="sCall" {{ $sCriteria['sCall'] }} >Phone Calls
                                </label>
                                <label class="checkbox-inline">
                                    <input type="checkbox" name="sTask" {{ $sCriteria['sTask'] }} >Tasks
                                </label>
                            </div>
                        @endslot
                    @endcomponent

                    @component('widgets.panel')
                        @slot('panelTitle', 'Dates')
                        @slot('panelBody')


                        @endslot
                    @endcomponent



                    @component('widgets.panel')
                        @slot('panelTitle', 'Contacts')

                        @slot('panelBody')
                            
                        @endslot
                    @endcomponent

                    @component('widgets.panel')
                        @slot('panelTitle', 'Tags')
                        @slot('panelBody')
                            
                        @endslot
                    @endcomponent

                    
                    @component('widgets.panel')
                        @slot('panelTitle', 'Datasets')
                        @slot('panelBody')
                            
                        @endslot
                    @endcomponent
                {{ Form::close() }}
            </div>
            <!-- /.col-lg-4 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.col-sm-12 -->
    <script>
        // Create an instance of mark.js and pass an argument containing
        // the DOM object of the context (where to search for matches)
        var markInstance = new Mark(document.querySelector(".timeline"));
        
        // Cache DOM elements
        var keywordInput = document.querySelector("input[name='keyword']");
        
        //var optionInputs = document.querySelectorAll("input[name='opt[]']");

        function performMark() {

        // Read the keyword
        var keyword = keywordInput.value;

        /* Determine selected options
        var options = {};
        [].forEach.call(optionInputs, function(opt) {
            options[opt.value] = opt.checked;
        });
        */
        
        // Remove previous marked elements and mark
        // the new keyword inside the context
        markInstance.unmark({
                done: function(){
                    markInstance.mark(keyword);
                }
            });
        };

         function performUnmark() {
            markInstance.unmark();
         };

        // Listen to input and option changes
        keywordInput.addEventListener("input", performMark);

    </script>

@endsection