<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VipCompanyToken extends Model
{
    //

    protected $table = 'vip_company_token';

    protected $guarded = [];

    const STATUS_UNUSED = 0;
    const STATUS_USED = 1;

    public function company()
    {
        return $this->belongsTo(VipCompany::class,'admin_id','admin_id');
    }

    public function user()
    {
        return $this->belongsTo(\App\User::class,'uid','uid');
    }


    public function getTokenAttribute($value)
    {
        $url = 'http://localhost:8888/leye/wechat.php?c=VipCompany&a=checkToken&token=';
        return $url.$value;
    }

    public static function getStatus($ind = null)
    {
        $arr = [
            self::STATUS_UNUSED => '未使用',
            self::STATUS_USED => '已使用',
        ];

        if ($ind !== null) {
            return array_key_exists($ind,$arr) ? $arr[$ind] : $arr[self::STATUS_UNUSED];
        }
        return $arr;
    }
}
