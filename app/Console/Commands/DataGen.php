<?php
namespace App\Console\Commands;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class DataGen extends Command {
    private $dataGen;
    private $profiles;

    protected $signature = 'rosselli:data-gen';
    protected $description = 'Data Generator for a given profile.';

    public function __construct() {
        parent::__construct();
        $this->profiles = Storage::disk('profiles')->files();
    }

    public function handle() {
        $this->formatProfileName();
        $profile = $this->choice('Choose the Profile?', $this->profiles, $this->profiles[0]);
        $this->info("Profile: {$profile}");

        $times = $this->choice('How many records do you want to generate?', [
            '1,5,10,50',
            '1,5,10,50,100,500',
            '1,5,10,50,100,500,1000,5000',
            '1,5,10,50,100,500,1000,5000,10000,50000',
        ], '0');
        $this->info("Times: {$times}");

        $times = explode(',', $times);
        $this->dataGen = new \App\Http\Controllers\DataGen($profile, $times);
        $output = $this->dataGen->run();
        $this->info($output);
    }

    public function formatProfileName() {
        if (array_search('Profiles.php', $this->profiles)) {
            unset($this->profiles[2]);
        }

        for ($i = 0; $i < count($this->profiles); $i++) {
//            $this->profiles[$i] = preg_replace("/(?<=\\w)(?=[A-Z])/"," $1", $this->profiles[$i]);
            $this->profiles[$i] = preg_replace("/(.php)/","", $this->profiles[$i]);
        }
    }
}
