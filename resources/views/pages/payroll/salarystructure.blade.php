@extends('layouts.admin-base')
@section('content')
<div class="container">
    <div id="alert-container">
        </div>   
   <div class="col-auto mr-auto">
            @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{$errors->first()}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif 
            
            @if(session()->get('success'))
            <div class="alert alert-primary alert-dismissible fade show" role="alert">
                <span id="alert-message">{{ session()->get('success') }}</span>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
        </div>
<div class="tab-pane fade show p-3" id="nav-salary-structure" role="tabpanel" aria-labelledby="nav-salary-structure-tab">
    <div class="row pb-3">
        <div class="col-auto mr-auto"></div>
        <div class="col-auto">
            @can(PermissionConstant::ADD_SALARY_STRUCTURE)
           <button type="button" class="btn btn-primary waves-effect" data-toggle="modal" data-target="#add-salary-structure-popup">
                Add Salary Structure
            </button>
            @endcan
        </div>
    </div>
            <table class="hrms-data-table compact w-100 t-2" id="salary-structure-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Team</th>
                        <th>Grade</th>
                        <th>Category</th>
                        <th>Basic Salary</th>
                        <th>KPI</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($salarystructures as $salarystructure)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{$salarystructure->team()->first()->name}}</td>
                        <td>{{$salarystructure->grade()->first()->name}}</td>
                        <td>{{$salarystructure->category()->first()->name}}</td>
                        <td>{{$salarystructure->basic_salary}}</td>
                        <td>{{$salarystructure->KPI}}</td>
                        <td>
                        @can(PermissionConstant::UPDATE_SALARY_STRUCTURE)
                        <button onclick="window.location='{{ route('payroll.salarystructure.edit',$salarystructure->id) }}';" class="btn btn-success btn-smt fas fa-edit"></button>
                        @endcan
                        @can(PermissionConstant::DELETE_SALARY_STRUCTURE)
                        <button type="submit" data-toggle="modal" data-target="#confirm-delete-modal" data-entry-title='{{ $salarystructure->id }}' data-link='{{ route('payroll.salarystructure.delete', ['id ' => $salarystructure->id]) }}' class="btn btn-danger btn-smt fas fa-trash"></button>
                        @endcan     
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
<div class="modal fade" id="add-salary-structure-popup" tabindex="-1" role="dialog" aria-labelledby="add-salary-structure-label"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="add-salary-structure-label">Add Salary Structure</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form  enctype="multipart/form-data" id="add-salary-structure-form" name="add-salary-structure-form" >
                <div class="modal-body">
                    @csrf
                     <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label><strong>Team*</strong></label>
                            <select name="team_id" id="team_id" class="form-control" >
                                <option value ="" >Select Team</option>
                                 @foreach($teams as $team)
                                 <option value="{{$team->id}}">{{$team->name}}</option>
                                 @endforeach
                                    </select>
                            <div id="team_id-error" class="invalid-feedback">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label><strong>Grade*</strong></label>
                            <select name="grade_id" id="grade_id" class="form-control" >
                                <option value ="" >Select Grade</option>
                                 @foreach($grades as $grade)
                                 <option value="{{$grade->id}}">{{$grade->name}}</option>
                                 @endforeach
                                    </select>
                            <div id="grade_id-error" class="invalid-feedback">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label><strong>Category*</strong></label>
                            <select name="categories_id" id="categories_id" class="form-control" >
                                <option value ="" >Select Category</option>
                                 @foreach($categories as $category)
                                 <option value="{{$category->id}}">{{$category->name}}</option>
                                 @endforeach
                                    </select>
                            <div id="categories_id-error" class="invalid-feedback">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label><strong>Basic Salary*</strong></label>
                            <input name="basic_salary" type="text" class="form-control" placeholder="" value="" >
                            <div id="basic_salary-error" class="invalid-feedback">
                            </div>
                        </div>
                    </div>
                     <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label><strong>KPI*</strong></label>
                            <input name="KPI" type="text" class="form-control" placeholder="" value="" >
                            <div id="KPI-error" class="invalid-feedback">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="add-salary-structure-form-submit" type="submit" class="btn btn-primary">
                    {{ __('Submit') }}
                </button>
                </div>
            </form>
        </div>
    </div>
</div>
</div>

<div class="modal fade" id="confirm-delete-modal" tabindex="-1" role="dialog" aria-labelledby="confirm-delete-label" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirm-delete-label">Confirm Delete</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <div class="modal-body">
                <p>Are you sure want to delete?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="confirm">Delete</button>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script type="text/javascript"> 
      //////////////////ADD///////////////////////////////////////////////

        // ADD
        $('#add-salary-structure-popup').on('show.bs.modal', function (event) {
            clearEmployeeAssetError('#add-salary-structure-form');
        });
        $('#add-salary-structure-form #add-salary-structure-form-submit').click(function(e){
            e.preventDefault();
            var form = document.forms.namedItem("add-salary-structure-form");
            var formdata = new FormData(form);
            clearEmployeeAssetError('#add-salary-structure-form');
            $.ajax({
                url: "",
                type: 'POST',
                contentType: false,
                processData: false,
                data:formdata,
                success: function(data) {
                    showAlert(data.success);
                    $('#add-salary-structure-popup').modal('toggle'); 
                    //employeeAssetsTable.ajax.reload();
                    $('#salary-structure-table').load(document.URL +  ' #salary-structure-table');
                    clearEmployeeAssetModal('#add-salary-structure-form');
                },
              error: function(xhr) {
                    if(xhr.status == 422) {
                        var errors = xhr.responseJSON.errors;
                        console.log("Error: ", xhr);
                        for (var errorField in errors) {
                            if (errors.hasOwnProperty(errorField)) {
                                console.log("Error: ", errorField);
                                switch(errorField) {
                                    case 'team_id':
                                        $('#add-salary-structure-form select[name=team_id]').addClass('is-invalid');
                                        $('#add-salary-structure-form #team_id-error').html('<strong>' + errors[errorField][0] + '</strong>');
                                    break;
                                    case 'grade_id':
                                        $('#add-salary-structure-form select[name=grade_id]').addClass('is-invalid');
                                        $('#add-salary-structure-form #grade_id-error').html('<strong>' + errors[errorField][0] + '</strong>');
                                    break;
                                    case 'categories_id':
                                        $('#add-salary-structure-form select[name=categories_id]').addClass('is-invalid');
                                        $('#add-salary-structure-form #categories_id-error').html('<strong>' + errors[errorField][0] + '</strong>');
                                    break;
                                    case 'basic_salary':
                                        $('#add-salary-structure-form input[name=basic_salary]').addClass('is-invalid');
                                        $('#add-salary-structure-form #basic_salary-error').html('<strong>' + errors[errorField][0] + '</strong>');
                                    break;
                                    case 'KPI':
                                        $('#add-salary-structure-form input[name=KPI]').addClass('is-invalid');
                                        $('#add-salary-structure-form #KPI-error').html('<strong>' + errors[errorField][0] + '</strong>');
                                    break;
                                    
                                }
                            }
                        }
                    }
                }
            });
        });

 // GENERAL FUNCTIONS
    function clearEmployeeAssetModal(htmlId) {
        $(htmlId + ' input[name=basic_salary]').val('');
        $(htmlId + ' input[name=KPI]').val('');
        $(htmlId + ' select[name=team_id]').val('');
        $(htmlId + ' select[name=grade_id]').val('');
        $(htmlId + ' select[name=categories_id]').val('');

        $(htmlId + ' input[name=basic_salary]').removeClass('is-invalid');
        $(htmlId + ' input[name=KPI]').removeClass('is-invalid');
        $(htmlId + ' select[name=team_id]').removeClass('is-invalid');
        $(htmlId + ' select[name=grade_id]').removeClass('is-invalid');
        $(htmlId + ' select[name=categories_id]').removeClass('is-invalid');
    }

    function clearEmployeeAssetError(htmlId) {
        $(htmlId + ' input[name=basic_salary]').removeClass('is-invalid');
        $(htmlId + ' input[name=KPI]').removeClass('is-invalid');
        $(htmlId + ' select[name=team_id]').removeClass('is-invalid');
        $(htmlId + ' select[name=grade_id]').removeClass('is-invalid');
        $(htmlId + ' select[name=categories_id]').removeClass('is-invalid');

    }

    ////////date//////////
 $(document).ready(function() {
    $('#salary-structure-table').DataTable();
} );

function showAlert(message) {
        $('#alert-container').html(`<div class="alert alert-primary alert-dismissible fade show" role="alert">
            <span id="alert-message">${message}</span>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>`)
    }

$('#confirm-delete-modal').on('show.bs.modal', function (e) {
        var entryTitle = $(e.relatedTarget).data('entry-title');
        var link = $(e.relatedTarget).data('link');
        $(this).find('.modal-body p').text('Are you sure you want to delete ?');

        // Pass form reference to modal for submission on yes/ok
        var form = $(e.relatedTarget).closest('form');
        $(this).find('.modal-footer #confirm').data('form', link);
});

$('#confirm-delete-modal').find('.modal-footer #confirm').on('click', function(){
        window.location = $(this).data('form');
});

</script>
@append
