@extends('frontend.master')
@section('title')
    Invoice Update
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
                            <form action="{{url('/invoice-update/'.$invoiceItems->id)}}" method="post" >
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
                                                                <option   value="{{$customer->id}}" {{$customer->id === $invoiceItems->ledger_id ? 'selected':'' }}>{{$customer->name }}-{{$customer->company_name }}</option>
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
                                                            <div class="text-center" >
                                                                <i style="cursor: pointer;" onclick="cloneRow()"  class="f-30 text-success icofont icofont-plus"></i>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    </thead>
                                                    <tbody id="tableBody">
                                                    @php
                                                        $toalP =0;
                                                    @endphp
                                                        @foreach($invoiceItems->invoiceItems as $data)
                                                            <tr id="originalRow">
                                                            <td>
                                                                <input class="typeahead form-control" name="item[]" type="text" value="{{$data->item}}" required  placeholder="Items">
                                                                <input name="trans_id" type="hidden" value="{{$invoiceItems->id}}">
                                                            </td>
                                                            <td>
                                                                <input class="typeahead form-control" name="size[]" type="text" value="{{$data->size}}" required  placeholder="Size">
                                                            </td>
                                                            <td>
                                                                <select class="form-select" required name="unit[]" id="unit" >
                                                                    <option class="text-center" value="{{$data->unit}}" selected >{{$data->unit}}</option>
                                                                    <option class="text-center" value="PCS">PCS</option>
                                                                </select>
                                                            </td>
                                                            <td>
                                                                <input class="typeahead form-control" name="width[]" value="{{$data->width}}"  required onchange="countSQft()" id="width"  type="number"  placeholder="Width">
                                                            </td>
                                                            <td>
                                                                <input class="typeahead form-control" name="height[]" value="{{$data->height}}" required onchange="countSQft()"  id="height" type="number"  placeholder="Height">
                                                            </td>
                                                            <td>
                                                                <p class="itemtext">
                                                                    <input class="form-control square_ft" type="number" value="{{$data->square_ft}}" required name="square_ft[]" id="square_ft" readonly>
                                                                </p>
                                                            </td>
                                                            <td>
                                                                <input class="typeahead form-control" name="rate[]" required value="{{$data->rate}}" onchange="rateSum()"  id="rate" type="number"  placeholder="Rate">
                                                            </td>
                                                            <td>
                                                                <p class="itemtext">
                                                                    <input class="form-control total_price" type="number" value="{{$totalPrice=$data->square_ft*$data->rate,2}}"  required name="total_price[]" id="total_price" readonly>
                                                                </p>
                                                            </td>
                                                            <td>
                                                                <div class=" text-center" id="closeIcon">
                                                                    <i style="cursor: pointer" onclick="removedTr(this)" class="f-30 text-danger icofont icofont-ui-close"></i>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                            @php
                                                            $toalP +=$totalPrice
                                                            @endphp
                                                        @endforeach
                                                    </tbody>
                                                    <tfoot>
                                                    <tr>
                                                        <td colspan="5"></td>
                                                        <td colspan="2" class="text-center"><h6 class="mb-0 p-2">SubTotal</h6></td>
                                                        <td class="payment">
                                                            <h6 class="mb-0 p-2">
                                                                <input class="form-control" type="number" id="sub_price" value="{{$toalP}}" name="sub_price"  readonly placeholder="0.00">
                                                            </h6>
                                                        </td>
                                                        <td class="payment">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="5"></td>
                                                        <td colspan="2" class="text-center"><h6 class="mb-0 p-2">Credit</h6></td>
                                                        <td class="payment">
                                                            <input class="form-control" name="credit" value="{{$invoiceItems->credit}}" required id="credit" type="number"  onchange="creditTotal(this.value)"  placeholder="Credit">
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
                                                                        <input class="form-control" placeholder="Description" value="{{$invoiceItems->description}}" name="description" id="description" type="text" >
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
                                                        <input class="datepicker-here form-control" placeholder="Date" value="{{$invoiceItems->entry_date}}" name="entry_date" id="date" type="text" data-language="en">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for=""> Bank</label>
                                            <select class="form-select" required name="bank" >
                                                <option class="text-center" selected >{{$invoiceItems->bank}}</option>
                                                <option class="text-center" value="Bank">Bank</option>
                                                <option class="text-center" value="CIH">Cash In Hand</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="card-body btn-showcase float-md-end">
                                        <button class="btn btn-square btn-primary btn-lg" type="submit" title="" data-bs-original-title="btn btn-square btn-primary btn-lg" data-original-title="btn btn-square btn-secondary btn-sm"><i class="icofont icofont-plus"></i> Update</button>
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
