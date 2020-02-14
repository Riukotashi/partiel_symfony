<?php

namespace App\CarEstimation;

interface ICarEstimation
{
    public function estimate(int $carYear, int $nbKm, int $nbDays): int;
}
