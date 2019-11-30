<?php
declare(strict_types=1);

use MoneyFormatter\MoneyFormatter;
use NumberFormatter\NumberFormatter;
use PHPUnit\Framework\TestCase;

class MoneyFormatterTest extends PHPUnit\Framework\TestCase
{
    private $sut;

    public function setUp(): void
    {
        $this->sut = new MoneyFormatter($this->getNumberFormatterMock());
    }

    private function getNumberFormatterMock()
    {
        $mock = $this->getMockBuilder(NumberFormatter::class)
            ->setMethods(['formatNumber'])
            ->getMock();

        $mock->method('formatNumber')
            ->with(2835779)
            ->willReturn("2.84M");

        return $mock;
    }

    public function testEuro()
    {
        $input = 2835779;
        $output = "2.84M €";

        $this->assertEquals($output, $this->sut->formatEur($input));
    }

    public function testUsd()
    {
        $input = 2835779;
        $output = "$2.84M";

        $this->assertEquals($output, $this->sut->formatUsd($input));
    }

}