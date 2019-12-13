{{-- TABLE JOB COMPANY --}}
<div class="tab-pane fade show active" id="nav-job-company" role="tabpanel" aria-labelledby="nav-job-company-tab">
    <div class="row pb-3">
        <div class="col-auto mr-auto"></div>
        <div class="col-auto">
        	@can(PermissionConstant::ADD_JOB_COMPANY)
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addJobCompanyPopup">
                Add Company
            </button>
            @endcan
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="float-right tableTools-container"></div>
            <table class="hrms-data-table compact w-100 t-2" id="job-company-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Company Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>


@section('scripts')
<script>

</script>
@append
