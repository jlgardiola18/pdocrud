<?php 

    require_once("session.php");
    require_once("dbconfig.php");

    if(isset($_POST['update'])){

        $userid = intval($_GET['id']);
        $fname = $_POST['first_name'];
        $lname = $_POST['last_name'];
        $email = $_POST['email'];
        $contact = $_POST['contact_number'];
        $address = $_POST['address'];

        $sql = "UPDATE tblusers SET first_name=:fn, last_name=:ln, email=:eml, contact_number=:cno, address=:adrss WHERE ID=:uid";
        
        $query = $dbh->prepare($sql);

        $query->bindParam(':fn',$fname,PDO::PARAM_STR);
        $query->bindParam(':ln',$lname,PDO::PARAM_STR);
        $query->bindParam(':eml',$email,PDO::PARAM_STR);
        $query->bindParam(':cno',$contact,PDO::PARAM_STR);
        $query->bindParam(':adrss',$address,PDO::PARAM_STR);
        $query->bindParam(':uid',$userid,PDO::PARAM_STR);

        $query->execute();

        echo "<script>alert('Record Updated Successfully!');</script>";
        echo "<script>window.location.href='dashboard.php'</script>";
        
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
                <h3>Update Information</h3>
            </div>
        </div>

        <?php
            $userid=intval($_GET['id']);
            $sql = "SELECT * FROM tblusers WHERE ID = :uid";
            $query = $dbh->prepare($sql);

            $query->bindParam('uid',$userid,PDO::PARAM_STR);
            $query->execute();
            $result=$query->fetchAll(PDO::FETCH_OBJ);

            $cnt=1;
            if($query->rowCount() > 0)
            {
                foreach($result as $results);
                {
        ?>

    <form name="insertrecord" method="POST">

        <div class="row">
            <div class="col-md-6">
                <b>First Name</b>
                <input type="text" name="first_name" value="<?php echo htmlentities($results->first_name);?>" class="form-control" required>
            </div>

            <div class="col-md-6">
                <b>Last Name</b>
                <input type="text" name="last_name" value="<?php echo htmlentities($results->last_name);?>" class="form-control" required>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <b>Email Address</b>
                <input type="text" name="email" value="<?php echo htmlentities($results->email);?>" class="form-control" required>
            </div>
            
            <div class="col-md-6">
                <b>Contact Number</b>
                <input type="text" name="contact_number" value="<?php echo htmlentities($results->contact_number);?>" class="form-control" required>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <b>Address</b>
                <textarea type="text" name="address" class="form-control" required><?php echo htmlentities($results->address);?></textarea>
            </div>
        </div>

        <?php

            }}
        ?>

        <div class="row" style="margin-top:1%">
            <div class="col-md-12">
                <input type="submit" name="update" class="btn btn-success" value="Update">
                <a href="dashboard.php" class="btn btn-danger">Back</a>
            </div>
        </div>

    </form>

    </div>


</body>
</html>