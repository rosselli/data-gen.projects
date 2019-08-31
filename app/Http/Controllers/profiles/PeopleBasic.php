<?php
namespace App\Http\Controllers\Profiles;
use App\Http\Controllers\Records;

class PeopleBasic extends Profiles {
    public $table = 'people_basic';
    protected $folderName = 'people-basic';

    public function __construct(Records $records) {
        parent::__construct($records);
    }

    public function generateData(): void {
        for ($i=0; $i < $this->times; $i++) {
            $this->data[$i]['firstname'] = $this->faker->firstName;
            $this->data[$i]['lastname'] = $this->faker->lastName;
        }
    }
}
