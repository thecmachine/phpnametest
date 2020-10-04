
<?php 
  header('Content-Type: application/json; charset=utf-8');
  print 'Hello';
  // $names = str_getcsv('names.csv');
  $names = array_map('str_getcsv', file('names.csv'));
  
  //remove headers 
  array_shift($names);

  //sort array by parent
  // print_r( $names );
  // print '<br>';  
  function sortByOrder($a, $b) {
    return $a['1'] - $b['1'];
  }
  usort($names, 'sortByOrder' );
  // print_r( $names );
  // print '<br>';  
  
// basic name key
  foreach($names as $key => $name){
    // print '<br>';
    // print_r($name[0] . " name: " . $name[2] . " parent ID: " . $name[1]);
  }
  // print '<br>';

  $namesToJson = array();
  // $currentParent = 0;
  $namesCopy = $names;
  foreach($names as $key => $name){

    $namesToJson[$name[0]] = array(
      'id' => $name[0],
      // 'parent_id' => $name[1],
      'name' => $name[2],
      'children' => array(),
    );
    foreach($namesCopy as $copyKey => $copyName){
      if($name[0] == $copyName[1]){
        $namesToJson[$name[0]]['children'][] = array(
          'id' => $copyName[0],
          // 'parent_id' => $name[1],
          'name' => $copyName[2],
          'children' => array(),
        );
      }
    };

   //loop through array of names popping the rest after the current parent doesnt match 
   //todo do something with $currentParent 
  }

  //master copy
  $masterCopy = array();
  foreach($namesToJson as $keyCopy => $nameCopy){
    // print_r($nameCopy);
    // print '<br>';
    $masterCopy[] = array(
      'id' => $nameCopy['id'],
      'name' => $nameCopy['name'],
      'children' => $nameCopy['children'],
    );
    // print_r($nameCopy['id'] . " name: " . $nameCopy['name'] . " Children:");
    foreach($nameCopy['children'] as $kidKey => $kid){
      // print '<br>';

      // print_r("KID".$kid['id'] . " KIDname: " . $kid['name'] . " Children:");
    }
  }
  // print '<br><br/>';
  // print_r($masterCopy);
  // print '<br><br/>';
  print_r(json_encode($masterCopy, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
  // print '<br><br/>';
  
  //todo compress array nest children up, array_lift? 
  // print_r(json_encode($namesToJson, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
  // print "<br>";

  //json broken pretty print
  // print_r(json_encode($names, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));


  ?>
