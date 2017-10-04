/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId])
/******/ 			return installedModules[moduleId].exports;
/******/
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// identity function for calling harmony imports with the correct context
/******/ 	__webpack_require__.i = function(value) { return value; };
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, {
/******/ 				configurable: false,
/******/ 				enumerable: true,
/******/ 				get: getter
/******/ 			});
/******/ 		}
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "";
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 50);
/******/ })
/************************************************************************/
/******/ ({

/***/ 12:
/***/ (function(module, exports) {

$(document).ready(function () {
    // make the tables fancy
    $('#tblContacts').DataTable();
    $('#tblTags').DataTable();

    // hide the empty tag divs 
    $('div.itemtags:empty').hide();

    // apply any highlighting to the items
    performMark();
});

$("#tblDatasets > tbody > tr").click(function (event) {
    if ($(this).hasClass('success')) {
        // do nothing because user has clicked on a row that is already selected.
    } else {
        $(this).addClass('success').siblings().removeClass('success');
        $('#sDataset').val('' + $(this).attr('data-key') + '');
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
        done: function done() {
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
$('#tblContacts tbody').on('click', 'tr', function () {
    var a = $('#sContacts').val().split(',');
    if ($(this).hasClass('selected')) {
        var i = a.indexOf($(this).attr('data-key'));
        if (i > -1) {
            a.splice(i, 1);
        }
    } else {
        a.push($(this).attr('data-key'));
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
            a.splice(i, 1);
        }
    } else {
        a.push($(this).attr('data-key'));
    }
    $('#sItems').val(a.join());
    $(this).toggleClass('itemselected', 150);
});

/*
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

            //****************** this might be where the ajax call will go ***********************

            itags.text().length == 0 ? itags.hide(150) : itags.show(150);
        });
    } else {
        alert('You must select some items to tag before selecting the tags.');
    }
});

function toggleArrayItem(a, v) {
    var i = a.indexOf(v);
    if (i === -1) {
        a.push(v);
    } else {
        a.splice(i, 1);
    }
    return a;
}
*/
/***/ }),

/***/ 50:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(12);


/***/ })

/******/ });