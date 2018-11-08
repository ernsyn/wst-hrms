@extends('layouts.app')
@section('pageTitle', 'Qualification')
@section('content')
<!-- ADD EXPERIENCES -->
<div class="modal fade" id="addCompanyPopup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Company</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form method="POST" action="{{ route('add_qualification_experience') }}" id="add_qualification_experience">
                @csrf
                <div class="row pb-5">
                    <div class="col-xl-8">
                        <label class="col-md-5 col-form-label">Company*</label>
                        <div class="col-md-10">
                            <input id="company" type="text" class="form-control{{ $errors->has('company') ? ' is-invalid' : '' }}" placeholder="company name" name="company" value="{{ old('company') }}" required>
                            @if ($errors->has('company'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('company') }}</strong>
                            </span>
                            @endif
                        </div>    
                        <label class="col-md-2 col-form-label">Position*</label>
                        <div class="col-md-10">
                                <input id="position" type="text" class="form-control{{ $errors->has('position') ? ' is-invalid' : '' }}" placeholder="Farther, Son, etc" name="position" value="{{ old('position') }}" required>
                                @if ($errors->has('position'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('position') }}</strong>
                                </span>
                                @endif
                        </div>
                        <label class="col-md-5 col-form-label">Start Date*</label>
                                <div class="col-md-7">
                                    <input id="dobDate" autocomplete="off" type="text" class="form-control">
                                    <input name="start_date" id="altdobDate" type="text" class="form-control" hidden>   
                                </div>
                                <label class="col-md-5 col-form-label">End Date*</label>
                                <div class="col-md-7">
                                    <input id="licenseExpiryDate" autocomplete="off" type="text" class="form-control">
                                    <input name="end_date" id="altlicenseExpiryDate" type="text" class="form-control" hidden>          
                                </div>        
                        <label class="col-md-5 col-form-label">Note</label> 
                        <div class="col-md-10">                                     
                            <textarea name="notes" class="form-control"></textarea>
                        </div>                                      
                    </div>
                </div>     
                <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Submit') }}
                        </button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
            </form>
        </div>
      </div>
    </div>
</div>

<!-- ADD EDUCATION -->
<div class="modal fade" id="addEducationPopup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Add Education</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('add_qualification_education') }}" id="add_qualification_education">
                    @csrf
                    <div class="row pb-5">
                        <div class="col-xl-8">
                            <label class="col-md-5 col-form-label">Degree*</label>
                            <div class="col-md-10">
                                <input id="level" type="text" class="form-control{{ $errors->has('level') ? ' is-invalid' : '' }}" placeholder="Degree name" name="level" value="{{ old('level') }}" required>
                                @if ($errors->has('level'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('level') }}</strong>
                                </span>
                                @endif
                            </div>    
                            <label class="col-md-2 col-form-label">Field of Study*</label>
                            <div class="col-md-10">
                                <input id="major" type="text" class="form-control{{ $errors->has('major') ? ' is-invalid' : '' }}" placeholder="etc" name="major" value="{{ old('major') }}" required>
                                @if ($errors->has('major'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('major') }}</strong>
                                </span>
                                @endif
                            </div>
                            <label class="col-md-5 col-form-label">Start Year*</label>
                                <div class="col-md-7">
                                    <input id="startYear" name="start_year" autocomplete="off" type="text" class="form-control">
                                    <input id="altStartYear" type="text" class="form-control" hidden>   
                                </div>
                            <label class="col-md-5 col-form-label">End Date*</label>
                                <div class="col-md-7">
                                    <input id="endYear" name="end_year" autocomplete="off" type="text" class="form-control">
                                    <input id="altEndYear" type="text" class="form-control" hidden>          
                                </div>     
                            <label class="col-md-2 col-form-label">GPA*</label>
                                <div class="col-md-10">
                                    <input id="gpa" type="number" min="0" max="4" class="form-control{{ $errors->has('gpa') ? ' is-invalid' : '' }}" placeholder="etc" name="gpa" value="{{ old('gpa') }}" required>
                                        @if ($errors->has('gpa'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('gpa') }}</strong>
                                        </span>
                                        @endif
                                </div>
                            <label class="col-md-2 col-form-label">School*</label>
                            <div class="col-md-10">
                                <input id="school" type="text" class="form-control{{ $errors->has('school') ? ' is-invalid' : '' }}" placeholder="etc" name="school" value="{{ old('school') }}" required>
                                @if ($errors->has('school'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('school') }}</strong>
                                </span>
                                @endif
                            </div>   
                            <label class="col-md-5 col-form-label">Description</label> 
                            <div class="col-md-10">                                     
                                <textarea name="description" class="form-control"></textarea>
                            </div>                                      
                        </div>
                    </div>     
                    <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Submit') }}
                            </button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div> 
                </form>
            </div>
        </div>
    </div>
</div>

<!-- ADD SKILLS -->
<div class="modal fade" id="addSkillsPopup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Add Skills</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('add_qualification_skills') }}" id="add_qualification_education">
                    @csrf
                    <div class="row pb-5">
                        <div class="col-xl-8">
                            <label class="col-md-5 col-form-label">Skill Name*</label>
                            <div class="col-md-10">
                                <input id="skills" type="text" class="form-control{{ $errors->has('skills') ? ' is-invalid' : '' }}" name="skills" value="{{ old('skills') }}" required>
                                @if ($errors->has('skills'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('skills') }}</strong>
                                </span>
                                @endif
                            </div>    
                            <label class="col-md-2 col-form-label">Year Experience*</label>
                            <div class="col-md-10">
                                <input id="year_experience" type="text" class="form-control{{ $errors->has('year_experience') ? ' is-invalid' : '' }}" name="year_experience" value="{{ old('year_experience') }}" required>
                                @if ($errors->has('year_experience'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('year_experience') }}</strong>
                                </span>
                                @endif
                            </div>
                            <label class="col-md-2 col-form-label">Competency</label>
                            <div class="col-md-10">
                                <select name="competency" id="competency" class ="form-control">
                                    <option value="Beginner">Beginner</option>
                                    <option value="Intermediate">Intermediate</option>
                                    <option value="Advanced">Advanced</option>                                    
                                </select>
                            </div>

                        </div>
                    </div>     
                    <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Submit') }}
                            </button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>   
                </form>
            </div>
        </div>
    </div>
</div>

<!-- UPDATE EXPERIENCES -->
<div class="modal fade" id="updateCompanyPopup" tabindex="-1" role="dialog" aria-labelledby="updateCompanyLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="updateCompanyLabel">Edit Experience</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('edit_qualification_company') }}" id="edit_qualification_company">
                    @csrf
                    <div class="row pb-5">
                        <div class="col-xl-8">
                            <input id="comp_id" name="comp_id" type="hidden">                       
                            <label class="col-md-5 col-form-label">Company*</label>
                            <div class="col-md-7">
                                <input id="previous_company" name="previous_company" type="text" class="form-control{{ $errors->has('previous_company') ? ' is-invalid' : '' }}" value="{{ old('previous_company') }}" required>
                                @if ($errors->has('previous_company'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('previous_company') }}</strong>
                                </span>
                                @endif
                            </div>    
                                <label class="col-md-2 col-form-label">Position*</label>
                                <div class="col-md-10">
                                    <input id="previous_position" type="text" class="form-control{{ $errors->has('previous_position') ? ' is-invalid' : '' }}" placeholder="etc" name="previous_position" value="{{ old('previous_position') }}" required>
                                    @if ($errors->has('previous_position'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('previous_position') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <label class="col-md-5 col-form-label">Start Date*</label>
                                <div class="col-md-7">
                                    <input id="dobDate" autocomplete="off" type="text" class="form-control">
                                    <input name="start_date" id="altdobDate" type="text" class="form-control" hidden>   
                                </div>
                                <label class="col-md-5 col-form-label">End Date*</label>
                                <div class="col-md-7">
                                    <input id="licenseExpiryDate" autocomplete="off" type="text" class="form-control">
                                    <input name="end_date" id="altlicenseExpiryDate" type="text" class="form-control" hidden>          
                                </div>    
                                <label class="col-md-5 col-form-label">Note</label> 
                                <div class="col-md-10">                                     
                                    <textarea name="note" id="note" class="form-control"></textarea>
                                </div>                      
                        </div>
                    </div>     
                    <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Submit') }}
                            </button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                </form>
            </div>
          </div>
    </div>
</div>

<!-- UPDATE EDUCATION -->
<div class="modal fade" id="updateEducationPopup" tabindex="-1" role="dialog" aria-labelledby="updateEducationLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="updateEducationLabel">Update Education</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form method="POST" action="{{ route('edit_qualification_education') }}" id="update_qualification_education">
                @csrf
                <div class="row pb-5">
                    <div class="col-xl-8">
                        <input id="edu_id" name="edu_id" type="hidden">
                        <label class="col-md-5 col-form-label">Degree*</label>
                        <div class="col-md-10">
                            <input id="level" type="text" class="form-control{{ $errors->has('level') ? ' is-invalid' : '' }}" placeholder="Degree name" name="level" value="{{ old('level') }}" required>
                            @if ($errors->has('level'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('level') }}</strong>
                            </span>
                            @endif
                        </div>    
                        <label class="col-md-2 col-form-label">Field of Study*</label>
                        <div class="col-md-10">
                            <input id="major" type="text" class="form-control{{ $errors->has('major') ? ' is-invalid' : '' }}" placeholder="etc" name="major" value="{{ old('major') }}" required>
                            @if ($errors->has('major'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('major') }}</strong>
                            </span>
                            @endif
                        </div>
                        <label class="col-md-5 col-form-label">Start Year*</label>
                            <div class="col-md-7">
                                <input id="startYear" name="start_year" autocomplete="off" type="text" class="form-control">
                                <input id="altStartYear" type="text" class="form-control" hidden>   
                            </div>
                        <label class="col-md-5 col-form-label">End Date*</label>
                            <div class="col-md-7">
                                <input id="endYear" name="end_year" autocomplete="off" type="text" class="form-control">
                                <input id="altEndYear" type="text" class="form-control" hidden>          
                            </div>     
                        <label class="col-md-2 col-form-label">GPA*</label>
                            <div class="col-md-10">
                                <input id="gpa" type="number" min="0" max="4" class="form-control{{ $errors->has('gpa') ? ' is-invalid' : '' }}" placeholder="etc" name="gpa" value="{{ old('gpa') }}" required>
                                    @if ($errors->has('gpa'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('gpa') }}</strong>
                                    </span>
                                    @endif
                            </div>
                        <label class="col-md-2 col-form-label">School*</label>
                        <div class="col-md-10">
                            <input id="school" type="text" class="form-control{{ $errors->has('school') ? ' is-invalid' : '' }}" placeholder="etc" name="school" value="{{ old('school') }}" required>
                            @if ($errors->has('school'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('school') }}</strong>
                            </span>
                            @endif
                        </div>   
                        <label class="col-md-5 col-form-label">Description</label> 
                        <div class="col-md-10">                                     
                            <textarea name="description" id="description" class="form-control"></textarea>
                        </div>                                      
                    </div>
                </div>     
                <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Submit') }}
                        </button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>  
            </form>
        </div>
    </div>
    </div>
</div>

<!-- UPDATE SKILLS -->
<div class="modal fade" id="updateSkillsPopup" tabindex="-1" role="dialog" aria-labelledby="updateSkillsLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="updateSkillsLabel">Edit Skills</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('edit_qualification_skills') }}" id="edit_qualification_skills">
                    @csrf
                    <div class="row pb-5">
                        <div class="col-xl-8">
                            <input id="skill_id" name="skill_id" type="hidden">
                            <label class="col-md-5 col-form-label">Skill Name*</label>
                            <div class="col-md-10">
                                <input id="emp_skill" type="text" class="form-control{{ $errors->has('emp_skill') ? ' is-invalid' : '' }}" name="emp_skill" value="{{ old('emp_skill') }}" required>
                                @if ($errors->has('emp_skill'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('emp_skill') }}</strong>
                                </span>
                                @endif
                            </div>    
                            <label class="col-md-2 col-form-label">Year Experience*</label>
                            <div class="col-md-10">
                                <input id="year_experience" type="text" class="form-control{{ $errors->has('year_experience') ? ' is-invalid' : '' }}" name="year_experience" value="{{ old('year_experience') }}" required>
                                @if ($errors->has('year_experience'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('year_experience') }}</strong>
                                </span>
                                @endif
                            </div>
                            <label class="col-md-2 col-form-label">Competency</label>
                            <div class="col-md-10">
                                <select name="competency" id="competency" class ="form-control">
                                    <option value="Beginner">Beginner</option>
                                    <option value="Intermediate">Intermediate</option>
                                    <option value="Advanced">Advanced</option>                                    
                                </select>
                            </div>

                        </div>
                    </div>     
                    <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Submit') }}
                            </button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>  
                </form>
            </div>
        </div>
    </div>
</div>


<div class="p-4">
   <div class="card py-4">
    <div class="card-body">
        <div class="container-fluid">
            <div class="row">
                <nav class="col-sm-12">
                    <div class="nav nav-tabs font-weight-bold" id="nav-tab" role="tablist">
                        <a class="nav-item nav-link active" id="nav-profile-tab" data-toggle="tab" href="#nav-company" role="tab" aria-controls="nav-company"
                            aria-selected="false">Company</a>
                        <a class="nav-item nav-link" id="nav-company-tab" data-toggle="tab" href="#nav-education" role="tab" aria-controls="nav-education"
                            aria-selected="true">Education</a>
                        <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-skill" role="tab" aria-controls="nav-skill"
                            aria-selected="false">Skill</a>
                    </div>
                </nav>
                <div class="tab-content col-sm-12 text-justify pt-4" id="nav-tabContent">
                    {{-- Company --}}
                    <div class="tab-pane fade show active" id="nav-company" role="tabpanel" aria-labelledby="nav-company-tab">
                        <!-- Open add company experience --> 
                        <div class="row pb-3">
                            <div class="col-auto mr-auto"></div>
                            <div class="col-auto">
                                <button type="button" class="btn btn-outline-info waves-effect" data-toggle="modal" data-target="#addCompanyPopup">
                                    Add Experience
                                </button>
                            </div>
                        </div>               
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-bordered table-hover" id="employeeQualCompanyTable">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Company</th>
                                            <th>Position</th>
                                            <th>Start Date</th>
                                            <th>End Date</th>
                                            <th>Note</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($companies as $row)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$row['previous_company']}}</td>
                                            <td>{{$row['previous_position']}}</td>
                                            <td>{{$row['start_date']}}</td>
                                            <td>{{$row['end_date']}}</td>
                                            <td>{{$row['note']}}</td>
                                            <td><button class="btn btn-outline-primary waves-effect" data-toggle="modal"
                                                data-company-id="{{$row['id']}}"          
                                                data-company-previous-company="{{$row['previous_company']}}"
                                                data-company-previous-position="{{$row['previous_position']}}"
                                                data-company-start-date="{{$row['start_date']}}"
                                                data-company-end-date="{{$row['end_date']}}"
                                                data-company-note="{{$row['note']}}"                                                
                                                data-target="#updateCompanyPopup">EDIT</button></td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    {{-- Education --}}
                    <div class="tab-pane fade" id="nav-education" role="tabpanel" aria-labelledby="nav-education-tab">
                        <!-- Open add education -->
                        <div class="row pb-3">
                                <div class="col-auto mr-auto"></div>
                                <div class="col-auto">
                                    <button type="button" class="btn btn-outline-info waves-effect" data-toggle="modal" data-target="#addEducationPopup">
                                        Add Education
                                    </button>
                                </div>
                            </div>   
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-bordered table-hover" id="employeeQualEduTable">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Degree</th>
                                            <th>Field of Study</th>
                                            <th>Start Year</th>
                                            <th>End Year</th>
                                            <th>GPA</th>
                                            <th>School</th>
                                            <th>Description</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($educations as $row)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$row['level']}}</td>
                                            <td>{{$row['major']}}</td>
                                            <td>{{$row['start_year']}}</td>
                                            <td>{{$row['end_year']}}</td>
                                            <td>{{$row['gpa']}}</td>
                                            <td>{{$row['school']}}</td>
                                            <td>{{$row['description']}}</td>
                                            <td><button class="btn btn-outline-primary waves-effect" data-toggle="modal"
                                                data-education-id="{{$row['id']}}"          
                                                data-education-level="{{$row['level']}}"
                                                data-education-major="{{$row['major']}}"
                                                data-education-start-year="{{$row['start_year']}}"
                                                data-education-end-year="{{$row['end_year']}}"
                                                data-education-gpa="{{$row['gpa']}}"
                                                data-education-school="{{$row['school']}}"
                                                data-education-description="{{$row['description']}}"                                             
                                                data-target="#updateEducationPopup">EDIT</button></td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    {{-- Skill --}}
                    <div class="tab-pane fade" id="nav-skill" role="tabpanel" aria-labelledby="nav-skill-tab">
                        <!-- Open add skills -->
                        <div class="row pb-3">
                                <div class="col-auto mr-auto"></div>
                                <div class="col-auto">
                                    <button type="button" class="btn btn-outline-info waves-effect" data-toggle="modal" data-target="#addSkillsPopup">
                                        Add Skill
                                    </button>
                                </div>
                            </div>
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-bordered table-hover" id="employeeQualSkillTable">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Skill Name</th>
                                            <th>Year Experience</th>
                                            <th>Competency</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($skills as $row)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$row['emp_skill']}}</td>
                                            <td>{{$row['year_experience']}}</td>
                                            <td>{{$row['competency']}}</td>
                                            <td><button class="btn btn-outline-primary waves-effect" data-toggle="modal"
                                                data-skill-id="{{$row['id']}}"          
                                                data-skill-name="{{$row['emp_skill']}}"
                                                data-skill-experience="{{$row['year_experience']}}"
                                                data-skill-competency="{{$row['competency']}}"                                                                                            
                                                data-target="#updateSkillsPopup">EDIT</button></td>
                                        </tr>
                                        @endforeach
                                    </tbody>

                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div></div>
@endsection