<?php
namespace App\Contracts\Interfaces;

use App\Contracts\Interfaces\Eloquent\DeleteInterface;
use App\Contracts\Interfaces\Eloquent\GetByServiceIdInterface;
use App\Contracts\Interfaces\Eloquent\GetByTypeInterface;
use App\Contracts\Interfaces\Eloquent\GetCountInterface;
use App\Contracts\Interfaces\Eloquent\GetInterface;
use App\Contracts\Interfaces\Eloquent\ShowInterface;
use App\Contracts\Interfaces\Eloquent\StoreInterface;
use App\Contracts\Interfaces\Eloquent\UpdateInterface;

interface ProductInterface extends GetInterface , StoreInterface ,UpdateInterface , DeleteInterface , ShowInterface, GetByTypeInterface , GetCountInterface
{

}

