<?php

namespace App\Admin\Controllers\Api;

use App\Models\Justice;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class JusticeController extends Controller
{
    //

    public function lists(Request $request)
    {
        $q = $request->get('q');

        return Justice::where('justice_name', 'like', "%$q%")->paginate(null, ['id', 'justice_name as text']);
    }
}
