<?php

namespace App\Admin\Controllers;

use App\Collection;

use App\Cymbals;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;


use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Row;
use Encore\Admin\Widgets\Box;
use Encore\Admin\Widgets\Chart\Bar;
use Encore\Admin\Widgets\Chart\Doughnut;
use Encore\Admin\Widgets\Chart\Line;
use Encore\Admin\Widgets\Chart\Pie;
use Encore\Admin\Widgets\Chart\PolarArea;
use Encore\Admin\Widgets\Chart\Radar;
use Encore\Admin\Widgets\Collapse;
use Encore\Admin\Widgets\InfoBox;
use Encore\Admin\Widgets\Tab;
use Encore\Admin\Widgets\Table;
use GuzzleHttp\Psr7\Request;

class ReCollectionController extends Controller
{
    use ModelForm;

    /**
     * Index interface.
     *
     * @return Content
     */
    public function index()
    {
        return redirect('admin/re/collections/6/edit');

        /*return Admin::content(function (Content $content){

            $content->header('Коллекции RE');

            /*$content->row(function (Row $row){

                $row->column(12, function (Column $column){

                    $tab = new Tab();
                    $tab->add('en', (new OptionController)->form_re(1)->edit(1));
                    $tab->add('ru', (new OptionController)->form_re(2)->edit(2));
                    $column->append($tab);
                });

            });*/
/*
            $content->row(function (Row $row) {

                $row->column(12, function (Column $column) {

                    $column->append($this->grid());
                });

            });
        });*/
    }

    /**
     * Edit interface.
     *
     * @param $id
     * @return Content
     */
    public function edit(\Illuminate\Http\Request $request)
    {
        /*return Admin::content(function (Content $content) {
            $content->header('Наборы');
            $content->body(Cymbals::tree());
        });*/
        /*return Admin::content(function (Content $content) use ($id) {

            $content->header('header');
            $content->description('description');

            $content->body($this->form()->edit($id));
        });*/
        $id=$request->id;
        return Admin::content(function (Content $content) use ($id) {

            $content->header('Наборы коллекции RE');

            /*$content->row(function (Row $row) use ($id){

                $row->column(12, function (Column $column) use ($id){

                    $column->append($this->form()->edit($id));
                });

            });*/

            $content->row(function (Row $row) use ($id) {

                $row->column(12, function (Column $column) use ($id) {

                    $column->append((new CymbalsController)->grid($id));
                });

            });
        });
    }

    public function update(\Illuminate\Http\Request $request)
    {
        $id=$request->collections;
        return $this->form()->update($id);
    }

    /**
     * Create interface.
     *
     * @return Content
     */
    public function create()
    {
        return Admin::content(function (Content $content) {

            $content->header('Добавить коллекцию');

            $content->body($this->form());
        });
    }

    public function destroy(\Illuminate\Http\Request $request)
    {
        $id=$request->collections;
        $cymbals = $this->form()->model()->find($id)->cymbals()->get();
        foreach ($cymbals as $item)
        {
            $item->plates()->delete();
            $item->local()->delete();
        }
        $this->form()->model()->find($id)->cymbals()->delete();
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
        return Admin::grid(Collection::class, function (Grid $grid) {

            $grid->id('ID')->sortable();
            $grid->model()->where('type',3)->orderBy('position', 'asc');
            $grid->name('Название коллекции');
            $grid->position('Позиция')->editable();
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
        return Admin::form(Collection::class, function (Form $form) {
            $form->text('name', 'Название коллекции');
            $form->hidden('position', 'Позиция')->default(0);
            $form->hidden('type', 'Позиция')->default(3);
        });
    }
}
