<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Modules\Fis;
use Illuminate\Support\Facades\Cache;

class ArrivalTable extends Component
{
    public $search = '';

    public function render()
    {
        $fis = new Fis;

        $arrivalscache = Cache::remember('flights.arrivals', 30, function () use ($fis) {
            return $fis->getFlights('arrivals');
        });

        $arrivals = collect($arrivalscache)->filter(function ($item) use ($arrivalscache) {

            if (empty($this->search)) {
                return $arrivalscache;
            }

            if (stripos($item["airlineName"] ?? "", $this->search) !== false) {
                return true;
            }
        });


        return view('livewire.arrival-table', [
            'arrivals' => $arrivals
        ]);
    }
}
