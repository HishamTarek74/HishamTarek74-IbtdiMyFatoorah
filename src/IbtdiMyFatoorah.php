<?php

namespace HishamTarek\IbtdiMyFatoorah;

use HishamTarek\IbtdiMyFatoorah\Services\IbtdiMyFatoorahService;

class IbtdiMyFatoorah extends IbtdiMyFatoorahService
{
    /**
     * @var $payment
     */
    protected $payment;

    /**
     * Create new invoice
     *
     * @param array $data
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function createInvoice(array $data)
    {
        try {
            $this->endpoint = 'SendPayment';

            /**
             *  @var Illuminate\Http\Client\Response $response
             */

            $response = $this->getClient()->post($this->getFullUrl(), $data);

        } catch (\Exception $exception) {
            throw new \Exception($exception->getMessage());
        }

        throw_unless(
            $response->successful(),
            $response->throw()
        );

        return $response->json();
    }

    /**
     * Payment
     *
     * @param $payment_id
     * @return mixed
     * @throws \Exception
     */
    public function payment($payment_id)
    {
        try {
            $this->endpoint = 'GetPaymentStatus';

            $this->payment = $this->getClient()->post($this->getFullUrl(), [
                'KeyType' => 'PaymentId',
                'Key' => $payment_id,
            ]);
        } catch (\Exception $exception) {
            throw new \Exception($exception->getMessage());
        }

        return $this;
    }

    /**
     * Get payment
     *
     * @return mixed
     */
    public function get()
    {
        return $this->payment ? $this->payment->json() : null;
    }

    /**
     * Check that payment status is success
     *
     * @return bool
     * @throws \Exception
     */
    public function isSuccess()
    {
        $response = $this->payment;

        return (data_get($response, 'IsSuccess') != true || data_get($response, 'Data.InvoiceStatus') != 'Paid') ? false : true;
    }
}