<?php namespace CrapChat;

class ColorMap {

    public function all()
    {
	    return [
			0 => [  0,   0,   0], // black
			1 => [255, 255, 255], // white
			2 => [255,   0,   0], // red
			3 => [255, 152,   0], // orange
			4 => [255, 255,   0], // yellow
			5 => [ 51, 252,   3], // lime
			6 => [  0, 153, 255], // blue
			7 => [102,  51, 253], // purple
			8 => [255, 153, 255], // pink
			9 => [  0,  51, 102], // background blue
	    ];
    }

	public function keyToRgb($key)
	{
		$colors = $this->all();

		if ( ! array_key_exists($key, $colors)) $key = 0;

		return $colors[$key];
	}

} 