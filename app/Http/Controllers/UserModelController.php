<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Jobs\GetUserQueryJob;
use App\Models\City;
use App\Models\UserModel;
use Illuminate\Http\RedirectResponse;
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

    public function storeUser(StoreUserRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        /** @var UserModel $user */
        $user = UserModel::create([
            'name' => $validated['name'],
            'surName' => $validated['surName'],
            'cityId' => $validated['cityId'],
        ]);

        if (array_key_exists('media', $validated)) {
            $media = $validated['media'];
            $user->addMedia($media)->toMediaCollection('avatar');
        }


        return redirect()->route('show.users');
    }

    public function editUser(int $id): View
    {
        $user = UserModel::query()->with('city')->findOrFail($id);
        $cities = City::query()->get();

        return view('components.users.edit-user', [
            'user' => $user,
            'cities' => $cities,
        ]);
    }

    public function storeEditUser(StoreUserRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $id = $request->request->get('id');

        /** @var UserModel $user */
        $user = UserModel::query()->with('media')->findOrFail($id);
        $user->update([
            'name' => $validated['name'],
            'surName' => $validated['surName'],
            'cityId' => $validated['cityId'],
        ]);
        $user = $user->refresh();

        if (array_key_exists('media', $validated)) {
            $media = $validated['media'];
            $user->addMedia($media)->toMediaCollection('avatar');
        }

        return redirect()->route('edit.user', $id);
    }

    public function deleteUser(int $id): RedirectResponse
    {
        /** @var UserModel $user */
        $user = UserModel::query()->findOrFail($id);
        $user->delete();

        return redirect()->route('show.users');
    }

    public function search(Request $request): View
    {
        $q = $request->query('q');
        if (! is_string($q)) {
            return view('components.users.search');
        }

        $users = UserModel::query()
            ->with('city')
            ->where('name', 'LIKE',  '%'.$q.'%')
            ->orWhere('surName', 'LIKE', '%'.$q.'%')
            ->get()
        ;

        return view('components.users.search', [
            'users' => $users,
        ]);
    }
}
