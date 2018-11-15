// Datatables Employee
$('#emergencyContactTable').DataTable({
    "bInfo": true,
    "bDeferRender": true,
    "serverSide": true,
    "bStateSave": true,
    "ajax": "emergencycontact",
    "columns": [{
            render: function (data, type, row, meta) {
                return meta.row + meta.settings._iDisplayStart + 1;
            }
        },
        {
            "data": "name"
        },
        {
            "data": "relationship"
        },
        {
            "data": "contact_no"
        },
        {
            "data": function (data, type, dataToSet) {
                return '<button type="button" class="btn btn-success btn-sm" '+
                              'data-toggle="modal" class="btn btn-outline-primary waves-effect" '+
                              'data-contact-id="'+data.id+'" '+
                              'data-contact-name="'+data.name+'" '+              
                              'data-contact-relationship="'+data.relationship+'" '+
                              'data-contact-number="'+data.contact_no+'" '+
                              'data-target="#updateContactPopup">'+
                              '<i class="far fa-edit"></i></button>';
            }
        }
    ]
});
$('#dependentTable').DataTable({
    "bInfo": true,
    "bDeferRender": true,
    "serverSide": true,
    "bStateSave": true,
    "ajax": "dependent",
    "columns": [{
            render: function (data, type, row, meta) {
                return meta.row + meta.settings._iDisplayStart + 1;
            }
        },
        {
            "data": "name"
        },
        {
            "data": "relationship"
        },
        {
            "data": "dob"
        },
        {
            "data":function (data, type, dataToSet) {
                return '<button type="button" class="btn btn-success btn-sm" '+
                              'data-toggle="modal" class="btn btn-outline-primary waves-effect" '+
                              'data-dependent-id="'+data.id+'" '+
                              'data-dependent-name="'+data.name+'" '+              
                              'data-dependent-relationship="'+data.relationship+'" '+
                              'data-dependent-date-of-birth="'+data.dob+'" '+
                              'data-target="#updateDependentPopup">'+
                              '<i class="far fa-edit"></i></button>';
            }
        }
    ]
});
$('#employeeImmigrationTable').DataTable({
    "bInfo": true,
    "bDeferRender": true,
    "serverSide": true,
    "bStateSave": true,
    "ajax": "employeeimmigration",
    "columns": [{
            render: function (data, type, row, meta) {
                return meta.row + meta.settings._iDisplayStart + 1;
            }
        },
        {
            "data": "document_media_id"
        },
        {
            "data": "passport_no"
        },
        {
            "data": "issued_by"
        },
        {
            "data": "issued_date"
        },
        {
            "data": "expiry_date"
        },
        {
            "data": function (data, type, dataToSet) {
                return '<button type="button" class="btn btn-success btn-sm" '+
                              'data-toggle="modal" class="btn btn-outline-primary waves-effect" '+
                              'data-immigration-id="'+data.id+'" '+
                              'data-immigration-document="'+data.document_media_id+'" '+              
                              'data-immigration-passport-no="'+data.passport_no+'" '+
                              'data-immigration-issued-by="'+data.issued_by+'" '+
                              'data-immigration-issued-date="'+data.issued_date+'" '+
                              'data-immigration-expiry-date="'+data.expiry_date+'" '+
                              'data-target="#updateImmigrationPopup">'+
                              '<i class="far fa-edit"></i></button>';
            }
        }
    ]
});
$('#employeeVisaTable').DataTable({
    "bInfo": true,
    "bDeferRender": true,
    "serverSide": true,
    "bStateSave": true,
    "ajax": "employeevisa",
    "columns": [{
            render: function (data, type, row, meta) {
                return meta.row + meta.settings._iDisplayStart + 1;
            }
        },
        {
            "data": "type"
        },
        {
            "data": "visa_number"
        },
        {
            "data": "family_members"
        },
        {
            "data": "issued_date"
        },
        {
            "data": "expiry_date"
        },
        {
            "data": function (data, type, dataToSet) {
                return '<button type="button" class="btn btn-success btn-sm" '+
                              'data-toggle="modal" class="btn btn-outline-primary waves-effect" '+
                              'data-visa-id="'+data.id+'" '+
                              'data-visa-type="'+data.type+'" '+              
                              'data-visa-number="'+data.visa_number+'" '+
                              'data-visa-family-members="'+data.family_members+'" '+
                              'data-visa-issued-date="'+data.issued_date+'" '+
                              'data-visa-expiry-date="'+data.expiry_date+'" '+
                              'data-visa-issued-by="'+data.issued_by+'" '+
                              'data-target="#updateVisaPopup">'+
                              '<i class="far fa-edit"></i></button>';
            }
        }
    ]
});
$('#employeeJobTable').DataTable({
    "bInfo": true,
    "bDeferRender": true,
    "serverSide": true,
    "bStateSave": true,
    "ajax": "employeejob",
    "columns": [{
            render: function (data, type, row, meta) {
                return meta.row + meta.settings._iDisplayStart + 1;
            }
        },
        {
            "data": "start_date"
        },
        {
            "data": "position"
        },
        {
            "data": "department"
        },
        {
            "data": "team"
        },     
        {
            "data": "cost_centre"
        },       
        {
            "data": "grade"
        },  
        {
            "data": "basic_salary"
        },  
        {
            "data": "status"
        },  
        {
            "data": function (data, type, dataToSet) {
                return '<button type="button" class="btn btn-success btn-sm" '+
                              'data-toggle="modal" class="btn btn-outline-primary waves-effect" '+
                              'data-job-id="'+data.id+'" '+
                              'data-job-date="'+data.start_date+'" '+              
                              'data-job-position="'+data.position_id+'" '+
                              'data-job-department="'+data.depart_id+'" '+
                              'data-job-team="'+data.team_id+'" '+              
                              'data-job-cost="'+data.cost_id+'" '+
                              'data-job-grade="'+data.grade_id+'" '+
                              'data-job-salary="'+data.basic_salary+'" '+
                              'data-job-status="'+data.status+'" '+
                              'data-target="#updateJob">'+
                              '<i class="far fa-edit"></i></button>';
            }
        }
    ]
});
$('#employeeBankTable').DataTable({
    "bInfo": true,
    "bDeferRender": true,
    "serverSide": true,
    "bStateSave": true,
    "ajax": "employeebank",
    "columns": [{
            render: function (data, type, row, meta) {
                return meta.row + meta.settings._iDisplayStart + 1;
            }
        },
        {
            "data": "bank_code"
        },
        {
            "data": "acc_no"
        },
        {
            "data": "acc_status"
        },
        {
            "data": function (data, type, dataToSet) {
                return '<button type="button" class="btn btn-success btn-sm" '+
                              'data-toggle="modal" class="btn btn-outline-primary waves-effect" '+
                              'data-bank-id="'+data.id+'" '+
                              'data-bank-code="'+data.bank_code+'" '+              
                              'data-bank-acc-no="'+data.acc_no+'" '+
                              'data-bank-acc-status="'+data.acc_status+'" '+
                              'data-target="#updateBankPopup">'+
                              '<i class="far fa-edit"></i></button>';
            }
        }
    ]
});
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
$('#leaveTypeTable').DataTable();
$('#leaveRequestTable').DataTable();
$('#employeeDependentTable').DataTable();
// $('#employeeImmiTable').DataTable();
$('#employeeQualCompanyTable').DataTable({
    "bInfo": true,
    "bDeferRender": true,
    "serverSide": true,
    "bStateSave": true,
    "ajax": "employee_experience",
    "columns": [{
            render: function (data, type, row, meta) {
                return meta.row + meta.settings._iDisplayStart + 1;
            }
        },
        {
            "data": "company"
        },
        {
            "data": "position"
        },
        {
            "data": "start_date"
        },
        {
            "data": "end_date"
        },
        {
            "data": "notes"
        },
        {
            "data": function (data, type, dataToSet) {
                return '<button type="button" class="btn btn-success btn-sm" '+
                              'data-toggle="modal" class="btn btn-outline-primary waves-effect" '+
                              'data-company-id="'+data.id+'" '+
                              'data-company-previous-company="'+data.bank_code+'" '+              
                              'data-company-previous-position="'+data.acc_no+'" '+
                              'data-company-previous-acc-status="'+data.acc_status+'" '+
                              'data-target="#updateBankPopup">'+
                              '<i class="far fa-edit"></i></button>';
            }
        }
    ]
});
$('#employeeQualEduTable').DataTable({
    "bInfo": true,
    "bDeferRender": true,
    "serverSide": true,
    "bStateSave": true,
    "ajax": "employee_education",
    "columns": [{
            render: function (data, type, row, meta) {
                return meta.row + meta.settings._iDisplayStart + 1;
            }
        },
        {
            "data": "institution"
        },
        {
            "data": "start_year"
        },
        {
            "data": "end_year"
        },
        {
            "data": "level"
        },
        {
            "data": "major"
        },
        {
            "data": "gpa"
        },
        {
            "data": "description"
        },
        {
            "data": null, // can be null or undefined
            "defaultContent": '<button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#educationModal"><i class="far fa-edit"></i></button>'
        }
    ]
});
$('#employeeQualSkillTable').DataTable({
    "bInfo": true,
    "bDeferRender": true,
    "serverSide": true,
    "bStateSave": true,
    "ajax": "employee_skill",
    "columns": [{
            render: function (data, type, row, meta) {
                return meta.row + meta.settings._iDisplayStart + 1;
            }
        },
        {
            "data": "name"
        },
        {
            "data": "years_of_experience"
        },
        {
            "data": "competency"
        },
        {
            "data": null, // can be null or undefined
            "defaultContent": '<button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#skillModal"><i class="far fa-edit"></i></button>'
        }
    ]
});
$('#employeeAttachmentTable').DataTable({
    "bInfo": true,
    "bDeferRender": true,
    "serverSide": true,
    "bStateSave": true,
    "ajax": "attachment",
    "columns": [{
            render: function (data, type, row, meta) {
                return meta.row + meta.settings._iDisplayStart + 1;
            }
        },
        {
            "data": "name"
        },
        {
            "data": "notes"
        },
        {
            "data": "media_id"
        },
        {
            "data": null, // can be null or undefined
            "defaultContent": '<button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#skillAttachment"><i class="far fa-edit"></i></button>'
        }
    ]
});
$('#employeeReporttoTable').DataTable();
$('#employeeHistoryTable').DataTable();

// Datatables Setup
$('#setupCompanyTable').DataTable({
    responsive: true,
    stateSave: true,
    dom: "<'row d-flex'<'col'l><'col d-flex justify-content-end'f><'col-auto d-flex justify-content-end'B>>" +
        "<'row'<'col-md-6'><'col-md-6'>>" +
        "<'row'<'col-md-12't>><'row'<'col-md-12'ip>>",
    buttons: [{
            extend: 'copy',
            text: '<i class="fas fa-copy fa-fw"></i>',
            className: 'btn-outline-danger',
            titleAttr: 'Copy',
            exportOptions: {
                columns: ':visible'
            }
        },
        {
            extend: 'colvis',
            text: '<i class="fas fa-search fa-fw"></i>',
            className: 'clearfix btn-outline-primary rounded-0',
            titleAttr: 'Show/Hide Column',
            exportOptions: {
                columns: ':visible'
            }
        },
        {
            extend: 'csv',
            text: '<i class="fas fa-file-alt fa-fw"></i>',
            className: 'btn-outline-success',
            titleAttr: 'Export CSV',
            exportOptions: {
                columns: ':visible'
            }
        },
        {
            extend: 'pdfHtml5',
            download: 'open',
            exportOptions: {
                columns: ':visible'
            },
            text: '<i class="fas fa-file-pdf fa-fw"></i>',
            className: 'btn-outline-danger',
            titleAttr: 'Export PDF'
        },
        {
            extend: 'print',
            text: '<i class="fas fa-print fa-fw"></i>',
            className: 'btn-outline-info',
            titleAttr: 'Print',
            exportOptions: {
                columns: ':visible'
            }
        },
    ]

});


$('#setupJobconfigureCostCentreTable').DataTable({
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
    ],
    initComplete: function () {
        this.api().columns(1).every(function () {
            var that = this;
            $('div.dataTables_wrapper div.dataTables_filter input', this.footer()).on('keyup change', function () {
                if (that.search() !== this.value) {
                    that
                        .search(this.value)
                        .draw();
                }
            });
        });
    }
});



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
$('#setupUserTable').DataTable({
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