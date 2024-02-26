<script src="https://js.pusher.com/7.0/pusher.min.js"></script>
<script>
    $(document).ready(function() {



        var table = $('#amenities_table').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                url: '{{ route('get.amenities') }}',
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    // Include CSRF token in the request headers
                },
            },
            "columns": [{
                    "data": "DT_RowIndex",
                },
                {
                    "data": "amenities_name"
                },
                {
                    "data": "amenities_name"
                },
                {
                    "data": "amenities_name"
                },
                {
                    "data": "amenities_name"
                },
                {
                    "data": "amenities_name"
                },
                {
                    "data": "amenities_name"
                },
                {
                    "data": "action",
                    "orderable": false,
                    "searchable": false
                },
            ],
            "order": [
                [0, "desc"]
            ]
        });
        // var channel = pusher.subscribe('amenities');
        // channel.bind('app\\Events\\AmenitiesUpdated', function(data) {
        //     console.log(data)
        //     table.ajax.reload();
        // });




        Pusher.logToConsole = true;
        var pusher = new Pusher('00710d032d91ced3b23b', {
            cluster: 'ap1',
            encrypted: true
        });

        var channel = pusher.subscribe('amenities');
        channel.bind('App\\Events\\AmenitiesUpdated', function(data) {
            // alert(JSON.stringify(data));
            console.log(data)
            table.ajax.reload();
        });


        // var table = $("#amenities_table").DataTable({
        //     lengthChange: false,
        //     ordering: false,
        //     dom: 'Bfrtip',
        //     orderCellsTop: true,
        //     buttons: [{
        //         extend: "copy",
        //         text: "Copy",
        //         exportOptions: {
        //             columns: ":not(:last-child)"
        //         },
        //         customize: function(data, config) {
        //             var message = "This is a message at the top of the copied data.\n\n";

        //             Swal.fire({
        //                 title: "Data Copied!",
        //                 html: message,
        //                 icon: "success",
        //                 showConfirmButton: false,
        //                 timer: 1500,
        //             });

        //             return data;
        //         },
        //     }, {
        //         extend: "excel",
        //         title: "Amenities",
        //         exportOptions: {
        //             columns: [0, 1]
        //         }
        //     }],
        //     order: [],
        //     pageLength: 10,
        //     ajax: {
        //         type: "POST",
        //         url: '{{ route('get.amenities') }}',
        //         headers: {
        //             'X-CSRF-TOKEN': '{{ csrf_token() }}'
        //             // Include CSRF token in the request headers
        //         },
        //         dataSrc: "data",
        //         beforeSend: function() {
        //             $("#loading-overlay").show(); // Show loading overlay
        //         },
        //         complete: function() {
        //             $("#loading-overlay").hide(); // Hide loading overlay
        //         },
        //     },
        //     columns: [{
        //         data: null,
        //         render: function(data, type, row, meta) {

        //             return '<td>' + (meta.row + 1) + '</td>';

        //         },
        //     }, {
        //         data: null,
        //         render: function(data) {
        //             return data.amenities_name;
        //         }
        //     }, {
        //         data: null,
        //         render: function(data) {
        //             return '<a href="" class="btn btn-sm btn-inverse-warning">Edit</a> <a href="" class="btn btn-sm btn-inverse-danger" id="delete">Delete</a>';
        //         }
        //     }],
        // });


        // function decryptData(encryptedData) {
        //     // Decrypt data using CryptoJS
        //     var decrypted = CryptoJS.AES.decrypt(encryptedData, '{{ config('app.key') }}');
        //     // Convert decrypted data to string and return
        //     return decrypted.toString(CryptoJS.enc.Utf8);
        // }

        // var table = $("#amenities_table").DataTable({
        //     lengthChange: false,
        //     ordering: false,
        //     dom: 'Bfrtip',
        //     orderCellsTop: true,
        //     buttons: [{
        //         extend: "copy",
        //         text: "Copy",
        //         exportOptions: {
        //             columns: ":not(:last-child)"
        //         },
        //         customize: function(data, config) {
        //             var message = "This is a message at the top of the copied data.\n\n";

        //             Swal.fire({
        //                 title: "Data Copied!",
        //                 html: message,
        //                 icon: "success",
        //                 showConfirmButton: false,
        //                 timer: 1500,
        //             });

        //             return data;
        //         },
        //     }, {
        //         extend: "excel",
        //         title: "Amenities",
        //         exportOptions: {
        //             columns: [0, 1]
        //         }
        //     }],
        //     order: [],
        //     pageLength: 10,
        //     ajax: {
        //         type: "POST",
        //         url: '{{ route('get.amenities') }}',
        //         headers: {
        //             'X-CSRF-TOKEN': '{{ csrf_token() }}'
        //             // Include CSRF token in the request headers
        //         },
        //         dataSrc: 'data', // Point to the 'data' key in the JSON response
        //         beforeSend: function() {
        //             $("#loading-overlay").show(); // Show loading overlay
        //         },
        //         complete: function() {
        //             $("#loading-overlay").hide(); // Hide loading overlay
        //         },
        //     },
        //     columns: [{
        //         data: null,
        //         render: function(data, type, row, meta) {
        //             return '<td>' + (meta.row + 1) + '</td>';
        //         },
        //     }, {
        //         data: 'amenities_name', // Assuming 'amenities_name' is the encrypted field
        //         render: function(data, type, row) {
        //             // Decrypt the 'amenities_name' field before displaying
        //             return decryptData(data);
        //         }
        //     }, {
        //         data: null,
        //         render: function(data) {
        //             return '<a href="" class="btn btn-sm btn-inverse-warning">Edit</a> <a href="" class="btn btn-sm btn-inverse-danger" id="delete">Delete</a>';
        //         }
        //     }],
        // });


        $('#submitAddForm').click(function(e) {
            e.preventDefault();

            var formData = $('#addForm').serialize();

            $.ajax({
                url: '{{ route('store.amenities') }}',
                type: 'POST',
                data: formData,
                success: function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        html: response['message'],
                        // type: response['alert-type'],
                        timer: 1500,
                        showConfirmButton: false,
                        allowOutsideClick: false
                    }).then(function() {
                        table.ajax.reload();
                    });
                    $('#addForm')[0].reset();
                    $('#addAmenities').modal('hide');
                    console.log(response);
                },
                error: function(error) {
                    showError(error)
                }
            });
        });
    })

    var isModalOpen = false;

    function displayModal(id) {
        console.log(id);
        if (isModalOpen) {
            return;
        }
        isModalOpen = true;
        $.ajax({
            type: "POST",
            url: '{{ route('modal.amenities') }}',

            data: {
                id: id,
            },
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                // Include CSRF token in the request headers
            },
            success: function(response) {
                $("#modalContent").html(response);
                // Show the modal
                $("#editAmenities").modal("show");

                // Reset the flag when the modal is closed
                $("#editAmenities").on("hidden.bs.modal", function() {
                    isModalOpen = false;
                });
            },
        });
    }



    function showError(error) {
        if (error.status === 422) {
            var errors = error.responseJSON.errors;
            $.each(errors, function(field, messages) {
                var $field = $('#' + field);
                $field.addClass('is-invalid');
                $field.next('.error-message').html(messages.join('<br>'));

                $field.on('input change', function() {
                    $(this).removeClass('is-invalid');
                    $(this).addClass('is-valid');
                    $(this).next('.error-message').html('');
                });
            });
        } else {
            console.log(error);
        }
    }
</script>
