@extends('enumerator.enumerator_dashboard')
@section('content')
    <style>
        .image_container {
            width: 240px;
            height: 220px;
        }

        .image_container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
    </style>
    <div class="page-content">
        {{-- <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
            <div>
                <h4 class="mb-3 mb-md-0">LOPEZ FAMILY</h4>
            </div>

        </div> --}}

        <div class="row">
            <div class="col-lg-12 col-xl-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="row  d-flex flex-column align-items-center">
                            <div class="col-12 grid-margin stretch-card d-flex align-items-center  justify-content-center">
                                <div class="image_container border border-dark">
                                    <img src="{{ asset('upload/households/add-image.png') }}" alt="">
                                </div>
                            </div>
                            <div class="row  d-flex flex-column align-items-center">
                                <div class="col-lg-8 col-xl-8 col-sm-12">
                                    <div class="row">
                                        <div class="col-lg-6 col-xl-6 col-sm-12 d-flex gap-2 align-items-center">
                                            <span>Household
                                                Number : </span><span class="fw-bold">42123018-00091</span>
                                        </div>
                                        <div class="col-lg-6 col-xl-6 col-sm-12 d-flex gap-2 align-items-center">
                                            <span>Address : </span><span class="fw-bold">Block 10 Lot 78
                                                Brgy. Elises GMA, Cavite</span>
                                        </div>
                                        <div
                                            class="col-12 mt-3 d-flex gap-2 align-items-center justify-content-center mb-4">
                                            <button class="btn btn-inverse-primary" data-bs-toggle="modal"
                                                data-bs-target="#manage">Manage Household</button>
                                            <button class="btn btn-inverse-success" data-bs-toggle="modal"
                                                data-bs-target="#addMember">Add Member</button>
                                        </div>

                                        <div class="modal fade" id="manage" data-bs-backdrop="static"
                                            data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                                            aria-hidden="true">
                                            <div class="modal-dialog ">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="addMemberLabel">
                                                            Manage Household
                                                        </h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body ">
                                                        <div class="row">
                                                            <div class="col-lg-4 col-md-4 col-sm-4 mb-3">
                                                                <label for="block">House No./ Block /Lot</label>
                                                                <input type="text" class="form-control" name="block"
                                                                    required="" autocomplete="off"
                                                                    value="Block 10 Lot 78">
                                                            </div>
                                                            <div class="col-lg-4 col-md-4 col-sm-4 mb-3">
                                                                <label for="lastname">Street</label>
                                                                <input type="text" class="form-control" name="street"
                                                                    required="" autocomplete="off">
                                                            </div>
                                                            <div class="col-lg-4 col-md-4 col-sm-4 mb-3">
                                                                <label for="lastname">Subdivision/ Village</label>
                                                                <input type="text" class="form-control"
                                                                    name="subdivision" required="" autocomplete="off">
                                                            </div>

                                                            <div class="col-lg-4 col-md-4 col-sm-4 mb-3">
                                                                <label for="cpassword">Barangay</label>
                                                                <select class="form-select"
                                                                    aria-label="Default select example" id="access_level"
                                                                    name="access_level" required="">
                                                                    <option value="Unknown">Choose Barangay
                                                                    </option>

                                                                    <option value="elises" selected>Elises</option>

                                                                </select>
                                                            </div>
                                                            <div class="col-lg-4 col-md-4 col-sm-4 mb-3">
                                                                <label for="lastname">Municipality</label>
                                                                <input type="text" class="form-control"
                                                                    name="municipality" autocomplete="off" value="GMA"
                                                                    disabled>
                                                            </div>
                                                            <div class="col-lg-4 col-md-4 col-sm-4 mb-3">
                                                                <label for="lastname">Province</label>
                                                                <input type="text" class="form-control" name="province"
                                                                    autocomplete="off" value="Cavite" disabled>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class=" modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>
                                                        <button type="button" class="btn btn-success"
                                                            data-bs-dismiss="modal">Save</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="table-responsive">
                                                <table id="dataTableExample" class="table ">
                                                    <thead>
                                                        <tr>
                                                            <th colspan="2">Household Members</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <div class="d-flex flex-column">
                                                                    <span>Gabriel, Lance Tristan</span>
                                                                    <span class="text-muted">Male, age 23, Household
                                                                        Head</span>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div
                                                                    class="d-flex gap-2 align-items-center justify-content-center">
                                                                    <a class="btn btn-sm btn-inverse-warning"><i
                                                                            data-feather="help-circle"></i></a>
                                                                    <a class="btn btn-sm btn-inverse-primary"><i
                                                                            data-feather="edit" data-bs-toggle="modal"
                                                                            data-bs-target="#editMember"></i></a>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <div class="d-flex flex-column">
                                                                    <span>Gabriel, Jessa</span>
                                                                    <span class="text-muted">Female, age 22, Spouse</span>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div
                                                                    class="d-flex gap-2 align-items-center justify-content-center">
                                                                    <a class="btn btn-sm btn-inverse-warning"><i
                                                                            data-feather="help-circle"></i></a>
                                                                    <a href=""
                                                                        class="btn btn-sm btn-inverse-primary"><i
                                                                            data-feather="edit"></i></a>
                                                                </div>
                                                            </td>
                                                        </tr>

                                                        <div class="modal fade" id="editMember" data-bs-backdrop="static"
                                                            data-bs-keyboard="false" tabindex="-1"
                                                            aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                            <div class="modal-dialog ">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h1 class="modal-title fs-5" id="addMemberLabel">
                                                                            Edit Household Member
                                                                        </h1>
                                                                        <button type="button" class="btn-close"
                                                                            data-bs-dismiss="modal"
                                                                            aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body ">
                                                                        <div class="row">
                                                                            <div class="col-lg-6 col-md-6 col-sm-12 mb-3">
                                                                                <label for="firstname">First
                                                                                    Name</label>
                                                                                <input type="text" class="form-control"
                                                                                    name="firstname" required=""
                                                                                    autocomplete="off"
                                                                                    value="Lance Tristan">
                                                                            </div>
                                                                            <div class="col-lg-6 col-md-6 col-sm-12 mb-3">
                                                                                <label for="lastname">Middle
                                                                                    Name</label>
                                                                                <input type="text" class="form-control"
                                                                                    name="middlename" required=""
                                                                                    autocomplete="off" value="B">
                                                                            </div>
                                                                            <div
                                                                                class="col-lg-10 col-md-10 col-sm-10 mb-3">
                                                                                <label for="lastname">Last
                                                                                    Name</label>
                                                                                <input type="text" class="form-control"
                                                                                    name="lastname" required=""
                                                                                    autocomplete="off" value="Gabriel">
                                                                            </div>
                                                                            <div class="col-lg-2 col-md-2 col-sm-2 mb-3">
                                                                                <label for="lastname">Suffix</label>
                                                                                <input type="text" class="form-control"
                                                                                    name="suffix" required=""
                                                                                    autocomplete="off">
                                                                            </div>
                                                                            <div class="col-lg-6 col-md-6 col-sm-6 mb-3">
                                                                                <label for="lastname">Date of Birth</label>
                                                                                <input type="date" class="form-control"
                                                                                    name="birthdate" required=""
                                                                                    autocomplete="off" value="2001-01-01">
                                                                            </div>
                                                                            <div class="col-lg-6 col-md-6 col-sm-6 mb-3">
                                                                                <label for="lastname">Contact
                                                                                    Number</label>
                                                                                <input type="number" class="form-control"
                                                                                    name="contact_number" required=""
                                                                                    autocomplete="off"
                                                                                    value="09186702483">
                                                                            </div>
                                                                            <div
                                                                                class="col-lg-12 col-md-12 col-sm-12 mb-3">
                                                                                <label for="cpassword">Household
                                                                                    Position</label>
                                                                                <select class="form-select"
                                                                                    aria-label="Default select example"
                                                                                    id="access_level" name="access_level"
                                                                                    required="" disabled>
                                                                                    <option value="Unknown"
                                                                                        selected="">Choose Household
                                                                                        Position
                                                                                    </option>
                                                                                    <option value="head" selected>Head
                                                                                    </option>
                                                                                    <option value="spouse">Spouse</option>
                                                                                    <option value="daughter">Daughter
                                                                                    </option>
                                                                                    <option value="son">Son
                                                                                    </option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class=" modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-bs-dismiss="modal">Close</button>
                                                                        <button type="button" class="btn btn-success"
                                                                            data-bs-dismiss="modal">Save</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="modal fade" id="addMember" data-bs-backdrop="static"
                                                            data-bs-keyboard="false" tabindex="-1"
                                                            aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                            <div class="modal-dialog ">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h1 class="modal-title fs-5" id="addMemberLabel">
                                                                            Add Household Member
                                                                        </h1>
                                                                        <button type="button" class="btn-close"
                                                                            data-bs-dismiss="modal"
                                                                            aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body ">
                                                                        <div class="row">
                                                                            <div class="col-lg-6 col-md-6 col-sm-12 mb-3">
                                                                                <label for="firstname">First
                                                                                    Name</label>
                                                                                <input type="text" class="form-control"
                                                                                    name="firstname" required=""
                                                                                    autocomplete="off">
                                                                            </div>
                                                                            <div class="col-lg-6 col-md-6 col-sm-12 mb-3">
                                                                                <label for="lastname">Middle
                                                                                    Name</label>
                                                                                <input type="text" class="form-control"
                                                                                    name="middlename" required=""
                                                                                    autocomplete="off">
                                                                            </div>
                                                                            <div
                                                                                class="col-lg-10 col-md-10 col-sm-10 mb-3">
                                                                                <label for="lastname">Last
                                                                                    Name</label>
                                                                                <input type="text" class="form-control"
                                                                                    name="lastname" required=""
                                                                                    autocomplete="off">
                                                                            </div>
                                                                            <div class="col-lg-2 col-md-2 col-sm-2 mb-3">
                                                                                <label for="lastname">Suffix</label>
                                                                                <input type="text" class="form-control"
                                                                                    name="suffix" required=""
                                                                                    autocomplete="off">
                                                                            </div>
                                                                            <div class="col-lg-6 col-md-6 col-sm-6 mb-3">
                                                                                <label for="lastname">Date of Birth</label>
                                                                                <input type="date" class="form-control"
                                                                                    name="birthdate" required=""
                                                                                    autocomplete="off">
                                                                            </div>
                                                                            <div class="col-lg-6 col-md-6 col-sm-6 mb-3">
                                                                                <label for="lastname">Contact
                                                                                    Number</label>
                                                                                <input type="number" class="form-control"
                                                                                    name="contact_number" required=""
                                                                                    autocomplete="off">
                                                                            </div>
                                                                            <div
                                                                                class="col-lg-12 col-md-12 col-sm-12 mb-3">
                                                                                <label for="cpassword">Household
                                                                                    Position</label>
                                                                                <select class="form-select"
                                                                                    aria-label="Default select example"
                                                                                    id="access_level" name="access_level"
                                                                                    required="">
                                                                                    <option value="Unknown"
                                                                                        selected="">Choose Household
                                                                                        Position
                                                                                    </option>
                                                                                    <option value="spouse">Spouse</option>
                                                                                    <option value="daughter">Daughter
                                                                                    </option>
                                                                                    <option value="son">Son
                                                                                    </option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class=" modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-bs-dismiss="modal">Close</button>
                                                                        <button type="button" class="btn btn-success"
                                                                            data-bs-dismiss="modal">Save</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>




    </div>

    {{-- <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
    <script>
        const amenitiesCount = $('#amenitiesCount');

        $(document).ready(function() {

            function amenitiesNumber() {
                $.ajax({
                    url: '{{ route('count.amenities') }}',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    type: 'POST',
                    success: function(response) {

                        amenitiesCount.text(response.toLocaleString())
                    }
                })
            }
            amenitiesNumber()


            // Pusher.logToConsole = true;
            var pusher = new Pusher('00710d032d91ced3b23b', {
                cluster: 'ap1',
                encrypted: true
            });

            var channel = pusher.subscribe('amenities');
            channel.bind('App\\Events\\AmenitiesUpdated', function(data) {
                // alert(JSON.stringify(data));
                amenitiesNumber()

            });
        });
    </script> --}}
@endsection
