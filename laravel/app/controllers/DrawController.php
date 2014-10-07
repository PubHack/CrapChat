<?php

use Illuminate\View\Factory;

class DrawController extends BaseController {

    /**
     * @var Factory
     */
    private $view;

    public function __construct(Factory $view)
    {
        $this->view = $view;
    }

    public function showDraw()
    {
        return $this->view->make('draw');
    }

}
