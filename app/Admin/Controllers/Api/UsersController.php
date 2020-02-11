<?php

namespace App\Admin\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UsersController extends Controller
{
    //

    public function users(Request $request)
    {
        $q = $request->get('q');

        return \App\User::where('username', 'like', "%$q%")->paginate(null, ['uid as id', 'username as text']);
    }
}
