<?php

namespace App\Classes;

use Illuminate\Http\JsonResponse;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\URL;

class DataProvider extends LengthAwarePaginator
{
	/**
     * {@inheritdoc}
     */
	public function __construct(LengthAwarePaginator $paginator, array $options = [])
	{
		parent::__construct($paginator->items(), $paginator->total(), $paginator->perPage(), $paginator->currentPage(), $options);
	}

	/**
	 * The Paginator instance returns only the items
	 *
	 * @return array
	 */
	public function toArray()
	{
		// array_values makes sure we return an flat array
		// [0 => first, 1 => second] instead of [5 => first, 6 => second]
		return array_values($this->items->toArray());
	}

	/**
	 * Build the Link headers
	 * Can be attached to the response using `withHeaders`
	 *
	 * @return array
	 */
	public function getHeaders()
	{
		$links = [
			'self' => URL::current() . $this->url($this->currentPage()),
			'last' => URL::current() . $this->url($this->lastPage()),
			'prev' => URL::current() . $this->previousPageUrl(),
			'next' => URL::current() . $this->nextPageUrl(),
		];

		$headers = [];

		foreach ($links as $rel => $url) {
			if ($url != null) {
				$headers[] = (new Link($url, $rel))->toString();
			}
		}

		return [
			'Link' => implode(', ', $headers),
			'X-Pagination-Total-Count' => $this->total(),
			'X-Pagination-Total-Page' => ceil($this->total() / $this->perPage()),
			'X-Pagination-Current-Page' => $this->currentPage(),
			'X-Pagination-Per-Page' => $this->perPage(),
		];
	}

	/**
	 * Create a Laravel Response that sends the items in the body and
	 * pagination info in the headers
	 *
	 * @return JsonResponse
	 */
	public function toResponse()
	{
		$response = new JsonResponse($this->toArray());

		return $response->withHeaders($this->getHeaders());
	}
}
