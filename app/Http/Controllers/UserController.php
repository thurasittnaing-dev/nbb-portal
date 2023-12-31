<?php

namespace App\Http\Controllers;

use App\Service\AjaxService;
use App\Service\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private $userService;
    private $ajaxService;

    public function __construct()
    {
        $this->userService = new UserService;
        $this->ajaxService = new AjaxService;
    }

    public function index(Request $request)
    {
        [$data, $count, $i] = $this->userService->list($request, 10);
        return view('backend.user.index', compact('data', 'count', 'i'));
    }

    public function store(Request $request)
    {
        [$status, $message] = $this->userService->store($request);
        return redirect()->back()->with($status, $message);
    }

    public function update(Request $request, $id)
    {
        [$status, $message] = $this->userService->update($request, $id);
        return redirect()->back()->with($status, $message);
    }

    public function updatePassword(Request $request, $id)
    {
        [$status, $message] = $this->userService->updatePassword($request, $id);
        return redirect()->back()->with($status, $message);
    }

    public function destroy(Request $request, $id)
    {
        [$status, $message] = $this->userService->softDelete($request, $id);
        return redirect()->back()->with($status, $message);
    }

    public function toggleStatus(Request $request)
    {
        $response = $this->ajaxService->userToggleStatus($request);
        return response()->json($response);
    }
}
