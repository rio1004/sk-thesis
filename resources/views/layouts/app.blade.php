
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
    </head>
    <body>
        <div id="page-container" class="sidebar-o sidebar-dark enable-page-overlay side-scroll page-header-fixed main-content-narrow">
            <nav id="sidebar" aria-label="Main Navigation">
                <div class="content-header bg-white-5">
                    <a class="font-w600 text-dual" href="index.html">
                        <span class="smini-hide font-size-h5 tracking-wider">
                           SK Management System
                        </span>
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