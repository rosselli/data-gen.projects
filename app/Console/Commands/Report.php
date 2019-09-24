<?php
namespace App\Console\Commands;
use App\Http\Controllers\Formats\Csv;
use App\Http\Controllers\Formats\Json;
use App\Http\Controllers\Formats\SQLInsert;
use App\Http\Controllers\Formats\SQLite;
use App\Http\Controllers\Profiles\PeopleBasic;
use App\Http\Controllers\Records;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class Report extends Command {
    protected $signature = 'rosselli:report';
    protected $description = 'Size by Record report for all formats';

    public function __construct() {
        parent::__construct();
    }

    public function handle()
    {
        $formats = ['csv', 'json', 'sql-insert', 'sqlite'];
        $headers = ['', '1', '10', '100', '1,000', '10,000', '100,000', '1,000,000'];
        $profiles = [
            ['title' => 'People Basic', 'folder' => 'people-basic'],
            ['title' => 'Posts Advanced', 'folder' => 'posts-advanced']
        ];


        $sizes = [];
        for ($k = 0; $k < count($profiles); $k++) {
            $headers[0] = $profiles[$k]['title'];

            # formats
            for ($i = 0; $i < count($formats); $i++) {
                $sizes[$i][0] = $formats[$i];

                # file sizes
                Storage::delete('data-gen/'.$profiles[$k]['folder'].'/'.$formats[$i].'/.DS_Store');
                $files = Storage::files('data-gen/'.$profiles[$k]['folder'].'/'.$formats[$i]);
                natsort($files);
                $files = array_values($files);

                for ($j = 0; $j < count($files); $j++) {
                    $sizes[$i][($j + 1)] = $this->formatBytes(Storage::size($files[$j]), 2);
                }
            }
            $this->table($headers, $sizes);
            $sizes = [];
        }
    }

    public function formatBytes($size, $precision = 0){
        $unit = ['b','kb','mb','GiB','TiB','PiB','EiB','ZiB','YiB'];

        for($i = 0; $size >= 1024 && $i < count($unit)-1; $i++){
            $size /= 1024;
        }

        return round($size, $precision).' '.$unit[$i];
    }

}
