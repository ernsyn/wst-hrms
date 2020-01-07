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
    var payroll_type = button.data('cost-centre-payroll-type')

    var modal = $(this)

    modal.find('.modal-body #cost_id').val(id)
    modal.find('.modal-body #category_name').val(category_name)
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
    var registration_no = button.data('company-registration')
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
