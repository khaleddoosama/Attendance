<?php
    $title = 'Success'; 
    require_once './includes/header.php'; 
    require_once './db/conn.php';
    if (isset($_POST['submit'])){
        // extract values from the $_post array
        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $dob = $_POST['dob'];
        $specialty = $_POST['specialty'];
        $email = $_POST['email'];
        $contact = $_POST['phone'];
        
        // upload the file
        $orig_file = $_FILES["avatar"]["tmp_name"];
        $ext = pathinfo($_FILES["avatar"]["name"], PATHINFO_EXTENSION);
        $target_dir = 'uploads/';
        $destination = "$target_dir$contact.$ext";
        move_uploaded_file($orig_file,$destination); 

        // call the function to insert and track if it was successful or not
        $isSuccess = $crud->insertAttendees($firstName, $lastName, $dob, $email, $contact, $specialty, $destination);

        if($isSuccess){
            include './includes/successmessage.php';
        } else {
            include './includes/errormessage.php';
        }
    }
    $results = $crud->getSpecialties();

?>
    
    <!-- This prints out values that were passed to the action page using method="post" -->
    <div class="card" style="width: 18rem;">
        <img src="<?php echo $destination; ?>" class="rounded" />
        <div class="card-body">
            <h5 class="card-title">
                <?php echo $_POST['firstName'] . ' ' . $_POST['lastName'];  ?>
            </h5>
            <h6 class="card-subtitle mb-2 text-muted">
                <?php while($r = $results->fetch(PDO::FETCH_ASSOC)){
                    if($r['specialty_id'] == $_POST['specialty']){
                        echo $r['name'];
                    }
                }
                ?>
            </h6>
            <p class="card-text">
                Date Of Birth: <?php echo $_POST['dob'];  ?>
            </p>
            <p class="card-text">
                Email Adress: <?php echo $_POST['email'];  ?>
            </p>
            <p class="card-text">
                Contact Number: <?php echo $_POST['phone'];  ?>
            </p>
    
        </div>
    </div>
    
    
<?php require_once 'includes/footer.php'; ?>