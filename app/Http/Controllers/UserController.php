<?php

namespace App\Http\Controllers;

use App\Http\Request\Auth\RegisterRequest;
use App\Http\Request\User\UserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Request;

class UserController extends Controller
{
    public function getAuthenticatedUser()
    {
        $user = Request::user();
        return $this->createResponse($user, 200, 'OK');
    }

    public function updateSelf(UserRequest $request)
    {
        $user = $request->user();

        if (isset($request['password'])) {
            $request['password'] = Hash::make($request['password']);
        }

        $user->update($request->all());

        return $this->createResponse([
            'id' => $user->id,
            'status' => 'updated'
        ], 200, 'OK');
    }

    public function index()
    {
        return $this->createResponse(User::all(), 200, 'OK');
    }

    public function show(User $user)
    {
        return $this->createResponse($user, 200, 'OK');
    }

    public function update(UserRequest $request, User $user)
    {
        $user->update($request->all());
        return $this->createResponse($user, 200, 'Updated');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return $this->createResponse(["status" => "Deleted"], 201, 'Deleted');
    }
}
