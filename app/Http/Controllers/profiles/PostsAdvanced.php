<?php
namespace App\Http\Controllers\Profiles;
use App\Http\Controllers\Profiles\Profiles;
use App\Http\Controllers\Records;

class PostsAdvanced extends Profiles {
	public function __construct(Records $records) {
		parent::__construct($records);
    }

    public function setTableName(): void {
        $this->tableName = 'posts_advanced';
    }

    public function setFolderName(): void {
        $this->folderName = 'posts-advanced';
    }

	public function generateData(): void {
		for ($i=0; $i < $this->times; $i++) {
			$this->data[$i]['user_id'] = $this->faker->numberBetween(10000, 90000);
			$this->data[$i]['category_id'] = $this->faker->numberBetween(100, 900);
			$this->data[$i]['title'] = $this->faker->sentence(6, true);
			$this->data[$i]['resume'] = $this->faker->paragraph(3, true);
			$this->data[$i]['text'] = $this->faker->paragraph(30, true);
			$this->data[$i]['image'] = $this->carbon->timestamp.".jpg";

			$range = $this->faker->numberBetween(40, 80);
			$this->data[$i]['caption'] = $this->faker->text($range);

			$range = $this->faker->numberBetween(2, 6);
			$tags = implode(', ', $this->faker->words($range));
			$this->data[$i]['tags'] = $tags;
			$this->data[$i]['created_at'] = $this->carbon->toDateTimeString();
		}
	}
}
