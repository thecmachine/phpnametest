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
// basic name key
  foreach($names as $key => $name){
    print '<br>';
    print_r($name[0] . " name: " . $name[2] . " parent ID: " . $name[1]);
  }
  print '<br>';

  $namesToJson = array();
  // $currentParent = 0;
  $namesCopy = $names;
  foreach($names as $key => $name){

    $namesToJson[$name[0]] = array(
      'id' => $name[0],
      'parent_id' => $name[1],
      'name' => $name[2],
      'children' => array(),
    );
    foreach($namesCopy as $copyKey => $copyName){
      if($name[0] == $copyName[1]){
        $namesToJson[$name[0]]['children'][] = array(
          'id' => $copyName[0],
          'parent_id' => $name[1],
          'name' => $copyName[2],
          'children' => array(),
        );
      }
    };

   //loop through array of names popping the rest after the current parent doesnt match 
   //todo do something with $currentParent 
  }

  //todo compress array nest children up, array_lift? 
  print_r(json_encode($namesToJson, JSON_PRETTY_PRINT));
  print "<br>";
  //json broken pretty print
  print_r(json_encode($names, JSON_PRETTY_PRINT));


  ?>
  </html>