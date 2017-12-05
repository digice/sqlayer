<?php

/**
 * @package SQLayer
 * @version 0.0.4
 * @date    2016-11-08
 * @author  Roderic Linguri <linguri@digices.com>
 * @license MIT
 */

abstract class SQLayerTbl
{

  /** @property *obj* SQLayerDbo **/
  protected $dbo;

  /** @property *str* table name **/
  protected $name;

  /** @property *int* number of rows **/
  protected $returnedCount;

  /**
   * @return *int*
   */
  public function returnedCount()
  {
    return $this->returnedCount;
  }

  public function fetchRows($sql)
  {
    $rows = $this->dbo->fetchRows($sql);
    $this->returnedCount = count($rows);
    if ($this->returnedCount > 0) {
      return $rows;
    } else {
      return array();
    }
  }

  /**
  * @return *mixed*
  */
  public function allRows()
  {
    $sql = 'SELECT * FROM `'.$this->name.'` ;';
    return $this->fetchRows($sql);
  }

  /**
   * @param  *int*
   * @return *mixed*
   */
  public function fetchRowFromId($id)
  {
    $sql = 'SELECT * FROM `'.$this->name.'` WHERE id = '.$id.' LIMIT 1;';
    $rows = $this->fetchRows($sql);
    if ($this->returnedCount == 1) {
      return $rows[0];
    } else {
      return array();
    }
  }

  /**
   * @param *mixed*
   */
  public function insertArrays($arrays)
  {
    $sql = 'INSERT INTO `'.$this->name.'` VALUES (NULL';
    for ($i = 0 ; $i < count($arrays[0]) ; $i++) {
      $sql .= ',?';
    }
    $sql .= ');';
    $this->dbo->insert($sql,$arrays);
  }

  /**
   * @param *mixed*
   */
  public function insertArray($values)
  {
    $this->insertArrays(array($values));
  }

}
