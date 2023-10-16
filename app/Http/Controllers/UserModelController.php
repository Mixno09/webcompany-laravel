<?php

namespace App\Http\Controllers;

use App\Jobs\GetUserQueryJob;
use App\Models\City;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserModelController extends Controller
{
    public function showUsers(Request $request): View
    {
        $showForm = ($request->query->getInt('form') === 1);
        $orderBy = $request->query->getString('orderBy');
        $order = $request->query->getString('order');
        $cityId = $request->query->getInt('cityId');

        $users = GetUserQueryJob::dispatchSync($orderBy, $order, $cityId);

        /** @var \Illuminate\Database\Eloquent\Collection $users */
        $users = UserModel::query()->get();
        $cities = City::query()->get();

        return view('components.users.index', [
            'users' => $users,
            'cities' => $cities,
            'showForm' => $showForm,
        ]);
    }

    public function createUser(): View
    {
        return view('components.users.create-user');
    }

    public function storeUser()
    {

    }
}
