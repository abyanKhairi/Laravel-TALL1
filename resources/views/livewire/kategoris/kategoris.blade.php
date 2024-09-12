<div>
    <div class="max-w-3xl mx-auto p-6 bg-white rounded-lg shadow-lg">
        <h2 class="text-2xl font-bold mb-6">Kategori</h2>
        <form wire:submit.prevent="store">
            @foreach ($inputs as $index => $input)
                <div class="mb-6">
                    <label for="kategori_{{ $index }}"
                        class="block text-sm font-medium text-gray-700">Kategori</label>
                    <input type="text" id="kategori_{{ $index }}"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm px-4 py-2"
                        wire:model="name.{{ $index }}">
                    @error('name.' . $index)
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>


                {{-- TRIX --}}
                <div class="mb-6" wire:ignore>
                    <label for="keterangan_{{ $index }}"
                        class="block text-sm font-medium text-gray-700">Keterangan</label>
                    <input id="keterangan_{{ $index }}" class="say" type="hidden"
                        wire:model.defer="keterangan.{{ $index }}">
                    <trix-editor input="keterangan_{{ $index }}"
                        data-action="trix-change@window.handleTrixChange"></trix-editor>

                    @error('keterangan.' . $index)
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>


                {{-- BATAS --}}



                {{-- CKeditor --}}
                {{-- <div class="mb-3" wire:ignore x-data x-init="ClassicEditor
                    .create($refs['editor{{ $index }}'])
                    .then(editor => {
                        editor.model.document.on('change:data', () => {
                            @this.set('keterangan.{{ $index }}', editor.getData());
                        });
                    })">
                    <label class="form-label">Product Description</label>
                    <textarea wire:model.defer="keterangan.{{ $index }}" x-ref="editor{{ $index }}" class="form-control"></textarea>
                    @error('keterangan.' . $index)
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div> --}}




                <button type="button" wire:click="remove({{ $index }})"
                    class="inline-flex items-center px-4 py-2 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-red-500 hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 mb-4">Remove</button>
            @endforeach
            <div class="mb-6">
                <button type="button" wire:click="add"
                    class="inline-flex items-center px-4 py-2 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-blue-500 hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">Add
                    More</button>
            </div>
            <div class="flex justify-end">
                <button type="button">Simpan</button>

                <button type="submit"
                    class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-green-500 hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">Save</button>
            </div>
        </form>
        @if (session()->has('message'))
            <div class="mt-6 p-4 bg-green-100 border border-green-300 text-green-700 rounded-md">
                {{ session('message') }}
            </div>
        @endif
    </div>
    <br>
    <div class="mx-12">
        <x-table>
            <x-table.thead>
                <tr>
                    <x-table.th>Kategori</x-table.th>
                    <x-table.th>Keterangan</x-table.th>
                    <x-table.th>Action</x-table.th>
                </tr>
            </x-table.thead>
            <x-table.tbody>
                @foreach ($kategoris as $kategori)
                    <tr>
                        <x-table.td>{{ $kategori->name }}</x-table.td>
                        <x-table.td>{!! $kategori->keterangan !!}</x-table.td>
                        <x-table.td>
                            <button wire:click="edit({{ $kategori->id }})" class="btn btn-primary btn-sm"
                                data-bs-toggle="modal" data-bs-target="#kategoriModal">
                                <i class="bi bi-pencil-square"></i> Edit
                            </button>
                            <button class="btn btn-danger btn-sm"
                                @click="$dispatch('alert', {get_id: {{ $kategori->id }}})"> <i class="bi bi-trash"></i>
                                Delete
                            </button>
                        </x-table.td>
                    </tr>
                @endforeach
            </x-table.tbody>
        </x-table>
    </div>
    <x-delete-alert />
    @include('livewire.kategoris.edit')
</div>


{{-- TRIX --}}
<script>
    document.addEventListener('trix-change', function(event) {
        let inputId = event.target.getAttribute('input');
        let inputElement = document.getElementById(inputId);
        @this.set(`keterangan.${inputId.split('_').pop()}`, inputElement.value);
    });
</script>
