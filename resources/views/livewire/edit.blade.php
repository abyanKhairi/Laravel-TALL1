<div class="max-w-3xl mx-auto p-6 bg-white rounded-lg shadow-lg">
    <h2 class="text-2xl font-bold mb-6">Add New Product</h2>
    <form wire:submit.prevent="update" class="space-y-6">
        <!-- CKEditor (Product Name) -->
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
            <label for="name" class="block text-sm font-medium text-gray-700">Product Name</label>
            <textarea id="name" x-model="content"
                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                wire:model.defer="name"></textarea>
            @error('name')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Category -->
        <div>
            <label for="kategori" class="block text-sm font-medium text-gray-700">Category</label>
            <select id="kategori" wire:model="kategori_id"
                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                <option value="">Select Category</option>
                @foreach ($kategoris as $kategori)
                    <option value="{{ $kategori->id }}">{{ $kategori->name }}</option>
                @endforeach
            </select>
            @error('kategori_id')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Product Quantity -->
        <div>
            <label for="jumlah" class="block text-sm font-medium text-gray-700">Product Quantity</label>
            <input type="number" id="jumlah" wire:model="jumlah"
                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            @error('jumlah')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Product Price -->
        <div>
            <label for="harga" class="block text-sm font-medium text-gray-700">Product Price</label>
            <input type="number" id="harga" wire:model="harga"
                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            @error('harga')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Submit and Cancel Buttons -->
        <div class="flex justify-end space-x-3">
            <a href="{{ route('products') }}" wire:navigate
                class="px-4 py-2 bg-gray-400 hover:bg-gray-500 text-white font-medium rounded-md">
                Cancel
            </a>
            <button type="submit" class="px-6 py-2 bg-green-500 hover:bg-green-600 text-white font-medium rounded-md">
                Save
            </button>
        </div>
    </form>
</div>
