<?php
    $title ='Edit Record';
    require_once('./includes/header.php');
    require_once('./includes/auth_check.php');
    require_once('./db/conn.php');

    $results = $crud->getSpecialties();

    if(!isset($_GET['id']))
    {
        include './includes/errormessage.php';
        header("Location: viewrecords.php");
    }
    else
    {
        $id = $_GET['id'];
        $attendee = $crud->getAttendeeDetails($id); 

?>

    <h1 class="text-center mt-5">Edit Record</h1>

    <form method="post" action="editpost.php">
        <input type="hidden" name="id" value="<?php echo $attendee['attendee_id']; ?>" />
        <div class="form-group">
            <label for="firstName">First Name</label>
            <input required type="text" class="form-control" id="firstName" name="firstName" value="<?php echo $attendee['firstname']?>">
        </div>
        <div class="form-group">
            <label for="lastName">Last Name</label>
            <input required type="text" class="form-control" id="lastName" name="lastName" value="<?php echo $attendee['lastname']?>">
        </div>
        <div class="form-group">
            <label for="dob">Date Of Birth</label>
            <input type="text" class="form-control" id="dob" name="dob" readonly value="<?php echo $attendee['dateofbirth']?>">
        </div>
        <div class="form-group">
            <label for="specialty">Area of Expertise</label>
            <select class="form-control" id="specialty" name="specialty">
                <option>Select</option>
                <?php while($r = $results->fetch(PDO::FETCH_ASSOC)){
                    echo "<option value='{$r['specialty_id']}' ".($r['specialty_id'] == $attendee['specialty_id'] ? 'selected' : '').">
                    {$r['name']}</option>";
                }

                ?>
            </select>
        </div>
        <div class="form-group">
            <label for="email">Email address</label>
            <input required type="email" class="form-control" id="email"  name="email" aria-describedby="emailHelp" value="<?php echo $attendee['emailaddress']?>" >
            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>
        <div class="form-group">
            <label for="phone">Contact Number</label>
            <input type="text" class="form-control" id="phone" name="phone" aria-describedby="phoneHelp" value="<?php echo $attendee['contactnumber']?>" >
            <small id="phoneHelp" class="form-text text-muted">We'll never share your number with anyone else.</small>
        </div>
        <br/>
        <!-- <div class="custom-file">
            <input type="file" accept="image/*" class="custom-file-input" id="avatar" name="avatar" >
            <label class="custom-file-label" for="avatar">Choose File</label>
            <small id="avatar" class="form-text text-danger">File Upload is Optional</small>
        </div> -->
        
        
        <a href="viewrecords.php" class="btn btn-default">Back To List</a>
        <button type="submit" name="submit" class="btn btn-success">Update</button>
    </form>

    <?php } ?>

<?php require_once('./includes/footer.php'); ?>
        
