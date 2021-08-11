<?php

namespace App\Admin\Controllers;

use App\Models\StoreAlbum;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class StoreAlbumController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'StoreAlbum';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new StoreAlbum());

        $grid->column('id', __('Id'));
        $grid->column('store_id', __('Store id'));
        $grid->column('thumb', __('Thumb'))->image('',200,200);
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));

        $grid->filter(function ($filter){
            $filter->disableIdFilter();
            $filter->equal('store_id');
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
        $show = new Show(StoreAlbum::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('store_id', __('Store id'));
        $show->field('thumb', __('Thumb'));
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
        $form = new Form(new StoreAlbum());

        $form->number('store_id', __('Store id'));
        $form->image('thumb', __('Thumb'))->dir('/images')->help('尺寸');

        return $form;
    }
}
