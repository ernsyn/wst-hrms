@extends('layouts.admin-base') 
@section('content')
<div id="page-add-leave-type" class="container">
    <div class="card mb-4">
        <form id="add-leave-type-form" data-parsley-validate>
            <div class="card-body">
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="code"><strong>Code*</strong></label>
                        <input id="code" type="text" class="form-control{{ $errors->has('code') ? ' is-invalid' : '' }}" placeholder="eg. ANNUAL"
                            name="code" value="{{ old('code') }}" readonly> @if ($errors->has('code'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('code') }}</strong>
                        </span> @endif
                    </div>
                    <div class="form-group col-md-9">
                        <label for="name"><strong>Name*</strong></label>
                        <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="eg. Annual Leave"
                            name="name" value="{{ old('name') }}" readonly> @if ($errors->has('name'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span> @endif
                    </div>
                </div>
                <div class="form-group">
                    <label for="description"><strong>Description*</strong></label>
                    <textarea class="form-control" id="description" name="description" rows="2" readonly></textarea>
                </div>

                <div id="section-rules" class="card mb-3">
                    <div class="card-header bg-primary text-white">
                        <strong>Rules</strong>
                    </div>
                    <div class="card-body">
                        <div id="leave-rules-list">
                            <div id="rule-leave-calculation" class="card rule-entry">
                                <div class="card-body">
                                    <h5 class="title text-primary">Leave Calculation</h5>
                                    <input type="number" name="id" hidden>
                                    <div class="form-check mt-2">
                                        <input class="form-check-input" type="checkbox" id="consecutive-input">
                                        <label class="form-check-label" for="consecutive-input">
                                            Consecutive
                                        </label>
                                    </div>
                                    <div class="form-check mt-2">
                                        <input class="form-check-input" type="checkbox" id="include-off-days">
                                        <label class="form-check-label" for="include-off-days">
                                            Include Holidays / Weekends / Off Days
                                        </label>
                                    </div>
                                </div>
                            </div>
                            {{-- INSERT RULES HERE --}}
                        </div>
                    </div>

                </div>

                <div class="card mb-3">
                    <div class="card-header bg-primary text-white">
                        <strong>Entitled Days</strong>
                        <button class="btn btn-primary btn-sm float-right dropdown-toggle" type="button" id="entitled-mode-dropdown" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <span id="selected-text">All Employees</span>
                            <span class="ml-2"><i class="fas fa-caret-down"></i></span>
                            <input type="text" hidden id="entitled-mode" name="entitled-mode" value="entitled-mode-all">
                        </button>
                        <div id="entitled-mode-options" class="dropdown-menu" aria-labelledby="entitled-mode-dropdown">
                            <button id="entitled-mode-all" class="dropdown-item" type="button">All Employees</button>
                            <button id="entitled-mode-by-grade" class="dropdown-item" type="button">By Employee Grade</button>
                        </div>
                    </div>
                    <div id="section-employee-mode-by-grade" class="card-body" hidden>
                        <div id="grade-group-list">
                            
                            {{-- INSERT GRADE GROUPS HERE --}}
                        </div>

                        <div class="row mt-2">
                            <div class="col">
                                <a role="button" id="add-grade-group-btn" class="float-right btn btn-primary text-white">
                                    <i class="fas fa-plus"></i> Add Group
                                </a>
                            </div>
                        </div>
                    </div>
                    <div id="section-employee-mode-all" class="section-entitlement-by-years card-body">

                        <div class="entitlement-by-years-entry default input-group">
                            <input type="text" name="min-years-input" class="min-years-input form-control text-white" value="Default" readonly>
                            <input type="number" name="entitled-days-input" class="entitled-days-input form-control" placeholder="Entitled Days">
                            <input type="number" name="id" hidden>
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fas fa-times"></i></span>
                            </div>
                        </div>
                        <div class="entitlement-by-years-list">

                        </div>



                        {{-- Button: Add --}}
                        <div class="row mt-2">
                            <div class="col">
                                <a role="button" class="add-entitlement-by-years-btn float-right btn btn-light">
                                    <i class="fas fa-plus"></i>
                                </a>

                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="card-footer">
                <button id="submit" type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
                <a role="button" class="btn btn-secondary" href="{{ URL::previous() }}">Cancel</a>
            </div>
        </form>
    </div>
</div>
{{-- TEMPLATES --}}
<div id="leave-type-rule-templates" hidden>
    {{-- RULE: Restrict: By Gender --}}
    <div id="rule-restrict-gender" class="card rule-entry mt-2">
        <div class="card-body">
            <input type="number" name="id" hidden> {{-- <a role="button" class="remove-rule float-right btn btn-danger text-white btn-sm">
                Remove
            </a> --}}
            <h5 class="title text-primary">Restrict: By Gender</h5>
            <input type="number" name="id" hidden>
            <div class="form-group">
                <label for="gender-input"><strong>Gender</strong></label>
                <select class="form-control" id="gender-input" name="gender">
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </select>
            </div>
        </div>
    </div>
    {{-- RULE: Can Carry Forward--}}
    <div id="rule-can-carry-forward" class="card rule-entry mt-2">
        <div class="card-body">
            <input type="number" name="id" hidden> {{-- <a role="button" class="remove-rule float-right btn btn-danger text-white btn-sm">
                Remove
            </a> --}}
            <h5 class="title text-primary">Can Carry Forward</h5>
            <div class="form-group">
                <label for="max-carry-forward-days"><strong>Max Carry Forward Days*</strong></label>
                <div class=" input-group">
                    <input id="max-carry-forward-days" name="max-carry-forward-days" type="number" class="form-control" placeholder="eg. 3">
                </div>
            </div>
            <div class="form-group">
                <label for="valid-until-end-month"><strong>Valid Until End Of*</strong></label>
                <select class="form-control" id="valid-until-end-month" name="valid-until-end-month">
                    <option value="1">January</option>
                    <option value="2">February</option>
                    <option value="3">March</option>
                    <option value="4">April</option>
                    <option value="5">May</option>
                    <option value="6">June</option>
                    <option value="7">July</option>
                    <option value="8">August</option>
                    <option value="9">September</option>
                    <option value="10">October</option>
                    <option value="11">November</option>
                    <option value="12">December</option>
                </select>
            </div>

        </div>
    </div>
    {{-- RULE: Multiple Approval Levels Required --}}
    <div id="rule-multiple-approval-levels-required" class="card rule-entry mt-2">
        <div class="card-body">
            <input type="number" name="id" hidden> {{-- <a role="button" class="remove-rule float-right btn btn-danger text-white btn-sm">
                Remove
            </a> --}}
            <h5 class="title text-primary">Multiple Approval Levels Required</h5>
        </div>
    </div>
</div>
<div id="leave-type-entitled-days-by-years-template" hidden>
    <div class="entitlement-by-years-entry input-group mt-2">
        <input type="number" name="min-years-input" class="min-years-input form-control text-white" placeholder="Minimum Years" min="1"
            max="50">
        <input type="number" name="entitled-days-input" class="entitled-days-input form-control" placeholder="Entitled Days" min="1"
            max="100">
        <input type="number" name="id" hidden>
        <div class="remove-entry input-group-append">
            <span class="input-group-text"><i class="fas fa-times"></i></span>
        </div>
    </div>
</div>
<div id="grade-group-entry-template" hidden>
    <div class="grade-group-entry card mt-2">
        <input type="number" name="id" hidden>
        <div class="card-header bg-light text-primary">
            <strong>Grade Group</strong>
            <a role="button" class="remove-grade-group-btn float-right btn btn-light btn-sm">
                        {{-- <i class="fas fa-plus"></i> --}}
                        Remove
                    </a>
        </div>
        <div class="card-body section-entitlement-by-years">
            <div class="form-group">
                <label for="grade-group-2"><strong>Grades*</strong></label>
                <select multiple name="grades" class="select-grades-dropdown form-control">
                    @foreach(App\EmployeeGrade::all() as $grade)
                    <option value={{ $grade->id }}>{{ $grade->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="entitlement-by-years-entry default input-group">
                <input type="text" name="min-years-input" class="min-years-input form-control text-white" value="Default" readonly>
                <input type="number" name="entitled-days-input" class="entitled-days-input form-control" placeholder="Entitled Days">
                <div class="input-group-append">
                    <span class="input-group-text"><i class="fas fa-times"></i></span>
                </div>
            </div>

            <div class="entitlement-by-years-list">

            </div>

            {{-- Button: Add --}}
            <div class="row mt-2">
                <div class="col">
                    <a role="button" class="add-entitlement-by-years-btn float-right btn btn-light">
                                <i class="fas fa-plus"></i>
                            </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
 
@section('scripts')
<script>
    $(function () {
        let leaveType = {!! json_encode($leave_type) !!};
        // SECTION: Init Edit Data
        (function () {
            console.log("Leave Type: ", leaveType);
            let form = $('#add-leave-type-form');
            form.find('#code').val(leaveType.code);
            form.find('#name').val(leaveType.name);
            form.find('#description').val(leaveType.description);

            let leaveRulesList = $('#leave-rules-list');
            let leaveRulesTemplates = $('#leave-type-rule-templates');
            if(leaveType.applied_rules) {
                for(let rule of leaveType.applied_rules) {
                    let configuration;
                    if(rule.configuration) {
                        configuration = JSON.parse(rule.configuration)
                        console.log("Rule configuration: ", configuration);
                    } 
                    switch(rule.rule) {
                        case 'leave_calculation': // rule-leave-calculation
                            let leaveCalculation = leaveRulesList.find('#rule-leave-calculation');
                            if(configuration.consecutive) {
                                leaveCalculation.find('#consecutive-input').prop("checked", true);
                            }

                            if(configuration.include_off_days) {
                                leaveCalculation.find('#include-off-days').prop("checked", true);
                            }
                        break;
                        case 'multiple_approval_levels_required': // 'rule-multiple-approval-levels-required':
                            let multipleApprovalLevelsReq = leaveRulesTemplates.find('#rule-multiple-approval-levels-required');
                            
                            multipleApprovalLevelsReq.find('input[name=id]').val(rule.id);
                            
                            multipleApprovalLevelsReq.appendTo('#leave-rules-list');
                        break;
                        case 'gender': // 'rule-restrict-gender':
                            let restrictByGender = leaveRulesTemplates.find('#rule-restrict-gender');
                            
                            restrictByGender.find('input[name=id]').val(rule.id);
                            restrictByGender.find('select[name=gender]').val(configuration.gender);
                            
                            restrictByGender.appendTo('#leave-rules-list');
                        break;
                        case 'can_carry_forward': //'rule-can-carry-forward':
                            let canCarryForward = leaveRulesTemplates.find('#rule-can-carry-forward');
                            
                            canCarryForward.find('input[name=id]').val(rule.id);
                            canCarryForward.find('input[name=max-carry-forward-days]').val(configuration.max_carry_forward_days);
                            canCarryForward.find('select[name=valid-until-end-month]').val(configuration.valid_till_end_month);
                            
                            canCarryForward.appendTo('#leave-rules-list');
                        break;
                    }
                }
            }

            if(leaveType.entitled_days) {
                // MODE: Entitled By Years
                let section = $('#section-employee-mode-all');
                
                section.find(".entitlement-by-years-entry.default").find('input[name=entitled-days-input]').val(leaveType.entitled_days);
                
                let list = section.find('.entitlement-by-years-list');
                if(leaveType.lt_conditional_entitlements) {
                    for(let conditionalEntitlement of leaveType.lt_conditional_entitlements) {
                        console.log("Conditional entitlement: ", conditionalEntitlement)
                        // Add conditional entitlement entry
                        let newEntry = $('#leave-type-entitled-days-by-years-template .entitlement-by-years-entry').clone();
                        newEntry.find('.remove-entry').click(function (removeEvent) {
                            $(removeEvent.target).closest('.entitlement-by-years-entry').remove();
                        });

                        newEntry.find('input[name=id]').val(conditionalEntitlement.id);
                        newEntry.find('input[name=min-years-input]').val(conditionalEntitlement.min_years);
                        newEntry.find('input[name=entitled-days-input]').val(conditionalEntitlement.entitled_days);

                        newEntry.appendTo(list);
                    }
                }
                
            } else {
                // MODE: Entitled By Grade
                $('#section-employee-mode-all').attr('hidden', true);
                $('#entitled-mode-dropdown #selected-text').text("By Employee Grade");   

                let section = $('#section-employee-mode-by-grade');
                section.removeAttr('hidden');

                let gradeGroupList = section.find('#grade-group-list');
                console.log('GG List ', gradeGroupList);
                if(leaveType.lt_entitlements_grade_groups) {
                    for(let gradeGroup of leaveType.lt_entitlements_grade_groups) {

                        let newGradeGroupEntry = $('#grade-group-entry-template .grade-group-entry').clone();
                        
                        newGradeGroupEntry.find('input[name=id]').val(gradeGroup.id);
                        
                        let section = newGradeGroupEntry.find('.section-entitlement-by-years');
                        let grades = [];
                        if(gradeGroup.grades) {
                            for(let grade of gradeGroup.grades) {
                                grades.push(grade.id);
                            }
                        }
                        section.find('select[name=grades]').val(grades);
                        section.find(".entitlement-by-years-entry.default").find('input[name=entitled-days-input]').val(gradeGroup.entitled_days);

                        // console.log("Default: ", section.find(".entitlement-by-years-entry.default").find('input[name=entitled-days-input]'));
                        let list = section.find('.entitlement-by-years-list');
                        if(gradeGroup.lt_conditional_entitlements) {
                            for(let conditionalEntitlement of gradeGroup.lt_conditional_entitlements) {
                                console.log("Conditional entitlement: ", conditionalEntitlement)
                                // Add conditional entitlement entry
                                let newEntry = $('#leave-type-entitled-days-by-years-template .entitlement-by-years-entry').clone();
                                newEntry.find('.remove-entry').click(function (removeEvent) {
                                    $(removeEvent.target).closest('.entitlement-by-years-entry').remove();
                                });

                                newEntry.find('input[name=id]').val(conditionalEntitlement.id);
                                newEntry.find('input[name=min-years-input]').val(conditionalEntitlement.min_years);
                                newEntry.find('input[name=entitled-days-input]').val(conditionalEntitlement.entitled_days);

                                newEntry.appendTo(list);
                            }
                        }
                       
                        newGradeGroupEntry.appendTo(gradeGroupList);
                    }
                }
                


            }
        })();

        // SECTION: Init Page Logic
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

        // $('#add-rule-dropdown a').click(function(e) {
        //     console.log('Clicked: ', e.target.id);
        //     switch(e.target.id) {
        //         // case 'rule-select-min-apply-days-before':
        //         // break;
        //         case 'rule-select-multiple-approval-levels-required':
        //             $('#leave-type-rule-templates #rule-multiple-approval-levels-required').appendTo('#leave-rules-list');
        //             $(e.target).attr('hidden', true);
        //             break;
        //         case 'rule-select-can-carry-forward':
        //             $('#leave-type-rule-templates #rule-can-carry-forward').appendTo('#leave-rules-list');
        //             $(e.target).attr('hidden', true);
        //             break;
        //         case 'rule-select-restrict-gender':
        //             $('#leave-type-rule-templates #rule-restrict-gender').appendTo('#leave-rules-list');
        //             $(e.target).attr('hidden', true);
        //             break;
        //     }
        // })

        // $('.remove-rule').click(function (e) {
        //     let parent = $(e.target).closest('.rule-entry');
        //     parent.appendTo('#leave-type-rule-templates');
        //     switch(parent.get(0).id) {
        //         // case 'rule-select-min-apply-days-before':
        //         // break;
        //         case 'rule-multiple-approval-levels-required':
        //             $('#rule-select-multiple-approval-levels-required').removeAttr('hidden');
        //         break;
        //         case 'rule-can-carry-forward':
        //             $('#rule-select-can-carry-forward').removeAttr('hidden');
        //             break;
        //         case 'rule-restrict-gender':
        //             $('#rule-select-restrict-gender').removeAttr('hidden');
        //             break;
        //     }
        // })

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
                url: "{{ route('admin.e-leave.configuration.leave-types.edit.post', ['id' => $leave_type->id ]) }}",
                type: 'POST',
                data: data,
                success: function(response) {
                    console.log("SUCCESS", response);
                    // window.location = '{{ route("admin.e-leave.configuration") }}'
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
    })

</script>
@append