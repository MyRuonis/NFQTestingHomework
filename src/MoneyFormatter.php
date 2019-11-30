<?php

declare(strict_types=1);

namespace MoneyFormatter;

use NumberFormatter\NumberFormatter;

class MoneyFormatter
{
    private $numberFormatter;

    public function __construct(NumberFormatter $numberForm)
    {
        $this->numberFormatter = $numberForm;
    }

    public function formatEur($float): string
    {
        return $this->numberFormatter->formatNumber($float) . " €";
    }

    public function formatUsd($float): string
    {
        return "$" . $this->numberFormatter->formatNumber($float);
    }
}