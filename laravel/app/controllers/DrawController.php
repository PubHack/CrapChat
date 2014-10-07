<?php

use Illuminate\View\Factory;

class DrawController extends BaseController {

    /**
     * @var Factory
     */
    private $view;

    /**
     * @var \CrapChat\ImageGenerator
     */
    private $gen;

    public function __construct(Factory $view, \CrapChat\ImageGenerator $gen)
    {
        $this->view = $view;
        $this->gen = $gen;
    }

    public function showDraw()
    {
        return $this->view->make('draw', [
            'colors' => [
				'rgb(0, 0, 0)' => 0, // black
				'rgb(255, 255, 255)' => 1, // white
				'rgb(255, 0, 0)' => 2, // red
				'rgb(255, 152, 0)' => 3, // orange
				'rgb(255, 255, 0)' => 4, // yellow
				'rgb(51, 252, 3)' => 5, // lime
				'rgb(0, 153, 255)' => 6, // blue
				'rgb(102, 51, 253)' => 7, // purple
				'rgb(255, 153, 255)' => 8, // pink
				'rgb(0, 51, 102)' => 9, // background blue
            ],
        ]);
    }

}
