<?php

namespace App\Http\Controllers;

use App\Enums\UserRoleTypeEnum;
use App\Models\User;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Illuminate\Http\Request;

class UserController extends CrudController
{
    public function searchFinancer(Request $request)
    {
        $search = $request->input('q'); // The search query

        $results = User::query()
            ->where('role', UserRoleTypeEnum::FINANCER->value)
            ->where('name', 'like', '%' . $search . '%')
            ->orWhere('email', 'like', '%' . $search . '%')
            ->take(10)
            ->get(['id', 'name as text']);

        return response()->json($results);
    }
}
