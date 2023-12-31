<?php

namespace App\Service;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function list($request, $paginate)
    {
        $data = new User();
        $data = $data->where('is_delete', false);

        if ($request->keyword != "") {
            $data = $data->where('name', 'LIKE', '%' . $request->keyword . '%')
                ->orWhere('loginid', 'LIKE', '%' . $request->keyword . '%');
        }

        $count = $data->count();
        $data = $data->latest()->paginate($paginate);

        $i = (request()->input('page', 1) - 1) * $paginate;
        return [$data, $count, $i];
    }

    public function store($request)
    {
        try {
            User::create([
                'name' => $request->name,
                'loginid' => $request->loginid,
                'role' => $request->role,
                'device_limit' => $request->device_limit,
                'password' => Hash::make($request->password),
                'cby' => auth()->user()->name,
            ]);
            return ['success', 'Created Success'];
        } catch (\Throwable $th) {
            return ['error', 'something went wrong'];
        }
    }

    public function update($request, $id)
    {
        try {
            $user = User::find($id);
            $user->update([
                'name' => $request->name,
                'loginid' => $request->loginid,
                'role' => $request->role,
                'device_limit' => $request->device_limit,
                'uby' => auth()->user()->name,
            ]);
            return ['success', 'Updated Success'];
        } catch (\Throwable $th) {
            return ['error', 'something went wrong'];
        }
    }

    public function updatePassword($request, $id)
    {
        try {
            $user = User::find($id);
            $user->update([
                'password' => Hash::make($request->password),
                'uby' => auth()->user()->name,
            ]);
            return ['success', 'Updated Success'];
        } catch (\Throwable $th) {
            return ['error', 'something went wrong'];
        }
    }

    public function softDelete($request, $id)
    {
        try {
            $user = User::find($id);
            $user->update([
                'is_delete' => true,
                'uby' => auth()->user()->name,
            ]);
            return ['success', 'Deleted Success'];
        } catch (\Throwable $th) {
            return ['error', 'something went wrong'];
        }
    }
}
