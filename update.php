<?php require "config/config.php"; ?>
<?php
    if(isset($_GET['upd'])){
        $id = $_GET['upd'];
        $query = "SELECT * FROM person WHERE id=$id";
        $fire = mysqli_query($con,$query) or die("Can not fetch the data.".mysqli_error($con));
        $user = mysqli_fetch_assoc($fire);  
    }
?>
<!-- Update data  -->
<?php
    if(isset($_POST['btnupdate'])){
        $name = $_POST['name'];
        $email = $_POST['email'];
        $age = (int)$_POST['age'];
        $address = $_POST['address'];
        $phone = $_POST['phone'];

        $query = "UPDATE person SET name ='$name', age = $age ,email = '$email',address = '$address',phone = '$phone' WHERE id=$id";
        $fire = mysqli_query($con,$query) or die("Can not update the data. ".mysqli_error($con));

        if($fire) header("Location:index.php");

    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
    <title>Document</title>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">                
                <!-- Signup form -->
                <div class="col-lg-4 col-lg-offset-4">
                    <h3>Update Data</h3>
                    <hr>
                    <form name="signup" id="signup" action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
                        <div class="form-group">
                            <label  for="name">Fullname</label>
                            <input value="<?php echo $user['name'] ?>"  name="name" id="name" type="text" class="form-control" placeholder="name">
                        </div>
                        <div class="form-group">
                            <label  for="age">Age</label>
                            <input value="<?php echo $user['age'] ?>"  name="age" id="age" type="text" class="form-control" placeholder="age">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input value="<?php echo $user['email'] ?>" name="email" id="email" type="email" class="form-control" placeholder="email">
                        </div>
                        <div class="form-group">
                            <label for="address">Address</label>
                            <input value="<?php echo $user['address'] ?>" name="address" id="address" type="text" class="form-control" placeholder="address">
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input value="<?php echo $user['phone'] ?>" name="phone" id="phone" type="text" class="form-control" placeholder="phone">
                        </div>
                        <div class="form-group">                            
                           <button name="btnupdate" id="btnupdate" class="btn btn-primary btn-block">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>