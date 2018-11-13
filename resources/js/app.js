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
import pdfMake from "pdfmake/build/pdfmake";
import pdfFonts from "pdfmake/build/vfs_fonts";
pdfMake.vfs = pdfFonts.pdfMake.vfs;
import 'datatables.net-buttons/js/buttons.colVis.js';
import 'datatables.net-buttons/js/buttons.print.js';
import 'datatables.net-buttons/js/buttons.flash.js';
import 'datatables.net-buttons/js/buttons.html5.js';

import 'parsleyjs';
import 'jquery-mousewheel';

import 'moment'
import Chart from 'chart.js';



import './datatables';
import './modal';

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

if (performance.navigation.type == 2) {
    location.reload(true);
}

$('#btn-toggle-menu').click(function () {
    $('#sidebar').toggleClass('fliph');
    $('.content').toggleClass('content-active');
});

// $(function() {
//     $(".card").fadeIn();
// })

$('.scrollable').mousewheel(function (e, delta) {
    this.scrollLeft -= (delta * 40);
    e.preventDefault();
});



$("#form_validate").parsley({
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

        var start = $("#startDate").datepicker("getDate");
        var end = $("#endDate").datepicker("getDate");
        var days = ((end - start) / (1000 * 60 * 60 * 24))+1;
        $( "span.totaldays").replaceWith( "<span class='totaldays'><b>"+days+"</b> days</span>" );
        $("#totalLeave").val(days);

        if(days>1)
        {
            $("#selectPeriod").hide();
        }
        else
        {
            $("#selectPeriod").show();
        }

    },
    onClose: function () {
        $(this).parsley().validate();
    }
});
//change day according to selected value
$('#type').on('change', function() {

    var txt = this.value;
    var obj = JSON.parse(txt);

    $( "div.leavedays" ).replaceWith( "<div class='leavedays col-sm-4'><b>"+ obj.balance +"</b> days available</span></div>" );
    $("#leaveTypeId").val(obj.id);
    $("#leaveBalance").val(obj.balance);
});

$("#leaveHalfDay").click(function(){  
        $( "span.totaldays").replaceWith( "<span class='totaldays'><b>0.5</b> days</span>" );
        $("#totalLeave").val(0.5);
});

$("#leaveFullDay").click(function(){  
    $( "span.totaldays").replaceWith( "<span class='totaldays'><b>1</b> days</span>" );
    $("#totalLeave").val(1);
});
$('#expiryDate').datepicker({
    altField: "#altexpiryDate",
    altFormat: 'yy-mm-dd',
    format: 'dd/mm/yy'
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
$('#expDate').datepicker({
    altField: "#altexpDate",
    altFormat: 'yy-mm-dd',
    format: 'dd/mm/yy'
});
$('#issueDate').datepicker({
    altField: "#altissueDate",
    altFormat: 'yy-mm-dd',
    format: 'dd/mm/yy'
});
$('#issuedDate').datepicker({
    altField: "#altissuedDate",
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


new Chart($("#myChart"), {
    type: 'bar',
    data: {
        labels: ["AL", "SL", "UL", "HL", "ML", "MTL"],
        datasets: [{
            label: '# of Votes',
            data: [12, 19, 3, 5, 2, 3],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        title: {
            display: true,
            text: 'Monthly Leave Statistics'
        },
        legend: {
            display: false
        }

    }
});

$('#updateCostCentre').click(function () {
    swal({
        title: 'Success!',
        text: 'Change has been saved.',
        type: 'success',
        confirmButtonText: 'Cool'
    })
});

$('#updateCostCentre').click(function () {
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


//update Team
$('#updateTeamPopup').on('show.bs.modal', function (event) {

    var button = $(event.relatedTarget)
    var id = button.data('team-id')
    var team_name = button.data('name')
    
    var modal = $(this)

    modal.find('.modal-body #team_id').val(id)
    modal.find('.modal-body #team_name').val(team_name)

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

$('#updateGradePopup').on('show.bs.modal', function (event) {

    var button = $(event.relatedTarget)
    var id = button.data('grade-id')
    var name = button.data('grade-name')


    var modal = $(this)

    modal.find('.modal-body #grade_id').val(id)
    modal.find('.modal-body #name').val(name)

})

$('#updatePositionPopup').on('show.bs.modal', function (event) {

    var button = $(event.relatedTarget)
    var id = button.data('position-id')
    var name = button.data('position-name')


    var modal = $(this)

    modal.find('.modal-body #position_id').val(id)
    modal.find('.modal-body #name').val(name)

})

//update department
$('#updateDepartmentPopup').on('show.bs.modal', function (event) {

    var button = $(event.relatedTarget)
    var id = button.data('department-id')
    var name = button.data('department-name')


    var modal = $(this)

    modal.find('.modal-body #department_id').val(id)
    modal.find('.modal-body #department_name').val(name)
})

$('#updateBranchPopup').on('show.bs.modal', function (event) {

    var button = $(event.relatedTarget)
    var id = button.data('branch-id')
    var name = button.data('branch-name')
    var city = button.data('branch-city')
    var country_code = button.data('branch-country-code')
    var contact_no_primary = button.data('branch-contact-no-primary')
    var state = button.data('branch-state')

    var zip_code = button.data('branch-zip-code')
    var contact_no_secondary = button.data('branch-contact-no-secondary')
    var address = button.data('branch-address')
    var fax_no = button.data('branch-fax-no')

    var modal = $(this)

    modal.find('.modal-body #branch_id').val(id)
    modal.find('.modal-body #name').val(name)
    modal.find('.modal-body #city').val(city)
    modal.find('.modal-body #country_code').val(country_code)
    modal.find('.modal-body #contact_no_primary').val(contact_no_primary)
    modal.find('.modal-body #state').val(state)

    modal.find('.modal-body #address').val(address)
    modal.find('.modal-body #zip_code').val(zip_code)
    modal.find('.modal-body #contact_no_secondary').val(contact_no_secondary)
    modal.find('.modal-body #fax_no').val(fax_no)
})

$('#updateCompanyPopup').on('show.bs.modal', function (event) {

    var button = $(event.relatedTarget)
    var id = button.data('company-id')
    var name = button.data('company-name')
    var description = button.data('company-description')
    var gst_no = button.data('company-gst-no')
    var tax_no = button.data('company-tax-no')

    var epf_no = button.data('company-epf-no')
    var socso_no = button.data('company-socso-no')
    var eis_no = button.data('company-eis-no')
  
    var url = button.data('company-url')
    var address = button.data('company-address')
    var code = button.data('company-code')
    var registration_no = button.data('company-registration-no')
    var phone = button.data('company-phone')
  


    var modal = $(this)

    modal.find('.modal-body #company_id').val(id)
    modal.find('.modal-body #name').val(name)

    modal.find('.modal-body #description').val(description)
    modal.find('.modal-body #gst_no').val(gst_no)
    modal.find('.modal-body #tax_no').val(tax_no)
    modal.find('.modal-body #epf_no').val(epf_no)

    modal.find('.modal-body #socso_no').val(socso_no)
    modal.find('.modal-body #eis_no').val(eis_no) 

    modal.find('.modal-body #code').val(code)
    modal.find('.modal-body #registration_no').val(registration_no)
    modal.find('.modal-body #url').val(url)
    modal.find('.modal-body #address').val(address)
    modal.find('.modal-body #phone').val(phone)

})

//approved leave
$('#approveLeaverequest').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget)
    var id = button.data('leaverequest-id')
    var modal = $(this)
    modal.find('.modal-body #req_id').val(id)
})
$('#disapproveLeaverequest').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget)
    var id = button.data('leaverequest-id')
    var modal = $(this)
    modal.find('.modal-body #req_id').val(id)
})

//edit leave balance
$('#updateLeaveBalance').on('show.bs.modal', function (event) {

    var button = $(event.relatedTarget)
    var id = button.data('balance-id')
    var emp_id = button.data('balance-emp-id')
    var balance_leave = button.data('balance-leave')
    var carry = button.data('balance-carry')
    var type_id = button.data('balance-type-id')

    var modal = $(this)

    modal.find('.modal-body #balance_id').val(id)
    modal.find('.modal-body #users').val(emp_id)
    modal.find('.modal-body #leave_balance').val(balance_leave)
    modal.find('.modal-body #carry_forward').val(carry)
    modal.find('.modal-body #types').val(type_id)

})


//update company
$('#editCompanyBankPopup').on('show.bs.modal', function (event) {

    var button = $(event.relatedTarget)
    var id = button.data('bank-id')
    var bank_code = button.data('bank-code')
    var account_name = button.data('bank-accout-name')
    var status = button.data('bank-status')

    var modal = $(this)

    modal.find('.modal-body #company_bank_id').val(id)
    modal.find('.modal-body #bank_list').val(bank_code)
    modal.find('.modal-body #account_name').val(account_name)
    modal.find('.modal-body #status').val(status)
})

//update company
$('#editSecurityGroupPopup').on('show.bs.modal', function (event) {

var button = $(event.relatedTarget)
var id = button.data('security-id')
var security_name = button.data('security-name')
var security_description = button.data('security-description')
var security_status = button.data('security-status')

var modal = $(this)

modal.find('.modal-body #security_group_id').val(id)
modal.find('.modal-body #name').val(security_name)
modal.find('.modal-body textarea#description').val(security_description)
modal.find('.modal-body #status').val(security_status)
})

//update addition
$('#editCompanyAdditionPopup').on('show.bs.modal', function (event) {

var button = $(event.relatedTarget)
var id = button.data('addition-id')    
var code = button.data('addition-code')
var name = button.data('addition-name')
var type = button.data('addition-type')    
var amount = button.data('addition-amount')
var statutory = button.data('addition-statutory')
var eaform = button.data('addition-eaform')
var status = button.data('addition-status')

var modal = $(this)

modal.find('.modal-body #company_addition_id').val(id)
modal.find('.modal-body #code').val(code)
modal.find('.modal-body #name').val(name)
modal.find('.modal-body #type').val(type)
modal.find('.modal-body #amount').val(amount)
modal.find('.modal-body #statutory').val(statutory)
modal.find('.modal-body #ea_form').val(eaform)
modal.find('.modal-body #status').val(status)
})

//update deduction
$('#editCompanyDeductionPopup').on('show.bs.modal', function (event) {

var button = $(event.relatedTarget)
var id = button.data('deduction-id')    
var code = button.data('deduction-code')
var name = button.data('deduction-name')
var type = button.data('deduction-type')    
var amount = button.data('deduction-amount')
var statutory = button.data('deduction-statutory')
var status = button.data('deduction-status')

var modal = $(this)

modal.find('.modal-body #company_deduction_id').val(id)
modal.find('.modal-body #code').val(code)
modal.find('.modal-body #name').val(name)
modal.find('.modal-body #type').val(type)
modal.find('.modal-body #amount').val(amount)
modal.find('.modal-body #statutory').val(statutory)
modal.find('.modal-body #status').val(status)
})


$('#check_cost_centre').change(function() {
    if(this.checked) {
        $('#cost_centre').prop('readonly', false);
    }
    else{
        $('#cost_centre').prop('readonly', true);
    }
});

$('#check_job_grade').change(function() {
    if(this.checked) {
        $('#job_grade').prop('readonly', false);
    }
    else{
        $('#job_grade').prop('readonly', true);
    }
});

