<?php

namespace App\Admin\Controllers;

use App\Cymbals;

use App\Plate;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use http\Env\Request;

use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Row;
use Encore\Admin\Widgets\Tab;

class CymbalsController extends Controller
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
        $id=$request->id;

        return Admin::content(function (Content $content) use ($request) {

            $content->header('Набор');

            $content->row(function (Row $row) use ($request){

                $row->column(12, function (Column $column) use ($request){

                    $tab = new Tab();
                    $tab->add('Тарелки', Plate::tree(function ($tree) use ($request) {
                        $tree->query(function ($model) use ($request){
                            return $model->where('cymbals_id', $request->id);
                        });
                        $tree->branch(function ($branch) {
                            $src = config('admin.upload.host') . '/' . $branch['image'] ;
                            $logo = "<img src='$src' style='max-width:500px;max-height:300px' align='center' class='img'/>";

                            return "$logo";
                        });
                    }));
                    $tab->add('Редактировать набор', $this->form($request)->edit($request->id));
                    $column->append($tab);
                    //$column->append($this->form()->edit($id));
                });

            });
        });
    }

    public function update(\Illuminate\Http\Request $request)
    {
        $id = $request->edit;
        return $this->form($request)->update($id);
    }

    /**
     * Create interface.
     *
     * @return Content
     */
    public function create(\Illuminate\Http\Request $request)
    {
        return Admin::content(function (Content $content) use ($request) {

            $content->header('Добавить набор');

            $content->body($this->form_create($request));
        });
    }

    public function store(\Illuminate\Http\Request $request)
        {
            return $this->form($request)->store();
        }

    public function destroy(\Illuminate\Http\Request $request)
    {
        $id = $request->edit; //dd($id);
        $this->form()->model()->find($id)->plates()->delete();
        $this->form()->model()->find($id)->local()->delete();
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
    public function grid($id)
    {
        return Admin::grid(Cymbals::class, function (Grid $grid) use ($id) {

            $grid->id();
            $grid->model()->where('collection_id', '=', $id)->orderBy('position', 'asc');
            $grid->image('Обложка')->image();
            $grid->position('Позиция набора')->editable();

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
    protected function form($request)
    {
        return Admin::form(Cymbals::class, function (Form $form) use ($request) {
            $form->display('id');
            $form->hidden('collection_id');
            $form->hidden('position');
            $form->text('vendor_code','Артикул')->default('000000')->rules('max:6');
            $form->image('image','Обложка');
            $form->image('image2','Обложка наведение курсора');
            if(mb_strtolower($request->type)!='re')
                $form->number('price','Цена');
            $form->hasMany('local', function (Form\NestedForm $form) {
                $form->select('language','Язык')->options(['ru' => 'ru','en'=>'en']);
                $form->textarea('description','Описание');
            })->options(['add'=>false,'delete'=>false,'local'=>true]);
        });
    }

    protected function form_create($request)
    {
        return Admin::form(Cymbals::class, function (Form $form) use ($request) {

            $form->hidden('collection_id')->default($request->collection_id);
            $form->text('vendor_code','Артикул')->default('000000')->rules('max:6');
            $form->image('image','Обложка');
            $form->image('image2','Обложка наведение курсора');
            if(mb_strtolower($request->type)!='re')
                $form->number('price','Цена');
            $form->hasMany('local', function (Form\NestedForm $form) {
                $form->select('language','Язык')->options(['ru' => 'ru','en'=>'en']);
                $form->textarea('description','Описание');
            })->options(['add'=>false,'delete'=>false,'local'=>true]);
        });
    }


}
