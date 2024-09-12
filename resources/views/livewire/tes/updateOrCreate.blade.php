{{-- <!-- Modal -->
<div class="modal fade" wire:ignore.self id="productModal" tabindex="-1" aria-labelledby="productModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="productModalLabel">{{ $title }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form wire:submit.prevent="save">
                    <div class="mb-3">
                        <label for="name" class="form-label">Product Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                            wire:model="name">
                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div wire:ignore class="mb-3">
                        <label for="description" class="form-label">Product Description</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" id="description" wire:model="description">{{ $description }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3 text-end">
                        <button class="btn btn-success">Save</button>
                        @if ($isEdit)
                            <button type="button" wire:click="cancel" class="btn btn-danger"
                                data-bs-dismiss="modal">Cancel</button>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script>
        let editor;
        ClassicEditor
            .create(document.querySelector('#description'))
            .then(newEditor => {
                editor = newEditor;
                editor.model.document.on('change:data', () => {
                    @this.set('description', editor.getData());
                });
            })
            .catch(error => {
                console.error(error);
            });

        Livewire.on('editProduct', () => {
            if (editor) {
                editor.setData(@this.description);
            }
        });
    </script>
@endpush --}}
