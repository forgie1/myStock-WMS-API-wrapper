<?php

/**
 * This file is part of ArtFocus ArtCMS.
 * Copyright © 2021 Ján Forgáč <forgac@artfocus.cz>
 */

namespace MyStockWmsApiWrapper\Entities;

/**
 * Item to be shipped
 */
class Item
{

	/** @var string Unique identifier of the product */
	private string $productId;

	/** @var float numeric (15,4) - Quantity of product (in basic unit of measurement, if there is no other unit of measurement filled in) */
	private float $amountQuantity;

	/** @var string|null Unit of measurement in which the product is issued from the warehouse - Code will be generated during the creation of unit of measurement in the WMS. If this box is empty, system uses the basic unit of measurement for the ordered product. */
	private ?string $amountMeasurementUnitCode = null;

	public function __construct(string $productId, float|int $amountQuantity, ?string $amountMeasurementUnitCode = null)
	{
		$this->productId = $productId;
		$this->amountQuantity = (float)$amountQuantity;
		$this->amountMeasurementUnitCode = $amountMeasurementUnitCode;
	}

	/**
	 * @return string
	 */
	public function getProductId(): string
	{
		return $this->productId;
	}

	/**
	 * @return float
	 */
	public function getAmountQuantity(): float
	{
		return $this->amountQuantity;
	}

	/**
	 * @return string|null
	 */
	public function getAmountMeasurementUnitCode(): ?string
	{
		return $this->amountMeasurementUnitCode;
	}

}
