<?php
namespace App\Http\Controllers\Formats;
use App\Http\Controllers\Profiles\Profiles;
use Illuminate\Support\Facades\Storage;
use SQLite3;

class SQLite extends Formats {
    private $createDbQuery;

	public function __construct(Profiles $profile) {
		parent::__construct($profile, 'sqlite', '.sqlite');
	}

    public function format(): void {}

    public function save(): void {
        $this->createDbQuery = "create table if not exists ".$this->profile->getTableName()." (id integer primary key autoincrement, ".$this->fieldsString.");";
        $this->createFormatFolder();
        $this->resetDatabase();

	    $db = new SQLite3($this->getFormatFileFullPath());
        $db->exec($this->createDbQuery);
        $db->exec(Storage::get($this->getSqlFilePath()));
	}

    public function createFormatFolder() {
        shell_exec('mkdir ' . $this->getFormatFolderPath());
    }

    public function resetDatabase() {
        if (Storage::exists($this->getFormatFilePath())) {
            Storage::delete($this->getFormatFilePath());
            shell_exec('touch ' . $this->getFormatFileFullPath());
        }
    }
}
