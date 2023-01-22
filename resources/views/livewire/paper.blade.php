<div>
    <h2 class="content-heading">Announcement</h2>
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
