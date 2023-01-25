
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

        <title>SK Management System</title>

        <meta name="description" content="OneUI - Bootstrap 4 Admin Template &amp; UI Framework created by pixelcave and published on Themeforest">
        <meta name="author" content="pixelcave">
        <meta name="robots" content="noindex, nofollow">

        <!-- Open Graph Meta -->

        <link rel="shortcut icon" href="{{asset('assets/media/favicons/favicon.png')}}">
        <link rel="icon" type="image/png" sizes="192x192" href="{{asset('assets/media/favicons/favicon-192x192.png')}}">
        <link rel="apple-touch-icon" sizes="180x180" href="{{asset('assets/media/favicons/apple-touch-icon-180x180.png')}}">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap">
        <link rel="stylesheet" id="css-main" href="{{asset('assets/css/oneui.min.css')}}">
        @livewireStyles
        <style>
            :root {
  --paper-shadow: #c9bf8d;
}



.paper {
  --paper-dark: #e5c93d;
  --paper-color: #ffed87;
  font-family: "Caveat", cursive;
  position: relative;
  display: flex;
  justify-content: center;
  min-width: 325px;
  min-height: 175px;
  cursor: pointer;
  background: linear-gradient(
    135deg,
    var(--paper-dark),
    30%,
    var(--paper-color)
  );
  box-shadow: 3px 3px 2px var(--paper-shadow);
    transition: ease-in-out;
    transition-duration: .2s;
  transform-origin: top left;
}
.paper:hover{
    transform: rotate(5deg)
}
.paper p {
  margin: auto;
}

.pin {
  --pin-color: #d02627;
  --pin-dark: #9e0608;
  --pin-light: #fc7e7d;

  position: absolute;
  left: 20px;
  width: 60px;
  height: 50px;
}

.shadow {
  position: absolute;
  top: 18px;
  left: -8px;
  width: 35px;
  height: 35px;
  border-radius: 50%;
  background: radial-gradient(var(--paper-shadow), 20%, rgba(201, 191, 141, 0));
}

.metal {
  position: absolute;
  width: 5px;
  height: 20px;
  background: linear-gradient(to right, #808080, 40%, #eae8e8, 50%, #808080);
  border-radius: 0 0 30% 30%;
  transform: rotate(50deg);
  transform-origin: bottom left;
  top: 15px;
  border-bottom: 1px solid #808080;
}

.bottom-circle {
  position: absolute;
  right: 15px;
  width: 35px;
  height: 35px;
  border-radius: 50%;
  background-color: var(--pin-color);
  background: radial-gradient(
    circle at bottom right,
    var(--pin-light),
    25%,
    var(--pin-dark),
    90%,
    var(--pin-color)
  );
}

/* Barrel */
.bottom-circle::before {
  content: "";
  position: absolute;
  top: 0;
  left: -2px;
  width: 20px;
  height: 30px;
  transform: rotate(55deg);
  transform-origin: 100% 100%;
  border-radius: 0 0 40% 40%;
  background: linear-gradient(
    to right,
    var(--pin-dark),
    30%,
    var(--pin-color),
    90%,
    var(--pin-light)
  );
}

/* Top circle */
.bottom-circle::after {
  content: "";
  position: absolute;
  right: -10px;
  top: -5px;
  width: 25px;
  height: 25px;
  border-radius: 50%;
  background: radial-gradient(
    circle at right,
    var(--pin-light),
    30%,
    var(--pin-color),
    var(--pin-dark) 80%
  );
}

        </style>
    </head>
    <body>
        <div id="page-container" class="sidebar-o sidebar-dark enable-page-overlay side-scroll page-header-fixed main-content-narrow">
            <nav id="sidebar" aria-label="Main Navigation">
                <div class="content-header bg-white-5">
                    <a class="font-w600 text-dual" href="index.html">
                        <span class="smini-hide font-size-h5 tracking-wider">
                            Web-based Record Management System
                        </span>
                    </a>
                    <a class="d-lg-none btn btn-sm btn-dual ml-1" data-toggle="layout" data-action="sidebar_close" href="javascript:void(0)">
                        <i class="fa fa-fw fa-times"></i>
                    </a>
                </div>
                @include('layouts.admin.navigation')
                <!-- END Sidebar Scrolling -->
            </nav>
            @include('layouts.admin.header')

            <main id="main-container">
                <div class="bg-body-light">
                    <div class="content content-full">
                        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2 text-center text-sm-left">
                            <div class="flex-sm-fill">
                                <h1 class="h3 font-w700 mb-2">
                                    @yield('page-name')
                                </h1>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content">
                    @yield('content')
                </div>
            </main>
            <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
            @yield('scripts')
            @include('layouts.admin.footer')
        </div>
       
        @livewireScripts
        
        <script src="{{asset('assets/js/oneui.core.min.js')}}"></script>
        <script src="{{asset('assets/js/oneui.app.min.js')}}"></script>
        <script src="{{asset('assets/js/plugins/bootstrap-notify/bootstrap-notify.min.js')}}"></script>
        <script>jQuery(function () { One.helpers('notify'); });</script>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
        <script>
            window.addEventListener('swal:confirm', event => {
                Swal.fire({
                    position: 'top-center',
                    icon: 'warning',
                    title: event.detail.message,
                    showCancelButton: true,
                    confirmButtonText: `Yes`,
                    denyButtonText: `Cancel`
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.livewire.emit('delete', event.detail.id)
                        Swal.fire({
                            position: 'top-center',
                            icon: 'success',
                            title: 'Successfully Deleted',
                            showConfirmButton: false,
                            timer: 1000
                        })
                    }
                });
            });
        </script>

        <script>
            window.addEventListener('swal:confirm-approve', event => {
                Swal.fire({
                    position: 'top-center',
                    icon: 'question',
                    title: event.detail.title,
                    text: event.detail.text,
                    showCancelButton: true,
                    confirmButtonText: `Yes`,
                    denyButtonText: `Cancel`
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.livewire.emit('send', event.detail.id)
                        Swal.fire({
                            position: 'top-center',
                            icon: 'success',
                            title: 'Successfully Approved',
                            showConfirmButton: false,
                            timer: 1000
                        })
                    }
                });
            });
            window.addEventListener('swal:confirm-release', event => {
                Swal.fire({
                    position: 'top-center',
                    icon: 'warning',
                    title: event.detail.message,
                    text: event.detail.text,
                    showCancelButton: true,
                    confirmButtonText: `Yes`,
                    denyButtonText: `Cancel`
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.livewire.emit('release', event.detail.id)
                        Swal.fire({
                            position: 'top-center',
                            icon: 'success',
                            title: 'Successfully Released',
                            showConfirmButton: false,
                            timer: 1000
                        })
                    }
                });
            });
            window.addEventListener('brgyError', event => {
                Swal.fire({
                    position: 'top-center',
                    icon: 'info',
                    title: event.detail.message,
                    showConfirmButton: true,
                })
            });
            window.addEventListener('showAnnounce', event => {
                Swal.fire({
                    position: 'top-center',
                    icon: 'info',
                    title: event.detail.title,
                    html:  event.detail.what + "<br>" + event.detail.where + "<br>" +  event.detail.when + "<br>" + event.detail.details,
                    showConfirmButton: true,
                })
            });
            window.addEventListener('swal:confirm-disapproved', event => {
                Swal.fire({
                    position: 'top-center',
                    icon: 'warning',
                    title: event.detail.message,
                    text: event.detail.text,
                    showCancelButton: true,
                    confirmButtonText: `Yes`,
                    denyButtonText: `Cancel`
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.livewire.emit('disapproved', event.detail.id)
                        Swal.fire({
                            position: 'top-center',
                            icon: 'success',
                            title: 'Successfully Disapproved',
                            showConfirmButton: false,
                            timer: 1000
                        })
                    }
                });
            });
            window.addEventListener('swal:confirm-approved', event => {
                Swal.fire({
                    position: 'top-center',
                    icon: 'question',
                    title: event.detail.title,
                    text: event.detail.text,
                    showCancelButton: true,
                    confirmButtonText: `Yes`,
                    denyButtonText: `Cancel`
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.livewire.emit('approved', event.detail.id)
                        Swal.fire({
                            position: 'top-center',
                            icon: 'success',
                            title: 'Successfully Approved',
                            showConfirmButton: false,
                            timer: 1000
                        })
                    }
                });
            });
        </script>

        <script>
            $(document).ready(function () {
                window.Alpine = Alpine;
                Alpine.start();

                $(document).on('click', '[data-add-item]', function () {
                    let _container = $(this).closest('[data-item-container]')
                    if (_container) {
                        let _template = _container.find('[data-parent]').first()
                        if (_template) {
                            let clone = _template.clone()
                            $(clone).find('.row').each((index, item) => {
                                let attr = $(item).attr('data-parent');
                                if (typeof attr === 'undefined' || attr === false) {
                                    $(item).remove()
                                }
                            })
                            if ($(clone[0]).attr('data-parent') !== undefined) {
                                $(clone[0]).removeAttr('data-parent')
                                $(clone[0]).find('[data-item-hide]').first().removeClass('d-none')
                                $(clone[0]).find('input, select').each(function (index, item) {
                                    item.value = ''
                                })
                                _container.append($(clone[0]))
                            }
                        }
                    }
                })

                // data-calc-item => assign to input text that you want to include in sum
                // data-calc-total => assign to input for displaying the total
                $(document).on('change', '[data-calc-item]', function () {
                    let _total_text = $('[data-calc-total]')
                    if (_total_text) {
                        let allItems = $('[data-calc-item]')
                        let total = 0;
                        allItems.each(function (index, item) {
                            let _this = $(item)
                            if (!isNaN(_this.val()) && _this.val() !== '') {
                                let val = _this.val()
                                total += parseFloat(val)
                            }
                        })
                        _total_text.val('Php. ' + total);
                    }
                })

                $(document).on('click', '[data-remove-item]', function () {
                    let _parent = $(this).closest('.row')
                    _parent.remove()
                })
            })
        </script>

    </body>
</html>
