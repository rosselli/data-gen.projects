<?php
namespace App\Http\Controllers\Formats;
use App\Http\Controllers\Profiles\Profiles;

class Csv extends Formats {
    const DELIMITER = ',';
    const ENCLOSURE = '"';

    public function __construct(Profiles $profile) {
        parent::__construct($profile, 'csv', '.csv');
    }

    public function format(): void {
		$fh = fopen('php://temp', 'rw');

		# create headers for csv
		fputcsv($fh, array_keys(current($this->data)));

		foreach ($this->data as $row) {
			fputcsv($fh, $row, self::DELIMITER, self::ENCLOSURE);
		}
		rewind($fh);
		$this->formattedData = stream_get_contents($fh);
		fclose($fh);
	}
}