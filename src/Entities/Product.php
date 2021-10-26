<?php

/**
 * This file is part of ArtFocus ArtCMS.
 * Copyright © 2021 Ján Forgáč <forgac@artfocus.cz>
 */

namespace MyStockWmsApiWrapper\Entities;

class Product
{

	/** @var string (string (150), required) - Product code - a unique identifier that cannot be changed over time, it is used to identify a product in the WMS. The code is displayed to warehouse operators on mobile devices and is printed in reports. */
	private string $productCode;

	/** @var string (string (255), required) - Name of the product */
	private string $name;

	/** @var int (smallint, required) - Supported product types: 0 - Goods, 10 - Material, 20 - Packaging, 30 - Fee, 40 - Product, 50 - Set, 60 - Semi-finished product, 70 - Production in progress, 80 - Gift voucher, 90 - Fabric, 100 - Promotional material */
	private int $type;

	/** @var string (string (1024), required) - Basic unit of measurement in which the product is recorded on stock cards - the CODE will be generated during the creation of measurement unit in the WMS */
	private string $measurementUnitCode;

	/** @var string (string (20), required) - Each product must have a warehouse code filled in - this warehouse code must be registered in the WMS (if the customer works with multiple warehouses registered in the WMS, it is sufficient to fill in only one warehouse code) */
	private string $warehouseCode;

	/** @var float|null  10.5 (numeric (17,6)) - Gross weight of the product. */
	private ?float $weightGross;

	/** @var float|null (numeric (17,6)) - Net weight of the product */
	private ?float $weightNett;

	/** @var float|null (numeric (8,4)) - Gross height of the product */
	private ?float $height;

	/** @var float|null (numeric (8,4)) - Gross width of the product */
	private ?float $width;

	/** @var float|null (numeric (8,4)) - Gross depth of the product */
	private ?float $depth;

	/** @var float|null 10.5 (numeric (17,6)) - Gross volume of the product */
	private ?float $volume;

	/** @var string|null www.mystock.cz/product.png (string (255)) - URL path to the image of the product. If the URL contains backslash character, the backslash has to be doubled (e.g. a UNC path "\\192.168.55.3\product\377169719.jpg" has to be sent as "\\\\192.168.55.3\\product\\377169719.jpg" - this limitation is based on the JSON characteristics) */
	private ?string $pictureUrl;

	/** @var int|null Mandatory registration of the expiration date. Supported values: 0 - No, 1 - Yes */
	private ?int $expirationMandatory;

	/** @var int|null Mandatory registration of serial numbers (inbound). Supported values: 0 - No, 1 - Yes */
	private ?int $inboundMandatory;

	/** @var int|null Mandatory registration of serial numbers (outbound). Supported values: 0 - No, 1 - Yes */
	private ?int $outboundMandatory;

	/** @var  ProductBarcode[] Optional collection of product's barcodes. See chapter Product barcode for the list of possible attributes of the barcodes */
	private array $barcodes;

	public function __construct(string $productCode, string $name, int $type, string $measurementUnitCode, string $warehouseCode)
	{
		$this->productCode = $productCode;
		$this->name = $name;
		$this->type = $type;
		$this->measurementUnitCode = $measurementUnitCode;
		$this->warehouseCode = $warehouseCode;
	}

	/**
	 * @return string
	 */
	public function getProductCode(): string
	{
		return $this->productCode;
	}

	/**
	 * @return string
	 */
	public function getName(): string
	{
		return $this->name;
	}

	/**
	 * @return int
	 */
	public function getType(): int
	{
		return $this->type;
	}

	/**
	 * @return string
	 */
	public function getMeasurementUnitCode(): string
	{
		return $this->measurementUnitCode;
	}

	/**
	 * @return string
	 */
	public function getWarehouseCode(): string
	{
		return $this->warehouseCode;
	}

	/**
	 * @return float|null
	 */
	public function getWeightGross(): ?float
	{
		return $this->weightGross;
	}

	/**
	 * @param float|null $weightGross
	 * @return Product
	 */
	public function setWeightGross(?float $weightGross): Product
	{
		$this->weightGross = $weightGross;
		return $this;
	}

	/**
	 * @return float|null
	 */
	public function getWeightNett(): ?float
	{
		return $this->weightNett;
	}

	/**
	 * @param float|null $weightNett
	 * @return Product
	 */
	public function setWeightNett(?float $weightNett): Product
	{
		$this->weightNett = $weightNett;
		return $this;
	}

	/**
	 * @return float|null
	 */
	public function getHeight(): ?float
	{
		return $this->height;
	}

	/**
	 * @param float|null $height
	 * @return Product
	 */
	public function setHeight(?float $height): Product
	{
		$this->height = $height;
		return $this;
	}

	/**
	 * @return float|null
	 */
	public function getWidth(): ?float
	{
		return $this->width;
	}

	/**
	 * @param float|null $width
	 * @return Product
	 */
	public function setWidth(?float $width): Product
	{
		$this->width = $width;
		return $this;
	}

	/**
	 * @return float|null
	 */
	public function getDepth(): ?float
	{
		return $this->depth;
	}

	/**
	 * @param float|null $depth
	 * @return Product
	 */
	public function setDepth(?float $depth): Product
	{
		$this->depth = $depth;
		return $this;
	}

	/**
	 * @return float|null
	 */
	public function getVolume(): ?float
	{
		return $this->volume;
	}

	/**
	 * @param float|null $volume
	 * @return Product
	 */
	public function setVolume(?float $volume): Product
	{
		$this->volume = $volume;
		return $this;
	}

	/**
	 * @return string|null
	 */
	public function getPictureUrl(): ?string
	{
		return $this->pictureUrl;
	}

	/**
	 * @param string|null $pictureUrl
	 * @return Product
	 */
	public function setPictureUrl(?string $pictureUrl): Product
	{
		$this->pictureUrl = $pictureUrl;
		return $this;
	}

	/**
	 * @return int|null
	 */
	public function getExpirationMandatory(): ?int
	{
		return $this->expirationMandatory;
	}

	/**
	 * @param int|null $expirationMandatory
	 * @return Product
	 */
	public function setExpirationMandatory(?int $expirationMandatory): Product
	{
		$this->expirationMandatory = $expirationMandatory;
		return $this;
	}

	/**
	 * @return int|null
	 */
	public function getInboundMandatory(): ?int
	{
		return $this->inboundMandatory;
	}

	/**
	 * @param int|null $inboundMandatory
	 * @return Product
	 */
	public function setInboundMandatory(?int $inboundMandatory): Product
	{
		$this->inboundMandatory = $inboundMandatory;
		return $this;
	}

	/**
	 * @return int|null
	 */
	public function getOutboundMandatory(): ?int
	{
		return $this->outboundMandatory;
	}

	/**
	 * @param int|null $outboundMandatory
	 * @return Product
	 */
	public function setOutboundMandatory(?int $outboundMandatory): Product
	{
		$this->outboundMandatory = $outboundMandatory;
		return $this;
	}

	/**
	 * @return ProductBarcode[]
	 */
	public function getBarcodes(): array
	{
		return $this->barcodes;
	}

	/**
	 * @param ProductBarcode $barcode
	 * @return Product
	 */
	public function addBarcode(ProductBarcode $barcode): Product
	{
		$this->barcodes[] = $barcode;
		return $this;
	}

}
