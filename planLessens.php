<?php
  session_start();
  $conn = mysqli_connect('localhost', 'root', '', 'dziennik');
?>
<?php
    include_once('header.php');
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>op</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.css" rel="stylesheet">

  </head>
  <body>
      <div class="container my-5">
      <h1>planLessens!</h1>
      <div class="col-lg-8 px-0">
<?php
      if(!isset($_SESSION["day"])){
        $_SESSION["day"] = 1;
      }
      //echo "set " . $_SESSION["day"];
      
      if(isset($_POST['back'])){
        $_SESSION["day"] = --$_SESSION["day"];
        if($_SESSION["day"] < 1){
          $_SESSION["day"] = 5;
        }
      }
       
      else if(isset($_POST['next'])){
        $_SESSION["day"] = ++$_SESSION["day"];
        if($_SESSION["day"] > 5){
          $_SESSION["day"] = 1;
        }
      }
      $day =  $_SESSION["day"];
      
     
      // $query = "SELECT DISTINCT weekday FROM `lessens`;";
      // $query = "SELECT weekday FROM `lessens`;";
      // $result = mysqli_query($conn, $query);
      // while($row=mysqli_fetch_assoc($result)){
      //   $day = $row['weekday'];
        //$today = "Today: ";
        // echo "day: " . $row['weekday'];
        
      $table_class = [
      '-primary', 
      '-secondary',
      '-success', 
      '-danger', 
      '-warning', 
      '-light',
      '-dark'
    ];
      //$table_class_lenth = count($table_class);

      //$query = "SELECT lessens.num_less AS num_less, subjects.name AS name_subject FROM lessens INNER JOIN subjects ON lessens.sub_id=subjects.id;";
      //$query = "SELECT lessens.num_less AS num_less, subjects.name AS name_subject FROM lessens INNER JOIN subjects ON lessens.sub_id=subjects.id WHERE lessens.weekday = $day;";
      // $query = "SELECT lessens.num_less AS num_less, subjects.name AS name_subject  FROM lessens INNER JOIN subjects ON lessens.sub_id=subjects.id 
      // WHERE lessens.weekday = $day ORDER BY lessens.num_less ASC;";
      $query = "SELECT lessens.num_less AS num_less, subjects.name AS name_subject, lessens.start_time AS start_less, lessens.end_time AS end_less, lessens.classroom AS classroom 
      FROM lessens INNER JOIN subjects ON lessens.sub_id=subjects.id WHERE lessens.weekday = $day ORDER BY lessens.num_less ASC;";

      $result=mysqli_query($conn, $query);
      echo '<table class="table">';
        echo '<tr>';
          echo '<th>№</th>';
          echo '<th>Subject</th>';
          echo '<th>Time start</th>';
          echo '<th>Time end</th>';
          echo '<th>Classroom</th>';
        echo  '</tr>';
        $i = 0;
        while($row=mysqli_fetch_assoc($result)){
          echo '<tr class="table' . $table_class[$i] . '">'; 
            echo '<td>' . $row['num_less'] . '</td>';
            echo '<td>' . $row['name_subject'] . '</td>';
            echo '<td>' . $row['start_less'] . '</td>';
            echo '<td>' . $row['end_less'] . '</td>';
            echo '<td>' . $row['classroom'] . '</td>';
          echo '</tr>';
          $i++;
        }
      echo '</table>';
      switch($day){
          case "1":
            $day = "Monday";
            break;
          case "2":
            $day = "Tuesday";
            break;
          case "3":
            $day = "Wensday";
            break;
          case "4":
            $day = "Thursday";
            break;
           case "5":
            $day = "Friday";
            break;
          case "6":
            $day = "Satterday";
            break;
          case "7":
            $day = "Sunday";
            break;
        }
        
        echo '<h3>' . $day . '</h3>';
   
    ?> 
    
    <form action="planLessens.php" method="post">
        <button type="submit" name="back" class="btn btn-dark btn-sm">&lt</button>
        <button type="submit" name="next" class="btn btn-dark btn-sm">&gt</button>
    </form>
    
        <hr class="col-1 my-4">

        <a href="messages.php" class="btn btn-primary">Messages</a>
        <a href="ogloszenia.php" class="btn btn-secondary">ogloszenia</a>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
  </body>
</html>
<?php
    include_once('footer.php');
?>
