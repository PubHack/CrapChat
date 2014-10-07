<?php namespace CrapChat;

use Imagick;

class CrapsService {

    /**
     * @var ImageGenerator
     */
    private $imageGenerator;

    public function __construct(ImageGenerator $imageGenerator)
    {
        $this->imageGenerator = $imageGenerator;
    }

    public function latest($limit = 10)
    {
        return \Crap::limit($limit);
    }

    /**
     * @param $key
     * @return string|bool
     */
    public function find($key)
    {
        $crap = \Crap::where('key', $key)->first();

        return $crap ? $crap->filename : false;
    }

    public function save(array $numbers)
    {
        $img = $this->imageGenerator->fromNumbers($numbers);

        $filename = $this->makeFilename();

        $img->writeImage($filename);

        $key = $this->rand();

        $crap = \Crap::create(compact('filename', 'key'));

        return $key;
    }

    /**
     * @return string
     */
    private function makeFilename()
    {
        return storage_path() . '/craps/' . uniqid('', true) . '.jpg';
    }

    private function rand()
    {
        $pool = '0123456789';

        return substr(str_shuffle(str_repeat($pool, 5)), 0, 8);
    }

} 