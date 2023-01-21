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
    <div class="block block-rounded">
        <div class="block-header block-header-default">
            <h2 class="block-title">Announcements</h2>
        </div>
        <div class="row justify-content-center py-sm-3 py-md-5" >
            {{-- @forelse ( $announcements as $paper )
                @livewire('paper', ['paper' => $paper], key($paper->id))
            @empty
            @endforelse --}}
        </div>
    </div>
</div>
