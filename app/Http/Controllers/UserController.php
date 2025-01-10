<?php

namespace App\Http\Controllers;

use App\Enums\UserRoleTypeEnum;
use App\Models\User;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function showImage($filename)
    {
        $user = Auth::guard('backpack')->user();

        if (!$user || !$user->isAdmin()) {
            abort(403, 'Unauthorized access');
        }

        $path = storage_path('app/public/uploads/payments/' . $filename);

        if (!file_exists($path)) {
            abort(404);
        }

        return response()->file($path);
    }
}
