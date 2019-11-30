<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use NumberFormatter\NumberFormatter;

class NumberFormatterTest extends PHPUnit\Framework\TestCase
{
    private $sut;

    public function setUp(): void
    {
        $this->sut = new NumberFormatter($this->getNumberFormatterMock());
    }

    private function getNumberFormatterMock()
    {
        $mock = $this->getMockBuilder(NumberFormatter::class)
            ->disableOriginalConstructor()
            ->getMock();

        return $mock;
    }

    public function testIfValueIsReturned()
    {
        $input = 1000000;
        $this->assertNotEmpty($this->sut->formatNumber($input));
    }

    public function testNoValue()
    {
        $this->expectException(TypeError::class);

        $this->sut->formatNumber(null);
    }

    public function testValueOverMillion()
    {
        $input = 2340000;
        $output = "2.34M";

        $this->assertEquals($output, $this->sut->formatNumber($input));
    }

    public function testValueBelowMillionAbove100K()
    {
        $input = 234000;
        $output = "234K";

        $this->assertEquals($output, $this->sut->formatNumber($input));
    }

    public function testBelow100KAbove1K()
    {
        $input = 27533.78;
        $output = "27 534";

        $this->assertEquals($output, $this->sut->formatNumber($input));
    }

    public function testBelow1K()
    {
        $input = 533.1 ;
        $output = "533.10";

        $this->assertEquals($output, $this->sut->formatNumber($input));
    }

    public function testNegative()
    {
        $input = -123654.89 ;
        $output = "-124K";

        $this->assertEquals($output, $this->sut->formatNumber($input));
    }

}