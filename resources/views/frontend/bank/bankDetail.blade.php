@extends('frontend.master')
@section('title')
    Bank-Details
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
            <div class="edit-profile">
                <div class="row">
                    <div class="col-xl-2">

                    </div>
                    <div class="col-xl-8">
                        <div class="card">
                            <div class="card-body">
                                <div class="mb-3 row">
                                    <label class="col-sm-2 col-form-label">Bank</label>
                                    <div class="col-sm-3">
                                        {{$bankDetail->bank_name}}
                                    </div>
                                    <div class="col-sm-7">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-sm-2 col-form-label">Account Name</label>
                                    <div class="col-sm-3">
                                        {{$bankDetail->account_name}}
                                    </div>
                                    <div class="col-sm-7">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-sm-2 col-form-label">Account Number</label>
                                    <div class="col-sm-3">
                                        {{$bankDetail->address}}
                                    </div>
                                    <div class="col-sm-7">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-sm-2 col-form-label">Branch</label>
                                    <div class="col-sm-3">
                                        {{$bankDetail->branch}}
                                    </div>
                                    <div class="col-sm-7">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-sm-2 col-form-label">Account Number</label>
                                    <div class="col-sm-3">
                                        {{$bankDetail->number}}
                                    </div>
                                    <div class="col-sm-7">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <div class="col-sm-5">
                                        <div class="table-responsive add-project">
                                            <table class="table card-table table-vcenter text-nowrap">
                                                <thead>
                                                <tr style="background-color: #7366FF;">
                                                    <th style="color: white">DEBIT</th>
                                                    <th style="color: white">CREDIT</th>
                                                    <th style="color: white">BALANCE</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>{{number_format($debit,2)}}</td>
                                                        <td>{{number_format($credit,2)}}</td>
                                                        <td>{{number_format($credit - $debit,2)}}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="col-sm-7">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-2"></div>
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title mb-0">TRANSACTION DETAILS</h4>
                                <div class="card-options"><a class="card-options-collapse" href="#" data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a><a class="card-options-remove" href="#" data-bs-toggle="card-remove"><i class="fe fe-x"></i></a></div>
                            </div>
                            <div class="table-responsive add-project">
                                <table class="table card-table table-vcenter text-nowrap">
                                    <thead>
                                    <tr>
                                        <th>DATE</th>
                                        <th>TYPE</th>
                                        <th>BANK/CASH</th>
                                        <th>DEBIT</th>
                                        <th>CREDIT</th>
                                        <th>ACTION</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($transDetails as $data)
                                            <tr>
                                                <td>{{date('d-M-Y',strtotime($data->entry_date))}}</td>
                                                <td>{{$data->type}}</td>
                                                <td>{{$data->bank}}</td>
                                                <td>{{number_format($data->debit,2)}}</td>
                                                <td>{{number_format($data->credit,2)}}</td>
                                                <td class="text-center">
                                                    <a class="btn btn-primary btn-sm" href="{{url('/bank-edit/'.$data->id)}}"><i class="fa fa-pencil"></i> Edit</a>
                                                    <a class="btn btn-danger btn-sm" onclick="return confirm('Want To delete')" href="{{url('/invoice-delete/'.$data->id)}}"><i class="fa fa-trash"></i> Delete</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
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
                document.getElementById('id').value = id;
                document.getElementById('name').value = res.data.name;
                document.getElementById('company_name').value = res.data.company_name;
                document.getElementById('phone').value = res.data.phone;
                document.getElementById('email').value = res.data.email;
                document.getElementById('address').value = res.data.address;
                document.getElementById('credit').value = res.data.credit;
                document.getElementById('debit').value = res.data.debit;
                document.getElementById('date').value = res.data.date;
            }).catch(err=>{
                console.log(err)
            })
        }
    </script>
    <script src="{{asset('/frontend/')}}/assets/js/datatable/datatables/jquery.dataTables.min.js"></script>
    <script src="{{asset('/frontend/')}}/assets/js/datatable/datatables/datatable.custom.js"></script>
@endpush
