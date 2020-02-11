<?php

namespace App\Admin\Controllers;

use App\Admin\Extensions\Tools\InviteUser;
use App\Models\AdminUser;
use App\Models\VipCompanyToken;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class CompanyTokenController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '邀请码';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new VipCompanyToken());

        if (Admin::user()->isRole('company')) {
            $adminId = Admin::user()->id;
            $grid->model()->where('admin_id', $adminId);

            $grid->column('user.username', __('用户昵称'));
            $grid->column('status', __('使用状态'))->using(VipCompanyToken::getStatus());
            $grid->column('token', __('邀请'))->copyable()->qrcode()->width(300);
            $grid->column('expire_at', __('过期时间'));
            $grid->column('created_at', __('创建时间'));
            $grid->column('updated_at', __('使用时间'));

            // 隐藏新增按钮
            $grid->disableCreateButton();
            $grid->disableActions();

            $grid->filter(function ($filter) {
                $filter->disableIdFilter();

                $filter->column(1/2,function ($filter) {
                    $filter->like('user.username','用户昵称');
                });

                $filter->column(1/2,function ($filter) {
                    $filter->equal('status','状态')->select(VipCompanyToken::getStatus());
                });
            });

            // 邀请按钮
            $grid->tools(function ($tools) {
                $tools->append(new InviteUser());
            });
        } else {
            $grid->column('id', __('编号'));
            $grid->column('admin_id', __('管理员'))->sortable();
            $grid->column('company.company', __('公司'))->sortable();
            $grid->column('uid', __('用户编号'))->sortable();
            $grid->column('user.username', __('用户昵称'));
            $grid->column('status', __('使用状态'))->using(VipCompanyToken::getStatus());
            $grid->column('token', __('邀请'))->copyable()->qrcode()->width(300);
            $grid->column('expire_at', __('过期时间'));
            $grid->column('created_at', __('创建时间'));
            $grid->column('updated_at', __('使用时间'));

            $grid->filter(function ($filter) {
                $filter->disableIdFilter();
                $filter->column(1/2,function ($filter) {
                    $filter->like('admin_id','管理员ID');
                    $filter->like('company.company','公司');
                    $filter->like('uid','用户编号');
                });

                $filter->column(1/2,function ($filter) {
                    $filter->like('user.username','用户昵称');
                    $filter->equal('status','状态')->select(VipCompanyToken::getStatus());
                    $filter->between('created_at','时间')->datetime();
                });
            });

            // 邀请按钮
            $grid->tools(function ($tools) {
                $tools->append(new InviteUser());
            });
        }

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(VipCompanyToken::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('admin_id', __('Admin id'));
        $show->field('uid', __('Uid'));
        $show->field('status', __('Status'));
        $show->field('token', __('Token'));
        $show->field('expire_at', __('Expire at'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new VipCompanyToken());


        $form->select('admin_id', __('关联公司'))->options(function ($id) {
            $user = AdminUser::find($id);

            if ($user) {
                return [$user->id => $user->username];
            }
        })->ajax(route('admin-user/users'))->required();
        $form->text('token', __('Token'));
        $form->datetime('expire_at', __('Expire at'))->default(date('Y-m-d H:i:s'));

        return $form;
    }
}
