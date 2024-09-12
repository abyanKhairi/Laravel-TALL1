<?php

namespace App\Livewire\Products;

use App\Models\Kategori;
use Livewire\Component;
use App\Models\Product;
use Livewire\WithPagination;

class Products extends Component
{
    use WithPagination;

    public $product_id;
    public $name = '';
    public $jumlah;
    public $harga;
    public $kategori_id;

    public $isEdit = false;
    public $title = 'Add New Product';
    public $search;
    public $pagi = 5;

    public function mount()
    {
        $this->resetFields();
    }

    public function resetFields()
    {
        $this->title = 'Add New Product';
        $this->reset('name', 'jumlah', 'harga', 'kategori_id', 'product_id');
        $this->name = '';
        $this->jumlah = '';
        $this->harga = '';
        $this->kategori_id = '';
        $this->product_id = '';
        $this->isEdit = false;
    }

    public function save()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'jumlah' => 'required|integer',
            'harga' => 'required|numeric',
            'kategori_id' => 'required|exists:kategoris,id',
        ]);

        Product::updateOrCreate(['id' => $this->product_id], [
            'name' => $this->name,
            'jumlah' => $this->jumlah,
            'harga' => $this->harga,
            'kategori_id' => $this->kategori_id,
        ]);

        session()->flash('message', $this->product_id ? 'Product updated successfully.' : 'Product added successfully.');
        $this->dispatch('hide-modal');
        $this->dispatch('close');
        $this->dispatch('sweet', icon: 'success', title: $this->product_id ? 'Product is updated.' : 'Product is added.', text: $this->product_id ? 'Product is updated.' : 'Product is added.');
        $this->resetFields();
    }

    public function edit($id)
    {
        $this->title = 'Edit Product';
        $product = Product::findOrFail($id);

        $this->product_id = $id;
        $this->name = $product->name;
        $this->jumlah = $product->jumlah;
        $this->harga = $product->harga;
        $this->kategori_id = $product->kategori_id;
        $this->isEdit = true;

        $this->dispatch('editProduct');
        $this->dispatch('show-product-modal');

    }

    public function cancel()
    {
        $this->resetFields();
        $this->dispatch('hide-modal');
    }

    public function delete($id)
    {
        Product::find($id)->delete();

        session()->flash('message', 'Product deleted successfully.');
    }



    public function render()
    {
        $kategoris = Kategori::all();

        $productsQuery = Product::query();

        if ($this->search) {
            $productsQuery->where('name', 'like', '%' . $this->search . '%');
        }

        $products = $productsQuery->latest()->paginate($this->pagi);

        return view('livewire.products.product', [
            'products' => $products,
            'kategoris' => $kategoris,
        ]);
    }



    public function updatedSearch()
    {
        $this->resetPage();
    }

}
