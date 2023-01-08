<div>
    <div wire:ignore.self class="modal" id="modal-block-small" tabindex="-1" role="dialog" aria-labelledby="modal-block-small" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="block block-rounded block-themed block-transparent mb-0">
                    <div class="block-header bg-primary-dark">
                        <h3 class="block-title">Announcement</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="fa fa-fw fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content font-size-sm">
                        <div class="row mx-3">
                            <h5>Title: </h5><p  class="mx-2">{{$title}}</p>
                        </div>
                        <div class="row mx-3">
                            <h5>When: </h5><p  class="mx-2">{{$when}}</p>
                        </div>
                        <div class="row mx-3">
                            <h5>Where: </h5><p  class="mx-2">{{$where}}</p>
                        </div>
                        <div class="row mx-3">
                            <h5>What: </h5><p class="mx-2">{{$what}}</p>
                        </div>
                        <div class="row mx-3">
                            <h5 class="">Details: </h5><p class="mx-2">{{$details}}</p>
                        </div>
                    </div>
                    <div class="block-content block-content-full text-right border-top">
                        <button type="button" class="btn btn-alt-primary mr-1" data-dismiss="modal" wire:click='close()'>Close</button>
                        <button type="button" class="btn btn-primary" data-dismiss="modal" wire:click='close()'>Ok</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="paper m-3" data-toggle="modal" data-target="#modal-block-small" wire:click='show({{$paper->id}})' wire:key="{{ $paper->id }}">
        <input type="hidden" value="{{$paper->id}}">
        <div class="pin">
            <div class="shadow"></div>
            <div class="metal"></div>
            <div class="bottom-circle"></div>
        </div>
        <p>{{$paper->title}}</p>
    </div>
</div>
