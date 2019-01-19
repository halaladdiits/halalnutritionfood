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

//tabel user untuk profile
var foodProductTableAdminUser = $('#foodProduct-tableAdminUser').DataTable({
    processing : true,
    serverSide : true,
    pageLength : 10,
    ajax : laroute.route('api.foodproduct.datauser'),
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
$('#foodProduct-tableAdminUser tbody').on( 'click', 'button.view', function () {
    var id = foodProductTableAdminUser.row( $(this).parents('tr') ).id(); 
    window.location.href = laroute.route('foodproduct.show', { foodproduct: id});
});
$('#foodProduct-tableAdminUser tbody').on( 'click', 'button.edit', function () {
    var id = foodProductTableAdminUser.row( $(this).parents('tr') ).id(); 
    window.location.href = laroute.route('foodproduct.edit', { foodproduct: id});
});
$('#foodProduct-tableAdminUser tbody').on( 'click', 'button.verify', function () {
    var id = foodProductTableAdminUser.row( $(this).parents('tr') ).id();
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
$('#foodProduct-tableAdminUser tbody').on( 'click', 'button.delete', function () {
    var id = foodProductTableAdminUser.row( $(this).parents('tr') ).id(); 
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
