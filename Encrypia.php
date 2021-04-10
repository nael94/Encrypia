<?php

/**
 * Class members declared public can be accessed everywhere.
 * Members declared protected can be accessed only within the class itself and by inheriting and parent classes.
 * Members declared as private may only be accessed by the class that defines the member. 
 */

/**
 * The two-way PHP-based encryption class with custom unique encryption
 * key that lets you blind texts before you save them into your database.
 * @param $key The key of Encrypia 
 */

class Encrypia {

  private $key;
  private static $staticKey;

  private function passkey($key) {
    if (in_array(true, array(is_object($key), is_array($key), is_bool($key), is_float($key)))) {
      die('Error in Encrypia key type: ' . gettype($key) . '. Allowed types are: [String, Integer].');
    }
    if (preg_match('/^[0-9]+$/', $key)) {
      // is int key
      // nothing to do
    }
    else if (gettype($key) == 'string') {
      // is str key
      $k2 = '';
      $k = str_split($key);
      $key = join('', array_map(function ($item) use($k, $k2) {
        $r = intval(ord($item) / 1 /* count($k) */) . ',';
        if (strlen($r) > 1) {
          $k2 .= array_sum(str_split($r));
        }
        return $k2;
      }, $k));
    }
    else {
      // die('Error in Encrypia key type: ' . gettype($key) . '. Allowed types are: [String, Integer].');
    }
    //
    return $key;
  }

  private function blind_func($text) {
    $text_arr     = str_split($text);
    $blinded_arr  = array();
    $i = 0;
    //
    foreach ($text_arr as $c) {
      $new_chr = chr(ord($c) + $this->key_arr[$i]);
      $blinded_arr[] = $new_chr;
      $i = ($i + 1) == $this->key_count ? 0 : $i + 1;
    }
    //
    return join('', $blinded_arr);
  }

  private function unblind_func($text) {
    $text_arr     = str_split($text);
    $blinded_arr  = array();
    $i = 0;
    //
    foreach ($text_arr as $c) {
      $new_chr = chr(ord($c) - $this->key_arr[$i]);
      $blinded_arr[] = $new_chr;
      $i = ($i + 1) == $this->key_count ? 0 : $i + 1;
    }
    //
    return join('', $blinded_arr);
  }

  private static function blind_static($text, $key = null) {
    $k = $key == null ? self::$staticKey : $key;
    //
    if ($k) {
      $text_arr     = str_split($text);
      $key_arr      = str_split($k);
      $key_count    = count($key_arr);
      $blinded_arr  = array();
      $i = 0;
      //
      foreach ($text_arr as $c) {
        $new_chr = chr(ord($c) + $key_arr[$i]);
        $blinded_arr[] = $new_chr;
        $i = ($i + 1) == $key_count ? 0 : $i + 1;
      }
      //
      return join('', $blinded_arr);
    }
    else {
      die('You have to set the key before.');
    }
  }

  private static function unblind_static($text, $key = null) {
    $k = $key == null ? self::$staticKey : $key;
    //
    if ($k) {
      $text_arr     = str_split($text);
      $key_arr      = str_split($k);
      $key_count    = count($key_arr);
      $blinded_arr  = array();
      $i = 0;
      //
      foreach ($text_arr as $c) {
        $new_chr = chr(ord($c) - $key_arr[$i]);
        $blinded_arr[] = $new_chr;
        $i = ($i + 1) == $key_count ? 0 : $i + 1;
      }
      //
      return join('', $blinded_arr);
    }
    else {
      die('You have to set the key before.');
    }
  }

  //

  public function __call($name, $args) {
    if (in_array($name, array('blind', 'unblind'))) {
      if (count($args) > 0) {
        if ($name == 'blind') {
          return $this->blind_func($args[0]);
        }
        else if ($name == 'unblind') {
          return $this->unblind_func($args[0]);
        }
      }
      else {
        die("You have to pass a value.");
      }
    }
  }

  public function __construct($key = null) {
    if ($key != null) {
      $this->key        = $this->passkey($key);
      $this->key_arr    = str_split($this->key);
      $this->key_count  = count($this->key_arr);
      self::$staticKey  = $this->key;
    }
  }

  public function __destruct() {
    $this->key        = null;
    $this->key_arr    = null;
    $this->key_count  = null;
    self::$staticKey  = null;
  }
  
  //

  public static function getKey() {
    return self::$staticKey ? self::$staticKey : null;
  }

  public static function setKey($key) {
    $key = call_user_func('Encrypia::passkey', $key);
    self::$staticKey = call_user_func('Encrypia::passkey', $key);
    //
    return __CLASS__;
  }

  public static function blind($text, $key = null) {
    return call_user_func('Encrypia::blind_static', $text, $key);
  }

  public static function unblind($text, $key = null) {
    return call_user_func('Encrypia::unblind_static', $text, $key);
  }

}