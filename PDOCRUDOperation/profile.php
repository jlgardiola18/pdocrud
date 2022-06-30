<?php 

    require_once("session.php");
    require_once("dbconfig.php");

    if(isset($_POST['upload'])){

        $userid = intval($_GET['id']);

        $file_name = $_FILES['file']['name'];
        $file_temp = $_FILES['file']['tmp_name'];
        $file_size = $_FILES['file']['size'];
        $file_type = $_FILES['file']['type'];

        $location="upload/".$file_name;
        
        if($file_size < 524880){
            if(move_uploaded_file($file_temp,$location)){
                try{
                    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $sql = "UPDATE tblusers SET photo='$location' WHERE ID='$userid'";
                    $dbh->exec($sql);
                }catch(PDOEexception $e){
                    echo $e->getMessage();
                }
                $dbh = null;
                header('location:dashboard.php');
            }
        }else{
            echo "<script>alert('File size is too large to upload!');</script>";
        }

    }

?>
    
<!DOCTYPE html>
<html lang="en">
<head>
    
    <title>PHP CRUD Operation</title>

    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/fileupload.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="js/fileupload.js"></script>

</head>
<body>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <form method="POST" enctype="multipart/form-data">
                    <!--<div class="form-group">
                        <label>Upload Here</label>
                        <input type="file" name="file" class="form-control" required>
                    </div>
                    <button type="submit" name="upload" class="btn btn-danger">Upload</button>
                    -->
                    <div class="file-upload">  <h3>Profile Upload</h3>
                        <button class="file-upload-btn" type="button" onclick="$('.file-upload-input').trigger( 'click' )"><span class="glyphicon glyphicon-picture"></span> Browse Photo</button>

                        <div class="image-upload-wrap">
                            <input class="file-upload-input" type='file' name="file" onchange="readURL(this);" accept="image/*" require/>
                            <div class="drag-text">
                            <h3>Drag and drop a file or Browse Image</h3>
                            </div>
                        </div>
                        <div class="file-upload-content">
                            <img class="file-upload-image" src="#" alt="your image" />
                            <div class="image-title-wrap">
                            <button type="button" onclick="removeUpload()" class="remove-image">Remove <span class="image-title">Uploaded Image</span></button>
                            </div>
                        </div>
                        <br>
                        <button type="submit" name="upload" class="btn btn-primary"> <span class="glyphicon glyphicon-upload"></span> Upload</button>
                        <a href="dashboard.php" class="btn btn-default"> <span class="glyphicon glyphicon-home"></span> Home</a>
                    </div>
                </form>
            </div>
        </div>
    </div>


</body>
</html>