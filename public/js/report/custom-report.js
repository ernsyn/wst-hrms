//global value
var employeeList=[];

// accordion fix
$('.port-item').click(function () {
    $('.form-collapse').collapse('hide');
})

$('#government-report-alert').delay(5000).fadeOut('slow');


$(document).ready(function(){
    $('.employee-selected').click(function() {
        //reset
        employeeList = [];
        $('.report-employees-table tbody').html('');
        $('.scroll-report').data('report-name','');
        $('.scroll-report').data('report-page',0);
        $(".employeeSidebarModal").modal('show');

        //set sidebar report name
        $('.scroll-report').data('report-name',$(this).data('report-name'));

        //load employee
        loadEmp($(this).data('report-name'),0);
    });


    $('.employee-all').click(function() {
        //reset
        employeeList = [];
        $('.scroll-report').data('report-name','');
        $('.scroll-report').data('report-page',0);
    });

    //scrollable
    $(".loading-span").hide();
    $('.scroll-report').scroll(function() {
        if($(this).scrollTop() + $(this).innerHeight() >= $(this)[0].scrollHeight) {
/*            alert("Report Name :" + $(this).data('report-name') +
                " | Page Num :" + $('.scroll-report').data('report-page') +
                " | Scroll Top :" + $(this).scrollTop() +
                " | inner height :" + $(this).innerHeight() +
                " | scroll height :" + $(this)[0].scrollHeight);*/
            loadEmp($(this).data('report-name'),$('.scroll-report').data('report-page'));
        } else {
            $(".loading-span").hide();
        }
    });

});

function loadEmp(reportName,$page){
    //alert(reportName);
    $(".loading-span").show();
    //set search data value
    $('.button-search-employee').data('report-name',reportName);

    var formName = "#"+reportName+"-form";
    var data = {
        reportName : reportName,
        selectYear : $(formName+" #selectYear").val(),
        selectPeriod : $(formName+" #selectPeriod").val(),
        selectOfficer : $(formName+" #selectOfficer").val(),
        selectCostCentres : $(formName+" #selectCostCentres").val(),
        selectDepartments : $(formName+" #selectDepartments").val(),
        selectBranches : $(formName+" #selectBranches").val(),
        selectPositions : $(formName+" #selectPositions").val(),
        page : $page
    };

    getEmployeeList(data);
}

function getEmployeeList(data){
    $.ajax({
        type: "GET",
        url: './government_report/employees',
        data:  data,
        contentType: false,
        success: function (data) {
            var row = [];
            data = JSON.parse(data);
            if(data == null || data == "null" || data.length == 0){
                row.push('<tr><td colspan="3" style="text-align: center;">No Data</td></tr>');
                $('.report-employees-table tbody').html(row.join(''));
                $('.loading-span').hide();
            }else {
                $.each(data, function (i, field) {
                    if (field != null && field.id != null) {
                            row.push('<tr>');
                            row.push('<td><input type="checkbox" name="employee_list_checkbox" value="' + field.id + '" onclick="javascript:toggleEmployeeList(this)"></td>');
                            row.push('<td>' + field.name + '</td>');
                            row.push('<td>' + field.ic_no + '</td>');
                            row.push('</tr>');
                    }
                });

                if($('.report-employees-table tbody tr').length > 0){
                    $('.report-employees-table tbody tr:last').after(row.join(''));
                }else {
                    $('.report-employees-table tbody').html(row.join(''));
                }

                //set page number
                var pageNum = $('.scroll-report').data('report-page');
                $('.scroll-report').data('report-page',pageNum + 1);

                //remove loading
                $(".loading-span").hide();
            }
        },
        error: function (xhr, status, error) {
            $('.loading-span').hide();
            alert(xhr.responseText);
        }
    });
}

function toggleEmployeeList(obj) {
    var isChecked = $(obj).is(':checked');
    if(isChecked) {
        //add
        employeeList.push(obj.value);
    }else {
        //remove
        if(employeeList.includes(obj.value)){
            employeeList.splice(employeeList.indexOf(obj.value),1);
        }
    }
}

function toggleSelectAllEmployee(obj){
    var isChecked = $(obj).is(':checked');
    if(isChecked) {
        $("input[name='employee_list_checkbox']").each( function () {
            employeeList.push($(this).val());
            $(this).prop('checked', true)
        });
    }else {
        $("input[name='employee_list_checkbox']").each( function () {
            if(employeeList.includes($(this).val())){
                employeeList.splice(employeeList.indexOf($(this).val()),1);
            }
            $(this).prop('checked', false)
        });
    }
}

$('.button-search-employee').click(function () {
    $('.loading-span').show();

    var reportName = $(this).data('report-name');
    var formName = "#"+reportName+"-form";
    var data = {
        reportName : reportName,
        selectYear : $(formName+" #selectYear").val(),
        selectPeriod : $(formName+" #selectPeriod").val(),
        selectOfficer : $(formName+" #selectOfficer").val(),
        selectCostCentres : $(formName+" #selectCostCentres").val(),
        selectDepartments : $(formName+" #selectDepartments").val(),
        selectBranches : $(formName+" #selectBranches").val(),
        selectPositions : $(formName+" #selectPositions").val(),
        searchEmployee : $(".search_employees").val(),
    };

    getEmployeeList(data);
})


//preset before submit execute
$('.generate-report-button').click(function () {
    if(employeeList.length > 0) {
        var reportName = $(this).data('report-name');
        var formName = "#" + reportName + "-form";
        $(formName + ' .hidden-employee-list').val(employeeList);
    }
})
