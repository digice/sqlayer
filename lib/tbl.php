<?php

abstract class SQLayerTbl
{

  protected $dbo;
  
  protected $name;
  
  protected $returnedCount;
  
  public function returnedCount()
  {
    return $this->returnedCount;
  }

  public function fetchRowFromId($id)
  {
    $sql = 'SELECT * FROM `'.$this->name.'` WHERE id = '.$id.' LIMIT 1;';
    $rows = $this->dbo->fetchRows($sql);
    $this->returnedCount = count($rows);
    if ($this->returnedCount > 0) {
      return $rows[0];
    } else {
      return array();
    }
  }

  public function insertArrays($arrays)
  {
    $sql = 'INSERT INTO `'.$this->name.'` VALUES (NULL';
    for ($i = 0 ; $i < count($arrays) ; $i++) {
      $sql .= ',?';
    }
    $sql .= ');';
    $this->dbo->insert($sql,$arrays);
  }

  public function insertArray($values)
  {
    $this->insertArrays(array($values));
  }

}
