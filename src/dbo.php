<?php

/**
 * @package SQLayer
 * @version 0.0.4
 * @date    2016-11-08
 * @author  Roderic Linguri <linguri@digices.com>
 * @license MIT
 */

abstract class SQLayerDbo
{

  /** @property *obj* PDO Connection **/
  protected $pdo;

  /** @property *str* hostname or ip address **/
  protected $host;
  
  /** @property *str* db name **/
  protected $name;
  
  /** @property *str* mysql username **/
  protected $user;
  
  /** @property *str* password **/
  protected $pass;
  
  /**
   * SQLayerDbo constructor
   */
  public function __construct()
  {
    $this->pdo = new PDO('mysql:dbname='.$this->name.';host='.$this->host,$this->user,$this->pass);
  }

  /**
   * @return *int*
   */
  public function insertId()
  {
    return $this->pdo->lastInsertId();
  }

  /**
   * @param *str* $sql
   * @return *int*
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
   * @param  *str* $sql
   * @return *mixed*
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
