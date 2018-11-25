<div class="tab-pane fade show p-3" id="nav-workdays" role="tabpanel" aria-labelledby="nav-work-days">
    <div class="container">
        <div class="card">
            <!-- Add Working Days -->
            <form id="add-working-day-form">
                <div class="card-body">
                    @csrf
                    <div class="row p-3">
                        <div class="form-group row w-100">
                            <label class="col-md-12 col-form-label">Template</label>
                            <div class="col-md-12">
                                   <select class="form-control{{ $errors->has('departments') ? ' is-invalid' : '' }}" name="working_day" id="working_day">
                                    <option value="">Select a Template</option>
                                    @foreach(App\EmployeeWorkingDay::templates()->get() as $working_day)
                                    <option value="{{ $working_day->id }}">{{ $working_day->template_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row w-100">
                            <label class="col-md-12 col-form-label">Monday*</label>
                            <div class="col-md-12">
                                <input id="monday" type="number" min="0" max="1" step="0.5" class="form-control{{ $errors->has('monday') ? ' is-invalid' : '' }}" placeholder=""
                                    name="monday" value="" required>
                                    @if ($errors->has('monday'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('monday') }}</strong>
                                    </span>
                                    @endif
                            </div>
                        </div>
                        <div class="form-group row w-100">
                            <label class="col-md-12 col-form-label">Tuesday*</label>
                            <div class="col-md-12">
                                <input id="tuesday" type="number" min="0" max="1" step="0.5" class="form-control{{ $errors->has('tuesday') ? ' is-invalid' : '' }}" placeholder=""
                                    name="tuesday" value="" required>
                                    @if ($errors->has('tuesday'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('tuesday') }}</strong>
                                    </span>
                                    @endif
                            </div>
                        </div>
                        <div class="form-group row w-100">
                            <label class="col-md-12 col-form-label">Wednesday*</label>
                            <div class="col-md-12">
                                <input id="wednesday" type="number" min="0" max="1" step="0.5" class="form-control{{ $errors->has('wednesday') ? ' is-invalid' : '' }}" placeholder=""
                                    name="wednesday" value="" required>
                                    @if ($errors->has('wednesday'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('wednesday') }}</strong>
                                    </span>
                                    @endif
                            </div>
                        </div>
                        <div class="form-group row w-100">
                            <label class="col-md-12 col-form-label">Thursday*</label>
                            <div class="col-md-12">
                                <input id="thursday" type="number" min="0" max="1" step="0.5" class="form-control{{ $errors->has('thursday') ? ' is-invalid' : '' }}" placeholder=""
                                    name="thursday" value="" required>
                                    @if ($errors->has('thursday'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('thursday') }}</strong>
                                    </span>
                                    @endif
                            </div>
                        </div>
                        <div class="form-group row w-100">
                            <label class="col-md-12 col-form-label">Friday*</label>
                            <div class="col-md-12">
                                <input id="friday" type="number" min="0" max="1" step="0.5" class="form-control{{ $errors->has('friday') ? ' is-invalid' : '' }}" placeholder=""
                                    name="friday" value="" required>
                                    @if ($errors->has('friday'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('friday') }}</strong>
                                    </span>
                                    @endif
                            </div>
                        </div>
                        <div class="form-group row w-100">
                            <label class="col-md-12 col-form-label">Saturday*</label>
                            <div class="col-md-12">
                                <input id="saturday" type="number" min="0" max="1" step="0.5" class="form-control{{ $errors->has('saturday') ? ' is-invalid' : '' }}" placeholder=""
                                    name="saturday" value="" required>
                                    @if ($errors->has('saturday'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('saturday') }}</strong>
                                    </span>
                                    @endif
                            </div>
                        </div>
                        <div class="form-group row w-100">
                            <label class="col-md-12 col-form-label">Sunday*</label>
                            <div class="col-md-12">
                                <input id="sunday" type="number" min="0" max="1" step="0.5" class="form-control{{ $errors->has('sunday') ? ' is-invalid' : '' }}" placeholder=""
                                    name="sunday" value="" required>
                                    @if ($errors->has('sunday'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('sunday') }}</strong>
                                    </span>
                                    @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button id="add-submit" type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
                    <a role="button" class="btn btn-secondary" href="{{ URL::previous() }}">Cancel</a>
                </div>
                <div id="message-box"></div>
            </form>            
        </div>
    </div>
</div>

@section('scripts')
<script>
    $.get("{{ route('admin.employees.id.working-day.employee', ['id' => $id]) }}", function(data, status) {
        $("#monday").val(data[0].monday);
        $("#tuesday").val(data[0].tuesday);
        $("#wednesday").val(data[0].wednesday);
        $("#thursday").val(data[0].thursday);
        $("#friday").val(data[0].friday);
        $("#saturday").val(data[0].saturday);
        $("#sunday").val(data[0].sunday);
    })

    $("#working_day").change(function(){
        $.get("id/working-day/" + this.value, function(data, status){
            $("#monday").val(data[0].monday);
            $("#tuesday").val(data[0].tuesday);
            $("#wednesday").val(data[0].wednesday);
            $("#thursday").val(data[0].thursday);
            $("#friday").val(data[0].friday);
            $("#saturday").val(data[0].saturday);
            $("#sunday").val(data[0].sunday);
        }).fail(function() {
            $("#monday").val("");
            $("#tuesday").val("");
            $("#wednesday").val("");
            $("#thursday").val("");
            $("#friday").val("");
            $("#saturday").val("");
            $("#sunday").val("");
        });
    });

    $(function(){
        // ADD
       $('#add-working-day-form #add-submit').click(function(e){
          e.preventDefault();
          $.ajax({
            url: "{{ route('admin.employees.working-days.post', ['id' => $id]) }}",
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                monday: $('#add-working-day-form #monday').val(),
                tuesday: $('#add-working-day-form #tuesday').val(),
                wednesday: $('#add-working-day-form #wednesday').val(),
                thursday: $('#add-working-day-form #thursday').val(),
                friday: $('#add-working-day-form #friday').val(),
                saturday: $('#add-working-day-form #saturday').val(),
                sunday: $('#add-working-day-form #sunday').val()
            },
            success: function(data) {
                $("#monday").val("");
                $("#tuesday").val("");
                $("#wednesday").val("");
                $("#thursday").val("");
                $("#friday").val("");
                $("#saturday").val("");
                $("#sunday").val("");

                $("#message-box").html(`<div class="alert alert-primary alert-dismissible fade show" role="alert">
                    <span id="alert-message">`+data.success+`</span>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>`);
            },
            error: function(xhr) {
                if(xhr.status == 422) {
                    var errors = xhr.responseJSON.errors;
                    console.log("Error: ", xhr);
                    for (var errorField in errors) {
                        if (errors.hasOwnProperty(errorField)) {
                            console.log("Error: ", errorField);
                        }
                    }
                }               
             }
          });
       });
    });
</script>
@append
