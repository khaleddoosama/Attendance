<?php
    $title ='View Records';
    require_once('./includes/header.php');
    require_once('./includes/auth_check.php');
    require_once('./db/conn.php');

    $results = $crud->getAttendees();
?>

<table class='table'>
    <tr>
        <th>#</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Specialty</th>
        <th>Actions</th>
    </tr>
    <?php while($r = $results->fetch(PDO::FETCH_ASSOC)){
        echo "<tr>";
            echo "<td>{$r['attendee_id']}</td>";
            echo "<td>{$r['firstname']}</td>";
            echo "<td>{$r['lastname']}</td>";
            echo "<td>{$r['name']}</td>";
            echo "<td>
                <a href='view.php?id={$r['attendee_id']}' class='btn btn-primary'>View</a>
                <a href='edit.php?id={$r['attendee_id']}' class='btn btn-warning'>Edit</a>
                <a href='delete.php?id={$r['attendee_id']}' class='btn btn-danger' onclick='return confirm(\"Are you sure you want to delete this record?\")'>Delete</a>
            </td>";
        echo "</tr>";
    }      
    ?>
</table>



<?php require_once('./includes/footer.php'); ?>
