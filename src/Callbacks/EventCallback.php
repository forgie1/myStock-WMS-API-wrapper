<?php

/**
 * This file is part of ArtFocus ArtCMS.
 * Copyright © 2021 Ján Forgáč <forgac@artfocus.cz>
 */

namespace FulfillmentByAuthentica\Callbacks;

/**
 * Fulfillment API supports callbacks
 */
abstract class EventCallback
{

	protected int $eventType;

	/** @var int */
	protected int $eventSubtype;

	/** @var string Order/Receipt ID this event is informing about */
	protected string $documentId;

	/**
	 * @return int
	 */
	public function getEventType(): int
	{
		return $this->eventType;
	}

	/**
	 * @return int
	 */
	public function getEventSubtype(): int
	{
		return $this->eventSubtype;
	}

	/**
	 * @return string
	 */
	public function getDocumentId(): string
	{
		return $this->documentId;
	}

}
