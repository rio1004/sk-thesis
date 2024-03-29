<header id="page-header">
    <div class="content-header">
        <div class="d-flex align-items-center">
            <button type="button" class="btn btn-sm btn-dual mr-2 d-lg-none" data-toggle="layout" data-action="sidebar_toggle">
                <i class="fa fa-fw fa-bars"></i>
            </button>
        </div>
        <div class="d-flex align-items-center">
            <div class="dropdown d-inline-block ml-2">
                <button type="button" class="btn btn-sm btn-dual d-flex align-items-center" id="page-header-user-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img class="rounded-circle" src="{{asset('assets/media/avatars/avatar10.jpg')}}" alt="Header Avatar" style="width: 21px;">
                    <span class="d-none d-sm-inline-block ml-2">{{Auth::user()->full_name}}</span>
                    <i class="fa fa-fw fa-angle-down d-none d-sm-inline-block ml-1 mt-1"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-md dropdown-menu-right p-0 border-0" aria-labelledby="page-header-user-dropdown">
                    <div class="p-3 text-center bg-primary-dark rounded-top">
                        <img class="img-avatar img-avatar48 img-avatar-thumb" src="{{asset('assets/media/avatars/avatar10.jpg')}}" alt="">
                        <p class="mt-2 mb-0 text-white font-w500">{{Auth::user()->full_name}}</p>
                        <p class="mb-0 text-white-50 font-size-sm">Administrator</p>
                    </div>
                    <div class="p-2">
                        @role('admin')
                            <a href="{{route('profile.show' , Auth::user()->id)}}" class="dropdown-item d-flex align-items-center justify-content-between">Profile</a>
                        @else

                        @endrole()
                        
                        <div class="dropdown-divider">

                        </div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                        <a class="dropdown-item d-flex align-items-center justify-content-between" href="route('logout')"
                        onclick="event.preventDefault();
                        this.closest('form').submit();"
                        >
                            <span class="font-size-sm font-w500">Log Out</span>
                        </a>
                    </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
