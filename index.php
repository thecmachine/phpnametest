<html>
<?php 
  print '<h1>Hello</h1>';
  // $names = str_getcsv('names.csv');
  $names = array_map('str_getcsv', file('names.csv'));
  
  array_shift($names);
  //sort array by parent
  print_r( $names );
  print '<br>';  
  function sortByOrder($a, $b) {
    return $a['1'] - $b['1'];
  }

  usort($names, 'sortByOrder' );
  print_r( $names );
  print '<br>';  

  foreach($names as $key => $name){
    print '<br>';
    print_r($name[0] . " name: " . $name[2] . " parent ID: " . $name[1]);
  }
  print '<br>';

  $namesToJson = array();
  // $currentParent = 0;
  foreach($names as $key => $name){

    $namesToJson[$name[0]] = array(
      'id' => $name[0],
      'name' => $name[2],
      'children' => array(),
    );

   //loop through array of names popping the rest after the current parent doesnt match 
   //todo do something with $currentParent 
  }





  print_r(json_encode($namesToJson, JSON_PRETTY_PRINT));


  print "<br>";
  

  print_r(json_encode($names, JSON_PRETTY_PRINT));



  ?>
  </html>