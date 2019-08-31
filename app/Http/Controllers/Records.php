<?php
namespace App\Http\Controllers;

class Records {
    private $times;
    private $fileName;

    public function __construct(int $times, $fileName = null) {
        $this->times = $times;
        $this->fileName = ($fileName != null) ? $fileName : $times;
    }

    public function getTimes(): int {
        return $this->times;
    }

    public function getFileName(): string {
        return $this->fileName;
    }
}
