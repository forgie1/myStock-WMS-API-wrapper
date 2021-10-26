<?php

/**
 * This file is part of ArtFocus ArtCMS.
 * Copyright © 2021 Ján Forgáč <forgac@artfocus.cz>
 */

namespace MyStockWmsApiWrapper\Callbacks;

/**
 * Callbeck object that order was Sent (dispatched)
 */
class OrderDispatched extends EventCallback
{

	protected int $eventType = 12;

	/** @var string (DR2082000056C) */
	private string $shippingLabel;

	/**
	 * @param string|int $eventType
	 * @param string|int $eventSubtype 1 - Carrier; 2 - Personal collection
	 * @param string $documentId
	 * @param string $shippingLabel
	 */
	public function __construct(string|int $eventType, string|int $eventSubtype, string $documentId, string $shippingLabel)
	{
		$this->eventType = (int)$eventType;
		$this->eventSubtype = (int)$eventSubtype;
		$this->documentId = $documentId;
		$this->shippingLabel = $shippingLabel;
	}

	/**
	 * @return string
	 */
	public function getShippingLabel(): string
	{
		return $this->shippingLabel;
	}

}
