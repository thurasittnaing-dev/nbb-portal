<?php

namespace App\Service;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AjaxService
{

    public function userToggleStatus($request)
    {
        try {
            $user = User::find($request->id);
            $user->update([
                'status' => $request->status,
            ]);

            return ['status' => 1, 'message' => 'success'];
        } catch (\Throwable $th) {
            return ['status' => 0, 'message' => 'something went wrong!'];
        }
    }
}
