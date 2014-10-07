<?php namespace CrapChat;

use Imagick;

class ClassyCraps {

    /**
     * @var CrapsService
     */
    private $craps;

    public function __construct(CrapsService $craps)
    {
        $this->craps = $craps;
    }

    /**
     * @param string $key
     * @return Imagick
     */
    public function make($key)
    {
        $filename = $this->craps->find($key);

        $crap = new Imagick($filename);
        $bg = new Imagick($this->getRandomBackground());

        // overlay crap on background - producing a CLASSY CRAP
        $bg->setImageColorspace($crap->getImageColorspace());
        $w = ($bg->getImageWidth() / 2) - ($crap->getImageWidth() / 2);
        $h = ($bg->getImageHeight() / 2) - ($crap->getImageHeight() / 2);
        $bg->compositeImage($crap, Imagick::COMPOSITE_OVER, $w, $h);

        return $bg;
    }

    private function getRandomBackground()
    {
        $backgrounds = [
            '1.jpg',
        ];

        return public_path() . '/bgs/' . $backgrounds[array_rand($backgrounds)];
    }

} 