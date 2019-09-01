<?php
namespace App\Http\Controllers\Formats;
use App\Http\Controllers\Profiles\Profiles;

class SQLInsert extends Formats {
	public function __construct(Profiles $profile) {
		parent::__construct($profile, 'sql-insert', '.sql');
	}

    public function format(): void {
		# insert line
		$sql = "insert into ".$this->profile->getTableName()." (".$this->fieldsString.") values ";

		# values
		$values = '';
		for ($i = 0; $i < count($this->data); $i++) {
			$values .= PHP_EOL."(";
			$fieldData = '';
			for ($j = 0; $j < count($this->fields); $j++) {
				$fieldData .= "\"".$this->data[$i][$this->fields[$j]]."\",";
			}
			$values .= rtrim($fieldData, ',');
			$values .= "),";
		}

		$sql .= rtrim($values, ',').";".PHP_EOL;
		$this->formattedData = $sql;
	}
}
