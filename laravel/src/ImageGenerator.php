<?php namespace CrapChat;

use Imagick;

class ImageGenerator {

    const DIGITS_PER_ROW = 20;
    const HD_SCALE = 20;

    /**
     * @var ColorMap
     */
    private $colorMap;

    public function __construct(ColorMap $colorMap)
    {
        $this->colorMap = $colorMap;
    }

    /**
     * @param $numbers  Array of 400 digits
     * @return Imagick  The generated image
     */
    public function fromNumbers($numbers)
    {
        $rgb = $this->convertNumbersToRgb($numbers);

        $width = $height = pow((count($rgb) / 3), 0.5);

        $img = new Imagick;
        $img->newImage($width, $height, 'gray');
        $img->importImagePixels(0, 0, $width, $height, 'RGB', Imagick::PIXEL_CHAR, $rgb);
        $img->setImageFormat('jpg');

        return $img;
    }

    /**
     * Convert array of numbers into an array of their associated RGB values
     * e.g. [0,1,1,2] => [0,0,0,255,255,255,255,255,255,255,0,0]
     *
     * @param $numbers
     * @return array
     */
    private function convertNumbersToRgb($numbers)
    {
        // lol, can't remember how this works. only wrote it half hour ago

        $pixels = [];
        $pixelsIn2 = [];
        $hdScale = self::HD_SCALE;

        // scale vertically
        foreach (array_chunk($numbers, 20) as $chunk) {
            for ($i=0; $i < $hdScale; $i++) {
                $pixelsIn2 = array_merge($pixelsIn2, $chunk);
            }
        }

        foreach ($pixelsIn2 as $p) {
            list($r, $g, $b) = $this->convertNumberToRgb($p);
            // horizontal scale
            for ($i=0; $i < $hdScale; $i++) array_push($pixels, $r, $g, $b);
        }

        return $pixels;
    }

    /**
     * Given a number, will return an array representing an R,G,B value
     * e.g. 1 => [255,0,255]
     *
     * @param $number
     * @return array
     */
    private function convertNumberToRgb($number)
    {
        return $this->colorMap->keyToRgb($number);
    }

} 