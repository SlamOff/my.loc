<?php

namespace App\Admin\Controllers;

use App\Order;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Row;

class OrderController extends Controller
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

            $content->header('Заказы');

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
        /*return Admin::content(function (Content $content) use ($id) {

            $content->header('header');
            $content->description('description');

            $content->body($this->form()->edit($id));
        });*/
        return Admin::content(function (Content $content) use ($id) {

            $content->header('Наборы коллекции');

            $content->row(function (Row $row) use ($id){

                $row->column(12, function (Column $column) use ($id){

                    $column->append($this->form()->edit($id));
                });

            });

            $content->row(function (Row $row) use ($id) {

                $row->column(12, function (Column $column) use ($id) {

                    $column->append((new CartController())->grid($id));
                });

            });
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
        return Admin::grid(Order::class, function (Grid $grid) {

            $grid->id('ID')->sortable();
            $grid->name('Имя клиента');
            $grid->phone('Телефон');
            $grid->created_at('Дата заказа');
            $grid->amount('Заказ на сумму');
            $grid->status('Статус')->select([
                0 => 'не обработано',
                1 => 'обработано',
            ]);
            $grid->disableCreation();
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
        return Admin::form(Order::class, function (Form $form) {

            $form->display('name', 'Имя');
            $form->display('phone', 'Телефон');
            $form->display('email', 'Email');
            $form->display('delivery', 'Тип доставки');
            $form->display('address', 'Адрес');
            $form->display('comment', 'Комментарий');
            $form->display('amount','Заказ на сумму');
            $form->display('created_at', 'Дата заказа');
            $form->select('status','Статус')->options([
                0 => 'не обработано',
                1 => 'обработано',
            ]);
        });
    }
}
