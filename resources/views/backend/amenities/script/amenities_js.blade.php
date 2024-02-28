<script src="https://js.pusher.com/7.0/pusher.min.js"></script>
<script>
    $(document).ready(function() {


        function fetchData(page, searchQuery = '') {
            $.ajax({
                url: '{{ route('get.amenities') }}?page=' + page + '&search=' + searchQuery,
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    // Include CSRF token in the request headers
                },
                success: function(response) {
                    // Update table rows
                    var html = '';
                    if (!response || (!response.data || response.data.length === 0) &&
                        response.total === 0) {
                        html +=
                            '<tr><td colspan="8" class="text-center">No data available</td></tr>';
                    } else {
                        $.each(response.data, function(index, item) {
                            console.log(response)

                            html += '<tr>';

                            html += '<td>' + item.id + '</td>';
                            html += '<td>' + item.amenities_name + '</td>';
                            html += '<td>' + item.amenities_name + '</td>';
                            html += '<td>' + item.amenities_name + '</td>';
                            html += '<td>' + item.amenities_name + '</td>';
                            html += '<td>' + item.amenities_name + '</td>';
                            html += '<td>' + item.amenities_name + '</td>';
                            html +=
                                '<td><button class="btn btn-sm btn-primary" onclick ="displayModal(' +
                                item.id + ')">Edit</button></td>';


                            html += '</tr>';

                        });
                    }
                    $('#amenities_table tbody').html(html);

                    var totalPages = Math.ceil(response.total / 10);

                    // Calculate start and end page numbers to display
                    var startPage = Math.max(1, response.current_page - 5);
                    var endPage = Math.min(totalPages, startPage + 9);

                    // Update pagination links
                    var paginationHtml = '';
                    var paginationNumber = '';
                    paginationNumber += '<span class="pe-5">Page ' + response.current_page +
                        ' of ' +
                        response
                        .last_page + '</span>';
                    if (response.prev_page_url) {

                        paginationHtml += '<a href="#" class="page-link " data-page="' + (
                            response
                            .current_page - 1) + '">Previous</a>';
                        paginationHtml += '<a href="#" class="page-link " data-page="' + (
                            1) + '">First</a>';


                    }
                    for (var i = startPage; i <= endPage; i++) {
                        paginationHtml += '<button class="page-link btn btn-sm ' + (i === response
                                .current_page ? 'active' : '') + '" data-page="' + i + '">' + i +
                            '</button>';
                    }
                    if (response.next_page_url) {
                        paginationHtml += '<a href="#" class="page-link " data-page="' + (
                            totalPages) + '">Last</a>';
                        paginationHtml += '<a href="#" class="page-link" data-page="' + (response
                            .current_page + 1) + '">Next</a>';

                    }
                    $('#pagination').html(paginationHtml);
                    $('#paginationNumber').html(paginationNumber);
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        }

        // Initial data fetch
        // Initial data fetch
        fetchData(1);

        // Pagination click event
        $(document).on('click', '.page-link', function(e) {
            e.preventDefault();
            var page = $(this).data('page');
            var searchQuery = $('#searchInput').val();
            fetchData(page, searchQuery);
        });

        $('#searchButton').click(function() {
            var searchQuery = $('#searchInput').val();
            fetchData(1, searchQuery); // Fetch data for the first page when search button is clicked
        });

        $('#resetSearch').click(function() {
            $('#searchInput').val('');
            fetchData(1, searchQuery = '')
        })
        // var table = $('#amenities_table').DataTable({
        //     "processing": true,
        //     "serverSide": true,
        //     "ajax": {
        //         url: '{{ route('get.amenities') }}',
        //         type: "POST",
        //         headers: {
        //             'X-CSRF-TOKEN': '{{ csrf_token() }}'
        //             // Include CSRF token in the request headers
        //         },
        //     },
        //     "columns": [{
        //             "data": "DT_RowIndex",
        //         },
        //         {
        //             "data": "amenities_name"
        //         },
        //         {
        //             "data": "amenities_name"
        //         },
        //         {
        //             "data": "amenities_name"
        //         },
        //         {
        //             "data": "amenities_name"
        //         },
        //         {
        //             "data": "amenities_name"
        //         },
        //         {
        //             "data": "amenities_name"
        //         },
        //         {
        //             "data": "action",
        //             "orderable": false,
        //             "searchable": false
        //         },
        //     ],
        //     "order": [
        //         [0, "desc"]
        //     ]
        // });
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
            // table.ajax.reload();
            fetchData(1)
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
                        // table.ajax.reload();
                        fetchData(1)
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
