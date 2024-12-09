<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

<div data-simplebar class="h-100">

    <!--- Sidemenu -->
    <div id="sidebar-menu">
        <!-- Left Menu Start -->
        <ul class="metismenu list-unstyled" id="side-menu">
            <li class="menu-title" data-key="t-menu">Menu</li>

            <li>
                <a href="{{ route('dashboard') }}">
                    <i data-feather="home"></i>
                    <span data-key="t-dashboard">Dashboard</span>
                </a>
            </li>

            <li class="menu-title" data-key="t-apps">Apps</li>

            <li>
                <a href="javascript: void(0);" class="has-arrow">
                    <i data-feather="archive"></i>
                    <span data-key="t-ecommerce">Pemindahan Data</s pan>
                </a>
                <ul class="sub-menu" aria-expanded="false">
                    <li><a href="{{ route('spareparts.import.view') }}" data-key="t-orders">Import Sistem</a></li>
                    <li><a href="{{ route('spareparts.importact.view') }}" data-key="t-orders">Import Actual</a></li>
                </ul>
            </li>
    </div>
    <!-- Sidebar -->
</div>
</div>
<!-- Left Sidebar End -->