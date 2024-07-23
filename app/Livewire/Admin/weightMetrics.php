<?php

namespace App\Livewire\Admin;

use App\Models\WeightMetric;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Illuminate\Validation\Rule;


class weightMetrics extends Component
{
    public $sortField, $sortAsc = true;
    public $search;
    public $addMetricsModal = false;
    public $confirmingDeletionModal = false;

    public $name;
    public $abbreviation;
    

    public $metricDeleteId;
    public $metricEditId;


    public function showModal()
    {
        $this->name = '';
        $this->metricEditId = null;
        $this->addMetricsModal = true;
    }

    public function createWeightMertic()
    {
        $rules = [
            'name' => ['required', 'max:30', 'string'],
            'abbreviation' => ['required', 'max:30'],

        ];
    
        if ($this->metricEditId) {
            $rules['name'][] = Rule::unique('weight_metrics')->ignore($this->metricEditId);
        } else {
            $rules['name'][] = 'unique:weight_metrics';
        }
    
        $validatedFields = $this->validate($rules);
    

        if($this->metricEditId){
           WeightMetric::findOrFail($this->metricEditId)->update($validatedFields);
        }else{
            WeightMetric::create($validatedFields);
        }
        $this->reset('addMetricsModal');
        session()->flash('success', 'Action Performed successfully');
    }

    public function editMetic($id){
        $metric = WeightMetric::find($id);
        $this->metricEditId = $metric->id;
        $this->name = $metric->name;
        $this->abbreviation = $metric->abbreviation;

        $this->addMetricsModal = true;


    }

    public function deleteMetric($id)
    {
        $this->metricDeleteId = $id;
        $this->confirmingDeletionModal = true;
    }

    public function delete()
    {
        $id = $this->metricDeleteId;
        $currency = WeightMetric::find($id);
        $currency->delete();

        $this->reset('metricDeleteId', 'confirmingDeletionModal');
        session()->flash('success', 'Metric deleted successfully.');
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
        $metrics = WeightMetric::paginate(20);
        return view('livewire.admin.weight-metrics', ['metrics' => $metrics]);
    }
}
