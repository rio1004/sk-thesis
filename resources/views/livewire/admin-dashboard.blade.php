<div>
    <div class="form-group">
        <label>Filter Barangay</label>
        <select name="payee_id" class="form-control" required wire:model='selectedBrgy'>
            <option value="">-- Please select --</option>
            @foreach($brgys as $supplier)
                <option value="{{ $supplier}}">{{ $supplier}}</option>
            @endforeach
        </select>
    </div>
    <div class="row">
        <div class="col">
            <a class="block block-rounded block-link-pop border-left border-primary border-4x" href="javascript:void(0)">
                <div class="block-content block-content-full">
                    <div class="font-size-sm font-w600 text-uppercase text-muted">Budget Remaining</div>
                    <div class="font-size-h2 font-w400 text-dark">{{ number_format($bgt?->remaining_budget, 2) }}</div>
                </div>
            </a>
        </div>
        <div class="col">
            <a class="block block-rounded block-link-pop border-left border-primary border-4x" href="javascript:void(0)">
                <div class="block-content block-content-full">
                    <div class="font-size-sm font-w600 text-uppercase text-muted">Total Purchase Request</div>
                    <div class="font-size-h2 font-w400 text-dark">{{$prs?$prs:0}}</div>
                </div>
            </a>
        </div>
        <div class="col">
            <a class="block block-rounded block-link-pop border-left border-primary border-4x" href="javascript:void(0)">
                <div class="block-content block-content-full">
                    <div class="font-size-sm font-w600 text-uppercase text-muted">Release Vouchers</div>
                    <div class="font-size-h2 font-w400 text-dark">{{$dvs?$dvs:0}}</div>
                </div>
            </a>
        </div>
        <div class="col">
            <a class="block block-rounded block-link-pop border-left border-primary border-4x" href="javascript:void(0)">
                <div class="block-content block-content-full">
                    <div class="font-size-sm font-w600 text-uppercase text-muted">Total Purchase Orders</div>
                    <div class="font-size-h2 font-w400 text-dark">{{$pos?$pos:0}}</div>
                </div>
            </a>
        </div>
    </div>
    <h2 class="content-heading">Announcement for this Month</h2>
    <div class="row justify-content-center py-sm-3 py-md-5" >
        @forelse ($announcements as $announcement)
        <div class="col-md-6 col-xl-3">
            <!-- Bottom Right Success -->
            <div class="block block-rounded">
                @if ($announcement->status ==1)
                <div class="block-content block-content-full ribbon ribbon-warning" wire:click="showAnnounce({{$announcement->id}})">
                    <div class="ribbon-box">
                        Fairly Important
                    </div>
                    <div class="text-center py-4">
                        <p>
                            <i class="far fa-3x fa-bell text-gray"></i>
                        </p>
                        <h4 class="mb-0">{{$announcement->title}}</h4>
                        <p class="text-center">
                            Please Click for Full Details
                        </p>
                    </div>
                </div>
                @elseif ($announcement->status ==2)
                <div class="block-content block-content-full ribbon ribbon-danger" wire:click="showAnnounce({{$announcement->id}})">
                    <div class="ribbon-box">
                        Very Important
                    </div>
                    <div class="text-center py-4">
                        <p>
                            <i class="far fa-3x fa-bell text-gray"></i>
                        </p>
                        <h4 class="mb-0">{{$announcement->title}}</h4>
                        <p class="text-center">
                            Please Click for Full Details
                        </p>
                    </div>
                </div>
                @else
                <div class="block-content block-content-full ribbon ribbon-success" wire:click="showAnnounce({{$announcement->id}})">
                    <div class="ribbon-box">
                        Important
                    </div>
                    <div class="text-center py-4">
                        <p>
                            <i class="far fa-3x fa-bell text-gray"></i>
                        </p>
                        <h4 class="mb-0">{{$announcement->title}}</h4>
                        <p class="text-center">
                            Please Click for Full Details
                        </p>
                    </div>
                </div>
                @endif

            </div>
            <!-- END Bottom Right Success -->
        </div>
        @empty
        <div class="col-md-12 col-xl-12">
            <!-- Bottom Right Success -->
            <div class="block block-rounded">
                <div class="block-content block-content-full ribbon ribbon-danger">
                    <div class="ribbon-box">
                        N/A
                    </div>
                    <div class="text-center py-4">
                        <p>
                            <i class="far fa-3x fa-bell-slash text-gray"></i>
                        </p>
                        <h4 class="mb-0">No Announcement Available</h4>
                    </div>
                </div>
            </div>
            <!-- END Bottom Right Success -->
        </div>
        @endforelse
    </div>

</div>
