<?php

namespace App\Jobs;

use Illuminate\Foundation\Bus\Dispatchable;

class GetUserQueryJob
{
    use Dispatchable;

    public function __construct(
        public string $orderBy,
        public string $order,
        public int $cityId,
    ) {}

    public function handle(): void
    {
        //
    }
}
