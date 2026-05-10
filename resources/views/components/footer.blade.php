{{-- resources/views/layouts/partials/footer.blade.php --}}

<footer class="app-footer">
    <div class="footer-inner">
        <span class="footer-text">
            &copy; {{ date('Y') }} Frozeria Stok. All rights reserved.
        </span>
    </div>
</footer>

<style>
/* ===== FOOTER STYLES ===== */
.app-footer {
    background: var(--card-bg);
    border-top: 1px solid var(--border);
}

.footer-inner {
    height: 44px;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 0 24px;
}

.footer-text {
    font-size: 12px;
    color: var(--text-muted);
}
</style>