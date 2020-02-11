<?php

namespace App\Admin\Controllers\Api;

use App\Services\CompanyInviteTokenService;
use Encore\Admin\Facades\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CompanyTokenController extends Controller
{
    //

    protected $tokenService;

    public function __construct()
    {
        $this->tokenService = new CompanyInviteTokenService();
    }

    public function inviteToken(Request $request)
    {
        $this->validate($request,['number','integer|min:1']);

        if ($request->admin_id) {
            $adminId = $request->admin_id;
        } else {
            $adminId = Admin::user()->id;
        }

        $code = $this->tokenService->createToken($adminId, $request->number);

        return ['code' => $code];
    }
}
