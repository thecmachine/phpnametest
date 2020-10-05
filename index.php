
<?php 
  header('Content-Type: application/json; charset=utf-8');
  $names = array_map('str_getcsv', file('names.csv'));
  
  //remove headers 
  array_shift($names);
  
  function sortByParent($a, $b) {
    return $a['1'] - $b['1'];
  }
  usort($names, 'sortByParent' );
  
  $namesToJson = array();
  $namesCopy = $names;
  foreach($names as $key => $name){

    $namesToJson[$name[0]] = array(
      'id' => $name[0],
      'name' => $name[2],
      'children' => array(),
    );
    foreach($namesCopy as $copyKey => $copyName){
      if($name[0] == $copyName[1]){
        $namesToJson[$name[0]]['children'][] = array(
          'id' => $copyName[0],
          'name' => $copyName[2],
          'children' => array(),
        );
      }
    };
  }

  //todo implement ktree navigation for grandchildren mastercopy
  $masterCopy = array();
  foreach($namesToJson as $keyCopy => $nameCopy){
    $masterCopy[] = array(
      'id' => $nameCopy['id'],
      'name' => $nameCopy['name'],
      'children' => $nameCopy['children'],
    );
  }

  print_r(json_encode($masterCopy, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));

  ?>
