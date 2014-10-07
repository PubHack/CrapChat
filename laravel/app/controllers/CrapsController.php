<?php

use CrapChat\CrapsService;

class CrapsController extends BaseController {

    /**
     * @var CrapsService
     */
    private $craps;

    public function __construct(CrapsService $craps)
    {
        $this->craps = $craps;
    }

    public function showAllCraps()
    {
        $this->craps->latest();
    }

} 