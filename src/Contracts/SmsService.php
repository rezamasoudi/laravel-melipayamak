<?php

namespace Masoudi\Melipayamak\Contracts;

use SoapClient;

abstract class SmsService
{
    protected SoapClient $client;
    protected string $username;
    protected string $password;

    /**
     * > This function takes a SoapClient object as a parameter and assigns it to the client property
     *
     * @param SoapClient client The SoapClient object that will be used to make the SOAP calls.
     */
    public function __construct(SoapClient $client)
    {
        $this->client = $client;
    }

    public function setUser(string $username, string $password): SmsService
    {
        $this->username = $username;
        $this->password = $password;

        return $this;
    }
}
