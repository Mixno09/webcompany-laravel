<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCityRequest;
use App\Http\Requests\TestRequest;
use App\Jobs\DeleteCityJob;
use App\Jobs\GetCityQueryJob;
use App\Models\City;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

class CityController extends Controller
{
    public function showCities(Request $request): View
    {
        $showForm = ($request->query->getInt('form') === 1);
        $orderBy = $request->query->getString('orderBy', 'idx');
        $order = $request->query->getString('order', 'ASC');

        $data = GetCityQueryJob::normalize($orderBy, $order);

        /** @var \Illuminate\Database\Eloquent\Collection $cities */
        $cities = GetCityQueryJob::dispatchSync($orderBy, $order);

        return view('components.cities.index', [
            'cities' => $cities,
            'showForm' => $showForm,
            'data' => $data,
        ]);
    }

    public function createCity(): View
    {
        return view('components.cities.create-city');
    }

    public function storeCity(StoreCityRequest $storeCityRequest): RedirectResponse|Redirector
    {
        $data = $storeCityRequest->validated();

        City::create($data);

        return redirect('/');
    }

    public function editCity(string $id): View
    {
        $city = City::query()->where(['id' => $id])->firstOrFail();

        return view('components.cities.edit-city', ['city' => $city]);
    }

    public function storeEditCity(StoreCityRequest $storeCityRequest): RedirectResponse|Redirector
    {
        $id = $storeCityRequest->input('id');
        $data = $storeCityRequest->validated();

        City::query()->where(['id' => $id])->firstOrFail()->update($data);

        return redirect()->route('edit.city', ['id' => $id]);
    }

    public function deleteCity(string $id): RedirectResponse|Redirector
    {
        City::query()->where(['id' => $id])->firstOrFail()->delete();

        return redirect('/');
    }
}
