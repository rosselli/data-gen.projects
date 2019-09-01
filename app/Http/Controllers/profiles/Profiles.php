<?php
namespace App\Http\Controllers\Profiles;
use App\Http\Controllers\Records;
use Carbon\Carbon;
use Faker\Factory as Faker;

abstract class Profiles {
	protected $faker;
	protected $carbon;
	protected $records;
	protected $times;
	protected $data = [];
	protected $tableName = '';
	protected $folderName = '';

	public function __construct(Records $records) {
		$this->faker = Faker::create();
		$this->carbon = Carbon::now();
		$this->records = $records;
		$this->times = $records->getTimes();
		$this->generateData();
	}

    abstract public function generateData(): void;
    abstract public function setTableName(): void;
    abstract public function setFolderName(): void;

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

	public function getTableName(): string {
		return $this->tableName;
	}


}
