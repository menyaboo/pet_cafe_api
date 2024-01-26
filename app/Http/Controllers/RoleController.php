<?php

namespace App\Http\Controllers;

use App\Http\Request\Role\RoleRequest;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        return $this->createResponse(Role::all(), 200, 'OK');
    }

    public function store(RoleRequest $request)
    {
        $role = Role::create($request->all());
        return $this->createResponse($role, 201, 'Created');
    }

    public function show(Role $role)
    {
        return $this->createResponse($role, 200, 'OK');
    }

    public function update(Request $request, Role $role)
    {
        $role->update($request->all());
        return $this->createResponse($role, 200, 'Updated');
    }

    public function destroy(Role $role)
    {
        $role->delete();
        return $this->createResponse(["status" => "Deleted"], 201, 'Deleted');
    }
}
