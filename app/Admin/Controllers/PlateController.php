<?php

namespace App\Admin\Controllers;

use App\Plate;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class PlateController extends Controller
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

            $content->header('header');
            $content->description('description');

            $content->body($this->grid());
        });
    }

    /**
     * Edit interface.
     *
     * @param $id
     * @return Content
     */
    public function edit(\Illuminate\Http\Request $request)
    {
        $id = $request->edit;
        return Admin::content(function (Content $content) use ($id) {

            $content->header('header');
            $content->description('description');

            $content->body($this->form()->edit($id));
        });
    }

    public function update(\Illuminate\Http\Request $request)
    {
        $id = $request->edit;
        return $this->form()->update($id);
    }

    /**
     * Create interface.
     *
     * @return Content
     */
    public function create(\Illuminate\Http\Request $request)
    {
        return Admin::content(function (Content $content) use ($request) {

            $content->header('Добавить в набор');

            $content->body($this->form_create($request));
        });
    }

    public function destroy(\Illuminate\Http\Request $request)
    {
        $id = $request->edit;
        if ($this->form()->destroy($id)) {
            return response()->json([
                'status'  => true,
                'message' => trans('admin::lang.delete_succeeded'),
            ]);
        } else {
            return response()->json([
                'status'  => false,
                'message' => trans('admin::lang.delete_failed'),
            ]);
        }
    }


    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Admin::grid(Plate::class, function (Grid $grid) {

            $grid->id('ID')->sortable();

            $grid->created_at();
            $grid->updated_at();
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(Plate::class, function (Form $form) {

            $form->display('id', 'ID');
            $form->image('image');
            $form->hidden('cymbals_id');
        });
    }
    protected function form_create($request)
    {
        return Admin::form(Plate::class, function (Form $form) use ($request) {

            $form->image('image');
            $form->hidden('cymbals_id')->default($request->id);
        });
    }
}
