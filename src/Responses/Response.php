<?php

/**
 * This file is part of ArtFocus ArtCMS.
 * Copyright © 2021 Ján Forgáč <forgac@artfocus.cz>
 */

namespace MyStockWmsApiWrapper\Responses;

class Response
{

	/** @var int HTTP Status code */
	private int $code;

	/** @var ResponseId[] generated ids */
	private array $ids;

	/** @var Error[]  */
	private array $errors;

	public function __construct(int $statusCode)
	{
		$this->code = $statusCode;
	}

	private function addResponseId(ResponseId $responseId)
	{
		$this->ids[] = $responseId;
	}

	private function addError(Error $error)
	{
		$this->errors[] = $error;
	}

	/**
	 * @return int
	 */
	public function getCode(): int
	{
		return $this->code;
	}

	/**
	 * @return ResponseId[]
	 */
	public function getIds(): array
	{
		return $this->ids;
	}

	/**
	 * @return Error[]
	 */
	public function getErrors(): array
	{
		return $this->errors;
	}

}
