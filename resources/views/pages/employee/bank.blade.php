
                        <div class="tab-pane fade show p-3" id="nav-bank" role="tabpanel" aria-labelledby="nav-bank-tab">
                                <table class="table table-bordered table-hover w-100" id="employeeBankTable">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Bank</th>
                                            <th>Account Number</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    {{--
                                    <tbody>
                                        @foreach($banks as $row)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{$row['bank_code']}}</td>
                                            <td>{{$row['acc_no']}}</td>
                                            <td>{{$row['status']}}</td>
                                            <td>Action</td>
                                        </tr>
                                        @endforeach
                                    </tbody> --}}
                                </table>
                                <!-- Modal -->
                                <div class="modal fade" id="bankModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                          </button>
                                            </div>
                                            <div class="modal-body">
                                                ...
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="submit" id="bankupdate" class="btn btn-primary" data-dismiss="modal">Save changes</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>