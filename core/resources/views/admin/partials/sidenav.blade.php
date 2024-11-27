<div
    class="sidebar {{ sidebarVariation()['selector'] }} {{ sidebarVariation()['sidebar'] }} {{ @sidebarVariation()['overlay'] }} {{ @sidebarVariation()['opacity'] }}"
    data-background="{{ getImage('assets/laramin/images/sidebar/2.jpg', '400x800') }}">
    <button class="res-sidebar-close-btn"><i class="las la-times"></i></button>
    <div class="sidebar__inner">
        <div class="sidebar__logo">
            <a href="{{ route('admin.dashboard') }}" class="sidebar__main-logo"><img
                    src="{{ getImage(imagePath()['logoIcon']['path'] . '/logo_2.png') }}" alt="@lang('image')"></a>
            <a href="{{ route('admin.dashboard') }}" class="sidebar__logo-shape"><img
                    src="{{ getImage(imagePath()['logoIcon']['path'] . '/favicon.png') }}" alt="@lang('image')"></a>
            <button type="button" class="navbar__expand"></button>
        </div>
        @if (auth()->guard('admin')->check() && auth()->guard('admin')->user()->level == 1)
            <div class="sidebar__menu-wrapper" id="sidebar__menuWrapper">
                <ul class="sidebar__menu">
                    <li class="sidebar-menu-item {{ menuActive('admin.dashboard') }}">
                        <a href="{{ route('admin.dashboard') }}" class="nav-link ">
                            <i class="menu-icon las la-home"></i>
                            <span class="menu-title">@lang('Dashboard')</span>
                        </a>
                    </li>
                    @can(['admin.staff.index', 'admin.roles.index', 'admin.permissions.index'])
                        <li class="sidebar-menu-item sidebar-dropdown">
                            <a class="{{ menuActive(['admin.staff*', 'admin.roles.*'], 3) }}" href="javascript:void(0)">
                                <i class="menu-icon las la-users"></i>
                                <span class="menu-title">@lang('Manage Staff')</span>
                            </a>
                            <div
                                class="sidebar-submenu {{ menuActive(['admin.staff*', 'admin.roles.*', 'admin.permissions*'], 2) }}">
                                <ul>
                                    @can('admin.staff.index')
                                        <li class="sidebar-menu-item {{ menuActive('admin.staff*') }}">
                                            <a class="nav-link" href="{{ route('admin.staff.index') }}">
                                                <i class="menu-icon las la-dot-circle"></i>
                                                <span class="menu-title">@lang('All Staff')</span>
                                            </a>
                                        </li>
                                    @endcan

                                    @can('admin.roles.index')
                                        <li class="sidebar-menu-item {{ menuActive('admin.roles*') }}">
                                            <a class="nav-link" href="{{ route('admin.roles.index') }}">
                                                <i class="menu-icon las la-dot-circle"></i>
                                                <span class="menu-title">@lang('Roles')</span>
                                            </a>
                                        </li>
                                    @endcan

                                </ul>
                            </div>
                        </li>
                    @endcan

                    @can(['admin.location.index'])
                        <li class="sidebar-menu-item {{ menuActive('admin.location*') }}">
                            <a href="{{ route('admin.location.index') }}" class="nav-link ">
                                <i class="menu-icon las la-map-marker-alt"></i>
                                <span class="menu-title">@lang('Location')</span>
                            </a>
                        </li>
                    @endcan
                    @can(['admin.type.property.index'])
                        <li class="sidebar-menu-item {{ menuActive('admin.type.property.index') }}">
                            <a href="{{ route('admin.type.property.index') }}" class="nav-link ">
                                <i class="menu-icon las la-building"></i>
                                <span class="menu-title">@lang('Property Type')</span>
                            </a>
                        </li>
                    @endcan
                    @can(['admin.amenity*'])
                        <li class="sidebar-menu-item {{ menuActive('admin.amenity*') }}">
                            <a href="{{ route('admin.amenity.index') }}" class="nav-link">
                                <i class="menu-icon las la-bars"></i>
                                <span class="menu-title">@lang('Amenity')</span>
                            </a>
                        </li>
                    @endcan
                    @can(['admin.news*', 'admin.category.index'])
                        <li class="sidebar-menu-item sidebar-dropdown">
                            <a href="javascript:void(0)" class="{{ menuActive('admin.news*', 3) }}">
                                <i class="menu-icon la la-newspaper"></i>
                                <span class="menu-title">@lang('Blog Posts')</span>

                                @if ($pending_news > 0)
                                    <span class="menu-badge pill bg--primary ml-auto">
                                        <i class="fa fa-exclamation"></i>
                                    </span>
                                @endif
                            </a>
                            <div class="sidebar-submenu {{ menuActive('admin.news*', 2) }}">
                                <ul>
                                    @can(['admin.category.index'])
                                        <li class="sidebar-menu-item {{ menuActive(['admin.category.index']) }}">
                                            <a href="{{ route('admin.category.index') }}" class="nav-link">
                                                <i class="menu-icon las la-dot-circle"></i>
                                                <span class="menu-title">@lang('Post Category')</span>
                                            </a>
                                        </li>
                                    @endcan
                                    @can(['admin.news.index'])
                                        <li class="sidebar-menu-item {{ menuActive(['admin.news.index']) }}">
                                            <a href="{{ route('admin.news.index') }}" class="nav-link">
                                                <i class="menu-icon las la-dot-circle"></i>
                                                <span class="menu-title">@lang('All Blog Posts')</span>
                                            </a>
                                        </li>
                                    @endcan
                                    @can(['admin.news.pending'])
                                        <li class="sidebar-menu-item {{ menuActive('admin.news.pending') }}">
                                            <a href="{{ route('admin.news.pending') }}" class="nav-link">
                                                <i class="menu-icon las la-dot-circle"></i>
                                                <span class="menu-title">@lang('Pending Blog Posts')</span>
                                                @if ($pending_news)
                                                    <span
                                                        class="menu-badge pill bg--primary ml-auto">{{ $pending_news }}</span>
                                                @endif
                                            </a>
                                        </li>
                                    @endcan
                                    @can(['admin.news.approved'])
                                        <li class="sidebar-menu-item {{ menuActive('admin.news.approved') }}">
                                            <a href="{{ route('admin.news.approved') }}" class="nav-link">
                                                <i class="menu-icon las la-dot-circle"></i>
                                                <span class="menu-title">@lang('Approved Blog Posts')</span>
                                            </a>
                                        </li>
                                    @endcan
                                    @can(['admin.news.rejected'])
                                        <li class="sidebar-menu-item {{ menuActive('admin.news.rejected') }}">
                                            <a href="{{ route('admin.news.rejected') }}" class="nav-link">
                                                <i class="menu-icon las la-dot-circle"></i>
                                                <span class="menu-title">@lang('Rejected Blog Posts')</span>
                                            </a>
                                        </li>
                                    @endcan
                                </ul>
                            </div>
                        </li>
                    @endcan

                    @can(['admin.property*'])
                        <li class="sidebar-menu-item sidebar-dropdown">
                            <a href="javascript:void(0)" class="{{ menuActive('admin.property*', 3) }}">
                                <i class="menu-icon las la-store-alt"></i>
                                <span class="menu-title">@lang('Property')</span>
                            </a>
                            <div class="sidebar-submenu {{ menuActive('admin.property*', 2) }} ">
                                <ul>
                                    @can(['admin.property.index'])
                                        <li class="sidebar-menu-item {{ menuActive('admin.property.index') }} ">
                                            <a href="{{ route('admin.property.index') }}" class="nav-link">
                                                <i class="menu-icon las la-dot-circle"></i>
                                                <span class="menu-title">@lang('All Property')</span>
                                            </a>
                                        </li>
                                    @endcan
                                    @can(['admin.pending.property.index'])
                                        <li class="sidebar-menu-item {{ menuActive('admin.pending.property.index') }}">
                                            <a href="{{ route('admin.pending.property.index') }}" class="nav-link ">
                                                <i class="menu-icon las la-dot-circle"></i>
                                                <span class="menu-title">@lang('Pending Approval')</span>
                                            </a>
                                        </li>
                                    @endcan
                                </ul>
                            </div>
                        </li>
                    @endcan

                    @can(['admin.users*'])
                        <li class="sidebar-menu-item sidebar-dropdown">
                            <a href="javascript:void(0)" class="{{ menuActive('admin.users*', 3) }}">
                                <i class="menu-icon las la-users"></i>
                                <span class="menu-title">@lang('Manage Users')</span>

                                @if ($banned_users_count > 0 || $email_unverified_users_count > 0 || $sms_unverified_users_count > 0)
                                    <span class="menu-badge pill bg--primary ml-auto">
                                        <i class="fa fa-exclamation"></i>
                                    </span>
                                @endif
                            </a>
                            <div class="sidebar-submenu {{ menuActive('admin.users*', 2) }} ">
                                <ul>
                                    @can('admin.users.all')
                                        <li class="sidebar-menu-item {{ menuActive('admin.users.all') }} ">
                                            <a href="{{ route('admin.users.all') }}" class="nav-link">
                                                <i class="menu-icon las la-dot-circle"></i>
                                                <span class="menu-title">@lang('All Users')</span>
                                            </a>
                                        </li>
                                    @endcan

                                    @can('admin.users.active')
                                        <li class="sidebar-menu-item {{ menuActive('admin.users.active') }} ">
                                            <a href="{{ route('admin.users.active') }}" class="nav-link">
                                                <i class="menu-icon las la-dot-circle"></i>
                                                <span class="menu-title">@lang('Active Users')</span>
                                            </a>
                                        </li>
                                    @endcan

                                    @can('admin.users.banned')
                                        <li class="sidebar-menu-item {{ menuActive('admin.users.banned') }} ">
                                            <a href="{{ route('admin.users.banned') }}" class="nav-link">
                                                <i class="menu-icon las la-dot-circle"></i>
                                                <span class="menu-title">@lang('Banned Users')</span>
                                                @if ($banned_users_count)
                                                    <span
                                                        class="menu-badge pill bg--primary ml-auto">{{ $banned_users_count }}</span>
                                                @endif
                                            </a>
                                        </li>
                                    @endcan

                                    @can('admin.users.email.unverified')
                                        <li class="sidebar-menu-item  {{ menuActive('admin.users.email.unverified') }}">
                                            <a href="{{ route('admin.users.email.unverified') }}" class="nav-link">
                                                <i class="menu-icon las la-dot-circle"></i>
                                                <span class="menu-title">@lang('Email Unverified')</span>

                                                @if ($email_unverified_users_count)
                                                    <span
                                                        class="menu-badge pill bg--primary ml-auto">{{ $email_unverified_users_count }}</span>
                                                @endif
                                            </a>
                                        </li>
                                    @endcan
                                    @can('admin.users.mobile.unverified')
                                        <li class="sidebar-menu-item {{ menuActive('admin.users.sms.unverified') }}">
                                            <a href="{{ route('admin.users.sms.unverified') }}" class="nav-link">
                                                <i class="menu-icon las la-dot-circle"></i>
                                                <span class="menu-title">@lang('SMS Unverified')</span>
                                                @if ($sms_unverified_users_count)
                                                    <span
                                                        class="menu-badge pill bg--primary ml-auto">{{ $sms_unverified_users_count }}</span>
                                                @endif
                                            </a>
                                        </li>
                                    @endcan

                                    @can('admin.users.with.balance')
                                        <li class="sidebar-menu-item {{ menuActive('admin.users.with.balance') }}">
                                            <a href="{{ route('admin.users.with.balance') }}" class="nav-link">
                                                <i class="menu-icon las la-dot-circle"></i>
                                                <span class="menu-title">@lang('With Balance')</span>
                                            </a>
                                        </li>
                                    @endcan
                                    @can('admin.users.with.balance')
                                        <li class="sidebar-menu-item {{ menuActive('admin.users.with.referrer') }}">
                                            <a href="{{ route('admin.users.with.referrer') }}" class="nav-link">
                                                <i class="menu-icon las la-dot-circle"></i>
                                                <span class="menu-title">@lang('With Referrer')</span>
                                            </a>
                                        </li>
                                    @endcan

                                    @can('admin.users.notification.all')
                                        <li class="sidebar-menu-item {{ menuActive('admin.users.email.all') }}">
                                            <a href="{{ route('admin.users.email.all') }}" class="nav-link">
                                                <i class="menu-icon las la-dot-circle"></i>
                                                <span class="menu-title">@lang('Email to All')</span>
                                            </a>
                                        </li>
                                    @endcan

                                </ul>
                            </div>
                        </li>
                    @endcan
                    @can(['admin.owners*'])
                        <li class="sidebar-menu-item sidebar-dropdown">
                            <a href="javascript:void(0)" class="{{ menuActive('admin.owners*', 3) }}">
                                <i class="menu-icon las la-user-friends"></i>
                                <span class="menu-title">@lang('Manage Agents')</span>

                                @if ($banned_owners_count > 0 || $email_unverified_owners_count > 0 || $sms_unverified_owners_count > 0)
                                    <span class="menu-badge pill bg--primary ml-auto">
                                        <i class="fa fa-exclamation"></i>
                                    </span>
                                @endif
                            </a>
                            <div class="sidebar-submenu {{ menuActive('admin.owners*', 2) }} ">
                                <ul>
                                    @can(['admin.owners.all'])
                                        <li class="sidebar-menu-item {{ menuActive('admin.owners.all') }} ">
                                            <a href="{{ route('admin.owners.all') }}" class="nav-link">
                                                <i class="menu-icon las la-dot-circle"></i>
                                                <span class="menu-title">@lang('All Owners')</span>
                                            </a>
                                        </li>
                                    @endcan
                                    @can(['admin.owners.active'])
                                        <li class="sidebar-menu-item {{ menuActive('admin.owners.active') }} ">
                                            <a href="{{ route('admin.owners.active') }}" class="nav-link">
                                                <i class="menu-icon las la-dot-circle"></i>
                                                <span class="menu-title">@lang('Active Owners')</span>
                                            </a>
                                        </li>
                                    @endcan
                                    @can(['admin.owners.banned'])
                                        <li class="sidebar-menu-item {{ menuActive('admin.owners.banned') }} ">
                                            <a href="{{ route('admin.owners.banned') }}" class="nav-link">
                                                <i class="menu-icon las la-dot-circle"></i>
                                                <span class="menu-title">@lang('Banned Owners')</span>
                                                @if ($banned_owners_count)
                                                    <span
                                                        class="menu-badge pill bg--primary ml-auto">{{ $banned_owners_count }}</span>
                                                @endif
                                            </a>
                                        </li>
                                    @endcan
                                    @can(['admin.owners.kyc.unverified'])
                                        <li class="sidebar-menu-item {{ menuActive('admin.owners.kyc.unverified') }}">
                                            <a href="{{ route('admin.owners.kyc.unverified') }}" class="nav-link">
                                                <i class="menu-icon las la-dot-circle"></i>
                                                <span class="menu-title">@lang('KYC Unverified')</span>
                                                @if ($kycUnverifiedUsersCount)
                                                    <span
                                                        class="menu-badge pill bg--danger ms-auto">{{ $kycUnverifiedUsersCount }}</span>
                                                @endif
                                            </a>
                                        </li>
                                    @endcan
                                    @can(['admin.owners.kyc.pending'])
                                        <li class="sidebar-menu-item {{ menuActive('admin.owners.kyc.pending') }}">
                                            <a href="{{ route('admin.owners.kyc.pending') }}" class="nav-link">
                                                <i class="menu-icon las la-dot-circle"></i>
                                                <span class="menu-title">@lang('KYC Pending')</span>
                                                @if ($kycPendingUsersCount)
                                                    <span
                                                        class="menu-badge pill bg--danger ms-auto">{{ $kycPendingUsersCount }}</span>
                                                @endif
                                            </a>
                                        </li>
                                    @endcan
                                    @can(['admin.owners.email.unverified'])
                                        <li class="sidebar-menu-item  {{ menuActive('admin.owners.email.unverified') }}">
                                            <a href="{{ route('admin.owners.email.unverified') }}" class="nav-link">
                                                <i class="menu-icon las la-dot-circle"></i>
                                                <span class="menu-title">@lang('Email Unverified')</span>

                                                @if ($email_unverified_owners_count)
                                                    <span
                                                        class="menu-badge pill bg--primary ml-auto">{{ $email_unverified_owners_count }}</span>
                                                @endif
                                            </a>
                                        </li>
                                    @endcan
                                    @can(['admin.owners.sms.unverified'])
                                        <li class="sidebar-menu-item {{ menuActive('admin.owners.sms.unverified') }}">
                                            <a href="{{ route('admin.owners.sms.unverified') }}" class="nav-link">
                                                <i class="menu-icon las la-dot-circle"></i>
                                                <span class="menu-title">@lang('SMS Unverified')</span>
                                                @if ($sms_unverified_owners_count)
                                                    <span
                                                        class="menu-badge pill bg--primary ml-auto">{{ $sms_unverified_owners_count }}</span>
                                                @endif
                                            </a>
                                        </li>
                                    @endcan
                                    @can(['admin.owners.with.balance'])
                                        <li class="sidebar-menu-item {{ menuActive('admin.owners.with.balance') }}">
                                            <a href="{{ route('admin.owners.with.balance') }}" class="nav-link">
                                                <i class="menu-icon las la-dot-circle"></i>
                                                <span class="menu-title">@lang('With Balance')</span>
                                            </a>
                                        </li>
                                    @endcan
                                    @can(['admin.owners.email.all'])
                                        <li class="sidebar-menu-item {{ menuActive('admin.owners.email.all') }}">
                                            <a href="{{ route('admin.owners.email.all') }}" class="nav-link">
                                                <i class="menu-icon las la-dot-circle"></i>
                                                <span class="menu-title">@lang('Email to All')</span>
                                            </a>
                                        </li>
                                    @endcan

                                </ul>
                            </div>
                        </li>
                    @endcan

                    @can(['admin.gateway*'])
                        <li class="sidebar-menu-item sidebar-dropdown">
                            <a href="javascript:void(0)" class="{{ menuActive('admin.gateway*', 3) }}">
                                <i class="menu-icon las la-credit-card"></i>
                                <span class="menu-title">@lang('Payment Gateways')</span>
                            </a>
                            <div class="sidebar-submenu {{ menuActive('admin.gateway*', 2) }} ">
                                <ul>
                                    @can('admin.gateway.automatic.index')
                                        <li class="sidebar-menu-item {{ menuActive('admin.gateway.automatic.index') }} ">
                                            <a href="{{ route('admin.gateway.automatic.index') }}" class="nav-link">
                                                <i class="menu-icon las la-dot-circle"></i>
                                                <span class="menu-title">@lang('Automatic Gateways')</span>
                                            </a>
                                        </li>
                                    @endcan
                                    @can('admin.gateway.manual.index')
                                        <li class="sidebar-menu-item {{ menuActive('admin.gateway.manual.index') }} ">
                                            <a href="{{ route('admin.gateway.manual.index') }}" class="nav-link">
                                                <i class="menu-icon las la-dot-circle"></i>
                                                <span class="menu-title">@lang('Manual Gateways')</span>
                                            </a>
                                        </li>
                                    @endcan
                                </ul>
                            </div>
                        </li>
                    @endcan
                    @can(['admin.deposit*'])
                        <li class="sidebar-menu-item sidebar-dropdown">
                            <a href="javascript:void(0)" class="{{ menuActive('admin.deposit*', 3) }}">
                                <i class="menu-icon las la-credit-card"></i>
                                <span class="menu-title">@lang('Payments')</span>
                                @if (0 < $pending_deposits_count)
                                    <span class="menu-badge pill bg--primary ml-auto">
                                        <i class="fa fa-exclamation"></i>
                                    </span>
                                @endif
                            </a>
                            <div class="sidebar-submenu {{ menuActive('admin.deposit*', 2) }} ">
                                <ul>
                                    @can('admin.deposit.pending')
                                        <li class="sidebar-menu-item {{ menuActive('admin.deposit.pending') }} ">
                                            <a href="{{ route('admin.deposit.pending') }}" class="nav-link">
                                                <i class="menu-icon las la-dot-circle"></i>
                                                <span class="menu-title">@lang('Pending Payments')</span>
                                                @if ($pending_deposits_count)
                                                    <span
                                                        class="menu-badge pill bg--primary ml-auto">{{ $pending_deposits_count }}</span>
                                                @endif
                                            </a>
                                        </li>
                                    @endcan
                                    @can('admin.deposit.approved')
                                        <li class="sidebar-menu-item {{ menuActive('admin.deposit.approved') }} ">
                                            <a href="{{ route('admin.deposit.approved') }}" class="nav-link">
                                                <i class="menu-icon las la-dot-circle"></i>
                                                <span class="menu-title">@lang('Approved Payments')</span>
                                            </a>
                                        </li>
                                    @endcan
                                    @can('admin.deposit.successful')
                                        <li class="sidebar-menu-item {{ menuActive('admin.deposit.successful') }} ">
                                            <a href="{{ route('admin.deposit.successful') }}" class="nav-link">
                                                <i class="menu-icon las la-dot-circle"></i>
                                                <span class="menu-title">@lang('Successful Payments')</span>
                                            </a>
                                        </li>
                                    @endcan

                                    @can('admin.deposit.rejected')
                                        <li class="sidebar-menu-item {{ menuActive('admin.deposit.rejected') }} ">
                                            <a href="{{ route('admin.deposit.rejected') }}" class="nav-link">
                                                <i class="menu-icon las la-dot-circle"></i>
                                                <span class="menu-title">@lang('Rejected Payments')</span>
                                            </a>
                                        </li>
                                    @endcan
                                    @can('admin.deposit.list')
                                        <li class="sidebar-menu-item {{ menuActive('admin.deposit.list') }} ">
                                            <a href="{{ route('admin.deposit.list') }}" class="nav-link">
                                                <i class="menu-icon las la-dot-circle"></i>
                                                <span class="menu-title">@lang('All Payments')</span>
                                            </a>
                                        </li>
                                    @endcan
                                </ul>
                            </div>
                        </li>
                    @endcan
                    @can(['admin.withdraw*'])
                        <li class="sidebar-menu-item sidebar-dropdown">
                            <a href="javascript:void(0)" class="{{ menuActive('admin.withdraw*', 3) }}">
                                <i class="menu-icon la la-bank"></i>
                                <span class="menu-title">@lang('Withdrawals') </span>
                                @if (0 < $pending_withdraw_count)
                                    <span class="menu-badge pill bg--primary ml-auto">
                                        <i class="fa fa-exclamation"></i>
                                    </span>
                                @endif
                            </a>
                            <div class="sidebar-submenu {{ menuActive('admin.withdraw*', 2) }} ">
                                <ul>
                                    @can('admin.withdraw.method.index')
                                        <li class="sidebar-menu-item {{ menuActive('admin.withdraw.method.index') }}">
                                            <a href="{{ route('admin.withdraw.method.index') }}" class="nav-link">
                                                <i class="menu-icon las la-dot-circle"></i>
                                                <span class="menu-title">@lang('Withdrawal Methods')</span>
                                            </a>
                                        </li>
                                    @endcan
                                    @can('admin.withdraw.pending')
                                        <li class="sidebar-menu-item {{ menuActive('admin.withdraw.pending') }} ">
                                            <a href="{{ route('admin.withdraw.pending') }}" class="nav-link">
                                                <i class="menu-icon las la-dot-circle"></i>
                                                <span class="menu-title">@lang('Pending Log')</span>

                                                @if ($pending_withdraw_count)
                                                    <span
                                                        class="menu-badge pill bg--primary ml-auto">{{ $pending_withdraw_count }}</span>
                                                @endif
                                            </a>
                                        </li>
                                    @endcan
                                    @can('admin.withdraw.approved')
                                        <li class="sidebar-menu-item {{ menuActive('admin.withdraw.approved') }} ">
                                            <a href="{{ route('admin.withdraw.approved') }}" class="nav-link">
                                                <i class="menu-icon las la-dot-circle"></i>
                                                <span class="menu-title">@lang('Approved Log')</span>
                                            </a>
                                        </li>
                                    @endcan
                                    @can('admin.withdraw.rejected')
                                        <li class="sidebar-menu-item {{ menuActive('admin.withdraw.rejected') }} ">
                                            <a href="{{ route('admin.withdraw.rejected') }}" class="nav-link">
                                                <i class="menu-icon las la-dot-circle"></i>
                                                <span class="menu-title">@lang('Rejected Log')</span>
                                            </a>
                                        </li>
                                    @endcan
                                    @can('admin.withdraw.log')
                                        <li class="sidebar-menu-item {{ menuActive('admin.withdraw.log') }} ">
                                            <a href="{{ route('admin.withdraw.log') }}" class="nav-link">
                                                <i class="menu-icon las la-dot-circle"></i>
                                                <span class="menu-title">@lang('Withdrawals Log')</span>
                                            </a>
                                        </li>
                                    @endcan


                                </ul>
                            </div>
                        </li>
                    @endcan

                    @can(['admin.ticket*'])
                        <li class="sidebar-menu-item sidebar-dropdown">
                            <a href="javascript:void(0)" class="{{ menuActive('admin.ticket*', 3) }}">
                                <i class="menu-icon la la-ticket"></i>
                                <span class="menu-title">@lang('Support Ticket') </span>
                                @if (0 < $pending_ticket_count)
                                    <span class="menu-badge pill bg--primary ml-auto">
                                        <i class="fa fa-exclamation"></i>
                                    </span>
                                @endif
                            </a>
                            <div class="sidebar-submenu {{ menuActive('admin.ticket*', 2) }} ">
                                <ul>
                                    @can('admin.ticket.index')
                                        <li class="sidebar-menu-item {{ menuActive('admin.ticket') }} ">
                                            <a href="{{ route('admin.ticket') }}" class="nav-link">
                                                <i class="menu-icon las la-dot-circle"></i>
                                                <span class="menu-title">@lang('All Ticket')</span>
                                            </a>
                                        </li>
                                    @endcan
                                    @can('admin.ticket.pending')
                                        <li class="sidebar-menu-item {{ menuActive('admin.ticket.pending') }} ">
                                            <a href="{{ route('admin.ticket.pending') }}" class="nav-link">
                                                <i class="menu-icon las la-dot-circle"></i>
                                                <span class="menu-title">@lang('Pending Ticket')</span>
                                                @if ($pending_ticket_count)
                                                    <span
                                                        class="menu-badge pill bg--primary ml-auto">{{ $pending_ticket_count }}</span>
                                                @endif
                                            </a>
                                        </li>
                                    @endcan
                                    @can('admin.ticket.closed')
                                        <li class="sidebar-menu-item {{ menuActive('admin.ticket.closed') }} ">
                                            <a href="{{ route('admin.ticket.closed') }}" class="nav-link">
                                                <i class="menu-icon las la-dot-circle"></i>
                                                <span class="menu-title">@lang('Closed Ticket')</span>
                                            </a>
                                        </li>
                                    @endcan
                                    @can('admin.ticket.answered')
                                        <li class="sidebar-menu-item {{ menuActive('admin.ticket.answered') }} ">
                                            <a href="{{ route('admin.ticket.answered') }}" class="nav-link">
                                                <i class="menu-icon las la-dot-circle"></i>
                                                <span class="menu-title">@lang('Answered Ticket')</span>
                                            </a>
                                        </li>
                                    @endcan
                                </ul>
                            </div>
                        </li>
                    @endcan

                    @can(['admin.report*'])
                        <li class="sidebar-menu-item sidebar-dropdown">
                            <a href="javascript:void(0)" class="{{ menuActive('admin.report*', 3) }}">
                                <i class="menu-icon la la-list"></i>
                                <span class="menu-title">@lang('Report') </span>
                            </a>
                            <div class="sidebar-submenu {{ menuActive('admin.report*', 2) }} ">
                                <ul>
                                    @can('admin.report.transaction')
                                        <li
                                            class="sidebar-menu-item {{ menuActive(['admin.report.transaction', 'admin.report.transaction.search']) }}">
                                            <a href="{{ route('admin.report.transaction') }}" class="nav-link">
                                                <i class="menu-icon las la-dot-circle"></i>
                                                <span class="menu-title">@lang('Transaction Log')</span>
                                            </a>
                                        </li>
                                    @endcan
                                    @can('admin.report.uer.login.history')
                                        <li
                                            class="sidebar-menu-item {{ menuActive(['admin.report.user.login.history', 'admin.report.user.login.ipHistory']) }}">
                                            <a href="{{ route('admin.report.user.login.history') }}" class="nav-link">
                                                <i class="menu-icon las la-dot-circle"></i>
                                                <span class="menu-title">@lang('User Login History')</span>
                                            </a>
                                        </li>
                                    @endcan
                                    @can('admin.report.owner.login.history')
                                        <li
                                            class="sidebar-menu-item {{ menuActive(['admin.report.owner.login.history', 'admin.report.owner.login.ipHistory']) }}">
                                            <a href="{{ route('admin.report.owner.login.history') }}" class="nav-link">
                                                <i class="menu-icon las la-dot-circle"></i>
                                                <span class="menu-title">@lang('Owner Login History')</span>
                                            </a>
                                        </li>
                                    @endcan
                                    @can(['admin.report.email.history'])
                                        <li class="sidebar-menu-item {{ menuActive('admin.report.email.history') }}">
                                            <a href="{{ route('admin.report.email.history') }}" class="nav-link">
                                                <i class="menu-icon las la-dot-circle"></i>
                                                <span class="menu-title">@lang('Email History')</span>
                                            </a>
                                        </li>
                                    @endcan

                                </ul>
                            </div>
                        </li>
                    @endcan

                    @can('admin.subscriber.index')
                        <li class="sidebar-menu-item  {{ menuActive('admin.subscriber.index') }}">
                            <a href="{{ route('admin.subscriber.index') }}" class="nav-link"
                               data-default-url="{{ route('admin.subscriber.index') }}">
                                <i class="menu-icon las la-thumbs-up"></i>
                                <span class="menu-title">@lang('Subscribers') </span>
                            </a>
                        </li>
                    @endcan
                    @can('admin.subscriber.index')
                        <li class="sidebar-menu-item  {{ menuActive('admin.feedback.index') }}">
                            <a href="{{ route('admin.feedback.index') }}" class="nav-link"
                               data-default-url="{{ route('admin.feedback.index') }}">
                                <i class="menu-icon las la-thumbs-up"></i>
                                <span class="menu-title">@lang('Feedbacks') </span>
                            </a>
                        </li>
                    @endcan

                    @if (can([
                            'admin.setting.index',
                            'admin.cron.index',
                            'admin.setting.logo.icon',
                            'admin.setting.system.configuration',
                            'admin.kyc.setting',
                            'admin.referral.setting',
                            'admin.extensions.index',
                            'admin.language.manage',
                            'admin.seo',
                            'admin.setting.notification',
                            'admin.api*',
                        ]))
                        <li class="sidebar__menu-header">@lang('Settings')</li>
                    @endif
                    @can('admin.setting.index')
                        <li class="sidebar-menu-item {{ menuActive('admin.setting.index') }}">
                            <a href="{{ route('admin.setting.index') }}" class="nav-link">
                                <i class="menu-icon las la-life-ring"></i>
                                <span class="menu-title">@lang('General Setting')</span>
                            </a>
                        </li>
                    @endcan
                    @can('admin.setting.logo.icon')
                        <li class="sidebar-menu-item {{ menuActive('admin.setting.logo.icon') }}">
                            <a href="{{ route('admin.setting.logo.icon') }}" class="nav-link">
                                <i class="menu-icon las la-images"></i>
                                <span class="menu-title">@lang('Logo & Favicon')</span>
                            </a>
                        </li>
                    @endcan
                    @can('admin.extensions.index')
                        <li class="sidebar-menu-item {{ menuActive('admin.extensions.index') }}">
                            <a href="{{ route('admin.extensions.index') }}" class="nav-link">
                                <i class="menu-icon las la-cogs"></i>
                                <span class="menu-title">@lang('Extensions')</span>
                            </a>
                        </li>
                    @endcan
                    @can('admin.seo')
                        <li class="sidebar-menu-item {{ menuActive('admin.seo') }}">
                            <a href="{{ route('admin.seo') }}" class="nav-link">
                                <i class="menu-icon las la-globe"></i>
                                <span class="menu-title">@lang('SEO Manager')</span>
                            </a>
                        </li>
                    @endcan
                    @can('admin.kyc.setting')
                        <li class="sidebar-menu-item {{ menuActive('admin.kyc.setting') }}">
                            <a href="{{ route('admin.kyc.setting') }}" class="nav-link">
                                <i class="menu-icon las la-user-check"></i>
                                <span class="menu-title">@lang('KYC Setting')</span>
                            </a>
                        </li>
                    @endcan
                    @can('admin.email.template*')
                        <li class="sidebar-menu-item sidebar-dropdown">
                            <a href="javascript:void(0)" class="{{ menuActive('admin.email.template*', 3) }}">
                                <i class="menu-icon la la-envelope-o"></i>
                                <span class="menu-title">@lang('Email Manager')</span>
                            </a>
                            <div class="sidebar-submenu {{ menuActive('admin.email.template*', 2) }} ">
                                <ul>
                                    @can('admin.email.template.global')
                                        <li class="sidebar-menu-item {{ menuActive('admin.email.template.global') }} ">
                                            <a href="{{ route('admin.email.template.global') }}" class="nav-link">
                                                <i class="menu-icon las la-dot-circle"></i>
                                                <span class="menu-title">@lang('Global Template')</span>
                                            </a>
                                        </li>
                                    @endcan
                                    @can('admin.email.template.index', 'admin.email.template.edit')
                                        <li
                                            class="sidebar-menu-item {{ menuActive(['admin.email.template.index', 'admin.email.template.edit']) }} ">
                                            <a href="{{ route('admin.email.template.index') }}" class="nav-link">
                                                <i class="menu-icon las la-dot-circle"></i>
                                                <span class="menu-title">@lang('Email Templates')</span>
                                            </a>
                                        </li>
                                    @endcan
                                    @can('admin.email.template.setting')
                                        <li class="sidebar-menu-item {{ menuActive('admin.email.template.setting') }} ">
                                            <a href="{{ route('admin.email.template.setting') }}" class="nav-link">
                                                <i class="menu-icon las la-dot-circle"></i>
                                                <span class="menu-title">@lang('Email Configure')</span>
                                            </a>
                                        </li>
                                    @endcan
                                </ul>
                            </div>
                        </li>
                    @endcan
                    @can('admin.sms.template')
                        <li class="sidebar-menu-item sidebar-dropdown">
                            <a href="javascript:void(0)" class="{{ menuActive('admin.sms.template*', 3) }}">
                                <i class="menu-icon la la-mobile"></i>
                                <span class="menu-title">@lang('SMS Manager')</span>
                            </a>
                            <div class="sidebar-submenu {{ menuActive('admin.sms.template*', 2) }} ">
                                <ul>
                                    @can('admin.sms.template.global')
                                        <li class="sidebar-menu-item {{ menuActive('admin.sms.template.global') }} ">
                                            <a href="{{ route('admin.sms.template.global') }}" class="nav-link">
                                                <i class="menu-icon las la-dot-circle"></i>
                                                <span class="menu-title">@lang('Global Setting')</span>
                                            </a>
                                        </li>
                                    @endcan
                                    @can('admin.sms.templates.setting')
                                        <li class="sidebar-menu-item {{ menuActive('admin.sms.templates.setting') }} ">
                                            <a href="{{ route('admin.sms.templates.setting') }}" class="nav-link">
                                                <i class="menu-icon las la-dot-circle"></i>
                                                <span class="menu-title">@lang('SMS Gateways')</span>
                                            </a>
                                        </li>
                                    @endcan
                                    @can('admin.sms.template.index', 'admin.sms.template.edit')
                                        <li
                                            class="sidebar-menu-item {{ menuActive(['admin.sms.template.index', 'admin.sms.template.edit']) }} ">
                                            <a href="{{ route('admin.sms.template.index') }}" class="nav-link">
                                                <i class="menu-icon las la-dot-circle"></i>
                                                <span class="menu-title">@lang('SMS Templates')</span>
                                            </a>
                                        </li>
                                    @endcan
                                </ul>
                            </div>
                        </li>
                    @endcan
                    @if (can(['admin.frontend.templates', 'admin.frontend.manage.pages', 'admin.frontend.sections']))
                        <li class="sidebar__menu-header">@lang('Frontend Manager')</li>
                    @endif
                    @can('admin.frontend.manage.pages')
                        <li class="sidebar-menu-item {{ menuActive('admin.frontend.manage.pages') }}">
                            <a href="{{ route('admin.frontend.manage.pages') }}" class="nav-link ">
                                <i class="menu-icon la la-list"></i>
                                <span class="menu-title">@lang('Manage Pages')</span>
                            </a>
                        </li>
                    @endcan
                    @can('admin.frontend.sections')
                        <li class="sidebar-menu-item sidebar-dropdown">
                            <a href="javascript:void(0)" class="{{ menuActive('admin.frontend.sections*', 3) }}">
                                <i class="menu-icon la la-html5"></i>
                                <span class="menu-title">@lang('Manage Section')</span>
                            </a>
                            <div class="sidebar-submenu {{ menuActive('admin.frontend.sections*', 2) }} ">
                                <ul>
                                    @php
                                        $lastSegment = collect(request()->segments())->last();
                                    @endphp
                                    @foreach (getPageSections(true) as $k => $secs)
                                        @if ($secs['builder'])
                                            <li
                                                class="sidebar-menu-item  @if ($lastSegment == $k) active @endif ">
                                                <a href="{{ route('admin.frontend.sections', $k) }}" class="nav-link">
                                                    <i class="menu-icon las la-dot-circle"></i>
                                                    <span class="menu-title">{{ __($secs['name']) }}</span>
                                                </a>
                                            </li>
                                        @endif
                                    @endforeach

                                </ul>
                            </div>
                        </li>
                    @endcan


                    @can('admin.setting.cookie')
                        <li class="sidebar__menu-header">@lang('Extra')</li>
                        <li class="sidebar-menu-item {{ menuActive('admin.setting.cookie') }}">
                            <a href="{{ route('admin.setting.cookie') }}" class="nav-link">
                                <i class="menu-icon las la-cookie-bite"></i>
                                <span class="menu-title">@lang('GDPR Cookie')</span>
                            </a>
                        </li>
                    @endcan
                    @can('admin.setting.custom.css')
                        <li class="sidebar-menu-item {{ menuActive('admin.setting.custom.css') }}">
                            <a href="{{ route('admin.setting.custom.css') }}" class="nav-link">
                                <i class="menu-icon lab la-css3-alt"></i>
                                <span class="menu-title">@lang('Custom CSS')</span>
                            </a>
                        </li>
                    @endcan
                    @can('admin.system.optimize')
                        <li class="sidebar-menu-item {{ menuActive('admin.setting.optimize') }}">
                            <a href="{{ route('admin.setting.optimize') }}" class="nav-link">
                                <i class="menu-icon las la-broom"></i>
                                <span class="menu-title">@lang('Clear Cache')</span>
                            </a>
                        </li>
                    @endcan
                </ul>
                <div class="text-center mb-3 text-uppercase">
                    <span class="text--primary">{{ __(systemDetails()['name']) }}</span>
                    <span class="text--success">@lang('V'){{ systemDetails()['version'] }} </span>
                </div>
            </div>
        @elseif(auth()->guard('admin')->check() && auth()->guard('admin')->user()->level == 2)
            <div class="sidebar__menu-wrapper" id="sidebar__menuWrapper">


                <ul class="sidebar__menu">
                    <li class="sidebar-menu-item {{ menuActive('user.home') }}">
                        <a href="{{ route('admin.dashboard') }}" class="nav-link ">
                            <i class="menu-icon las la-home"></i>
                            <span class="menu-title">@lang('Dashboard')</span>
                        </a>
                    </li>


                    <li class="sidebar-menu-item sidebar-dropdown">
                        <a href="javascript:void(0)" class="{{ menuActive('user.news*', 3) }}">
                            <i class="menu-icon la la-newspaper"></i>
                            <span class="menu-title">@lang('News') </span>
                        </a>
                        <div class="sidebar-submenu {{ menuActive('user.news*', 2) }} ">
                            <ul>
                                <li class="sidebar-menu-item {{ menuActive(['user.news.index']) }}">
                                    <a href="{{ route('admin.news.index') }}" class="nav-link">
                                        <i class="menu-icon las la-dot-circle"></i>
                                        <span class="menu-title">@lang('All News')</span>
                                    </a>
                                </li>
                                <li class="sidebar-menu-item {{ menuActive('user.news.pending') }}">
                                    <a href="{{ route('admin.news.pending') }}" class="nav-link">
                                        <i class="menu-icon las la-dot-circle"></i>
                                        <span class="menu-title">@lang('Pending News')</span>
                                    </a>
                                </li>
                                <li class="sidebar-menu-item {{ menuActive('user.news.approved') }}">
                                    <a href="{{ route('admin.news.approved') }}" class="nav-link">
                                        <i class="menu-icon las la-dot-circle"></i>
                                        <span class="menu-title">@lang('Approved News')</span>
                                    </a>
                                </li>
                                <li class="sidebar-menu-item {{ menuActive('user.news.rejected') }}">
                                    <a href="{{ route('admin.news.rejected') }}" class="nav-link">
                                        <i class="menu-icon las la-dot-circle"></i>
                                        <span class="menu-title">@lang('Rejected News')</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="sidebar-menu-item sidebar-dropdown">
                        <a href="javascript:void(0)"
                           class="{{ menuActive(['user.change.password', 'user.profile.setting', 'user.twofactor'], 3) }}">
                            <i class="menu-icon la la-user-circle"></i>
                            <span class="menu-title">@lang('Profile') </span>
                        </a>
                        <div
                            class="sidebar-submenu {{ menuActive(['user.change.password', 'user.profile.setting', 'user.twofactor'], 2) }} ">
                            <ul>
                                <li class="sidebar-menu-item {{ menuActive('admin.change.password') }}">
                                    <a href="{{ route('admin.password') }}" class="nav-link">
                                        <i class="menu-icon las la-dot-circle"></i>
                                        <span class="menu-title">@lang('Change Password')</span>
                                    </a>
                                </li>
                                <li class="sidebar-menu-item {{ menuActive('admin.profile.setting') }}">
                                    <a href="{{ route('admin.profile') }}" class="nav-link">
                                        <i class="menu-icon las la-dot-circle"></i>
                                        <span class="menu-title">@lang('Profile Setting')</span>
                                    </a>
                                </li>
                                <li class="sidebar-menu-item">
                                    <a href="{{ route('admin.logout') }}" class="nav-link">
                                        <i class="menu-icon las la-dot-circle"></i>
                                        <span class="menu-title">@lang('Logout')</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>

            </div>
        @endif
    </div>
</div>
<!-- sidebar end -->
