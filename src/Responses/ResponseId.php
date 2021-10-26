<?php

/**
 * This file is part of ArtFocus ArtCMS.
 * Copyright © 2021 Ján Forgáč <forgac@artfocus.cz>
 */

namespace MyStockWmsApiWrapper\Responses;

class ResponseId
{

	/** @var string generated id */
	private string $id;

	/** @var int Record order if more than one record is inserted */
	private int $recordId;

	/** @var string Record type (orderIncoming, orderIncomingItem, ...) */
	private string $type;

	public function __construct(string|int $id, string|int $recordId, string $type)
	{
		$this->id = (string)$id;
		$this->recordId = (int)$recordId;
		$this->type = $type;
	}

	/**
	 * @return string
	 */
	public function getId(): string
	{
		return $this->id;
	}

	/**
	 * @return int
	 */
	public function getRecordId(): int
	{
		return $this->recordId;
	}

	/**
	 * @return string
	 */
	public function getType(): string
	{
		return $this->type;
	}

}
