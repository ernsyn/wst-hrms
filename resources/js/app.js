
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import './bootstrap';
import 'jquery-ui/ui/i18n/datepicker-en-GB.js';
import 'fullcalendar';

import 'datatables.net-bs4';
import 'datatables.net-buttons-bs4';
import 'datatables.net-responsive-bs4';

import 'datatables.net-buttons/js/buttons.colVis.js';
import 'datatables.net-buttons/js/buttons.print.js';
import 'datatables.net-buttons/js/buttons.flash.js';
import 'datatables.net-buttons/js/buttons.html5.js';

import swal from 'sweetalert2';
import 'parsleyjs';
import 'jquery-mousewheel';

// window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// Vue.component('example-component', require('./components/ExampleComponent.vue'));

// const app = new Vue({
//     el: '#app'
// });

if(performance.navigation.type == 2){
    location.reload(true);
}

$('.button-left').click(function(){
    $('#sidebar').toggleClass('fliph');
    $('.content').toggleClass('content-active');
});

$(".card").fadeIn();



$('.scrollable').mousewheel(function (e, delta) {
    this.scrollLeft -= (delta * 40);
    e.preventDefault();
});



$("#leaveform").parsley({
    errorClass: 'is-invalid',
    successClass: 'is-valid', // Comment this option if you don't want the field to become green when valid. Recommended in Google material design to prevent too many hints for user experience. Only report when a field is wrong.
    errorsWrapper: '<span class="form-text text-danger"></span>',
    errorTemplate: '<small class="font-italic"></small>',
    trigger: 'change'
});



// datepicker
var today = new Date(new Date().getFullYear(), new Date().getMonth(), new Date().getDate());

$("#startDate").datepicker({
    altField: "#altStart",
    altFormat: "yy-mm-dd",
    format: "dd/mm/yy",
    minDate: today,
    onSelect: function (selectedDate) {
        $("#endDate").datepicker("option", "minDate", selectedDate);
    },
    onClose: function () {
        $(this).parsley().validate();
    }
});
$('#endDate').datepicker({
    altField: "#altEnd",
    altFormat: 'yy-mm-dd',
    format: 'dd/mm/yy',
    minDate: today,
    onSelect: function (selectedDate) {
        $("#startDate").datepicker("option", "maxDate", selectedDate);
    },
    onClose: function () {
        $(this).parsley().validate();
    }
});
$('#dobDate').datepicker({
    altField: "#altdobDate",
    altFormat: 'yy-mm-dd',
    format: 'dd/mm/yy'
});
$('#editDobDate').datepicker({
    format: 'dd/mm/yyyy',
    uiLibrary: 'bootstrap4',
    iconsLibrary: 'fontawesome'
});
$('#licenseExpiryDate').datepicker({
    altField: "#altlicenseExpiryDate",
    altFormat: 'yy-mm-dd',
    format: 'dd/mm/yy'
});
$('#startYear').datepicker({
    changeMonth: true,
    changeYear: true,
    showButtonPanel: true,
    dateFormat: 'MM yy',
    onClose: function (dateText, inst) {
        var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
        var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
        $(this).datepicker('setDate', new Date(year, month, 1));
    }
});
$("#startYear").on('focus blur click', function () {
    $(".ui-datepicker-calendar").hide();
});
$('#endYear').datepicker({
    changeMonth: true,
    changeYear: true,
    showButtonPanel: true,
    dateFormat: 'MM yy',
    onClose: function (dateText, inst) {
        var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
        var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
        $(this).datepicker('setDate', new Date(year, month, 1));
    }
});
$("#endYear").on('focus blur click', function () {
    $(".ui-datepicker-calendar").hide();
});

// fullcalendar.io
$('#calendar').fullCalendar({
    // put your options and callbacks here
})

// Datatables Employee
$('#emergencyContactTable').DataTable({
    "bInfo": true,
    "bDeferRender": true,
    "serverSide": true,
    "bStateSave": true,
    "ajax": "emergencycontactdata",
    "columns": [
        {
            render: function (data, type, row, meta) {
                return meta.row + meta.settings._iDisplayStart + 1;
            }
        },
        { "data": "contact_name" },
        { "data": "relationship" },
        { "data": "contact_number" },
        {
            "data": null, // can be null or undefined
            "defaultContent": '<button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#emergencyModal"><i class="far fa-edit"></i></button>'
        }
    ]
});
$('#employeeDependentTable').DataTable({
    "bInfo": true,
    "bDeferRender": true,
    "serverSide": true,
    "bStateSave": true,
    "ajax": "dependentdata",
    "columns": [
        {
            render: function (data, type, row, meta) {
                return meta.row + meta.settings._iDisplayStart + 1;
            }
        },
        { "data": "dependent_name" },
        { "data": "dependent_relationship" },
        { "data": "date_of_birth" },
        {
            "data": null, // can be null or undefined
            "defaultContent": '<button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#dependentModal"><i class="far fa-edit"></i></button>'
        }
    ]
});
$('#employeeImmiTable').DataTable({
    "bInfo": true,
    "bDeferRender": true,
    "serverSide": true,
    "bStateSave": true,
    "ajax": "employeeimmigrationdata",
    "columns": [
        {
            render: function (data, type, row, meta) {
                return meta.row + meta.settings._iDisplayStart + 1;
            }
        },
        { "data": "document" },
        { "data": "passport_no" },
        { "data": "issued_by" },
        { "data": "issued_date" },
        { "data": "expiry_date" },
        {
            "data": null, // can be null or undefined
            "defaultContent": '<button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#immigrationModal"><i class="far fa-edit"></i></button>'
        }
    ]
});
$('#employeeVisaTable').DataTable({
    "bInfo": true,
    "bDeferRender": true,
    "serverSide": true,
    "bStateSave": true,
    "ajax": "employeevisadata",
    "columns": [
        {
            render: function (data, type, row, meta) {
                return meta.row + meta.settings._iDisplayStart + 1;
            }
        },
        { "data": "visa_number" },
        { "data": "family_members" },
        { "data": "issued_by" },
        { "data": "issued_date" },
        { "data": "expiry_date" },
        {
            "data": null, // can be null or undefined
            "defaultContent": '<button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#visaModal"><i class="far fa-edit"></i></button>'
        }
    ]
});
$('#employeeJobTable').DataTable({
    "bInfo": true,
    "bDeferRender": true,
    "serverSide": true,
    "bStateSave": true,
    "ajax": "bankdata",
    "columns": [
        {
            render: function (data, type, row, meta) {
                return meta.row + meta.settings._iDisplayStart + 1;
            }
        },
        { "data": "created_on" },
        { "data": "positionname" },
        { "data": "departname" },
        { "data": "teamname" },
        { "data": "categoryname" },
        { "data": "gradename" },
        { "data": "basic_salary" },
        { "data": "status" },
        {
            "data": null, // can be null or undefined
            "defaultContent": '<button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#jobModal"><i class="far fa-edit"></i></button>'
        }
    ]
});
$('#employeeBankTable').DataTable({
    "bInfo": true,
    "bDeferRender": true,
    "serverSide": true,
    "bStateSave": true,
    "ajax": "jobdata",
    "columns": [
        {
            render: function (data, type, row, meta) {
                return meta.row + meta.settings._iDisplayStart + 1;
            }
        },
        { "data": "bank_code" },
        { "data": "acc_no" },
        { "data": "status" },
        {
            "data": null, // can be null or undefined
            "defaultContent": '<button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#bankModal"><i class="far fa-edit"></i></button>'
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
$('#employeeImmiTable').DataTable();
$('#employeeQualCompanyTable').DataTable();
$('#employeeQualEduTable').DataTable();
$('#employeeQualSkillTable').DataTable();
$('#employeeAttachmentTable').DataTable();
$('#employeeReporttoTable').DataTable();
$('#employeeHistoryTable').DataTable();

// Datatables Setup
$('#setupCompanyTable').DataTable({
    responsive: true,
    stateSave:true,
    dom: "<'row d-flex'<'col'l><'col d-flex justify-content-end'f><'col-auto d-flex justify-content-end'B>>" +
    "<'row'<'col-md-6'><'col-md-6'>>" +
    "<'row'<'col-md-12't>><'row'<'col-md-12'ip>>",
    buttons: [
        {
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


$('#setupJobconfigureCostCentreTable').DataTable();
$('#setupJobconfigureDeptTable').DataTable();
$('#setupJobconfigureTeamTable').DataTable();
$('#setupJobconfigurePositionTable').DataTable();
$('#setupJobconfigureGradeTable').DataTable();
$('#setupBranchTable').DataTable();

//sweet alert2
$('#emergencyupdate').click(function () {
    swal({
        title: 'Success!',
        text: 'Change has been saved.',
        type: 'success',
        confirmButtonText: 'Cool'
    })
});

$('#dependentupdate').click(function () {
    swal({
        title: 'Success!',
        text: 'Change has been saved.',
        type: 'success',
        confirmButtonText: 'Cool'
    })
});

//update employee dependent
$('#updateDependentPopup').on('show.bs.modal', function (event) {

    var button = $(event.relatedTarget)
    var id = button.data('dependent-id')
    var name = button.data('dependent-name')
    var relationship = button.data('dependent-relationship')
    var dob = button.data('date-of-birth')

    var modal = $(this)

    modal.find('.modal-body #emp_dep_id').val(id)
    modal.find('.modal-body #name').val(name)
    modal.find('.modal-body #relationship').val(relationship)
    modal.find('.modal-body #dobDate').val(dob)

})
//update emergency contact
$('#updateContactPopup').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget)
    var id = button.data('contact-id')
    var name = button.data('contact-name')
    var relationship = button.data('contact-relationship')
    var contact_number = button.data('contact-number')

    var modal = $(this)

    modal.find('.modal-body #emp_con_id').val(id)
    modal.find('.modal-body #name').val(name)
    modal.find('.modal-body #relationship').val(relationship)
    modal.find('.modal-body #contact_number').val(contact_number)
})
//update employee immigration
$('#updateImmigrationPopup').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget)
    var id = button.data('immigration-id')
    var document = button.data('immigration-document')
    var passport_no = button.data('immigration-passport-no')
    var issued_by = button.data('immigration-issued-by')

    var modal = $(this)

    modal.find('.modal-body #img_id').val(id)
    modal.find('.modal-body #document').val(document)
    modal.find('.modal-body #passport_no').val(passport_no)
    modal.find('.modal-body #issued_by').val(issued_by)
})
//update employee visa
$('#updateVisaPopup').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget)
    var id = button.data('visa-id')
    var type = button.data('visa-type')
    var visa_number = button.data('visa-number')
    var family_members = button.data('visa-family-members')

    var modal = $(this)

    modal.find('.modal-body #visa_id').val(id)
    modal.find('.modal-body #type').val(type)
    modal.find('.modal-body #visa_number').val(visa_number)
    modal.find('.modal-body #family_members').val(family_members)
})
//update employee bank
$('#updateBankPopup').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget)
    var id = button.data('bank-id')
    var bank_code = button.data('bank-code')
    var acc_no = button.data('bank-acc-no')
    var acc_status = button.data('bank-acc-status')

    var modal = $(this)

    modal.find('.modal-body #bank_id').val(id)
    modal.find('.modal-body #bank_code').val(bank_code)
    modal.find('.modal-body #acc_no').val(acc_no)
    modal.find('.modal-body #acc_status').val(acc_status)
})

//update qualification experience
$('#updateCompanyPopup').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget)
    var id = button.data('company-id')
    var previous_company = button.data('company-previous-company')
    var previous_position = button.data('company-previous-position')
    var start_date = button.data('company-start-date')
    var end_date = button.data('company-end-date')
    var note = button.data('company-note')

    var modal = $(this)

    modal.find('.modal-body #comp_id').val(id)
    modal.find('.modal-body #previous_company').val(previous_company)
    modal.find('.modal-body #previous_position').val(previous_position)
    modal.find('.modal-body #start_date').val(start_date)
    modal.find('.modal-body #end_date').val(end_date)
    modal.find('.modal-body #note').val(note)
})

//update qualification education
$('#updateEducationPopup').on('show.bs.modal', function (event) {

    var button = $(event.relatedTarget)
    var id = button.data('education-id')
    var level = button.data('education-level')
    var major = button.data('education-major')
    var start_year = button.data('education-start-year')
    var end_year = button.data('education-end-year')
    var gpa = button.data('education-gpa')
    var school = button.data('education-school')
    var description = button.data('education-description')

    var modal = $(this)

    modal.find('.modal-body #edu_id').val(id)
    modal.find('.modal-body #level').val(level)
    modal.find('.modal-body #major').val(major)
    modal.find('.modal-body #start_year').val(start_year)
    modal.find('.modal-body #end_year').val(end_year)
    modal.find('.modal-body #gpa').val(gpa)
    modal.find('.modal-body #school').val(school)
    modal.find('.modal-body #description').val(description)
})

//update qualification skills
$('#updateSkillsPopup').on('show.bs.modal', function (event) {

    var button = $(event.relatedTarget)
    var id = button.data('skill-id')
    var emp_skill = button.data('skill-name')
    var year_experience = button.data('skill-experience')
    var competency = button.data('skill-competency')

    var modal = $(this)

    modal.find('.modal-body #skill_id').val(id)
    modal.find('.modal-body #emp_skill').val(emp_skill)
    modal.find('.modal-body #year_experience').val(year_experience)
    modal.find('.modal-body #competency').val(competency)
})

//update cost sentre
$('#updateCostCentrePopup').on('show.bs.modal', function (event) {

    var button = $(event.relatedTarget)
    var id = button.data('cost-centre-id')
    var category_name = button.data('cost-centre-name')
    var seniority_pay = button.data('cost-centre-seniority-pay')
    var payroll_type = button.data('cost-centre-payroll-type')

    var modal = $(this)

    modal.find('.modal-body #cost_id').val(id)
    modal.find('.modal-body #category_name').val(category_name)
    modal.find('.modal-body #seniority_pay').val(seniority_pay)
    modal.find('.modal-body #payroll_type').val(payroll_type)
})

