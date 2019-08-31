<?php
namespace App\Http\Controllers\Formats;
use App\Http\Controllers\Profiles\Profiles;
use Illuminate\Support\Facades\Storage;

abstract class Formats {
	protected $profile;
	protected $data;
	protected $formattedData;
	protected $fields;
	protected $fieldsString;
	protected $records;
	protected $formatFilePath;
	protected $formatFolderPath;
	protected $folderName;
	protected $extension;

	public function __construct(Profiles $profile, $folderName, $extension) {
		$this->profile = $profile;
		$this->records = $profile->getRecords();
		$this->data = $profile->getData();
		$this->fields = array_keys(current($this->data));
		$this->fieldsString = implode(",", $this->fields);
		$this->folderName = $folderName;
		$this->extension = $extension;
		$this->format();
		$this->save();
		$this->updateReport();
	}

    abstract public function format(): void;

	public function save(): void{
		Storage::put($this->getFormatFilePath(), $this->formattedData);
	}

	public function getSqlFilePath(): string {
		# storage/app/data-gen/profile/format/filename
		return 'data-gen/'.$this->profile->getFolderName().'/sql-insert/'.$this->records->getFileName().'.sql';
    }

	public function getFormatFilePath(): string {
		# storage/app/data-gen/profile/format/filename
		return 'data-gen/'.$this->profile->getFolderName().'/'.$this->folderName.'/'.$this->records->getFileName().$this->extension;
    }

	public function getFormatFileFullPath(): string {
		# storage/app/data-gen/profile/format/filename
		return storage_path('app/'.$this->getFormatFilePath());
    }

	public function getFormatFolderPath(): string {
		$relative = 'data-gen/'.$this->profile->getFolderName().'/'.$this->folderName.'/';
		return storage_path('app/'.$relative);
    }

	public function getFormatFolderFullPath(): string {
		return storage_path('app/'.$this->getFormatFolderPath());
    }

	public function getFormattedData() {
		return $this->formattedData;
	}

	public function getFileSize(): int {
		return Storage::size($this->getFormatFilePath());
	}

	public function updateReport(): void {
		$reportPath = 'data-gen/report.json';
		$profile = $this->profile->getFolderName();
		$format = $this->folderName;
		$file = $this->records->getFileName();

		if (!Storage::exists($reportPath)) { Storage::put($reportPath, "{}"); }

		$json = Storage::get($reportPath);
		$report = json_decode($json, true);
		$report[$profile][$format][$file] = $this->getFileSize();
		asort($report[$profile][$format]);

		Storage::put($reportPath, json_encode($report));
	}

}