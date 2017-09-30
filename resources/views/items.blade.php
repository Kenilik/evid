@extends('layouts.dashboard')

@section('page_heading','Investigation Items')

@section('section')
    
    <!-- /.row -->
    <div class="col-sm-12">
        <div class="row">
        </div> 
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-7">
                @component('widgets.panel')
                    @slot('panelTitle', 'Conversation Timeline')
                    @slot('panelBody')
                    <div style="text-align:center;">
                        {{ $items->links() }}
                        <input id="sItems" name="sItems" type="hidden">
                    </div>
                        <ul class="timeline">
                            @forelse($items as $item)
                                @if ($item->is_init_by_target == 0)
                                    <li>
                                @else
                                    <li class="timeline-inverted">
                                @endif
                                    @if ($item->item_type_id == 1)
                                        <div class="timeline-badge info"><i class="fa fa-comments-o"></i></div>
                                    @elseif ($item->item_type_id == 2)
                                        <div class="timeline-badge warning"><i class="fa fa-phone"></i></div>
                                    @endif
                                    <div class="timeline-panel" data-key="{{ $item->id }}">
                                        <div class="timeline-heading">
                                            <h4 class="timeline-title">From: {{ $item->from_contact['name'] }} To: {{ $item->to_contact['name'] }}</h4>
                                            <p>
                                                <small class="text-muted">From: {{ $item->from_contact['phone_num'] }} To: {{ $item->to_contact['phone_num'] }}
                                                    <i class="fa fa-clock-o"></i> {{ $item->date_time }}
                                                </small>
                                            </p>
                                        </div>
                                        <div class="timeline-body">
                                            @if ($item->item_type_id == 1)
                                                <msgtext>{{ $item->text_content }}</msgtext>
                                            @elseif ($item->item_type_id == 2)
                                                Call Duration: {{ gmdate("H:i:s", $item->call_duration) }} ({{ $item->call_duration }} seconds)
                                            @endif
                                            <div class="textarea itemtags" contenteditable="true" id="tags" name="tags"></div>
                                        </div>
                                    </div>
                                </li>
                            @empty
                                <p>There are no items to display. You need to import your data first.</p>
                            @endforelse
                        </ul>
                    @endslot
                @endcomponent
                {{ $items->links() }}
            </div>
            
            <!-- /.col-lg-8 -->
            <div class="col-lg-5">
                {{ Form::open(array('route' => array('items', $investigation), 'class' => 'form-horizontal', 'method' => 'GET')) }}
                    @component('widgets.panel')
                        @slot('panelBody')
                            <div class="input-group custom-search-form">
                                {{ Form::text('sText', $aCriteria['sText'], array('class' => 'form-control', 'placeholder' => 'Search text...'))}}
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
                                {{ Form::text('sKeywords', $aCriteria['sKeywords'], array('name' => 'sKeywords', 'class' => 'form-control', 'placeholder' => 'Highlight phrases...')) }}
                                <span class="input-group-btn">
                                    {{ Form::button('<i class="fa fa-times"></i>', ['class' => 'btn btn-default', 'type' => 'button', 'onclick' => 'performUnmark()']) }}
                                </span>
                            </div>
                        @endslot
                    @endcomponent

                    @component('widgets.panel')
                        @slot('panelTitle', 'Tags')
                        @slot('panelBody')
                            <table id="tblTags" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Tag</th>
                                        <th>Description</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr data-key="1">
                                        <td>Tag1</td>
                                        <td>Tag 1 Description</td>
                                    </tr>
                                    <tr data-key="2">
                                        <td>Tag2</td>
                                        <td>Tag 2 Description</td>
                                    </tr>
                                </tbody>
                            </table>

                        @endslot
                    @endcomponent

                    @component('widgets.panel')
                        @slot('panelTitle', 'Items')
                        @slot('panelBody')
                            <div class="input-group">
                                <label class="checkbox-inline">
                                    <input type="checkbox" name="sMsg" {{ $aCriteria['sMsg'] }} >Text Messages
                                </label>
                                <label class="checkbox-inline">
                                    <input type="checkbox" name="sCall" {{ $aCriteria['sCall'] }} >Phone Calls
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
                            <input id="sContacts" name="sContacts" type="hidden" value="{{ implode(',', $aCriteria['sContacts']) }}">
                            <table id="tblContacts" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Phone Num</th>
                                        <th>Name</th>
                                        <th>Msg Sent</th>
                                        <th>Msg Rec</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($contacts as $contact)
                                        <tr data-key="{{ $contact->id }}" 
                                                @if (in_array($contact->id, $aCriteria['sContacts']) == true)
                                                    class="selected"
                                                @endif
                                        >
                                            <td>{{ $contact->phone_num }}</td>
                                            <td>{{ $contact->name }}</td>
                                            <td>{{ $contact->from_items_count }}</td>
                                            <td>{{ $contact->to_items_count }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endslot
                    @endcomponent
                    
                    @component('widgets.panel')
                        @slot('panelTitle', 'Datasets')
                        @slot('panelBody')
                            <input id="sDataset" name="sDataset" type="hidden" value="{{ $aCriteria['sDataset'] }}">
                            <table id="tblDatasets" class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Description</th>
                                        <th>Target Number</th>
                                        <th>Target Name</th>
                                        <th>Imported</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($datasets as $dataset)
                                    <tr data-key="{{ $dataset['id'] }}" 
                                        @if ($aCriteria['sDataset'] == $dataset['id'])
                                            class="selected"
                                        @endif
                                    >
                                        <td>{{ $dataset['id'] }}</td>
                                        <td>{{ $dataset['description'] }}</td>
                                        <td>{{ $dataset['target_num'] }}</td>
                                        <td>{{ $dataset['target->name'] }}</td>
                                        <td>{{ $dataset['created_at'] }} </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endslot
                    @endcomponent
                {{ Form::close() }}
            </div>
            <!-- /.col-lg-4 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.col-sm-12 -->
    <script type="text/javascript">

        $( document ).ready(function() {
            // make the tables fancy
            $('#tblContacts').DataTable();
            $('#tblTags').DataTable();

            // hide the empty tag divs 
            $('div.itemtags:empty').hide();

            // apply any highlighting to the items
            performMark();

        });

        $("#tblDatasets > tbody > tr").click(function(event) {
            if ($(this).hasClass('success')) {
                // do nothing because user has clicked on a row that is already selected.
            } else {
                $(this).addClass('success').siblings().removeClass('success');
                $('#sDataset').val(''+$(this).attr('data-key')+'');
            }
        });

        // Create an instance of mark.js and pass an argument containing
        // the DOM object of the context (where to search for matches)

        var markInstance = new Mark(document.querySelectorAll("div.timeline-body"));
        
        // Cache DOM elements
        var keywordInput = document.querySelector("input[name='sKeywords']");
        
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


 
        // this function deals with multi select on the contacts table
        // when a row is selected, it's contact id (in the data-key attribute of the table row) is added to an array in a hidden field
        // when ar row is un-selected, it's contact id is removed from the hidden field array
        // then the row selection is toggled.
        $('#tblContacts tbody').on( 'click', 'tr', function () {
            var a = $('#sContacts').val().split(',');
            if ($(this).hasClass('selected')) {
                var i = a.indexOf($(this).attr('data-key'));
                if (i > -1) {
                    a.splice(i,1);
                }
            } else {
                a.push( $(this).attr('data-key') );
            }
            $('#sContacts').val(a.join());
            $(this).toggleClass('selected');
        });

        // this function deals with multi select on the timeline
        // when a timeline panel is selected, it's item id (in the data-key attribute) is added to an array in a hidden field
        // when a timeline panel is un-selected, it's item id is removed from the hidden field array
        // then the row colour is toggled.

        $('.timeline-panel').on('click', function () {
            var a = $('#sItems').val().split(',');
            if ($(this).hasClass('itemselected')) {
                var i = a.indexOf($(this).attr('data-key'));
                if (i > -1) {
                    a.splice(i,1);
                }
            } else {
                a.push( $(this).attr('data-key') );
            }
            $('#sItems').val(a.join());
            $(this).toggleClass('itemselected', 150);
        });

        $('#tblTags tbody').on( 'click', 'tr', function () {
            var itemsToTag = $('.itemselected').toArray();
            if (itemsToTag.length > 0) { //there are some items selected
                
                var tag = $(this).children('td:first').text();
                
                // for each selected item get the value of the textarea

                $('.itemselected').each(function(index) {
                    // get the item tags for this item selected and create an array 
                    var itags = $(this).find('.itemtags')
                    var a = itags.text().split(",");
                    a = toggleArrayItem(a, tag).sort();
                    // convert the array back to a string and put it back into the element
                    itags.text(a.join());
                    //****************** this is where the ajax call will go ***********************//

                    (itags.text().length == 0) ? itags.hide(150) : itags.show(150);
                });
                //$('.itemselected').removeClass('itemselected');
                //$('div.itemtags:empty').hide();
            } else {
                alert('You must select some items to tag before selecting the tags.');
            }
        });

        function toggleArrayItem(a, v) {
            var i = a.indexOf(v);
            if (i === -1) {
                a.push(v);
            } else {
                a.splice(i,1);
            }
            return a;
        }
            
    </script>

<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(".btnTagItems").click(function(e){
        e.preventDefault();
        var name = $("input[name=name]").val();
        var password = $("input[name=password]").val();
        var email = $("input[name=email]").val();
        $.ajax({
            type:'POST',
            url:'/ajaxRequest',
            data:{name:name, password:password, email:email},
            success:function(data){
                 alert(data.success);
           }
        });
    });
</script>

@endsection