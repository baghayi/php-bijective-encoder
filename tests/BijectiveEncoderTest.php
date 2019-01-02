<?php

declare(strict_types=1);

namespace Test;

use PHPUnit\Framework\TestCase;
use Baghayi\BijectiveEncoder\BijectiveEncoder;

class BijectiveEncoderTest extends TestCase
{

    /**
     * @test
     */
    public function it_uses_first_provided_chars_for_data_number_zero()
    {
        $service = new BijectiveEncoder;
        $service->overwriteDefaultChars('def');
        $this->assertEquals($service->encode(0), 'd');
    }

    /**
     * @test
     * @expectedException \InvalidArgumentException
     */
    public function negative_numbers_are_not_supported()
    {
        $service = new BijectiveEncoder;
        $service->encode(-1);
    }

    /**
     * @test
     */
    public function decodes_encoded_data()
    {
        $service = new BijectiveEncoder;
        $data = 1;
        $code = $service->encode($data);

        $this->assertNotEquals($code, $data);
        $this->assertEquals($data, $service->decode($code));
    }


    /**
     * @test
     */
    public function encode_using_provided_chars() 
    {
        $service = new BijectiveEncoder;
        $service->overwriteDefaultChars('def');
        $this->assertEquals($service->encode(1), 'e');
        $this->assertEquals($service->encode(2), 'f');
    }


    public function test_encoding_something()
    {
        $service = new BijectiveEncoder;
        $service->overwriteDefaultChars('vjo1l8m3cp94gkrixntbe0z6s27u5yfwhadq');

        $data = 1566230;
        $code = "aetr";

        $this->assertEquals($service->encode($data), $code);
        $this->assertEquals($service->decode($code), $data);
    }

}
