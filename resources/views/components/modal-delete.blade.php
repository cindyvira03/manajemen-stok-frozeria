@props([
    'id' => 'deleteModal'
])

<div class="modal fade" id="{{ $id }}" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content text-center p-3">

            <div class="modal-body">

                {{-- ICON --}}
                <div class="mb-3">
                    <div class="modal-icon-danger">
                        <i class="bi bi-exclamation-triangle"></i>
                    </div>
                </div>

                <h5>Hapus data?</h5>

                <p id="deleteText" class="text-muted"></p>

                <div class="d-flex justify-content-center gap-2 mt-3">
                    
                    <x-button type="batal" data-bs-dismiss="modal">
                        Batal
                    </x-button>

                    <form id="deleteForm" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger">Ya, Hapus</button>
                    </form>

                </div>

            </div>

        </div>
    </div>
</div>