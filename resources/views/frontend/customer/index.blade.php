@extends('frontend.master')
@section('title')
    Customers
@endsection
@push('style')
    <link rel="stylesheet" type="text/css" href="{{asset('/frontend/')}}/assets/css/vendors/datatables.css">
@endpush
@section('content')
    <div class="page-body">
        <div class="container-fluid">
            <div class="page-title">
                <div class="row">

                </div>
            </div>
        </div>
        <!-- Container-fluid starts-->
        <div class="container-fluid">
            <div class="row project-cards">
                <div class="col-md-2 project-list"></div>
                <div class="col-md-8 project-list">
                    <div class="card">
                        @if(Session()->has('error'))
                            <div class="alert alert-danger">{{Session()->get('error')}}</div>
                        @endif
                        <div class="row">
                            <div class="col-md-8">
                                <ul class="nav nav-tabs border-tab" id="top-tab" role="tablist">
                                    <li class="nav-item"><a class="nav-link active" id="top-home-tab" data-bs-toggle="tab" href="#top-home" role="tab" aria-controls="top-home" aria-selected="true"><i data-feather="target"></i>All Customer</a></li>
                                    <li class="nav-item"><a class="nav-link" id="profile-top-tab" data-bs-toggle="tab" href="#top-profile" role="tab" aria-controls="top-profile" aria-selected="false"><i data-feather="info"></i>Active Customer</a></li>
                                    <li class="nav-item"><a class="nav-link" id="contact-top-tab" data-bs-toggle="tab" href="#top-contact" role="tab" aria-controls="top-contact" aria-selected="false"><i data-feather="check-circle"></i>Inactive Customer</a></li>
                                </ul>
                            </div>
                            <div class="col-md-4">
                                <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target=".bd-example-modal-edite"><i data-feather="plus-square"> </i>ADD Customer</button>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade bd-example-modal-edite" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-content modal-lg">
                            <form action="{{url('/customer-store')}}" method="post">
                                @csrf
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="myLargeModalLabel">Add Customer Details</h4>
                                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label class="col-form-label">Name</label>
                                            <input class="form-control" name="name" type="text" placeholder="Customer Name" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="col-form-label">Address</label>
                                            <input class="form-control" name="address" {{ old('address') }} type="text" placeholder="Address" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="col-form-label">Email Address</label>
                                            <input class="form-control" name="email" type="email" placeholder="Enter email" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="col-form-label">Phone</label>
                                            <input class="form-control" name="phone" {{ old('phone') }} type="Number" placeholder="Enter contact number" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="col-form-label">Company</label>
                                            <input class="form-control" name="company_name" {{ old('company_name') }} type="text" placeholder="Company Name" required>
                                        </div>
                                        <hr class="mt-4 mb-4">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="mb-3">
                                                    <label>Debit</label>
                                                    <input class="form-control" type="number" name="debit">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="mb-3">
                                                    <label>Credit</label>
                                                    <input class="form-control" type="number" name="credit" >
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
                                        <button class="btn btn-primary" type="submit">Save</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="modal fade bd-example-modal-edite1" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-content modal-lg">
                            <form action="{{url('/customer-update')}}" method="post">
                                @csrf
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="myLargeModalLabel">Update Customer Details</h4>
                                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label class="col-form-label">Name</label>
                                            <input class="form-control" name="id" id="id" type="hidden" placeholder="Customer Id" required>
                                            <input class="form-control" name="name" id="name" type="text" placeholder="Customer Name" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="col-form-label">Address</label>
                                            <input class="form-control" name="address" id="address" type="text" placeholder="Address" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="col-form-label">Email Address</label>
                                            <input class="form-control" name="email" id="email" type="email" placeholder="Enter email" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="col-form-label">Phone</label>
                                            <input class="form-control" name="phone" id="phone" type="Number" placeholder="Enter contact number" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="col-form-label">Company</label>
                                            <input class="form-control" name="company_name" id="company_name" type="text" placeholder="Company Name" required>
                                        </div>
                                        <hr class="mt-4 mb-4">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="mb-3">
                                                    <label>Debit</label>
                                                    <input class="form-control" type="number" id="debit" name="debit">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="mb-3">
                                                    <label>Credit</label>
                                                    <input class="form-control" type="number" id="credit" name="credit" >
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
                                        <button class="btn btn-primary" type="submit">Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-2 project-list"></div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="display" id="advance-1">
                                    <thead>
                                        <tr>
                                            <th>COMPANY</th>
                                            <th>NAME</th>
                                            <th>ADDRESS</th>
                                            <th>PHONE</th>
                                            <th>ACTION</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($customers as $customer)
                                            <tr>
                                                <td>{{$customer->company_name}}</td>
                                                <td>{{$customer->name}}</td>
                                                <td>{{$customer->address}}</td>
                                                <td>{{$customer->phone}}</td>
                                                <td>
                                                    <div class="d-flex text-center">
                                                        <a href="{{ url('/viewcustomer/'.$customer->id) }}" title="Customer View"><i class="icofont icofont-ui-file f-24"></i></a>
                                                        <a style="cursor: pointer" onclick="customerUpdate({{$customer->id}})" data-bs-toggle="modal" data-bs-target=".bd-example-modal-edite1" class="p-l-20" title="Customer Edit"><i class="icofont icofont-ui-edit text-warning f-24" ></i></a>
                                                        <a href="{{ url('/customer/delete/'.$customer->id) }}" onclick="return confirm('are you Sure Want To Delete')" title="Customer Delete" class="ms-3"><i class="icofont icofont-ui-close f-24 text-danger"></i></a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>COMPANY</th>
                                            <th>NAME</th>
                                            <th>ADDRESS</th>
                                            <th>PHONE</th>
                                            <th>ACTION</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Container-fluid Ends-->
    </div>
@endsection
@push('script')
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        function customerUpdate(id){
            axios.get('/customer-edit/'+id,{

            }).then(res=>{
                console.log(res.data)
                document.getElementById('id').value = id;
                document.getElementById('name').value = res.data.name;
                document.getElementById('company_name').value = res.data.company_name;
                document.getElementById('phone').value = res.data.phone;
                document.getElementById('email').value = res.data.email;
                document.getElementById('address').value = res.data.address;
                for (let i=0; i<res.data.cus_trans.length; i++ ){
                    let credit = res.data.cus_trans[i].credit;
                    let debit = res.data.cus_trans[i].debit;
                    document.getElementById('credit').value = credit;
                    document.getElementById('debit').value = debit;
                }
            }).catch(err=>{
                console.log(err)
            })
        }
    </script>
    <script src="{{asset('/frontend/')}}/assets/js/datatable/datatables/jquery.dataTables.min.js"></script>
    <script src="{{asset('/frontend/')}}/assets/js/datatable/datatables/datatable.custom.js"></script>
@endpush
