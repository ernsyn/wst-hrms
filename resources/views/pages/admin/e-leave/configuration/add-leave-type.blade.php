@extends('layouts.admin-base') 
@section('content')
<div id="page-add-leave-type" class="container">
        <div class="card mb-4">
                <form method="POST" action="{{ route('admin.settings.working-days.add.post') }}" id="form_validate" data-parsley-validate>
                    <div class="card-body">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label for="code"><strong>Code*</strong></label>
                                <input id="code" type="text" class="form-control{{ $errors->has('code') ? ' is-invalid' : '' }}" placeholder="eg. ANNUAL"
                                    name="code" value="{{ old('code') }}" required>
                                @if ($errors->has('code'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('code') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="form-group col-md-9">
                                <label for="name"><strong>Name*</strong></label>
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="eg. Annual Leave"
                                    name="name" value="{{ old('name') }}" required>
                                @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="card mb-3">
                            <div class="card-header bg-primary text-white">
                                <strong>Rules</strong>
                                <a role="button" id="add-leave-type-btn" class="float-right btn btn-primary btn-sm">
                                    <i class="fas fa-plus"></i>
                                </a>
                            </div>
                            <div class="card-body">

                            </div>
                        </div>

                        <div class="card mb-3">
                            <div class="card-header bg-primary text-white">
                                <strong>Entitled Days</strong>
                                <button class="btn btn-primary btn-sm float-right dropdown-toggle" type="button" id="entitled-mode-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span id="selected-text">All Employees</span>
                                    <span class="ml-2"><i class="fas fa-caret-down"></i></span>
                                    <input type="text" hidden id="entitled-mode" name="entitled-mode" value="entitled-mode-all">
                                </button>
                                <div id="entitled-mode-options" class="dropdown-menu" aria-labelledby="entitled-mode-dropdown">
                                    <button id="entitled-mode-all" class="dropdown-item" type="button">All Employees</button>
                                    <button id="entitled-mode-by-grade" class="dropdown-item" type="button">By Employee Grade</button>
                                </div>
                            </div>
                            <div id="section-employee-mode-by-grade" class="card-body"  hidden>
                                  <div class="card">
                                      <div class="card-header bg-light text-primary">
                                            <strong>Grade Group</strong>
                                            {{-- <a role="button" id="add-leave-type-btn" class="float-right btn btn-light btn-sm">
                                                <i class="fas fa-plus"></i>
                                            </a>  --}}
                                      </div>
                                      <div class="card-body">
                                            <div class="form-group">
                                                <label for="grade-group-1"><strong>Grades*</strong></label>
                                                <select multiple class="form-control" id="grade-group-1">
                                                    <option>A1</option>
                                                    <option>A2</option>
                                                    <option>M1</option>
                                                    <option>M2</option>
                                                    <option>M3</option>
                                                </select>
                                            </div>

                                            <div class="entitlement-by-years-entry default input-group">
                                                    <input type="text" class="min-years-input form-control text-white" value="Default" readonly>
                                                    <input type="number" class="entitled-days-input form-control" placeholder="Entitled Days">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text"><i class="fas fa-times"></i></span>
                                                    </div>
                                                </div>
                
                                                <div class="entitlement-by-years-entry input-group mt-2">
                                                    <input type="number" class="min-years-input form-control text-white" placeholder="Minimum Years" min="1" max="50">
                                                    <input type="number" class="entitled-days-input form-control" placeholder="Entitled Days" min="1" max="100">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text"><i class="fas fa-times"></i></span>
                                                    </div>
                                                </div>
                
                                                {{-- Button: Add --}}
                                                <div class="row mt-2">
                                                    <div class="col">
                                                        <a role="button" id="" class="float-right btn btn-light">
                                                                <i class="fas fa-plus"></i>
                                                            </a>
                
                                                    </div>
                                                </div>
                                      </div>
                                  </div>
                                  
                                  <div class="card mt-2">
                                    <div class="card-header bg-light text-primary">
                                            <strong>Grade Group</strong>
                                            {{-- <a role="button" id="add-leave-type-btn" class="float-right btn btn-light btn-sm">
                                                <i class="fas fa-plus"></i>
                                            </a>  --}}
                                        </div>
                                      <div class="card-body">
                                            <div class="form-group">
                                                <label for="grade-group-2"><strong>Grades*</strong></label>
                                                <select multiple class="form-control" id="grade-group-2">
                                                    <option>A1</option>
                                                    <option>A2</option>
                                                    <option>M1</option>
                                                    <option>M2</option>
                                                    <option>M3</option>
                                                </select>
                                            </div>

                                            <div class="entitlement-by-years-entry default input-group">
                                                    <input type="text" class="min-years-input form-control text-white" value="Default" readonly>
                                                    <input type="number" class="entitled-days-input form-control" placeholder="Entitled Days">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text"><i class="fas fa-times"></i></span>
                                                    </div>
                                                </div>
                
                                                <div class="entitlement-by-years-entry input-group mt-2">
                                                    <input type="number" class="min-years-input form-control text-white" placeholder="Minimum Years" min="1" max="50">
                                                    <input type="number" class="entitled-days-input form-control" placeholder="Entitled Days" min="1" max="100">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text"><i class="fas fa-times"></i></span>
                                                    </div>
                                                </div>
                
                                                {{-- Button: Add --}}
                                                <div class="row mt-2">
                                                    <div class="col">
                                                        <a role="button" id="" class="float-right btn btn-light">
                                                            <i class="fas fa-plus"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                      </div>
                                  </div>

                                  <div class="row mt-2">
                                        <div class="col">
                                            <a role="button" id="" class="float-right btn btn-primary text-white">
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
                            <div id="section-employee-mode-all" class="card-body">

                                <div class="entitlement-by-years-entry default input-group">
                                    <input type="text" class="min-years-input form-control text-white" value="Default" readonly>
                                    <input type="number" class="entitled-days-input form-control" placeholder="Entitled Days">
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="fas fa-times"></i></span>
                                    </div>
                                </div>

                                <div class="entitlement-by-years-entry input-group mt-2">
                                    <input type="number" class="min-years-input form-control text-white" placeholder="Minimum Years" min="1" max="50">
                                    <input type="number" class="entitled-days-input form-control" placeholder="Entitled Days" min="1" max="100">
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="fas fa-times"></i></span>
                                    </div>
                                </div>

                                {{-- Button: Add --}}
                                <div class="row mt-2">
                                    <div class="col">
                                        <a role="button" id="" class="float-right btn btn-light">
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
@endsection
 
@section('scripts') 
<script>
    $(function() {
        $('#grade-group-1').multiselect({
            numberDisplayed: 0
        });
        $('#grade-group-2').multiselect({
            numberDisplayed: 0
        });

        $("#entitled-mode-options button").click(function (e) {
            $('#entitled-mode-dropdown #selected-text').html(e.target.innerText);
            $('#entitled-mode-dropdown').dropdown('toggle');
            $('input[name="entitled-mode"]').attr('value', e.target.id);
            switch(e.target.id) {
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
    })
</script>
@append