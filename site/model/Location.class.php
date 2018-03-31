<?php
 
class Location {
  const DB_TABLE = 'Locations'; // database table name
 
  // database fields for this table
  public $id = 0;
  public $name = '';
  public $activities = '';
  public $staff = '';
  public $capacity = '';
  public $cost = '';
 
  // return a location object by id
  public static function l_loadByID($id) {
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
 
        $place = new Location(); // instantiate object
 
        // store db results in local object
        $place->id                  = $row['id'];
        $place->name                = $row['name'];
        $place->activities          = $row['activities'];
        $place->staff               = $row['staff'];
        $place->capacity            = $row['capacity'];
        $place->cost                = $row['cost'];
 
        return $place; // return the object
      }
  }
 
  // return a place object by name
  public static function l_loadByName($name) {
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
 
        $place = new Location(); // instantiate new object
 
        // store db results in local object
        $place->id                  = $row['id'];
        $place->name                = $row['name'];
        $place->activities          = $row['activities'];
        $place->staff               = $row['staff'];
        $place->capacity            = $row['capacity'];
        $place->cost                = $row['cost'];
 
        return $place; // return the object
      }
  }
 
  // return all members as an array
  public static function getLocations() {
    $db = Db::instance();
    $q = "SELECT id FROM `".self::DB_TABLE."` ORDER BY name ASC;";
    $result = $db->query($q);
 
    $place = array();
    if($result->num_rows != 0) {
      while($row = $result->fetch_assoc()) {
        $place[] = self::loadByID($row['id']);
      }
    }
    return $place;
  }
 
  public function l_save(){
    if($this->id == 0) {
      return $this->l_insert(); // member is new and needs to be created
    } else {
      return $this->l_update(); // member already exists and needs to be updated
    }
  }
 
  public function l_insert() {
    if($this->id != 0)
      return null; // can't insert something that already has an ID
 
    $db = Db::instance(); // connect to db
   
    // build query
 
    $q = sprintf("INSERT INTO `%s` (`name`, `activities`, `staff`, `capacity`, `cost`)
    VALUES (%s, %s, %s, %d, %d);",
      self::DB_TABLE,
      $db->escape($this->name),
      $db->escape($this->activities),
      $db->escape($this->staff),
      $db->escape($this->capacity),
      $db->escape($this->cost)
      );
     
    $db->query($q); // execute query
    return $db->getInsertID();
  }
 
  public function l_update() {
    if($this->id == 0)
      return null; // can't update something without an ID
 
    $db = Db::instance(); // connect to db
 
    // format dates for update
    if($this->date_captured != '')
      $this->date_captured = $db->formatDate($this->date_captured);
 
    // build query
    $q = sprintf("UPDATE `%s` SET
      `name`        = %s,
      `activities`  = %s,
      `staff`       = %s,
      `capacity`    = %d,
      `cost`        = %d
      WHERE `id` = %d;",
      self::DB_TABLE,
      $db->escape($this->name),
      $db->escape($this->activities),
      $db->escape($this->staff),
      $db->escape($this->capacity),
      $db->escape($this->cost)
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