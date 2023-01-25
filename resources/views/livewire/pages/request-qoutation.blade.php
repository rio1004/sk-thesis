<div class="btn-group">
    <a href="{{route('qoutation.edit', $qoutation)}}" class="btn btn-sm btn-alt-success"  data-toggle="tooltip" title="Edit">
        <i class="fa fa-fw fa-pencil-alt"></i>
    </a>
    <button type="button" class="btn btn-sm btn-alt-info" data-toggle="tooltip" title="Export" wire:click="export" wire:loading.attr="disabled">
        <i class="fa fa-fw fa-file-export"></i>
    </button>
    
</div>


