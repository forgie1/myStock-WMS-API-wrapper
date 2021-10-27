<?php

/**
 * This file is part of  ArtFocus ArtCMS.
 * Copyright © 2021 Ján Forgáč <forgac@artfocus.cz>
 */

namespace MyStockWmsApiWrapper\Entities;

class MyStockWrapProductBarcode
{

	/** @var string 1A672B37-B674-4F14-A13F-C82EAF53BF15 (string (1024), required) - Unique identifier of the product - ID will be generated during the creation of product via API */
	private string $productId;

	/** @var string EAN3 (string (30), required) - Barcode of the product. Any string of values can be entered, usually EAN-13 is used. There is no validation of the code imported into the WMS */
	private string $barcode;

	/** @var bool 0 (tinyint) - Default barcode for the product (only one barcode can be selected as a default barcode). Supported values: 0 - No, 1 - Yes */
	private bool $default = true;

	/** @var string|null KS (string (1024)) - The box is used to distinguish barcodes for different units of measurement (the unit of measurement must exist in the WMS, otherwise the record will not be imported). If there is only one (basic) unit of measurement registered in the WMS for the given product, it is not necessary to fill in the box (it can be NULL or empty) */
	private ?string $measurementUnitCode = null;

	/** @var bool|int State of the barcode. Supported values: 0 - Inactive, 1 - Active */
	private bool $active = true;

	public function __construct(string $productId, string $barcode)
	{
		$this->productId = $productId;
		$this->barcode = $barcode;
	}

	/**
	 * @return string
	 */
	public function getProductId(): string
	{
		return $this->productId;
	}

	/**
	 * @return string
	 */
	public function getBarcode(): string
	{
		return $this->barcode;
	}

	/**
	 * @return bool
	 */
	public function getDefault(): bool
	{
		return $this->default;
	}

	/**
	 * @param bool $default
	 * @return MyStockWrapProductBarcode
	 */
	public function setDefault(bool $default): MyStockWrapProductBarcode
	{
		$this->default = $default;
		return $this;
	}

	/**
	 * @return string|null
	 */
	public function getMeasurementUnitCode(): ?string
	{
		return $this->measurementUnitCode;
	}

	/**
	 * @param string|null $measurementUnitCode
	 * @return MyStockWrapProductBarcode
	 */
	public function setMeasurementUnitCode(?string $measurementUnitCode): MyStockWrapProductBarcode
	{
		$this->measurementUnitCode = $measurementUnitCode;
		return $this;
	}

	/**
	 * @return bool|int
	 */
	public function getActive(): bool|int
	{
		return $this->active;
	}

	/**
	 * @param bool|int $active
	 * @return MyStockWrapProductBarcode
	 */
	public function setActive(bool|int $active): MyStockWrapProductBarcode
	{
		$this->active = $active;
		return $this;
	}

}
