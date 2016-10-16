<?php

abstract class SQLayerDbo
{

  protected $pdo;
  
  public function __construct()
  {
    $this->pdo = new PDO('mysql:dbname='.DB_NAME.';host='.DB_HOST,DB_USER,DB_PASS);
  }

  public function executeSQL($sql)
  {
    if ($affectedRows = $this->pdo->exec($sql)) {
      return $affectedRows;
    } else {
      return 0;
    }
  }

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

}