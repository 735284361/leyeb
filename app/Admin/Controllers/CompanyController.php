<?php

namespace App\Admin\Controllers;

use App\Models\AdminUser;
use App\Models\VipCompany;
use Carbon\Carbon;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class CompanyController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '企业';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new VipCompany());

        $grid->column('id', __('编号'));
        $grid->column('company', __('公司'));
        $grid->column('contact_name', __('联系人'));
        $grid->column('contact_phone', __('联系电话'));
        $grid->column('contact_email', __('邮箱'));
        $grid->column('city', __('城市'));
        $grid->column('end_at', __('会员到期时间'));
        $grid->column('member_count', __('会员人数'));
        $grid->column('created_at', __('创建时间'));
        $grid->column('id', __('邀请码'))->qrcode();

        $grid->filter(function ($filter) {
            $filter->disableIdFilter();

            $filter->column(1/2,function ($filter) {
                $filter->like('company','公司');
                $filter->like('contact_name','联系人');
                $filter->like('contact_phone','电话');
            });

            $filter->column(1/2,function ($filter) {
                $filter->like('city','城市');
                $filter->like('member_count','会员人数');
                $filter->between('end_at','到期时间')->datetime();
            });
        });

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
        $show = new Show(VipCompany::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('company', __('Company'));
        $show->field('contact_name', __('Contact name'));
        $show->field('contact_phone', __('Contact phone'));
        $show->field('contact_email', __('Contact email'));
        $show->field('city', __('City'));
        $show->field('admin_id', __('Admin id'));
        $show->field('end_at', __('End at'));
        $show->field('member_count', __('Member count'));
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
        $form = new Form(new VipCompany());

        $form->text('company', __('公司名称'))->required();
        $form->text('contact_name', __('联系人'));
        $form->text('contact_phone', __('联系电话'));
        $form->text('contact_email', __('邮箱'));
        $form->text('city', __('城市'));
        $form->select('admin_id', __('关联账户'))->options(function ($id) {
            $user = AdminUser::find($id);

            if ($user) {
                return [$user->id => $user->username];
            }
        })->ajax(route('admin-user/users'))->required();
        $form->datetime('end_at', __('会员到期'))->default(Carbon::now()->modify('+1 year'))->required();
        $form->number('member_count', __('会员人数'))->required()->min(1);

        return $form;
    }
}
