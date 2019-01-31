@extends('layouts.admin-base')
@section('content')
<div class="page-leave-type container">
                <div id="alert-container">
                    </div>  
    <div class="card mb-4">
        <form id="add-leave-type-form" data-parsley-validate>
            <div class="card-body">
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="code"><strong>Code*</strong></label>
                        <input id="code" type="text" class="form-control{{ $errors->has('code') ? ' is-invalid' : '' }}"
                            placeholder="eg. ANNUAL" name="code" value="{{ old('code') }}" oninput="this.value = this.value.toUpperCase()" required>
                        @if ($errors->has('code'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('code') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="form-group col-md-9">
                        <label for="name"><strong>Name*</strong></label>
                        <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                            placeholder="eg. Annual Leave" name="name" value="{{ old('name') }}" required>
                        @if ($errors->has('name'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <label for="description"><strong>Description*</strong></label>
                    <textarea class="form-control" id="description" name="description" rows="2" required></textarea>
                </div>

                <div id="section-rules" class="card mb-3">
                    <div class="card-header bg-primary text-white">
                        <strong>Rules</strong>
                        <a role="button" id="add-rule-btn" class="float-right btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-plus"></i>
                        </a>
                        <div id="add-rule-dropdown" class="dropdown-menu" aria-labelledby="add-rule-btn">
                                {{-- <a id="rule-select-min-apply-days-before" class="dropdown-item" href="#">Minimum Apply Days Before</a> --}}
                                <a id="rule-select-multiple-approval-levels-needed" class="dropdown-item" href="#"> Multiple Approval Levels Needed</a>
                                <a id="rule-select-can-carry-forward" class="dropdown-item" href="#">Can Carry Forward</a>
                                <a id="rule-select-restrict-gender" class="dropdown-item" href="#">Restrict: By Gender</a>
                                <a id="rule-select-required-attachment" class="dropdown-item" href="#">Required: Attachment</a>
                                <a id="rule-select-consecutive" class="dropdown-item" href="#">Consecutive Application</a>
                                <a id="rule-select-min-employment-period" class="dropdown-item" href="#">Required: Minimum Employment Period</a>
                                <a id="rule-select-max-no-of-children" class="dropdown-item" href="#">Max Number of Children</a>
                                <a id="rule-select-unpaid" class="dropdown-item" href="#">Unpaid Leave</a>
                                <a id="rule-select-employee-cannot-apply" class="dropdown-item" href="#">Employee Cannot Apply</a>
                                <a id="rule-select-inc-off-days" class="dropdown-item" href="#">Include Off Days</a>
                                <a id="rule-select-max-after-applied-days" class="dropdown-item" href="#">Only Allowed To Apply Maximum After Days</a>
                                <a id="rule-select-max-applications" class="dropdown-item" href="#">Maximum Applications</a>
                                <a id="rule-select-no-limit" class="dropdown-item" href="#">No Applied Days Limit</a>
                                <a id="rule-select-max-days-per-application" class="dropdown-item" href="#">Maximum Days Per Application</a>
                                <a id="rule-select-non-prorated" class="dropdown-item" href="#">Non-Prorated</a>
                                <a id="rule-select-min-apply-days-before" class="dropdown-item" href="#">Minimum Apply Days Before</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div id="leave-rules-list">
                            {{-- INSERT RULES HERE --}}
                        </div>
                    </div>

                </div>

                <div class="card mb-3">
                    <div class="card-header bg-primary text-white">
                        <strong>Entitled Days</strong>
                        <button class="btn btn-primary btn-sm float-right dropdown-toggle" type="button" id="entitled-mode-dropdown"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
                            <div class="grade-group-entry card mt-2">
                                <div class="card-header bg-light text-primary">
                                    <strong>Grade Group</strong>
                                    {{-- <a role="button" id="add-leave-type-btn" class="float-right btn btn-light btn-sm">
                                        <i class="fas fa-plus"></i>
                                    </a> --}}
                                </div>
                                <div class="card-body section-entitlement-by-years">
                                    <div class="form-group">
                                        <label for="grade-group-2"><strong>Grades*</strong></label>
                                        <select multiple class="form-control select-grades-dropdown" id="grade-group-2">
                                            @foreach(App\EmployeeGrade::all() as $grade)
                                        <option value={{ $grade->id }}>{{ $grade->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
    
                                    <div class="entitlement-by-years-entry default input-group">
                                        <input type="text" class="min-years-input form-control text-white" value="Default"
                                            readonly>
                                        <input type="number" class="entitled-days-input form-control" placeholder="Entitled Days">
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
                    {{-- <ul id="section-employee-mode-all" class="list-group list-group-flush">
                        <li class="entitlement-by-years-entry list-group-item">
                            <div class="row">
                                <div class="col-md-3 bg-primary">
                                    Default
                                </div>
                                <div class="col-md-9">
                                    10
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item">Dapibus ac facilisis in</li>
                        <li class="list-group-item bg-light">
                            <a role="button" id="add-leave-type-btn" class="float-right btn btn-light btn-sm">
                                <i class="fas fa-plus"></i>
                            </a>
                        </li>
                    </ul> --}}
                    <div id="section-employee-mode-all" class="section-entitlement-by-years card-body">

                        <div class="entitlement-by-years-entry default input-group">
                            <input type="text" class="min-years-input form-control text-white" value="Default" readonly>
                            <input type="number" class="entitled-days-input form-control" placeholder="Entitled Days">
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
                <a role="button" class="remove-rule float-right btn btn-danger text-white btn-sm">
                    Remove
                </a>
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
                <a role="button" class="remove-rule float-right btn btn-danger text-white btn-sm">
                    Remove
                </a>
                <input type="number" name="id" hidden> 
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
        {{-- RULE: Required: Attachment --}}
        <div id="rule-required-attachment" class="card rule-entry mt-2">
            <div class="card-body">
                <a role="button" class="remove-rule float-right btn btn-danger text-white btn-sm">
                    Remove
                </a>
                <input type="number" name="id" hidden> 
                <h5 class="title text-primary">Required: Attachment</h5>
                <div class="form-group">
                    <label for="attachment-type"><strong>Attachment Type*</strong></label>
                    <div class=" input-group">
                        <input id="attachment-type" name="attachment-type" type="text" class="form-control" placeholder="eg. Medical Certificate">
                    </div>
                </div>
            </div>
        </div>
        {{-- RULE: Multiple Approval Levels Required --}}
        <div id="rule-multiple-approval-levels-needed" class="card rule-entry mt-2">
            <div class="card-body">
                <a role="button" class="remove-rule float-right btn btn-danger text-white btn-sm">
                    Remove
                </a>
                <input type="number" name="id" hidden> 
                <h5 class="title text-primary">Multiple Approval Levels Required</h5>
            </div>
        </div>
        {{-- RULE: Consecutive --}}
        <div id="rule-consecutive" class="card rule-entry mt-2">
            <div class="card-body">
                <a role="button" class="remove-rule float-right btn btn-danger text-white btn-sm">
                    Remove
                </a>
                <input type="number" name="id" hidden> 
                <h5 class="title text-primary">Application Must Be Consecutive</h5>
            </div>
        </div>
        {{-- RULE: Min Employment Period --}}
        <div id="rule-min-employment-period" class="card rule-entry mt-2">
            <div class="card-body">
                <a role="button" class="remove-rule float-right btn btn-danger text-white btn-sm">
                    Remove
                </a>
                <input type="number" name="id" hidden> 
                <h5 class="title text-primary">Minimum Employment Period</h5>
                <div class="form-group">
                    <label for="min-days"><strong>Minimum Days Employed*</strong></label>
                    <div class=" input-group">
                        <input id="min-days" name="min-days" type="number" class="form-control" placeholder="eg. 3">
                    </div>
                </div>
            </div>
        </div>
        {{-- RULE: Max No of Children --}}
        <div id="rule-max-no-of-children" class="card rule-entry mt-2">
            <div class="card-body">
                <a role="button" class="remove-rule float-right btn btn-danger text-white btn-sm">
                    Remove
                </a>
                <input type="number" name="id" hidden> 
                <h5 class="title text-primary">Maximum Number of Children</h5>
                <div class="form-group">
                    <label for="max-no-of-children"><strong>Max Children*</strong></label>
                    <div class=" input-group">
                        <input id="max-no-of-children" name="max-no-of-children" type="number" class="form-control" placeholder="eg. 3">
                    </div>
                </div>
            </div>
        </div>
        {{-- RULE: Unpaid --}}
        <div id="rule-unpaid" class="card rule-entry mt-2">
            <div class="card-body">
                <a role="button" class="remove-rule float-right btn btn-danger text-white btn-sm">
                    Remove
                </a>
                <input type="number" name="id" hidden> 
                <h5 class="title text-primary">Unpaid</h5>
            </div>
        </div>
        {{-- RULE: Employee Cannot Apply --}}
        <div id="rule-employee-cannot-apply" class="card rule-entry mt-2">
            <div class="card-body">
                <a role="button" class="remove-rule float-right btn btn-danger text-white btn-sm">
                    Remove
                </a>
                <input type="number" name="id" hidden> 
                <h5 class="title text-primary">Employee Cannot Apply</h5>
            </div>
        </div>
        {{-- RULE: Include Off Days --}}
        <div id="rule-inc-off-days" class="card rule-entry mt-2">
            <div class="card-body">
                <a role="button" class="remove-rule float-right btn btn-danger text-white btn-sm">
                    Remove
                </a>
                <input type="number" name="id" hidden> 
                <h5 class="title text-primary">Include Off Days</h5>
            </div>
        </div>
        {{-- RULE: Max No of Children --}}
        <div id="rule-max-after-applied-days" class="card rule-entry mt-2">
            <div class="card-body">
                <a role="button" class="remove-rule float-right btn btn-danger text-white btn-sm">
                    Remove
                </a>
                <input type="number" name="id" hidden> 
                <h5 class="title text-primary">Only Allowed To Apply Maximum After Days</h5>
                <div class="form-group">
                    <label for="max-after-applied-days"><strong>After Days*</strong></label>
                    <div class=" input-group">
                        <input id="max-after-applied-days" name="max-after-applied-days" type="number" class="form-control" placeholder="eg. 3">
                    </div>
                </div>
            </div>
        </div>
        {{-- RULE: Maximum Applications --}}
        <div id="rule-max-applications" class="card rule-entry mt-2">
            <div class="card-body">
                <a role="button" class="remove-rule float-right btn btn-danger text-white btn-sm">
                    Remove
                </a>
                <input type="number" name="id" hidden> 
                <h5 class="title text-primary">Maximum Applications</h5>
                <div class="form-group">
                    <label for="max-applications"><strong>Maximum Applications*</strong></label>
                    <div class=" input-group">
                        <input id="max-applications" name="max-applications" type="number" class="form-control" placeholder="eg. 3">
                    </div>
                </div>
            </div>
        </div>
        {{-- RULE: No Applied Days Limit --}}
        <div id="rule-no-limit" class="card rule-entry mt-2">
            <div class="card-body">
                <a role="button" class="remove-rule float-right btn btn-danger text-white btn-sm">
                    Remove
                </a>
                <input type="number" name="id" hidden> 
                <h5 class="title text-primary">No Applied Days Limit</h5>
            </div>
        </div>
        {{-- RULE: Maximum Days Per Application --}}
        <div id="rule-max-days-per-application" class="card rule-entry mt-2">
            <div class="card-body">
                <a role="button" class="remove-rule float-right btn btn-danger text-white btn-sm">
                    Remove
                </a>
                <input type="number" name="id" hidden> 
                <h5 class="title text-primary">Maximum Days Per Application</h5>
                <div class="form-group">
                    <label for="max-days-per-application"><strong>Maximum Days Per Application*</strong></label>
                    <div class=" input-group">
                        <input id="max-days-per-application" name="max-days-per-application" type="number" class="form-control" placeholder="eg. 3">
                    </div>
                </div>
            </div>
        </div>
        {{-- RULE: No Applied Days Limit --}}
        <div id="rule-non-prorated" class="card rule-entry mt-2">
            <div class="card-body">
                <a role="button" class="remove-rule float-right btn btn-danger text-white btn-sm">
                    Remove
                </a>
                <input type="number" name="id" hidden> 
                <h5 class="title text-primary">Non Prorated</h5>
            </div>
        </div>
        {{-- RULE: Minimum Apply Days Before --}}
        <div id="rule-min-apply-days-before" class="card rule-entry mt-2">
            <div class="card-body">
                <a role="button" class="remove-rule float-right btn btn-danger text-white btn-sm">
                    Remove
                </a>
                <input type="number" name="id" hidden> 
                <h5 class="title text-primary">Minimum Apply Days Before</h5>
                <div class="entries-table container">
                    <div class="entry-headers row">
                        <div class="col-5">Min Applied Days</div>
                        <div class="col-6">Must Apply Before (Days)</div>
                        <div class="col-1"></div>
                    </div>
                    <div class="entry-list">
                        
                    </div>
                    <div class="footer row justify-content-end">
                        <div class="col-2 p-0">
                            <a role="button" class="float-right btn add-btn">
                                <i class="fas fa-plus"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        {{-- (TODO) RULE: Deduct Other Leave Types if Insufficient --}}
        {{-- (TODO) RULE: Include Off Days (Based on Minimum Applied Days) --}}
</div>
<div id="leave-type-rule-min-apply-days-before-template" hidden>
    <div class="min-apply-days-before-entry row">
        <div class="col-5">
            <input name="min-leave-days" type="number" class="form-control min-leave-days" placeholder="eg. 3">
        </div>
        <div class="col-6">
            <input name="min-apply-before-days" type="number" class="form-control min-apply-before-days" placeholder="eg. 3">
        </div>
        <div class="col-1 p-0">
            <a role="button" class="remove-btn float-right btn" hidden>
                <i class="fas fa-times"></i>
            </a>
        </div>
    </div>
</div>
<div id="leave-type-entitled-days-by-years-template" hidden>
    <div class="entitlement-by-years-entry input-group mt-2">
        <input type="number" class="min-years-input form-control text-white" placeholder="Minimum Years"
            min="1" max="50">
        <input type="number" class="entitled-days-input form-control" placeholder="Entitled Days"
            min="1" max="100">
        <div class="remove-entry input-group-append">
            <span class="input-group-text"><i class="fas fa-times"></i></span>
        </div>
    </div>
</div>
<div id="grade-group-entry-template" hidden>
        <div class="grade-group-entry card mt-2">
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
                        <select multiple class="select-grades-dropdown form-control">
                                @foreach(App\EmployeeGrade::all() as $grade)
                                <option value={{ $grade->id }}>{{ $grade->name }}</option>
                                @endforeach
                        </select>
                    </div>

                    <div class="entitlement-by-years-entry default input-group">
                        <input type="text" class="min-years-input form-control text-white" value="Default"
                            readonly>
                        <input type="number" class="entitled-days-input form-control" placeholder="Entitled Days">
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
        (function () {
            // EVENT: Add / Remove - Min Apply Days Before Entry
            $('#rule-min-apply-days-before .add-btn').click(function(addEvent) {
                let minApplyDaysBefore = $('#rule-min-apply-days-before');
                let newMinApplyDaysBeforeEntry = $('#leave-type-rule-min-apply-days-before-template .min-apply-days-before-entry').clone();
                let minApplyDaysBeforeEntryList = minApplyDaysBefore.find('.entry-list');

                newMinApplyDaysBeforeEntry.find('.remove-btn').removeAttr('hidden');
                newMinApplyDaysBeforeEntry.appendTo(minApplyDaysBeforeEntryList);
            });

            $(document).on('click', '.min-apply-days-before-entry .remove-btn', function(removeEvent) {
                $(removeEvent.target).closest('.min-apply-days-before-entry').remove();
            });
        })();
        

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
                case 'rule-select-multiple-approval-levels-needed':
                    $('#leave-type-rule-templates #rule-multiple-approval-levels-needed').appendTo('#leave-rules-list');
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
                case 'rule-select-restrict-gender':
                    $('#leave-type-rule-templates #rule-restrict-gender').appendTo('#leave-rules-list');
                    $(e.target).attr('hidden', true);
                    break;

                case "rule-select-required-attachment":
                    $('#leave-type-rule-templates #rule-required-attachment').appendTo('#leave-rules-list');
                    $(e.target).attr('hidden', true);
                    break;
                case "rule-select-consecutive":
                    $('#leave-type-rule-templates #rule-consecutive').appendTo('#leave-rules-list');
                    $(e.target).attr('hidden', true);
                    break;
                case "rule-select-min-employment-period":
                    $('#leave-type-rule-templates #rule-min-employment-period').appendTo('#leave-rules-list');
                    $(e.target).attr('hidden', true);
                    break;
                case "rule-select-max-no-of-children":
                    $('#leave-type-rule-templates #rule-max-no-of-children').appendTo('#leave-rules-list');
                    $(e.target).attr('hidden', true);
                    break;
                case "rule-select-unpaid":
                    $('#leave-type-rule-templates #rule-unpaid').appendTo('#leave-rules-list');
                    $(e.target).attr('hidden', true);
                    break;
                case "rule-select-employee-cannot-apply":
                    $('#leave-type-rule-templates #rule-employee-cannot-apply').appendTo('#leave-rules-list');
                    $(e.target).attr('hidden', true);
                    break;
                case "rule-select-inc-off-days":
                    $('#leave-type-rule-templates #rule-inc-off-days').appendTo('#leave-rules-list');
                    $(e.target).attr('hidden', true);
                    break;
                case "rule-select-max-after-applied-days":
                    $('#leave-type-rule-templates #rule-max-after-applied-days').appendTo('#leave-rules-list');
                    $(e.target).attr('hidden', true);
                    break;
                case "rule-select-max-applications":
                    $('#leave-type-rule-templates #rule-max-applications').appendTo('#leave-rules-list');
                    $(e.target).attr('hidden', true);
                    break;
                case "rule-select-no-limit":
                    $('#leave-type-rule-templates #rule-no-limit').appendTo('#leave-rules-list');
                    $(e.target).attr('hidden', true);
                    break;
                case "rule-select-max-days-per-application":
                    $('#leave-type-rule-templates #rule-max-days-per-application').appendTo('#leave-rules-list');
                    $(e.target).attr('hidden', true);
                    break;
                case "rule-select-non-prorated":
                    $('#leave-type-rule-templates #rule-non-prorated').appendTo('#leave-rules-list');
                    $(e.target).attr('hidden', true);
                    break;
                case "rule-select-min-apply-days-before":
                    $('#leave-type-rule-templates #rule-min-apply-days-before').appendTo('#leave-rules-list');
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
                case 'rule-multiple-approval-levels-needed':
                    $('#rule-select-multiple-approval-levels-needed').removeAttr('hidden');
                break;
                case 'rule-can-carry-forward':
                    $('#rule-select-can-carry-forward').removeAttr('hidden');
                    break;
                case 'rule-restrict-gender':
                    $('#rule-select-restrict-gender').removeAttr('hidden');
                    break;
                case 'rule-required-attachment':
                    $('#rule-select-required-attachment').removeAttr('hidden');
                    break;
                case 'rule-consecutive':
                    $('#rule-select-consecutive').removeAttr('hidden');
                    break;
                case 'rule-min-employment-period':
                    $('#rule-select-min-employment-period').removeAttr('hidden');
                    break;
                case 'rule-max-no-of-children':
                    $('#rule-select-max-no-of-children').removeAttr('hidden');
                    break;
                case 'rule-unpaid':
                    $('#rule-select-unpaid').removeAttr('hidden');
                    break;
                case 'rule-employee-cannot-apply':
                    $('#rule-select-employee-cannot-apply').removeAttr('hidden');
                    break;
                case 'rule-inc-off-days':
                    $('#rule-select-inc-off-days').removeAttr('hidden');
                    break;
                case 'rule-max-after-applied-days':
                    $('#rule-select-max-after-applied-days').removeAttr('hidden');
                    break;
                case 'rule-max-applications':
                    $('#rule-select-max-applications').removeAttr('hidden');
                    break;
                case 'rule-no-limit':
                    $('#rule-select-no-limit').removeAttr('hidden');
                    break;
                case 'rule-max-days-per-application':
                    $('#rule-select-max-days-per-application').removeAttr('hidden');
                    break;
                case 'rule-non-prorated':
                    $('#rule-select-non-prorated').removeAttr('hidden');
                    break;
                case 'rule-min-apply-days-before':
                    $('#rule-select-min-apply-days-before').removeAttr('hidden');
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
                    // case 'rule-leave-calculation':
                    //     console.log("Leave Calculation: ", leaveRuleEl);
                        
                    //     ruleData.rule = 'leave_calculation';
                    //     ruleData.configuration = {
                    //         consecutive: leaveRule.find('#consecutive-input').prop('checked'),
                    //         include_off_days: leaveRule.find('#include-off-days').prop('checked')
                    //     };
                    // break;
                    case 'rule-multiple-approval-levels-needed':
                        console.log("Multiple Approval Levels Required: ", leaveRuleEl);
                        ruleData.rule = 'multiple_approval_levels_needed';
                    break;
                    // case 'rule-min-apply-days-before':
                    //     ruleData.rule = 'gender';
                    //     ruleData.configuration = {
                    //         gender: leaveRule.find('#gender-input').val(),
                    //     };
                    // break;
                    case 'rule-restrict-gender':
                        ruleData.rule = 'gender';
                        ruleData.configuration = {
                            gender: leaveRule.find('#gender-input').val(),
                        };
                    break;
                    case 'rule-can-carry-forward':
                        ruleData.rule = 'can_carry_forward';
                        ruleData.configuration = {
                            max_carry_forward_days: +(leaveRule.find('#max-carry-forward-days').val()),
                            valid_till_end_month: +(leaveRule.find('#valid-until-end-month').val()),
                        };
                    break;
                    case 'rule-required-attachment':
                        ruleData.rule = 'required_attachment';
                        ruleData.configuration = {
                            attachment_type: leaveRule.find('#attachment-type').val(),
                        };
                    break;
                    case 'rule-consecutive':
                        ruleData.rule = 'consecutive';
                    break;
                    case 'rule-min-employment-period':
                        ruleData.rule = 'min_employment_period';
                        ruleData.configuration = {
                            min_days: +(leaveRule.find('#min-days').val()),
                        };
                    case 'rule-max-no-of-children':
                        ruleData.rule = 'max_no_of_children';
                        ruleData.configuration = {
                            max_no_of_children: +(leaveRule.find('#max-no-of-children').val()),
                        };
                    break;
                    case 'rule-unpaid':
                        ruleData.rule = 'unpaid';
                    break;
                    case 'rule-employee-cannot-apply':
                        ruleData.rule = 'employee_cannot_apply';
                    break;
                    case 'rule-inc-off-days':
                        ruleData.rule = 'inc_off_days';
                    break;
                    case 'rule-max-after-applied-days':
                        ruleData.rule = 'max_after_applied_days';
                        ruleData.configuration = {
                            max_after_applied_days: +(leaveRule.find('#max-after-applied-days').val()),
                        };
                    break;
                    case 'rule-max-applications':
                        ruleData.rule = 'max_applications';
                        ruleData.configuration = {
                            max_applications: +(leaveRule.find('#max-applications').val()),
                        };
                    break;
                    case 'rule-no-limit':
                        ruleData.rule = 'no_limit';
                    break;
                    case 'rule-max-days-per-application':
                        ruleData.rule = 'max_days_per_application';
                        ruleData.configuration = {
                            max_days_per_application: +(leaveRule.find('#max-days-per-application').val()),
                        };
                    break;
                    case 'rule-non-prorated':
                        ruleData.rule = 'non_prorated';
                    case 'rule-min-apply-days-before':
                        ruleData.rule = 'min_apply_days_before';

                        let config = [];
                        minApplyDaysBeforeEntries = leaveRule.find('.entry-list .min-apply-days-before-entry');
                        $.each(minApplyDaysBeforeEntries, function(index, entryEl) {
                            let minLeaveDays = $(entryEl).find('.min-leave-days').val();
                            let minApplyDaysBefore = $(entryEl).find('.min-apply-before-days').val();
                            if(minLeaveDays && minApplyDaysBefore) {
                                config.push({
                                    min_leave_days: +(minLeaveDays),
                                    min_apply_days_before: +(minApplyDaysBefore)
                                })
                            }
                        });

                        ruleData.configuration = config;
                        // for(let i = 0; i < configuration.length; i++) {
                        //         let entryEl = minApplyDaysBeforeEntryTemplate.clone();
                                
                        //         entryEl.find('.min-leave-days').val(configuration[i].min_leave_days);
                        //         entryEl.find('.min-apply-before-days').val(configuration[i].min_apply_days_before);
                        //         if(i > 0) {
                        //             entryEl.find('.remove-btn').removeAttr('hidden');
                        //         }

                        //         entryEl.appendTo(minApplyDaysBeforeEntryList);
                        //     }
                    break;
                }

                leaveRulesListData.push(ruleData);
            })
            data.applied_rules = leaveRulesListData;

            console.log("Data: ", data);
            data._token = '{{ csrf_token() }}';
            $.ajax({
                url: "{{ route('admin.e-leave.configuration.leave-types.add.post') }}",
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
    })

</script>
@append
