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