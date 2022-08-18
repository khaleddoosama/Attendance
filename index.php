<?php
    $title ='Index';
    require_once('./includes/header.php');
    require_once('./db/conn.php');

    $results = $crud->getSpecialties();
?>

        <h1 class="text-center mt-5">Registrations For It Conference</h1>
       <!-- 
        - First name
        - Last Name
        - Date of Birth (Use DatePicker)
        - Specialty (Database Admin, SOftware Developer, Web Administrator, Other)
        - Email Address
        - Contact Number
     -->

    <form method="post" action="success.php"enctype="multipart/form-data">
        <div class="form-group">
            <label for="firstName">First Name</label>
            <input required type="text" class="form-control" id="firstName" name="firstName">
        </div>
        <div class="form-group">
            <label for="lastName">Last Name</label>
            <input required type="text" class="form-control" id="lastName" name="lastName">
        </div>
        <div class="form-group">
            <label for="dob">Date Of Birth</label>
            <input type="text" class="form-control" id="dob" name="dob" readonly>
        </div>
        <div class="form-group">
            <label for="specialty">Area of Expertise</label>
            <select class="form-control" id="specialty" name="specialty" required>
                <option value="" disabled selected>Select</option>
                <?php while($r = $results->fetch(PDO::FETCH_ASSOC)){
                    echo "<option value='{$r['specialty_id']}'>{$r['name']}</option>";
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label for="email">Email address</label>
            <input required type="email" class="form-control" id="email"  name="email" aria-describedby="emailHelp" >
            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>
        <div class="form-group">
            <label for="phone">Contact Number</label>
            <input type="text" class="form-control" id="phone" name="phone" aria-describedby="phoneHelp" >
            <small id="phoneHelp" class="form-text text-muted">We'll never share your number with anyone else.</small>
        </div>
        <br/>
        <div class="custom-file">
            <input type="file" accept="image/*" class="custom-file-input form-control" id="avatar" name="avatar" >
            <label class="custom-file-label" for="avatar">Choose File</label>
            <small id="avatar" class="form-text text-danger">File Upload is Optional</small>
        </div>
        <br/>
        
        <button type="submit" name="submit" class="btn btn-primary btn-block form-control">Submit</button>
    </form>


<?php require_once('./includes/footer.php'); ?>
        
