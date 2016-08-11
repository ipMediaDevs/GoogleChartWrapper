<?php namespace IpMedia;

use InvalidArgumentException;

class GoogleChartWrapper {

	const BASE_URL = 'http://chart.apis.google.com/chart';

	const PIE_3D = 'p3';

	const PIE = 'p';

	const COLOR_RED = 'ff0000';

	const COLOR_GREEN = '00ff00';

	const COLOR_BLUE = '0000ff';

	private $mandatory = [ 'cht', 'chs', 'chd' ];

	private $optional = [ 'chl', 'chtt', 'chco' ];

	private $types = [ 'p3', 'p' ];

	private $data = [ 'cht' => self::PIE_3D, 'chs' => '450x200' ];


	/**
	 * Gets the Chart type to be rendered
	 *
	 * @return string|null
	 */
	public function getType()
	{
		if ( isset( $this->data['cht'] ) ) return $this->data['cht'];
	}


	/**
	 * Sets the Chart type to be rendered
	 *
	 * @param string $type
	 *
	 * @return $this
	 */
	public function setType($type)
	{
		if ( in_array($type, $this->types) )
		{
			$this->data['type'] = $type;

			return $this;
		}

		$message = "";

		throw new InvalidArgumentException($message);

	}


	/**
	 * Gets the Chart size to be rendered
	 *
	 * @return string
	 */
	public function getSize()
	{
		if ( isset( $this->data['chs'] ) ) return $this->data['chs'];
	}


	/**
	 * Sets the Chart size to be rendered
	 *
	 * @param int      $width
	 * @param int|null $height
	 *
	 * @return $this
	 */
	public function setSize($width, $height = null)
	{
		$height = $height ?: $width;

		$this->data['chs'] = "{$width}x$height";

		return $this;
	}


	/**
	 * Sets the Chart data to be rendered
	 *
	 * @param array $data
	 *
	 * @return $this
	 */
	public function setData(array $data)
	{
		$this->data['chd'] = 't:' . implode(',', $data);

		return $this;
	}


	/**
	 * Sets the base color for the chart
	 *
	 * @param array|string $color
	 *
	 * @return $this
	 */
	public function setBaseColor($color)
	{
		$color = $this->sanitizeColor($color);

		$this->data['chco'] = $color;

		return $this;
	}


	private function sanitizeColor($color)
	{
		// it supports the rgb input
		if ( is_array($color) )
		{
			// must be a valid one
			if ( count($color) != 3 ) $message = 'The rgb color must have only 3 values.';

			$color = implode('',
							 array_map(function ($c) // convert each color
							 {
								 return str_pad(dechex($c), 2, "0", STR_PAD_LEFT);
							 },
								 $color));

		}
		// it supports the hex input
		elseif ( is_string($color) && strlen($color) != 6 ) $message = 'The hex color must have 6 chars.';

		// it throws exception if none above
		else $message = 'Unknown given format';

		if ( isset( $message ) ) throw new InvalidArgumentException($message);

		return $color;
	}


	/**
	 * Sets the gradient extremes for the chart
	 *
	 * @param array|string $from
	 * @param array|string $to
	 *
	 * @return $this
	 */
	public function setGradientColor($from, $to)
	{
		$from = $this->sanitizeColor($from);
		$to   = $this->sanitizeColor($to);

		$this->data['chco'] = "$from,$to";

		return $this;
	}


	/**
	 * Sets the colors for each segment
	 *
	 * @param array $colors
	 *
	 * @return $this
	 */
	public function setColors(array $colors)
	{
		$colors = array_map([ $this, 'sanitizeColor' ], $colors);

		$this->data['chco'] = implode('|', $colors);

		return $this;

	}


	/**
	 * Sets the Chart Labels
	 *
	 * @param array $labels
	 *
	 * @return $this
	 */
	public function setLabels(array $labels)
	{
		$this->data['chl'] = implode('|', $labels);

		return $this;
	}


	public function setTitle($title)
	{
		$this->data['chtt'] = urlencode($title);

		return $this;
	}


	/**
	 * Returns the Charts URL
	 *
	 * @return string
	 */
	public function getSrc()
	{
		return self::BASE_URL . '?' . urldecode(http_build_query($this->data));
	}
}
