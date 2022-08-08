<!DOCTYPE html>
<html lang="en">
<head>
    <title>Upload</title>
    <link rel="icon" type="image/x-icon" href="BranchLogo.png">
    <?php
        include_once("connection.php")

        if(isset($_POST['but_upload'])){
            $maxsize = 104857600; //5MB

            $name = $_FILES['file']['name'];
            $traget_dir = "tblvideos/";
            $target_file = $traget_dir . $_FILES["file"]["name"];

            //file type
            $videoFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

            //acceptable extensions
            $extensions_arr = array("mp4", "mov", "mpeg");

            //Checks the video extension
            if (in_array($videoFileType, $extensions_arr)){

                //now we compare file size
                if (($_FILES['file']['size'] >= $maxsize) || ($_FILES["file"]['size'] == 0)){
                    echo "File too large.";
                }else {

                    //UPLOADING BIT
                    if (move_uploaded_file($_FILES['file']['tmp_name'],$target_file)) {
                        
                        //insert into database
                        $query = "INSERT INTO tblVideos(filename, location) VALUES('".$name."','".$target_file."')";

                        mysqli_query($con,$query);

                        echo "upload done!";
                    }
                }
            }else{
                echo "file error";
            }


        }

    ?>
</head>
<body>
    <a href="placeholder.php">This page is still in the works, go back</a>
    <form method="post" action="" enctype="multipart/form-data">
        <input type='file' name='file'>
        <input type="submit" name="but_upload" value="upload">

    </form>
</body>
</html>
