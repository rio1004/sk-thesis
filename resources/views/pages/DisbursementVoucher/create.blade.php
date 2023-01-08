@extends('layouts.app')
@section('page-name')
    Disbursement Voucher
@endsection
@section('content')
<form action="{{route('dibursement.store')}}" method="POST">
    @csrf
    <x-alert></x-alert>
    <x-error></x-error>
    <div class="block block-rounded">
        <div class="block-header block-header-default">
            <h3 class="block-title">Create Disbursement Voucher</h3>
            <div class="block-header">
                <a class="btn btn-sm btn-alt-success" href="{{route('dibursement.index')}}">
                    Cancel
                </a>
            </div>
        </div>
        <div class="block-content">
            <div class="row justify-content-center py-sm-3 py-md-5">
                <div class="col-sm-10 col-md-8">
                    <div class="form-group">
                        <label>DV No. <span class="text-danger">*</span></label>
                        <input type="text" name="dv_no" class="form-control" id="block-form1-username" placeholder="Enter dv no." value="{{ old('dv_no') }}" required/>
                    </div>
                    <div class="form-group">
                        <label>DV Date <span class="text-danger">*</span></label>
                        <input type="date" name="dv_date" class="form-control" id="block-form1-username" value="{{ old('dv_date') }}" required/>
                    </div>
                    <div class="form-group">
                        <label>Payee <span class="text-danger">*</span></label>
                        <select name="payee_id" class="form-control" required>
                            <option value="">-- Please select --</option>
                            @foreach($suppliers as $supplier)
                                <option value="{{ $supplier->id }}">{{ $supplier->supplier_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Check No.</label>
                        <input type="text" name="check_no" class="form-control" placeholder="Enter check no." value="{{ old('che ck_no') }}"/>
                    </div>
                    <div class="form-group">
                        <label>Date</label>
                        <input type="date" name="check_date" class="form-control" value="{{ old('check_date') }}"/>
                    </div>
                    <div class="form-group">
                        <label>Bank Name</label>
                        <input type="text" name="bank_name" class="form-control" value="{{ old('bank_name') }}" placeholder="Enter bank name"/>
                    </div>
                    <div class="form-group">
                        <label>Bank Branch</label>
                        <input type="text" name="bank_branch" class="form-control" value="{{ old('bank_branch') }}" placeholder="Enter bank branch"/>
                    </div>
                    <div class="form-group">
                        <label>OR No.</label>
                        <input type="text" name="or_no" class="form-control" value="{{ old('or_no') }}" placeholder="Enter OR no."/>
                    </div>
                    <div class="form-group">
                        <label>Date</label>
                        <input type="date" name="or_date" value="{{ old('or_date') }}" class="form-control"/>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Particulars <span class="text-danger">*</span></label>
                        <textarea name="particular_text" class="form-control" rows="5" required></textarea>
                    </div>
                    <div data-item-container>
                        <button type="button" class="btn btn-primary mb-3" data-add-item>Add new item</button>
                        <div class="row" data-parent>
                            <div class="form-group col-md-6">
                                <label>Enter item text:</label>
                                <input type="text" name="particular_item[]" value="{{old('particular_item.0')}}" class="form-control" placeholder="Item text">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Amount:</label>
                                <div class="input-group">
                                    <input type="number" name="particular_amount[]" value="{{old('particular_amount.0')}}" class="form-control" placeholder="Enter the amount" data-calc-item/>
                                    <div class="input-group-append d-none" data-item-hide>
                                        <button class="btn btn-danger" type="button" data-remove-item>
                                            <span class="flaticon2-trash"></span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Total Amount <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" value="Php. 0.00" data-calc-total readonly required>
                    </div>
            </div>
        </div>
    </div>
    <div class="block block-rounded">
        <div class="block-header block-header-default">
            <h3 class="block-title">SKCC</h3>
            <div class="block-header">
                <a class="btn btn-sm btn-alt-success" href="{{route('qoutation.index')}}">
                    Cancel
                </a>
            </div>
        </div>
        <div class="block-content">
            <div class="row justify-content-center py-sm-3 py-md-5">
                <div class="col-sm-10 col-md-8">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>SKCC No. <span class="text-danger">*</span></label>
                            <input type="text" name="skcc_no" class="form-control" placeholder="Enter skcc no." required/>
                        </div>
                        <div class="form-group">
                            <label>Date: <span class="text-danger">*</span></label>
                            <input type="date" name="skcc_date" class="form-control" placeholder="Enter skcc date" required/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>To: <span class="text-danger">*</span></label>
                            <input type="text" name="to_name" class="form-control" value="The Bank Manager" required/>
                        </div>
                        <div class="form-group">
                            <input type="text" name="to_company" class="form-control" value="Landbank of the Philippines" required/>
                        </div>
                        <div class="form-group">
                            <input type="text" name="to_address" class="form-control" placeholder="Address" required/>
                        </div>
                    </div>
            </div>
        </div>
    </div>
    <div class="block block-rounded">
        <div class="block-header block-header-default">
            <h3 class="block-title">SKCC Item</h3>
        </div>
        <div class="block-content" data-item-container>
            <div class="block-header">
                <button class="btn btn-sm btn-alt-warning" type="button" data-add-item>
                   <span>
                        <i class="far fa-trash-alt"></i>
                    </span>
                    Add new Item
                </button>
            </div>
            <div class="row justify-content-left" data-parent>
                <div class="form-group col-md-3">
                    <label>Account No:</label>
                    <input type="text" name="acct_no[]" class="form-control" placeholder="Enter Account No">
                </div>
                <div class="form-group col-md-3">
                    <label>Check No:</label>
                    <input type="text" name="acct_check_no[]" class="form-control" placeholder="Enter Check No">
                </div>
                <div class="form-group col-md-3">
                    <label>Date:</label>
                    <input type="date" name="acct_check_date[]" class="form-control" placeholder="Enter Date">
                </div>
                <div class="form-group col-md-3">
                    <label>Payee:</label>
                    <input type="text" name="payee[]" class="form-control" placeholder="Enter Payee">
                </div>
                <div class="form-group col-md-3">
                    <label>Amount:</label>
                    <input type="number" name="amount[]" class="form-control" placeholder="Enter Amount">
                </div>
                <div class="form-group col-md-2">
                    <label for="block-form1-username">Purpose</label>
                    <div class="input-group">
                        <input type="number" class="form-control" id="block-form1-username" name="purpose[]" value="{{old('qtys.0')}}" placeholder="Enter quantity">
                        <div class="input-group-appen d-none" data-item-hide="">
                            <button type="button" class="btn btn-danger " data-remove-item>
                                <i class="far fa-trash-alt"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group pl-5 pb-3">
            <button type="submit" class="btn btn-sm btn-primary">
                Submit
            </button>
            <button type="reset" class="btn btn-sm btn-alt-primary">
                Reset
            </button>
        </div>
    </div>

</form>
@endsection
