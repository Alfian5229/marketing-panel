<!-- Sidenav -->
<nav class="sidenav navbar navbar-vertical fixed-left navbar-expand-xs navbar-light bg-white" id="sidenav-main">
    <div class="scrollbar-inner">
      <!-- Brand -->
        <div class="sidenav-header d-flex align-items-center">
            <a class="navbar-brand" href="#" style="margin-left:10%">
                <img src="{{asset('assets')}}/img/brand/blue.png" class="navbar-brand-img" alt="...">
            </a>
            <div class="ml-auto">
                <!-- Sidenav toggler -->
                <div class="sidenav-toggler d-none d-xl-block" data-action="sidenav-unpin" data-target="#sidenav-main">
                    <div class="sidenav-toggler-inner">
                        <i class="sidenav-toggler-line"></i>
                        <i class="sidenav-toggler-line"></i>
                        <i class="sidenav-toggler-line"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="navbar-inner">
            <!-- Collapse -->
            <div class="collapse navbar-collapse" id="sidenav-collapse-main">
                <!-- Nav items -->
                <ul class="navbar-nav">
                    <li class="nav-item {{ $activepage == 'dashboard' ? ' active' : '' }}">
                        <a class="nav-link" href="/dashboard">
                            <i class="ni ni-tv-2 text-primary"></i>
                            <span class="nav-link-text">Dashboards</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#navbar-examples" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="navbar-examples">
                            <i class="ni ni-ungroup text-orange"></i>
                            <span class="nav-link-text">{{ __('Data Transaksi 2019') }}</span>
                        </a>
                        <div class="collapse {{ $activepage == 'data_transaksi' ? ' show' : '' }}" id="navbar-examples">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item {{ $activepage == 'data_trx_januari' ? ' active' : '' }}">
                                    <a class="nav-link" href="/data_trx_januari">
                                        {{ __('Januari') }}
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    {{-- <li class="nav-item">
                        <a class="nav-link" href="#navbar-laporan" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="navbar-examples">
                            <i class="ni ni-archive-2 text-green"></i>
                            <span class="nav-link-text">{{ __('Report') }}</span>
                        </a>
                        <div class="collapse {{ $activepage == 'withdraw' | $activepage == 'transaksi' ? ' show' : '' }}" id="navbar-laporan">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item {{ $activepage == 'transaksi' ? ' active' : '' }}">
                                    <a class="nav-link" href="/transaksi">
                                        {{ __('Transaction') }}
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item {{ $activepage == 'withdraw' ? ' active' : '' }}">
                        <a class="nav-link" href="/withdraw">
                            <i class="ni ni-tv-2 text-primary"></i>
                            <span class="nav-link-text">Withdraw</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#navbar-crm" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="navbar-examples">
                            <i class="ni ni-circle-08 text-orange"></i>
                            <span class="nav-link-text">{{ __('Management CRM') }}</span>
                        </a>
                        <div class="collapse {{ $activepage == 'users' ? ' show' : '' }}" id="navbar-crm">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item {{ $activepage == 'users' ? ' active' : '' }}">
                                    <a class="nav-link" href="/users">
                                        {{ __('User CRM') }}
                                    </a>
                                </li>
                                <li class="nav-item {{ $activepage == 'users' ? ' active' : '' }}">
                                    <a class="nav-link" href="/logactivity">
                                        {{ __('Log Activity Users') }}
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li> --}}
                </ul>
            </div>
        </div>
    </div>
</nav>
