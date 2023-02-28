@extends('frontend.master')
@section('title')
    Entry Create
@endsection
@section('content')
    <div class="page-body">
        <div class="container-fluid">
            <div class="page-title">
                <div class="row">

                </div>
            </div>
        </div>
        <!-- Container-fluid starts-->
        <div class="container-fluid search-page">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        @if(Session()->has('error'))
                            <div class="alert alert-danger">{{Session()->get('error')}}</div>
                        @endif
                        <div class="card-body">
                            <form action="{{url('/entry-store')}}" method="post" >
                                @csrf
                                <div class="invoice">
                                    <div>
                                        <div>
                                            <div class="row">

                                            </div>
                                        </div>
                                        <!-- End Invoice Mid-->
                                        <div id="posReload">
                                            <div class="table-responsive invoice-table" id="table">
                                                <table id="myTable" class="table table-bordered table-striped">
                                                    <thead>
                                                        <tr>
                                                            <td class="item">
                                                                <h6 class="p-2 mb-0">Date</h6>
                                                            </td>
                                                            <td class="Hours">
                                                                <h6 class="p-2 mb-0">Type</h6>
                                                            </td>
                                                            <td class="Rate">
                                                                <h6 class="p-2 mb-0">Profile</h6>
                                                            </td>
                                                            <td class="Rate">
                                                                <h6 class="p-2 mb-0">Debit</h6>
                                                            </td>
                                                            <td class="Rate">
                                                                <h6 class="p-2 mb-0">Credit</h6>
                                                            </td>
                                                            <td class="Rate">
                                                                <h6 class="p-2 mb-0">Description</h6>
                                                            </td>
                                                            <td class="subtotal">
                                                                <h6 class="p-2 mb-0">Bank</h6>
                                                            </td>
                                                            <td >
                                                                <div class="text-center" id="plusIcon">
                                                                    <i style="cursor: pointer;" onclick="cloneRow()"  class="f-30 text-success icofont icofont-plus"></i>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="tableBody">
                                                        <tr id="originalRow">
                                                            <td>
                                                                <input class="datepicker-here form-control" placeholder="Date" name="entry_date" id="date" type="text" data-language="en">
                                                            </td>
                                                            <td>
                                                                <select class="form-select parent" required name="type" onchange="typeData(this.value)" id="type" style="width: 250px;" >
                                                                    <option class="text-center" selected disabled >Select Type</option>
                                                                    <option class="text-center" value="Customer">Customer</option>
                                                                    <option class="text-center" value="Bank">Bank</option>
                                                                    <option class="text-center" value="Supplier">Supplier</option>
                                                                </select>
                                                            </td>
                                                            <td>
                                                                <select class="form-select child" required name="profile_id" id="profile" style="width: 250px;">
                                                                    <option class="text-center" selected disabled >Select Profile</option>
                                                                </select>
                                                            </td>
                                                            <td>
                                                                <input class="form-control" name="debit" required id="debit" type="number" placeholder="Debit">
                                                            </td>
                                                            <td>
                                                                <input class="form-control" name="credit" required id="credit" type="number" placeholder="Credit">
                                                            </td>
                                                            <td>
                                                                <input class="form-control" placeholder="Description" name="description" id="description" type="text" >
                                                            </td>
                                                            <td>
                                                                <select class="form-select" required name="bank" id="bank" >
                                                                    <option class="text-center" selected disabled >Select Bank</option>
                                                                    @foreach($banks as $bank)
                                                                        <option class="text-center" value="{{$bank->bank_name}}">{{$bank->bank_name}}-{{$bank->account_name}}</option>
                                                                    @endforeach
                                                                    <option class="text-center" value="CIH">Cash In Hand</option>
                                                                </select>
                                                            </td>
                                                            <td>
                                                                <div id="closeIcon" class=" text-center" style="display: none" >
                                                                    <i style="cursor: pointer" onclick="removedTr(this)" class="f-30 text-danger icofont icofont-ui-close"></i>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <!-- End Table-->
                                        </div>
                                        <!-- End InvoiceBot-->
                                    </div>
                                    <div class="card-body btn-showcase float-md-end">
                                        <button class="btn btn-square btn-primary btn-lg" type="submit" title="" data-bs-original-title="btn btn-square btn-primary btn-lg" data-original-title="btn btn-square btn-secondary btn-sm"><i class="icofont icofont-plus"></i> Save</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Container-fluid Ends-->
    </div>
@endsection
@push('script')
    <script src="{{asset('/frontend/')}}/assets/js/custome-js/entry.js"></script>
@endpush
