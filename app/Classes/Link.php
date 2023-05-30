<?php

namespace App\Classes;

/**
 * @see https://github.com/Guzzle3/http/blob/master/Message/Header/Link.php
 */
class Link
{
	private $links = [];

	/**
	 * Build a Link header
	 *
	 * @param string $url    Link URL
	 * @param string $rel    Link rel
	 * @param array  $params Other link parameters
	 *
	 * @return self
	 */
	public function __construct($url, $rel, array $params = [])
	{
		$this->links = ["<{$url}>", "rel=\"{$rel}\""];
		foreach ($params as $k => $v) {
			$this->links[] = "{$k}=\"{$v}\"";
		}
	}

	/**
	 * Strigfy links
	 */
	public function toString()
	{
		return implode('; ', $this->links);
	}
}
