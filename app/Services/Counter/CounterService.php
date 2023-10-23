<?php

namespace App\Services\Counter;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as RequestFacade;
use Illuminate\Http\Response;

class CounterService
{
    public function increment(Request $request, Response $response): void
    {
        if (! $request->isMethod('GET')) {
            return;
        }

        if ($response->getStatusCode() !== 200) {
            return;
        }

        $values = $this->extractValues($request);

        $routeName = $request->route()->getName();
        $this->incrementByRouteName($routeName, $values);

        $this->populateValues($values, $response);
    }

    private function incrementByRouteName(string $routeName, array &$values): void
    {
        $totalCount = $values['total'] ?? 1;
        $totalCount++;
        $values['total'] = $totalCount;

        $routeCount = $values[$routeName] ?? 1;
        $routeCount++;
        $values[$routeName] = $routeCount;
    }

    public function getValues(): array
    {
        $request = RequestFacade::instance();

        return $this->extractValues($request);
    }

    private function populateValues(array $values, Response $response): void
    {
        $data = json_encode($values);

        $response->cookie('count', $data, 43200);
    }

    private function extractValues(Request $request): array
    {
        $data = $request->cookie('count');
        if (! is_string($data)) {
            return [];
        }

        $values = json_decode($data, true);
        if (! is_array($values)) {
            return [];
        }

        return $values;
    }
}
