/**
 * Allows you to add data-method="METHOD to links to automatically inject a form
 * with the method on click
 *
 * Example: <a href="{{route('customers.destroy', $customer->id)}}" data-method="delete" name="delete_item">Delete</a>
 *
 * Injects a form with that's fired on click of the link with a DELETE request.
 * Good because you don't have to dirty your HTML with delete forms everywhere.
 */
function addDeleteForms() {
    $('[data-method]').append(function () {
            if (! $(this).find('form').length > 0)
                return "\n" +
                    "<form action='" + $(this).attr('href') + "' method='POST' name='delete_item' style='display:none'>\n" +
                    "   <input type='hidden' name='_method' value='" + $(this).attr('data-method') + "'>\n" +
                    "   <input type='hidden' name='_token' value='" + $('meta[name="_token"]').attr('content') + "'>\n" +
                    "</form>\n";
            else
                return "";
        })
        .removeAttr('href')
        .attr('style', 'cursor:pointer;')
        .attr('onclick', '$(this).find("form").submit();');
}

function addVerifyForms() {
    $('[data-method]').append(function () {
            if (! $(this).find('form').length > 0)
                return "\n" +
                    "<form action='" + $(this).attr('href') + "' method='POST' name='verify_item' style='display:none'>\n" +
                    "   <input type='hidden' name='_method' value='" + $(this).attr('data-method') + "'>\n" +
                    "   <input type='hidden' name='_token' value='" + $('meta[name="_token"]').attr('content') + "'>\n" +
                    "</form>\n";
            else
                return "";
        })
        .removeAttr('href')
        .attr('style', 'cursor:pointer;')
        .attr('onclick', '$(this).find("form").submit();');
}

/**
 * Place any jQuery/helper plugins in here.
 */
$(function() {
    /**
     * Place the CSRF token as a header on all pages for access in AJAX requests
     */
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });

    /**
     * Add the data-method="delete" forms to all delete links
     */
    addDeleteForms();
    addVerifyForms();
});


$('body').on('keydown', '.form-code', function (e) {
    // Allow: backspace, delete, tab, escape, and enter
    if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110]) !== -1 ||
        // Allow: Ctrl+A
        (e.keyCode == 65 && e.ctrlKey === true) ||
        // Allow: Ctrl+C
        (e.keyCode == 67 && e.ctrlKey === true) ||
        // Allow: Ctrl+X
        (e.keyCode == 88 && e.ctrlKey === true) ||
        // Allow: home, end, left, right
        (e.keyCode >= 35 && e.keyCode <= 39)) {
        // let it happen, don't do anything
        return;
    }
    // Ensure that it is a number and stop the keypress
    if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
        e.preventDefault();
    }
});
$('body').on('keydown', '.form-number', function (e) {
    // Allow: backspace, delete, tab, escape, enter and .
    if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
        // Allow: Ctrl+A
        (e.keyCode == 65 && e.ctrlKey === true) ||
        // Allow: Ctrl+C
        (e.keyCode == 67 && e.ctrlKey === true) ||
        // Allow: Ctrl+V
        (e.keyCode == 86 && e.ctrlKey === true) ||
        // Allow: Ctrl+X
        (e.keyCode == 88 && e.ctrlKey === true) ||
        // Allow: home, end, left, right
        (e.keyCode >= 35 && e.keyCode <= 39)) {
        // let it happen, don't do anything
        return;
    }
    // Ensure that it is a number and stop the keypress
    if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
        e.preventDefault();
    }
});

$(".form-date").inputmask("dd-mm-yyyy",{ "placeholder": "dd-mm-yyyy" });
$('.select2').select2({
    width: '100%',
    theme: "bootstrap",
});
$('.dataTable').DataTable();

$('.productName').select2({
    width: '100%',
    tokenSeparators: [","],
    theme: "bootstrap",
    placeholder: "Click here and start typing to search.",
    ajax: {
        url: laroute.route('api.foodproduct.list'),
        dataType: 'json',
        delay: 250,
        data: function (params) {
            return {
                q: params.term
            };
        },
        processResults: function (data) {
            return {
                results: data
            };
        },
        cache: true
    },
    minimumInputLength: 2
}).on("select2:select", function(e) {
    window.location.href = laroute.route('foodproduct.show', { foodproduct: e.params.data.id});
});
$('.additive').select2({
    width: '100%',
    tokenSeparators: [","],
    theme: "bootstrap",
    placeholder: "Click here and start typing to search.",
    ajax: {
        url: laroute.route('api.additive.list'),
        dataType: 'json',
        delay: 250,
        data: function (params) {
            return {
                q: params.term
            };
        },
        processResults: function (data) {
            return {
                results: data
            };
        },
        cache: true
    },
    minimumInputLength: 2
}).on("select2:select", function(e) {
    window.location.href = laroute.route('additive.show', { additive: e.params.data.id});
});

//Form
var add_form_max = 10;
var add_form_wrapper = $(".input_fields_wrap");
var add_certificate = $(".add_certificate");
var add_source = $(".add_source");

var x = 1;
$(add_certificate).click(function (e) {
    e.preventDefault();
    if (x < add_form_max) {
        x++;
        $(add_form_wrapper).append('<div class="row"><div class="col-lg-3 col-md-4"><div class="form-group"><input class="form-control form-code" placeholder="Code" name="cCode[]" type="text"></div></div><div class="col-lg-2 col-md-3"><div class="form-group"><input class="form-control form-date" id="certexp" placeholder="dd-mm-yyyy" name="cExpire[]" type="text"></div></div><div class="col-lg-3 col-md-4"><div class="form-group"><select class="form-control select3" placeholder="Status" name="cStatus[]"><option value="0">Development</option><option value="1">New</option><option value="2">Renew</option></select></div></div><div class="col-lg-3 col-md-4 col-xs-11"><div class="form-group"><input class="halalcertorg form-control" placeholder="Halal Organization" autocomplete="off" name="cOrganization[]" type="text"></div></div><div class="col-lg-1 col-md-1 col-xs-1"><a href="#" class="btn btn-danger remove_field"><i class="fa fa-minus"></i></a></div></div>');
        $(".form-date").inputmask("dd-mm-yyyy",{ "placeholder": "dd-mm-yyyy" });
        $('.select3').select2({
            width: '100%',
            theme: "bootstrap",
        });
        $('.halalcertorg').typeahead({
            ajax: {
                url: laroute.route('api.certOrg.list'),
                triggerLength: 3
            }
        });
    }
});
$(add_source).click(function (e) {
    e.preventDefault();
    if (x < add_form_max) {
        x++;
        $(add_form_wrapper).append('<div class="col-lg-4 col-md-6 col-xs-12"><div class="col-md-12"><label for="halalSource">Halal Source</label></div><div class="col-md-12"><div class="form-group"><input class="hOrganization form-control" placeholder="Halal Organization" name="hOrganization[]" type="text" autocomplete="off"></div></div><div class="col-md-12"><div class="form-group"><select class=" select3 form-control" placeholder="Halal Status" name="hStatus[]"><option value="0">Halal</option><option value="1">Masbooh</option><option value="2">Haram</option></select></div></div><div class="col-md-12"><div class="form-group"><textarea class="form-control" placeholder="Enter description here" rows="10" cols="3" name="hDescription[]"></textarea></div></div><div class="col-lg-10 col-md-10 col-xs-10"><div class="form-group"><input class="url form-control" placeholder="Put URL here" name="url[]" type="text"></div></div><div class="col-md-1"><a href="#" class="btn btn-danger remove_field"><i class="fa fa-minus"></i></a></div></div>');
        $('.hOrganization').typeahead({
            ajax: {
                url: laroute.route('api.halalOrg.list'),
                triggerLength: 3
            }
        });
        $('.select3').select2({
            width: '100%',
            theme: "bootstrap",
        });
        $(".url").inputmask({alias: 'url', greedy: false});
    }
});
$(add_form_wrapper).on("click", ".remove_field", function (e) {
    e.preventDefault();
    $(this).parent('div').parent('div').remove();
    x--;
});

//List
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
    }
});
var verifyStatus = function ( data, type, full, meta ) {
    var is_verified = data == true ? "<span class='label label-success'>Yes</span>" : "<span class='label label-danger'>No</span>";
    return is_verified;
}
//Tabel Admin
var foodProductTableAdmin = $('#foodProduct-tableAdmin').DataTable({
    processing : true,
    serverSide : true,
    pageLength : 10,
    ajax : laroute.route('api.foodproduct.data'),
    columns: [
        { data: 'fCode', name: 'fCode'},
        { data: 'fName', name: 'fName' },
        { data: 'fManufacture', name: 'fManufacture' },
        { data: 'fVerify', name: 'fVerify', render: verifyStatus },
        { data: null, name: 'action'}
    ],
    rowId: 'id',
    columnDefs : [ 
        {
            targets : -1,
            data : null,
            defaultContent : "<div class='action'>"+
            "<button class='btn btn-success btn-xs view'><i class='fa fa-eye'></i></button>"+
            "<button class='btn btn-info btn-xs edit'><i class='fa fa-pencil'></i></button>"+
            "<button name='verify_item' class='btn btn-primary btn-xs verify'><i class='fa fa-check'></i></button>"+
            "<button class='btn btn-danger btn-xs delete'><i class='fa fa-trash'></i></button>"+
            "</div>"
        } 
    ],
});
$('#foodProduct-tableAdmin tbody').on( 'click', 'button.view', function () {
    var id = foodProductTableAdmin.row( $(this).parents('tr') ).id(); 
    window.location.href = laroute.route('foodproduct.show', { foodproduct: id});
});
$('#foodProduct-tableAdmin tbody').on( 'click', 'button.edit', function () {
    var id = foodProductTableAdmin.row( $(this).parents('tr') ).id(); 
    window.location.href = laroute.route('foodproduct.edit', { foodproduct: id});
});
$('#foodProduct-tableAdmin tbody').on( 'click', 'button.verify', function () {
    var id = foodProductTableAdmin.row( $(this).parents('tr') ).id();
    $.ajax
    ({ 
        url: laroute.url('foodproduct/verify', [ id ]),
        _token: $('meta[name="_token"]').attr('content'),
        type: 'post',
        success: function(data) {
          // if(!data.error) window.location.href = laroute.route('foodproduct.index');
        }   
    });
    window.location.href = laroute.route('foodproduct.index');
});
$('#foodProduct-tableAdmin tbody').on( 'click', 'button.delete', function () {
    var id = foodProductTableAdmin.row( $(this).parents('tr') ).id(); 
    $.ajax
    ({ 
        url: laroute.url('foodproduct', [ id ]),
        _token: $('meta[name="_token"]').attr('content'),
        type: 'delete',
        success: function(data) {
          // if(!data.error) window.location.href = laroute.route('foodproduct.index');
        }   
    });
    window.location.href = laroute.route('foodproduct.index');
});
//Tabel User
var foodProductTable = $('#foodProduct-table').DataTable({
    processing : true,
    serverSide : true,
    pageLength : 10,
    ajax : laroute.route('api.foodproduct.data'),
    columns: [
        { data: 'fCode', name: 'fCode'},
        { data: 'fName', name: 'fName' },
        { data: 'fManufacture', name: 'fManufacture' },
    ],
    rowId: 'id'
});
$('#foodProduct-table tbody').on( 'click', 'tr', function () {
    var id = foodProductTable.row( this ).id();
    window.location.href = laroute.route('foodproduct.show', { foodproduct: id});
});
//Set plug in form
$('.fManufacture').typeahead({
    ajax: {
        url: laroute.route('api.manufacture.list'),
        triggerLength: 3
    }
});
$('.halalcertorg').typeahead({
    ajax: {
        url: laroute.route('api.certOrg.list'),
        triggerLength: 3
    }
});

$('.ingredient').select2({
    width: '100%',
    multiple: true,
    tags: true,
    theme: "bootstrap",
    tokenSeparators: [","],
    placeholder: "Click here and start typing to search.",
    minimumInputLength: 2,
    ajax: {
        url: laroute.route('api.ingredient.list'),
        dataType: 'json',
        delay: 250,
        data: function (params) {
            return {
                q: params.term,
            };
        },
        processResults: function (data) {
            return {
                results: data
            };
        },
        cache: true
    }
});

//List
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
    }
});
//Tabel Admin
var additiveTableAdmin = $('#additive-tableAdmin').DataTable({
    processing : true,
    serverSide : true,
    pageLength : 10,
    ajax : laroute.route('api.additive.data'),
    columns: [
        { data: 'eNumber', name: 'eNumber'},
        { data: 'iName', name: 'iName' },
        { data: null, name: 'action'}
    ],
    rowId: 'id',
    columnDefs : [ 
        {
            targets : -1,
            data : null,
            defaultContent : "<div class='action'>"+
            "<button class='btn btn-success btn-xs view'><i class='fa fa-eye'></i></button>"+
            "<button class='btn btn-info btn-xs edit'><i class='fa fa-pencil'></i></button>"+
            "<button class='btn btn-danger btn-xs delete'><i class='fa fa-trash'></i></button>"+
            "</div>"
        } 
    ],
});
$('#additive-tableAdmin tbody').on( 'click', 'button.view', function () {
    var id = additiveTableAdmin.row( $(this).parents('tr') ).id(); 
    window.location.href = laroute.route('additive.show', { additive: id});
});
$('#additive-tableAdmin tbody').on( 'click', 'button.edit', function () {
    var id = additiveTableAdmin.row( $(this).parents('tr') ).id(); 
    window.location.href = laroute.route('additive.edit', { additive: id});
});
$('#additive-tableAdmin tbody').on( 'click', 'button.delete', function () {
    var id = additiveTableAdmin.row( $(this).parents('tr') ).id(); 
    $.ajax
    ({ 
        url: laroute.url('additive', [ id ]),
        _token: $('meta[name="_token"]').attr('content'),
        type: 'delete',
        success: function(data) {
          // if(!data.error) window.location.href = laroute.route('additive.index');
        }   
    });
    window.location.href = laroute.route('additive.index');
});
// Tabel User
var additiveTable = $('#additive-table').DataTable({
    processing : true,
    serverSide : true,
    pageLength : 10,
    ajax : laroute.route('api.additive.data'),
    columns: [
        { data: 'eNumber', name: 'eNumber'},
        { data: 'iName', name: 'iName' }
    ],
    rowId: 'id'
});
$('#additive-table tbody').on( 'click', 'tr', function () {
    var id = additiveTable.row( this ).id();
    window.location.href = laroute.route('additive.show', { additive: id});
});
//Set plug in form
$(".eNumber").inputmask({mask: "E[9]{3,5}", greedy: false });
// $(".url").inputmask({alias: 'url', greedy: false});

$('.hOrganization').typeahead({
    ajax: {
        url: laroute.route('api.halalOrg.list'),
        triggerLength: 3
    }
});

//Angular JS Validation
var app = angular.module('validationApp', [],['$interpolateProvider', function($interpolateProvider) {
    $interpolateProvider.startSymbol('<%');
    $interpolateProvider.endSymbol('%>');
}]);
app.controller('foodProductValidate', ['$scope', function($scope) {
    $scope.submitForm = function() {
        if ($scope.userForm.$valid) {
        }
    };
    $scope.Math = window.Math;
    if (typeof foodProduct === "undefined") {
    }
    else{
        $scope.foodName = foodProduct['fName'];
        $scope.totalFat = foodProduct['totalFat'];
        $scope.saturatedFat = foodProduct['saturatedFat'];
        $scope.cholesterol = foodProduct['cholesterol'];
        $scope.sodium = foodProduct['sodium'];
        $scope.totalCarbohydrates = foodProduct['totalCarbohydrates'];
        $scope.dietaryFiber = foodProduct['dietaryFiber'];
    } 
}]);

//Parsley food product
if ($('#foodProductForm').length > 0 ){
    $("#foodProductForm").parsley({
        // successClass: "has-success",
        errorClass: "has-error",
        classHandler: function(el) {
            return el.$element.closest(".form-group");
        },
        errorsWrapper: "<span class='help-block'></span>",
        errorTemplate: "<span></span>"
    });
    $(".ingredient").on('change', function() {
        // $("#foodProductForm").parsley().validate();
    });
    $(".cCode, .cExpire, .cStatus, .cOrganization").on('change', function() {
        if ($(".cCode").val().length > 0 ||
            $(".cExpire").val().length > 0 ||
            $(".cStatus").val().length > 0 ||
            $(".cOrganization").val().length > 0)
        {
            $(".cCode, .cExpire, .cStatus, .cOrganization").attr("required", "required");
        } 
        else {
            $(".cCode, .cExpire, .cStatus, .cOrganization").removeAttr("required");
        }
        // $("#foodProductForm").parsley().validate();
    });
}
//Parsley addictive
if ($('#additiveForm').length > 0 ){
    $("#additiveForm").parsley({
        // successClass: "has-success",
        errorClass: "has-error",
        classHandler: function(el) {
            return el.$element.closest(".form-group");
        },
        errorsWrapper: "<span class='help-block'></span>",
        errorTemplate: "<span></span>"
    });
    $(".hOrganization, .hStatus, .hDescription, .hUrl").on('change', function() {
        if ($(".hOrganization").val().length > 0 ||
            $(".hStatus").val().length > 0 ||
            $(".hDescription").val().length > 0 ||
            $(".hUrl").val().length > 0)
        {
            $(".hOrganization, .hStatus, .hDescription, .hUrl").attr("required", "required");
        } 
        else {
            $(".hOrganization, .hStatus, .hDescription, .hUrl").removeAttr("required");
        }
        // $("#additiveForm").parsley().reset();
    });
}
if ($('.form-signin').length > 0 ){
    $(".form-signin").parsley({
        errorsWrapper: '<div></div>',
        errorTemplate: '<div class="alert alert-danger parsley" role="alert"></div>'
    });
}

//# sourceMappingURL=plugins.js.map
