<!-- ADD ATTACHMENTS -->
<div class="modal fade" id="add-attachment-popup" tabindex="-1" role="dialog" aria-labelledby="add-attachment-label" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="add-attachment-label">Add Attachment</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                <form id="add-attachment-form">
                    <div class="modal-body">
                        @csrf
                        <div class="form-row">
                            <div class="col-md-12 mb-3">
                                <label for="name"><strong>Name*</strong></label>
                                <input id="name" type="text" class="form-control" placeholder="" value="" readonly>
                                <div id="name-error" class="invalid-feedback">
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-12 mb-3">
                                <label for="notes"><strong>Notes*</strong></label>
                                <input id="notes" type="text" class="form-control" placeholder="" value="" readonly>
                                <div id="notes-error" class="invalid-feedback">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button id="add-attachment-submit" type="submit" class="btn btn-primary">
                            {{ __('Submit') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- UPDATE ATTACHMENTS -->
    <div class="modal fade" id="edit-attachment-popup" tabindex="-1" role="dialog" aria-labelledby="edit-attachment-label" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="edit-attachment-label">View Attachment</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="edit-attachment-form">
                    <div class="modal-body">
                        @csrf
                        <div class="form-row">
                            <div class="col-md-12 mb-3">
                                <label for="name"><strong>Name*</strong></label>
                                <input id="name" type="text" class="form-control" placeholder="" value="" readonly>
                                <div id="name-error" class="invalid-feedback">
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-12 mb-3">
                                <label for="notes"><strong>Notes*</strong></label>
                                <input id="notes" type="text" class="form-control" placeholder="" value="" readonly>
                                <div id="notes-error" class="invalid-feedback">
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="modal-footer">
                        <button id="edit-attachment-submit" type="submit" class="btn btn-primary">
                            {{ __('Submit') }}
                        </button>
                    </div> --}}
                </form>
            </div>
        </div>
    </div>

    {{-- DELETE ATTACH--}}
    <div class="modal fade" id="confirm-delete-attachment-modal" tabindex="-1" role="dialog" aria-labelledby="confirm-delete-attachment-label"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirm-delete-attachment-label">Confirm Delete</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure want to delete?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" id="delete-attachment-submit">Delete</button>
                </div>
            </div>
        </div>
    </div>

    {{-- TABLE --}}
    <div class="tab-pane fade show p-3" id="nav-attachments" role="tabpanel" aria-labelledby="nav-attachments-tab">
        {{-- <div class="row pb-3">
            <div class="col-auto mr-auto"></div>
            <div class="col-auto">
                <button type="button" class="btn btn-primary waves-effect" data-toggle="modal" data-target="#add-attachment-popup">
                    Add Attachment
                </button>
            </div>
        </div> --}}
        <table class="hrms-primary-data-table table  w-100" id="attachments-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Notes</th>
                    <th>Action</th>
                </tr>
            </thead>
        </table>
    </div>






    @section('scripts')
    <script>
        var attachmentsTable = $('#attachments-table').DataTable({
            "bInfo": true,
            "bDeferRender": true,
            "serverSide": true,
            "bStateSave": true,
            "ajax": "{{ route('employee.dt.attachments', ['id' => $id]) }}",
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
                    "data": "name"
                },
                {
                    "data": "notes"
                },
                {
                    "data": null,
                    render: function (data, type, row, meta) {
                        return `<button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-current="${encodeURI(JSON.stringify(row))}" data-target="#edit-attachment-popup"><i class="far fa-eye"></i></button>`;
                            // `<button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-current="${encodeURI(JSON.stringify(row))}" data-target="#confirm-delete-attachment-modal"><i class="far fa-trash-alt"></i></button>`;
                    }
                }
            ]
        });

    </script>
    <script type="text/javascript">
        $(function(){
            // ADD ATTACHMENTS
            $('#add-attachment-popup').on('show.bs.modal', function (event) {
                clearAttachmentsError('#add-attachment-form');
            });
            $('#add-attachment-form #add-attachment-submit').click(function(e){
                clearAttachmentsError('#add-attachment-form');
                e.preventDefault();
                $.ajax({
                    url: "{{ route('employee.attachments.post', ['id' => $id]) }}",
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        // Form Data
                        name: $('#add-attachment-form #name').val(),
                        notes: $('#add-attachment-form #notes').val()
                    },
                    success: function(data) {
                        showAlert(data.success);
                        attachmentsTable.ajax.reload();
                        $('#add-attachment-popup').modal('toggle');
                        clearAttachmentsModal('#add-attachment-form');
                    },
                    error: function(xhr) {
                        if(xhr.status == 422) {
                            var errors = xhr.responseJSON.errors;
                            console.log("Error: ", xhr);
                            for (var errorField in errors) {
                                if (errors.hasOwnProperty(errorField)) {
                                    console.log("Error: ", errorField);
                                    switch(errorField) {
                                        case 'name':
                                            $('#add-attachment-form #name').addClass('is-invalid');
                                            $('#add-attachment-form #name-error').html('<strong>' + errors[errorField][0] + "</strong>");
                                        break;
                                        case 'notes':
                                            $('#add-attachment-form #notes').addClass('is-invalid');
                                            $('#add-attachment-form #notes-error').html('<strong>' + errors[errorField][0] + '</strong>');
                                        break;
                                    }
                                }
                            }
                        }
                    }
                });
            });

            // EDIT ATTACHMENT
            var editAttachmentId = null;
            // Function: On Modal Clicked Handler
            $('#edit-attachment-popup').on('show.bs.modal', function (event) {
                clearAttachmentsError('#edit-attachment-form');
                var button = $(event.relatedTarget) // Button that triggered the modal
                var currentData = JSON.parse(decodeURI(button.data('current'))) // Extract info from data-* attributes
                console.log('Data: ', currentData)

                editAttachmentId = currentData.id;

                $('#edit-attachment-form #name').val(currentData.name);
                $('#edit-attachment-form #notes').val(currentData.notes);
            });

            var editAttachmentRouteTemplate = "{{ route('employee.attachments.edit.post', ['emp_id' => $id, 'id' => '<<id>>']) }}";
            $('#edit-attachment-submit').click(function(e){
                clearAttachmentsError('#edit-attachment-form');
                var editAttachmentRoute = editAttachmentRouteTemplate.replace(encodeURI('<<id>>'), editAttachmentId);
                e.preventDefault();
                $.ajax({
                    url: editAttachmentRoute,
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        name: $('#edit-attachment-form #name').val(),
                        notes: $('#edit-attachment-form #notes').val()
                    },
                    success: function(data) {
                        showAlert(data.success);
                        attachmentsTable.ajax.reload();
                        $('#edit-attachment-popup').modal('toggle');
                        clearAttachmentsModal('#edit-attachment-form');
                    },
                    error: function(xhr) {
                        if(xhr.status == 422) {
                            var errors = xhr.responseJSON.errors;
                            console.log("Error: ", xhr);
                            for (var errorField in errors) {
                                if (errors.hasOwnProperty(errorField)) {
                                    console.log("Error: ", errorField);
                                    switch(errorField) {
                                        case 'name':
                                            $('#edit-attachment-form #name').addClass('is-invalid');
                                            $('#edit-attachment-form #name-error').html('<strong>' + errors[errorField][0] + "</strong>");
                                        break;
                                        case 'notes':
                                            $('#edit-attachment-form #notes').addClass('is-invalid');
                                            $('#edit-attachment-form #notes-error').html('<strong>' + errors[errorField][0] + '</strong>');
                                        break;
                                    }
                                }
                            }
                        }
                    }
                });
            });

            // DELETE ATTACHMENT
            var deleteAttachmentId = null;
            // Function: On Modal Clicked Handler
            $('#confirm-delete-attachment-modal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget) // Button that triggered the modal
                var currentData = JSON.parse(decodeURI(button.data('current'))) // Extract info from data-* attributes
                console.log('Data: ', currentData)

                deleteAttachmentId = currentData.id;
            });

            var deleteAttachmentRouteTemplate = "{{ route('employee.attachments.delete', ['emp_id' => $id, 'id' => '<<id>>']) }}";
            $('#delete-attachment-submit').click(function(e){
                var deleteAttachmentRoute = deleteAttachmentRouteTemplate.replace(encodeURI('<<id>>'), deleteAttachmentId);
                e.preventDefault();
                $.ajax({
                    url: deleteAttachmentRoute,
                    type: 'GET',
                    data: {
                        _token: '{{ csrf_token() }}',
                        id: deleteAttachmentId
                    },
                    success: function(data) {
                        showAlert(data.success);
                        attachmentsTable.ajax.reload();
                        $('#confirm-delete-attachment-modal').modal('toggle');
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
        });


        // GENERAL FUNCTIONS
        function clearAttachmentsModal(htmlId) {
            $(htmlId + ' #name').val('');
            $(htmlId + ' #notes').val('');

            $(htmlId + ' #name').removeClass('is-invalid');
            $(htmlId + ' #notes').removeClass('is-invalid');
        }
        function clearAttachmentsError(htmlId) {
            $(htmlId + ' #name').removeClass('is-invalid');
            $(htmlId + ' #notes').removeClass('is-invalid');
        }

        function showAlert(message) {
            $('#alert-container').html(`<div class="alert alert-primary alert-dismissible fade show" role="alert">
                <span id="alert-message">${message}</span>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>`)
        }

    </script>
    @append
