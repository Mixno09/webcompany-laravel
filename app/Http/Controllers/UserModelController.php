<?php

namespace App\Http\Controllers;

use App\Jobs\GetUserQueryJob;
use App\Models\City;
use App\Models\UserModel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;

class UserModelController extends Controller
{
    public function showUsers(Request $request): View
    {
        $showForm = ($request->query->getInt('form') === 1);
        $orderBy = $request->query->getString('orderBy');
        $order = $request->query->getString('order');
        $cityId = $request->query->getInt('cityId');

        $data = GetUserQueryJob::normalize($orderBy, $order, $cityId);
        $users = GetUserQueryJob::dispatchSync($data['orderBy'], $data['order'], $cityId);
        $cities = City::query()->get();

        return view('components.users.index', [
            'users' => $users,
            'cities' => $cities,
            'showForm' => $showForm,
            'data' => $data,
        ]);
    }

    public function createUser(): View
    {
        $cities = City::query()->get();

        return view('components.users.create-user', [
            'cities' => $cities,
        ]);
    }

    public function storeUser()
    {

    }

    public function deleteUser(int $id): RedirectResponse|Redirector
    {
        $count = UserModel::query()->where('id', $id)->delete();

        if ($count === 0) {
            abort(404);
        }

        return redirect()->route('show.users');
    }
}
