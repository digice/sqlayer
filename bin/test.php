<?php

require_once(dirname(__DIR__).DIRECTORY_SEPARATOR.'autoload.php');

// set up test classes as singletons
class TestDbo extends SQLayerDbo
{

  protected static $sharedInstance;

  public static function sharedInstance()
  {
    if (!isset(self::$sharedInstance)) {
      self::$sharedInstance = new self();
    }
    return self::$sharedInstance;
  }

  public function __construct()
  {
    $this->host = '127.0.0.1';
    $this->name = 'test';
    $this->user = 'test';
    $this->host = 'secret';
    parent::__construct();
  }

}

class TestTbl extends SQLayerTbl
{

    protected static $sharedInstance;

    public static function sharedInstance()
    {
      if (!isset(self::$sharedInstance)) {
        self::$sharedInstance = new self();
      }
      return self::$sharedInstance;
    }

    public function __construct()
    {
      $this->name = 'test';
      $this->dbo = TestDbo::sharedInstance();
    }

}

// first create the table in the database
$dbo = TestDbo::sharedInstance();

$sql = 'CREATE TABLE `test` (
  `id` int(10) NOT NULL,
  `column1` varchar(10) NOT NULL,
  `column2` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;';

echo 'Creating test table'.PHP_EOL;
$dbo->executeSQL($sql);


// instantiate table singleton
$test = TestTbl::sharedInstance();
echo 'Inserting test data'.PHP_EOL;
$test->insertArray(array('test','data'));
