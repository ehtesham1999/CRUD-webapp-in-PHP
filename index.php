<?php require "config/config.php"; ?>

<?php    
    if((isset($_POST['submit']))){

        $name = mysqli_real_escape_string($con,trim($_POST['name']));
        $age =  mysqli_real_escape_string($con,trim($_POST['age']));
        $email = mysqli_real_escape_string($con,trim($_POST['email']));
        $address = mysqli_real_escape_string($con,trim($_POST['address']));
        $phone = mysqli_real_escape_string($con,trim($_POST['phone'])); 

        $name_valid = $email_valid = $phone_valid = $address_valid = $age_valid = false;

        //Check Fullname
        if(!empty($name)){            
            if(strlen($name) > 2 && strlen($name) <= 30){
                if(!preg_match('/[^a-zA-Z\s]/', $name)){

                    // All Test Passed !!
                    $name_valid = true;
                    echo "Fullname is OK !! <br>";                    

                }else { /*Invalid Characters --> */ echo "Fullname can contain only alphabets <br>"; }
            } else { /* Invalid Length --> */ echo "Fullname must be between 2 to 30 chars long. <br>"; }
        } else { /* Blank Input --> */ echo "Fullname can not be blank !! <br>";}

        //check age
        if(!empty($age)){            
            if((int)$age>0 && (int)$age<120){
                    
                    // All Test Passed !!
                    $phone_valid = true;
                    //$phone = md5($phone);
                    echo "Age is OK !! <br>";

                
            } else { /* Invalid Length --> */ echo $phone." = phone must be between 10 chars long. <br>"; }
        } else { /* Blank Input --> */ echo "Phone can not be blank !! <br>";}

        //Check Email
        if(!empty($email)){            
            if(filter_var($email, FILTER_VALIDATE_EMAIL)){                

                    // All Test Passed !!
                    $email_valid = true;
                    echo "Email is OK !! <br>";
                
            } else { /* Invalid Email --> */ echo $email."is an Invalid Email Address. <br>"; }
        } else { /* Blank Input --> */ echo "email can not be blank !! <br>";}


        //Check Username
        if(!empty($address)){            
            if(strlen($address) >= 4 && strlen($address) <= 25){
                if(!preg_match('/[^a-zA-Z\d\s.]/', $address)){

                    // All Test Passed !!
                    $address_valid = true;
                    echo "Username is OK !! <br>";                    

                }else { /*Invalid Characters --> */ echo "address can contain alphabets,digits and period '.' symbols <br>"; }
            } else { /* Invalid Length --> */ echo "address must be between 2 to 15 chars long. <br>"; }
        } else { /* Blank Input --> */ echo "address can not be blank !! <br>";}


        //Check Password
        if(!empty($phone)){            
            if(strlen($phone)==10){
                    
                    // All Test Passed !!
                    $phone_valid = true;
                    //$phone = md5($phone);
                    echo "Phone is OK !! <br>";

                
            } else { /* Invalid Length --> */ echo $phone." = password must be between 10 chars long. <br>"; }
        } else { /* Blank Input --> */ echo "Password can not be blank !! <br>";}
               
        if($name_valid && $email_valid && $phone_valid && $address_valid){

            $age = (int)$age;
            $query = "INSERT INTO person(name,age,email,address,phone) VALUES('$name',$age,'$email','$address','$phone')";
            $fire = mysqli_query($con,$query) or die("Can not insert data into database. ".mysqli_error($con));
            if($fire) echo "Data Submitted to Database.";        
        }
    }
    ?>


    <?php
        if(isset($_GET['del'])){
            $id = $_GET['del'];
            $query = "DELETE FROM person WHERE id = $id";
            $fire = mysqli_query($con,$query) or die("Can not delete the data from database.". mysqli_error($con));
            if($fire) {
                echo "Data deleted from database";
                header("Location:index.php");
            };
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
            <div class="col-lg-12 flex-container">
                <!-- Show Data Here -->
                <div class="col-lg-8 col-xs-12">
                    <h3>User Data</h3>
                    <hr>
                    <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>Full Name</th>
                            <th>age</th>
                            <th>adress</th>
                            <th>Email</th>
                            <th>phone</th>        
                        </tr>
                        </thead>
                        <tbody>                        
                             <?php
                                $query = "SELECT * FROM person";
                                $fire = mysqli_query($con,$query) or die("Can not fetch data from database ".mysqli_error($con));
                                //if($fire) echo "We got the data from database.";

                                if(mysqli_num_rows($fire)>0){                           
                                    while($user = mysqli_fetch_assoc($fire)){ ?>                                          
                                <tr>
                                    <td><?php echo $user['name'] ?></td>
                                    <td><?php echo $user['age'] ?></td>
                                    <td><?php echo $user['email'] ?></td>                                    
                                    <td><?php echo $user['address'] ?></td>                                    
                                    <td><?php echo $user['phone'] ?></td>                                    
                                    
                                    <td>
                                        <a href="<?php $_SERVER['PHP_SELF'] ?>?del=<?php echo $user['id'] ?>"
                                           class="btn btn-sm btn-danger">Delete</a>
                                    </td> 
                                    <td>
                                        <a class="btn btn-sm btn-warning"
                                            href="update.php?upd=<?php echo $user['id'] ?>"
                                            >Update</a>
                                    </td>                                                                     
                                </tr>

                                   <?php
                                    }      
                                }
                                else{ ?>
                                    <tr>
                                      <td colspan="3" class="text-center">
                                          <h2 class="text-muted">There is No Data to Show !!</h2>
                                      </td>
                                  </tr>      
                              <?php } ?>
                        </tbody>
                    </table>
                    </div>


                   


                </div>
                <!-- Signup form -->
                <div class="col-lg-4 col-xs-12">
                    <h3>Signup</h3>
                    <hr>
                    <form name="signup" id="signup" action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
                        <div class="form-group">
                            <label  for="name">Fullname</label>
                            <input  name="name" id="name" type="text" class="form-control" placeholder="name">
                        </div>
                        <div class="form-group">
                            <label  for="age">Age</label>
                            <input  name="age" id="age" type="text" class="form-control" placeholder="age">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input name="email" id="email" type="text" class="form-control" placeholder="email">
                        </div>
                        <div class="form-group">
                            <label for="address">Addrerss</label>
                            <input name="address" id="address" type="text" class="form-control" placeholder="address" >
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input name="phone" id="phone" type="text" class="form-control" placeholder="phone" >
                        </div>
                        <div class="form-group">                            
                           <button name="submit" id="submit" class="btn btn-primary btn-block">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>