<?php
    $munuLinks = [
        [
            'lable' => 'main page',
            'url' => '/ja/projectPHP/dziennik/index.php',
        ],
        [
            'lable' => 'messages',
            'url' => '/ja/projectPHP/dziennik/messages.php',
        ],
        [
            'lable' => 'planLessens',
            'url' => '/ja/projectPHP/dziennik/planLessens.php',
        ],
        [
            'lable' => 'ogloszenia',
            'url' => '/ja/projectPHP/dziennik/ogloszenia.php',
        ],
        [
            'lable' => 'attendance',
            'url' => '/ja/projectPHP/dziennik/attendance.php',
        ],
        [
            'lable' => 'Grate',
            'url' => '/ja/projectPHP/dziennik/grates.php',
        ]
    ];
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>op</title>
    <link href="bootstrap.css" rel="stylesheet">
  </head>
  <body>
    <!-- <h1>Hello, world!</h1> -->

      <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container">
<!-- grate -->
        <a class="navbar-brand" href="#">Grate</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>

        <!--  -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            
            <?php
                foreach($munuLinks as $link){
                    echo "<li class=\"nav-item\">
                    <a class=\"nav-link\" href=\"{$link['url']}\">{$link['lable']}</a>
                    </li>";
                }
            ?>
            
          </ul>


          <form class="d-flex" role="search">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success" type="submit">Search</button>
          </form>
        </div>
      </div>
    </nav>