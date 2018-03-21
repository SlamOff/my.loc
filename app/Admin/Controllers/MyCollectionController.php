<?php

namespace App\Admin\Controllers;

use App\Collection;

use App\Cymbals;
use Illuminate\Support\Facades\Input;
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


class MyCollectionController extends Controller
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

            $content->header('Коллекции MY');

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
        $id=$request->id;
        return Admin::content(function (Content $content) use ($id) {

            $content->header('Наборы коллекции');

            $content->row(function (Row $row) use ($id){

                $row->column(12, function (Column $column) use ($id){

                    $column->append($this->form()->edit($id));
                });

            });

            $content->row(function (Row $row) use ($id) {

                $row->column(12, function (Column $column) use ($id) {

                    $column->append((new CymbalsController)->grid($id));
                });

            });
        });
    }

    public function update(\Illuminate\Http\Request $request)
    {
        $name = Input::get('name','');
        $alias = Input::get('alias','');

        if($alias)
            $temp = $alias;
        else
            $temp = $name;

        $temp = str_replace(' ', '_', $temp);
        $alias = preg_replace("/[^-_a-zA-Z0-9]/iu", '', $temp);
        $alias = strtolower($alias);
        Input::merge(['alias' => $alias]);
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

    public function store()
    {
        $name = Input::get('name','');
        $alias = Input::get('alias','');

        if($alias)
            $temp = $alias;
        else
            $temp = $name;

        $temp = str_replace(' ', '_', $temp);
        $alias = preg_replace("/[^-_a-zA-Z0-9]/iu", '', $temp);
        $alias = strtolower($alias);
        Input::merge(['alias' => $alias]);
        return $this->form()->store();
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
            $grid->model()->where('type',2)->orderBy('position', 'asc');
            $grid->name('Название коллекции');
            $grid->alias('Псевдоним');
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
            $form->text('name', 'Название коллекции')->rules('required');
            $form->text('alias','Псевдоним');
            $form->hidden('position', 'Позиция')->default(0);
            $form->hidden('type', 'Тип')->default(2);
        });
    }
}
