{{-- resources/views/layouts/partials/header.blade.php --}}

<header class="app-header">
    <div class="header-inner">

        {{-- Hamburger (mobile) --}}
        <button class="header-menu-btn" id="sidebarToggle" title="Toggle Sidebar">
            <i class="bi bi-list"></i>
        </button>

        {{-- Spacer --}}
        <div class="header-spacer"></div>

        {{-- Right Actions --}}
        <div class="header-actions">

            

        </div>
    </div>
</header>

<style>
/* ===== HEADER STYLES ===== */
.header-inner {
    height: var(--header-height);
    display: flex;
    align-items: center;
    padding: 0 24px;
    gap: 12px;
}

.header-menu-btn {
    background: none;
    border: none;
    cursor: pointer;
    font-size: 20px;
    color: var(--text-muted);
    display: flex;
    align-items: center;
    padding: 6px;
    border-radius: 8px;
    transition: all 0.15s;
}

.header-menu-btn:hover {
    background: var(--body-bg);
    color: var(--text-dark);
}

.header-spacer { flex: 1; }

.header-actions {
    display: flex;
    align-items: center;
    gap: 4px;
}

.header-icon-btn {
    position: relative;
    background: none;
    border: none;
    cursor: pointer;
    font-size: 18px;
    color: var(--text-muted);
    display: flex;
    align-items: center;
    justify-content: center;
    width: 38px;
    height: 38px;
    border-radius: 10px;
    transition: all 0.15s;
}

.header-icon-btn:hover {
    background: var(--body-bg);
    color: var(--text-dark);
}

.notif-wrapper { position: relative; }

.notif-badge {
    position: absolute;
    top: 5px;
    right: 5px;
    background: var(--primary);
    color: #fff;
    font-size: 9px;
    font-weight: 700;
    min-width: 16px;
    height: 16px;
    border-radius: 99px;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 0 3px;
    pointer-events: none;
    border: 2px solid #fff;
}
</style>