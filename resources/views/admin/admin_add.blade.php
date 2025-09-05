@extends('admin.layout.app')
@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <div class="main-content">


        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Admin</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Add Team Member</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">

            </div>
        </div>
        <!--end breadcrumb-->
        <div class="row">
            <div class="col-xl-12 mx-auto">
                <hr>
                <div class="card">
                    <div class="card-body">
                        <form action="" method="post">
                            @csrf


                            <div class="mb-3">
                                <label for="formName" class="form-label">Team Member Name</label>
                                <input class="form-control" type="text" name="name" placeholder="Team Member Name"
                                    aria-label="default input example">
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>


                            <div class="mb-3">
                                <label for="formName" class="form-label">Team Member Email</label>
                                <input class="form-control" type="text" name="email" placeholder="Team Member Email"
                                    aria-label="default input example">
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>


                            <div class="mb-3">
                                <label for="formName" class="form-label">Team Member Mobile Number</label>
                                <input class="form-control" type="text" name="phone" placeholder="Team Member Mobile Number"
                                    aria-label="default input example">
                                @error('phone')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>


                            <div class="mb-3">
                                <label for="formName" class="form-label">Team Member Password</label>
                                <input class="form-control" type="password" name="password" placeholder="Team Member Password"
                                    aria-label="default input example">
                                @error('password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="formName" class="form-label">Team Member Image</label>
                                <input type="file" class="form-control" name="image" id="image" placeholder="Team Member Image">
                            </div>


                            <div class="mb-3">
                                <img id="showImage" src="{{ url('no_image.jpg') }}"
                                    class="rounded-circle p-1 shadow mb-3" width="90" height="90" alt="">
                            </div>



                            <div class="mb-3">
                                <button type="submit" class="btn btn-grd btn-grd-success px-5">Add Team Member</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--end row-->
    </div>


@endsection
