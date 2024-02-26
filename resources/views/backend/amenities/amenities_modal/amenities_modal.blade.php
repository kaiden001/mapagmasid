<div class="modal fade" id="editAmenities" tabindex="-1" aria-labelledby="editAmenitiesLabel" aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content">
            <form class="forms-sample" id="editForm">
                @csrf
                @method('post')
                <div class="modal-header">
                    <h5 class="modal-title" id="editAmenitiesLabel">Edit Amenities</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="amenities_name" class="form-label">Amenities Name</label>
                        <input type="text" name="id" value="{{ $amenitiesData->id }}">
                        <input type="text" name="amenities_name" id="amenities_name" placeholder="Amenities Name"
                            class="form-control" value="{{ $amenitiesData->amenities_name }}">
                        <span class="text-danger error-message"></span>
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="submitEditForm">Save changes</button>
                </div>

            </form>
        </div>
    </div>
</div>
