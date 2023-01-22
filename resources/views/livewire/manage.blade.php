<div class="block block-rounded">
    <div class="block-content">
        <h3 >List of PurchaseRequest</h3>
    </div>
    <div class="block-content">
        <div class="row">
            <div class="form-group">
                <div class="col ">
                    <label>Filter Barangay</label>
                    <select name="payee_id" class="form-control" required wire:model='selectedBrgy'>
                        <option value="">-- Please select --</option>
                        @foreach($brgys as $supplier)
                            <option value="{{ $supplier}}">{{ $supplier}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group">
                <div class="col ">
                    <label>Search by Project Name</label>
                    <input type="text" class="form-control" placeholder="Please search by Project Name"wire:model="searchTerm" wire:keydown.enter="searchProject">
                </div>
            </div>
        </div>
    </div>
    <div class="block-content ">
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-vcenter">
                <thead>

                    <tr>
                        <th>PR Number</th>
                        <th>PR Date</th>
                        <th>Status</th>
                        <th>Barangay Name</th>
                        <th class="text-center" style="width: 100px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($prs)
                        @forelse ($prs as $pr)
                        <tr>
                            <td class="font-w600 font-size-sm">
                            {{$pr->pr_no}}
                            </td>
                            <td class="font-w600 font-size-sm">
                                {{$pr->pr_date->format('Y-M-d')}}
                            </td>
                            <td class="font-w600 font-size-sm">
                                @if ($pr->admin_approved ==1)
                                    <span class="badge badge-success">Approved</span>
                                @elseif($pr->admin_approved == 0)
                                    <span class="badge badge-warning"> Under Approval </span>
                                @else
                                    <span class="badge badge-danger"> Not Approved </span>
                                @endif
                            </td>
                            <td class="font-w600 font-size-sm">
                                {{$pr->user->brgy}}
                            </td>
                            <td class="text-center">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-sm btn-alt-warning" data-toggle="tooltip" title="Approved" wire:click="releaseConfirmation({{$pr->id}})" wire:loading.attr="disabled">
                                        <i class="fa fa-fw fa fa-check-double"></i>
                                    </button>
                                    <button type="button" class="btn btn-sm btn-alt-danger" data-toggle="tooltip" title="Diapproved" wire:click="disapprovedConfirm({{$pr->id}})" wire:loading.attr="disabled">
                                        <i class="fa fa-fw fa fa-handshake-slash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                            <td class="font-size-sm" colspan="7">No Data Available</td>
                        @endforelse
                    @else
                    @forelse ($allPrs as $pr)
                        <tr>
                            <td class="font-w600 font-size-sm">
                            {{$pr->pr_no}}
                            </td>
                            <td class="font-w600 font-size-sm">
                                {{$pr->pr_date->format('Y-M-d')}}
                            </td>
                            <td class="font-w600 font-size-sm">
                                @if ($pr->admin_approved ==1)
                                    <span class="badge badge-success">Approved</span>
                                @elseif($pr->admin_approved == 0)
                                    <span class="badge badge-warning"> Under Approval </span>
                                @else
                                    <span class="badge badge-danger"> Not Approved </span>
                                @endif
                            </td>
                            <td class="font-w600 font-size-sm">
                                {{$pr->user->brgy}}
                            </td>
                            <td class="text-center">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-sm btn-alt-warning" data-toggle="tooltip" title="Approved" wire:click="releaseConfirmation({{$pr->id}})" wire:loading.attr="disabled">
                                        <i class="fa fa-fw fa fa-check-double"></i>
                                    </button>
                                    <button type="button" class="btn btn-sm btn-alt-danger" data-toggle="tooltip" title="Diapproved" wire:click="disapprovedConfirm({{$pr->id}})" wire:loading.attr="disabled">
                                        <i class="fa fa-fw fa fa-handshake-slash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                            <td class="font-size-sm" colspan="7">No Data Available</td>
                        @endforelse
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
