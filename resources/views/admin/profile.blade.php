@extends('admin.layout.app')
@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <div class="main-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Admin</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Profile</li>
                    </ol>
                </nav>
            </div>
            <!-- <div class="ms-auto">
                            <div class="btn-group">
                                <button type="button" class="btn btn-primary">Settings</button>
                                <button type="button" class="btn btn-primary split-bg-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown">	<span class="visually-hidden">Toggle Dropdown</span>
                                </button>
                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-end">	<a class="dropdown-item" href="javascript:;">Action</a>
                                    <a class="dropdown-item" href="javascript:;">Another action</a>
                                    <a class="dropdown-item" href="javascript:;">Something else here</a>
                                    <div class="dropdown-divider"></div>	<a class="dropdown-item" href="javascript:;">Separated link</a>
                                </div>
                            </div>
                        </div> -->
        </div>
        <!--end breadcrumb-->


        <div class="card rounded-4">
            <div class="card-body p-4">
                <div class="position-relative mb-5">
                    <img src="{{ asset('admin/assets/images/gallery/profile-cover.png') }}"
                        class="img-fluid rounded-4 shadow" alt="">
                    <div class="profile-avatar position-absolute top-100 start-50 translate-middle">
                        <img src="{{ !empty($user->image) ? url('/storage/admin/' . $user->image) : url('no_image.jpg') }}"
                            class="img-fluid rounded-circle p-1 bg-grd-danger shadow" width="170" height="170" alt="">
                    </div>
                </div>

                <div class="profile-info pt-5 d-flex align-items-center justify-content-center">
                    <div class="text-center">
                        <h3>{{ @$user->name }}</h3>
                        <p class="mb-0">
                            {{ @$user->email }}
                        </p>
                        <p class="mb-0">
                            {{ @$user->phone }}
                        </p>
                        <p class="mb-0">
                            {{ @$user->address }}
                        </p>
                    </div>
                </div>

            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card rounded-4 border-top border-4 border-primary border-gradient-1">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-start justify-content-between mb-3">
                            <div class="">
                                <h5 class="mb-0 fw-bold">Edit Profile</h5>
                            </div>
                        </div>
                        <form class="row g-4" method="post" action=""
                            enctype="multipart/form-data">
                            @csrf
                            <div class="col-md-12">
                                <label for="input1" class="form-label">Name</label>
                                <input type="text" class="form-control" name="name" id="input1"
                                    placeholder="Enter Your Name" value="{{@$user->name}}">
                            </div>
                            <div class="col-md-12">
                                <label for="input2" class="form-label">Email</label>
                                <input type="email" class="form-control" name="email" id="input2"
                                    placeholder="Enter Your Email" value="{{@$user->email}}">
                            </div>
                            <div class="col-md-12">
                                <label for="input3" class="form-label">Phone</label>
                                <input type="number" class="form-control" name="phone" id="input3"
                                    placeholder="Enter Your Mobile Number" value="{{@$user->phone}}">
                            </div>
                            <div class="col-md-12">
                                <label for="image" class="form-label">Image</label>
                                <input type="file" class="form-control" name="image" id="image"
                                    placeholder="Enter Your Image">
                            </div>
                            <div class="col-md-12">
                                <img id="showImage"
                                    src="{{ !empty($user->image) ? url('/storage/admin/' . $user->image) : url('no_image.jpg') }}"
                                    class="rounded-circle p-1 shadow mb-3" width="90" height="90" alt="">
                            </div>
                            <div class="col-md-12">
                                <label for="input11" class="form-label">Address</label>
                                <textarea class="form-control" id="input11" name="address" placeholder="Enter Your Address"
                                    rows="4" cols="4">{{@$user->address}}</textarea>
                            </div>
                            <div class="col-md-12">
                                <div class="d-md-flex d-grid align-items-center gap-3">
                                    <button type="submit" class="btn btn-grd-primary px-4">Update Profile</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div><!--end row-->
    </div>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#image').change(function (e) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#showImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });
    </script>
@endsection
