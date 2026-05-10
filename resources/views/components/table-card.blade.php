<div class="table-card">

    {{-- TOOLBAR (optional) --}}
    @isset($toolbar)
        <div class="table-toolbar">
            {{ $toolbar }}
        </div>
    @endisset

    {{-- TABLE --}}
    <div class="table-wrap">
        <table class="data-table">
            
            {{-- HEADER --}}
            @isset($head)
                <thead>
                    {{ $head }}
                </thead>
            @endisset

            {{-- BODY --}}
            <tbody>
                {{ $slot }}
            </tbody>

        </table>
    </div>

    {{-- FOOTER (optional: pagination, info) --}}
    @isset($footer)
        <div class="table-footer">
            {{ $footer }}
        </div>
    @endisset

</div>