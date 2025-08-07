<?php
include_once('header.php');

$conn = mysqli_connect(hostname:'localhost', username:'root', database:'dziennik');
?>
  <form action="grates.php" method="post">
    <div class="row g-3 align-items-center">
      <div class="col-auto">
        <label for="id user" class="col-form-label">ID user</label>
      </div>
      <div class="col-auto">
        <input type="text" id="id_user" name="id_user" class="form-control" aria-describedby="passwordHelpInline">
      </div>
      <div class="col-auto">
      </div>
    </div>
    <button type="submit" class="btn btn-outline-primary">Show grates</button>
  </form>

<div class="container my-5">
  <table class="table">
    <thead>
  
    <?php

      if (isset($_POST['id_user'])) {
        $user_id = $_POST['id_user'];
        //echo $user_id;
      
    // ПОлучаем каждую срднюю оценку
    $query = "SELECT subjects.name, grades.sub_id, ROUND(AVG(grade),2) AS avg_grade
              FROM `grades` LEFT JOIN subjects ON subjects.id=grades.sub_id 
              WHERE user_id=$user_id GROUP BY `grades`.`sub_id`;";

    $result = mysqli_query($conn, $query);

    $totalQuery = mysqli_fetch_all($result, MYSQLI_ASSOC);
    
    /* 
  $totalQuery = [
    ['name' => 'Math', 'sub_id' => 2, 'avg_grade' => 4.5],
    ['name' => 'History', 'sub_id' => 5, 'avg_grade' => 3.8]
  ];
*/
    
    // period 1
    $query1 = "SELECT sub_id, AVG(grade) AS grade_first FROM `grades` 
    WHERE created_ad < '2025-05-08' AND user_id=$user_id
    GROUP BY sub_id;";
    $result = mysqli_query($conn, $query1);
    $totalQuery1 = mysqli_fetch_all($result, MYSQLI_ASSOC);


    // period 2
    $query2 = "SELECT sub_id, AVG(grade) AS grade_second FROM `grades` 
    WHERE created_ad > '2025-05-08' AND user_id=$user_id
    GROUP BY sub_id;";
    $result = mysqli_query($conn, $query2);
    $totalQuery2 = mysqli_fetch_all($result, MYSQLI_ASSOC);


    //echo '<pre>';
    // var_dump($totalQuery, $totalQuery1, $totalQuery2);
   
    //$finallArr=array_merge($totalQuery, $totalQuery1, $totalQuery2);

    // для отклдаки провери 
    $allArray = [];
    foreach($totalQuery as $item) { $allArray[] = $item; }
    foreach($totalQuery1 as $item){ $allArray[] = $item; }
    foreach($totalQuery2 as $item){ $allArray[] = $item; }
    echo "<pre>";
    print_r($allArray);
    


    $subjects = [];

    foreach ($totalQuery as $item) {
        $subId = $item['sub_id'];
        
        if(!isset($subjects[$subId])){
          $subjects[$subId] = [
            'name' => $item['name'],
            'sub_id' => $subId,
            'avg_grade' => $item['avg_grade']
          ];
        }
    }

 
    foreach ($totalQuery1 as $item) {
        $subId = $item['sub_id'];

        $subjects[$subId]['first_grade'] = $item['grade_first'];
    }

    
    foreach ($totalQuery2 as $item) {
        $subId = $item['sub_id'];

        $subjects[$subId]['second_grade'] = $item['grade_second'];
    }

  
    // echo "<table>"; 
    //   echo "<tr>";
    //     echo "<th> Name subject</th>";
    //     echo "<th>sub id</th>";
    //     echo "<th>avg grade</th>";
    //     echo "<th>first_grade</th>";
    //     echo "<th>second_grade</th>";
    //   echo "</tr>";
    function colorCell($grade){
      if($grade <= 3) { return 'table-danger';}
      elseif($grade < 5) { return 'table-warning';}
      else {return 'table-success';}
    }
    // print_r($finallArr);
    foreach($subjects as $items){
       if (isset($items['name']) && isset($items['avg_grade']) && isset($items['sub_id']) && isset($items['first_grade']) && isset($items['second_grade'])) {
        echo "<tr>";
        echo "<th>" . $items['name'] . "</th>";
        echo "<th>" . $items['sub_id'] . "</th>";
        echo '<th class="' . colorCell($items['avg_grade']) . '">' . $items['avg_grade'] . '<th>';    
           
      //echo '<th class="'table-danger'">' . $items['first_grade'] . '<th>';
        echo '<th class="' . colorCell($items['first_grade']) . '">' . $items['first_grade'] . '<th>'; 
        echo '<th class="' . colorCell($items['second_grade']) . '">' . $items['second_grade'] . '<th>';
        
        echo "</tr>";
        }
        // echo "<tr>
        //   <th scope=\"row\">{$items['name']}</th>
        //   <td>{$items['grade_first']}</td>
        //   <td>{$items['grade_second']}</td>
        //   <td>{$items['avg_grade']}</td>
        //   <td><button type=\"button\" class=\"btn btn-primary\">Add Grades</button></td>
        // </tr>";
    } 
  }
    ?>
  </table>

</div>
<?php
include_once('footer.php');
?>