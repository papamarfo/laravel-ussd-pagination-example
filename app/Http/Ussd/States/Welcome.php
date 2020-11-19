<?php

namespace App\Http\Ussd\States;

use Sparors\Ussd\State;
use App\Models\Service;

class Welcome extends State
{
    protected function beforeRendering(): void
    {
    	$collection = collect(Service::all());

    	$services = $collection->map(function ($item, $key) {
		    return $item->name;
		})->toArray();

        $this->menu->text('Welcome to Sparors')
	        ->lineBreak(2)
           	->listing($services);
    }

    protected function afterRendering(string $argument): void
    {
        //
    }
}
