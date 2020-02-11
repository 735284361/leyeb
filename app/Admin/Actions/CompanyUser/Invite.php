<?php

namespace App\Admin\Actions\CompanyUser;

use Encore\Admin\Actions\BatchAction;
use Illuminate\Database\Eloquent\Collection;

class Invite extends BatchAction
{
    public $name = '邀请成员';

    protected $selector = '.report-posts';

    public function handle(Collection $collection, Request $request)
    {
        foreach ($collection as $model) {
            //
        }

        dd($request);

        return $this->response()->success('举报已提交！')->refresh();
    }

    public function form()
    {
    }

    public function html()
    {
        return "<a class='report-posts btn btn-sm btn-info'><i class='fa fa-qrcode'></i> 邀请</a>";
    }

}
