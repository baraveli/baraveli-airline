<?php
namespace App;

use App\Modules\Fis;
use Illuminate\Support\Facades\Cache;

class FisService
{
    protected $fis;

    public function __construct()
    {
        $this->fis = new Fis;
    }
    public function depature()
    {
        return Cache::remember('flights.depatures', 300, function (){
            return $this->fis->getFlights('depatures');
        });
    }

    public function arrival()
    {
       return Cache::remember('flights.arrivals', 300, function (){
            return $this->fis->getFlights('arrivals');
        });
    
    }
}