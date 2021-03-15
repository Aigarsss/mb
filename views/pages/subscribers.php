<?php

$page = new Pages();

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
  <link rel="stylesheet" href="/style/style.css">

  <style>
  table, tr, td {
    border: 1px solid black;
    border-collapse: collapse;
    padding: 5px 15px;
  }
  </style>

</head>

<body style ="overflow: scroll; position: static; margin: 15px;">

    <h1 style="margin-bottom: 15px;">Subscribers</h1>

    <p style="color:red;"> Applied filters: 
    
    <?php

        if (sizeof($data["appliedFilters"]) == 0 || (isset($data["appliedFilters"]['filter']) && $data["appliedFilters"]['filter'] == "Reset")) {
            echo "None";
        } else {
            foreach($data["appliedFilters"] as $name => $value){
                echo $name."=".$value." | ";
            }
        }

    ?>
    
    </p>

    <a href="/">Back</a>

    <form action="" method="GET" style="margin-bottom: 15px; padding: 5px;">
        <input type="text" name="search" placeholder="Search..." style="padding: 5px;">
        <button> Search</button>
    </form>

    <form action="" method="GET">
        <div> Filter: 

            <button type="sumbit" name = "filter" value = "Reset" style="margin: 5px; padding: 5px;">Reset</button>

            <!-- Getting the filtering buttons. Not sure if it is okay to do this. i would think not -->
            <?php 
            $rows = $page->connection->getProviders();

            if(!empty($rows)) {
                foreach($rows as $row) {
            ?>

            <button type="sumbit" name = "filter" value =  <?= $row['provider']; ?> style="margin: 5px; padding: 5px;"><?= $row['provider']; ?></button>

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


        if(!empty($data['rows'])) {
            foreach($data['rows'] as $row) {
        ?>

        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['date']; ?></td>
            <td><?php echo $row['email']; ?></td>
            <td><?php echo $row['provider']; ?></td>
            <!-- TODO -->
            <td><a href="?deleteId=<?php echo $row['id']; ?>">Delete</a></td> 
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