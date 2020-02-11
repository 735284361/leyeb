<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VipCompanyUser extends Model
{
    //
    protected $table = 'vip_company_user';

    public function company()
    {
        return $this->belongsTo(VipCompany::class,'admin_id','admin_id');
    }

    public function user()
    {
        return $this->belongsTo(\App\User::class,'uid','uid');
    }

}
