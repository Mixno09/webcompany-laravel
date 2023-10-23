<?php

namespace App\Http\Middleware;

use App\Services\Counter\CounterService;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response as LaravelResponse;
use Symfony\Component\HttpFoundation\Response;

class Counter
{
    private CounterService $counterService;

    public function __construct(CounterService $counterService)
    {
        $this->counterService = $counterService;
    }

    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        if ($response instanceof LaravelResponse) {
            $this->counterService->increment($request, $response);
        }

        return $response;
    }
}
