@extends('layouts.admin-base')
@section('content')
<div id="page-add-leave-type" class="container">
    <div class="card mb-4">
        <h3>Coming Soon</h3>
    </div>
@endsection

@section('scripts')
<script>
    $(function () {
        $('#section-employee-mode-by-grade .select-grades-dropdown').multiselect({
            numberDisplayed: 0
        });

        $("#entitled-mode-options button").click(function (e) {
            $('#entitled-mode-dropdown #selected-text').html(e.target.innerText);
            $('#entitled-mode-dropdown').dropdown('toggle');
            $('input[name="entitled-mode"]').attr('value', e.target.id);
            switch (e.target.id) {
                case 'entitled-mode-all':
                    $('#section-employee-mode-all').removeAttr('hidden');
                    $('#section-employee-mode-by-grade').attr('hidden', true);
                    break;
                case 'entitled-mode-by-grade':
                    $('#section-employee-mode-all').attr('hidden', true);
                    $('#section-employee-mode-by-grade').removeAttr('hidden');
                    break;
            }



            return false;
        });

        $('#add-rule-dropdown a').click(function(e) {
            console.log('Clicked: ', e.target.id);
            switch(e.target.id) {
                // case 'rule-select-min-apply-days-before':
                // break;
                case 'rule-select-multiple-approval-levels-required':
                    $('#leave-type-rule-templates #rule-multiple-approval-levels-required').appendTo('#leave-rules-list');
                    $(e.target).attr('hidden', true);
                    break;
                case 'rule-select-can-carry-forward':
                    $('#leave-type-rule-templates #rule-can-carry-forward').appendTo('#leave-rules-list');
                    $(e.target).attr('hidden', true);
                    break;
                case 'rule-select-restrict-gender':
                    $('#leave-type-rule-templates #rule-restrict-gender').appendTo('#leave-rules-list');
                    $(e.target).attr('hidden', true);
                    break;
            }
        })

        $('.remove-rule').click(function (e) {
            let parent = $(e.target).closest('.rule-entry');
            parent.appendTo('#leave-type-rule-templates');
            switch(parent.get(0).id) {
                // case 'rule-select-min-apply-days-before':
                // break;
                case 'rule-multiple-approval-levels-required':
                    $('#rule-select-multiple-approval-levels-required').removeAttr('hidden');
                break;
                case 'rule-can-carry-forward':
                    $('#rule-select-can-carry-forward').removeAttr('hidden');
                    break;
                case 'rule-restrict-gender':
                    $('#rule-select-restrict-gender').removeAttr('hidden');
                    break;
            }
        })

        $('.add-entitlement-by-years-btn').click(function(e) {
            let list = $(e.target).closest('.section-entitlement-by-years').children('.entitlement-by-years-list').get(0);
            console.log("List: ", list)
            let newEntry = $('#leave-type-entitled-days-by-years-template .entitlement-by-years-entry').clone();
            
            newEntry.find('.remove-entry').click(function (removeEvent) {
                $(removeEvent.target).closest('.entitlement-by-years-entry').remove();
            })

            newEntry.appendTo(list);
        });

        $('#add-grade-group-btn').click(function(e) {
            let list = $(e.target).closest('#section-employee-mode-by-grade').children('#grade-group-list').get(0);
            // console.log("List: ", list);
            let newEntry = $('#grade-group-entry-template .grade-group-entry').clone();
            
            newEntry.find('.remove-grade-group-btn').click(function (removeEvent) {
                console.log('remove')
                $(removeEvent.target).closest('.grade-group-entry').remove();
            })

            newEntry.find('.select-grades-dropdown').multiselect({
                numberDisplayed: 0
            });

            newEntry.find('.add-entitlement-by-years-btn').click(function(e) {
                let list = $(e.target).closest('.section-entitlement-by-years').children('.entitlement-by-years-list').get(0);
                // console.log("List: ", list)
                let newEntry = $('#leave-type-entitled-days-by-years-template .entitlement-by-years-entry').clone();
                
                newEntry.find('.remove-entry').click(function (removeEvent) {
                    $(removeEvent.target).closest('.entitlement-by-years-entry').remove();
                })

                newEntry.appendTo(list);
            });

            newEntry.appendTo(list);
        })

        // POST Leave Type
        // TODO: Validation
        // $('#add-leave-type-form').submit(function (e) {
        $('#submit').click(function (e) {
            e.preventDefault();
            
            let form = $('#add-leave-type-form');
            console.log("FORM: ", form);
            let data = {
                code: form.find('#code').val(),
                name: form.find('#name').val(),
                description: form.find('#description').val(),
            }

            // SECTION: Entitled Days
            let entitledMode = $('#entitled-mode').val();
            console.log("Entitled Mode: ", entitledMode);
            switch(entitledMode) {
                case 'entitled-mode-all':
                    let allSection = form.find('#section-employee-mode-all');
                    console.log('SECTION: All');
                    data.entitled_days = allSection.find('.entitlement-by-years-entry.default .entitled-days-input').val();

                    let entitledDaysByYearsListData = [];
                    let entitledDaysByYearsList = allSection.find('.entitlement-by-years-list').children();
                    entitledDaysByYearsList.each(function (index, entitledDaysByYearsEntry) {
                        console.log(`Min Years: ${$(entitledDaysByYearsEntry).find('.min-years-input').val()}, Entitled Days: ${$(entitledDaysByYearsEntry).find('.entitled-days-input').val()}`);
                        entitledDaysByYearsListData.push({
                            min_years: $(entitledDaysByYearsEntry).find('.min-years-input').val(),
                            entitled_days: $(entitledDaysByYearsEntry).find('.entitled-days-input').val()
                        });
                    })
                    data.conditional_entitlements = entitledDaysByYearsListData;
                
                break;
                case 'entitled-mode-by-grade':
                    let byGradeSection = form.find('#section-employee-mode-by-grade');

                    let gradeGroupListData = [];
                    let gradeGroupList = byGradeSection.find('#grade-group-list').children();
                    gradeGroupList.each(function (index, gradeGroupEntryEl) {
                        let gradeGroup = {};

                        let gradeGroupEntry = $(gradeGroupEntryEl);

                        gradeGroup.grades = gradeGroupEntry.find('.select-grades-dropdown').val();
                        gradeGroup.entitled_days = gradeGroupEntry.find('.entitlement-by-years-entry.default .entitled-days-input').val();
                        console.log("Grade Group: ", gradeGroup.grades);

                        let entitledDaysByYearsListData = [];
                        let entitledDaysByYearsList = gradeGroupEntry.find('.entitlement-by-years-list').children();
                        entitledDaysByYearsList.each(function (index, entitledDaysByYearsEntry) {
                            console.log(`Min Years: ${$(entitledDaysByYearsEntry).find('.min-years-input').val()}, Entitled Days: ${$(entitledDaysByYearsEntry).find('.entitled-days-input').val()}`);
                            entitledDaysByYearsListData.push({
                                min_years: $(entitledDaysByYearsEntry).find('.min-years-input').val(),
                                entitled_days: $(entitledDaysByYearsEntry).find('.entitled-days-input').val()
                            });
                        })
                        gradeGroup.conditional_entitlements = entitledDaysByYearsListData;

                        gradeGroupListData.push(gradeGroup);
                    })
                    data.grade_groups = gradeGroupListData;

                break;
            }
            
            // SECTION: Rules
            let leaveRulesListData = [];
            let leaveRulesList = $('#leave-rules-list');
            console.log("Leave Rules List: ", leaveRulesList);
            leaveRulesList.children('.rule-entry').each(function (index, leaveRuleEl) {
                let leaveRule = $(leaveRuleEl);
                console.log('Leave Rule: ', leaveRuleEl.id);

                let ruleData = {};
                switch(leaveRuleEl.id) {
                    case 'rule-leave-calculation':
                        console.log("Leave Calculation: ", leaveRuleEl);
                        ruleData.rule = 'leave_calculation';
                        ruleData.configuration = {
                            consecutive: leaveRule.find('#consecutive-input').prop('checked'),
                            include_off_days: leaveRule.find('#include-off-days').prop('checked')
                        };
                    break;
                    case 'rule-multiple-approval-levels-required':
                        console.log("Multiple Approval Levels Required: ", leaveRuleEl);
                        ruleData.rule = 'multiple_approval_levels_required';
                    break;
                    case 'rule-restrict-gender':
                        console.log("Gender: ", leaveRuleEl);
                        ruleData.rule = 'gender';
                        ruleData.configuration = {
                            gender: leaveRule.find('#gender-input').val(),
                        };
                    break;
                    case 'rule-can-carry-forward':
                        console.log("Can Carry Forward: ", leaveRuleEl);
                        ruleData.rule = 'can_carry_forward';
                        ruleData.configuration = {
                            max_carry_forward_days: +(leaveRule.find('#max-carry-forward-days').val()),
                            valid_till_end_month: +(leaveRule.find('#valid-until-end-month').val()),
                        };
                    break;
                }

                leaveRulesListData.push(ruleData);
            })
            data.applied_rules = leaveRulesListData;

            console.log("Data: ", data);
            data._token = '{{ csrf_token() }}';
            $.ajax({
                url: "{{ route('admin.e-leave.configuration.leave-types.edit.post') }}",
                type: 'POST',
                data: data,
                success: function(response) {
                    console.log("SUCCESS", response);
                    window.location = '{{ route("admin.e-leave.configuration") }}'
                    // showAlert(data.success);
                    // emergencyContactsTable.ajax.reload();
                    // $('#confirm-delete-modal').modal('toggle');
                    // // clearEmergencyContactModal('#edit-emergency-contact-form');
                },
                error: function(xhr) {
                    if(xhr.status == 422) {
                        var errors = xhr.responseJSON.errors;
                        console.log("Error 422: ", xhr);
                        // for (var errorField in errors) {
                        //     if (errors.hasOwnProperty(errorField)) {
                        //         console.log("Error: ", errorField);
                        //         switch(errorField) {
                        //             case 'name':
                        //                 $('#edit-emergency-contact-form #name').addClass('is-invalid');
                        //                 $('#edit-emergency-contact-form #name-error').html('<strong>' + errors[errorField][0] + "</strong>");
                        //             break;
                        //             case 'relationship':
                        //                 $('#edit-emergency-contact-form #relationship').addClass('is-invalid');
                        //                 $('#edit-emergency-contact-form #relationship-error').html('<strong>' + errors[errorField][0] + "</strong>");
                        //             break;
                        //             case 'contact_no':
                        //                 $('#edit-emergency-contact-form #contact-no').addClass('is-invalid');
                        //                 $('#edit-emergency-contact-form #contact-no-error').html('<strong>' + errors[errorField][0] + '</strong>');
                        //             break;
                        //         }
                        //     }
                        // }
                    }
                    console.log("Error: ", xhr);
                }
            });
        })

        // SECTION: Init Edit Data
        let leaveType = {!! json_encode($leave_type) !!};
        console.log("Leave Type: ", leaveType);
        let form = $('#add-leave-type-form');
        form.find('#code').val(leaveType.code);
        form.find('#name').val(leaveType.name);
        form.find('#description').val(leaveType.description);

        let leaveRulesList = $('#leave-rules-list');
        if(leaveType.applied_rules) {
            for(let rule of leaveType.applied_rules) {
                switch(rule.rule) {
                    case 'leave_calculation': // rule-leave-calculation
                        let leaveCalculation = leaveRulesList.find('#rule-leave-calculation');
                        console.log('leave calc', leaveCalculation);

                        // ruleData.configuration = {
                        //     consecutive: leaveRule.find('#consecutive-input').prop('checked'),
                        //     include_off_days: leaveRule.find('#include-off-days').prop('checked')
                        // };
                    break;
                    case 'multiple_approval_levels_required': // 'rule-multiple-approval-levels-required':
                        let multipleApprovalLevelsReq = leaveRulesList.find('#rule-multiple-approval-levels-required');
                        multipleApprovalLevelsReq.appendTo('#leave-rules-list');
                        
                        // NEED TO SET ID
                        console.log("ID", multipleApprovalLevelsReq.find('input[name="id"]'))// .val(rule.id);
                        multipleApprovalLevelsReq.find('input[name=id]')// .val(rule.id);

                        console.log('multipleApprovalLevelsReq ', multipleApprovalLevelsReq);
                        // console.log("Multiple Approval Levels Required: ", leaveRuleEl);
                        // ruleData.rule = 'multiple_approval_levels_required';
                    break;
                    case 'gender': // 'rule-restrict-gender':
                        // console.log("Gender: ", leaveRuleEl);
                        // ruleData.rule = 'gender';
                        // ruleData.configuration = {
                        //     gender: leaveRule.find('#gender-input').val(),
                        // };
                    break;
                    case 'can_carry_forward': //'rule-can-carry-forward':
                        // console.log("Can Carry Forward: ", leaveRuleEl);
                        // ruleData.rule = 'can_carry_forward';
                        // ruleData.configuration = {
                        //     max_carry_forward_days: +(leaveRule.find('#max-carry-forward-days').val()),
                        //     valid_till_end_month: +(leaveRule.find('#valid-until-end-month').val()),
                        // };
                    break;
                }
            }
        }
    })

</script>
@append
