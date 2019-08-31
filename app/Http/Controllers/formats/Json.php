<?php
namespace App\Http\Controllers\Formats;
use App\Http\Controllers\Profiles\Profiles;

class Json extends Formats {
    public function __construct(Profiles $profile) {
        parent::__construct($profile, 'json', '.json');
    }

    public function format(): void {
        $this->formattedData = json_encode($this->data);
    }
}
