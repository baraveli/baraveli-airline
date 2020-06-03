<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\FisService;

class DepatureTable extends Component
{
    public $search = '';

    public function render()
    {

        $depaturescache = (new FisService)->depature();

        $depatures = collect($depaturescache)->filter(function ($item) use ($depaturescache) {

            if (empty($this->search)) {
                return $depaturescache;
            }

            if (stripos($item["airlineName"] ?? "", $this->search) !== false) {
                return true;
            }
        });

        return view('livewire.depature-table', [
            'depatures' => $depatures
        ]);
    }
}
