# sqlayer
*MySQL Database Wrapper for OTMVC Projects*

## SQLayerDbo ##
*To create a database connection object, extend SQLayerDbo:*
```php
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
```

Access the connection's shared instance:

```php
$dbo = TestDbo::sharedInstance();
```

You then have access to the following API methods:

### Execute SQL ###
*Pass in SQL string to execute with no result. Returns number of affected rows*
```php
$int = $dbo->executeSQL($sql);
```

### Fetch Rows ###
*Pass in SQL string to fetch an array of rows. Returns an array (array is empty if no result)*
```php
$array = $dbo->fetchRows($sql);
```

### Insert Rows ###
*Pass in INSERT prepared statement along with arrays to insert. No return value*
```php
$sql = 'INSERT INTO `test` (`id`,`column1`,`column2`) VALUES (NULL,?,?)';
$arrays = array(
  array('value_a','value_b'),
  array('value_c','value_d')
);
$dbo->insert($sql,$arrays);
```

### Get Insert Id ###
*Returns the last insert id*
```php
$int = $dbo->insertId();
```
## SQLayerTbl ##
*To access a table in the database, extend SQLayerTbl:*
```php
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
```

Access the table's shared instance:
```php
$tbl = TestTbl::sharedInstance();
```

You then have access to the following API methods:

### Fetch Rows ###
*Pass in SQL string to fetch an array of rows (array is empty if no result)*
```php
$sql = 'SELECT * FROM `test`;';
$rows = $tbl->fetchRows($sql);
```

### Fetch Row From Id ###
*Pass in id to fetch a single row (row is empty if no result)*
```php
$row = $tbl->fetchRowFromId(1);
```

### Get Returned Count ###
*Returns the number of rows returned from last fetch operation*
```php
$int = $tbl->returnedCount();
```

### Insert Arrays ###
*Pass in arrays to perform auto-increment inserts (i.e. omitting `id`). No return value*
```php
$arrays = array(
  array('value_a','value_b'),
  array('value_c','value_d')
);
$tbl->insertArrays($arrays);
```

### Insert Array ###
*Pass in array to perform a single insert. No return value*
```php
$array = array('value_a','value_b');
$tbl->insertArray($array);
```

