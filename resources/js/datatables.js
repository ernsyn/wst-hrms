// Datatables Employee






// $('#leaveTypeTable').DataTable({
//     'bDestroy': true,
//     "bInfo": true,
//     "bDeferRender": true,
//     "serverSide": true,
//     "bStateSave": true,
//     "ajax":"leavetypedata",
//     "columns": [{
//         render: function render(data, type, row, meta) {
//             return meta.row + meta.settings._iDisplayStart + 1;
//         }
//     }, 
//     { "data": "code" }, 
//     { "data": "name" }, 
//     { "data": "apply_before_days" }, 
//     {
//         "data": null, // can be null or undefined
//         "defaultContent": '<div class="btn-group"><button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#exampleModal"><i class="far fa-edit"></i></button><button type="button" class="btn btn-danger btn-sm"><i class="far fa-trash-alt"></i></button></div>'
//     }]
// });
// $('#leaveTypeTable').DataTable();
// $('#leaveRequestTable').DataTable();
// $('#employeeDependentTable').DataTable();
// $('#employeeImmiTable').DataTable();



// $('#employeeReporttoTable').DataTable();
// $('#employeeHistoryTable').DataTable();

// Datatables Setup







$('#setupJobconfigureDeptTable').DataTable({
    responsive: true,
    stateSave: true,
    dom: "<'row d-flex'<'col'l><'col d-flex justify-content-end'f><'col-auto d-flex justify-content-end'B>>" +
        "<'row'<'col-md-6'><'col-md-6'>>" +
        "<'row'<'col-md-12't>><'row'<'col-md-12'ip>>",
    buttons: [{
            extend: 'copy',
            text: '<i class="fas fa-copy fa-fw"></i>',
            className: 'btn-outline-danger',
            titleAttr: 'Copy'
        },
        {
            extend: 'colvis',
            text: '<i class="fas fa-search fa-fw"></i>',
            className: 'clearfix btn-outline-primary rounded-0',
            titleAttr: 'Show/Hide Column'
        },
        {
            extend: 'csv',
            text: '<i class="fas fa-file-alt fa-fw"></i>',
            className: 'btn-outline-success',
            titleAttr: 'Export CSV'
        },
        {
            extend: 'print',
            text: '<i class="fas fa-print fa-fw"></i>',
            className: 'btn-outline-info',
            titleAttr: 'Print'
        },
    ]

});
$('#setupJobconfigureTeamTable').DataTable({
    responsive: true,
    stateSave: true,
    dom: "<'row d-flex'<'col'l><'col d-flex justify-content-end'f><'col-auto d-flex justify-content-end'B>>" +
        "<'row'<'col-md-6'><'col-md-6'>>" +
        "<'row'<'col-md-12't>><'row'<'col-md-12'ip>>",
    buttons: [{
            extend: 'copy',
            text: '<i class="fas fa-copy fa-fw"></i>',
            className: 'btn-outline-danger',
            titleAttr: 'Copy'
        },
        {
            extend: 'colvis',
            text: '<i class="fas fa-search fa-fw"></i>',
            className: 'clearfix btn-outline-primary rounded-0',
            titleAttr: 'Show/Hide Column'
        },
        {
            extend: 'csv',
            text: '<i class="fas fa-file-alt fa-fw"></i>',
            className: 'btn-outline-success',
            titleAttr: 'Export CSV'
        },
        {
            extend: 'print',
            text: '<i class="fas fa-print fa-fw"></i>',
            className: 'btn-outline-info',
            titleAttr: 'Print'
        },
    ]

});
$('#setupJobconfigurePositionTable').DataTable();
$('#setupJobconfigureGradeTable').DataTable();
$('#setupBranchTable').DataTable({
    responsive: true,
    stateSave: true,
    dom: "<'row d-flex'<'col'l><'col d-flex justify-content-end'f><'col-auto d-flex justify-content-end'B>>" +
        "<'row'<'col-md-6'><'col-md-6'>>" +
        "<'row'<'col-md-12't>><'row'<'col-md-12'ip>>",
    buttons: [{
            extend: 'copy',
            text: '<i class="fas fa-copy fa-fw"></i>',
            className: 'btn-outline-danger',
            titleAttr: 'Copy'
        },
        {
            extend: 'colvis',
            text: '<i class="fas fa-search fa-fw"></i>',
            className: 'clearfix btn-outline-primary rounded-0',
            titleAttr: 'Show/Hide Column'
        },
        {
            extend: 'csv',
            text: '<i class="fas fa-file-alt fa-fw"></i>',
            className: 'btn-outline-success',
            titleAttr: 'Export CSV'
        },
        {
            extend: 'print',
            text: '<i class="fas fa-print fa-fw"></i>',
            className: 'btn-outline-info',
            titleAttr: 'Print'
        },
    ]

});
$('#leaveBalanceTable').DataTable();