<?php

use CrapChat\ClassyCraps;
use CrapChat\ColorMap;
use CrapChat\CrapsService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
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

    /**
     * @var CrapsService
     */
    private $craps;

    /**
     * @var Redirector
     */
    private $redirector;

    public function __construct(Request $request, ViewFactory $view, ColorMap $colorMap, CrapsService $craps, Redirector $redirector)
    {
        $this->request = $request;
        $this->view = $view;
        $this->colorMap = $colorMap;
        $this->craps = $craps;
        $this->redirector = $redirector;
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
        $key = $this->craps->save(explode(',', $x));

        return $this->redirector->to('/crap/'.$key);
    }

    public function viewCrap($key)
    {
        if ( ! $this->craps->find($key)) return 'Nope, nothing found';

        return $this->view->make('crap', compact('filename', 'key'));
    }

    public function viewCrapImg($key)
    {
        $filename = $this->craps->find($key);

        if ( ! $filename) return;

        $img = file_get_contents($filename);

        return new Response($img, 200, ['Content-Type' => 'image/jpg']);
    }

    public function viewClassyCrapImg($key)
    {

        $img = App::make(ClassyCraps::class)->make($key);

        return new Response($img, 200, ['Content-Type' => 'image/jpg']);
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
