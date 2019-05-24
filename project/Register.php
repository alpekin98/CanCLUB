<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/css/bootstrap.min.css">
    <title>Register</title>
<style>
li {
    list-style-position:inside;
    border: 1px solid black;
}
</style>

</head>

<body>

<nav class="navbar navbar-dark bg-dark navbar-expand-lg">
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="nav navbar-nav ml-auto">
            <?php
                echo'
                    <li class="nav-item"><a class="nav-link" href="http://localhost:8080/project/register.php">Register</a></li>
                    <li class="nav-item"><a class="nav-link" href="http://localhost:8080/project/login.php">Login</a></li>
                ';
            ?>
        </ul>
    </div>
</nav>

<div class="container">
    <div >
        <div>
            <h3>Register</h3>
            <form name="form1" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="lblFirstname" >
                </div>
                <div class="form-group">
                    <label>Surname</label>
                    <input type="text" name="lblSurname" >
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email"  name="lblEmail" >
                </div>
                <div class="form-group">
                    <label>Username</label>
                    <input type="text"  name="lblUsername" >
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password"  minlength="5" name="lblPassword" >
                </div>
                <div class="form-group">
                    <label>Birth Date</label>
                    <input type="date" name="lblBirthDate" value="2019-01-01" min="1950-01-01" max="2023-01-01">
                </div>
                <div class="form-group">
                    <label>Department</label>
                    <input type="text" name="lblDepartment">
                </div>
                
            
                Select image to upload:
                <input type="file" name="fileToUpload" id="fileToUpload" value="Choose image"><br>
                <input type="submit" value="Upload Image" name="submit">
                </form>
        </div><hr>
    </div>
</div>
</body>

<?php
	include('DbConnection.php');
    session_start();
    
	$Firstname = $_POST['lblFirstname'];
	$Surname = $_POST['lblSurname'];
    $Email = $_POST['lblEmail'];
    $Username = $_POST['lblUsername'];
    $Password= $_POST['lblPassword'];
	$BirthDate = $_POST['lblBirthDate'];
    $Department = $_POST['lblDepartment'];
    $Photo = "";
    $Admin = 0;

	$query="SELECT * FROM users WHERE Email='$Email'";
	$result=mysqli_query($DB_Connection,$query);
	$row=mysqli_fetch_array($result,MYSQLI_ASSOC);

	if(mysqli_num_rows($result) != 1 && $Email != '') {
        
        // BURADAN SONRASINI SİLECEKSİN UŞAĞIM
        // BURADAN SONRASINI SİLECEKSİN UŞAĞIM
        // BURADAN SONRASINI SİLECEKSİN UŞAĞIM

        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);

        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        if(isset($_POST["submit"]))
        {
            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            if($check !== false)
                $uploadOk = 1;
            else 
                $uploadOk = 0;
        }
        if (file_exists($target_file))
            $uploadOk = 0;
        if ($_FILES["fileToUpload"]["size"] > 1000000)
            $uploadOk = 0;
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" )
            $uploadOk = 0;
        
        if ($uploadOk != 0) 
            move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);

        $Photo = $target_file;

        // BURADAN ÖNCESİNİ SİLECEKSİN UŞAĞIM
        // BURADAN ÖNCESİNİ SİLECEKSİN UŞAĞIM
        // BURADAN ÖNCESİNİ SİLECEKSİN UŞAĞIM
        
		$registration_query = "INSERT INTO users(Firstname,Surname,Username,Email,BirthDate,Department,Password,Photo,Admin) 
                                VALUES ('$Firstname','$Surname','$Username','$Email','$BirthDate','$Department','$Password','$Photo','$Admin');
                                ";
		$registration_query_result=mysqli_query($DB_Connection,$registration_query);
		echo '<script language="javascript"> alert("Registration completed.") </script>';
	}
	else
        echo '<script language="javascript" alert("This email is already registered. Please enter a different email.")</script>';
?>

</html>