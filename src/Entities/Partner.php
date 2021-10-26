<?php

/**
 * This file is part of ArtFocus ArtCMS.
 * Copyright © 2021 Ján Forgáč <forgac@artfocus.cz>
 */

namespace MyStockWmsApiWrapper\Entities;

/**
 * Partner = Customer or Supplier
 */
class Partner
{

	/** @var string Partner code from the ERP - a unique identifier that cannot be changed over time, it is used to identify a partner in the WMS. The code is displayed to warehouse operators on mobile devices and is printed in reports. */
	private string $code;

	/** @var int Supported partner types: 0 - Not specified, 1 - Customer, 2 - Supplier, 3 - Customer and supplier */
	private int $type;

	/** @var string [string (150)] Name of the partner */
	private string $name;

	/** @var string|null string (20) Short name of the partner, if the box is not filled in, the WMS uses first 20 characters from the partner's name as the short name */
	private ?string $nameShort;

	/** @var string|null Partner's registration number. The registration number must be unique - if the same registration number is already used with different partner, the entry will not be imported into the WMS. Registration number cannot be longer than 15 characters and can contain only capital letters and numbers (no spaces are permitted) (ICO12345) */
	private ?string $companyRegistrationId;

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

	/** @var bool Defines if the partner is active. Supported values: 0 - No, 1 - Yes. If no value is filled, the partner is inserted as active */
	private bool $active = true;

	/** @var OperatingUnit[] Optional collection of partner's operating units */
	private array $operatingUnits;

	public function __construct(string $code, int $type, string $name)
	{
		$this->code = $code;
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
	public function getNameShort(): ?string
	{
		return $this->nameShort;
	}

	/**
	 * @param string|null $nameShort
	 * @return Partner
	 */
	public function setNameShort(?string $nameShort): Partner
	{
		$this->nameShort = $nameShort;
		return $this;
	}

	/**
	 * @return string|null
	 */
	public function getCompanyRegistrationId(): ?string
	{
		return $this->companyRegistrationId;
	}

	/**
	 * @param string|null $companyRegistrationId
	 * @return Partner
	 */
	public function setCompanyRegistrationId(?string $companyRegistrationId): Partner
	{
		$this->companyRegistrationId = $companyRegistrationId;
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
	 * @return Partner
	 */
	public function setStreet(?string $street): Partner
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
	 * @return Partner
	 */
	public function setCity(?string $city): Partner
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
	 * @return Partner
	 */
	public function setZip(?string $zip): Partner
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
	 * @return Partner
	 */
	public function setCountry(string $country): Partner
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
	 * @return Partner
	 */
	public function setEmail(?string $email): Partner
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
	 * @return Partner
	 */
	public function setPhone(?string $phone): Partner
	{
		$this->phone = $phone;
		return $this;
	}

	/**
	 * @return bool
	 */
	public function isActive(): bool
	{
		return $this->active;
	}

	/**
	 * @param bool $active
	 * @return Partner
	 */
	public function setActive(bool $active): Partner
	{
		$this->active = $active;
		return $this;
	}

	/**
	 * @return OperatingUnit[]
	 */
	public function getOperatingUnits(): array
	{
		return $this->operatingUnits;
	}

	/**
	 * @param OperatingUnit $operatingUnit
	 * @return Partner
	 */
	public function addOperatingUnit(OperatingUnit $operatingUnit): Partner
	{
		$this->operatingUnits[] = $operatingUnit;
		return $this;
	}

}
