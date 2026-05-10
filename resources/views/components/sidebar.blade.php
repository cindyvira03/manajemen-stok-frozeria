{{-- resources/views/layouts/partials/sidebar.blade.php --}}

<aside class="app-sidebar">

    {{-- Logo --}}
    <div class="sidebar-logo">
        <div class="logo-frozeria">
            <img src="{{ asset('logo-frozeria.jpeg') }}" 
                alt="Logo Frozeria"
                style="width:200px; height:auto; object-fit:contain;">
        </div>
    </div>

    {{-- Navigation --}}
    <nav class="sidebar-nav">
        {{-- <a href="{{ route('dashboard') }}"
           class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <i class="bi bi-house-door"></i>
            <span>Dashboard</span>
        </a> --}}

        <a href="{{ route('barang.index') }}"
           class="nav-item {{ request()->routeIs('barang.*') ? 'active' : '' }}">
            <i class="bi bi-box-seam"></i>
            <span>Dashboard</span>
        </a>

        <a href="{{ route('kategori.index') }}"
           class="nav-item {{ request()->routeIs('kategori.*') ? 'active' : '' }}">
            <i class="bi bi-folder2"></i>
            <span>Kategori</span>
        </a>

        <a href="#"
           class="nav-item {{ request()->routeIs('bantuan.*') ? 'active' : '' }}">
            <i class="bi bi-gear"></i>
            <span>Bantuan</span>
        </a>
    </nav>

    {{-- User Profile --}}
    <div class="sidebar-user">
        <div class="user-avatar">
            <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name ?? 'Admin') }}&background=2EC4C4&color=fff&size=36" alt="avatar">
        </div>
        <div class="user-info">
            <span class="user-name">{{ auth()->user()->name ?? 'Admin' }}</span>
            <span class="user-role">{{ auth()->user()->role ?? 'Administrator' }}</span>
        </div>
        <button class="user-chevron" title="Opsi">
            <i class="bi bi-chevron-down"></i>
        </button>
    </div>

</aside>

<style>
/* ===== SIDEBAR STYLES ===== */
.sidebar-logo {
    display: flex;
    align-items: center;
    /* gap: 10px;
    padding: 18px 20px;
    border-bottom: 1px solid var(--border); */
}

/* Nav */
.sidebar-nav {
    flex: 1;
    padding: 16px 12px;
    display: flex;
    flex-direction: column;
    gap: 2px;
}

.nav-item {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 9px 12px;
    border-radius: 10px;
    color: var(--text-muted);
    text-decoration: none;
    font-size: 13.5px;
    font-weight: 500;
    transition: all 0.18s ease;
}

.nav-item i {
    font-size: 16px;
    flex-shrink: 0;
}

.nav-item:hover {
    background: var(--sidebar-hover-bg);
    color: var(--primary);
}

.nav-item.active {
    background: var(--primary);
    color: #ffffff;
    box-shadow: 0 4px 12px rgba(46,196,196,0.3);
}

.nav-item.active i {
    color: #ffffff;
}

/* User Profile */
.sidebar-user {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 14px 16px;
    border-top: 1px solid var(--border);
    margin-top: auto;
}

.user-avatar img {
    width: 36px;
    height: 36px;
    border-radius: 50%;
    display: block;
}

.user-info {
    flex: 1;
    display: flex;
    flex-direction: column;
    overflow: hidden;
    min-width: 0;
}

.user-name {
    font-size: 13px;
    font-weight: 600;
    color: var(--text-dark);
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.user-role {
    font-size: 11px;
    color: var(--text-muted);
}

.user-chevron {
    background: none;
    border: none;
    cursor: pointer;
    color: var(--text-muted);
    padding: 4px;
    border-radius: 6px;
    display: flex;
    align-items: center;
    font-size: 12px;
    transition: background 0.15s;
}

.user-chevron:hover {
    background: var(--sidebar-hover-bg);
    color: var(--text-dark);
}
</style>