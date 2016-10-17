<?php

abstract class SQLayerTbl
{

  /** @property SQLayerDbo **/
  protected $dbo;

  /** @property string **/
  protected $name;

  /** @property int **/
  protected $returnedCount;

  /**
   * @return mixed
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
   * @param $id
   * @return array
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
   * @param mixed $arrays
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
   * @param mixed $values
   */
  public function insertArray($values)
  {
    $this->insertArrays(array($values));
  }

}
