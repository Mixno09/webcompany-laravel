<?php

namespace App\View\Components;

use App\Services\Counter\CounterService;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Counter extends Component
{
    private CounterService $counterService;

    public function __construct(CounterService $counterService)
    {
        $this->counterService = $counterService;
    }

    public function render(): View
    {
        $values = $this->counterService->getValues();

        return view('components.counter', [
            'values' => $values,
        ]);
    }
}
