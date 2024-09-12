<?php

namespace App\Livewire;

use App\Models\Kategori;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Validate;
use Livewire\Component;
use App\Models\Product;
use Livewire\Attributes\On;

class edit extends Component
{
    #[Locked]
    public $product_id;
    #[Validate('required')]
    public $name = '';
    #[Validate('required')]
    public $jumlah;
    #[Validate('required')]
    public $harga;
    #[Validate('required')]
    public $kategori_id;


    public function mount($id)
    {
        $product = Product::find($id);

        if ($product) {
            $this->product_id = $product->id;
            $this->name = $product->name;
            $this->jumlah = $product->jumlah;
            $this->harga = $product->harga;
            $this->kategori_id = $product->kategori_id;
        }
    }


    public function update()
    {
        $this->validate();

        if ($this->product_id) {
            $post = Product::find($this->product_id);
            if ($post) {
                $post->update([
                    'name' => $this->name,
                    'jumlah' => $this->jumlah,
                    'harga' => $this->harga,
                    'kategori_id' => $this->kategori_id,
                ]);
            }
        }
        $this->dispatch('sweet', icon: 'success', title: $this->product_id ? 'Product is updated.' : 'Product is added.', text: $this->product_id ? 'Product is updated.' : 'Product is added.');

        return $this->redirect('/products');


    }



    public function render()
    {
        $kategoris = Kategori::all();
        return view('livewire.edit', [
            'kategoris' => $kategoris,
        ])->layout('components.layouts.app');
    }

}
