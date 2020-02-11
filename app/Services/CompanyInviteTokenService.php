<?php

namespace App\Services;

use App\Models\VipCompanyToken;
use Carbon\Carbon;

class CompanyInviteTokenService
{

    public function createToken($adminId, $count)
    {
        if ($count < 1) return false;

        $tokenObj = new VipCompanyToken();

        $dataArr = [];
        for ($i = 0; $i < $count; $i++) {
            $data['admin_id'] = $adminId;
            $data['token'] = $this->getToken();
            $data['expire_at'] = Carbon::now()->addDays(2);
            $data['created_at'] = Carbon::now();
            $dataArr[] = $data;
        }

        return $tokenObj->insert($dataArr);
    }

    private function getToken()
    {
        return uniqid();
    }


}
