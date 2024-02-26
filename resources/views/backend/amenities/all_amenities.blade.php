@extends('admin.admin_dashboard')
@section('admin')
    <div class="page-content">

        <nav class="page-breadcrumb">
            <ol class="breadcrumb">

                <button type="button" class="btn btn-inverse-info" data-bs-toggle="modal" data-bs-target="#addAmenities">
                    Add Amenities
                </button>
            </ol>
        </nav>
        <!-- Button trigger modal -->

        <!-- Modal -->
        <div class="modal fade" id="addAmenities" tabindex="-1" aria-labelledby="addAmenitiesLabel" aria-hidden="true">
            <div class="modal-dialog ">
                <div class="modal-content">
                    <form class="forms-sample" id="addForm">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="addAmenitiesLabel">Add Amenities</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="btn-close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="amenities_name" class="form-label">Amenities Name</label>
                                <input type="text" name="amenities_name" id="amenities_name" placeholder="Amenities Name"
                                    class="form-control">
                                <span class="text-danger error-message"></span>
                            </div>


                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" id="submitAddForm">Save changes</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">All Amenities</h6>
                        <div class="table-responsive">
                            <table id="amenities_table" class="table w-100">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Amenities Name</th>
                                        <th>Amenities Name</th>
                                        <th>Amenities Name</th>
                                        <th>Amenities Name</th>
                                        <th>Amenities Name</th>
                                        <th>Amenities Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="modalContent"></div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.1.1/crypto-js.min.js"></script>
    @include('backend/amenities/script.amenities_js')
    <script></script>
@endsection
