$( document ).ready(function() {
    // make the tables fancy
    $('#tblContacts').DataTable();
    $('#tblTags').DataTable();

    // make the tags field sortable
    $( ".taglist" ).sortable();
    $( ".taglist" ).disableSelection();

    // hide the empty tag divs 
    $('div.itemtags:empty').hide();
    //alert($('div.itemtags:empty').length);

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
// when a row is un-selected, it's contact id is removed from the hidden field array
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
$('.timeline-panel').on('click', function () {
    var a = $('#sItems').val().split(',');
    if ($(this).hasClass('itemselected')) {
        // when a timeline panel is un-selected, it's item id is removed from the hidden field array
        // then the row colour is toggled.
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

// this function stops the click event being propagated up to the timeline
// panel and toggling the itemselected when the user clicks on the remove X
$('.itemtag').on('click', (function(e) {
    e.stopPropagation();
}));

// this function removes this tag from an item via an AJAX call
$('.remove').on('click', (function(e) {
    var itemID = $(this).parents('.timeline-panel').attr('data-key');
    var tagID = $(this).parent().attr('data-key');
    $.ajax({
        type: 'post',
        url: '/removeItemTag',
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        // pass an array of the item ids to be tagged and the tag text
            data: {
            'itemID': itemID,
            'tagID': tagID
            },
            // expect an array back from the ajax call that has an array with the item ID
            // and for each item ID, has an array of the tags that should now be on that item.
            success: function(data) {
                if ((data.errors)) {
                    $('.error').removeClass('hidden');
                    $('.error').text(data.errors.name);
                } else {
                    $('.error').remove();
                    var itemID = data.itemID;
                    var tags = data.tags;
                    var displayItemTags = false;
                    //get the itemtags dom for the item
                    var itemTags = $('.timeline-panel[data-key='+itemID+']').find('.itemtags');
                    var newTagsHTML = ""
                    //clear the current tags that are currently showing
                    itemTags.html("").show(150);
                    // loop through the tags array

                    for (var i = 0; i < tags.length; i++) {
                        // for each tag create a div inside the selected item's itemtag field                                
                        newTagsHTML = newTagsHTML + "<span class='itemtag'>"+tags[i].name.en_nz+" <a href='' class='remove' tabindex='-1' title='Remove'><i class='fa fa-times'></i></a></span>";
                        var displayItemTags = true;
                    }
                    itemTags.append(newTagsHTML).show(150);                    
                    (displayItemTags) ? itemTags.show(150) : itemTags.hide(150);
                }
            }
        });
}));

// this function is triggered when the user clicks on a tag in the tag list.
// the tag is applied to the selected items via an ajax call.
// the tags on the select items are returned and the  page is updated.

//$('#tblTags tbody').on('click', 'tr', function () {
$('.taglist li').click(function () {
    var itemsToTag = $('.itemselected').toArray();
    var investigationID = $('#investigationID').val();
    // if there are some items selected
    if (itemsToTag.length > 0) {
        // get the text for the tag we are applying.
        var tagText = $(this).text();
        var itemsIDsToTag = [];
        $('.itemselected').each(function (index) {
            itemsIDsToTag[index] = $(this).attr('data-key');
        });
        $.ajax({
            type: 'post',
            url: '/updateItemTags',
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            // pass an array of the item ids to be tagged and the tag text
            data: {
                'investigationID': investigationID,
                'itemsIDsToTag': itemsIDsToTag,
                'tagText': tagText
            },
            // expect an array back from the ajax call that has an array with the item ID
            // and for each item ID, has an array of the tags that should now be on that item.
            success: function(data) {
                if ((data.errors)) {
                    $('.error').removeClass('hidden');
                    $('.error').text(data.errors.name);
                } else {
                    $('.error').remove();
                    var itemIDs = data.itemIDs;
                    var tags = data.tags;
                    var displayItemTags = false;
                    // loop through the ItemIDs array
                    for (var i = 0; i < itemIDs.length; i++) {
                        //get the itemtags dom for the item
                        var itemTags = $('.itemselected[data-key='+itemIDs[i]+']').find('.itemtags');
                        var newTagsHTML = ""
                        //clear the current tags that are currently
                        itemTags.html("").show(150);
                        // loop through the tags array
                        for (var j = 0; j < tags[i].length; j++) {
                            // for each tag create a div inside the selected item's itemtag field                                
                            newTagsHTML = newTagsHTML + "<span class='itemtag' data-key='"+tags[i][j].id+"'>"+tags[i][j].name.en_nz+" <a href='' class='remove' tabindex='-1' title='Remove'><i class='fa fa-times'></i></a></span>";
                            var displayItemTags = true;
                        }
                        itemTags.append(newTagsHTML).show(150);
                        //console.log(displayItemTags);
                        (displayItemTags) ? itemTags.show(150) : itemTags.hide(150);
                    }
                }
            }
        });
    } else {
        alert('You must select some items to tag before selecting the tags.');
    }
});

