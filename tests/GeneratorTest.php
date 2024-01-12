<?php

namespace Nizerin\ChineseAddressGenerator\Tests;

use PHPUnit\Framework\TestCase;

class GeneratorTest extends TestCase
{
	public function testGenerateLevel1()
	{
		$generator = new \Nizerin\ChineseAddressGenerator\Generator();

		$fakeAddress = $generator->generateLevel1();
		var_dump($fakeAddress);

		$this->assertIsArray($fakeAddress);
	}

	public function testGenerateLevel2()
	{
		$generator = new \Nizerin\ChineseAddressGenerator\Generator();

		$fakeAddress = $generator->generateLevel2();
		var_dump($fakeAddress);

		$this->assertIsArray($fakeAddress);
	}

	public function testGenerateLevel3()
	{
		$generator = new \Nizerin\ChineseAddressGenerator\Generator();

		$fakeAddress = $generator->generateLevel3();
		var_dump($fakeAddress);

		$this->assertIsArray($fakeAddress);
	}

	public function testGenerateLevel4()
	{
		$generator = new \Nizerin\ChineseAddressGenerator\Generator();

		$fakeAddress = $generator->generateLevel4();
		var_dump($fakeAddress);

		$this->assertIsArray($fakeAddress);
	}

	public function testGenerateFullAddress()
	{
		$generator = new \Nizerin\ChineseAddressGenerator\Generator();

		$fakeAddress = $generator->fabricateFullAddress();
		var_dump($fakeAddress);

		$this->assertIsString($fakeAddress);
	}
}