<?php

namespace App\Admin\Controllers\Api;

use App\Models\AdminUser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminUserController extends Controller
{
    //

    public function users(Request $request)
    {
        $q = $request->get('q');

        return AdminUser::where('username', 'like', "%$q%")->paginate(null, ['id', 'username as text']);
    }

}
