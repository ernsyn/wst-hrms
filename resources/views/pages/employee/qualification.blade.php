
                        <div class="tab-pane fade show p-3" id="nav-qualification" role="tabpanel" aria-labelledby="nav-qualification-tab">
                                {{-- Company --}}
                                <div class="col-md-12">COMPANY</div>
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
                                    {{--
                                    <tbody>
                                        @foreach($companies as $row)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$row['company']}}</td>
                                            <td>{{$row['position']}}</td>
                                            <td>{{$row['start_date']}}</td>
                                            <td>{{$row['end_date']}}</td>
                                            <td>{{$row['note']}}</td>
                                            <td>Action</td>
                                        </tr>
                                        @endforeach
                                    </tbody> --}}
                                </table>
                                <div class="dropdown-divider pb-3"></div>
                                {{-- Education --}}
                                <div class="col-md-12">EDUCATION</div>
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
                                    {{--
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
                                            <td>Action</td>
                                        </tr>
                                        @endforeach
                                    </tbody> --}}
                                </table>
                                <div class="dropdown-divider pb-3"></div>
                                {{-- Skill --}}
                                <div class="col-md-12">SKILL</div>
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
                                    {{--
                                    <tbody>
                                        @foreach($skills as $row)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$row['skill']}}</td>
                                            <td>{{$row['year_experience']}}</td>
                                            <td>{{$row['competency']}}</td>
                                            <td>Action</td>
                                        </tr>
                                        @endforeach
                                    </tbody> --}}
                                </table>
                            </div>