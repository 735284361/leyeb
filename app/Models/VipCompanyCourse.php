<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VipCompanyCourse extends Model
{
    //
    protected $table = 'vip_company_course';

    public function company()
    {
        return $this->belongsTo(VipCompany::class,'admin_id','admin_id');
    }

    public function justice()
    {
        return $this->belongsTo(Justice::class,'justice_id','id');
    }

}
