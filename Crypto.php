<?php

class QWERTYCrypt {
  private static $dict = [
      'q' => "qwertyuiopêûîôéúíóèùìòõ´[",
      'a' => "asdfghjklçâáàã~]",
      'z' => "zxcvbnm,.;/",
      '1' => "1234567890'\"!@#$%¨&*()-_=+",
      'Q' => "QWERTYUIOPÊÛÎÔÉÚÍÓÈÙÌÒÕ`{",
      'A' => "ASDFGHJKLÇÂÁÀÃ^}",
      'Z' => "ZXCVBNM<>:?\|",
  ];
  
  public static function encode($sequence)
  {
      $encoded = "";
  
      for ($i = 0; $i < strlen($sequence); $i++) {
          $char = $sequence[$i];
  
          if ($char === ' ') {
              $encoded .= " ";
          } else {
              foreach (self::$dict as $key => $row) {
                  $index = strpos($row, $char);
                  if ($index !== false) {
                      $shift = $index;
  
                      $encoded .= $key . ($shift == 0 ? "-1" : $shift) . " ";
                      break;
                  }
              }
          }
      }
  
      return trim($encoded);
  }
  
  public static function decode($sequence)
  {
      $words = explode(" ", $sequence);
      $decoded = "";
  
      foreach ($words as $word) {
          if ($word === '') {
              $decoded .= " ";
          } else {
              $reference = $word[0];
              $shift = intval(substr($word, 1));
  
              if (isset(self::$dict[$reference])) {
                  $row = self::$dict[$reference];
                  $row_length = strlen($row);
  
                  if ($shift === -1) {
                      $decoded .= $reference;
                  } else {
                      $index = strpos($row, $reference);
  
                      $new_index = $index + $shift;
                      $new_index = ($new_index % $row_length + $row_length) % $row_length;
  
                      $decoded .= $row[$new_index];
                  }
              } else {
                  $decoded .= '?';
              }
          }
      }
  
      return $decoded;
  }
}