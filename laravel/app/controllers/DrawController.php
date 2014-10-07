<?php

use CrapChat\ColorMap;
use Illuminate\Http\Request;
use Illuminate\View\Factory as ViewFactory;

class DrawController extends BaseController {

    /**
     * @var Request
     */
    private $request;

    /**
     * @var ViewFactory
     */
    private $view;

    /**
     * @var ColorMap
     */
    private $colorMap;

    public function __construct(Request $request, ViewFactory $view, ColorMap $colorMap)
    {
        $this->request = $request;
        $this->view = $view;
        $this->colorMap = $colorMap;
    }

    public function showDraw()
    {
        return $this->view->make('draw', [
            'colors' => $this->formatColors(),
        ]);
    }

    public function storeDrawing()
    {
        $x = $this->request->get('drawing');
        $gen = App::make(\CrapChat\ImageGenerator::class);
        $foo = $gen->fromNumbers(explode(',', $x));
        $foo->writeImage(storage_path().'/'.uniqid('crapchat', true).'.jpg');
        return new \Illuminate\Http\Response($foo, 200, ['Content-Type' => 'image/jpg']);
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
