<?php

namespace App\Livewire;

use Livewire\Attributes\Locked;
use Livewire\Attributes\Validate;
use Livewire\Component;
use App\Models\Product;
use Livewire\Attributes\Url;
use Livewire\WithPagination;

class Productsss extends Component
{


    use WithPagination;

    #[Locked]
    public $product_id;

    #[Validate('required')]
    public $name = '';

    #[Validate('required')]
    public $description = '';

    public $isEdit = false;

    public $title = 'Add New Product';

    public $search;

    public $pagi = 5;


    public function resetFields()
    {
        $this->title = 'Add New Product';
        $this->reset('name', 'description', 'product_id');
        $this->isEdit = false;
    }

    public function save()
    {
        $this->validate();

        Product::updateOrCreate(['id' => $this->product_id], [
            'name' => $this->name,
            'description' => $this->description,
        ]);

        $this->dispatch('sweet', icon: 'success', title: $this->product_id ? 'Product is updated.' : 'Product is added.', text: $this->product_id ? 'Product is updated.' : 'Product is added.');

        session()->flash('message', $this->product_id ? 'Product is updated.' : 'Product is added.');
        // $this->resetFields();
        // return $this->redirect('/products');
    }

    public function edit($id)
    {
        $this->title = 'Edit Product';
        $product = Product::findOrFail($id);

        $this->product_id = $id;
        $this->name = $product->name;
        $this->description = $product->description;
        $this->isEdit = true;
    }

    public function cancel()
    {
        $this->resetFields();
    }


    public function delete($id)
    {
        Product::find($id)->delete();

        session()->flash('message', 'Product Deleted Successfully.');
    }



    public function render()
    {

        if (!$this->search) {
            $products = Product::latest()->paginate($this->pagi);
        } else {
            $products = Product::where('name', 'like', '%' . $this->search . '%')->paginate($this->pagi);

        }

        return view('livewire.products', [
            'products' => $products,
        ]);
    }

    public function updateCari()
    {
        $this->resetPage();
    }

}
