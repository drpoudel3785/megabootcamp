<?php
include_once('inc_sessioncheck.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.css" />
    <title>Settings</title>
</head>

<body>

    <?php include('inc_welcomemenu.php'); ?>
    <div class="container-fluid">
        <div class="row">
            <?php include('inc_sidemenu.php'); ?>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 mt-3">
                <div class="row">
                    <div class="col-xxl-4">

                        <?php
                        if (isset($_POST['submit'])) {
                            //getting data fromform
                            $nm = $_POST['name'];
                            $val = $_POST['value'];

                            //sql
                            $sql = "INSERT INTO settings(name, value) VALUES ('$nm', '$val')";

                            //db connection
                            include('dbconnection.php');

                            //query
                            $query  = mysqli_query($conn, $sql) or die(mysqli_error($conn));

                            if ($query) {
                                echo "Data Inserted Successfully";
                            } else {
                                echo "Something Error";
                            }
                        }

                        ?>
                        <form method="post" name='addsetting' action="settings.php" class=" border p-4">
                            <fieldset>
                                <legend>Add Setting</legend>
                                <label>Name</label>
                                <input type="text" name="name" class="form-control">
                                <br />
                                <label>Value</label>
                                <input type="text" name="value" class="form-control">
                                <br />
                                <input type="submit" name='submit' value="Add">
                            </fieldset>
                        </form>
                    </div>
                    <div class="col-xxl-8">
                        <div class="table-responsive">
                            <h2>Display of all Settings</h2>

                            <?php
                            $sql = "SELECT * from settings order by id DESC";

                            include('dbconnection.php');

                            $query = mysqli_query($conn, $sql);

                            $count = mysqli_num_rows($query);
                            if ($count >= 1) {
                                echo "There are total $count records";
                                echo "<table class='table table-striped table-sm'>
<tr><th>ID</th><th>Name</th><th>Value</th><th>Action</th></tr>";

                                while ($row = mysqli_fetch_array($query)) {
                                    echo "<tr>";
                                    echo "<td>" . $row['id'] . "</td>";
                                    echo "<td>" . $row['name'] . "</td>";
                                    echo "<td>" . $row['value'] . "</td>";
                                    echo "<td><a class='btn btn-primary btn-sm' href='settings_edit.php?id=".$row['id']. "'>EDIT</a> <a class='btn btn-danger btn-sm' href='settings_delete.php?id=" . $row['id'] . "'>DELETE</a></td>";
                                }

                                echo "</table>";
                            } else {
                                echo "No records Found";
                            }

                            ?>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>


</body>

</html>