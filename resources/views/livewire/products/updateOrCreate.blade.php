<div class="modal fade" wire:ignore.self @close.window="$el.querySelector('[data-bs-dismiss=modal]').click();"
    id="productModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="productModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="productModalLabel">{{ $title }}</h5>
                <button type="button" wire:click="cancel" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div>
                    <form wire:submit.prevent="save">
                        <div wire:ignore x-data="{ content: @entangle('name') }" x-init="$nextTick(() => {
                            ClassicEditor
                                .create(document.querySelector('#name'))
                                .then(newEditor => {
                                    editor = newEditor;
                                    editor.model.document.on('change:data', () => {
                                        @this.set('name', editor.getData());
                                    });
                                })
                        })">
                            <label for="name" class="form-label">Product name</label>
                            <textarea x-model="content" class="form-control @error('name') is-invalid @enderror" id="name"
                                wire:model.defer="name"></textarea>
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="kategori" class="form-label">Category</label>
                            <select wire:model="kategori_id"
                                class="form-control @error('kategori_id') is-invalid @enderror" id="kategori">
                                <option value="">Select Category</option>
                                @foreach ($kategoris as $kategori)
                                    <option value="{{ $kategori->id }}">{{ $kategori->name }}</option>
                                @endforeach
                            </select>
                            @error('kategori_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="jumlah" class="form-label">Product Quantity</label>
                            <input type="number" class="form-control @error('jumlah') is-invalid @enderror"
                                id="jumlah" wire:model="jumlah">
                            @error('jumlah')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="harga" class="form-label">Product Price</label>
                            <input type="number" class="form-control @error('harga') is-invalid @enderror"
                                id="harga" wire:model="harga">
                            @error('harga')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
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
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        window.addEventListener('show-product-modal', event => {
            $('#productModal').modal('show');
        });

        window.addEventListener('hide-modal', event => {
            $('#productModal').modal('hide');

            if (editor) {
                editor.setData('');
            }
        });

        Livewire.on('editProduct', () => {
            if (editor) {
                editor.setData(@this.name);
            }
        });

    });

    Livewire.on('editProduct', () => {
        if (editor) {
            editor.setData(@this.name);
        }
    });
</script>
