    @extends('layout.app')
    @section('content')
        <div class="main-content" style="margin-right:0px !important;left:0px !important">
            <h1 class="text-center">Hello, {{ @$user->name }}</h1>


            <div class="container-fluid my-5">
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                        <div
                            class="card rounded-4 mb-0 border-top border-bottom border-start border-end border-4 border-primary border-gradient-1">
                            <div class="card-body p-5">
                                <div class="text-center">
                                    <img src="{{ asset('admin/assets/images/logo1.png') }}" class="mb-4" width="145"
                                        alt="">
                                </div>
                                <div class="form-body my-4">
                                    <form class="row g-3" method="POST" action="{{ route('sale-post') }}"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="mb-3" id="shop-name-section">
                                            <label class="form-label">Shop Name</label>
                                            <input type="text" class="form-control" name="shop_name">
                                            @error('shop_name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="mb-3" id="shop-name-section">
                                            <label for="inputSelectCountry" class="form-label">Shop Type</label>
                                            <select class="form-select" id="inputSelectCountry"
                                                aria-label="Default select example" name="shop_type">
                                                <option selected="" disabled>Choose Shop Type</option>
                                                <option value="Wholesale">Wholesale</option>
                                                <option value="Retail">Retail</option>
                                                <option value="Distributor">Distributor</option>
                                                <option value="Hawker">Hawker</option>
                                            </select>
                                            @error('shop_type')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="mb-3" id="mobile-no-section">
                                            <label class="form-label">Mobile No</label>
                                            <input type="text" class="form-control" name="mobile_no">
                                            @error('mobile_no')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="mb-3" id="owner-name-section">
                                            <label class="form-label">Sale Amount</label>
                                            <input type="text" class="form-control" name="sale_amount">
                                            @error('sale_amount')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="mb-3" id="owner-name-section">
                                            <label class="form-label">Sales Representative Name</label>
                                            <input type="text" class="form-control" name="sale_representative_name">
                                            @error('sale_representative_name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Visit Notes</label>
                                            <textarea class="form-control" name="visit_notes"></textarea>
                                            @error('visit_notes')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="gpsLocation" class="form-label">
                                                GPS Location
                                            </label>
                                            <div class="d-flex">
                                                <input type="text" id="gpsLocation" readonly
                                                    placeholder="Getting location..." class="form-control me-2"
                                                    name="location">
                                                <button type="button" id="refreshLocationBtn"
                                                    class="btn btn-primary">🔄</button>
                                            </div>
                                            {{-- <small id="locationHelp" class="text-muted d-block mt-2"></small> --}}
                                            @error('location')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>




                                        <div class="mb-3" id="shop-address-section">
                                            <label class="form-label">Shop Address</label>
                                            <textarea class="form-control" name="shop_address"></textarea>
                                            @error('shop_address')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="mb-3" id="image-section">
                                            <label class="form-label">Image</label>
                                            <input type="file" class="form-control" name="image">
                                            @error('image')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-12" id="submit-section">
                                            <div class="d-grid">
                                                <button type="submit" class="btn btn-dark text-white">Submit</button>
                                            </div>
                                        </div>

                                    </form>
                                </div>



                            </div>
                        </div>
                    </div>
                </div><!--end row-->
            </div>

        </div>
        <script>
            const gpsInput = document.getElementById("gpsLocation");
            const statusDot = document.getElementById("locationStatus"); // now exists
            const help = document.getElementById("locationHelp");
            const refreshBtn = document.getElementById("refreshLocationBtn");

            function setStatus(color, msg) {
                if (statusDot) statusDot.style.background = color;
                if (msg) help.textContent = msg;
                else help.textContent = "";
            }

            function explainError(err) {
                // Friendlier messages
                switch (err.code) {
                    case err.PERMISSION_DENIED:
                        return "Permission denied. Allow location access in the browser/site settings.";
                    case err.POSITION_UNAVAILABLE:
                        return "Position unavailable. Try turning on GPS/location services.";
                    case err.TIMEOUT:
                        return "Timed out. Try again or move near a window/open sky.";
                    default:
                        return "Unknown error.";
                }
            }

            async function checkPermissions() {
                if (!navigator.permissions) return null;
                try {
                    const q = await navigator.permissions.query({
                        name: "geolocation"
                    });
                    return q.state; // "granted" | "prompt" | "denied"
                } catch {
                    return null;
                }
            }

            async function getLocation() {
                gpsInput.value = "Getting location...";
                // setStatus("#f0ad4e", "Requesting location…"); // amber

                if (!("geolocation" in navigator)) {
                    gpsInput.value = "Geolocation not supported";
                    setStatus("#d9534f", "Your browser doesn't support geolocation.");
                    return;
                }

                const state = await checkPermissions();
                if (state === "denied") {
                    gpsInput.value = "Permission denied";
                    setStatus("#d9534f", "Enable location permission for this site and retry.");
                    return;
                }

                navigator.geolocation.getCurrentPosition(
                    (pos) => {
                        const lat = pos.coords.latitude.toFixed(6);
                        const lon = pos.coords.longitude.toFixed(6);
                        gpsInput.value = `${lat},${lon}`;
                    },
                    (err) => {
                        gpsInput.value = "Unable to retrieve location";
                        setStatus("#d9534f", explainError(err));
                        console.error("Geolocation error:", err);
                    }, {
                        enableHighAccuracy: true,
                        timeout: 10000, // 10s
                        maximumAge: 60000 // 1 min cache
                    }
                );
            }

            // Only trigger on button click to ensure a user gesture (helps on iOS)
            refreshBtn.addEventListener("click", getLocation);

            // Optional: try once on load (some browsers require a gesture; if it fails, user can tap 🔄)
            getLocation();
        </script>
    @endsection
