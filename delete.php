
<?php 
	include 'Model.php';
    $model = new Model();
	$id = $_REQUEST['id'];

    try {
        $delete = $model->delete($id);

        header("Location: /subscribers.php");
        exit();
    } catch (Exception $e) {
        die($e->getMessage());
    }   

    ?>