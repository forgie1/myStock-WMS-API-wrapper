<?php

/**
 * This file is part of ArtFocus ArtCMS.
 * Copyright © 2021 Ján Forgáč <forgac@artfocus.cz>
 */

namespace MyStockWmsApiWrapper\Responses;

class Error
{

	const ERROR_TYPES = [
		1 => 'Value is NULL',
		2 => 'Value is not specified',
		3 => 'Invalid value - e.g. id of nonexisting record',
		4 => 'Other specific error',
		5 => 'Value is not unique',
		6 => 'Update of record is forbidden',
		7 => 'Value overflow e.g. string is too long',
		100 => 'Internal server error. Unique record id is set in recordId',
	];

	private string $errorText;

	/** @var int  Error type (see self::ERROR_TYPES) */
	private int $errorType;

	/** @var string|null Optional name of invalid property */
	private ?string $propertyName;

	/** @var string If header is faulted then 0, else order of faulted item */
	private string $recordId;

	/** @var string Type of faulted record (partner) */
	private string $recordType;

	public function __construct(string $errorText, int|string $errorType, ?string $propertyName, string $recordId, string $recordType)
	{
		$this->errorText = $errorText;
		$this->errorType = (int)$errorType;
		$this->propertyName = $propertyName;
		$this->recordId = $recordId;
		$this->recordType = $recordType;
	}

	/**
	 * @return string
	 */
	public function getErrorText(): string
	{
		return $this->errorText;
	}

	public function getErrorCode(): int
	{
		return $this->errorType;
	}

	public function getErrorCodeAsText(): string
	{
		return self::ERROR_TYPES[$this->errorType] ?? 'Unknown error';
	}

	/**
	 * @return string|null
	 */
	public function getPropertyName(): ?string
	{
		return $this->propertyName;
	}

	/**
	 * @return string
	 */
	public function getRecordId(): string
	{
		return $this->recordId;
	}

	/**
	 * @return string
	 */
	public function getRecordType(): string
	{
		return $this->recordType;
	}

}
