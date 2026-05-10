<nav class="navbar navbar-expand-lg">

    <div class="container-fluid nav-left">

        <!-- LOGO -->
        <a href="#">
            <img src="{{ asset('logo-frozeria.jpeg') }}" 
                 alt="Logo" style="width:120px;">
        </a>

        <!-- HAMBURGER -->
        <button class="navbar-toggler" type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navMenu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- MENU -->
        <div class="collapse navbar-collapse nav-menu" id="navMenu">

            <a href="{{ route('dashboard') }}"
               class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <i class="bi bi-box-seam"></i>
                <span>Dashboard</span>
            </a>

            <a href="{{ route('kategori.index') }}"
               class="nav-item {{ request()->routeIs('kategori.*') ? 'active' : '' }}">
                <i class="bi bi-tag"></i>
                <span>Kategori</span>
            </a>

            <a href="{{ route('bantuan') }}" class="nav-item {{ request()->routeIs('bantuan') ? 'active' : '' }}">
                <i class="bi bi-info-circle"></i>
                <span>Bantuan</span>
            </a>

        </div>

    </div>

</nav>

<style>
    /* NAV MENU JADI HORIZONTAL */
.navbar {
    display: flex;
    align-items: center;
    padding: 10px 20px;
    position: sticky;
    top: 0;
    z-index: 1000;
     background: #fff;
    border-bottom: 1px solid rgba(0,0,0,0.05);
    box-shadow: 0 2px 6px rgba(0,0,0,0.04);
}

.nav-left {
    display: flex;
    align-items: center;
    gap: 24px;
}

.nav-menu {
    display: flex;
    align-items: center;
    gap: 10px;
}

/* NAV ITEM DARI SIDEBAR DIADAPTASI */
.navbar .nav-item {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 8px 14px;
    border-radius: 10px;
    color: var(--text-muted);
    text-decoration: none;
    font-size: 13.5px;
    font-weight: 500;
    transition: all 0.18s ease;
}

/* ICON */
.navbar .nav-item i {
    font-size: 15px;
}

/* HOVER */
.navbar .nav-item:hover {
    background: var(--sidebar-hover-bg);
    color: var(--primary);
}

/* ACTIVE */
.navbar .nav-item.active {
    background: var(--primary);
    color: #ffffff;
    box-shadow: 0 4px 12px rgba(46,196,196,0.3);
}

.navbar .nav-item.active i {
    color: #ffffff;
}

@media (max-width: 991px) {

    /* default: ikut Bootstrap (hidden) */
    .nav-menu {
        flex-direction: column;
        align-items: stretch;
        width: 100%;
        margin-top: 10px;
        gap: 6px;
    }

    /* HANYA saat dibuka */
    .nav-menu.show {
        display: flex !important;
    }

    .nav-item {
        width: 100%;
        padding: 12px 16px;
    }
}
</style>