<?php

// require 'Model.php';

require 'Model.php';
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
    <a href="/index.php">Back</a>

    <form action="" method="GET" style="margin-bottom: 15px; padding: 5px;">
        <input type="text" name="search" placeholder="Search..." style="padding: 5px;>
        <button name="filter"> Search</button>
    </form>

    <form action="" method="GET">
        <div> Filter: 

            <button type="sumbit" name = "filter" value = "All" style="margin: 5px; padding: 5px;">All</button>
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
            <td>Date</td>
            <td>Email</td>
            <td>Provider</td>
            <td>Action</td>
        </tr>
        
        <?php 

        (isset($_GET['filter'])) ? $rows = $model->filterProvider() : $rows = $model->readAll(); 

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
