@extends('admin.layout.app')
@section('content')
    <div class="main-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Admin</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">All Sales Person</li>
                    </ol>
                </nav>
            </div>
            {{-- <div class="ms-auto">
                <a href="{{ route('admin-add') }}" type="button" class="btn btn-primary">Add Team Member</a>
            </div> --}}
        </div>
        <!--end breadcrumb-->
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example2" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>SL No</th>
                                <th>Sales Person</th>
                                <th>Shop Name</th>
                                <th>Shop Type</th>
                                <th>Mobile Number</th>
                                <th>Sale Amount</th>
                                <th>Sale Representative Name</th>
                                <th>Visit Note</th>
                                <th>Image</th>
                                <th>Location</th>
                                <th>Shop Address</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($datas as $key => $item)
                                <tr>
                                    <td> {{ $key + 1 }} </td>
                                    <td>{{ $item->user_id }}</td>
                                    <td>{{ $item->shop_name }}</td>
                                    <td>{{ $item->shop_type }}</td>
                                    <td>{{ $item->mobile_no }}</td>
                                    <td>{{ $item->sale_amount }}</td>
                                    <td>{{ $item->sale_representative_name }}</td>
                                    <td>{{ $item->visit_notes }}</td>
                                    <td><a href="{{ asset($item->image) }}" target="_blank"><img src="{{ asset($item->image) }}"
                                        style="width: 70px; height:40px;"></a></td>
                                    <td><a href="https://www.google.com/maps?q={{ $item->location }}" target="_blank">View
                                            Location</a></td>
                                    <td>{{ $item->shop_address }}</td>
                                    <td>{{ $item->created_at->format('M d Y') }}</td>


                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>SL No</th>
                                <th>Sales Person</th>
                                <th>Shop Name</th>
                                <th>Shop Type</th>
                                <th>Mobile Number</th>
                                <th>Sale Amount</th>
                                <th>Sale Representative Name</th>
                                <th>Visit Note</th>
                                <th>Image</th>
                                <th>Location</th>
                                <th>Shop Address</th>
                                <th>Date</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>


    </div>
@endsection
