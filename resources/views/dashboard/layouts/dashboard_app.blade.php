<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- CSS files -->

    <link href="{{ asset('assets/css/vendor.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet" />

    <link href="{{ asset('assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}"
        rel="stylesheet" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">

    <link href="{{ asset('assets/css/notiflix.css') }}" rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js">
    </script>
    <script src="//cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>

    <meta name="csrf-token" content="{{ csrf_token() }}" />
</head>


<body>

    <div>

        <main class="py-5">

            <div id="app" class="app" style="padding-top: 5px">

                <div id="header" class="app-header">

                    <div class="mobile-toggler">
                        <button type="button" class="menu-toggler" data-toggle="sidebar-mobile">
                            <span class="bar"></span>
                            <span class="bar"></span>
                        </button>
                    </div>


                    <div class="brand">
                        <div class="desktop-toggler">
                            <button type="button" class="menu-toggler" data-toggle="sidebar-minify">
                                <span class="bar"></span>
                                <span class="bar"></span>
                            </button>
                        </div>
                        <a href="#" class="brand-logo">
                            {{-- <img src="assets/img/logo.png" alt="" height="20" /> --}}
                            <h4 style="font-weight: 700;">Trust Plastic</h4>
                        </a>
                    </div>


                    <div class="menu">
                        <form class="menu-search" method="POST" name="header_search_form">
                            <div class="menu-search-icon"><i class="fa fa-search"></i></div>
                            <div class="menu-search-input">
                                <input type="text" class="form-control" placeholder="Search menu..." />
                            </div>
                        </form>

                        <div class="menu-item dropdown">
                            <a href="#" data-bs-toggle="dropdown" data-bs-display="static" class="menu-link">
                                <div class="menu-img online">
                                    <img src="assets/img/user/user.jpg" alt="" class="mw-100 mh-100 rounded-circle" />
                                </div>
                                <div class="menu-text">
                                    <span class="" data-cfemail="">Poojila Rajakaruna</span>
                                </div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end me-lg-3">

                                <a class="dropdown-item d-flex align-items-center" href="#">Log Out <i
                                        class="fa fa-toggle-off fa-fw ms-auto text-gray-400 fs-16px"></i></a>
                            </div>
                        </div>
                    </div>

                </div>

                <div id="sidebar" class="app-sidebar bg-white">

                    <div class="app-sidebar-content" data-scrollbar="true" data-height="100%">

                        <div class="menu">
                            <div class="menu-header">Dashboard</div>
                            <div class="menu-item active">
                                <a href="/inventory" class="menu-link">
                                    <span class="menu-icon"><i class="fa fa-laptop"></i></span>
                                    <span class="menu-text">Dashboard</span>
                                </a>
                            </div>

                            <div class="menu-divider"></div>

                            <div class="menu-header">Purchase Order Management</div>

                            <div class="menu-item has-sub">
                                <a href="#" class="menu-link">
                                    <span class="menu-icon">
                                        <i class="fa fa-qrcode"></i>
                                    </span>
                                    <span class="menu-text">Item Management</span>
                                    <span class="menu-caret"><b class="caret"></b></span>
                                </a>
                                <div class="menu-submenu">

                                    <div class="menu-item">
                                        <a href="/item/category" class="menu-link">
                                            <span class="menu-icon">
                                                <i class="fa fa-th-large"></i>
                                            </span>
                                            <span class="menu-text">Category Registration</span>
                                        </a>
                                    </div>

                                    <div class="menu-item">
                                        <a href="/item" class="menu-link">
                                            <span class="menu-icon">
                                                <i class="fa fa-book"></i>
                                            </span>
                                            <span class="menu-text">Item Registration</span>
                                        </a>
                                    </div>

                                </div>
                            </div>

                            <div class="menu-item">
                                <a href="/supplier" class="menu-link">
                                    <span class="menu-icon"><i class="fa fa-user-o"></i></span>
                                    <span class="menu-text">Supplier Registration</span>
                                </a>
                            </div>

                            <div class="menu-item">
                                <a href="/po" class="menu-link">
                                    <span class="menu-icon"><i class="fa fa-clipboard"></i></span>
                                    <span class="menu-text">Purchase Order Request</span>
                                </a>
                            </div>

                            <div class="menu-divider"></div>

                            <div class="menu-header">GRN Management</div>

                            <div class="menu-item">
                                <a href="grn" class="menu-link">
                                    <span class="menu-icon"><i class="fa fa-cube"></i></span>
                                    <span class="menu-text">GRN</span>
                                </a>
                            </div>

                            <div class="menu-item">
                                <a href="widgets.html" class="menu-link">
                                    <span class="menu-icon"><i class="fa fa-cubes"></i></span>
                                    <span class="menu-text">Item Stock</span>
                                </a>
                            </div>

                            <div class="menu-item">
                                <a href="widgets.html" class="menu-link">
                                    <span class="menu-icon"><i class="fa fa-rocket"></i></span>
                                    <span class="menu-text">Inter location Transfer</span>
                                </a>
                            </div>


                            <div class="menu-divider"></div>

                            <div class="menu-header">Job & Product Management</div>

                            <div class="menu-item has-sub">
                                <a href="#" class="menu-link">
                                    <span class="menu-icon">
                                        <i class="fa fa-puzzle-piece "></i>
                                    </span>
                                    <span class="menu-text">Product Management</span>
                                    <span class="menu-caret"><b class="caret"></b></span>
                                </a>
                                <div class="menu-submenu">
                                    <div class="menu-item">
                                        <a href="email_inbox.html" class="menu-link">
                                            <span class="menu-icon">
                                                <i class="fa fa-cube"></i>
                                            </span>
                                            <span class="menu-text">Product Registration</span>
                                        </a>
                                    </div>
                                    <div class="menu-item">
                                        <a href="email_compose.html" class="menu-link">
                                            <span class="menu-icon">
                                                <i class="fa fa-car"></i>
                                            </span>
                                            <span class="menu-text">Vehicle Registration</span>
                                        </a>
                                    </div>

                                </div>
                            </div>

                            <div class="menu-item has-sub">
                                <a href="#" class="menu-link">
                                    <span class="menu-icon">
                                        <i class="fa fa-cogs"></i>
                                    </span>
                                    <span class="menu-text">Job Management</span>
                                    <span class="menu-caret"><b class="caret"></b></span>
                                </a>
                                <div class="menu-submenu">
                                    <div class="menu-item">
                                        <a href="email_inbox.html" class="menu-link">
                                            <span class="menu-icon">
                                                <i class="fa fa-wrench"></i>
                                            </span>
                                            <span class="menu-text">Job Registration</span>
                                        </a>
                                    </div>
                                    <div class="menu-item">
                                        <a href="email_compose.html" class="menu-link">
                                            <span class="menu-icon">
                                                <i class="fa fa-flask"></i>
                                            </span>
                                            <span class="menu-text">Material Requests Registration</span>
                                        </a>
                                    </div>

                                    <div class="menu-item">
                                        <a href="" class="menu-link">
                                            <span class="menu-icon">
                                                <i class="fa fa-paper-plane"></i>
                                            </span>
                                            <span class="menu-text">Issuing Items on Material Requests</span>
                                        </a>
                                    </div>

                                    <div class="menu-item">
                                        <a href="email_compose.html" class="menu-link">
                                            <span class="menu-icon">
                                                <i class="fa fa-check-square-o"></i>
                                            </span>
                                            <span class="menu-text">Job Close & Invoice</span>
                                        </a>
                                    </div>

                                </div>
                            </div>

                            <div class="menu-divider"></div>

                            <div class="menu-header">System Reports</div>

                            <div class="menu-item">
                                <a href="email_inbox.html" class="menu-link">
                                    <span class="menu-icon">
                                        <i class="fa fa-file-archive-o"></i>
                                    </span>
                                    <span class="menu-text">Stock Report</span>
                                </a>
                            </div>

                            <div class="menu-item">
                                <a href="email_inbox.html" class="menu-link">
                                    <span class="menu-icon">
                                        <i class="fa fa-file-code-o"></i>
                                    </span>
                                    <span class="menu-text">Job Report</span>
                                </a>
                            </div>

                            <div class="menu-item">
                                <a href="email_inbox.html" class="menu-link">
                                    <span class="menu-icon">
                                        <i class="fa fa-file-word-o"></i>
                                    </span>
                                    <span class="menu-text">Material Request</span>
                                </a>
                            </div>

                            <div class="menu-item">
                                <a href="email_inbox.html" class="menu-link">
                                    <span class="menu-icon">
                                        <i class="fa fa-file-text-o"></i>
                                    </span>
                                    <span class="menu-text">Stock Report</span>
                                </a>
                            </div>


                            <div class="menu-divider"></div>

                            <div class="menu-header">User Management</div>

                            <div class="menu-item">
                                <a href="user-registration" class="menu-link">
                                    <span class="menu-icon"><i class="fa fa-users"></i></span>
                                    <span class="menu-text">User Registration</span>
                                </a>
                            </div>

                            <div class="menu-item">
                                <a href="user-registration" class="menu-link">
                                    <span class="menu-icon"><i class="fa fa-window-restore"></i></span>
                                    <span class="menu-text">User Session Activites</span>
                                </a>
                            </div>
                        </div>

                    </div>


                    <button class="app-sidebar-mobile-backdrop" data-dismiss="sidebar-mobile"></button>

                </div>

                @yield('content')

                <a href="#" data-click="scroll-top" class="btn-scroll-top fade"><i class="fa fa-arrow-up"></i></a>

            </div>

        </main>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js">
    </script>
    <script src="{{ asset('assets/js/vendor.min.js') }}" type="0485eeef8cf3263d1a7b2548-text/javascript"></script>
    <script src="{{ asset('assets/js/app.min.js') }}" type="0485eeef8cf3263d1a7b2548-text/javascript"></script>
    <script src="{{ asset('assets/js/rocket-loader.min.js') }}" data-cf-settings="0485eeef8cf3263d1a7b2548-|49"
        defer=""></script>
    <script src="{{ asset('assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"
        type="0485eeef8cf3263d1a7b2548-text/javascript"></script>
    <script src="{{ asset('assets/js/notiflix.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.maskedinput.js') }}" type="text/javascript"></script>
    {{-- <script src="{{ asset('assets/js/process/admin.js') }}"></script> --}}
    <script src="{{ asset('assets/js/process/po.js') }}"></script>
    <script src="{{ asset('assets/js/process/myi.js') }}"></script>

    {{-- Item Auto Select --}}
    <script>
        $(document).ready(function() {

            $('#itemAutoSelect').typeahead({
                source: [{
                        id: '1',
                        name: 'ITM00021'
                    },
                    {
                        id: '2',
                        name: 'ITM0015'
                    },
                ],
                autoSelect: true
            });

        });

    </script>

    {{-- Supplier Auto Select --}}
    <script>
        // $(document).ready(function() {

        //     $('#supplierAutoSelect').typeahead({
        //         source: [{
        //                 id: '1',
        //                 name: 'SUP0001'
        //             },
        //             {
        //                 id: '2',
        //                 name: 'SUP0015'
        //             },
        //         ],
        //         autoSelect: true
        //     });

        // });

        $(document).ready(function() {

            $('#grnAutoSelect').typeahead({
                source: [{
                        id: '1',
                        name: 'P0001'
                    },
                    {
                        id: '2',
                        name: 'P0015'
                    },
                ],
                autoSelect: true
            });

        });

    </script>

    <script type="text/javascript">
        $(function() {
            $.mask.definitions['~'] = "[+-]";
            $("#po_date").mask("99/99/9999", {
                placeholder: "dd/mm/yyyy",
                completed: function() {
                    // alert("completed!");
                }
            });
        });

        $(function() {
            $.mask.definitions['~'] = "[+-]";
            $("#po_expt_deliver_date").mask("99/99/9999", {
                placeholder: "dd/mm/yyyy",
                completed: function() {
                    // alert("completed!");
                }
            });
        });

        $(".phone").mask("(999) 999-9999");
        $("input.precentage").mask("99%");

    </script>

</body>

</html>
