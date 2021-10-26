<?php

/**
 * This file is part of ArtFocus ArtCMS.
 * Copyright © 2021 Ján Forgáč <forgac@artfocus.cz>
 */

namespace MyStockWmsApiWrapper\Entities;

/**
 * Address of the partner
 */
class OperatingUnit
{

	/** @var string Operating unit code from the ERP - a unique identifier that cannot be changed over time, it is used to identify partner's operating unit in the WMS. The code is displayed to warehouse operators on mobile devices and is printed in reports. */
	private string $code;

	/** @var string Unique identifier of the partner - ID will be generated during the creation of partner via API */
	private string $partnerId;

	/** @var int Supported operating unit types: 0 - Not specified, 1 - Customer, 2 - Supplier, 3 - Customer and supplier */
	private int $type;

	/** @var string [string (150)] Name of the operating unit (Provozní jednotka 2) */
	private string $name;

	/** @var string|null (Novoveská 22) */
	private ?string $street;

	/** @var string|null (Ostrava) */
	private ?string $city;

	/** @var string|null (70900) */
	private ?string $zip;

	/** @var string Country code should be filled according to the ISO 3166-1 standard with alpha-2 codes (e.g. "CZ" for Czech Republic) */
	private string $country;

	/** @var string|null */
	private ?string $email;

	/** @var string|null (731123456) */
	private ?string $phone;

	public function __construct(string $code, string $partnerId, int $type, string $name)
	{
		$this->code = $code;
		$this->partnerId = $partnerId;
		$this->type = $type;
		$this->name = $name;
	}

	/**
	 * @return string
	 */
	public function getCode(): string
	{
		return $this->code;
	}

	/**
	 * @return string
	 */
	public function getPartnerId(): string
	{
		return $this->partnerId;
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
	public function getName(): string
	{
		return $this->name;
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
	 * @return OperatingUnit
	 */
	public function setStreet(?string $street): OperatingUnit
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
	 * @return OperatingUnit
	 */
	public function setCity(?string $city): OperatingUnit
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
	 * @return OperatingUnit
	 */
	public function setZip(?string $zip): OperatingUnit
	{
		$this->zip = $zip;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getCountry(): string
	{
		return $this->country;
	}

	/**
	 * @param string $country
	 * @return OperatingUnit
	 */
	public function setCountry(string $country): OperatingUnit
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
	 * @return OperatingUnit
	 */
	public function setEmail(?string $email): OperatingUnit
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
	 * @return OperatingUnit
	 */
	public function setPhone(?string $phone): OperatingUnit
	{
		$this->phone = $phone;
		return $this;
	}

}
