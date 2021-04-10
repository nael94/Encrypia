<?php

require_once '../Encrypia.php';

// Objective way

$encrypia = new Encrypia('61758394');
// Initalize Encrypia with key in the constructor
echo "The passed key in the constructor is: " . $encrypia->getKey();

echo "<hr />";

$encrypia->setKey('81753024');
// Initialzie or Update Encrypia key using setKey()
echo "The passed key in setKey() method is: " . $encrypia->getKey();

echo "<hr />";

$text         = 'This is the first text to be blinded.';
$blinded_text = $encrypia->blind($text);
echo "The original first text is: " . $text;
echo "<br />";
echo "The blinded first text is: " . $blinded_text;
echo "<br />";
echo "The key of the blinding is: " . $encrypia->getKey();

echo "<hr />";

$encrypia->setKey('66175201938');
$text_2         = "This is the second text to be blinded.";
$blinded_text_2 = $encrypia->blind($text);
echo "The original second text is: " . $text_2;
echo "<br />";
echo "The blinded second text is: " . $blinded_text_2;
echo "<br />";
echo "The key of the blinding is: " . $encrypia->getKey();

echo "<hr />";

echo "This below is the unblinded first text using its correct key as a second parameter:<br />";
echo $encrypia->unblind('\ipx#iu$|il%iitw|!{j{t"xw!ij#bnmveli1', 81753024);

echo "<hr />";

echo "This below is the unblinded first text using a wrong key:<br />";
echo $encrypia->unblind('\ipx#iu$|il%iitw|!{j{t"xw!ij#bnmveli1'); // depending on the last setKey() value

echo "<hr />";
echo "<hr />";

// Static way

Encrypia::setKey('4129807536');
// Initializing Encrypia with setKey() static method
echo "The passed key in setKey() static method is: " . Encrypia::getKey();
// Getting the key using getKey() static method

echo "<hr />";

$text_3         = "This is the third text to be blinded.";
$blinded_text_3 = Encrypia::blind($text_3);
echo "The original third text is: " . $text_3;
echo "<br />";
echo "The blinded third text is: " . $blinded_text_3;
echo "<br />";
echo "The key of the blinding is: " . Encrypia::getKey();

echo "<hr />";

echo "This below is the unblinded first text using its correct key as a second parameter:<br />";
echo Encrypia::unblind($blinded_text, 81753024) . "<br />";
echo "This below is the unblinded first text using a wrong key:<br />";
echo Encrypia::unblind($blinded_text) . "<br />"; // depending on the last setKey() value

echo "<hr />";
echo "<hr />";

echo '<h3>Hint: Wrong unblinding values are happening due to wrong key
  passed through the Constructor or last setKey() value
  or the $key that passed as a second parameter into unblind().</h3>';

echo "<hr />";
