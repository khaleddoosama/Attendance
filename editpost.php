<?php
    require_once('./db/conn.php');

    if (isset($_POST['submit'])){
        // extract values from the $_post array
        $id = $_POST['id'];
        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $dob = $_POST['dob'];
        $specialty = $_POST['specialty'];
        $email = $_POST['email'];
        $contact = $_POST['phone'];

        //call crud function
        $result = $crud->editAttendee($id, $firstName, $lastName, $dob, $email, $contact, $specialty);

        if($result){
            header("Location: view.php?id=$id");
        } else {
            include './includes/errormessage.php';
        }
    }
    else {
        include './includes/errormessage.php';
    }

?>