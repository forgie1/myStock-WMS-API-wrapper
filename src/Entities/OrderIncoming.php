<?php

/**
 * This file is part of ArtFocus ArtCMS.
 * Copyright © 2021 Ján Forgáč <forgac@artfocus.cz>
 */

namespace MyStockWmsApiWrapper\Entities;

/**
 * Order to be created in Fulfillment
 */
class OrderIncoming
{

	/** Order number from the ERP system. Each order code must be unique
	 * @var string
	 */
	private string $orderCode;

	/**
	 * Order type:
	 *     External (1)
	 *     To supplier (10)
	 * @var int
	 */
	private int $type;

	/** Warehouse code from the ERP ("1")
	 * @var string
	 */
	private string $warehouseCode;

	/** @var string Unique identifier of the partner - ID will be generated during the creation of partner via API */
	private string $partnerId;

	/** @var string Unique identifier of the partner's operating unit - ID will be generated during the creation of partner's operating unit via API */
	private string $operatingUnitId;

	/** @var int Order's priority, higher number means higher priority of the inserted order. The priority can range from -999 to 999. Even though the box is not mandatory, some number (e.g. constant "0") has to be filled in */
	private int $priority = 0;

	/** @var \DateTime|null Scheduled date of dispatch from the warehouse (2021-01-24 00:00:00.000) */
	private ?\DateTime $dispatchDate;

	/** @var string Delivery method for the inserted order - ID will be generated during the creation of delivery method in the WMS (U0001_DPD) */
	private string $deliveryMethodCode;

	/** @var string|null Payment method (mandatory only for COD - cash on delivery) - Code will be generated during the creation of payment method in the WMS  */
	private ?string $paymentMethodCode;

	/** @var string|null Variable symbol used for distinguishing the payment (mandatory for COD, otherwise should not be filled in) */
	private ?string $variableSymbol;

	/** @var float|null numeric (16,5) Cash amount that should be paid for the inserted order (mandatory for COD, otherwise should not be filled in (123.5) */
	private ?float $cashAmount;

	/** @var string|null string (3) Code of currency that should be used for payment (mandatory for COD, otherwise should not be filled in) (CZK) */
	private ?string $currencyCode;

	/** @var string|null Delivery address (B2C) - company name */
	private ?string $company;

	/** @var string|null Delivery address (B2C) - first name of recipient */
	private ?string $firstName;

	/** @var string|null Delivery address (B2C) - second name of recipient. Mandatory if shipment is to be delivered to different address than that of the partner's operating unit. */
	private ?string $lastName;

	/** @var string|null Delivery address (B2C) - street. Mandatory if shipment is to be delivered to different address than that of the partner's operating unit (Novoveská 22) */
	private ?string $street;

	/** @var string|null Delivery address (B2C) - city. Mandatory if shipment is to be delivered to different address than that of the partner's operating unit. (Ostrava) */
	private ?string $city;

	/** @var string|null Delivery address (B2C) - ZIP code. Mandatory if shipment is to be delivered to different address than that of the partner's operating unit (70900) */
	private ?string $zip;

	/** @var string|null Delivery address (B2C) - country. Mandatory if shipment is to be delivered to different address than that of the partner's operating unit. Country code should be filled according to the ISO 3166-1 standard with alpha-2 codes (e.g. "CZ" for Czech Republic). */
	private ?string $country;

	/** @var string|null Delivery address (B2C) - e-mail of recipient. Mandatory if shipment is to be delivered to different address than that of the partner's operating unit */
	private ?string $email;

	/** @var string|null Delivery address (B2C) - phone number of recipient. Mandatory if shipment is to be delivered to different address than that of the partner's operating unit. (731123456) */
	private ?string $phone;

	/** @var string|null Code of pickup place from the selected carrier's codebook to which the order is to be delivered (B2C). Mandatory if shipment is to be delivered to carrier's pickup place */
	private ?string $pickupPlaceCode;

	/** @var Item[] Items to be send  */
	private array $items;

	/** @var string|null Partner's order reference from the ERP */
	private ?string $itemsCustomerOrderCode;

	public function __construct(string $orderCode, int $type, string $warehouseCode, string $partnerId, string $operatingUnitId)
	{
		$this->orderCode = $orderCode;
		$this->type = $type;
		$this->warehouseCode = $warehouseCode;
		$this->partnerId = $partnerId;
		$this->operatingUnitId = $operatingUnitId;
	}

	/**
	 * @return string
	 */
	public function getOrderCode(): string
	{
		return $this->orderCode;
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
	public function getWarehouseCode(): string
	{
		return $this->warehouseCode;
	}

	/**
	 * @return string
	 */
	public function getPartnerId(): string
	{
		return $this->partnerId;
	}

	/**
	 * @return string
	 */
	public function getOperatingUnitId(): string
	{
		return $this->operatingUnitId;
	}

	/**
	 * @return int
	 */
	public function getPriority(): int
	{
		return $this->priority;
	}

	/**
	 * @param int $priority
	 * @return OrderIncoming
	 */
	public function setPriority(int $priority): OrderIncoming
	{
		$this->priority = $priority;
		return $this;
	}

	/**
	 * @return \DateTime|null
	 */
	public function getDispatchDate(): ?\DateTime
	{
		return $this->dispatchDate;
	}

	/**
	 * @param \DateTime|null $dispatchDate
	 * @return OrderIncoming
	 */
	public function setDispatchDate(?\DateTime $dispatchDate): OrderIncoming
	{
		$this->dispatchDate = $dispatchDate;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getDeliveryMethodCode(): string
	{
		return $this->deliveryMethodCode;
	}

	/**
	 * @param string $deliveryMethodCode
	 * @return OrderIncoming
	 */
	public function setDeliveryMethodCode(string $deliveryMethodCode): OrderIncoming
	{
		$this->deliveryMethodCode = $deliveryMethodCode;
		return $this;
	}

	/**
	 * @return string|null
	 */
	public function getPaymentMethodCode(): ?string
	{
		return $this->paymentMethodCode;
	}

	/**
	 * @param string|null $paymentMethodCode
	 * @return OrderIncoming
	 */
	public function setPaymentMethodCode(?string $paymentMethodCode): OrderIncoming
	{
		$this->paymentMethodCode = $paymentMethodCode;
		return $this;
	}

	/**
	 * @return string|null
	 */
	public function getVariableSymbol(): ?string
	{
		return $this->variableSymbol;
	}

	/**
	 * @param string|null $variableSymbol
	 * @return OrderIncoming
	 */
	public function setVariableSymbol(?string $variableSymbol): OrderIncoming
	{
		$this->variableSymbol = $variableSymbol;
		return $this;
	}

	/**
	 * @return float|null
	 */
	public function getCashAmount(): ?float
	{
		return $this->cashAmount;
	}

	/**
	 * @param float|null $cashAmount
	 * @return OrderIncoming
	 */
	public function setCashAmount(?float $cashAmount): OrderIncoming
	{
		$this->cashAmount = $cashAmount;
		return $this;
	}

	/**
	 * @return string|null
	 */
	public function getCurrencyCode(): ?string
	{
		return $this->currencyCode;
	}

	/**
	 * @param string|null $currencyCode
	 * @return OrderIncoming
	 */
	public function setCurrencyCode(?string $currencyCode): OrderIncoming
	{
		$this->currencyCode = $currencyCode;
		return $this;
	}

	/**
	 * @return string|null
	 */
	public function getCompany(): ?string
	{
		return $this->company;
	}

	/**
	 * @param string|null $company
	 * @return OrderIncoming
	 */
	public function setCompany(?string $company): OrderIncoming
	{
		$this->company = $company;
		return $this;
	}

	/**
	 * @return string|null
	 */
	public function getFirstName(): ?string
	{
		return $this->firstName;
	}

	/**
	 * @param string|null $firstName
	 * @return OrderIncoming
	 */
	public function setFirstName(?string $firstName): OrderIncoming
	{
		$this->firstName = $firstName;
		return $this;
	}

	/**
	 * @return string|null
	 */
	public function getLastName(): ?string
	{
		return $this->lastName;
	}

	/**
	 * @param string|null $lastName
	 * @return OrderIncoming
	 */
	public function setLastName(?string $lastName): OrderIncoming
	{
		$this->lastName = $lastName;
		return $this;
	}

	/**
	 * @return string|null
	 */
	public function getStreet(): ?string
	{
		return $this->street;
	}

	/**
	 * @param string|null $street
	 * @return OrderIncoming
	 */
	public function setStreet(?string $street): OrderIncoming
	{
		$this->street = $street;
		return $this;
	}

	/**
	 * @return string|null
	 */
	public function getCity(): ?string
	{
		return $this->city;
	}

	/**
	 * @param string|null $city
	 * @return OrderIncoming
	 */
	public function setCity(?string $city): OrderIncoming
	{
		$this->city = $city;
		return $this;
	}

	/**
	 * @return string|null
	 */
	public function getZip(): ?string
	{
		return $this->zip;
	}

	/**
	 * @param string|null $zip
	 * @return OrderIncoming
	 */
	public function setZip(?string $zip): OrderIncoming
	{
		$this->zip = $zip;
		return $this;
	}

	/**
	 * @return string|null
	 */
	public function getCountry(): ?string
	{
		return $this->country;
	}

	/**
	 * @param string|null $country
	 * @return OrderIncoming
	 */
	public function setCountry(?string $country): OrderIncoming
	{
		$this->country = $country;
		return $this;
	}

	/**
	 * @return string|null
	 */
	public function getEmail(): ?string
	{
		return $this->email;
	}

	/**
	 * @param string|null $email
	 * @return OrderIncoming
	 */
	public function setEmail(?string $email): OrderIncoming
	{
		$this->email = $email;
		return $this;
	}

	/**
	 * @return string|null
	 */
	public function getPhone(): ?string
	{
		return $this->phone;
	}

	/**
	 * @param string|null $phone
	 * @return OrderIncoming
	 */
	public function setPhone(?string $phone): OrderIncoming
	{
		$this->phone = $phone;
		return $this;
	}

	/**
	 * @return string|null
	 */
	public function getPickupPlaceCode(): ?string
	{
		return $this->pickupPlaceCode;
	}

	/**
	 * @param string|null $pickupPlaceCode
	 * @return OrderIncoming
	 */
	public function setPickupPlaceCode(?string $pickupPlaceCode): OrderIncoming
	{
		$this->pickupPlaceCode = $pickupPlaceCode;
		return $this;
	}

	/**
	 * @return Item[]
	 */
	public function getItems(): array
	{
		return $this->items;
	}

	/**
	 * @param Item $item
	 * @return OrderIncoming
	 */
	public function addItem(Item $item): OrderIncoming
	{
		$this->items[] = $item;
		return $this;
	}

	/**
	 * @return string|null
	 */
	public function getItemsCustomerOrderCode(): ?string
	{
		return $this->itemsCustomerOrderCode;
	}

	/**
	 * @param string|null $itemsCustomerOrderCode
	 * @return OrderIncoming
	 */
	public function setItemsCustomerOrderCode(?string $itemsCustomerOrderCode): OrderIncoming
	{
		$this->itemsCustomerOrderCode = $itemsCustomerOrderCode;
		return $this;
	}

}
