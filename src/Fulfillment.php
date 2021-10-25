<?php

/**
 * This file is part of ArtFocus ArtCMS.
 * Copyright © 2021 Ján Forgáč <forgac@artfocus.cz>
 */

namespace FulfillmentByAuthentica;

use FulfillmentByAuthentica\Entities\OperatingUnit;
use FulfillmentByAuthentica\Entities\OrderIncoming;
use FulfillmentByAuthentica\Entities\Partner;
use FulfillmentByAuthentica\Entities\Product;
use FulfillmentByAuthentica\Entities\ProductBarcode;
use FulfillmentByAuthentica\Responses\Response;
use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use Psr\Http\Message\ResponseInterface;

class Fulfillment
{

	const TEST_ENDPOINT = 'https://authenticatest.wmsint.mystock.cz:9351/myStockInterfaceAuthenticaTest/V1/';
	const PRODUCTION_ENDPOINT = '';

	private string $username;

	private string $password;

	private bool $testMode = false;

	public function __construct(string $username, string $password, bool $testMode = false)
	{
		$this->username = $username;
		$this->password = $password;
		$this->testMode = $testMode;
	}

	public function createProduct(Product $product): Response
	{
		return $this->sendRequest('product', $this->productToArray($product));
	}

	public function updateProduct(Product $product, string $productId): Response
	{
		return $this->sendRequest('product', $this->productToArray($product), 'PUT', $productId);
	}

	public function createBarcode(ProductBarcode $barcode): Response
	{
		$data = $this->barcodesToArray([$barcode]);
		return $this->sendRequest('productBarcode', reset($data));
	}

	public function updateBarcode(ProductBarcode $barcode): Response
	{
		$data = $this->barcodesToArray([$barcode]);
		return $this->sendRequest('productBarcode', reset($data), 'PUT', '??????');
	}

	public function createPartner(Partner $partner): Response
	{
		$data[] = '';

		return $this->sendRequest('partner', $data);
	}

	public function updatePartner(Partner $partner): Response
	{
		$data[] = '';

		return $this->sendRequest('partner', $data, 'PUT', $partner->getCode());
	}

	public function createPartnerOperatingUnit(OperatingUnit $operatingUnit): Response
	{
		$data[] = '';

		return $this->sendRequest('partnerOperatingUnit', $data);
	}

	public function updatePartnerOperatingUnit(OperatingUnit $operatingUnit): Response
	{
		$data[] = '';

		return $this->sendRequest('partnerOperatingUnit', $data, 'PUT', $operatingUnit->getCode());
	}

	public function createOrderIncoming(OrderIncoming $orderIncoming): Response
	{
		$data[] = '';

		return $this->sendRequest('orderIncoming', $data);
	}

	private function sendRequest(string $service, array $data, string $method = 'POST', ?string $id = null): Response
	{
		$url = $this->testMode ?
			self::TEST_ENDPOINT :
			self::PRODUCTION_ENDPOINT;
		$url .= $service;

		if ($id) {
			$url .= $url . '/' . $id;
		}

		$options[RequestOptions::AUTH] = [$this->username, $this->password];
		$options[RequestOptions::JSON] = $data;

		$client = new Client();
		$response = $client->request($method, $url, $options);

		return $this->parseResponse($response);
	}

	private function parseResponse(ResponseInterface $response): Response
	{

	}

	// help methods

	private function productToArray(Product $product): array
	{
		$data = [
			'productCode' => $product->getProductCode(),
			'name' => $product->getName(),
			'type' => $product->getType(),
			'measurementUnitCode' => $product->getMeasurementUnitCode(),
			'warehouseCode' => $product->getWarehouseCode(),
		];

		if ($product->getWeightGross()) {
			$data['weightGross'] = $product->getWeightGross();
		}
		if ($product->getWeightNett()) {
			$data['weightNett'] = $product->getWeightNett();
		}
		if ($product->getHeight()) {
			$data['grossDimension']['height'] = $product->getHeight();
		}
		if ($product->getWidth()) {
			$data['grossDimension']['width'] = $product->getWidth();
		}
		if ($product->getDepth()) {
			$data['grossDimension']['depth'] = $product->getDepth();
		}
		if ($product->getVolume()) {
			$data['grossDimension']['volume'] = $product->getVolume();
		}
		if ($product->getPictureUrl()) {
			$data['pictureUrl'] = $product->getPictureUrl();
		}
		if ($product->getExpirationMandatory()) {
			$data['expirationMandatory'] = $product->getExpirationMandatory();
		}
		if ($product->getInboundMandatory()) {
			$data['serialNumbersRecords']['inboundMandatory'] = $product->getInboundMandatory();
		}
		if ($product->getOutboundMandatory()) {
			$data['serialNumbersRecords']['outboundMandatory'] = $product->getOutboundMandatory();
		}

		if ($product->getBarcodes()) {
			$data['barcodes'] = $this->barcodesToArray($product->getBarcodes());
		}

		return $data;
	}

	/**
	 * @param ProductBarcode[] $barcodes
	 * @return array
	 */
	private function barcodesToArray(array $barcodes): array
	{
		$items = [];
		foreach ($barcodes as $barCode) {
			$item['barcode'] = $barCode->getBarcode();
			$item['default'] = $barCode->getDefault();
			if ($barCode->getMeasurementUnitCode()) {
				$item['measurementUnitCode'] = $barCode->getMeasurementUnitCode();
			}
			if ($barCode->getActive() !== null) {
				$item['active'] = $barCode->getActive();
			}

			$items[] = $item;
		}

		return $items;
	}

}
