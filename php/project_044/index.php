<?php
class Logger {
    private $file;
    public function __construct($file) { $this->file = $file; }
    public function log($level, $msg) {
        $line = date('Y-m-d H:i:s') . " [$level] $msg\n";
        file_put_contents($this->file, $line, FILE_APPEND);
    }
}
$logger = new Logger('app.log');
$logger->log('info', 'App started');
$logger->log('error', 'Something went wrong');
echo "Logged!";
