@extends('frontend.master')
@section('title')
    Invoice Create
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
                            <form action="{{url('/invoice-store')}}" method="post" >
                                @csrf
                                <div class="invoice">
                                    <div>
                                        <div>
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <div>
                                                        <div class="mb-2">

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6" >
                                                    <div class="mb-2">
                                                        <select class="js-example-basic-single col-sm-12" required name="customer_id">
                                                            <option class="text-center" value="" selected disabled >Select Customer</option>
                                                            @foreach($customers as $customer)
                                                                <option   value="{{$customer->id}}">{{$customer->name }}-{{$customer->company_name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="mb-2">
                                                        <div class="btn-showcase float-md-right">
                                                            <!-- Large modal-->
                                                            <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target=".bd-example-modal-edite">Create Customer</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <!-- End Invoice Mid-->
                                        <div id="posReload">
                                            <div class="table-responsive invoice-table" id="table">
                                                <table id="myTable" class="table table-bordered table-striped">
                                                    <thead>
                                                        <tr>
                                                            <td class="item">
                                                                <h6 class="p-2 mb-0">Item</h6>
                                                            </td>
                                                            <td class="Hours">
                                                                <h6 class="p-2 mb-0">Size</h6>
                                                            </td>
                                                            <td class="Rate">
                                                                <h6 class="p-2 mb-0">Unit</h6>
                                                            </td>
                                                            <td class="Rate">
                                                                <h6 class="p-2 mb-0">Width</h6>
                                                            </td>
                                                            <td class="Rate">
                                                                <h6 class="p-2 mb-0">Height</h6>
                                                            </td>
                                                            <td class="subtotal">
                                                                <h6 class="p-2 mb-0">Square Ft</h6>
                                                            </td>
                                                            <td >
                                                                <h6 class="p-2 mb-0">Rate</h6>
                                                            </td>
                                                            <td >
                                                                <h6 class="p-2 mb-0">Price</h6>
                                                            </td>
                                                            <td >
                                                                <h6 class="p-2 mb-0">Action</h6>
                                                            </td>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="tableBody">
                                                        <tr id="originalRow">
                                                            <td>
                                                                <input class="typeahead form-control" name="item[]" type="text" required  placeholder="Items">
                                                            </td>
                                                            <td>
                                                                <input class="typeahead form-control" name="size[]" type="text" required  placeholder="Size">
                                                            </td>
                                                            <td>
                                                                <select class="form-select" required name="unit[]" id="unit" >
                                                                    <option class="text-center" selected disabled >Select Units</option>
                                                                    <option class="text-center" value="PCS">PCS</option>
                                                                </select>
                                                            </td>
                                                            <td>
                                                                <input class="typeahead form-control" name="width[]"  required onchange="countSQft()" id="width"  type="number"  placeholder="Width">
                                                            </td>
                                                            <td>
                                                                <input class="typeahead form-control" name="height[]" required onchange="countSQft()"  id="height" type="number"  placeholder="Height">
                                                            </td>
                                                            <td>
                                                                <p class="itemtext">
                                                                    <input class="form-control square_ft" type="number" required name="square_ft[]" id="square_ft" readonly>
                                                                </p>
                                                            </td>
                                                            <td>
                                                                <input class="typeahead form-control" name="rate[]" required onchange="rateSum()"  id="rate" type="number"  placeholder="Height">
                                                            </td>
                                                            <td>
                                                                <p class="itemtext">
                                                                    <input class="form-control total_price" type="number" required name="total_price[]" id="total_price" readonly>
                                                                </p>
                                                            </td>
                                                            <td>
                                                                <div class="text-center" id="plusIcon">
                                                                    <i style="cursor: pointer;" onclick="cloneRow()"  class="f-30 text-success icofont icofont-plus"></i>
                                                                </div>
                                                                <div class=" text-center" style="display: none" id="closeIcon">
                                                                    <i style="cursor: pointer" onclick="removedTr(this)" class="f-30 text-danger icofont icofont-ui-close"></i>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                    <tfoot>
                                                    <tr>
                                                        <td colspan="5"></td>
                                                        <td colspan="2" class="text-center"><h6 class="mb-0 p-2">SubTotal</h6></td>
                                                        <td class="payment">
                                                            <h6 class="mb-0 p-2">
                                                                <input class="form-control" type="number" id="sub_price" name="sub_price"  readonly placeholder="0.00">
                                                            </h6>
                                                        </td>
                                                        <td class="payment">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="5"></td>
                                                        <td colspan="2" class="text-center"><h6 class="mb-0 p-2">Credit</h6></td>
                                                        <td class="payment">
                                                            <input class="form-control" name="credit" required id="credit" type="number"  onchange="creditTotal(this.value)"  placeholder="Credit">
                                                            <strong class="text-danger" id="due"></strong>
                                                            <strong class="text-success" id="paid"></strong>
                                                        </td>
                                                        <td class="payment">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="5"></td>
                                                        <td colspan="4" class="text-center">
                                                            <div class="row">
                                                                <div class="col-sm-12">
                                                                    <div class="mb-3">
                                                                        <label>Description</label>
                                                                        <input class="form-control" placeholder="Description" name="description" id="description" type="text" >
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                            <!-- End Table-->
                                        </div>
                                        <!-- End InvoiceBot-->
                                    </div>
                                    <div class="row g-3">
                                        <div class="col-md-4">

                                        </div>
                                        <div class="col-md-4">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="mb-3">
                                                        <label>Date</label>
                                                        <input class="datepicker-here form-control" placeholder="Date" name="date" id="date" type="text" data-language="en">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for=""> Bank</label>
                                            <select class="form-select" required name="payment_type" >
                                                <option class="text-center" selected disabled >Select Bank</option>
                                                @foreach($banks as $bank)
                                                    <option class="text-center" value="{{$bank->bank_name}}">{{$bank->bank_name}}-{{$bank->account_name}}</option>
                                                @endforeach
                                                <option class="text-center" value="CIH">Cash In Hand</option>
                                            </select>
                                        </div>
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
    <script src="{{asset('/frontend/')}}/assets/js/custome-js/invoice.js"></script>
@endpush
