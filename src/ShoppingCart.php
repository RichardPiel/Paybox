<?php

namespace Paybox;

class ShoppingCart
{

    /**
     * @var int
     */
    private $totalQuantity;
 
    public function __construct(
        string $totalQuantity
     
    ) {
        $this->totalQuantity = max(1, min($totalQuantity, 99));
    }

    /**
     * Return the values of the billing address formatted for Paybox
     *
     * @return string
     */
    public function getValues(): string
    {
       
        return str_replace(array("\r", "\n", "    "), '', "
            <shoppingcart>
                <total>
                    <totalQuantity>{$this->totalQuantity}</totalQuantity>
                </total>
            </shoppingcart>
        ");
    }

}
