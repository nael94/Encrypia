<?php

/**
 * Class members declared public can be accessed everywhere.
 * Members declared protected can be accessed only within the class itself and by inheriting and parent classes.
 * Members declared as private may only be accessed by the class that defines the member. 
 */

/**
 * An encryption class
 * @param $level 
 */

class Encrypia {

  private $key;

  public function __construct($key) {
    if (in_array(true, [is_object($key), is_array($key), is_bool($key), is_float($key)])) {
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
    $this->key        = $key;
    $this->key_arr    = str_split($this->key);
    $this->key_count  = count($this->key_arr);
  }

  public function blind($text) {
    $text_arr     = str_split($text);
    $blinded_arr  = [];
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

  public function unblind($text) {
    $text_arr     = str_split($text);
    $blinded_arr  = [];
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

  public function __destruct() {
    # code...
    // echo $this->key;
  }

}