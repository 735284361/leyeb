<?php

namespace App\Admin\Controllers;

use App\Models\AdminUser;
use App\Models\Justice;
use App\Models\VipCompanyCourse;
use Encore\Admin\Auth\Permission;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class CompanyCourseController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '课程';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new VipCompanyCourse());

        if (Admin::user()->isRole('company')) {
            $adminId = Admin::user()->id;
            $grid->model()->where('admin_id', $adminId);

            $grid->column('id', __('编号'));
            $grid->column('justice.justice_name', __('课程'));
            $grid->column('company.company', __('公司'));
            $grid->column('created_at', __('创建时间'));

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
                    $filter->like('justice.justice_name','课程');
                });
            });

        } else {

            $grid->column('id', __('编号'));
            $grid->column('justice_id', __('课程ID'));
            $grid->column('justice.justice_name', __('课程'));
            $grid->column('admin_id', __('管理员ID'));
            $grid->column('company.company', __('公司'));
            $grid->column('created_at', __('创建时间'));
            $grid->column('updated_at', __('更新时间'));

            $grid->filter(function ($filter) {
                $filter->disableIdFilter();
                $filter->column(1/2,function ($filter) {
                    $filter->like('admin_id','管理员ID');
                    $filter->like('company.company','公司');
                });

                $filter->column(1/2,function ($filter) {
                    $filter->like('justice.justice_name','课程名称');
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
        $show = new Show(VipCompanyCourse::findOrFail($id));

        Permission::check('*');

        $show->field('id', __('Id'));
        $show->field('justice_id', __('Justice id'));
        $show->field('admin_id', __('Admin id'));
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
        $form = new Form(new VipCompanyCourse());

        Permission::check('*');

        $form->select('admin_id', __('关联公司'))->options(function ($id) {
            $user = AdminUser::find($id);

            if ($user) {
                return [$user->id => $user->username];
            }
        })->ajax(route('admin-user/users'))->required();
        $form->select('justice_id', __('课程'))->options(function ($id) {
            $justice = Justice::find($id);

            if ($justice) {
                return [$justice->id => $justice->justice_name];
            }
        })->ajax(route('admin.justice.list'))->required();

        return $form;
    }
}
