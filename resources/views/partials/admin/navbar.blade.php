@stack('navbar_start')
<nav class="navbar navbar-top navbar-expand navbar-dark border-bottom">
    <div class="container-fluid">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            @stack('navbar_search')

            @permission('read-common-search')
                <form class="navbar-search navbar-search-light form-inline mb-0" id="navbar-search-main" autocomplete="off">
                    <div id="global-search" class="form-group mb-0 mr-sm-3">
                        <div class="input-group input-group-alternative input-group-merge">
                            <div class="input-group-prepend">
                                <span class="input-group-text remove-border"><i class="fa fa-search setLiteColor"></i></span>
                            </div>
                            <input type="text" name="search" v-model="keyword" @input="onChange" v-click-outside="closeResult" class="form-control remove-border" autocomplete="off" placeholder="{{ trans('general.search') }}">
                            <div class="dropdown-menu dropdown-menu-xl dropdown-menu-center" ref="menu" :class="[{show: show}]">
                                <div class="list-group list-group-flush">
                                    <a class="list-group-item list-group-item-action" :href="item.href" v-for="(item, index) in items">
                                        <div class="row align-items-center">
                                            <div class="col ml--2">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div>
                                                        <div class="name" v-text="item.name"></div>
                                                    </div>
                                                    <div class="">
                                                        <span class="type" v-text="item.type"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="close" data-action="search-close" data-target="#navbar-search-main" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </form>
            @endpermission

            <ul class="navbar-nav align-items-center ml-md-auto">
                @stack('navbar_create')

                @permission(['create-sales-invoices', 'create-sales-revenues', 'create-sales-invoices', 'create-purchases-bills', 'create-purchases-payments', 'create-purchases-vendors'])
                    <li class="nav-item dropdown">
                        <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="far fa-plus-square"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-dark dropdown-menu-right lg-screen">
                            <div class="row shortcuts px-4">
                                @stack('navbar_create_invoice')

                                @permission('create-sales-invoices')
                                    <a onmouseover="MouseOver('createinvoice');" onmouseout="MouseOut('createinvoice');" href="{{ route('invoices.create') }}" class="cl-custom shortcut-item">
                                        <small id="createinvoice" class="text-info hover-text-margin">{{ trans_choice('general.invoices', 1) }}</small>
                                        <span class="shortcut-media avatar rounded-circle btn-box-shadow set-background-1">
                                        <i  class="fa fa-shopping-cart marginLeft"></i>
                                        </span>

                                    </a>
                                @endpermission

                                @stack('navbar_create_revenue')

                                @permission('create-sales-revenues')

                                    <a onmouseover="MouseOver('revenues-top-nav');" onmouseout="MouseOut('revenues-top-nav');" href="{{ route('revenues.create') }}" class="cl-custom shortcut-item">
                                        <small id="revenues-top-nav" class="text-info hover-text-margin">{{ trans_choice('general.revenues', 1) }}</small>
                                        <span class="shortcut-media avatar rounded-circle btn-box-shadow set-background-2">
                                            <i class="fas fa-hand-holding-usd"></i>
                                        </span>
                                    </a>
                                @endpermission

                                @stack('navbar_create_customer')

                                @permission('create-sales-customers')
                                    <a onmouseover="MouseOver('customers-top-nav');" onmouseout="MouseOut('customers-top-nav');" href="{{ route('customers.create') }}" class="cl-custom shortcut-item">
                                        <small id="customers-top-nav" class="text-info hover-text-margin">{{ trans_choice('general.customers', 1) }}</small>
                                        <span class="shortcut-media avatar rounded-circle btn-box-shadow set-background-3">
                                        <i class="fas fa-user"></i>
                                        </span>
                                    </a>
                                @endpermission

                                @stack('navbar_create_bill')

                                @permission('create-purchases-bills')
                                    <a onmouseover="MouseOver('bills-top-nav');" onmouseout="MouseOut('bills-top-nav');" href="{{ route('bills.create') }}" class="cl-custom shortcut-item">
                                        <small id="bills-top-nav" class="text-info hover-text-margin">{{ trans_choice('general.bills', 1) }}</small>
                                        <span class="shortcut-media avatar rounded-circle btn-box-shadow set-background-4">
                                        <i class="fa fa-shopping-cart marginLeft"></i>
                                        </span>
                                    </a>
                                @endpermission

                                @stack('navbar_create_payment')

                                @permission('create-purchases-payments')
                                    <a onmouseover="MouseOver('payments-top-nav');" onmouseout="MouseOut('payments-top-nav');" href="{{ route('payments.create') }}" class="cl-custom shortcut-item">
                                        <small id="payments-top-nav" class="text-info hover-text-margin">{{ trans_choice('general.payments', 1) }}</small>
                                        <span class="shortcut-media avatar rounded-circle btn-box-shadow set-background-5">
                                            <i class="fas fa-hand-holding-usd"></i>
                                        </span>
                                    </a>
                                @endpermission

                                @stack('navbar_create_vendor_start')

                                @permission('create-purchases-vendors')
                                    <a onmouseover="MouseOver('vendor-top-nav');" onmouseout="MouseOut('vendor-top-nav');" href="{{ route('vendors.create') }}" class="cl-custom shortcut-item">
                                        <small id="vendor-top-nav" class="text-info hover-text-margin">{{ trans_choice('general.vendors', 1) }}</small>
                                        <span class="shortcut-media avatar rounded-circle btn-box-shadow set-background-6">
                                        <i class="fas fa-user"></i>
                                        </span>
                                    </a>
                                @endpermission

                                @stack('navbar_create_vendor_end')


                                
                            </div>
                        </div>
                    </li>
                @endpermission

                @stack('navbar_notifications')

                <li class="nav-item dropdown">
                    <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span>
                            <i class="far fa-bell"></i>
                        </span>
                        @if ($notifications)
                            <span class="badge badge-md badge-circle badge-reminder badge-warning">{{ $notifications }}</span>
                        @endif
                    </a>

                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right py-0 overflow-hidden">
                        @if ($notifications)
                            <div class="p-3">
                                <a class="text-sm text-muted">{{ trans_choice('header.notifications.counter', $notifications, ['count' => $notifications]) }}</a>
                            </div>
                        @endif

                        <div class="list-group list-group-flush">
                            @if (count($bills))
                                <a href="{{ route('users.read.bills', $user->id) }}" class="list-group-item list-group-item-action">
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <i class="fa fa-shopping-cart"></i>
                                        </div>
                                        <div class="col ml--2">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <h4 class="mb-0 text-sm">{{ trans_choice('header.notifications.upcoming_bills', count($bills), ['count' => count($bills)]) }}</h4>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            @endif

                            @if (count($invoices))
                                <a href="{{ route('users.read.invoices', $user->id) }}" class="list-group-item list-group-item-action">
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <i class="fa fa-money-bill"></i>
                                        </div>
                                        <div class="col ml--2">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <h4 class="mb-0 text-sm">{{ trans_choice('header.notifications.overdue_invoices', count($invoices), ['count' => count($invoices)]) }}</h4>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            @endif
                        </div>

                        @if ($notifications)
                            <a href="#" class="dropdown-item text-center text-info font-weight-bold py-3">{{ trans('header.notifications.view_all') }}</a>
                        @else
                            <a class="dropdown-item text-center text-info font-weight-bold py-3">{{ trans_choice('header.notifications.counter', $notifications, ['count' => $notifications]) }}</a>
                        @endif
                    </div>
                </li>

{{--                @stack('navbar_updates')--}}

{{--                @permission('read-install-updates')--}}
{{--                    <li class="nav-item">--}}
{{--                        <a class="nav-link" href="{{ route('updates.index') }}" title="{{ $updates }} Updates Available" role="button" aria-haspopup="true" aria-expanded="false">--}}
{{--                            <span>--}}
{{--                                <i class="fa fa-sync-alt"></i>--}}
{{--                            </span>--}}
{{--                            @if ($updates)--}}
{{--                                <span class="badge badge-md badge-circle badge-update badge-warning">{{ $updates }}</span>--}}
{{--                            @endif--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                @endpermission--}}

{{--                @stack('navbar_help_start')--}}

{{--                <li class="nav-item d-none d-md-block">--}}
{{--                    <a class="nav-link" href="{{ url(trans('header.support_link')) }}" target="_blank" title="{{ trans('general.help') }}" role="button" aria-haspopup="true" aria-expanded="false">--}}
{{--                        <i class="far fa-life-ring"></i>--}}
{{--                    </a>--}}
{{--                </li>--}}

{{--                @stack('navbar_help_end')--}}
            </ul>

            @stack('navbar_profile')

            <ul class="navbar-nav align-items-center ml-auto ml-md-0">
                <li class="nav-item dropdown">
                    <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                        <div class="media align-items-center">
                            <img src="{{ asset('public/img/proPic.jpeg') }}" height="36" width="36" alt="User"/>
                            <div class="media-body ml-2 d-none d-lg-block">
                                <span class="mb-0 text-sm  font-weight-bold">
                                    @if (!empty($user->name))
                                        {{ $user->name }}
                                    @endif
                                </span>
                            </div>
                        </div>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right">
                        @stack('navbar_profile_welcome')

                        <div class="dropdown-header noti-title">
                            <h6 class="text-overflow m-0">{{ trans('general.welcome') }}</h6>
                        </div>

                        @stack('navbar_profile_edit')

                        @permission('update-auth-users')
                            <a href="{{ route('users.edit', $user->id) }}" class="dropdown-item">
                                <i class="fas fa-user"></i>
                                <span>{{ trans('auth.profile') }}</span>
                            </a>
                        @endpermission

                        @permission(['read-auth-users', 'read-auth-roles', 'read-auth-permissions'])
                            <div class="dropdown-divider"></div>

                            @stack('navbar_profile_users')

                            @permission('read-auth-users')
                                <a href="{{ route('users.index') }}" class="dropdown-item">
                                    <i class="fas fa-users"></i>
                                    <span>{{ trans_choice('general.users', 2) }}</span>
                                </a>
                            @endpermission

                            @stack('navbar_profile_roles')

                            @permission('read-auth-roles')
                                <a href="{{ route('roles.index') }}" class="dropdown-item">
                                    <i class="fas fa-list"></i>
                                    <span>{{ trans_choice('general.roles', 2) }}</span>
                                </a>
                            @endpermission

                            @stack('navbar_profile_permissions_start')

                            @permission('read-auth-permissions')
                                <a href="{{ route('permissions.index') }}" class="dropdown-item">
                                    <i class="fas fa-key"></i>
                                    <span>{{ trans_choice('general.permissions', 2) }}</span>
                                </a>
                            @endpermission

                            @stack('navbar_profile_permissions_end')
                        @endpermission

                        <div class="dropdown-divider"></div>

                        @stack('navbar_profile_logout_start')

                        <a href="{{ route('logout') }}" class="dropdown-item">
                            <i class="fas fa-power-off"></i>
                            <span>{{ trans('auth.logout') }}</span>
                        </a>

                        @stack('navbar_profile_logout_end')
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>
@stack('navbar_end')
<script>

    // let search = document.querySelector('.remove-border');
    // console.log(search);
    // search.addEventListener("focusin", function () {
    //    // let input = document.querySelector('.input-group-text');
    //    console.log('focus');
    //
    // });
    let elements = document.getElementsByClassName("hover-text-margin");
    //console.log(elements);
    Array.from(elements).forEach(b => {
        b.style.visibility = "hidden";
    });
    function MouseOver(id) {
        let Id = id;
        let elem = document.getElementById(Id);
        elem.style.visibility = "visible";
    }
    function MouseOut(id) {
        let Id = id;
        let elem = document.getElementById(Id);
        elem.style.visibility = "hidden";
    }
</script>
