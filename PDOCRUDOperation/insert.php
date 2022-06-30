<?php

    require_once("session.php");
    require_once("dbconfig.php");

    if(isset($_POST['insert'])){

        $fname = $_POST['first_name'];
        $lname = $_POST['last_name'];
        $email = $_POST['email'];
        $contact = $_POST['contact_number'];
        $address = $_POST['address'];

        $sql = "INSERT INTO tblusers(first_name, last_name, email, contact_number, address) VALUES(:fn,:ln,:eml,:cno,:adrss)";
        $query = $dbh->prepare($sql);

        $query->bindParam(':fn',$fname,PDO::PARAM_STR);
        $query->bindParam(':ln',$lname,PDO::PARAM_STR);
        $query->bindParam(':eml',$email,PDO::PARAM_STR);
        $query->bindParam(':cno',$contact,PDO::PARAM_STR);
        $query->bindParam(':adrss',$address,PDO::PARAM_STR);

        $query->execute();

        $lastInsertId = $dbh->lastInsertId();

        if($lastInsertId){
            echo "<script>alert('Record Added Successfully!');</script>";
            echo "<script>window.location.href='dashboard.php'</script>";
        }else{
            echo "<script>alert('Something wrong with you!');</script>";
            echo "<script>window.location.href='dashboard.php'</script>";
        }

    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    
    <title>PHP CRUD Operation</title>

    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>

</head>
<body>
    
    <div class="container">

        <div class="row">
            <div class="col-md-12">
                <h3>Registration</h3>
            </div>
        </div>

        <hr />

    <form name="insertrecord" method="POST">

        <div class="row">
            <div class="col-md-6">
                <b>First Name</b>
                <input type="text" name="first_name" class="form-control" required>
            </div>

            <div class="col-md-6">
                <b>Last Name</b>
                <input type="text" name="last_name" class="form-control" required>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <b>Email Address</b>
                <input type="text" name="email" class="form-control" required>
            </div>
            
            <div class="col-md-6">
                <b>Contact Number</b>
                <input type="text" name="contact_number" class="form-control" required>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <b>Address</b>
                <textarea type="text" name="address" class="form-control" required></textarea>
            </div>
        </div>

        <div class="row" style="margin-top:1%">
            <div class="col-md-12">
                <input type="submit" name="insert" class="btn btn-success" value="Submit">
                <a href="dashboard.php" class="btn btn-danger">Back</a>
            </div>
        </div>

    </form>

    </div>


</body>
</html>