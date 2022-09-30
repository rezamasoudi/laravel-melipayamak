<?php

namespace Masoudi\Melipayamak;

use Masoudi\Melipayamak\Contracts\PatternableSmsService;
use Masoudi\Melipayamak\Contracts\SmsService;

class MeliPayamak extends SmsService implements PatternableSmsService
{
    public function sendPatternSms(string $phone, string $pattern, array $params)
    {
        $params = [
            'username' => $this->username,
            'password' => $this->password,
            'text' => implode(';', $params),
            'to' => $phone,
            'bodyId' => $pattern,
        ];

        return $this->client->SendByBaseNumber2($params)->SendByBaseNumber2Result;
    }
}
