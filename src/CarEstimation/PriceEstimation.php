<?php

namespace App\CarEstimation;

class PriceEstimation implements ICarEstimation
{
    // Prix d'un jour de location pour une voiture neuve
    private $initialDayPrice = 1500;

    public function estimate(int $carYear, int $nbKm, int $nbDays) :int
    {
        $price = 0;
        $priceForADay = ($this->initialDayPrice / $carYear)/ ($nbKm/10000);
        $price = $priceForADay * $nbDays;
        return intval($price);
    }
}
