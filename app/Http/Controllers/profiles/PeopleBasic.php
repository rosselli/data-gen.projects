<?php
namespace App\Http\Controllers\Profiles;
use App\Http\Controllers\Records;

class PeopleBasic extends Profiles {
    public function __construct(Records $records) {
        parent::__construct($records);
        $this->setTableName();
        $this->setFolderName();
    }

    public function setTableName(): void {
        $this->tableName = 'people_basic';
    }

    public function setFolderName(): void {
        $this->folderName = 'people-basic';
    }

    public function generateData(): void {
        for ($i=0; $i < $this->times; $i++) {
            $this->data[$i]['firstname'] = $this->faker->firstName;
            $this->data[$i]['lastname'] = $this->faker->lastName;
        }
    }
}
