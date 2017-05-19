<?php
/**
 * DbConnect Class
 *
 * @category  Database Access
 * @author    Alexeev-Demiankov Ilya <job@ialexeev.ru>
 * @version   1.0
 */

class DbConnect {
  	public static $dbHost;
    public static $dbUser;
    public static $dbPass;
    public static $dbName;
  	public static $dbEncode="utf8";
    static private $instance = NULL;
  
 
    static function getInstance()
    {
      if (self::$instance == NULL)
      {   
        self::$instance = new mysqli(self::$dbHost, self::$dbUser, self::$dbPass, self::$dbName);
        self::$instance->query("set names ".self::$dbEncode);
        if(mysqli_connect_errno()) {
            return "Database connection failed: ".mysqli_connect_error();
        }
      }
      return self::$instance;
    }
    private function __construct(){ }
    private function __clone() {}
}
?>
