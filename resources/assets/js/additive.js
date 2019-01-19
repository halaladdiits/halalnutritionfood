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
