<?php
namespace App\Http\Controllers\Profiles;
use App\Http\Controllers\Records;
use Faker\Factory as Faker;

abstract class Profiles {
	protected $faker;
	protected $records;
	protected $times;
	protected $data = [];
	protected $table = 'default';
	protected $folderName = 'default';


	public function __construct(Records $records) {
		$this->faker = Faker::create();
		$this->records = $records;
		$this->times = $records->getTimes();
		$this->generateData();
	}

    abstract public function generateData(): void;

	public function getData(): array {
		return $this->data;
	}

	public function getTimes(): int {
		return $this->times;
	}

	public function getRecords(): Records {
		return $this->records;
	}

	public function getFolderName(): string {
		return $this->folderName;
	}
}