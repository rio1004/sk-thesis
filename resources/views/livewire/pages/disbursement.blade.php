<div class="btn-group">
    <a href="{{route('dibursement.edit', $disbursement)}}" class="btn btn-sm btn-alt-success"  data-toggle="tooltip" title="Edit">
        <i class="fa fa-fw fa-pencil-alt"></i>
    </a>
    <button type="button" class="btn btn-sm btn-alt-info" data-toggle="tooltip" title="Export" wire:click="export" wire:loading.attr="disabled">
        <i class="fa fa-fw fa-file-export"></i>
    </button>
    <button type="button" class="btn btn-sm btn-alt-danger" data-toggle="tooltip" title="Delete" wire:click="deleteConfirm" wire:loading.attr="disabled">
        <i class="fa fa-fw fa-times"></i>
    </button>
</div>


