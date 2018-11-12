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

$('.button-left').click(function () {
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
