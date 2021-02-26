<?php

session_start();
require 'Model.php';

// Creating session variables so that multi-filtering can be used
if (isset($_GET['search'])) {
    $_SESSION["search"] = $_GET['search'];
} if (isset($_GET['filter'])) {
    $_SESSION["filter"] = $_GET['filter'];
} if (isset($_GET['orderBy'])) {
    $_SESSION["order"] = $_GET['orderBy'];
} if (isset($_GET['direction'])) {
    $_SESSION["direction"] = $_GET['direction'];
}

$model = new Model();

?>

<!doctype html>
<html lang="">

<head>
  <meta charset="utf-8">
  <title>Pineapple Inc subscribers</title>
  <meta name="description" content="Buy your pineapple sunglasses here">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <meta property="og:title" content="">
  <meta property="og:type" content="">
  <meta property="og:url" content="">
  <meta property="og:image" content="">

  <link rel="icon" type="image/png" sizes="32x32" href="img/favicon-32x32.png">
  <link rel="stylesheet" href="style/style.css">

</head>

<body style ="overflow: scroll; position: static; margin: 15px;">

    <h1 style="margin-bottom: 15px;">Subscribers</h1>

    <p style="color:red;"> Applied filters: 
    
    <?php

        if (sizeof($_SESSION) == 0) {
            echo "None";
        } else {
            foreach($_SESSION as $name => $value){
                echo $name."=".$value." | ";
            }
        }

    ?>
    
    </p>

    <a href="/index.php">Back</a>

    <form action="" method="GET" style="margin-bottom: 15px; padding: 5px;">
        <input type="text" name="search" placeholder="Search..." style="padding: 5px;">
        <button> Search</button>
    </form>

    <form action="" method="GET">
        <div> Filter: 

            <button type="sumbit" name = "filter" value = "Reset" style="margin: 5px; padding: 5px;">Reset</button>

            <!-- Getting the filtering buttons -->
            <?php 
            $rows = $model->getProviders();

            if(!empty($rows)) {
                foreach($rows as $row) {
            ?>

            <button type="sumbit" name = "filter" value =  <?php echo $row->provider; ?> style="margin: 5px; padding: 5px;"><?php echo $row->provider; ?></button>

            <?php } 
            }

            ?>
        </div>
    </form>

    <table>
        <tr>
            <td>ID</td>
            <td>Date <a href="?orderBy=date&direction=asc">asc</a> <a href="?orderBy=date&direction=desc">desc</a></td>
            <td>Email <a href="?orderBy=email&direction=asc">asc</a> <a href="?orderBy=email&direction=desc">desc</a></td>
            <td>Provider</td>
            <td>Action</td>
        </tr>
        
        <!-- Getting the appropriate data from DB depending on the last entered filter -->
        <?php 

        if (isset($_GET['filter'])) {
            $rows = $model->filterProvider();
        } else if (isset($_GET['orderBy']) && isset($_GET['direction'])){
            $rows = $model->filterProvider();
        } else if (isset($_GET['search'])){
            $rows = $model->filterProvider();
        } else {
            $rows = $model->readAll();
        }

        if(!empty($rows)) {
            foreach($rows as $row) {
        ?>

        <tr>
            <td><?php echo $row->id; ?></td>
            <td><?php echo $row->date; ?></td>
            <td><?php echo $row->email; ?></td>
            <td><?php echo $row->provider; ?></td>
            <td><a href="delete.php?id=<?php echo $row->id; ?>">Delete</a></td>
        </tr>

        <?php 
            }
        } else {
            echo "no data";
        }
        
        ?>
    </table>
</body>
</html>
