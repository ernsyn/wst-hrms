<!-- ADD -->
<div class="modal fade" id="add-discipline-popup" tabindex="-1" role="dialog" aria-labelledby="add-discipline-label"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="add-discipline-label">Add Disciplinary Issue</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="add-discipline-form">
                <div class="modal-body">
                    @csrf
                    <div class="form-row">
                        <div class="col-md-8 mb-3">
                            <label for="discipline_date"><strong>Date*</strong></label>
                            <div class="input-group date" data-target-input="nearest">
                                <input type="text" id="discipline_date" name="discipline_date" class="form-control datetimepicker-input" data-target="#discipline_date" autocomplete="off" placeholder="DD/MM/YYYY"/>
                                <div class="input-group-append" data-target="#discipline_date" data-toggle="datetimepicker">
                                    <div class="input-group-text rounded-right"><i class="far fa-calendar-alt"></i></div>
                                </div>
                                <div id="discipline_date-error" class="invalid-feedback">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label><strong>Title*</strong></label>
                            <input name="discipline_title" id="discipline_title" type="text" class="form-control" placeholder="" value="" >
                            <div id="discipline_title-error" class="invalid-feedback">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label><strong>Description</strong></label>
                            <textarea name="discipline_desc" id="discipline_desc" class="form-control" rows="8" value=""></textarea>
                            <div id="discipline_desc-error" class="invalid-feedback">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label><strong>Investigated By*</strong></label>
                            <input name="created_by" id="created_by" type="text" class="form-control" placeholder="" value="" readonly="">
                            <div id="created_by-error" class="invalid-feedback">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label><strong>Attachment</strong></label>
                            <input name="discipline_attach[]" id="discipline_attach" type="file" class="form-control" multiple>
                            <div id="discipline_attach-error" class="invalid-feedback">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="add-discipline-submit" type="submit" class="btn btn-primary">
                    {{ __('Submit') }}
                </button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- END ADD -->

<!-- UPDATE -->
<div class="modal fade" id="edit-discipline-popup" tabindex="-1" role="dialog" aria-labelledby="edit-discipline-label"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="edit-discipline-label">Edit Disciplinary Issue</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <form enctype="multipart/form-data" name="edit-discipline-form" id="edit-discipline-form">
                @csrf
                <div class="modal-body">
                	<div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="discipline_date-edit"><strong>Date*</strong></label>
                            <div class="input-group date" data-target-input="nearest">
                                <input type="text" id="discipline_date-edit" name="discipline_date-edit" class="form-control datetimepicker-input" data-target="#discipline_date-edit" autocomplete="off" placeholder="DD/MM/YYYY"/>
                                <div class="input-group-append" data-target="#discipline_date-edit" data-toggle="datetimepicker">
                                    <div class="input-group-text rounded-right"><i class="far fa-calendar-alt"></i></div>
                                </div>
                                <div id="discipline_date-error" class="invalid-feedback">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label><strong>Title*</strong></label>
                            <input name="discipline_title-edit" id="discipline_title-edit" type="text" class="form-control" placeholder="" value="" >
                            <div id="discipline_title-error" class="invalid-feedback">

                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label><strong>Description*</strong></label>
                            <textarea  name="discipline_desc-edit" id="discipline_desc-edit "class="form-control" value="" rows="8"></textarea>
                            <div id="discipline_desc-error" class="invalid-feedback">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label><strong>Investigated By*</strong></label>
                            <input name="created_by-edit" id="created_by-edit" type="text" class="form-control" placeholder="" value="" readonly="">
                            <div id="created_by-error" class="invalid-feedback">

                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label><strong>Attachment</strong></label>
                            <input name="discipline_attach[]" id="discipline_attach" type="file" class="form-control" multiple>
                            <div id="discipline_attach-error" class="invalid-feedback">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label><strong>Attachment</strong></label>
                             <div id="attach">

                             </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="edit-discipline-submit" type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- END UPDATE -->
<!-- VIEW -->
<div class="modal fade" id="view-discipline-popup" tabindex="-1" role="dialog" aria-labelledby="view-discipline-label"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="edit-discipline-label">View Disciplinary Issue</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <form id="view-discipline-form">
                @csrf
                <div class="modal-body">
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="discipline_date-edit"><strong>Date*</strong></label>
                            <div class="input-group date" data-target-input="nearest">
                                <input type="text" id="discipline_date-edit" name="discipline_date-edit" class="form-control datetimepicker-input" data-target="#discipline_date-edit" autocomplete="off" placeholder="DD/MM/YYYY" readonly/>
                                <div class="input-group-append" data-target="#discipline_date-edit" data-toggle="datetimepicker">
                                    <div class="input-group-text rounded-right"><i class="far fa-calendar-alt"></i></div>
                                </div>
                                <div id="discipline_date-error" class="invalid-feedback">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label><strong>Title*</strong></label>
                            <input name="discipline_title-edit" id="discipline_title-edit" type="text" class="form-control" placeholder="" value="" readonly >
                            <div id="discipline_title-error" class="invalid-feedback">

                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label><strong>Description*</strong></label>
                            <textarea  name="discipline_desc-edit" id="discipline_desc-edit "class="form-control" value="" rows="8" readonly></textarea>
                            <div id="discipline_desc-error" class="invalid-feedback">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label><strong>Investigated By*</strong></label>
                            <input name="created_by-edit" id="created_by-edit" type="text" class="form-control" placeholder="" value="" readonly="">
                            <div id="created_by-error" class="invalid-feedback">

                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label><strong>Attachment</strong></label>
                             <div id="attach_view">

                             </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- END VIEW -->
<!-- DELETE -->
{{-- DELETE ASSET --}}
<div class="modal fade" id="confirm-delete-discipline-modal" tabindex="-1" role="dialog" aria-labelledby="confirm-delete-discipline-label"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirm-delete-discipline-label">Confirm Delete</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
            </div>
            <div class="modal-body">
                    <p>Are you sure want to delete?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="delete-discipline-submit">Delete</button>
            </div>
        </div>
    </div>
</div>
<!-- END DELETE -->
<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                 <div class="modal-header">
                <h5 class="modal-title" id="confirm-delete-discipline-label">Confirm Delete</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                </button>
                 </div>
                <div class="modal-body">
                    <p>Are you sure want to delete?</p>
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-danger btn-ok">Delete</a>
                </div>
            </div>
        </div>
</div>
<div class="tab-pane fade show active p-3" id="nav-overview" role="tabpanel" aria-labelledby="nav-overview-tab">
	<div class="card">
		<div class="card-body">
		<h5><strong>Personal Career Development</strong></h5>
        <div class="bar"></div>
        <div class="timeline">
        	@foreach($jobs as $job)
          	<div class="entry">
           		<h6><u><b>{{ Carbon\Carbon::parse($job->start_date)->format('d/m/Y') }}</b></u></h6>
            	<br>{!!$job->position_name ? $job->position_name : '<strong>(not set)</strong>'!!}</span>
                <br>{!!$job->department_name ? $job->department_name : '<strong>(not set)</strong>'!!}</span>
                <br>{!!$job->section_name ? $job->section_name : '<strong>(not set)</strong>'!!}</span>
                <br>{{$job->branch_name}}
                <br>{!!$job->cost ? $job->cost : '<strong>(not set)</strong>'!!}</span>
                <br>{!!$job->status ? $job->status : '<strong>(not set)</strong>'!!}</span>
          	</div>
          	@endforeach
        </div>
	</div>
</div>
	<br>
	<div class="card">
		<div class="card-body">
		<h5><strong>Discipline Issue</strong></h5>
    <div class="row pb-3">
        <div class="col-auto mr-auto"></div>
        <div class="col-auto">
        	
            <button type="button" class="btn btn-primary waves-effect" data-toggle="modal" data-target="#add-discipline-popup">
                Add 
            </button>
            
        </div>
    </div>
    <table class="hrms-primary-data-table table w-100" id="employee-overview-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Date</th>
                <th>Title</th>
                <th>Action</th>
            </tr>
        </thead>
    </table>
	</div>
</div>
<br>
</div>
@section('scripts')

<script>
	 $('#discipline_date').datetimepicker({
        format: 'DD/MM/YYYY'
    });
   
    $('#discipline_date-edit').css('caret-color', 'transparent');

     $('#discipline_date-edit').datetimepicker({
        format: 'DD/MM/YYYY'
    });
   
    $('#discipline_date').css('caret-color', 'transparent');

    var overviewDisciplineTable = $('#employee-overview-table').DataTable({
        "bInfo": true,
        "bDeferRender": true,
        "serverSide": true,
        "bStateSave": true,
        "ajax": "{{ route('admin.employees.dt.overview', ['id' => $id]) }}",
        "columnDefs": [ {
            "targets": 3,
            "orderable": false
        } ],
        "columns": [{
                render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            {
               "data": "discipline_date",
                 render: function (data, type, row, meta) 
                    {
                        return moment(data).format('DD/MM/YYYY');
                    }  
            },
            {
                "data": "discipline_title"
            },
            {
                "data": null,
                render: function (data, type, row, meta) {
                    return `<button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-current="${encodeURI(JSON.stringify(row))}" data-target="#view-discipline-popup"><i class="fa fa-eye"></i></button>
                    ` + `<button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-current="${encodeURI(JSON.stringify(row))}" data-target="#edit-discipline-popup"><i class="far fa-edit"></i></button>
					` + `
                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-current="${encodeURI(JSON.stringify(row))}" data-target="#confirm-delete-discipline-modal"><i class="far fa-trash-alt"></i></button>
					
                    `;
                }
            }
        ]
    });


        // ADD
        $('#add-discipline-popup').on('show.bs.modal', function (event) {
            clearEmployeeAssetError('#add-discipline-form');
        });
        $('#add-discipline-form #add-discipline-submit').click(function(e){
            e.preventDefault();
             var form = document.forms.namedItem("add-discipline-form");
            var formdata = new FormData(form);
            clearEmployeeAssetError('#add-discipline-form');
            $.ajax({
                url: "{{ route('admin.employees.overview.post', ['id' => $id]) }}",
                type: 'POST',
                contentType: false,
                processData: false,
                data:formdata,
                success: function(data) {
                    showAlert(data.success);
                    overviewDisciplineTable.ajax.reload();
                    $('#add-discipline-popup').modal('toggle');
                    clearDisciplineModal('#add-discipline-form')
                },
                error: function(xhr) {
                    if(xhr.status == 422) {
                        var errors = xhr.responseJSON.errors;
                        console.log("Error: ", xhr);
                        for (var errorField in errors) {
                            if (errors.hasOwnProperty(errorField)) {
                                console.log("Error: ", errorField);
                                switch(errorField) {
                                    case 'discipline_title':
                                        $('#add-discipline-form input[name=discipline_title]').addClass('is-invalid');
                                        $('#add-discipline-form #discipline_title-error').html('<strong>' + errors[errorField][0] + '</strong>');
                                    break;
                                    case 'discipline_desc':
                                        $('#add-discipline-form input[name=discipline_desc]').addClass('is-invalid');
                                        $('#add-discipline-form #discipline_desc-error').html('<strong>' + errors[errorField][0] + '</strong>');
                                    break;
                                    case 'discipline_date':
                                        $('#add-discipline-form input[name=discipline_date]').addClass('is-invalid');
                                        $('#add-discipline-form #discipline_date-error').html('<strong>' + errors[errorField][0] + '</strong>');
                                    break;
                                    case 'discipline_attach':
                                        $('#add-discipline-form input[name=discipline_attach]').addClass('is-invalid');
                                        $('#add-discipline-form #discipline_attach-error').html('<strong>' + errors[errorField][0] + '</strong>');
                                    break;
                                }
                            }
                        }
                    }
                }
            });
        });
        //VIEW
                var editId = null;
        $('#view-discipline-popup').on('show.bs.modal', function (event) {
            clearBankAccountError('#view-discipline-form');
            var button = $(event.relatedTarget)
            var currentData = JSON.parse(decodeURI(button.data('current')))
            //console.log('Data: ', currentData)

            editId = currentData.id;
            $.ajax({
                url: "{{ route('admin.employees.disciplineAttach') }}",
                type: 'GET',
                data: {
                    id: editId
                },
                error: function(xhr) {
                    console.log("Error: ", xhr);
                },
                success: function(data) {
                    //console.log(data);
                    jQuery('#attach_view').html('');
                    for(i=0; i<data.length; i++) {
                        var attachmentId = data[i]['id'];
                        var url = '{!! route('admin.employees.disciplineAttach.delete', ":id") !!}';
                        url = url.replace(':id', attachmentId);  
                        $('#attach_view').append('<a href="/storage/emp_id_'+{{$id}}+'/discipline/'+data[i]['discipline_attach']+'" target="_blank">'+data[i]['discipline_attach']+'</a> <br>');
                    }
                }
            });
            $('#view-discipline-form input[name=discipline_title-edit]').val(currentData.discipline_title);
            $('#view-discipline-form input[name=created_by-edit]').val(currentData.investigateBy);
            $('#view-discipline-form textarea[name=discipline_desc-edit]').val(currentData.discipline_desc);
            if(currentData.discipline_date!=null){
                formatDisciplineDate= $.datepicker.formatDate("d/mm/yy", new Date(currentData.discipline_date));
                $('#view-discipline-form #discipline_date-edit').val(formatDisciplineDate);
            } else {
                $('#view-discipline-form #discipline_date-edit').val();
            }
        });

        // EDIT
        var editId = null;
        $('#edit-discipline-popup').on('show.bs.modal', function (event) {
            clearBankAccountError('#edit-discipline-form');
            var button = $(event.relatedTarget)
            var currentData = JSON.parse(decodeURI(button.data('current')))
            //console.log('Data: ', currentData)

            editId = currentData.id;
           $.ajax({
                url: "{{ route('admin.employees.disciplineAttach') }}",
                type: 'GET',
                data: {
                    id: editId
                },
                error: function(xhr) {
                    console.log("Error: ", xhr);
                },
                success: function(data) {
                    //console.log(data);
                    jQuery('#attach').html('');
                    for(i=0; i<data.length; i++) {
                        var attachmentId = data[i]['id'];
                        var url = '{!! route('admin.employees.disciplineAttach.delete', ":id") !!}';
                        url = url.replace(':id', attachmentId);   
                        $('#attach').append('<a href="/storage/emp_id_'+{{$id}}+'/discipline/'+data[i]['discipline_attach']+'" target="_blank">'+data[i]['discipline_attach']+'</a> <a data-href="'+url+'" href="#" data-toggle="modal" data-target="#confirm-delete"><i class="fa fa-times" aria-hidden="true"></i></a><br>');
                    }
                }
            });
            $('#edit-discipline-form input[name=discipline_title-edit]').val(currentData.discipline_title);
            $('#edit-discipline-form input[name=created_by-edit]').val(currentData.investigateBy);
            $('#edit-discipline-form textarea[name=discipline_desc-edit]').val(currentData.discipline_desc);
            if(currentData.discipline_date!=null){
                formatDisciplineDate= $.datepicker.formatDate("d/mm/yy", new Date(currentData.discipline_date));
                $('#edit-discipline-form #discipline_date-edit').val(formatDisciplineDate);
            } else {
                $('#edit-discipline-form #discipline_date-edit').val();
            }
        });

        var editRouteTemplate = "{{ route('admin.employees.overview.edit.post', ['emp_id' => $id, 'id' => '<<id>>']) }}";
        $('#edit-discipline-submit').click(function(e){
            var editRoute = editRouteTemplate.replace(encodeURI('<<id>>'), editId);
             e.preventDefault();
             var form = document.forms.namedItem("edit-discipline-form");
            var formdata = new FormData(form);
            clearEmployeeAssetError('#edit-assets-form');
            $.ajax({
                url: editRoute,
                type: 'POST',
                data: formdata,
                contentType: false,
                processData: false,
                success: function(data) {
                    showAlert(data.success);
                    overviewDisciplineTable.ajax.reload();
                    $('#edit-discipline-popup').modal('toggle');
                    clearDisciplineModal('#edit-discipline-form');
                },
                error: function(xhr) {
                    if(xhr.status == 422) {
                        var errors = xhr.responseJSON.errors;
                        console.log("Error: ", xhr);
                        for (var errorField in errors) {
                            if (errors.hasOwnProperty(errorField)) {
                                console.log("Error: ", errorField);
                                switch(errorField) {
                                    case 'discipline_title':
                                        $('#edit-discipline-form input[name=discipline_title-edit]').addClass('is-invalid');
                                        $('#edit-discipline-form #discipline_title-error').html('<strong>' + errors[errorField][0] + "</strong>");
                                    break;
                                    case 'discipline_desc':
                                        $('#edit-discipline-form textarea[name=discipline_desc-edit]').addClass('is-invalid');
                                        $('#edit-discipline-form #discipline_desc-error').html('<strong>' + errors[errorField][0] + "</strong>");
                                    break;
                                    case 'discipline_date':
                                        $('#edit-discipline-form #discipline_date-edit').addClass('is-invalid');
                                        $('#edit-discipline-form #discipline_date-error').html('<strong>' + errors[errorField][0] + "</strong>");
                                    break;
                                    case 'discipline_attach':
                                        $('#edit-discipline-form #discipline_attach').addClass('is-invalid');
                                        $('#edit-discipline-form #discipline_attach-error').html('<strong>' + errors[errorField][0] + "</strong>");
                                    break;
                                }
                            }
                        }
                    }
                }
            });
        });

        // DELETE
              
        var deleteId = null;
        $('#confirm-delete-discipline-modal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget)
            var currentData = JSON.parse(decodeURI(button.data('current')))
            console.log('Data: ', currentData)
            deleteId = currentData.id;
        });

        var deleteRouteTemplate = "{{ route('admin.settings.overview.delete', ['emp_id' => $id, 'id' => '<<id>>']) }}";
        $('#delete-discipline-submit').click(function(e){
            var deleteRoute = deleteRouteTemplate.replace(encodeURI('<<id>>'), deleteId);
            e.preventDefault();
            $.ajax({
                url: deleteRoute,
                type: 'GET',
                data: {
                    _token: '{{ csrf_token() }}',
                    id: deleteId
                },
                success: function(data) {
                    showAlert(data.success);
                    overviewDisciplineTable.ajax.reload();
                    $('#confirm-delete-discipline-modal').modal('toggle');
                },
                error: function(xhr) {
                    if(xhr.status == 422) {
                        var errors = xhr.responseJSON.errors;
                        console.log("Error 422: ", xhr);
                    }
                    console.log("Error: ", xhr);
                }
            });
        });
        function clearDisciplineModal(htmlId) {
	        $(htmlId + ' input[name=discipline_title]').val('');
	        $(htmlId + ' input[name=discipline_desc]').val('');
	        $(htmlId + ' input[name=acc-status]').val('');
	        $(htmlId + ' input[name=discipline_attach]').val('');

	        $(htmlId + ' input[name=discipline_title]').removeClass('is-invalid');
	        $(htmlId + ' input[name=discipline_desc]').removeClass('is-invalid');
	        $(htmlId + ' input[name=discipline_date]').removeClass('is-invalid');
	        $(htmlId + ' input[name=discipline_attach]').removeClass('is-invalid');
    	}

    	function clearDisciplineError(htmlId) {
	        $(htmlId + ' input[name=discipline_title]').removeClass('is-invalid');
	        $(htmlId + ' input[name=discipline_desc]').removeClass('is-invalid');
	        $(htmlId + ' input[name=discipline_date]').removeClass('is-invalid');
	        $(htmlId + ' input[name=discipline_attach]').removeClass('is-invalid');
    	}

        function showAlert(message) {
        $('#alert-container').html(`<div class="alert alert-primary alert-dismissible fade show" role="alert">
            <span id="alert-message">${message}</span>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>`)
    }

        $('#confirm-delete').on('show.bs.modal', function(e) {
            $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
            
            $('.debug-url').html('Delete URL: <strong>' + $(this).find('.btn-ok').attr('href') + '</strong>');
        });
    </script>
<style type="text/css">
.timeline {
  white-space: nowrap;
  overflow-x: scroll;
  padding: 30px 0 10px 0;
  position: relative;
}

.entry {
  display: inline-block;
  vertical-align: top;
  background: #ffffff;
  color: #000000;
  padding: 10px;
  font-size: 12px;
  text-align: center;
  position: relative;
  //border-top: 4px solid #06182E;
  border-radius: 3px;
  min-width: 200px;
  max-width: 500px;
}


.entry:after {
  content: '';
  display: block;
  background: #eee;
  width: 14px;
  height: 14px;
  border-radius: 6px;
  //border: 3px solid #06182E;
  position: absolute;
  left: 50%;
  top: -25px;
  margin-left: -6px;
}

.bar {
  height: 1px;
  background: #eee;
  width: 100%;
  position: relative;
  top: 13px;
  left: 0;
}
</style>
@append