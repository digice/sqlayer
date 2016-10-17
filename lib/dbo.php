<?php

abstract class SQLayerDbo
{

  /** @property PDO **/
  protected $pdo;

  /**
   * SQLayerDbo constructor
   */
  public function __construct()
  {
    $this->pdo = new PDO('mysql:dbname='.DB_NAME.';host='.DB_HOST,DB_USER,DB_PASS);
  }

  /**
   * @return int
   */
  public function insertId()
  {
    return $this->pdo->lastInsertId();
  }

  /**
   * @param string $sql
   * @return int
   */
  public function executeSQL($sql)
  {
    if ($affectedRows = $this->pdo->exec($sql)) {
      return $affectedRows;
    } else {
      return 0;
    }
  }

  /**
   * @param  string $sql
   * @return mixed
   */
  public function fetchRows($sql)
  {
    $rows = array();
    if ($res = $this->pdo->query($sql,PDO::FETCH_ASSOC)) {
      foreach ($res as $row) {
        array_push($rows, $row);
      }
    }
    return $rows;
  }

  /**
   * @param *str* sql string
   * @param *mixed* array of arrays
   */
  public function insert($sql, $arrays)
  {
    $stmt = $this->pdo->prepare($sql);
    foreach ($arrays as $array) {
      $stmt->execute($array);
    }
  }

}
