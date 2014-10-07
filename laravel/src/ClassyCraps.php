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

    public function latestSent($limit = 10)
    {
        return \SentCrap::orderBy('id', 'desc')->take($limit)->get()->map(function($crap) {
            return (object) [
                'from' => $crap->from,
                'to' => $crap->to,
                'key' => $crap->key,
                'date' => $crap->created_at,
            ];
        });
    }

    /**
     * @param string $key
     * @return Imagick
     */
    public function make($key)
    {
        if ($this->alreadyExists($key))
        {
            $bg = new Imagick($this->getPath($key));
        }
        else
        {
            $filename = $this->craps->find($key);

            $crap = new Imagick($filename);
            $bg = new Imagick($this->getRandomBackground());

            // overlay crap on background - producing a CLASSY CRAP
            $bg->setImageColorspace($crap->getImageColorspace());
            $w = ($bg->getImageWidth() / 2) - ($crap->getImageWidth() / 2);
            $h = ($bg->getImageHeight() / 2) - ($crap->getImageHeight() / 2);
            $bg->compositeImage($crap, Imagick::COMPOSITE_OVER, $w, $h);

            $bg->writeImage($this->getPath($key));
        }

        return $bg;
    }

    private function getRandomBackground()
    {
        $backgrounds = [
            '1.jpg',
        ];

        return public_path() . '/bgs/' . $backgrounds[array_rand($backgrounds)];
    }

    private function alreadyExists($key)
    {
        return file_exists($this->getPath($key));
    }

    /**
     * @return string
     */
    private function makeFilename($key)
    {
        return storage_path() . '/craps/cc-' . $key . '.jpg';
    }

    /**
     * @param $key
     * @return string
     */
    private function getPath($key)
    {
        return storage_path() . '/craps/cc-' . $key . '.jpg';
    }

}