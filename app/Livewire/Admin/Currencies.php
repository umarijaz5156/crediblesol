<?php

namespace App\Livewire\Admin;

use App\Models\Currency;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Currencies extends Component
{
    public $sortField, $sortAsc = true;
    public $search;
    public $addCurrencyModal = false;
    public $confirmingDeletionModal = false;

    public $code, $name, $symbol;

    public $currencyDeleteId;

    public function showModal()
    {
        $this->addCurrencyModal = true;
    }

    public function createCurrency()
    {
        $validatedFields = $this->validate([
            'code' => ['required', 'max:15', 'string'],
            'name' => ['required', 'max:20', 'string'],
            'symbol' => ['required', 'max:5', 'string']
        ]);

        Currency::create($validatedFields);
        $this->reset('addCurrencyModal');
        session()->flash('success', 'Currency cerated successfully');
    }

    public function deleteCurrency($id)
    {
        $this->currencyDeleteId = $id;
        $this->confirmingDeletionModal = true;
    }

    public function delete()
    {
        $id = $this->currencyDeleteId;
        $currency = Currency::find($id);
        $currency->delete();

        $this->reset('currencyDeleteId', 'confirmingDeletionModal');
        session()->flash('success', 'Currency deleted successfully.');
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortAsc = !$this->sortAsc;
        } else {
            $this->sortAsc = true;
        }

        $this->sortField = $field;
    }

    #[Layout('layouts.app')]
    public function render()
    {
        $currencies = Currency::paginate(20);
        return view('livewire.admin.currencies', ['currencies' => $currencies]);
    }
}
