<?php
/**
 * 2007-2016 [PagSeguro Internet Ltda.]
 *
 * NOTICE OF LICENSE
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 *
 * @author    PagSeguro Internet Ltda.
 * @copyright 2007-2016 PagSeguro Internet Ltda.
 * @license   http://www.apache.org/licenses/LICENSE-2.0
 *
 */

namespace PagSeguro\Parsers\Transaction\Notification;

use PagSeguro\Parsers\Error;
use PagSeguro\Parsers\Parser;
use PagSeguro\Parsers\Transaction\Response;
use PagSeguro\Resources\Http;

/**
 * Class Request
 * @package PagSeguro\Parsers\Transaction\Notification
 */
class Request extends Error implements Parser
{
    /**
     * @param \PagSeguro\Resources\Http $http
     * @return Response
     */
    public static function success(Http $http)
    {
        $xml = simplexml_load_string($http->getResponse());

        $response = new Response();
        $response->setDate($xml->date)
            ->setCode($xml->code)
            ->setReference($xml->reference)
            ->setType($xml->type)
            ->setStatus($xml->status)
            ->setLastEventDate($xml->lastEventDate)
            ->setPaymentMethod($xml->paymentMethod)
            ->setGrossAmount($xml->grossAmount)
            ->setDiscountAmount($xml->discountAmount)
            ->setCreditorFees($xml->creditorFees)
            ->setNetAmount($xml->netAmount)
            ->setExtraAmount($xml->extraAmount)
            ->setEscrowEndDate($xml->escrowEndDate)
            ->setInstallmentCount($xml->installmentCount)
            ->setItemCount($xml->itemCount)
            ->setItems($xml->items)
            ->setSender($xml->sender)
            ->setShipping($xml->shipping);
        return $response;
    }

    /**
     * @param \PagSeguro\Resources\Http $http
     * @return \PagSeguro\Domains\Error
     */
    public static function error(Http $http)
    {
        $error = parent::error($http);
        return $error;
    }
}
