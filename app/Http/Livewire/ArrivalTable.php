<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\FisService;

class ArrivalTable extends Component
{
    public $search = '';

    public function render()
    {
        $arrivalscache = (new FisService)->arrival();

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
