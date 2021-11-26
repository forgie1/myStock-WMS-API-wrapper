<?php

/**
 * This file is part of ArtFocus ArtCMS.
 * Copyright © 2021 Ján Forgáč <forgac@artfocus.cz>
 */

namespace MyStockWmsApiWrapper;

use MyStockWmsApiWrapper\Entities\MyStockWrapOperatingUnit;
use MyStockWmsApiWrapper\Entities\MyStockWrapOrderIncoming;
use MyStockWmsApiWrapper\Entities\MyStockWrapPartner;
use MyStockWmsApiWrapper\Entities\MyStockWrapProduct;
use MyStockWmsApiWrapper\Entities\MyStockWrapProductBarcode;
use MyStockWmsApiWrapper\Responses\Error;
use MyStockWmsApiWrapper\Responses\Response;
use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use MyStockWmsApiWrapper\Responses\ResponseId;
use Psr\Http\Message\ResponseInterface;

class MyStockClient
{

	const TEST_ENDPOINT = 'https://authenticatest.wmsint.mystock.cz:9351/myStockInterfaceAuthenticaTest/V1/';
	const PRODUCTION_ENDPOINT = 'https://authentica.wmsint.mystock.cz:9341/myStockInterfaceAuthentica/V1/';

	private ?MyStockLoggerI $logger = null;

	private string $username;

	private string $password;

	private string $endPoint;

	public function __construct(string $username, string $password, bool $testMode = true)
	{
		$this->username = $username;
		$this->password = $password;

		$this->endPoint = $testMode ? self::TEST_ENDPOINT : self::PRODUCTION_ENDPOINT;
	}

	/**
	 * @param MyStockLoggerI|null $logger
	 * @return $this
	 */
	public function setLogger(?MyStockLoggerI $logger)
	{
		$this->logger = $logger;
		return $this;
	}

	// Base API communication

	public function createProduct(MyStockWrapProduct $product): Response
	{
		return $this->sendRequest('product', $this->productToArray($product));
	}

	public function updateProduct(MyStockWrapProduct $product, string $productId): Response
	{
		return $this->sendRequest('product', $this->productToArray($product, true), 'PUT', $productId);
	}

	public function createBarcode(MyStockWrapProductBarcode $barcode): Response
	{
		$data = $this->barcodesToArray([$barcode]);
		return $this->sendRequest('productBarcode', reset($data));
	}

	public function updateBarcode(MyStockWrapProductBarcode $barcode, string $barcodeId): Response
	{
		$data = $this->barcodesToArray([$barcode], true);
		return $this->sendRequest('productBarcode', reset($data), 'PUT', $barcodeId);
	}

	public function createPartner(MyStockWrapPartner $partner): Response
	{
		$data = $this->partnerToArray($partner);
		return $this->sendRequest('partner', $data);
	}

	public function updatePartner(MyStockWrapPartner $partner): Response
	{
		$data = $this->partnerToArray($partner);
		return $this->sendRequest('partner', $data, 'PUT', $partner->getWmsPartnerId());
	}

	public function createPartnerOperatingUnit(MyStockWrapOperatingUnit $operatingUnit): Response
	{
		throw new \Exception('Not implemented method ' . __METHOD__ . ' , implement it first.');
		$data[] = '';
		return $this->sendRequest('partnerOperatingUnit', $data);
	}

	public function updatePartnerOperatingUnit(MyStockWrapOperatingUnit $operatingUnit): Response
	{
		throw new \Exception('Not implemented method ' . __METHOD__ . ' , implement it first.');
		$data[] = '';
		return $this->sendRequest('partnerOperatingUnit', $data, 'PUT', $operatingUnit->getCode());
	}

	public function createOrderIncoming(MyStockWrapOrderIncoming $orderIncoming): Response
	{
		return $this->sendRequest('orderIncoming', $this->orderIncomingToArray($orderIncoming));
	}

	private function sendRequest(string $service, array $data, string $method = 'POST', ?string $id = null): Response
	{
		$url = $this->endPoint;
		$url .= $service;

		if ($id) {
			$url .= '/' . $id;
		}

		$options[RequestOptions::AUTH] = [$this->username, $this->password];
		$options[RequestOptions::JSON] = $data;
		$options[RequestOptions::HTTP_ERRORS] = false;

		$this->logger?->logg('request endpoint', [$url]);
		$this->logger?->logg('request data', $data);

		$client = new Client();
		$response = $client->request($method, $url, $options);

		return $this->parseResponse($response);
	}

	private function parseResponse(ResponseInterface $rawResponse): Response
	{
		$response = new Response($rawResponse->getStatusCode());

		$body = json_decode($rawResponse->getBody()->getContents());
		if (isset($body->data->ids)) {
			foreach ($body->data->ids as $id) {
				$response->addResponseId(new ResponseId($id->id, $id->recordId, $id->type));
			}
		}
		if (isset($body->errors) && count($body->errors)) {
			foreach ($body->errors as $error) {
				$response->addError(new Error($error->errorText, $error->errorType, $error->propertyName, $error->recordId ?? '', $error->recordType ?? ''));
			}
		}

		$this->logger?->logg('response', [$response]);
		$this->logger?->logg('response code', [$response->getCode()]);
		$this->logger?->logg('response body', is_array($body) ? $body : [$body]);

		return $response;
	}

	// convert to array methods

	private function orderIncomingToArray(MyStockWrapOrderIncoming $orderIncoming): array
	{
		// basics
		$data = [
			'orderCode' => $orderIncoming->getOrderCode(),
			'partnerId' => $orderIncoming->getPartnerId(),
			'type' => $orderIncoming->getType(),
			'warehouseCode' => $orderIncoming->getWarehouseCode(),
			'deliveryMethodCode' => $orderIncoming->getDeliveryMethodCode(),
		];

		// services
		if ($orderIncoming->getPaymentMethodCode()) {
			$data['paymentMethodCode'] = $orderIncoming->getPaymentMethodCode();
			if ($orderIncoming->getCashAmount()) {
				$data['paymentInformation'] = [
					'variableSymbol' => $orderIncoming->getVariableSymbol(),
					'cashAmount' => $orderIncoming->getCashAmount(),
					'currencyCode' => $orderIncoming->getCurrencyCode(),
				];
			}
		}

		// destination
		$data['partyIdentification'] = [
			'company' => $orderIncoming->getCompany(),
			'firstName' => $orderIncoming->getFirstName(),
			'lastName' => $orderIncoming->getLastName(),
			'street' => $orderIncoming->getStreet(),
			'city' => $orderIncoming->getCity(),
			'zip' => $orderIncoming->getZip(),
			'country' => $orderIncoming->getCountry(),
			'email' => $orderIncoming->getEmail(),
			'phone' => $orderIncoming->getPhone(),
		];

		// items
		$items = [];
		foreach ($orderIncoming->getItems() as $item) {
			$item = [
				'productId' => $item->getProductId(),
				'amount' => ['quantity' => $item->getAmountQuantity(), 'measurementUnitCode' => $item->getAmountMeasurementUnitCode()],
			];
			$items[] = $item;
		}
		$data['items'] = $items;

		return $data;
	}

	private function partnerToArray(MyStockWrapPartner $partner): array
	{
		$data = [
			'code' => $partner->getCode(),
			'type' => $partner->getType(),
			'name' => $partner->getName(),
		];

		if ($partner->getCompanyRegistrationId()) {
			$data['companyRegistrationId'] = $partner->getCompanyRegistrationId();
		}
		if ($partner->getStreet()) {
			$data['partyIdentification']['street'] = $partner->getStreet();
		}
		if ($partner->getCity()) {
			$data['partyIdentification']['city'] = $partner->getCity();
		}
		if ($partner->getZip()) {
			$data['partyIdentification']['zip'] = $partner->getZip();
		}
		if ($partner->getCountry()) {
			$data['partyIdentification']['country'] = $partner->getCountry();
		}
		if ($partner->getEmail()) {
			$data['partyIdentification']['email'] = $partner->getEmail();
		}
		if ($partner->getPhone()) {
			$data['partyIdentification']['phone'] = $partner->getPhone();
		}
		$data['active'] = (int)$partner->isActive();

		return $data;
	}

	private function productToArray(MyStockWrapProduct $product, bool $update = false): array
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
	 * @param MyStockWrapProductBarcode[] $barcodes
	 * @param bool $update
	 * @return array
	 */
	private function barcodesToArray(array $barcodes, bool $update = false): array
	{
		$items = [];
		foreach ($barcodes as $barCode) {
			$item['productId'] = $barCode->getProductId();
			if (!$update) {
				$item['barcode'] = $barCode->getBarcode();
			}
			$item['default'] = (int)$barCode->getDefault();
			if ($barCode->getMeasurementUnitCode()) {
				$item['measurementUnitCode'] = $barCode->getMeasurementUnitCode();
			}
			if ($barCode->getActive() !== null) {
				$item['active'] = (int)$barCode->getActive();
			}

			$items[] = $item;
		}

		return $items;
	}

}
