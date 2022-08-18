<?php
    $title ='View';
    require_once('./includes/header.php');
    require_once('./includes/auth_check.php');
    require_once('./db/conn.php');

    // print if data is post or get 
    $results = $crud->getSpecialties();

    if (!isset($_GET['id'])){
        include './includes/errormessage.php';
    }
    else {
        // Get the ID from the URL
        $id = $_GET['id'];
        $result = $crud->getAttendeeDetails($id);
    


?>
    <div class="card" style="width: 18rem;">
        <img src="<?php echo empty($result['avatar_path']) ? "uploads/blank.png" : $result['avatar_path'] ; ?>" class="rounded" />

        <div class="card-body">
            <h5 class="card-title">
                <?php echo $result['firstname'] . ' ' . $result['lastname'];  ?>
            </h5>
            <h6 class="card-subtitle mb-2 text-muted">
                <?php while($r = $results->fetch(PDO::FETCH_ASSOC)){
                    if($r['specialty_id'] == $result['specialty_id']){
                        echo $r['name'];
                    }
                }
                ?>
            </h6>
            <p class="card-text">
                Date Of Birth: <?php echo $result['dateofbirth'];  ?>
            </p>
            <p class="card-text">
                Email Adress: <?php echo $result['emailaddress'];  ?>
            </p>
            <p class="card-text">
                Contact Number: <?php echo $result['contactnumber'];  ?>
            </p>
        </div>
    </div>
    <br>
    <?php  echo "<td>
                <a href='viewrecords.php' class='btn btn-info'>Back To List</a>
                <a href='edit.php?id={$result['attendee_id']}' class='btn btn-warning'>Edit</a>
                <a href='delete.php?id={$result['attendee_id']}' class='btn btn-danger' onclick='return confirm(\"Are you sure you want to delete this record?\")'>Delete</a>
            </td>";
    }
    ?>



<?php require_once('./includes/footer.php'); ?>
