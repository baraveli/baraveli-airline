<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Modules\Fis;
use Illuminate\Support\Facades\Cache;

class DepatureTable extends Component
{
    public $search = '';

    public function render()
    {
        $fis = new Fis;

        $depaturescache = Cache::remember('flights.depatures', 30, function () use ($fis) {
            return $fis->getFlights('depatures');
        });

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
