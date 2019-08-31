<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Formats\Csv;
use App\Http\Controllers\Formats\Json;
use App\Http\Controllers\Formats\SQLInsert;
use App\Http\Controllers\Formats\SQLite;
use App\Http\Controllers\Profiles\PeopleBasic;
use Illuminate\Support\Facades\Storage;

class DataGen {
    private $times;
    private $profile;

    public function __construct($profile, $times) {
        $this->times = $times;
        $this->profile = $profile;
    }

    public function run() {
        $profile = "App\\Http\\Controllers\\Profiles\\".$this->profile;
        $output = '';

        for ($i = 0; $i < count($this->times); $i++) {
            $records = new Records($this->times[$i]);
            $profile = new $profile($records);

            $csv = new Csv($profile);
            $json = new Json($profile);
            $sqlInsert = new SQLInsert($profile);
            $sqlite = new SQLite($profile);

            $output .= 'CSV ('.$this->times[$i].'): '.$csv->getFileSize().' bytes.'.PHP_EOL;
            $output .= 'JSON ('.$this->times[$i].'): '.$json->getFileSize().' bytes.'.PHP_EOL;
            $output .= 'SQL Insert ('.$this->times[$i].'): '.$sqlInsert->getFileSize().' bytes.'.PHP_EOL;
            $output .= 'SQLite ('.$this->times[$i].'): '.$sqlite->getFileSize().' bytes.'.PHP_EOL;
        }

        return $output;
    }
}
