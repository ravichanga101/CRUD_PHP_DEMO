<?php

include_once './classes/constants.php';
include_once './classes/database.php';
include_once './classes/user.php';

include_once './includes/db_connect.php';

$user = new User($db);

$from_record_num = 1;
$records_per_page = 25;

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <title>OOP CRUD</title>

</head>

<body>

    <div class="container">

        <?php include('./includes/menu.php'); ?>

        <div class="row">
            <div class="col-12">
                <div class='float-end m-3'>
                    <a href="create.php" class="btn btn-lg btn-primary">Create Users</a>
                </div>

                <?php
                // select all users
                $prep_state = $user->getAllUsers($from_record_num, $records_per_page); //Name of the PHP variable to bind to the SQL statement parameter.
                $num = $prep_state->rowCount();

                // check if more than 0 record found
                if ($num >= 0) {

                    echo "<table class='table table-hover table-responsive table-bordered'>";
                    echo "<tr>";
                    echo "<th>First Name</th>";
                    echo "<th>Last Name</th>";
                    echo "<th>E-Mail</th>";
                    echo "<th>Mobile</th>";
                    // echo "<th>Category</th>";
                    echo "<th>Actions</th>";
                    echo "</tr>";

                    while ($row = $prep_state->fetch(PDO::FETCH_ASSOC)) {

                        // extract($row); //Import variables into the current symbol table from an array
                        $id = $row['id'];

                        echo "<tr>";

                        echo "<td>$row[firstname]</td>";
                        echo "<td>$row[lastname]</td>";
                        echo "<td>$row[email]</td>";
                        echo "<td>$row[mobile]</td>";

                        echo "<td>";
                        // edit user button
                        // echo "<a href='edit.php?id=" . $id . "' class=' btn btn-warning m-1'>";
                        // echo "Edit";
                        // echo "</a>";

                        //delete user button
                        echo "<a href='actions/act_delete.php?id=" . $id . "' class='btn btn-danger delete-object'>";
                        echo "Delete";
                        echo "</a>";

                        echo "</td>";
                        echo "</tr>";
                    }

                    echo "</table>";

                    // include pagination file
                    // include_once 'pagination.php';
                }

                // if there are no user
                else {
                    echo "<div> No User found. </div>";
                }
                ?>
            </div>

            <?php include('./includes/footer.php'); ?>
        </div>


</body>

</html>