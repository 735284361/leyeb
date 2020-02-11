<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Models\VipCompany;
use App\Models\VipCompanyUser;
use Encore\Admin\Controllers\Dashboard;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;

class HomeController extends Controller
{
    public function index(Content $content)
    {

        return $content
            ->title('首页')
            ->description('主页面板...')
            ->row(view('admin.dashboard.title'))
            ->row(function (Row $row) {

                $row->column(4, function (Column $column) {
                    $info = VipCompany::where('admin_id',Admin::user()->id)->first();
                    $view = view('admin.dashboard.info', compact('info'));
                    $column->append($view);
                });

                $row->column(4, function (Column $column) {
                    $users = VipCompanyUser::where('admin_id',Admin::user()->id)->orderBy('created_at','desc')->limit(10)->get();
                    $view = view('admin.dashboard.user', compact('users'));
                    $column->append($view);
                });

                $row->column(4, function (Column $column) {
                    $users = VipCompanyUser::where('admin_id',Admin::user()->id)->orderBy('created_at','desc')->limit(10)->get();
                    $view = view('admin.dashboard.user', compact('users'));
                    $column->append($view);
                });
            });
    }
}
