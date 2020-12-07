<?php
/**
 * Yoo.Kassa driver for Omnipay payment processing library
 *
 * @link      https://github.com/hiqdev/omnipay-yoo-kassa
 * @package   omnipay-yoo-kassa
 * @license   MIT
 * @copyright Copyright (c) 2019, HiQDev (http://hiqdev.com/)
 */

namespace Omnipay\YooKassa\Message;

use Omnipay\Common\Exception\InvalidResponseException;
use Omnipay\Common\Message\ResponseInterface;

/**
 * Class DetailsRequest.
 *
 */
class DetailsRequest extends AbstractRequest
{
    public function getData()
    {
        $this->validate('transactionReference');

        return [];
    }

    /**
     * Send the request with specified data.
     *
     * @param  mixed $data The data to send
     * @throws InvalidResponseException
     * @return DetailsResponse|ResponseInterface
     */
    public function sendData($data): ResponseInterface
    {
        try {
            $response = $this->client->getPaymentInfo($this->getTransactionReference());

            return new DetailsResponse($this, $response);
        } catch (\Throwable $e) {
            throw new InvalidResponseException(
                'Error communicating with payment gateway: ' . $e->getMessage(),
                $e->getCode()
            );
        }
    }
}
