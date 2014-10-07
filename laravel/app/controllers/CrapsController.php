<?php

use CrapChat\ClassyCraps;

class CrapsController extends BaseController {

    /**
     * @var ClassyCraps
     */
    private $craps;

    public function __construct(ClassyCraps $craps)
    {
        $this->craps = $craps;
    }

    public function showAllCraps()
    {
        $craps = $this->craps->latestSent();

        return View::make('craps', compact('craps'));
    }

} 