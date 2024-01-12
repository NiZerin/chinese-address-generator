<?php

namespace Nizerin\ChineseAddressGenerator;

/**
 *
 */
class Generator
{
	/** @var array|mixed  */
	private array $level3;

	/** @var array|false[]|\string[][]  */
	private array $level4;

	/**
	 * Generator constructor.
	 */
	public function __construct()
	{
		$this->level3 = json_decode(file_get_contents(__DIR__ . '/data/level3.json'), true);

		$level4 = file_get_contents(__DIR__ . '/data/level4.txt');
		$level4 = explode("\n", $level4);
		$level4 = array_map(function ($l) {
			return explode(",", $l);
		}, $level4);

		$this->level4 = $level4;
	}

	/**
	 * @param $dict
	 * @return bool
	 */
	private function checkSub($dict): bool
	{
		return isset($dict['regionEntitys']) && is_array($dict['regionEntitys']) && count($dict['regionEntitys']) > 0;
	}

	/**
	 * @return array
	 */
	public function generateLevel1(): array
	{
		$province = $this->getRandom($this->level3);

		return [
			'region' => $province['region'],
			'code' => $province['code'],
		];
	}

	/**
	 * @return array
	 */
	public function generateLevel2(): array
	{
		$dict = array_filter($this->level3, [$this, 'checkSub']);
		$province = $this->getRandom($dict);
		$city = $this->getRandom($province['regionEntitys']);

		return [
			'region' => $province['region'] . $city['region'],
			'code' => $city['code'],
		];
	}

	/**
	 * @return array
	 */
	public function generateLevel3(): array
	{
		$dict = array_filter($this->level3, [$this, 'checkSub']);
		$province = $this->getRandom($dict);
		$city = $this->getRandom($province['regionEntitys']);

		if (!isset($city['regionEntitys'])) {
			return $this->generateLevel3(); // If no third-level region, recurse
		}

		$region = $this->getRandom($city['regionEntitys']);

		return [
			'region' => $province['region'] . $city['region'] . $region['region'],
			'code' => $region['code'],
		];
	}

	/**
	 * @return array
	 */
	public function generateLevel4(): array
	{
		$city = $this->generateLevel3();
		$subs = array_filter($this->level4, function ($l) use ($city) {
			return strpos($l[0], $city['code']) === 0;
		});

		$sub = $this->getRandom($subs);

		if (!$sub) {
			return $this->generateLevel4(); // If no matching condition found, recurse
		}

		return [
			'region' => $city['region'] . $sub[1],
			'code' => strval($sub[0]),
		];
	}

	/**
	 * @param  bool  $hasCode
	 * @return array|string
	 */
	public function fabricateFullAddress(bool $hasCode = false)
	{
		$street = $this->generateLevel4();
		$buildNo = str_pad(strval(mt_rand(1, 1400)), 3, '0', STR_PAD_LEFT);
		$room = strval(mt_rand(1, 9)) . '0' . strval(mt_rand(1, 9));

		$address = $street['region'] . $buildNo . '号' . $room . '室';

		if (!$hasCode) {
			return $address;
		} else {
			return [
				'region' => $address,
				'code' => $street['code'],
			];
		}
	}

	/**
	 * @param $array
	 * @return mixed
	 */
	private function getRandom($array)
	{
		if (empty($array)) {
			return '';
		}

		return $array[array_rand($array)];
	}

	// Example usage:
	// $level3Data = // Load your level3 data here
	// $level4Data = // Load your level4 data here
	// $addressGenerator = new AddressGenerator($level3Data, $level4Data);
	// $level1 = $addressGenerator->generateLevel1();
	// $level2 = $addressGenerator->generateLevel2();
	// $level3 = $addressGenerator->generateLevel3();
	// $level4 = $addressGenerator->generateLevel4();
	// $fullAddress = $addressGenerator->fabricateFullAddress();
	// $fullAddressWithCode = $addressGenerator->fabricateFullAddress(true);

}