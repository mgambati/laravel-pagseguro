<?php

namespace laravel\pagseguro\Tests\Unit\Checkout;

use laravel\pagseguro\Address\Address;
use laravel\pagseguro\Checkout\SimpleCheckout;
use laravel\pagseguro\Document\DocumentCollection;
use laravel\pagseguro\Item\ItemCollection;
use laravel\pagseguro\Phone\Phone;
use laravel\pagseguro\Sender\Sender;
use laravel\pagseguro\Shipping\Shipping;

/**
 * Checkout Test Base
 * @author Isaque de Souza <isaquesb@gmail.com>
 */
class CheckoutBase extends \PHPUnit_Framework_TestCase
{
    /**
     * @var SimpleCheckout
     */
    protected $checkout;

    /**
     * SetUp
     */
    public function setUp()
    {
        $items = $this->getItems();
        $sender = $this->getSender();
        $shipping = $this->getShipping();
        $this->checkout = new SimpleCheckout($items, $sender, $shipping);
    }

    /**
     * Get Items to Test
     */
    public function getItems()
    {
        return ItemCollection::factory([
            [
                'id' => '18',
                'description' => 'Laravel PS',
                'quantity' => '40',
                'amount' => '784.6',
                'weight' => '45',
                'shippingCost' => '666',
                'width' => '665',
                'height' => '445',
                'length' => '669',
            ],
        ]);
    }

    /**
     * Get Sender to Test
     */
    public function getSender()
    {
        $data = [
            'email' => 'isaquesb@gmail.com',
            'name' => 'Isaque de Souza Barbosa',
            'documents' => [
                [
                    'number' => '80808080822',
                    'type' => 'CPF'
                ]
            ],
            'phone' => '11985445522',
            'bornDate' => '1988-03-25',
        ];
        return new Sender($data);
    }

    /**
     * Get Shipping to Test
     */
    public function getShipping()
    {
        $data = [
            'address' => new Address([
                'postalCode' => '06410030',
                'street' => 'Rua da Selva',
                'number' => '12',
                'district' => 'Jardim dos Camargos',
                'city' => 'Barueri',
                'state' => 'SP',
                'country' => 'BRA',
            ]),
            'type' => 2,
            'cost' => 30.4,
        ];
        return new Shipping($data);
    }
}
