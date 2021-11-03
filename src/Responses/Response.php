<?php

/**
 * This file is part of ArtFocus ArtCMS.
 * Copyright © 2021 Ján Forgáč <forgac@artfocus.cz>
 */

namespace MyStockWmsApiWrapper\Responses;

use JetBrains\PhpStorm\Pure;

class Response
{

	const STATUS_CODE_OK = 200;
	const STATUS_CODE_CREATED = 201;
	const STATUS_CODE_ERROR = 400;
	const STATUS_CODE_NOT_FOUND = 404;
	const STATUS_CODE_SERVER_ERROR = 500;

	const TYPE_ORDER_INCOMING = 'orderIncoming';
	const TYPE_ORDER_INCOMING_ITEM = 'orderIncomingItem';
	const TYPE_PARTNER = 'partner';
	const TYPE_PRODUCT = 'product';

	/** @var int HTTP Status code */
	private int $code;

	/** @var ResponseId[] generated ids */
	private array $ids = [];

	/** @var Error[]  */
	private array $errors = [];

	public function __construct(int $statusCode)
	{
		$this->code = $statusCode;
	}

	public function addResponseId(ResponseId $responseId)
	{
		$this->ids[] = $responseId;
	}

	public function addError(Error $error)
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

	#[Pure]
	public function getIdsByType(string $type)
	{
		$typedIds = [];
		foreach ($this->ids as $id) {
			if ($id->getType() === $type) {
				$typedIds[] = $id;
			}
		}

		return $typedIds;
	}

	/**
	 * @return Error[]
	 */
	public function getErrors(): array
	{
		return $this->errors;
	}

	// calculated

	public function isOk(): bool
	{
		return in_array($this->code, [self::STATUS_CODE_OK, self::STATUS_CODE_CREATED]);
	}

}
