<?php
 
class Person {
  const DB_TABLE = 'People'; // database table name
 
  // database fields for this table
  public $id = 0;
  public $name = '';
  public $date_captured = '';
  public $age = '';
  public $etc = '';
 
  // return a person object by id
  public static function p_loadByID($id) {
      $db = Db::instance(); // create db connection
      // build query
      $q = sprintf("SELECT * FROM `%s` WHERE id = '%d';",
        self::DB_TABLE,
        $id
        );
      $result = $db->query($q); // execute query
      // make sure we found something
      if($result->num_rows == 0) {
        return null;
      } else {
        $row = $result->fetch_assoc(); // get results as associative array
 
        $person = new Person(); // instantiate new family member object
 
        // store db results in local object
        $person->id                 = $row['id'];
        $person->name           = $row['name'];
        $person->date_captured      = $row['date_captured'];
        $person->age                = $row['age'];
        $person->etc                = $row['etc'];
 
        return $person; // return the family member
      }
  }
 
  // return a person object by name
  public static function p_loadByName($name) {
      $db = Db::instance(); // create db connection
      // build query
      $q = sprintf("SELECT * FROM `%s` WHERE name = '%s';",
        self::DB_TABLE,
        $name
        );
      $result = $db->query($q); // execute query
      // make sure we found something
      if($result->num_rows == 0) {
        return null;
      } else {
        $row = $result->fetch_assoc(); // get results as associative array
 
        $person = new Person(); // instantiate new family member object
 
        // store db results in local object
        $person->id                 = $row['id'];
        $person->name               = $row['name'];
        $person->date_captured      = $row['date_captured'];
        $person->age                = $row['age'];
        $person->etc                = $row['etc'];
 
        return $person; // return the family member
      }
  }
 
  // return all members as an array
  public static function getPeople() {
    $db = Db::instance();
    $q = "SELECT id FROM `".self::DB_TABLE."` ORDER BY name ASC;";
    $result = $db->query($q);
 
    $person = array();
    if($result->num_rows != 0) {
      while($row = $result->fetch_assoc()) {
        $person[] = self::p_loadByID($row['id']);
      }
    }
    return $person;
  }
 
  public function p_save(){
    if($this->id == 0) {
      return $this->p_insert(); // member is new and needs to be created
    } else {
      return $this->p_update(); // member already exists and needs to be updated
    }
  }
 
  public function p_insert() {
    if($this->id != 0)
      return null; // can't insert something that already has an ID
 
    $db = Db::instance(); // connect to db
   
    // build query
 
    // format dates for insertion
    if($this->date_captured != '')
      $this->date_captured = $db->formatDate($this->date_captured);
 
    $q = sprintf("INSERT INTO `%s` ( `name`, `date_captured`, `age`, `etc`)
    VALUES (%s, %s, %s, %s);",
      self::DB_TABLE,
      $db->escape($this->name),
      $db->escape($this->date_captured),
      $db->escape($this->age),
      $db->escape($this->etc)
      );
     
    $db->query($q); // execute query
    return $db->getInsertID();
  }
 
  public function p_update() {
    if($this->id == 0)
      return null; // can't update something without an ID
 
    $db = Db::instance(); // connect to db
 
    // format dates for update
    if($this->date_captured != '')
      $this->date_captured = $db->formatDate($this->date_captured);
 
    // build query
    $q = sprintf("UPDATE `%s` SET
      `name`            = %s,
      `date_captured`   = %s,
      `age`             = %s,
      `etc`             = %s
      WHERE `id` = %d;",
      self::DB_TABLE,
      $db->escape($this->name),
      $db->escape($this->date_captured),
      $db->escape($this->age),
      $db->escape($this->etc),
      $db->escape($this->id)
      );
 
    $db->query($q); // execute query
    return $db->getInsertID();
  }
 
  public function remove(){
     
    $db = Db::instance(); // connect to db
   
    $q = sprintf("DELETE FROM `%s` WHERE `id` = %d;",
      self::DB_TABLE,
      $db->escape($this->id)
    );
   
    $db->query($q);
  }
 
}