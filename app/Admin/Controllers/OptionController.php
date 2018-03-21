<?php

namespace App\Admin\Controllers;

use App\Option;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use http\Env\Request;
use Illuminate\Support\Facades\Redirect;

class OptionController extends Controller
{
    use ModelForm;

    /**
     * Index interface.
     *
     * @return Content
     */
    public function index()
    {
        return Admin::content(function (Content $content) {

            $content->header('Опции');
            $content->body($this->grid());
        });
    }

    /**
     * Edit interface.
     *
     * @param $id
     * @return Content
     */
    public function edit($id)
    {
        return Admin::content(function (Content $content) use ($id) {

            $content->header('header');
            $content->description('description');

            $content->body($this->form()->edit($id));
        });
    }


    /**
     * Create interface.
     *
     * @return Content
     */
    public function create()
    {
        return Admin::content(function (Content $content) {

            $content->header('header');
            $content->description('description');

            $content->body($this->form());
        });
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Admin::grid(Option::class, function (Grid $grid) {

            //$grid->model()->where('type','options');
            $grid->title('Имя');
            $grid->value('значение')->editable();;
            $grid->updated_at('изменено');
            $grid->disableActions();
            $grid->disableCreation();
            $grid->disablePagination();
            $grid->disableFilter();
            $grid->disableExport();
            $grid->disableRowSelector();
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(Option::class, function (Form $form) {

            $form->display('id', 'ID');
            $form->textarea('value');
            $form->display('created_at', 'Created At');
            $form->display('updated_at', 'Updated At');
        });
    }

    public function form_re($id)
    {
        return Admin::form(Option::class, function (Form $form) use ($id) {

            $form->textarea('value','Приветствие');
            $form->setAction('/admin/re/collections/welcome/'.$id);
            $form->disableReset();
            $form->setView('vendor.admin.form_re');
        });
    }

    public function update_re($id)
    {
        $this->form_re($id)->update($id);
        return Redirect()->back();
    }
}
