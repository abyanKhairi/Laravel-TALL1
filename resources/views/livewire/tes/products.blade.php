    <div class="row justify-content-center mt-3">
        <div class="col-md-12">

            @if (session()->has('message'))
                <div class="alert alert-success" role="alert">
                    {{ session('message') }}
                </div>
            @endif

            <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#productModal">
                Add Product
            </button>


            <div class="card">
                <div class="card-header">Product List</div>
                <div class="card-body">

                    <div class="flex gap-2">
                        <input type="text" class="border-solid	border-3 border-black	" wire:model.live="search"
                            placeholder="Cari Nama">
                        <select class="border-solid	border-3 border-black	" wire:model.live="pagi" id="">
                            <option value="5">5</option>
                            <option value="10">10</option>
                            <option value="20">20</option>
                            <option value="30">30</option>
                            <option value="40">40</option>
                            <option value="50">50</option>
                        </select>
                    </div>
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">S#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Description</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($products as $product)
                                <tr :product="$product" wire:key="{{ $product->id }}">
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $product->name }}</td>
                                    <td>{!! $product->description !!}</td>
                                    <td>
                                        <button wire:click="edit({{ $product->id }})" class="btn btn-primary btn-sm"
                                            data-bs-toggle="modal" data-bs-target="#productModal">
                                            <i class="bi bi-pencil-square"></i> Edit
                                        </button>
                                        <button class="btn btn-danger btn-sm"
                                            @click="$dispatch('alert', {get_id: {{ $product->id }}})"> <i
                                                class="bi bi-trash"></i> Delete
                                        </button>
                                        <a href="{{ route('product.edit', $product->id) }}">EDIT</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4">
                                        <span class="text-danger">
                                            <strong>No Product Found!</strong>
                                        </span>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div>
                        @if ($products->hasPages())
                            <nav role="navigation" aria-label="Pagination Navigation">
                                <span>
                                    @if ($products->onFirstPage())
                                        <span class="pr-3 text-zinc-400	">Previsous</span>
                                    @else
                                        <button class="pr-3" wire:click="previousPage" wire:loading.attr="disabled"
                                            rel="prev">Previous</button>
                                    @endif
                                </span>

                                <span class="px-3 text-white rounded-lg border-solid bg-slate-700">
                                    {{ $products->currentPage() }}
                                </span>

                                <span>
                                    @if ($products->onLastPage())
                                        <span class="pl-3 text-zinc-400	">Next</span>
                                    @else
                                        <button class="pl-3" wire:click="nextPage" wire:loading.attr="disabled"
                                            rel="next">Next</button>
                                    @endif
                                </span>
                            </nav>
                        @endif
                    </div>

                </div>
            </div>
        </div>
        @include('livewire.updateOrCreate')
        <x-delete-alert />
    </div>
