<?php

namespace Paybox;

class BillingAddress
{

    /**
     * @var string
     */
    private $firtName;

    /**
     * @var string
     */
    private $lastName;

    /**
     * @var string
     */
    private $address;

    /**
     * @var string|null
     */
    private $addressMore;

    /**
     * @var string
     */
    private $zipCode;

    /**
     * @var string
     */
    private $city;

    /**
     * @var string
     */
    private $country;

    /**
     *
     * @param string $firtName
     * @param string $lastName
     * @param string $address
     * @param string|null $addressMore
     * @param string $zipCode
     * @param string $city
     * @param string $country
     */
    public function __construct(
        string $firtName,
        string $lastName,
        string $address,
        string $addressMore = null,
        string $zipCode,
        string $city,
        string $country
    ) {
        $this->firtName = Utils::formatTextValue($firtName, 'ANP', 30);
        $this->lastName = Utils::formatTextValue($lastName, 'ANP', 30);
        $this->address = Utils::formatTextValue($address, 'ANS', 50);
        $this->addressMore = Utils::formatTextValue($addressMore, 'ANS', 50);
        $this->zipCode = Utils::formatTextValue($zipCode, 'ANS', 16);
        $this->city = Utils::formatTextValue($city, 'ANS', 50);
        $this->country = Utils::formatTextValue($country, 'N', 3);
    }

    /**
     * Return the values of the billing address formatted for Paybox
     *
     * @return string
     */
    public function getValues(): string
    {
       
        return str_replace(array("\r", "\n", "    "), '', "
            <Billing>
                <Address>
                    <FirstName>{$this->firtName}</FirstName>
                    <LastName>{$this->lastName}</LastName>
                    <Address1>{$this->address}</Address1>
                    <Address2>{$this->addressMore}</Address2>
                    <City>{$this->city}</City>
                    <ZipCode>{$this->zipCode}</ZipCode>
                    <CountryCode>{$this->country}</CountryCode>
                </Address>
            </Billing>
        ");
    }

}
