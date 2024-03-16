@extends('enumerator.enumerator_dashboard')
@section('content')
    <script src="{{ asset('assets/js/scanner/instascan.min.js') }}"></script>
    <div class="page-content">
        <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
            <div>
                <h4 class="mb-3 mb-md-0">Welcome @php echo Auth::user()->name; @endphp</h4>
            </div>

        </div>
        <div class="row">
            <div class="col-lg-12 col-xl-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-baseline mb-2">
                            <h6 class="card-title mb-0">Scan Household Number</h6>

                        </div>
                        <p class="text-muted">
                            MAPAGMASID will automatically search for the household number. If camera is not available, you
                            can enter
                            it manually.
                        </p>
                        <div class="row d-flex align-items center justify-content-center mt-5">
                            <div class="col-lg-4 col-xl-4 col-sm-12 d-flex align-items-center gap-3">
                                <button class="btn btn-sm btn-inverse-secondary" id="showScanner"><i
                                        data-feather="camera"></i></button>
                                <span class="fw-bold">Scan QRCode</span>
                            </div>
                            <div class="col-12 text-center">OR</div>
                            <div class="col-lg-4 col-xl-4 col-sm-12">
                                <label for="searchHousehold">Household Number</label>
                                <div class="input-group mb-3">

                                    <input type="text" class="col-6 form-control" aria-label="Username"
                                        aria-describedby="basic-addon1" id="searchHousehold" autocomplete="off"
                                        placeholder="Enter Household Number"> <span
                                        class="input-group-text cursor-pointer btn btn-inverse-secondary"
                                        id="basic-addon1"><i data-feather="search"></i></span>
                                </div>
                                <div class="col-12">
                                    <a href="{{ route('enumerator.household') }}" class="d-flex gap-2"><span>Gabriel, Lance
                                            Tristan</span> - <span>42123018-00091</span></a>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>

        </div>
        <div class="modal fade" id="scanQR" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog ">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="qrScannerModalLabel">
                            <div id="result"></div>
                            Scan QrCode
                        </h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body " style="height:300px; width: 100%;">
                        <video id="video" playsinline style="width:100%;height:100%;object-fit:cover;"></video>

                    </div>
                    <div class=" modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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

    <script src="{{ asset('assets/js/scanner/jsQR.js') }}"></script>
    <script>
        $('#showScanner').click(function() {
            $('#scanQR').modal('show')

        })
        document.addEventListener('DOMContentLoaded', () => {
            const video = document.getElementById('video');
            const resultDiv = document.getElementById('result');
            let scannerInterval;

            // Function to start the QR code scanning process
            function startScanner() {

                navigator.mediaDevices.enumerateDevices()
                    .then(devices => {
                        const backCamera = devices.find(device => device.kind === 'videoinput' && device.label
                            .includes('back'));

                        if (backCamera) {
                            return navigator.mediaDevices.getUserMedia({
                                video: {
                                    deviceId: backCamera.deviceId
                                }
                            });
                        } else {
                            // Fallback to default getUserMedia if back camera is not found
                            return navigator.mediaDevices.getUserMedia({
                                video: true
                            });
                        }
                    })
                    .then((stream) => {
                        video.srcObject = stream;
                        video.play();

                        video.addEventListener('loadedmetadata', () => {
                            // Start scanning frames
                            scannerInterval = setInterval(captureFrame, 1000 / 30);
                        });
                    })
                    .catch((error) => {
                        console.error('Error accessing camera:', error);
                    });
            }

            // Function to stop the QR code scanning process
            function stopScanner() {
                if (scannerInterval) {
                    clearInterval(scannerInterval);
                }

                // Stop the camera stream
                const stream = video.srcObject;
                if (stream) {
                    const tracks = stream.getTracks();
                    tracks.forEach(track => track.stop());
                }
            }

            // Function to capture video frames and attempt to decode QR codes
            function captureFrame() {
                if (video.videoWidth == 0) {
                    return;
                }
                const canvas = document.createElement('canvas');
                const context = canvas.getContext('2d');

                // Set canvas dimensions to match the video frame
                canvas.width = video.videoWidth;
                canvas.height = video.videoHeight;

                context.drawImage(video, 0, 0, canvas.width, canvas.height);
                const imageData = context.getImageData(0, 0, canvas.width, canvas.height);

                // Attempt to decode QR code
                const code = jsQR(imageData.data, canvas.width, canvas.height);


                if (code) {
                    resultDiv.textContent = `${code.data}`;


                    stopScanner();
                    // $('#scanQR').modal('hide');
                } else {
                    resultDiv.textContent = 'No QR Code detected';
                }
            }

            // Event listener for when the modal is shown
            const modalElement = document.getElementById('scanQR');
            modalElement.addEventListener('shown.bs.modal', () => {
                startScanner();
            });

            // Event listener for when the modal is hidden
            modalElement.addEventListener('hidden.bs.modal', () => {
                stopScanner();
            });
        });
    </script>
@endsection
