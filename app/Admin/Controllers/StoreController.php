<?php

namespace App\Admin\Controllers;

use App\Admin\Actions\Store\Tags;
use App\Models\Store;
use Encore\Admin\Actions\Action;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class StoreController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Store';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Store());

        $grid->column('id', __('Id'));
        $grid->column('mark', __('Mark'))->image();
        $grid->column('name', __('Name'));
        $grid->column('title', __('Title'));
        $grid->column('price', __('Price'));
        $grid->column('origin_price', __('Origin price'));
        $grid->column('sales', __('Sales'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));

        $grid->filter(function($filter){
            $filter->like('name','Name');
        });

        $grid->actions(function ($actions) {
            // append一个作
            $actions->add(new Tags);
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
        $show = new Show(Store::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('mark', __('Mark'));
        $show->field('name', __('Name'));
        $show->field('title', __('Title'));
        $show->field('price', __('Price'));
        $show->field('origin_price', __('Origin price'));
        $show->field('sales', __('Sales'));
        $show->field('description', __('Description'));
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
        $form = new Form(new Store());

        $form->image('mark', __('Mark'))->dir('/images');
        $form->text('name', __('Name'));
        $form->text('title', __('Title'));
        $form->decimal('price', __('Price'))->placeholder("价格");
        $form->decimal('origin_price', __('Origin price'))->placeholder("原价");
        $form->number('sales', __('Sales'))->placeholder("销量");
        $form->UEditor('description', __('Description'));

        return $form;
    }
}
