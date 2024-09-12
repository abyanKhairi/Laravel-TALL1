<!-- Modal Edit -->
<div @close.window="$el.querySelector('[data-bs-dismiss=modal]').click();" x-data="{ eketerangan: @entangle('Eketerangan') }" class="modal fade"
    wire:ignore.self id="kategoriModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="kategoriModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="kategoriModalLabel">Edit</h5>
                <button type="button" wire:click="cancel" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form wire:submit.prevent="update">
                    <div class="mb-3">
                        <label for="Ename" class="form-label">Product Quantity</label>
                        <input type="text" class="form-control @error('Ename') is-invalid @enderror" id="Ename"
                            wire:model="Ename">
                        @error('Ename')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="Eketerangan" class="form-label">Product Eketerangan</label>
                        <trix-editor x-ref="trixEditor" x-init="$nextTick(() => $refs.trixEditor.editor.loadHTML(eketerangan))"
                            x-on:trix-change="eketerangan = $event.target.editor.getDocument().toString()">
                        </trix-editor>
                        @error('Eketerangan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3 text-end">
                        <button type="submit" class="btn btn-success">Save</button>
                        <button type="button" wire:click="cancel" class="btn btn-danger"
                            data-bs-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
