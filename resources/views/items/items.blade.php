@extends('layouts.dashboard')

@section('page_heading','Investigation Items')

@section('section')
    
    <!-- /.row -->
    <div class="col-sm-12">
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

    <script type="text/javascript">

        $('#tblTags tbody').on('click', 'tr', function () {
            var itemsToTag = $('.itemselected').toArray();
            if (itemsToTag.length > 0) {
                //there are some items selected

                var tag = $(this).children('td:first').text();

                // for each selected item get the value of the textarea
                $('.itemselected').each(function (index) {

                    // get the item tags for this item selected and create an array 
                    var itags = $(this).find('.itemtags');

                    // get the value of the tags field. check if it has any content, if so turn it into an array, otherwise return an empty array
                    var a = [];
                    if (itags.text().length != 0) {
                        a = itags.text().split(",");
                    }

                    a = toggleArrayItem(a, tag).sort();

                    itags.text(a.join());

                    //****************** this might be where the ajax call will go ***********************//

                    itags.text().length == 0 ? itags.hide(150) : itags.show(150);
                });
            } else {
                alert('You must select some items to tag before selecting the tags.');
            }
        });
        /*
            $.ajax({
                type: 'post',
                url: '/updateTags',
                data: {
                    '_token': $('input[name=_token]').val(),
                    'items': $('input[name=items]').val(),
                    'tag': $('input[name=tag]').val()
                },
                success: function(data) {
                    if ((data.errors)) {
                        $('.error').removeClass('hidden');
                        $('.error').text(data.errors.name);
                    } else {
                        $('.error').remove();
                        $('#table').append("<tr class='item" + data.id + "'><td>" + data.id + "</td><td>" + data.name + "</td><td><button class='edit-modal btn btn-info' data-id='" + data.id + "' data-name='" + data.name + "'><span class='glyphicon glyphicon-edit'></span> Edit</button> <button class='delete-modal btn btn-danger' data-id='" + data.id + "' data-name='" + data.name + "'><span class='glyphicon glyphicon-trash'></span> Delete</button></td></tr>");
                    }
                },
            });
            $('#name').val('');            
        */
    </script>
@endsection