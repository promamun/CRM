@extends('frontend.master')
@section('title')
    Bank
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
                                    <li class="nav-item"><a class="nav-link active" id="top-home-tab" data-bs-toggle="tab" href="#top-home" role="tab" aria-controls="top-home" aria-selected="true"><i data-feather="target"></i>All Bamk</a></li>
                                    <li class="nav-item"><a class="nav-link" id="profile-top-tab" data-bs-toggle="tab" href="#top-profile" role="tab" aria-controls="top-profile" aria-selected="false"><i data-feather="info"></i>Active Bamk</a></li>
                                    <li class="nav-item"><a class="nav-link" id="contact-top-tab" data-bs-toggle="tab" href="#top-contact" role="tab" aria-controls="top-contact" aria-selected="false"><i data-feather="check-circle"></i>Inactive Bamk</a></li>
                                </ul>
                            </div>
                            <div class="col-md-4">
                                <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target=".bd-example-modal-edite"><i data-feather="plus-square"> </i>ADD Bank</button>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade bd-example-modal-edite" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-content modal-lg">
                            <form action="{{url('/bank-store')}}" method="post">
                                @csrf
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="myLargeModalLabel">Add Bank Details</h4>
                                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label class="col-form-label">Bank Name</label>
                                            <input class="form-control" name="bank_name" type="text" placeholder="Bank Name" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="col-form-label">Account Name</label>
                                            <input class="form-control" name="account_name" {{ old('account_name') }} type="text" placeholder="Account Name" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="col-form-label">Branch</label>
                                            <input class="form-control" name="branch" type="text" placeholder="Branch" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="col-form-label">Type</label>
                                            <input class="form-control" name="type" {{ old('type') }} type="text" placeholder="Type" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="col-form-label">Number</label>
                                            <input class="form-control" name="number" {{ old('number') }} type="number" placeholder="Number" required>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="mb-3">
                                                    <label>Date</label>
                                                    <input class="datepicker-here form-control" placeholder="Date" name="entry_date" type="text" data-language="en">
                                                </div>
                                            </div>
                                        </div>
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
                            <form action="{{url('/bank-update')}}" method="post">
                                @csrf
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="myLargeModalLabel">Update Bank Details</h4>
                                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label class="col-form-label">Bank Name</label>
                                            <input class="form-control" name="bank_name" id="bank_name" type="text" placeholder="Bank Name" required>
                                            <input class="form-control" name="id" id="id" type="hidden">
                                        </div>
                                        <div class="mb-3">
                                            <label class="col-form-label">Account Name</label>
                                            <input class="form-control" name="account_name" id="account_name" type="text" placeholder="Account Name" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="col-form-label">Branch</label>
                                            <input class="form-control" name="branch" id="branch" type="text" placeholder="Branch" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="col-form-label">Type</label>
                                            <input class="form-control" name="type" id="type" type="text" placeholder="Type" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="col-form-label">Number</label>
                                            <input class="form-control" name="number" id="number" type="number" placeholder="Number" required>
                                        </div>
                                        <hr class="mt-4 mb-4">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="mb-3">
                                                    <label>Date</label>
                                                    <input class="datepicker-here form-control" placeholder="Date" id="entry_date" name="entry_date" type="text" data-language="en">
                                                </div>
                                            </div>
                                        </div>
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
                                            <th>BANK NAME</th>
                                            <th>ACCOUNT NAME</th>
                                            <th>BRANCH</th>
                                            <th>TYPE</th>
                                            <th>NUMBER</th>
                                            <th>ACTION</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($banks as $data)
                                            <tr>
                                                <td>
                                                    <a href="{{ url('/viewbank/'.$data->id) }}" title="Bank View">
                                                    {{$data->bank_name}}
                                                    </a>
                                                </td>
                                                <td>{{$data->account_name}}</td>
                                                <td>{{$data->branch}}</td>
                                                <td>{{$data->type}}</td>
                                                <td>{{$data->number}}</td>
                                                <td>
                                                    <div class="d-flex text-center">
                                                        <a href="{{ url('/viewbank/'.$data->id) }}" title="Bank View"><i class="icofont icofont-ui-file f-24"></i></a>
                                                        <a style="cursor: pointer" onclick="bankUpdate({{$data->id}})" data-bs-toggle="modal" data-bs-target=".bd-example-modal-edite1" class="p-l-20" title="Bank Edit"><i class="icofont icofont-ui-edit text-warning f-24" ></i></a>
                                                        <a href="{{ url('/bank/delete/'.$data->id) }}" onclick="return confirm('are you Sure Want To Delete')" title="Bank Delete" class="ms-3"><i class="icofont icofont-ui-close f-24 text-danger"></i></a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>BANK NAME</th>
                                            <th>ACCOUNT NAME</th>
                                            <th>BRANCH</th>
                                            <th>TYPE</th>
                                            <th>NUMBER</th>
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
        function bankUpdate(id){
            axios.get('/bank-edit/'+id,{

            }).then(res=>{
                console.log(res.data)
                document.getElementById('id').value = id;
                document.getElementById('bank_name').value = res.data.bank_name;
                document.getElementById('account_name').value = res.data.account_name;
                document.getElementById('branch').value = res.data.branch;
                document.getElementById('type').value = res.data.type;
                document.getElementById('number').value = res.data.number;
                document.getElementById('entry_date').value = res.data.entry_date;
                for (let i=0; i<res.data.bank_trans.length; i++ ){
                    let credit = res.data.bank_trans[i].credit;
                    let debit = res.data.bank_trans[i].debit;
                    let entry_date = res.data.bank_trans[i].entry_date;
                    document.getElementById('credit').value = credit;
                    document.getElementById('debit').value = debit;
                    document.getElementById('entry_date').value = entry_date;
                }
            }).catch(err=>{
                console.log(err)
            })
        }
    </script>
    <script src="{{asset('/frontend/')}}/assets/js/datatable/datatables/jquery.dataTables.min.js"></script>
    <script src="{{asset('/frontend/')}}/assets/js/datatable/datatables/datatable.custom.js"></script>
@endpush
