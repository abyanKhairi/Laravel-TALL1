<?php
namespace App\Livewire\Kategoris;

use Livewire\Attributes\Validate;
use Livewire\Component;
use App\Models\Kategori;
use Livewire\Attributes\Locked;

class Kategoris extends Component
{


    public $Ekategori_id;

    public $Ename;

    public $Eketerangan;

    public $name = [];
    public $keterangan = [];
    public $inputs = [];
    public $i = 1;

    public function updateKeterangan($inputId, $value)
    {
        $index = str_replace('keterangan_', '', $inputId);
        $this->keterangan[$index] = $value;
    }


    public function mount()
    {
        $this->inputs = [1];
    }

    public function add()
    {
        $this->i++;
        $this->inputs[] = $this->i;
    }

    public function remove($index)
    {
        unset($this->inputs[$index]);
        $this->inputs = array_values($this->inputs); // Reindex the array
    }

    private function resetInputFields()
    {
        $this->name = [];
        $this->keterangan = [];
    }

    public function store()
    {

        $validatedData = $this->validate([
            'name.*' => 'required|string|max:255',
            'keterangan.*' => 'required|string|max:255',
        ], [
            'name.*.required' => 'Name field is required',
            'keterangan.*.required' => 'Keterangan field is required',
        ]);


        foreach ($this->name as $key => $value) {
            Kategori::create([
                'name' => $value,
                'keterangan' => $this->keterangan[$key],
            ]);
        }

        $this->inputs = [];
        $this->resetInputFields();

        session()->flash('message', 'Kategori Added Successfully.');
        $this->dispatch('sweet', icon: 'success', title: 'Kategori Added.', text: 'Kategori is Added.');

    }


    public function update()
    {
        $this->validate([
            'Ename' => 'required|string|max:255',
            'Eketerangan' => 'required|string|max:255',
        ]);

        if ($this->Ekategori_id) {
            $post = Kategori::find($this->Ekategori_id);
            if ($post) {
                $post->update([
                    'name' => $this->Ename,
                    'keterangan' => $this->Eketerangan,
                ]);
            }
        }

        // dispatch event instead of dispatch
        $this->dispatch('editProduct');
        $this->dispatch('close');
        $this->dispatch('show-product-modal');
        $this->dispatch('sweet', icon: 'success', title: 'Product is updated.', text: 'Product is updated.');

    }

    public function edit($id)
    {
        $kategori = Kategori::findOrFail($id);

        $this->Ekategori_id = $id;
        $this->Ename = $kategori->name;
        $this->Eketerangan = $kategori->keterangan;

    }


    public function cancel()
    {
        $this->reset('name', 'keterangan');
        $this->dispatch('hide-modal');
    }

    public function delete($id)
    {
        Kategori::find($id)->delete();
    }

    public function render()
    {
        $kategoris = Kategori::all();
        return view('livewire.kategoris.kategoris', ['kategoris' => $kategoris]);
    }
}