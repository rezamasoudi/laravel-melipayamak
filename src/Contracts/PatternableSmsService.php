<?php

namespace Masoudi\Melipayamak\Contracts;

interface PatternableSmsService
{
    /**
     * Send pattern SMS
     *
     * @param  string  $phone
     * @param  string  $pattern
     * @param  array  $params
     */
    public function sendPatternSms(string $phone, string $pattern, array $params);
}
