<?php

$sth = $dbh->prepare("SELECT name, colour FROM fruit");
$sth->execute();

/* Fetch all of the remaining rows in the result set */
$result = $sth->fetchAll();

/* Fetch all of the values of the first column */
$result = $sth->fetchAll(PDO::FETCH_COLUMN, 0);


// changes to do 8-1-2020
// write distructor in model for close connection



// 30-1-2020
// status codes for lead
// 0 => if technician id is 0 in complaint_master =  New lead
// 1 =  if technician assigned then make status 1 in complaint_master = pending lead
// 2 solved
// 3 cant solved
///

// lead status 

//  users [
//     list []
//   status []

//  ]    
  
//   primary lead source
//   campeign offer


?>