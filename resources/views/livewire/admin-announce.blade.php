<div class="btn-group">
    <a href="{{route('admin-announcement.edit', $announcement)}}" class="btn btn-sm btn-alt-success"  data-toggle="tooltip" title="Edit">
        <i class="fa fa-fw fa-pencil-alt"></i>
    </a>
    <button type="button" class="btn btn-sm btn-alt-danger" data-toggle="tooltip" title="Delete" wire:click="deleteConfirm" wire:loading.attr="disabled">
        <i class="fa fa-fw fa-times"></i>
    </button>
</div>


