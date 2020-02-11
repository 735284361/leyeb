<?php

namespace App\Admin\Controllers;

use App\Admin\Extensions\Tools\InviteUser;
use App\Admin\Extensions\Tools\UserGender;
use App\Models\AdminUser;
use App\Models\VipCompanyUser;
use Encore\Admin\Auth\Permission;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class CompanyUserController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '用户';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new VipCompanyUser());

        if (Admin::user()->isRole('company')) {
            $adminId = Admin::user()->id;
            $grid->model()->where('admin_id', $adminId);

            $grid->column('id', __('编号'))->sortable();
            $grid->column('company.company', __('公司'));
            $grid->column('user.username', __('用户昵称'));
            $grid->column('name', __('姓名'))->editable();
            $grid->column('created_at', __('创建时间'))->sortable();

            // 隐藏新增按钮
            $grid->disableCreateButton();

            $grid->actions(function ($actions) {
                // 隐藏编辑和查看按钮
                $actions->disableEdit();
                $actions->disableView();
            });

            $grid->filter(function ($filter) {
                $filter->disableIdFilter();

                $filter->column(1/2,function ($filter) {
                    $filter->like('name','姓名');
                });

                $filter->column(1/2,function ($filter) {
                    $filter->between('created_at','时间')->datetime();
                });
            });
        } else {
            $grid->column('id', __('编号'));
            $grid->column('admin_id', __('管理员编号'))->sortable();
            $grid->column('company.company', __('公司'))->sortable();
            $grid->column('uid', __('用户编号'))->sortable();
            $grid->column('user.username', __('用户昵称'));
            $grid->column('name', __('姓名'))->editable();
            $grid->column('created_at', __('创建时间'))->sortable();
            $grid->column('updated_at', __('修改时间'));

            $grid->filter(function ($filter) {
                $filter->disableIdFilter();
                $filter->column(1/2,function ($filter) {
                    $filter->like('admin_id','管理员ID');
                    $filter->like('company.company','公司');
                    $filter->like('uid','用户编号');
                });

                $filter->column(1/2,function ($filter) {
                    $filter->like('user.username','用户昵称');
                    $filter->like('name','姓名');
                    $filter->between('created_at','时间')->datetime();
                });
            });
        }

        $grid->expandFilter();

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
        $show = new Show(VipCompanyUser::findOrFail($id));

        Permission::check('*');

        $show->field('id', __('Id'));
        $show->field('admin_id', __('Admin id'));
        $show->field('uid', __('Uid'));
        $show->field('name', __('Name'));
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
        $form = new Form(new VipCompanyUser());

//        Permission::check('*');

        $form->select('admin_id', __('关联公司'))->options(function ($id) {
            $user = AdminUser::find($id);

            if ($user) {
                return [$user->id => $user->username];
            }
        })->ajax(route('admin-user/users'))->required();
        $form->select('uid', __('用户编号'))->options(function ($id) {
            $user = \App\User::find($id);

            if ($user) {
                return [$user->uid => $user->username];
            }
        })->ajax(route('user/users'));
        $form->text('name', __('姓名'));

        return $form;
    }

}
