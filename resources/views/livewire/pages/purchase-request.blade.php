<div class="btn-group">
    <a href="{{route('purchase-request.edit', $purchaseRequest)}}" class="btn btn-sm btn-alt-success"  data-toggle="tooltip" title="Edit">
        <i class="fa fa-fw fa-pencil-alt"></i>
    </a>
    <button type="button" class="btn btn-sm btn-alt-info" data-toggle="tooltip" title="Export" wire:click="export" wire:loading.attr="disabled">
        <i class="fa fa-fw fa-file-export"></i>
    </button>
    <button type="button" class="btn btn-sm btn-alt-danger" data-toggle="tooltip" title="Disapproved" wire:click="disapprovedConfirm" wire:loading.attr="disabled">
        <i class="fa fa-fw fa fa-handshake-slash"></i>
    </button>
    <button type="button" class="btn btn-sm btn-alt-warning" data-toggle="tooltip" title="Approved" wire:click="approvedConfirmation" wire:loading.attr="disabled">
        <i class="fa fa-fw fa-check-double"></i>
    </button>
    <button type="button" class="btn btn-sm btn-alt-danger" data-toggle="tooltip" title="Delete" wire:click="deleteConfirm" wire:loading.attr="disabled">
        <i class="fa fa-fw fa-times"></i>
    </button>
</div>


