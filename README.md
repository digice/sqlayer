# sqlayer
MySQL Database Wrapper for OTMVC Projects

To create a database connection object, extend SQLayerDbo:

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
*Pass in SQL string to execute with no result. Returns 1 on success, 0 on failure
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
