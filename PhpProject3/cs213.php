<?php

$books = array("Matthew" => 1, "Mark" => 2, "Luke" => 3, "John" => 4);
while ($book = each($books))
   print "1<b>$book[key]</b><br>";
	
$books = array("Matthew" => 1, "Mark" => 2, "Luke" => 3, "John" => 4);
//foreach ($books = $order => $book)
   print "2<b>$book</b><br>";
	
$books = array("Matthew", "Mark", "Luke", "John");
foreach ($books as $book)
   print "3<b>$book</b><br>";
	
$books = array("Matthew" => 1, "Mark" => 2, "Luke" => 3, "John" => 4);
while ($book = next($books))
 print "4<b>$book</b><br>";
	
$books = array("Matthew" => 1, "Mark" => 2, "Luke" => 3, "John" => 4);
//foreach ($book = each($books))
   //print "5<b>$book["key"]</b>";
	
$books = array("Matthew" => 1, "Mark" => 2, "Luke" => 3, "John" => 4);
foreach ($books as $book => $order)
   print "6<b>$book</b><br>";
	
$books = array("Matthew", "Mark", "Luke", "John");
//while ($books as $book)
   print "7<b>$book</b><br>";
	
$books = array("Matthew", "Mark", "Luke", "John");
while ($book = next($books))
   print "8<b>$book</b><br>";

?>