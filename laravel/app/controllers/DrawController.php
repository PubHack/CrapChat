<?php

use CrapChat\ColorMap;
use Illuminate\View\Factory;

class DrawController extends BaseController {

    /**
     * @var Factory
     */
    private $view;

    /**
     * @var ColorMap
     */
    private $colorMap;

    /**
     * @var \CrapChat\ImageGenerator
     */
    private $imageGenerator;

    public function __construct(Factory $view, ColorMap $colorMap, \CrapChat\ImageGenerator $imageGenerator)
    {
        $this->view = $view;
        $this->colorMap = $colorMap;
        $this->imageGenerator = $imageGenerator;
    }

    public function showDraw()
    {
        return $this->view->make('draw', [
            'colors' => $this->formatColors(),
        ]);
    }

    private function formatColors()
    {
        $colors = $this->colorMap->all();

        $out = [];

        foreach ($colors as $key => $rgb)
        {
            $rgbString = sprintf('rgb(%d,%d,%d)', $rgb[0], $rgb[1], $rgb[2]);
            $out[$rgbString] = $key;
        }

        return $out;
    }

}
