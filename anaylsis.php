#! /usr/bin/php -q
<?php

require_once("fileReader.class");
require_once ("lengthTracker.class");

class anaylsis
{
    protected $passwordFile = "../passwords.txt";

    /** @var fileReader $passwordFileReader */
    protected $passwordFileReader;
    /** @var lengthTracker $lengthTracker */
    protected $lengthTracker;
    protected $passwordList;
    protected $pwCount = 0;

    public function __construct()
    {
        $this->passwordFileReader = new fileReader($this->passwordFile);
        $this->passwordList = $this->passwordFileReader->getFileContents();
        $this->getCount();
        
        $this->lengthTracker = new lengthTracker();
    }
    
    private function processPasswords()
    {
        
        
        foreach($this->passwordList as $pw) {
            if (strlen($pw) > 0) {
                $this->lengthTracker->trackWord($pw);
            }
        }
        
        
    }
    
    public function run()
    {
        $this->processPasswords();
        $this->printAnalysis();
    }
    
    public function printAnalysis()
    {
        echo "There are {$this->pwCount} passwords in the file\n";
        
        $this->lengthTracker->printLengthAnalysis();
    }
    
    protected function getCount()
    {
        $this->pwCount = count($this->passwordList);
        return $this->pwCount;
    }
}

$analyzer = new anaylsis();
$analyzer->run();