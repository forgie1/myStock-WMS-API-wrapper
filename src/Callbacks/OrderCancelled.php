<?php

/**
 * This file is part of ArtFocus ArtCMS.
 * Copyright © 2021 Ján Forgáč <forgac@artfocus.cz>
 */

namespace MyStockWmsApiWrapper\Callbacks;

/**
 * Callbeck object that Order was Cancelled
 */
class OrderCancelled extends EventCallback
{

	protected int $eventType = 20;

	/**
	 * @param string|int $eventType
	 * @param string|int $eventSubtype 3 - Order incoming
	 * @param string $documentId
	 */
	public function __construct(string|int $eventType, string|int $eventSubtype, string $documentId)
	{
		$this->eventType = (int)$eventType;
		$this->eventSubtype = (int)$eventSubtype;
		$this->documentId = $documentId;
	}

}
