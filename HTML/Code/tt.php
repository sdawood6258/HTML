<?php
// error_reporting(E_ALL);
// ini_set('display_errors', 1);
session_start();
include_once("config.php");

if(isset($_GET["tenant_id"]) && !empty(trim($_GET["tenant_id"]))){
  // Get URL parameter
  $tenant_id =  trim($_GET["tenant_id"]);
//   echo $tid;
//   exit();
 $_SESSION['tid']=$tenant_id;
}

    if(isset($_SESSION['login_id'])){
        $emp_id= $_SESSION['login_id'];  
        $emp_name=  $_SESSION['first_name'];
        $role_id= $_SESSION['role_id'];  
    }
    else{
        $path='/hyq_time/Admin';
        
        if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on'){   
         $url = "https://";   
        } else  {
             $url = "http://";
        }
        $url .= $_SERVER['HTTP_HOST'];
        $url .= $path; //$_SERVER['REQUEST_URI'];
        
        header('Location: '.$url.'/logout.php'); 
        // echo "<script>location.href='$page_url/login.php'</script>";
       exit();
    }

    $path='/hyq_time/Admin';
            
    if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')   
     $url = "https://";   
    else  {
         $url = "http://";
    }
    $url .= $_SERVER['HTTP_HOST'];
    $url .= $path; //$_SERVER['REQUEST_URI'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <link href="./images/logo.png" rel="icon">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registration Form</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
   <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
     
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <!--/* Import Google font - Poppins */-->
<!--@import url("https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap");-->
<!--<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap" rel="stylesheet">-->
  <style>
    /*body {*/
    /*  background-color: #f8f9fa;*/
    /*}*/
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: "Poppins", sans-serif;
    }
    :root {
      --white-color: #fff;
      --blue-color: #4070f4;
      --grey-color: #707070;
      --grey-color-light: #aaa;
    }
    body {
      background-color: #e7f2fd;
      transition: all 0.5s ease;
    }
    body.dark {
      background-color: #333;
    }
    body.dark {
      --white-color: #333;
      --blue-color: #fff;
      --grey-color: #f2f2f2;
      --grey-color-light: #aaa;
    }


    .container {
      margin-top: 50px;
      background-color: #fff;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    }

    .form-title {
      text-align: center;
      margin-bottom: 30px;
      font-size: 28px;
      color: #343a40;
    }

    .form-group label {
      color: #343a40;
      font-weight: bold;
    }

    .form-control {
      border-radius: 5px;
    }

    .custom-btn {
      padding: 10px 20px;
      border-radius: 5px;
      font-size: 16px;
      font-weight: bold;
      cursor: pointer;
      transition: background-color 0.3s, color 0.3s, border-color 0.3s;
    }

    .custom-btn:hover {
      transform: translateY(-2px);
      color: #fff;
    }

    .custom-btn.register {
      /*background-color: #343a40;*/
      /*border-color: #343a40;*/
      /*background-color: #5c825a;*/
      /*border-color: #5c825a;*/
      background-color: #37A8CD;
      border-color: #37A8CD;
      color: #fff;
    }

    .custom-btn.cancel {
      /*background-color: #dc3545;*/
      background-color: #343a40;
      /*border-color: #dc3545;*/
      border-color: #343a40;
      color: #fff;
    }
    
    /*footer css*/
    #footer {
       position: fixed;
       bottom: 0;
       /*width: 100%;*/
       width: 90%;
    }
    
    
    /*color code start*/
      .menu-preview {
            /*width: 250px;*/
            /*height: 400px;*/
            display: flex;
            flex-direction: column;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .menu-item {
            padding: 15px;
            cursor: pointer;
            transition: background-color 0.3s, color 0.3s;
        }
        .menu-item:hover {
            filter: brightness(0.9);
        }
        .active-item {
            font-weight: bold;
        }
    /*color code end*/
    
    select{
      cursor:pointer !important;   
    }
    
  </style>
</head>
<body>
 <?php
    include './sidebar.php';
  ?>
    <section class="home-section">
        <div class="home-content">
          <i class='bx bx-menu' style="background: none; font-size: 35px; cursor:pointer;"></i>
          <!--<span class="text">Drop Down Sidebar</span>-->
          <!--<i class='bx bx-sun' id="darkLight"></i>-->
          <h2 class="form-title" style="margin-left: 28%;">Update Business Registered</h2>
        </div>
    
        <div class="container">
          <!--<h2 class="form-title">Update Business Registered </h2>-->
          <?php
            $sql = "select * from tbusiness where tenant_id =$tenant_id";

            $result = mysqli_query($conn,$sql);
            $row = mysqli_fetch_array($result);
            // $output["c_id"] = $row["c_id"];
            

            // `tenant_id`,`businessName`,`email`,`phoneNumber`,`businessType`,`professionalWebsite`,`businessDescription`,`logo`,`status`,
          ?>
              <!--<form onsubmit="return validation()" action="updateBusinessdata.php" method="post" enctype="multipart/form-data">-->
            <form id="businessForm" action="updateBusinessdata.php" method="post" enctype="multipart/form-data">
                <input type="text" class="d-none" id="tenant_id" name="tenant_id" value="<?php echo $tenant_id;?>">
                <!-- Step 1: -->
                <!--<div id="step1">-->
                    
                    <!-- Contact Information -->
                    <h4>User Information</h4>
                    <!--<button type="button" class="btn btn-block custom-btn form-control" id="addcontactinfoRow"><i class="fa fa-plus" aria-hidden="true"></i></button>-->
                    
                    <div class="form-row">
                        <div class="form-group col-md-4 d-flex align-items-center">
                            <label for="addcontactinfoRow" class="mr-2">Add User</label>
                            <button type="button" class="btn custom-btn " style="background-color: #37A8CD; border-color: #37A8CD; color: #fff;" id="addcontactinfoRow">
                                <i class="fa fa-plus" aria-hidden="true"></i>
                            </button>
                        </div>
                    </div>

                    
                    <?php
                            // `streetAddress`,`city`,`state`,`zipcode`,`tenant_id`
                            // $contact_sql ="SELECT `tenant_id`,`firstName`,`lastName`,`phoneNumber`,`role`, `email` FROM tbusiness_contact_info WHERE tenant_id='$tenant_id' ORDER BY id ASC";
                            $contact_sql ="SELECT emp_id, `first_name`,`last_name`,`mobile_no`,`email_id`,`username`,`tenant_id`,`role_id`, `user_flag` FROM temployee WHERE tenant_id='$tenant_id' and user_flag=1 and `delete`=0  ORDER BY emp_id ASC";
                            $contact_result = mysqli_query($conn, $contact_sql);
                            
                            // Step 2: Get the number of rows
                            $num_contact_rows = mysqli_num_rows($contact_result);
                            
                            if ($num_contact_rows > 0) {
                                $j=0;
                                while($contact_row = mysqli_fetch_assoc($contact_result)) {
                                    if($j==0){
                                ?> 
                                <div class="form-row" id="contactinfoRow_<?php echo $j;?>">
                                      <div class="form-group col-md-2">
                                         <input type="text"  class="d-none" name="existUser[]" id="existUser<?php echo $j;?>"  value="<?php echo $contact_row['emp_id'];?>"> 
                                        <label for="firstName">First Name <span style="color:red;">*</span></label>
                                        <input type="text" class="form-control" id="firstName" name="firstName[]" placeholder="Enter first name" value="<?php echo $contact_row['first_name'];?>" autocomplete="off" oninput="allow_alphabets(this)">
                                      </div>
                                     
                                      <div class="form-group col-md-2">
                                        <label for="lastName">Last Name <span style="color:red;">*</span></label>
                                        <input type="text" class="form-control" id="lastName" name="lastName[]" placeholder="Enter last name" value="<?php echo $contact_row['last_name'];?>" autocomplete="off" oninput="allow_alphabets(this)">
                                      </div>
                                      <div class="form-group col-md-2">
                                        <label for="phoneNumber">Phone Number <span style="color:red;">*</span></label>
                                        <input type="tel" class="form-control" id="phoneNumber" name="phoneNumber[]" placeholder="Enter phone number" value="<?php echo $contact_row['mobile_no'];?>" maxlength="10"  minlength="10" oninput="check_for_numbers(this)">
                                      </div>
                                      <div class="form-group col-md-3">
                                        <label for="userEmail">Email <span style="color:red;">*</span></label>
                                        <input type="email" class="form-control" id="userEmail" name="userEmail[]" placeholder="Enter email" value="<?php echo $contact_row['email_id'];?>" autocomplete="off" readOnly>
                                      </div>
                                       <div class="form-group col-md-2">
                                        <label for="role">Role <span style="color:red;">*</span></label>
                                         <select class="form-control" id="role" name="role[]">
                                            <!--<option value="0" disabled> Select role</option>-->
                                            <!--<php echo $contact_row['role'];?>-->
                                            <!--<option value="1">Owner</option>-->
                                            <!--<option value="2">Supervisor</option>-->
                                            <!--<option value="3">Employee</option>-->
                                            <option value="" disabled <?php echo empty($contact_row["role_id"]) ? 'selected' : ''; ?>>Select</option>
                                            <option value="2" <?php echo $contact_row["role_id"] == "2" ? 'selected' : ''; ?>>Owner</option>
                                            <option value="3" <?php echo $contact_row["role_id"] == "3" ? 'selected' : ''; ?>>Supervisor</option>
                                            <!--<option value="2" <php echo $row["businessType"] == "2" ? 'selected' : ''; ?>>Employee</option>-->
                                            <?php
                                            /*
                                            $query = "select * from role";
                                            // $query = mysqli_query($con, $qr);
                                            $result = $conn->query($query);
                                            if ($result->num_rows > 0) {
                                                while ($row = mysqli_fetch_assoc($result)) {
                                
                                            ?>
                                                    <option value="<?php echo $row['id']; ?>"><?php echo $row['role_name']; ?></option>
                                            <?php
                                                }
                                            }
                                            */
                                            ?>
                                
                                        </select>
                                        <!--<input type="text" class="form-control" id="middleName" name="middleName[]" placeholder="Enter middle name">-->
                                      </div>
                                        <div class="form-group col-md-1">
                                           <label for=""></label>
                                            <!--<button type="button" class="btn btn-block custom-btn form-control" id="addcontactinfoRow"><i class="fa fa-plus" aria-hidden="true"></i></button>-->
                                            <button id="removecontactinfoRow_<?php echo $j;?>" type="button" class="btn btn-danger mt-4" onclick="removeRow(<?php echo $j;?>)"><i class="fa fa-times" aria-hidden="true"></i></button>
                                        </div>
                                        
                                </div>
                                <?php
                                    }else{
                                       ?> 
                                        <div class="form-row" id="contactinfoRow_<?php echo $j;?>">
                                              <div class="form-group col-md-2">
                                                  <input type="text"  class="d-none" name="existUser[]" id="existUser<?php echo $j;?>" value="<?php echo $contact_row['emp_id'];?>">
                                                <label for="firstName">First Name <span style="color:red;">*</span></label>
                                                <input type="text" class="form-control" id="firstName_<?php echo $j;?>" name="firstName[]" placeholder="Enter first name" value="<?php echo $contact_row['first_name'];?>" autocomplete="off" oninput="allow_alphabets(this)">
                                              </div>
                                             
                                              <div class="form-group col-md-2">
                                                <label for="lastName">Last Name <span style="color:red;">*</span></label>
                                                <input type="text" class="form-control" id="lastName_<?php echo $j;?>" name="lastName[]" placeholder="Enter last name" value="<?php echo $contact_row['last_name'];?>" autocomplete="off" oninput="allow_alphabets(this)">
                                              </div>
                                              <div class="form-group col-md-2">
                                                <label for="phoneNumber">Phone Number <span style="color:red;">*</span></label>
                                                <input type="tel" class="form-control" id="phoneNumber_<?php echo $j;?>" name="phoneNumber[]" placeholder="Enter phone number" value="<?php echo $contact_row['mobile_no'];?>" maxlength="10"  minlength="10" oninput="check_for_numbers(this)">
                                              </div>
                                              <div class="form-group col-md-3">
                                                <label for="userEmail">Email <span style="color:red;">*</span></label>
                                                <input type="email" class="form-control" id="userEmail_<?php echo $j;?>" name="userEmail[]" placeholder="Enter email" value="<?php echo $contact_row['email_id'];?>" autocomplete="off" readOnly>
                                              </div>
                                               <div class="form-group col-md-2">
                                                <label for="role">Role <span style="color:red;">*</span></label>
                                                 <select class="form-control" id="role_<?php echo $j;?>" name="role[]">
                                                    <!--<option value="0" disabled> Select role</option>-->
                                                    <!--<php echo $contact_row['role'];?>-->
                                                    <!--<option value="1">Owner</option>-->
                                                    <!--<option value="2">Supervisor</option>-->
                                                    <!--<option value="3">Employee</option>-->
                                                    <option value="" disabled <?php echo empty($contact_row["role_id"]) ? 'selected' : ''; ?>>Select</option>
                                                    <option value="2" <?php echo $contact_row["role_id"] == "2" ? 'selected' : ''; ?>>Owner</option>
                                                    <option value="3" <?php echo $contact_row["role_id"] == "3" ? 'selected' : ''; ?>>Supervisor</option>
                                                    <!--<option value="2" <php echo $row["businessType"] == "2" ? 'selected' : ''; ?>>Employee</option>-->
                                                    <?php
                                                    /*
                                                    $query = "select * from role";
                                                    // $query = mysqli_query($con, $qr);
                                                    $result = $conn->query($query);
                                                    if ($result->num_rows > 0) {
                                                        while ($row = mysqli_fetch_assoc($result)) {
                                        
                                                    ?>
                                                            <option value="<?php echo $row['id']; ?>"><?php echo $row['role_name']; ?></option>
                                                    <?php
                                                        }
                                                    }
                                                    */
                                                    ?>
                                        
                                                </select>
                                                <!--<input type="text" class="form-control" id="middleName" name="middleName[]" placeholder="Enter middle name">-->
                                              </div>
                                                <!--<div class="form-group col-md-1">-->
                                                <!--   <label for="addcontactinfoRow"></label>-->
                                                <!--    <button type="button" class="btn btn-block custom-btn form-control" id="addcontactinfoRow"><i class="fa fa-plus" aria-hidden="true"></i></button>-->
                                                <!--</div>-->
                                                
                                                <div class="form-group col-md-1">
                                                    <label for=""></label>

                                                    <button id="removecontactinfoRow_<?php echo $j;?>" type="button" class="btn btn-danger mt-4" onclick="removeRow(<?php echo $j;?>)"><i class="fa fa-times" aria-hidden="true"></i></button>
                                                </div>
                                                
                                        </div>
                                        
                                <?php  
                                    }
                                    $j++;
                                }
                            }
                            else{
                    ?>
                    <div class="form-row">
                      <div class="form-group col-md-2">
                          <input type="text"  class="d-none" name="existUser[]" id="existUser" value="0">
                        <label for="firstName">First Name <span style="color:red;">*</span></label>
                        <input type="text" class="form-control" id="firstName" name="firstName[]" placeholder="Enter first name" autocomplete="off" oninput="allow_alphabets(this)">
                      </div>
                     
                      <div class="form-group col-md-2">
                        <label for="lastName">Last Name <span style="color:red;">*</span></label>
                        <input type="text" class="form-control" id="lastName" name="lastName[]" placeholder="Enter last name" autocomplete="off" oninput="allow_alphabets(this)">
                      </div>
                      <div class="form-group col-md-2">
                        <label for="phoneNumber">Phone Number <span style="color:red;">*</span></label>
                        <input type="tel" class="form-control" id="phoneNumber" name="phoneNumber[]" placeholder="Enter phone number" maxlength="10"  minlength="10" oninput="check_for_numbers(this)">
                      </div>
                      <div class="form-group col-md-3">
                        <label for="userEmail">Email <span style="color:red;">*</span></label>
                        <input type="email" class="form-control" id="userEmail" name="userEmail[]" placeholder="Enter email" value="" autocomplete="off">
                      </div>
                       <div class="form-group col-md-2">
                        <label for="role">Role <span style="color:red;">*</span></label>
                         <select class="form-control" id="role" name="role[]">
                            <option value="0" disabled> Select role</option>
                            <option value="2">Owner</option>
                            <option value="3">Supervisor</option>
                            <!--<option value="3">Employee</option>-->
                            <?php
                            /*
                            $query = "select * from role";
                            // $query = mysqli_query($con, $qr);
                            $result = $conn->query($query);
                            if ($result->num_rows > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                
                            ?>
                                    <option value="<?php echo $row['id']; ?>"><?php echo $row['role_name']; ?></option>
                            <?php
                                }
                            }
                            */
                            ?>
                
                        </select>
                        <!--<input type="text" class="form-control" id="middleName" name="middleName[]" placeholder="Enter middle name">-->
                      </div>
                      
                        <div class="form-group col-md-1">
                           <label for="addcontactinfoRow"></label>
                           <label for=""></label>
                            <button id="removecontactinfoRow_1" type="button" class="btn btn-danger mt-4" onclick="removeRow(<?php echo $j;?>)"><i class="fa fa-times" aria-hidden="true"></i></button>
                            <!--<button type="button" class="btn btn-block custom-btn form-control" id="addcontactinfoRow"><i class="fa fa-plus" aria-hidden="true"></i></button>-->
                        </div>
                    </div>
                    <?php } ?>
                    
                      <div id="newcontactinfoRow"></div>
                   <!-- <div class="form-row">
                      <div class="form-group col-md-4">
                        <label for="email">Email Address </label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" >
                      </div>
                      
                        <div class="form-group col-md-4">
                        <label for="address">Address </label>
                        <input type="text" class="form-control" id="address" name="address" placeholder="Enter address" >
                      </div>
                    </div>-->
                    
                    <?php
                    /*
                    //
                    // // Check if tenant_id exists in the database
                    // $check_emp = $conn->prepare("SELECT COUNT(*) FROM temployee WHERE tenant_id = ? and username = ?");
                    $check_emp = $conn->prepare("SELECT COUNT(*) FROM temployee WHERE tenant_id = ? ");
                    // $check_emp->bind_param("is", $tenant_id,$username);
                    $check_emp->bind_param("i", $tenant_id);
                    $check_emp->execute();
                    $check_emp->bind_result($count_emp);
                    $check_emp->fetch();
                    $check_emp->close();
                    if($count_emp > 1){
                        $emp_login = "SELECT username FROM temployee WHERE tenant_id = '$tenant_id' order by emp_id ASC limit 1 ";
                    }
                    else if($count_emp == 1){
                        $emp_login = "SELECT username FROM temployee WHERE tenant_id = '$tenant_id'  ";
                    }else if($count_emp == 0){
                        $emp_login = "SELECT username FROM temployee WHERE tenant_id = '$tenant_id'  ";
                    }
                        // Execute the query
                        $result_emp_login = mysqli_query($conn, $emp_login);
                        
                        // if ($result_business_features && mysqli_num_rows($result_business_features) > 0) {
                            // Fetch the data
                            $row_emp_login = mysqli_fetch_assoc($result_emp_login);
                            
                            // Retrieve data from the result
                            $username = $row_emp_login['username'];
                    ?>
                    
                   <div class="form-row">
                        <div class="form-group col-md-3">  
                            <label for="username">Username <span style="color:red;">*</span></label>
                            <input type="text" class="form-control" id="username" name="username" value="<?php echo $username;?>" autocomplete="off" readOnly>
                        </div>
                        
                        <div class="form-group col-md-3">
                            <label for="password">Password </label>
                            <input type="password" class="form-control" id="password" name="password"  autocomplete="off">
                        </div>
                        
                        <div class="form-group col-md-3">
                            <label for="confirm_password">Confirm Password </label>
                            <input type="password" class="form-control" id="confirm_password" name="confirm_password" autocomplete="off">
                        </div>
                        
                    </div>
                    <?php */ ?>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="statusActive" name="statusActive" value="1" <?php echo $row['status'] == 1 ? 'checked' : ''; ?>>
                                <label class="form-check-label" for="statusActive">
                                    Active
                                </label>
                            </div>
                        </div>
                        <div class="form-group col-md-8">
                             <?php
                                // Query to get a single row
                                // tenant_id, auto_logout, auto_logout_time, pay_peroid_duration, week_start_from, time_schedule, location_tracking
                                /*$business_features = "SELECT tenant_id, auto_logout, auto_logout_time, pay_peroid_duration, week_start_from, time_schedule, location_tracking FROM business_features WHERE tenant_id = ? ORDER BY id ASC LIMIT 1";
                                
                                // Prepare the statement to prevent SQL injection
                                if ($stmt = $conn->prepare($business_features)) {
                                    // Bind parameters
                                    $stmt->bind_param("i", $tenant_id);
                                    
                                    // Execute the statement
                                    $stmt->execute();
                                    
                                    // Bind the result variables
                                    // $stmt->bind_result($tenant_id, $firstName, $lastName, $phoneNumber, $role);
                                    $stmt->bind_result($auto_logout, $auto_logout_time, $pay_peroid_duration, $week_start_from, $time_schedule, $location_tracking);
                                    
                                    // Fetch the result
                                    if ($stmt->fetch()) {
                                        // Data has been retrieved, now you can use the variables
                                        echo "Tenant ID: $tenant_id<br>";
                                        // echo "First Name: $firstName<br>";
                                        // echo "Last Name: $lastName<br>";
                                        // echo "Phone Number: $phoneNumber<br>";
                                        // echo "Role: $role<br>";
                                    } else {
                                        // No data found for the tenant
                                        echo "No contact information found for tenant ID: $tenant_id";
                                    }
                                    
                                    // Close the statement
                                    $stmt->close();
                                } else {
                                    echo "Failed to prepare the SQL statement.";
                                }
                                */
                                
                                $business_features = "SELECT tenant_id, auto_logout, auto_logout_time, pay_peroid_duration, week_start_from, time_schedule, location_tracking,theme_color, highlight_color,plan_package FROM business_features WHERE tenant_id = '$tenant_id' ORDER BY id ASC LIMIT 1 ";
                                
                                // Execute the query
                                $result_business_features = mysqli_query($conn, $business_features);
                                
                                // if ($result_business_features && mysqli_num_rows($result_business_features) > 0) {
                                    // Fetch the data
                                    $row_features = mysqli_fetch_assoc($result_business_features);
                                    
                                    // Retrieve data from the result
                                    $tenant_id = $row_features['tenant_id'];
                                    $auto_logout = $row_features['auto_logout'];
                                    $auto_logout_time = $row_features['auto_logout_time'];
                                    $pay_peroid_duration = $row_features['pay_peroid_duration'];
                                    $week_start_from = $row_features['week_start_from'];
                                    $time_schedule = $row_features['time_schedule'];
                                    $location_tracking = $row_features['location_tracking'];
                                    $theme_color = $row_features['theme_color'];
                                    $highlight_color = $row_features['highlight_color'];
                                    $plan_package = $row_features['plan_package'];
                                    
                                    // Display the results
                                    // echo "Tenant ID: $tenant_id<br>";
                                    // echo "Auto Logout: $auto_logout<br>";
                                    // echo "Auto Logout Time: $auto_logout_time<br>";
                                    // echo "Pay Period Duration: $pay_peroid_duration<br>";
                                    // echo "Week Start From: $week_start_from<br>";
                                    // echo "Time Schedule: $time_schedule<br>";
                                    // echo "Location Tracking: $location_tracking<br>";
                                // } 
                                // else {
                                //     // No data found for the tenant
                                //     // echo "No information found for tenant ID: $tenant_id";
                                // }
                                
                                // Close the result set (optional but recommended)
                                mysqli_free_result($result);
                                
                                
                            ?>
                        
                            <!--<div class="form-check">-->
                                <!--<label for="plan_package">Current Package <span style="color:red;">*</span></label>-->
                                <label for="plan_package">Current Package </label>
                                <select class="form-control" id="plan_package" name="plan_package">
                                    <!--<option value="0" disabled selected> Select Package</option>-->
                                    <!--price_package--> 
                                    <!--id  description-->
                                    <?php
                                    $pkg_query = "select * from price_package";
                                    $pkg_result = mysqli_query($conn, $pkg_query);
                                    
                                
                                    
                                    // $plan_package=1; //temperory later get from db
                                    while($pkg_row = mysqli_fetch_assoc($pkg_result)) {
                                        
                                    // $pkg_query = "select * from price_package";
                                    // $query = mysqli_query($con, $qr);
                                    // $pkg_result = $conn->query($pkg_query);
                                    // if ($pkg_result->num_rows > 0) {
                                        // while ($pkg_row = mysqli_fetch_assoc($pkg_result)) {
                                            if($plan_package == $pkg_row['id'] ){
                                    ?>
                                            <option value="<?php echo $pkg_row['id']; ?>" selected><?php echo $pkg_row['description']; ?></option>
                                    <?php
                                            }else{
                                            ?>
                                            <option value="<?php echo $pkg_row['id']; ?>" disabled><?php echo $pkg_row['description']; ?></option>
                                            <?php
                                            }
                                        // }
                                    }
                                    
                                    ?>
                                    
                            
                                    <!--  <option value="1" <php echo $plan_package == "1" ? 'selected' : ''; ?>>From 0 to 20 active employees ($20 per Month)</option>-->
                            		<!--<option value="2" <php echo $plan_package == "2" ? 'selected' : ''; ?>>From 21 to 40 active employees ($30 per Month)</option>-->
                            		<!--<option value="3" <php echo $plan_package == "3" ? 'selected' : ''; ?>>From 41 to 60 active employees ($40 per Month)</option>-->
                            		<!--<option value="4" <php echo $plan_package == "4" ? 'selected' : ''; ?>>From 60+ active employees ($60 per Month)</option>-->

                                </select>
                                
                            <!--</div>-->
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <?php 
                        
                                // update count
                                // $sql_count = "SELECT SUM(CASE WHEN `delete` = 0 THEN 1 ELSE 0 END) AS active_emp, SUM(CASE WHEN `delete` = 1 THEN 1 ELSE 0 END) AS delete_emp FROM `temployee` WHERE `tenant_id` = $tenant_id";
                                $sql_count = "SELECT SUM(CASE WHEN `delete` = 0 and active=0 THEN 1 ELSE 0 END) AS active_emp, SUM(CASE WHEN `delete` = 0 and active=1 THEN 1 ELSE 0 END) AS inactive_emp, SUM(CASE WHEN `delete` = 1 THEN 1 ELSE 0 END) AS delete_emp FROM `temployee` WHERE `tenant_id` = $tenant_id";
                                // $sql_count = "SELECT SUM(CASE WHEN `delete` = 0 THEN 1 ELSE 0 END) AS active_emp FROM `temployee` WHERE `tenant_id` = $tenant_id";
                                                
                                $result_count = mysqli_query($conn,$sql_count);
                                $row_count = mysqli_fetch_array($result_count);
                                $active_emp = $row_count["active_emp"];
                                $inactive_emp = $row_count["inactive_emp"];
                                $delete_emp = $row_count["delete_emp"]; 
                                $plan_package_new=1;
                                if($active_emp <= 3 ){  // 0 to 3
                                    $plan_package_new=1;
                                }else if(($active_emp >= 4) && ($active_emp <=20) ){ // 4 to 20
                                    $plan_package_new=2;
                                }else if( ($active_emp >= 21) && ($active_emp <=40) ){ // 21 to 40
                                    $plan_package_new=3;
                                }else if( ($active_emp >= 41) && ($active_emp <=60) ){  // 41 to 60
                                    $plan_package_new=4;
                                }else if($active_emp > 60 ){ // 60+
                                    $plan_package_new=5;
                                }
                                
                                // tenant_id exists, update the plan_package
                                // $update_features = $conn->prepare("UPDATE business_features SET plan_package =? WHERE tenant_id = ?");
                                // $update_features->bind_param('ii', $plan_package_new, $tenant_id);
                                // $update_features->execute();
                                // $update_features->close();
                                
                            // $sql_count = "SELECT COUNT(*) as count FROM `temployee` WHERE `tenant_id` = $tenant_id AND `delete` = 0 ";
                            // $sql_count = "SELECT SUM(CASE WHEN `delete` = 0 THEN 1 ELSE 0 END) AS active_emp, SUM(CASE WHEN `delete` = 1 THEN 1 ELSE 0 END) AS delete_emp FROM `temployee` WHERE `tenant_id` = $tenant_id";
                    
                            // $result_count = mysqli_query($conn,$sql_count);
                            // $row_count = mysqli_fetch_array($result_count);
                            // $active_emp = $row_count["active_emp"];
                            // $delete_emp = $row_count["delete_emp"];
                        ?>        
            
            
                        <div class="form-group col-md-4">
                        </div>
                        <div class="form-group col-md-8">
                            <div class="form-check">
                                <input type="text" class="d-none" id="new_Active_emp_flag" name="new_Active_emp_flag" value="<?php echo $active_emp;?>">
                                <input type="text" class="d-none" id="new_plan_package_flag" name="new_plan_package_flag" value="<?php echo $plan_package_new;?>">
                                <!--<input class="form-check-input" type="checkbox" id="statusActive" name="statusActive" value="1" <php echo $row['status'] == 1 ? 'checked' : ''; ?>>-->
                                <label class="form-check-label" for="empCount">
                                    Employees Count : 
                                </label>
                                <span>
                                   <?php //echo $active_emp." Active ".$inactive_emp." Inactive ". $delete_emp." Archived"; ?>
                                   <?php //echo $active_emp." Active &nbsp;&nbsp;&nbsp;".$inactive_emp." Inactive &nbsp;&nbsp;&nbsp;". $delete_emp." Deleted"; ?>
                                   <?php echo $active_emp." Active &nbsp;&nbsp;&nbsp;".$inactive_emp." Inactive"; ?>
                                </span>
                            </div>
                        </div>
                    </div>
                    
                    <?php
                        // get credit card details
                        $sql_card = "SELECT * FROM `business_card_info` WHERE `tenant_id` = $tenant_id";
                        
                        // `tenant_id`,`credit_card_no`, `credit_cvv`, `credit_expiry_date`, `address_same_as_business`, `address`, `city`, `state`, `zipcode`
                        
                        $result_card = mysqli_query($conn,$sql_card);
                        $row_card = mysqli_fetch_array($result_card);
                        
                        $credit_card_no = $row_card["credit_card_no"];
                        $credit_cvv = $row_card["credit_cvv"]; 
                        $credit_expiry_date = $row_card["credit_expiry_date"]; 
                        $address_same_as_business = $row_card["address_same_as_business"]; 
                        $bill_address = $row_card["address"]; 
                        $bill_city = $row_card["city"]; 
                        $bill_state = $row_card["state"]; 
                        $bill_zipcode = $row_card["zipcode"]; 
                        // $delete_emp = $row_card["delete_emp"]; 
                    ?>
                    <!--Credit card-->
                      <div class="form-row mr-2 <?php echo ($plan_package_new <= 1) ? 'd-none' : ''?> "  id="card_Details1">
                        <div class="form-group col-md-4 mb-4">
                            <label >Credit Card Details </label>
                            <!--<div class="form-outline">
                                <label for="creditcard_details">
                                    <input type="checkbox" id="creditcard_details" class="checkboxclass" name="creditcard_details" style='cursor:pointer;' required>
                                    Credit Card
                                </label>
                            </div>-->
        
                        </div>
                    </div>
                    <div class="form-row <?php echo ($plan_package_new <= 1) ? 'd-none' : ''?>" id="card_Details2">
                        <!--<div class="row mr-2" id="creditcard_details1" style="display:none;"> -->
                        <div class="row mr-2" id="creditcard_details1">
                    
                            <div class="form-group col-md-4 mb-4">
            
                                <div class="form-outline">
                                    <label class="form-label" for="creditcardnumber1">Card Number<span style="color:red">*</span></label>
                                    <!--<input type="text" name="creditcardnumber" value="<php echo $credit_card_no;?>" placeholder="&bull;&bull;&bull;&bull; &bull;&bull;&bull;&bull; &bull;&bull;&bull;&bull; &bull;&bull;&bull;&bull;" id="creditcardnumber" style="background: #;" class="background form-control form-control-lg" maxlength="16" oninput="check_for_numbers(this)" onchange="maskCreditCard(this)"   <php echo ($plan_package_new > 1) ? 'required' : '' ?> />-->
                                    <input type="text" name="creditcardnumber1" value="<?php echo $credit_card_no;?>" placeholder="&bull;&bull;&bull;&bull; &bull;&bull;&bull;&bull; &bull;&bull;&bull;&bull; &bull;&bull;&bull;&bull;" id="creditcardnumber1" style="background: #;" class="background form-control form-control-lg" maxlength="16"   <?php echo ($plan_package_new > 1) ? 'required' : '' ?> />
                                    <input type="text" name="creditcardnumber" value="<?php echo $credit_card_no;?>" placeholder="&bull;&bull;&bull;&bull; &bull;&bull;&bull;&bull; &bull;&bull;&bull;&bull; &bull;&bull;&bull;&bull;" id="creditcardnumber" style="background: #;" class="d-none background form-control form-control-lg" maxlength="16"   <?php echo ($plan_package_new > 1) ? 'required' : '' ?> />
                                    <br>
                                    
                                <div>
                                    <!--<input type="checkbox" id="bill_address1" name="bill_address1" checked> <label for="bill_address1">Billing address is same as above address</label>-->
                                    <!--<input type="checkbox" id="bill_address1" name="bill_address1" checked> <label for="bill_address1">Billing address is same as business address</label>-->
                                    <!--<textarea class="form-control" style="display:none;" id="exampleTextarea1" rows="3" placeholder="Enter Your Billing Address"></textarea>-->
                                </div>
                              </div>
            
                            </div>
                            
                            <div class="form-group col-md-4 mb-4">
                              <div class="form-outline">
                                  <label class="form-label" for="credit_expiry_date1">Expiry Date <span style="color:red">*</span></label>
                                <!--<input type="text" id="credit_expiry_date" value="<php echo $credit_expiry_date; ?>" placeholder="&bull;&bull; / &bull;&bull;" name="credit_expiry_date" style="background: #;" maxlength="5" oninput="check_for_numbers(this)" class="background form-control form-control-lg" <php echo ($plan_package_new > 1) ? 'required' : '' ?> />-->
                                <input type="text" id="credit_expiry_date1" value="<?php echo $credit_expiry_date; ?>" placeholder="&bull;&bull; / &bull;&bull;" name="credit_expiry_date1" style="background: #;" maxlength="5"  class="background form-control form-control-lg" <?php echo ($plan_package_new > 1) ? 'required' : '' ?> />
                                <input type="text" id="credit_expiry_date" value="<?php echo $credit_expiry_date; ?>" placeholder="&bull;&bull; / &bull;&bull;" name="credit_expiry_date" style="background: #;" maxlength="5"  class="d-none background form-control form-control-lg" <?php echo ($plan_package_new > 1) ? 'required' : '' ?> />
                                
                              </div>
            
                            </div>
                            <div class="form-group col-md-4 mb-4">
            
                              <div class="form-outline">
                                  <label class="form-label" for="credit_cvv1">CVV<span style="color:red">*</span></label>
                                <!--<input type="text" id="credit_cvv" name="credit_cvv" value="<?php echo $credit_cvv;?>" placeholder="&bull;&bull;&bull;" style="background: #;" class="background form-control form-control-lg"  maxlength="3" oninput="check_for_numbers(this)" <php echo ($plan_package_new > 1) ? 'required' : '' ?> />-->
                                <input type="text" id="credit_cvv1" name="credit_cvv1" value="<?php echo $credit_cvv;?>" placeholder="&bull;&bull;&bull;" style="background: #;" class="background form-control form-control-lg"  maxlength="3"  <?php echo ($plan_package_new > 1) ? 'required' : '' ?> />
                                <input type="text" id="credit_cvv" name="credit_cvv" value="<?php echo $credit_cvv;?>" placeholder="&bull;&bull;&bull;" style="background: #;" class="d-none background form-control form-control-lg"  maxlength="3"  <?php echo ($plan_package_new > 1) ? 'required' : '' ?> />
                                
                              </div>
            
                            </div>
                          </div> 
            
                    </div>
                    
                    <div class="form-row <?php echo ($plan_package_new <= 1) ? 'd-none' : '' ?>" id="card_Details3">
                        <div class=" col-md-12">    
                            <input type="checkbox" id="bill_address1" name="bill_address1" <?php echo ($address_same_as_business == 1) ? 'checked' : '' ?> > <label for="bill_address1">Billing address is same as business address</label>
                            <!--<textarea class="form-control" style="display:none;" id="exampleTextarea1" rows="3" placeholder="Enter Your Billing Address"></textarea>-->
                        </div>
                    </div>
                    
                    <div class="form-row <?php echo ($plan_package_new <= 1) ? 'd-none' : '' ?>" style="<?php echo ($address_same_as_business == 1) ? 'display:none' : ''; ?>" id="bill_address_section">
                         <div class="form-group col-md-4">
                            <label for="bill_address">Street Address <span style="color:red;">*</span></label>
                            <input type="text" class="form-control" id="bill_address" name="bill_address" value="<?php echo $bill_address;?>" placeholder="Enter street address"  >
                         </div>
                         <div class="form-group col-md-3">
                            <label for="bill_city">City <span style="color:red;">*</span></label>
                            <input type="text" class="form-control" id="bill_city" name="bill_city" value="<?php echo $bill_city;?>" placeholder="Enter city" autocomplete="off" oninput="allow_alphabets(this)" >
                         </div>
                         <div class="form-group col-md-2">
                            <label for="bill_state">State <span style="color:red;">*</span> </label>
                            <input type="text" class="form-control" id="bill_state" name="bill_state" value="<?php echo $bill_state;?>" placeholder="Enter state" autocomplete="off" oninput="allow_alphabets(this)" >
                         </div>
                         <div class="form-group col-md-2">
                            <label for="zipCode">Zip Code <span style="color:red;">*</span></label>
                            <input type="text" class="form-control" id="bill_zipCode" name="bill_zipCode" value="<?php echo $bill_zipcode;?>" placeholder="Enter zip code" maxlength="5"  minlength="5" oninput="check_for_numbers(this)">
                         </div>
                        <!--<div class="form-group col-md-1">
                           <label for="zipCode"></label>
                            <button type="button" class="btn btn-block custom-btn" id="addbusinessAddressRow"><i class="fa fa-plus" aria-hidden="true"></i></button>
                        </div>-->
                    </div>
                     
                     <br>       
                    <!-- Business Information/Services -->
                    <h4>Business Information</h4>
                    <div class="form-row">
                        <div class="form-group col-md-8">
                            <label for="yearsExperience">Business Name <span style="color:red;">*</span></label>
                        <input type="text" class="form-control" id="businessName" name="businessName" placeholder="Enter Business Name" value="<?php echo $row["businessName"];?>"  required>
                      
                          </div>
                      <div class="form-group col-md-4">
                        <label for="businessType">Business Type <span style="color:red;">*</span></label>
                     <select class="form-control" id="businessType" name="businessType">
                            <!--<option value="" disabled selected> Select</option>-->
                            <!--<option value="Tree Farm">Tree Farm</option>
                            <option value="Shop">Shop</option>
                            <option value="Other">Other</option>-->
                            <!--<select class="form-control" id="businessType" name="businessType">-->
                            <option value="" disabled <?php echo empty($row["businessType"]) ? 'selected' : ''; ?>>Select</option>
                            <!--<option value="Tree Farm" <php echo $row["businessType"] == "Tree Farm" ? 'selected' : ''; ?>>Tree Farm</option>-->
                            <!--<option value="Shop" <php echo $row["businessType"] == "Shop" ? 'selected' : ''; ?>>Shop</option>-->
                            <option value="Wholesale/Retail" <?php echo $row["businessType"] == "Wholesale/Retail" ? 'selected' : ''; ?>>Wholesale/Retail</option>
                            <option value="Service" <?php echo $row["businessType"] == "Service" ? 'selected' : ''; ?>>Service</option>
                            <!--<option value="Garden Center" <php echo $row["businessType"] == "Garden Center" ? 'selected' : ''; ?>>Garden Center</option>-->
                            <option value="Other" <?php echo $row["businessType"] == "Other" ? 'selected' : ''; ?>>Other</option>
                            
                           
                        </select>
        
                            <?php
                            /*
                            $query = "select * from service_category";
                            // $query = mysqli_query($con, $qr);
                            $result = $conn->query($query);
                            if ($result->num_rows > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                
                            ?>
                                    <option value="<?php echo $row['sc_id']; ?>"><?php echo $row['category_name']; ?></option>
                            <?php
                                }
                            }
                            */
                            ?>
                
                        </select>
                      </div>
                      <?php /* ?>
                      <div class="form-group col-md-4">
                            <label for="yearsExperience">Service/Product </label>
                      
                          <select class="form-control" id="subservices" name="services" >
                            <option value="0">Select service</option>
                
                        </select>
                      </div>
                      <?php */ ?>
                      <!--<div class="form-group col-md-4">
                            <label for="yearsExperience">Years of Experience </label>
                        <input type="number" class="form-control" id="yearsExperience" name="yearsExperience" placeholder="Enter years of experience" >
                      
                          </div>-->
                    </div>
                     <h5>Address</h5>
                      <?php
                            // `city`,`streetAddress`,`state`,`zipcode`,`tenant_id`
                            $address_sql ="SELECT * FROM tbusiness_address WHERE tenant_id='$tenant_id' ORDER BY id ASC";
                            $address_result = mysqli_query($conn, $address_sql);
                            // Step 2: Get the number of rows
                            $num_address_rows = mysqli_num_rows($address_result);
                            
                            if ($num_address_rows > 0) {
                                $i=1;
                                while($address_row = mysqli_fetch_assoc($address_result)) {
                                ?>
                                <div class="form-row">
                                  <div class="form-group col-md-4">
                                    <label for="address">Street Address <span style="color:red;">*</span></label>
                                    <input type="text" class="form-control" id="address" name="address[]" placeholder="Enter street address" value="<?php echo $address_row['streetAddress'];?>" required>
                                  </div>
                                  <div class="form-group col-md-3">
                                    <label for="city">City <span style="color:red;">*</span></label>
                                    <input type="text" class="form-control" id="city" name="city[]" placeholder="Enter city" value="<?php echo $address_row['city'];?>" autocomplete="off" oninput="allow_alphabets(this)" required>
                                  </div>
                                  <div class="form-group col-md-2">
                                    <label for="city">State <span style="color:red;">*</span></label>
                                    <input type="text" class="form-control" id="state" name="state[]" placeholder="Enter state" autocomplete="off" value="<?php echo $address_row['state'];?>" oninput="allow_alphabets(this)" required>
                                  </div>
                                  <div class="form-group col-md-2">
                                    <label for="zipCode">Zip Code <span style="color:red;">*</span></label>
                                    <input type="text" class="form-control" id="zipCode" name="zipCode[]" placeholder="Enter zip code" maxlength="5"  minlength="5" value="<?php echo $address_row['zipcode'];?>" oninput="check_for_numbers(this)">
                                  </div>
                                    <!--<div class="form-group col-md-1">
                                       <label for="zipCode"></label>
                                        <button type="button" class="btn btn-block custom-btn" id="addbusinessAddressRow"><i class="fa fa-plus" aria-hidden="true"></i></button>
                                    </div>-->
                                </div>
                                <?php
                                $i++;
                                }
                            }
                            else{
                        ?>
                                
                             <div class="form-row">
                                
                              <div class="form-group col-md-4">
                                <label for="address">Street Address <span style="color:red;">*</span></label>
                                <input type="text" class="form-control" id="address" name="address[]" placeholder="Enter street address"  required>
                              </div>
                              <div class="form-group col-md-3">
                                <label for="city">City <span style="color:red;">*</span></label>
                                <input type="text" class="form-control" id="city" name="city[]" placeholder="Enter city" autocomplete="off" oninput="allow_alphabets(this)" required>
                              </div>
                              <div class="form-group col-md-2">
                                <label for="city">State <span style="color:red;">*</span> </label>
                                <input type="text" class="form-control" id="state" name="state[]" placeholder="Enter state" autocomplete="off" oninput="allow_alphabets(this)" required>
                              </div>
                              <div class="form-group col-md-2">
                                <label for="zipCode">Zip Code </label>
                                <input type="text" class="form-control" id="zipCode" name="zipCode[]" placeholder="Enter zip code" maxlength="5"  minlength="5" oninput="check_for_numbers(this)">
                              </div>
                                <!--<div class="form-group col-md-1">
                                   <label for="zipCode"></label>
                                    <button type="button" class="btn btn-block custom-btn" id="addbusinessAddressRow"><i class="fa fa-plus" aria-hidden="true"></i></button>
                                </div>-->
                            </div>
                                
                        <?php } ?>
                    <div id="newbusinessAddressRow"></div>
                    
                     
                    <div class="form-row">
                          <div class="form-group col-md-4">
                        <label for="phoneNumber">Phone Number <span style="color:red;">*</span></label>
                        <input type="tel" class="form-control" id="businessPhoneNumber" name="businessPhoneNumber" placeholder="Enter phone number" maxlength="10"  minlength="10" value="<?php echo $row["phoneNumber"];?>" oninput="check_for_numbers(this)" >
                      </div>
                        <div class="form-group col-md-4">
                            <label for="email">Business Email </label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" value="<?php echo $row["email"];?>">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="professionalWebsite">Website URL </label>
                            <input type="text" class="form-control" id="professionalWebsite" name="professionalWebsite" placeholder="Enter website url" value="<?php echo $row["professionalWebsite"];?>">
                   <!--type="url"  type="text"-->
                        <!--<label for="socialMedia">Professional Social Media Profiles </label>-->
                        <!--<input type="url" class="form-control" id="socialMedia" placeholder="Enter professional social media profiles">-->
                      </div>
                     
                      <!--<div class="form-group col-md-4">-->
                      <!--  <label for="preferredLocations">Preferred Work Locations (if applicable) </label>-->
                      <!--  <input type="text" class="form-control" id="preferredLocations" name="preferredLocations" placeholder="Enter preferred work locations">-->
                      <!--</div>-->
                    </div>
                
                    <!-- Additional Details -->
                    <div class="form-row">
                      <!--div class="form-group col-md-6">
                        <label for="qualifications">Qualifications/Certifications </label>
                        <textarea class="form-control" id="qualifications" name="qualifications" rows="3" placeholder="Enter qualifications/certifications"></textarea>
                      </div>-->
                      
                        <div class="form-group col-md-6">
                            <label for="specializations">Business Description </label>
                            <textarea class="form-control" id="Businessdescription" name="Businessdescription" rows="3" placeholder="Business description"><?php echo $row["businessDescription"];?></textarea>
                        </div>
                        
                    </div>
                    <?php /* ?>
                   <div class="row">
                     <h4>Business Hours<input type="checkbox"  class=" ml-5" name="vehicle1" onchange="myFunction()"value="Bike">
                <label for="vehicle1" class=""> Show</label> </h4>
                </div>
                    <table id="myDIV">
                <!--   <tr>-->
                     
                    <!--<td><label for="agentCode" class="mr-2"> </label></td>-->
                <!--    <td></td>-->
                    <!--<td></td>-->
                <!--    <td><label for="agentCode" class="mr-2">Opning Time</label><label for="agentCode" class="mr-2">Closing Time</label></td>-->
                   
                <!--   <td></td>-->
                <!--   <td></td>-->
                <!--   <td></td>-->
                <!--   <td></td>-->
                <!--   <td></td>-->
                <!--   <td></td>-->
                <!--   <td></td><!--<td><label for="agentCode" class="mr-2"> </label></td>-->
                    <!--<td><label for="agentCode"  class="ml-2">Opning Time</label><label for="agentCode">Closing Time</label></td>-->
                   
                   <!--<td><label for="agentCode" class="mr-2"> </label></td>-->
                   <!-- <td><label for="agentCode" class="mr-2">Opning Time</label><label for="agentCode" class="mr-2">Closing Time</label></td>-->
                   <!-- <td><label for="agentCode" class="mr-2"> </label></td>-->
                   <!--<td><label for="agentCode" class="mr-2">Opning Time</label><label for="agentCode" class="mr-2">Closing Time</label></td>-->
                   
                     
                     
                <!--</tr>-->
                <tr>
                      <td><label for="sunday_time" class="mt-2">Sunday</label></td>
                      
                      <td>
                          <input class="mt-2  ml-2 d-none" type="text" name="1"  value="Sunday">
                          <input class="mt-2  ml-2" type="time" name="openSunday_time"  id="opensunday_time">
                      <input class="mt-2  ml-2" type="time" name="closeSunday_time" id="closesunday_time" >
                      </td>
                      <td>
                      
                      <input type="checkbox" id="toggleButton1"  onchange="workoff('toggleButton1','opensunday_time','closesunday_time')" class="mt-3 ml-2" name="vehicle1" >
                <label for="vehicle1" class="mt-3"> off</label>
                      </td>
                      <td > <label class="ml-5"> </label></td>
                      <td class=" ml-5">Monday</td>
                    
                      
                      <td> <input class="mt-2  ml-2 d-none" type="text" name="2"  value="Monday">
                          <input class="mt-2 ml-2" type="time" name="openMonday_time" id="openmonday_time">
                      <input class="mt-2 ml-2" type="time" name="closeMonday_time" id="closemonday_time">
                      </td>
                    <td>
                      
                      <input type="checkbox"  class="mt-3 ml-2" name="vehicle1" id="toggleButton2"  onchange="workoff('toggleButton2','openmonday_time','closemonday_time')">
                <label for="vehicle1" class="mt-3"> off</label>
                      </td>
                      
                      <td><label for="sunday_time" class="ml-5 mt-2">Tuesday</label></td>
                      <td> <input class="mt-2  ml-2 d-none" type="text" name="3"  value="Tuesday">
                          <input class="mt-2  ml-2" type="time" name="opentuesday_time" id="openTuesday_time" >
                      <input class="mt-2  ml-2" type="time" name="closeTuesday_time" id="closetuesday_time"  >
                      </td>
                       <td>
                      
                      <input type="checkbox"  class="mt-3 ml-3" name="vehicle1" id="toggleButton3" onchange="workoff('toggleButton3','opentuesday_time','closetuesday_time')">
                <label for="vehicle1" class="mt-3"> off</label>
                      </td>
                      </tr>
                  <tr>
                      <td><label for="sunday_time" class="mt-2">Wednesday</label></td>
                      <td> <input class="mt-2  ml-2 d-none" type="text" name="4"  value="Wednesday"><input class="mt-2  ml-2" type="time" name="openWednesday_time" id="openwednesday_time">
                      <input class="mt-2  ml-2" type="time" name="closeWednesday_time"  id="closewednesday_time">
                      </td>
                      <td>
                      
                      <input type="checkbox"  class="mt-3 ml-2" id="toggleButton4" name="vehicle1" onchange="workoff('toggleButton4','openwednesday_time','closewednesday_time')">
                <label for="vehicle1" class="mt-3"> off</label>
                      </td>
                      <td > <label class="ml-5"> </label></td>
                      <td class=" ml-5">Thursday</td>
                    
                      
                      <td> <input class="mt-2  ml-2 d-none" type="text" name="5"  value="Thursday">
                          <input class="mt-2 ml-2" type="time" name="openThursday_time" id="openthursday_time">
                      <input class="mt-2 ml-2" type="time" name="closeThursday_time" id="closethursday_time">
                      </td>
                    <td>
                      
                      <input type="checkbox"  class="mt-3 ml-2" id="toggleButton5" name="vehicle1" onchange="workoff('toggleButton5','openthursday_time','closethursday_time')">
                <label for="vehicle1" class="mt-3"> off</label>
                      </td>
                      
                      <td><label for="sunday_time" class="ml-5 mt-2">Friday</label></td>
                      <td><input class="mt-2  ml-2 d-none" type="text" name="6"  value="Friday">
                          <input class="mt-2  ml-2" type="time" name="openFriday_time" id="openfriday_time" >
                      <input class="mt-2  ml-2" type="time" name="closeFriday_time" id="closefriday_time" >
                      </td>
                       <td>
                      
                      <input type="checkbox"  class="mt-3 ml-3" id="toggleButton6" name="vehicle1" onchange="workoff('toggleButton6','openfriday_time','closefriday_time')">
                <label for="vehicle1" class="mt-3"> off</label>
                      </td>
                      </tr>    
                   <tr>
                      <td><label for="sunday_time" class="mt-2">Saturday</label></td>
                      <td><input class="mt-2  ml-2 d-none" type="text" name="7"  value="Saturday">
                          <input class="mt-2  ml-2" type="time" name="openSaturday_time" id="opensaturday_time">
                      <input class="mt-2  ml-2" type="time" name="closeSaturday_time" id="closesaturday_time">
                      </td>
                      <td>
                      
                      <input type="checkbox"  class="mt-3 ml-2"  id="toggleButton7" name="vehicle1" onchange="workoff('toggleButton7','opensaturday_time','closesaturday_time')">
                <label for="vehicle1" class="mt-3"> off</label>
                      </td>
                     
                      </tr>      
                <!--         <tr>-->
                <!--      <td>Wednesday</td>-->
                    
                      
                <!--      <td><input class="mt-2 ml-2" type="time" name="openwednesday_time">-->
                <!--      <input class="mt-2 ml-2" type="time" name="closewednesday_time">-->
                <!--      </td>-->
                <!--      <td>-->
                      
                <!--      <input type="checkbox"  class="mt-3 ml-3" name="vehicle1" value="Bike">-->
                <!--<label for="vehicle1" class="mt-3"> off</label>-->
                <!--      </td>-->
                    
                <!--      <td><label for="sunday_time">Thursday</label></td>-->
                <!--      <td><input class="mt-2  ml-2" type="time" name="openthursday_time">-->
                <!--      <input class="mt-2  ml-2" type="time" name="closethursday_time">-->
                <!--      </td>-->
                <!--      <td>-->
                      
                <!--      <input type="checkbox"  class="mt-3 ml-3" name="vehicle1" value="Bike">-->
                <!--<label for="vehicle1" class="mt-3"> off</label>-->
                <!--      </td>-->
                <!--      <td>Friday</td>-->
                    
                      
                <!--      <td><input class="mt-2 ml-2" type="time" name="openfriday_time">-->
                <!--      <input class="mt-2 ml-2" type="time" name="closefriday_time">-->
                <!--      </td>-->
                <!--    <td>-->
                      
                <!--      <input type="checkbox"  class="mt-3 ml-3" name="vehicle1" value="Bike">-->
                <!--<label for="vehicle1" class="mt-3"> off</label>-->
                <!--      </td>-->
                      <!--<td><label for="sunday_time">Saturday</label></td>-->
                      <!--<td><input class="mt-2  ml-2" type="time" name="opensaturday_time">-->
                      <!--<input class="mt-2  ml-2" type="time" name="closesaturday_time">-->
                      <!--</td>-->
                     
                <!--    </tr>-->
                   </table>
                   <?php */ ?>
                   
                    
                    <br>   
                        <!--Look & Feel-->
                        <h4>Look & Feel</h4>
                        <?php /* ?>
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label for="file">Logo <span style="color:red;" id="logo_validation">*</span></label>
                                <!--<input type="file" class="" name="file"  id="imgInp"  >-->
                                <input type="file" name="file" id="imgInp" accept="image/*">
                                <br><br>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" style="cursor:pointer;" id="logo_validate" name="logo_validate" value="1">
                                    <label class="form-check-label" for="logo_validate" style="font-weight: normal;">Don't have logo </label>
                                </div>
                            </div>
                            <div class="form-group col-md-3">
                               <!--<label for="blah"></label>-->
                               <!--https://calsgarden.com/hyq_time/Admin/businessImages/No-Image.png-->
                               <img id="blah" src="<?php echo $url.'/'.$row['logo'];?>" alt="Logo" class="mt-5" height="60" widht="60"  />
                            </div>
                        </div>
                        <?php */ ?>
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label for="file">Logo <span style="color:red; <?= $row['logo'] === 'businessImages/No-Image.png' ? 'display:none;' : '' ?>" id="logo_validation">*</span></label>
                                <!--<input type="file" name="file" id="imgInp" accept="image/*">-->
                                <input type="file" name="file" id="imgInp" accept="image/*" <?= $row['logo'] === 'businessImages/No-Image.png' ? '' : 'required' ?> >
                                <br><br>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" style="cursor:pointer;" id="logo_validate" name="logo_validate" value="1" <?= $row['logo'] === 'businessImages/No-Image.png' ? 'checked' : '' ?>>
                                    <label class="form-check-label" for="logo_validate" style="font-weight: normal;">Don't have logo </label>
                                </div>
                            </div>
                            <div class="form-group col-md-3">
                                <img id="blah" src="<?php echo $url.'/'.$row['logo'];?>" alt="Logo" class="mt-5" height="60" width="60" />
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <!--005085-->
                                <!--<label for="colorPicker">Pick a color:</label> <input type="color" id="colorPicker" value="#005085"><br>--> 
                                <!--<label for="colorPicker">Set Theme Color </label> <input type="color" id="colorPicker" value="<php echo empty($theme_color) ? '#005085' : $theme_color; ?>"><br>-->
                                <label for="colorPicker">Set Theme Color </label> 
                                
                                <div class="form-check form-check-inline">
                                    <label class="form-check-label" for="colorCode"><input type="color" id="colorPicker" value="<?php echo empty($theme_color) ? '#005085' : $theme_color; ?>"> </label> 
                                    <input class="form-control form-check-input" type="text" id="colorCode" name="colorCode" placeholder="Color Code" value="<?php echo empty($theme_color) ? '#005085' : $theme_color; ?>" style="margin-left:3%;">
                                </div>
                            </div>
                            
                            <div class="form-group col-md-3">
                                <label for="colorPicker1">Set Menu Highlight Color </label> 
                                <!--<input type="color" id="colorPicker" value="#005085">-->
                                <br>
                                <div class="form-check form-check-inline"> 
                                <!--#01294a-->
                                     <label class="form-check-label" for="colorCode1"><input  type="color" id="colorPicker1" value="<?php echo $highlight_color == '' ? '#01294a' : $highlight_color;?>"> </label>
                                    <input class="form-control form-check-input" type="text" id="colorCode1" name="colorCode1" placeholder="Color Code" value="<?php echo $highlight_color == '' ? '#01294a' : $highlight_color;?>" style="margin-left:3%;">
                                </div>
                            </div>
                            
                            <div class="form-group col-md-3">
                                <label for="colorPicker1">Color Preview </label> 
                                <br>
                                <div class="form-check form-check-inline">
                                    <div class="menu-preview" id="menuPreview">
                                        <div class="menu-item" id="menuItem1">Dashboard</div>
                                        <div class="menu-item active-item" id="menuItem2">Settings</div>
                                        <!--<div class="menu-item" id="menuItem3">Reports</div>-->
                                        <!--<div class="menu-item" id="menuItem4">Profile</div>-->
                                        <!--<div class="menu-item" id="menuItem5">Logout</div>-->
                                    </div>
                                </div>
                            </div>
                            
                            
                        </div>
                        
                    <!--Configuration-->
                    <br>
                    <!--<h4>Configuration</h4>-->
                    <h4>Configure Time Tracker</h4>
                    <!--<p>You will be logged out automatically after inactivity.</p>-->
                        <div class="form-row">
                            <?php //echo $row['status'] == 1 ? 'checked' : ''; ?>
                            
                            
                            <div class="form-group col-md-3">
                                <label for="autoLogout">Auto Punchout</label><br>
                                <!--<label for="autoLogout">Enable Auto Logout</label><br>-->
                                    
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" style="cursor:pointer;" id="autoLogout" name="autoLogout" value="1" <?php echo $row_features['auto_logout'] == 1 ? 'checked' : ''; ?>>
                                    <label class="form-check-label" for="autoLogout" style="font-weight: normal;">Yes</label>
                                </div>
                            </div>
                            
                            <!--<div class="form-group col-md-4" id="autoLogoutTimeFormat" style="display:none">-->
                            <div class="form-group col-md-4" id="autoLogoutTimeFormat" style="display: <?php echo $row_features['auto_logout'] == 1 ? 'block' : 'none'; ?>;">
                                <label for="timeFormat">Auto Punchout Duration</label><br>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" style="cursor:pointer;" name="timeFormat" id="midnightFormat" value="Midnight" <?php echo $row_features['auto_logout_time'] == 'Midnight' ? 'checked' : ''; ?> >
                                    <label class="form-check-label" for="midnightFormat" style="font-weight: normal;">At Midnight</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" style="cursor:pointer;" name="timeFormat" id="twelveHourFormat" value="12 Hours" <?php echo $row_features['auto_logout_time'] == '12 Hours' ? 'checked' : ''; ?>>
                                    <label class="form-check-label" for="twelveHourFormat" style="font-weight: normal;">After 12 Hours</label>
                                </div>
                            </div>
                            
                            <!--<div class="form-group col-md-3">-->
                                <!--<div class="form-check">-->
                            <!--        <label for="middleName">Select One </label>-->
                            <!--        <select class="form-control" id="autoLogoutValue" name="autoLogoutValue">-->
                            <!--            <option value="0" disabled> Select One</option>-->
                            <!--            <option value="1">Midnight</option>-->
                            <!--            <option value="2">12 Hourrs</option>-->
                                        <!--<option value="3">Employee</option>-->
                            <!--        </select>-->
                            <!--    </div>-->
                        </div>
                        
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label for="autoLogout">Pay Cycle</label><br>
                                <div class="form-check form-check-inline">
                                    <!--<label for="payPeriod">Select One </label>-->
                                    <!--<label for="payPeriod">Pay Period</label> <br>-->
                                    <select class="form-control" id="payPeriod" name="payPeriod" style="cursor:pointer;">
                                        <!--<option value="0" disabled> Select One</option>-->
                                        <!--pay_peroid_duration   week_start_from--> 
                                        <option value="7" <?php echo $row_features['pay_peroid_duration'] == '7' ? 'selected' : ''; ?> >Weekly</option>
                                        <option value="14" <?php echo $row_features['pay_peroid_duration'] == '14' ? 'selected' : ''; ?> >Bi-Weekly</option>
                                        <option value="Month" <?php echo $row_features['pay_peroid_duration'] == 'Month' ? 'selected' : ''; ?> >Monthly</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="form-group col-md-3" >
                                <label for="timeFormat">Pay Cycle Start</label><br>
                                <div class="form-check form-check-inline">
                                    <!--<input class="form-check-input" type="radio" style="cursor:pointer;" name="weekStartDay" id="weekStartDaySun" value="Monday" <php echo $row_features['week_start_from'] == 'Monday' ? 'checked' : ''; ?> >-->
                                    <input class="form-check-input" type="radio" style="cursor:pointer;" name="weekStartDay" id="weekStartDaySun" value="Monday" <?php echo ($row_features['week_start_from'] == 'Monday' || $row_features['week_start_from'] != 'Sunday') ? 'checked' : ''; ?> >
                                    <label class="form-check-label" for="midnightFormat" style="font-weight: normal;">Monday</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" style="cursor:pointer;" name="weekStartDay" id="weekStartDayMon" value="Sunday" <?php echo $row_features['week_start_from'] == 'Sunday' ? 'checked' : ''; ?>>
                                    <label class="form-check-label" for="twelveHourFormat" style="font-weight: normal;">Sunday</label>
                                </div>
                            </div>
                            <!--<div class="form-group col-md-3">-->
                            <!--    <label for="weekStartDay">Work Week Start</label><br>-->
                            <!--    <div class="form-check form-check-inline">-->
                                    <!--<label for="payPeriod">Select One </label>-->
                                    <!--<label for="payPeriod">Pay Period</label> <br>-->
                            <!--        <select class="form-control" id="weekStartDay" name="weekStartDay" style="cursor:pointer;">-->
                                        <!--<option value="0" disabled> Select One</option>-->
                                        <!--<option value="Monday" selected <php echo $row_features['week_start_from'] == 'Monday' ? 'selected' : ''; ?>>Monday</option>-->
                            <!--            <option value="Sunday" <php echo $row_features['week_start_from'] == 'Sunday' ? 'selected' : ''; ?>>Sunday</option>-->
                            <!--            <option value="Monday" <php echo ($row_features['week_start_from'] == 'Monday' || $row_features['week_start_from'] == '') ? 'selected' : ''; ?>>Monday</option>-->
                                        <!--<option value="Sunday" <php echo $row_features['week_start_from'] == 'Tuesday' ? 'selected' : ''; ?>>Tuesday</option>-->
                                        <!--<option value="Sunday" <php echo $row_features['week_start_from'] == 'Wednesday' ? 'selected' : ''; ?>>Wednesday</option>-->
                                        <!--<option value="Sunday" <php echo $row_features['week_start_from'] == 'Thursday' ? 'selected' : ''; ?>>Thursday</option>-->
                                        <!--<option value="Sunday" <php echo $row_features['week_start_from'] == 'Friday' ? 'selected' : ''; ?>>Friday</option>-->
                                        <!--<option value="Sunday" <php echo $row_features['week_start_from'] == 'Saturday' ? 'selected' : ''; ?>>Saturday</option>-->
                                        
                            <!--        </select>-->
                            <!--    </div>-->
                            <!--</div>-->
                            
                            <div class="form-group col-md-3">
                                <label for="timeSchedule">Staff Scheduler</label><br>
                                <!--<label for="autoLogout">Enable Auto Logout</label><br>-->
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" style="cursor:pointer;" id="timeSchedule" name="timeSchedule" value="1" <?php echo $row_features['time_schedule'] == 1 ? 'checked' : ''; ?>>
                                    <label class="form-check-label" for="timeSchedule" style="font-weight: normal;">Yes</label>
                                </div>
                            </div>
                            
                            <div class="form-group col-md-3"> </div>
                            
                            <div class="form-group col-md-3 d-none">
                                <label for="locationTracking">Location Tracking</label><br>
                                <label for="autoLogout">Enable Auto Logout</label><br>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" style="cursor:pointer;" id="locationTracking" name="locationTracking" value="1" <php echo $row_features['location_tracking'] == 1 ? 'checked' : ''; ?>>
                                    <label class="form-check-label" for="locationTracking" style="font-weight: normal;">Yes</label>
                                </div>
                            </div>
                            
                        </div>
                     
                   <?php // ?>
                    <div class="form-row">
                        <div class="form-group col-md-9"></div>
                        <div class="form-group col-md-3">
                            <!--<button type="button" class="btn custom-btn btn-primary" onclick="nextStep()">Next</button>-->
                            <button type="submit" class="btn custom-btn register"  style="color: #fff;" onclick="return nextStep()">Update</button> 
                            <button type="button" class="btn custom-btn cancel" onclick="location.reload()" style="color: #fff;">Cancel</button>
                        </div>
                    </div>
                    <br><br>
                <!--</div>-->
                <!-- Step 2: -->
                <!--<div id="step2" style="display: none;">-->
                    
                    
                        <!-- Submit and Cancel Buttons -->
                        <!--<div class="form-row">-->
                        <!--  <div class="col-md-2">-->
                        <!--    <button type="submit" class="btn btn-block custom-btn register"  style="color: #fff;">Update</button> -->
                            <!--onclick="return create_validation();"-->
                        <!--  </div>-->
                        <!--  <div class="col-md-2">-->
                        <!--    <button type="button" class="btn btn-block custom-btn cancel" onclick="location.reload()" style="color: #fff;">Cancel</button>-->
                        <!--  </div>-->
                        <!--</div>-->
                        
                        <div class="form-row">
                            <div class="col-md-6"></div>
                          <div class="col-md-6">
                            <!--<button type="button" class="btn custom-btn btn-secondary" onclick="prevStep()">Prev</button>-->
                            <!--<button type="submit" class="btn custom-btn register"  style="color: #fff;">Update</button> -->
                            <!--<button type="button" class="btn custom-btn cancel" onclick="location.reload()" style="color: #fff;">Cancel</button>-->
                          </div>
                        </div>
                        
                <!--</div>-->
                <!--ds_close-->
          </form>
        </div>
        
        <section class="mt-5">
          <!-- Footer -->
          <footer class="text-center text-white" id="footer" style="background-color:#004F86;"> <!--background-color:#0a4275; -->
            <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
              © 2024 Copyright:
              <!--<div class="copyright"><a href="https://hyqsoft.com/" target="_blank">HyQsoft Technologies India PVT LTD © 2024 All Rights Reserved</a></div>-->
              <a class="text-white" href="https://hyqsoft.com/" target="_blank">HyQsoft Technologies India PVT LTD © 2024 All Rights Reserved</a>
            </div>
            <!-- Copyright -->
          </footer>
          <!-- Footer -->
        </section>
        
         <!--Confirmation  Modal -->
        <div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
                <!--<form  action="delete_dept.php" method="POST" enctype="multipart/form-data"> -->
              <div class="modal-header">
                <!--<h5 class="modal-title" id="exampleModalLabel">Modal title</h5>-->
                <h3 style=" font-size:20px; font-weight:600;" class="modal-title" id="exampleModalLabel">Confirmation!</h3>
                    <!--<div class="vstaffstyle">-->
                    <!--<h3><input type="text" name="delete_dept_id" id="delete_dept_id" size="1" class="eee" readonly /></h3>-->
                    <!--</div>-->
                <!--<button type="button" class="close" data-dismiss="modal" aria-label="Close">-->
                  <!--<span aria-hidden="true">&times;</span>-->
                <!--</button>-->
              </div>
              <div class="modal-body">
                  <input type="text" class="d-none" name="confirm_code" id="confirm_code" size="1" class="eee" readonly />
                <!--<label>Is this barcode correct?</label>-->
                 <label id="modelbarcode"></label>
                 
              </div>
              <div class="modal-footer">
                <!--<button type="button" name="delete" class="btn btn-success"  style="background-color:#5c825a; color:white; margin-bottom:5px; border:none;" onclick="return confirmBarcode(1)" id="coll"  >Yes</button>-->
                <button type="button" name="delete" class="btn btn-success"  style="background-color: <?php echo empty($highlight_color) ? '#01294a' : $highlight_color; ?>; color: <?php echo $textColor2;?>; margin-bottom:5px; border:none;" onclick="return confirmBarcode(1)" id="coll"  >Yes</button>
                <button type="button" class="btn btn-secondary" onclick="return confirmBarcode(0)" id="colla">No</button>
        
              </div>
              <!--</form>-->
            </div>
          </div>
        </div>
            
                  <!-- user Confirmation Modal -->
            <div class="modal fade" id="userConfirmationModal" role="dialog">
                <div class="modal-dialog  modal-md" style="width: auto">
                     <!--Modal content -->
                    <div class="modal-content shadow-lg">
                        <div class="modal-header">
                            <!--<h5 class="modal-title" id="exampleModalLabel">Modal title</h5> -->
                            <!--<h3 style=" font-size:20px; font-weight:600;" class="modal-title" id="userConfirmationModalLabel">Confirmation!</h3>-->
                            <h4 class="modal-title" id="userConfirmationModalLabel">Confirmation!</h4>
                        </div>
                        <div class="modal-body">
                            <!--<div class="container-fluid">-->
                                <!--<p>Are you sure you want to give a discount of more than 10% ?</p>-->
                                <p id="pkg_msg" style="display:none;">Your package will be change to "<span id="new_package_name">new package</span>".</p>
                                <p id="msg_userAction" style="font-size: 18px;"></p>
                                <!--<p>Are you sure you want to upgrade your package?</p>-->
                                <!--<p>Are you sure you want to give a discount of more than 20% ?</p>-->
                                <!--<p>Are you sure you want to give a discount of more than 30% ?</p>-->
                            <!--</div>-->
                            
                        </div>
                        <div class="modal-footer">
                            <!--<button type="button" name="delete" class="btn btn-success"  style="background-color: <php echo empty($highlight_color) ? '#01294a' : $highlight_color; ?>; color: <php echo $textColor2;?>; margin-bottom:5px; border:none;" onclick="return confirmBarcode(1)" id="coll"  >Yes</button>-->
                            <!--<button type="button" class="btn btn-secondary" onclick="return confirmBarcode(0)" id="colla">No</button>-->
                            <button type="button" class="btn btn-success ml-2" id="confirm_userAction" style="background-color: <?php echo empty($highlight_color) ? '#01294a' : $highlight_color; ?>; color: <?php echo $textColor2;?>; margin-bottom:5px; border:none;">Yes</button>
                            <button type="button" class="btn btn-secondary" id="cancel_userAction" data-dismiss="modal">No</button>    
                        </div>
                    </div>
                </div>
            </div>

        
    </section>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script>
    
    // for autoLogout
     document.getElementById('autoLogout').addEventListener('change', function() {
        if (this.checked) {
            // autoLogoutTimeFormat  midnightFormat
            // console.log("Auto Logout is enabled.");
            
            document.getElementById('autoLogoutTimeFormat').style.display = 'block';
            // midnightFormat
            //set default to Midnight
            document.getElementById('midnightFormat').checked = true;
            
            
        } else {
            // console.log("Auto Logout is disabled.");
            document.getElementById('autoLogoutTimeFormat').style.display = 'none';
            const radioButtons = document.getElementsByName('timeFormat');
            radioButtons.forEach(radio => {
                radio.checked = false;
            });
        }
    });
    
    // for logo validation
    document.getElementById('logo_validate').addEventListener('change', function() {
        if (this.checked) {
            // document.getElementById('logo_validation').style.display = 'none';
            $("#logo_validation").hide();
            document.getElementById("imgInp").removeAttribute("required");
            // midnightFormat
            
        } else {
            // document.getElementById('logo_validation').style.display = 'block';
            $("#logo_validation").show();
            document.getElementById("imgInp").setAttribute("required", "required");
            
        }
    });
    
   function nextStep() {
    //   alert("validation called");
        // document.getElementById('step1').style.display = 'none';
        // document.getElementById('step2').style.display = 'block';
        // function validateStep1() {
            // Get required fields
            var businessName = document.getElementById('businessName').value.trim();
            var businessType = document.getElementById('businessType').value;
            // businessType businessType
            var address = document.getElementById('address').value.trim();
            var city = document.getElementById('city').value.trim();
            var state = document.getElementById('state').value.trim();
            var zipCode = document.getElementById('zipCode').value.trim();
            var zipCode_length = document.getElementById('zipCode').value.length;
            var businessPhoneNumber = document.getElementById('businessPhoneNumber').value.trim();
            
            var firstName= document.getElementById("firstName").value;
            var lastName= document.getElementById("lastName").value;
            // var phoneNumber= document.getElementById("phoneNumber").value;
            var phone_1_input_length= document.getElementById("phoneNumber").value.length;
            var userEmail= document.getElementById("userEmail").value;
            var role_input= document.getElementById("role").value;
            // var username= document.getElementById("username").value;
            // var password= document.getElementById("password").value;
            // var confirm_password= document.getElementById("confirm_password").value;
            
            // plan_package
            var plan_package= document.getElementById("plan_package").value;
            
            // bill_address1
            // bill_address_section
            // bill_address
            // bill_city
            // bill_state
            // bill_zipCode
            var bill_address_sts=0;
            if ($("#bill_address1").prop("checked")) {
                bill_address_sts=1;
            }
            else{
                bill_address_sts=0;
            }
                
            var bill_address = document.getElementById('bill_address').value.trim();
            var bill_city = document.getElementById('bill_city').value.trim();
            var bill_state = document.getElementById('bill_state').value.trim();
            var bill_zipCode = document.getElementById('bill_zipCode').value.trim();
            var bill_zipCode_length = document.getElementById('bill_zipCode').value.length;
            // var zipCode_length = document.getElementById('zipCode').value.length;
            
            
            // Initialize validation flag
            var isValid = true;
            
            if(firstName == ""  ){
                alert("Please enter first name.");
                document.getElementById("firstName").focus();
                return false;
            }
            else if(lastName == ""  ){
                alert("Please enter last name.");
                document.getElementById("lastName").focus();
                return false;
            }
            
            else if( phoneNumber == '' ){
                alert("Please enter phone number.");
                document.getElementById("phoneNumber").focus();
                return false;
            }
            
            // user_mobile_no
            // else if( (user_mobile_no.indexOf(""+phoneNumber) !== -1) )  
            // { 
            //     alert("This user phone number is already exist. Please try another."); 
            //     document.getElementById("phoneNumber").focus();
            //     return false;
            // }
            else if( phone_1_input_length != 10 ){
                alert("Please enter valid phone number.");
                document.getElementById("phoneNumber").focus();
                return false;
            }
            
            // else if(userEmail == "") {
            //     alert("Please enter user email.");
            //     document.getElementById("userEmail").focus();
            //     return false;
            // }
            // else if(username != ""){
            /*else if( (uname.indexOf(""+userEmail) !== -1)  || (user_email.indexOf(""+userEmail) !== -1))  
            { 
                alert("This email is already exist. Please try another."); 
                document.getElementById("userEmail").focus();
                return false;
            } 
            */
            else if(role_input == "0"  ){
                alert("Please select role.");
                document.getElementById("role").focus();
                return false;
            }
            
            //username  password   confirm_password
            /*else if((password == "") && (confirm_password != "" ) ){
                alert("Please enter password.");
                document.getElementById("password").focus();
                return false;
            }
            else if((password != "") && (confirm_password == "" ) ){
                alert("Please enter confirm password.");
                document.getElementById("confirm_password").focus();
                return false;
            }
            else if(confirm_password !== password ){
                alert("Password and confirm password are not matching.");
                document.getElementById("confirm_password").focus();
                return false;
            }*/
            /*else if(plan_package == 0 ){
                alert("Please select package.");
                document.getElementById("plan_package").focus();
                return false;
            }*/
            
            /*else if (!bill_address && bill_address_sts==0 && plan_package > 1) {
                alert("Please enter billing street address.");
                // isValid = false;
                document.getElementById('bill_address').focus();
                return false;
            }else if (!bill_city && bill_address_sts==0 && plan_package > 1) {
                alert("Please enter billing city.");
                // isValid = false;
                document.getElementById('bill_city').focus();
                return false;
            }else if (!bill_state && bill_address_sts==0 && plan_package > 1) {
                alert("Please enter billing state.");
                // isValid = false;
                document.getElementById('bill_state').focus();
                return false;
            }
            // bill_zipCode
            else if (!bill_zipCode && bill_address_sts==0 && plan_package > 1) {
                alert("Please enter billing zip code.");
                // isValid = false;
                document.getElementById('bill_zipCode').focus();
                return false;
            }
            else if (bill_zipCode_length != 5 && bill_address_sts==0 && plan_package > 1) {
                alert("Please enter valid billing zip code.");
                // isValid = false;
                document.getElementById('bill_zipCode').focus();
                return false;
            }
            */
            
            if (bill_address_sts == 0 && plan_package > 1) {
                if (!bill_address) {
                    alert("Please enter billing street address.");
                    document.getElementById('bill_address').focus();
                    return false;
                }
                if (!bill_city) {
                    alert("Please enter billing city.");
                    document.getElementById('bill_city').focus();
                    return false;
                }
                if (!bill_state) {
                    alert("Please enter billing state.");
                    document.getElementById('bill_state').focus();
                    return false;
                }
                if (!bill_zipCode) {
                    alert("Please enter billing zip code.");
                    document.getElementById('bill_zipCode').focus();
                    return false;
                }
                if (bill_zipCode.length != 5) {
                    alert("Please enter a valid billing zip code.");
                    document.getElementById('bill_zipCode').focus();
                    return false;
                }
            }


            // Check if business name is filled
            if (!businessName) {
                alert("Please enter the business name.");
                document.getElementById('businessName').focus();
                isValid = false;
                return false;
            }
            // Check if a business type is selected
            // else if (!businessType) {
            //     alert("Please select a business type.");
            //     // isValid = false;
            //     document.getElementById('businessType').focus();
            // }
            else if (!address) {
                alert("Please enter street address.");
                // isValid = false;
                document.getElementById('address').focus();
                return false;
            }else if (!city) {
                alert("Please enter city.");
                // isValid = false;
                document.getElementById('city').focus();
                return false;
            }else if (!state) {
                alert("Please enter state.");
                // isValid = false;
                document.getElementById('state').focus();
                return false;
            }else if (!zipCode) {
                alert("Please enter zip code.");
                // isValid = false;
                document.getElementById('zipCode').focus();
                return false;
            }
            else if (zipCode_length != 5) {
                alert("Please enter valid zip code.");
                // isValid = false;
                document.getElementById('zipCode').focus();
                return false;
            }
            else if (!businessPhoneNumber) {
                alert("Please enter business phone number.");
                // isValid = false;
                document.getElementById('businessPhoneNumber').focus();
                return false;
            }
            
            // If all required fields are filled, go to the next step
            //  if(isValid) {
            else{
                
                var isValid = true;  // Flag to track if the form is valid
                var isValid1 = true;  // Flag to track if the form is valid
                //code to check unique values start
                
                const emails = Array.from(document.querySelectorAll('input[name="userEmail[]"]')).map(input => input.value.trim());
                const phoneNumbers = Array.from(document.querySelectorAll('input[name="phoneNumber[]"]')).map(input => input.value.trim());
                
                const emailSet = new Set(emails);
                const phoneSet = new Set(phoneNumbers);
                
                if (phoneSet.size !== phoneNumbers.length) {
                  alert("Duplicate phone numbers found. Please ensure each phone number is unique.");
                  isValid1 = false;
                  return false;
                }
                
                if (emailSet.size !== emails.length) {
                  alert("Duplicate email addresses found. Please ensure each email is unique.");
                  isValid1 = false;
                  return false;
                }
                else{
                    isValid1=true;
                }
                
                //code to check unique values end
                
                // Get the count of inputs with name="phoneNumber[]"
                var phoneNumberCount = $('input[name="phoneNumber[]"]').length;
                // console.log("Count of phoneNumber[] inputs: " + phoneNumberCount);
                // alert("Count of phoneNumber[] inputs: " + phoneNumberCount);
                
                
                // Loop through each input and log its id
                $('input[name="phoneNumber[]"]').each(function(index) {
                    // console.log("ID of phoneNumber[" + index + "]: " + $(this).attr('id'));
                    // alert("ID:"+ $(this).attr('id'));
                    var fullId = $(this).attr('id');  // Get the full id (e.g., phoneNumber_1)
                    
                    var firstName= 'firstName';
                    var lastName= 'lastName';
                    var phoneNumber= 'phoneNumber';
                    var role= 'role';
                    var userEmail= 'userEmail';
    
                    // Check if the id contains an underscore and split it
                    if (fullId.includes('_')) {
                        var parts = fullId.split('_');  // Split the id by underscore
                        var baseId = parts[0];          // This will be 'phoneNumber'
                        var suffix = parts[1];          // This will be '1' (or the numeric part)
                        
                        firstName= 'firstName_'+ suffix;
                        lastName= 'lastName_'+ suffix;
                        phoneNumber= 'phoneNumber_'+ suffix;
                        role= 'role_'+ suffix;
                        userEmail= 'userEmail_'+ suffix;
                        // console.log("Base ID: " + baseId + ", Suffix: " + suffix);
                        // alert("Base ID: " + baseId + ", Suffix: " + suffix);
                    } 
                    else {
                        // If no underscore, treat it as the base id with no suffix
                        // console.log("Base ID: " + fullId + ", No Suffix");
                        firstName= 'firstName';
                        lastName= 'lastName';
                        phoneNumber= 'phoneNumber';
                        role= 'role';
                        userEmail= 'userEmail';
                    }
                    
                    var fname= document.getElementById(""+firstName).value;
                    var lname= document.getElementById(""+lastName).value;
                    // var phoneNumber= document.getElementById("phoneNumber").value;
                    var phone_input_length= document.getElementById(""+phoneNumber).value.length;
                    var role_id= document.getElementById(""+role).value;
                    var userEmail_id= document.getElementById(""+userEmail).value;
                    
                    // if((fname != "" ) || (lname != "" ) ){
                        if(fname == ""  ){
                            alert("Please enter first name");
                            document.getElementById(""+firstName).focus();
                            isValid = false;
                            return false;
                        }
                        else if(lname == ""  ){
                            alert("Please enter last name");
                            document.getElementById(""+lastName).focus();
                            isValid = false;
                            return false;
                        }
                        else if(phone_input_length != 10 ){
                            alert("Please enter valid phone number ");
                            document.getElementById(""+phoneNumber).focus();
                            isValid = false;
                            return false;
                        }
                         
                        else if(userEmail_id == ""  ){
                            alert("Please enter user email");
                            document.getElementById(""+userEmail).focus();
                            isValid = false;
                            return false;
                        }
                        else if(role_id == "0"  ){
                            alert("Please select role");
                            document.getElementById(""+role).focus();
                            isValid = false;
                            return false;
                        }
                    // }
                    else{
                         isValid = true;  // Flag to track if the form is valid
                    }
                    
                });
                
                // alert("isValid:"+isValid);
                // if(isValid === 'true'){
                if (isValid && isValid1) {
                    return true;
                    // alert("run");
                    // Code to show the next step (e.g., moving to step 2)
                    // document.getElementById('step1').style.display = 'none';
                    // document.getElementById('step2').style.display = 'block';
                    // alert("run1");
                }else{
                    return false;
                }
                //  return false;
                
            }
        // }
        // startAutoLogout();
    }
    function prevStep() {
        document.getElementById('step2').style.display = 'none';
        document.getElementById('step1').style.display = 'block';
        // startAutoLogout();
    }
/* function hideDiv(){
     var x = document.getElementById("myDIV");
     x.style.display = "none";
 } 
  hideDiv();*/
  function workoff(btnId,startTime,endTime){
    //   alert(btnId);
     var checkedboxval=$("#"+btnId).is(":checked");

    //   alert(x);
//  document.getElementById(btnId).addEventListener("change", function() {
  if (checkedboxval==true) {
   document.getElementById(startTime).value = "";
document.getElementById(endTime).value = "";
 document.getElementById(startTime).readOnly=true;
document.getElementById(endTime).readOnly=true;

  } 
  else {
       document.getElementById(endTime).readOnly=false;
            document.getElementById(startTime).readOnly=false;
    
    
  }
// }); 
}
  
  function myFunction() {
  var x = document.getElementById("myDIV");
  if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }
}
  
   imgInp.onchange = evt => {
      
      const [file] = imgInp.files;
      if (file) {
        blah.src = URL.createObjectURL(file)
      }
    }
    
    var i=2;
    $("#addbusinessAddressRow").click(function () {
            
        var html = '';
        html += ' <div id="inputFormRow">';
        html += '<h6>Address '+i+'</h6>';
        html += '<div class="form-row" >';
        
        html += '<div class="form-group col-md-4">';
        html += '<label for="address">Street Address </label>';
        html += '<input type="text" class="form-control" id="address'+i+'" name="address[]" placeholder="Enter street address" >';
        html += '</div>';
        html += '<div class="form-group col-md-3">';
        html += ' <label for="city">City </label>';
        html += '<input type="text" class="form-control" id="city'+i+'" name="city[]" placeholder="Enter city" autocomplete="off" oninput="allow_alphabets(this)">';
        html += '</div>';
        html += '<div class="form-group col-md-2">';
        html += '<label for="city">State </label>';
        html += '<input type="text" class="form-control" id="state'+i+'" name="state[]" placeholder="Enter state" autocomplete="off" oninput="allow_alphabets(this)">';
        html += '</div>';
        html += '<div class="form-group col-md-2">';
        html += '<label for="zipCode">Zip Code </label>';
        html += '<input type="text" class="form-control" id="zipCode'+i+'" name="zipCode[]" placeholder="Enter zip code" maxlength="5"  minlength="5" oninput="check_for_numbers(this)">';
        html += '</div>';
        html += '<div class="form-group col-md-1 ">';
        
        html += '<button id="removeRow" type="button" class="btn btn-danger mt-4"><i class="fa fa-times" aria-hidden="true"></i></button>';
        //  html += '<button type="button" class="btn btn-block custom-btn form-control">Add<i class="fa fa-plus"></i></button>';
        html += '</div>';
        html += '</div>';
        html += '</div>';
        
        
        $('#newbusinessAddressRow').append(html);
        i++;
    });
  
  // remove row
          $(document).on('click', '#removeRow', function () {
              $(this).closest('#inputFormRow').remove();
          });
      
  /*    $("#addcontactinfoRow").click(function () {
              var html = '';
 html += '<div class="form-row" id="contactinfoRow">';
      html += '<div class="form-group col-md-3">';
        html += '<label for="firstName">First Name </label>';
        html += '<input type="text" class="form-control" id="firstName" name="firstName[]" placeholder="Enter first name" autocomplete="off" oninput="allow_alphabets(this)" >';
      html += '</div>';
    //   html += '<div class="form-group col-md-2">';
    //     html += '<label for="middleName">Middle Name </label>';
    //     html += '<input type="text" class="form-control" id="middleName" name="middleName[]" placeholder="Enter middle name">';
    //   html += '</div>';
      html += '<div class="form-group col-md-3">';
        html += '<label for="lastName">Last Name </label>';
        html += '<input type="text" class="form-control" id="lastName" name="lastName[]" placeholder="Enter last name" autocomplete="off" oninput="allow_alphabets(this)" >';
      html += '</div>';
      html += '<div class="form-group col-md-3">';
        html += '<label for="phoneNumber">Phone Number </label>';
        html += '<input type="tel" class="form-control" id="phoneNumber" name="phoneNumber[]" placeholder="Enter phone number" maxlength="10"  minlength="10" oninput="check_for_numbers(this)">';
      html += '</div>';
      html += '<div class="form-group col-md-2">';
        html += '<label for="role">Role </label>';
        html += '<select class="form-control" id="role" name="role[]">';
            // html += '<option value="0"> Select role</option>';
            html += '<option value="0" disabled> Select role</option>';
            html += '<option value="1">Owner</option>';
            html += '<option value="2">Supervisor</option>';
            html += '<option value="3">Employee</option>';
        <?php
            /*
            $query = "select * from role";
            // $query = mysqli_query($con, $qr);
            $result = $conn->query($query);
            if ($result->num_rows > 0) {
                while ($row = mysqli_fetch_assoc($result)) {

            ?>
                     html += '<option value="<?php echo $row['id']; ?>"><?php echo $row['role_name']; ?></option>';
            <?php
                }
            }
            */
            ?>
         
            html += '</select>';
         html += ' </div>';
       html += '<div class="form-group col-md-1">';
           html += '<button id="removecontactinfoRow" type="button" class="btn btn-danger mt-4"><i class="fa fa-times" aria-hidden="true"></i></button>';
         html += ' </div>';
    html += '</div>';


             
              
  
              $('#newcontactinfoRow').append(html);
          });
  */
  // remove row
      /*    $(document).on('click', '#removecontactinfoRow', function () {
              $(this).closest('#contactinfoRow').remove();
          });  
      */
         
        //  var rowCount = 0;  // Initialize a counter to generate unique IDs
         var rowCount = <?php echo $num_contact_rows;?>;  // Initialize a counter to generate unique IDs
        // $num_contact_rows
        $("#addcontactinfoRow").click(function () {
            var userRowCount = $('input[name="firstName[]"]').length;
            // alert("userRowCount:"+userRowCount);
            
            // for max 3 user validation
            if(userRowCount < 3){
                
                var tenant_id= $('#tenant_id').val();
                // new_Active_emp_flag
                var new_Active_emp_flag= $('#new_Active_emp_flag').val();
                var temp_new_plan_package_flag= $('#new_plan_package_flag').val();
                var existing_package= $('#new_plan_package_flag').val();
                // alert("tenant_id:"+tenant_id+" flag:"+flag);
                // $active_emp  $plan_package_new
                // var current_active_emp= <php echo $active_emp;?>;
                // var current_active_emp1 = <php echo json_encode($active_emp); ?>;
                
                //old data start
                //existing active user/emp
                var current_active_emp = <?php echo json_encode(!empty($active_emp) ? $active_emp : 0); ?>;
                //existing plan package
                // var existing_package = <php echo json_encode(!empty($plan_package_new) ? $plan_package_new : 1); ?>;
                
                //existing users
                var existing_user = <?php echo json_encode(!empty($num_contact_rows) ? $num_contact_rows : 0); ?>;
                 
                //old data end
        
                // var 
                // alert("tenant_id:"+tenant_id+" || current_active_emp:"+current_active_emp+" || current_active_emp1:"+current_active_emp1);
                // alert("tenant_id:"+tenant_id+" || new_Active_emp_flag:"+new_Active_emp_flag+" || current_active_emp:"+current_active_emp+" || existing_package:"+existing_package+" || existing_user:"+existing_user);
                var new_active_emp = parseInt(new_Active_emp_flag) + 1;
                   
               $.ajax({
                    url: 'getPackageDetail_Admin.php',
                    type: 'POST',
                    data:{
                        tenant_id:tenant_id,
                        new_active_emp: new_active_emp
                    },
                    dataType:"json",
                    success: function(response2) {
                        // Process the response from the second request
                        // console.log("Second request successful:", response2);
                        // new_plan_package  description
                        // alert("existing_package:"+existing_package+" || new_plan_package: "+response2.new_plan_package);
                        // alert("existing_package:"+existing_package+" || old_db_package: "+response2.old_db_package+" || new_plan_package: "+response2.new_plan_package);
                        // old_db_package -- > from db
                        if(existing_package != response2.new_plan_package){
                            
                            //show new package msg
                            $('#pkg_msg').show();
                            $('#new_package_name').text(response2.description);
                            document.getElementById('msg_userAction').innerHTML  =  'Are you sure want to add new user?';
                            
                            // alert("package will change");
                            $("#userConfirmationModal").modal('show');
                
                             // Remove any previously attached event handler to avoid multiple calls
                            $('#confirm_userAction').off('click');
                            $('#cancel_userAction').off('click');
                            
                            $('#confirm_userAction').on('click', function() {
                                // Close the modal
                                $('#userConfirmationModal').modal('hide');
                                // Execute action after confirming
                                // $('#contactinfoRow_' + rowId).remove();
                                // alert("Yes button clicked");
                                rowCount++;  // Increment the counter for each new row
                        
                                var html = '';
                                html += '<div class="form-row" id="contactinfoRow_' + rowCount + '">';
                                html += '<div class="form-group col-md-2">';
                                html += '<input type="text" class="d-none" name="existUser[]" id="existUser' + rowCount + '"value="0" >';
                                html += '<label for="firstName_' + rowCount + '">First Name <span style="color:red;">*</span></label>';
                                html += '<input type="text" class="form-control" id="firstName_' + rowCount + '" name="firstName[]" placeholder="Enter first name" autocomplete="off" oninput="allow_alphabets(this)" >';
                                html += '</div>';
                            
                                html += '<div class="form-group col-md-2">';
                                html += '<label for="lastName_' + rowCount + '">Last Name <span style="color:red;">*</span></label>';
                                html += '<input type="text" class="form-control" id="lastName_' + rowCount + '" name="lastName[]" placeholder="Enter last name" autocomplete="off" oninput="allow_alphabets(this)" >';
                                html += '</div>';
                            
                                html += '<div class="form-group col-md-2">';
                                html += '<label for="phoneNumber_' + rowCount + '">Phone Number <span style="color:red;">*</span></label>';
                                html += '<input type="tel" class="form-control" id="phoneNumber_' + rowCount + '" name="phoneNumber[]" placeholder="Enter phone number" maxlength="10" minlength="10" oninput="check_for_numbers(this)">';
                                html += '</div>';
                                
                                html += '<div class="form-group col-md-3">';
                                html += '<label for="userEmail_' + rowCount + '">Email <span style="color:red;">*</span></label>';
                                html += '<input type="email" class="form-control" id="userEmail_' + rowCount + '" name="userEmail[]" placeholder="Enter email" value="" autocomplete="off">';
                                html += '</div>';
                                
                                html += '<div class="form-group col-md-2">';
                                html += '<label for="role_' + rowCount + '">Role <span style="color:red;">*</span></label>';
                                html += '<select class="form-control" id="role_' + rowCount + '" name="role[]">';
                                html += '<option value="0" disabled> Select role</option>';
                                html += '<option value="2">Owner</option>';
                                html += '<option value="3">Supervisor</option>';
                                // html += '<option value="2">Supervisor</option>';
                                // html += '<option value="3">Employee</option>';
                                html += '</select>';
                                html += '</div>';
                            
                                html += '<div class="form-group col-md-1">';
                                html += '<button id="removecontactinfoRow_' + rowCount + '" type="button" class="btn btn-danger mt-4" onclick="removeRow(' + rowCount + ')"><i class="fa fa-times" aria-hidden="true"></i></button>';
                                html += '</div>';
                                html += '</div>';
                            
                                $('#newcontactinfoRow').append(html);
                                // Add your action here after Yes button is clicked
                                //change active emp/user count
                                $('#new_Active_emp_flag').val(''+parseInt(new_active_emp)); 
                                
                                //change temperory new_plan_package_flag
                                $('#new_plan_package_flag').val(''+parseInt(response2.new_plan_package)); 
                                
                                // new_plan_package_flag
                                if(parseInt(response2.new_plan_package) > 1){
                                    // alert("show credit card details1");
                                    // To show the element (remove 'd-none' class)
                                    // $("#card_Details1").removeClass("d-none");
                                    
                                    // To hide the element (add 'd-none' class)
                                    // $("#card_Details1").addClass("d-none");
                                    $("#card_Details1").removeClass("d-none");
                                    document.getElementById("creditcardnumber1").removeAttribute("required", "required");
                                    document.getElementById("creditcardnumber").removeAttribute("required", "required");
                                    document.getElementById("credit_expiry_date1").removeAttribute("required", "required");
                                    document.getElementById("credit_expiry_date").removeAttribute("required", "required");
                                    document.getElementById("credit_cvv1").removeAttribute("required", "required");
                                    document.getElementById("credit_cvv").removeAttribute("required", "required");
                                    $("#card_Details2").removeClass("d-none");
                                    $("#card_Details3").removeClass("d-none");
                                    
                                    // $("#bill_address_section").show();
                                    if ($("#bill_address1").prop("checked")) {
                                        document.getElementById("bill_address_section").style.display="none";
                                        $("#bill_address_section").addClass("d-none");
                                        document.getElementById("bill_address").value='';
                                        document.getElementById("bill_city").value='';
                                        document.getElementById("bill_state").value='';
                                        document.getElementById("bill_zipCode").value='';
                                    //   document.getElementById("exampleTextarea1").value="Same as Customer";
                                        document.getElementById("bill_address").removeAttribute("required", "required");
                                        document.getElementById("bill_city").removeAttribute("required", "required");
                                        document.getElementById("bill_state").removeAttribute("required", "required");
                                        document.getElementById("bill_zipCode").removeAttribute("required", "required");
                                        
                                    } else {
                                        $("#bill_address_section").removeClass("d-none");
                                        document.getElementById("bill_address_section").style.display="";
                                        document.getElementById("bill_address").setAttribute("required", "required");
                                        document.getElementById("bill_city").setAttribute("required", "required");
                                        document.getElementById("bill_state").setAttribute("required", "required");
                                        document.getElementById("bill_zipCode").setAttribute("required", "required");
                                    }
                                    
                                }
                                else{
                                    // alert("hide credit card details1");
                                    // To show the element (remove 'd-none' class)
                                    // $("#card_Details1").removeClass("d-none");
                                    
                                    // To hide the element (add 'd-none' class)
                                    // $("#card_Details1").addClass("d-none");
                                    $("#card_Details1").addClass("d-none");
                                    $("#card_Details2").addClass("d-none");
                                    document.getElementById("creditcardnumber1").setAttribute("required", "required");
                                    document.getElementById("creditcardnumber").setAttribute("required", "required");
                                    document.getElementById("credit_expiry_date1").setAttribute("required", "required");
                                    document.getElementById("credit_expiry_date").setAttribute("required", "required");
                                    document.getElementById("credit_cvv1").setAttribute("required", "required");
                                    document.getElementById("credit_cvv").setAttribute("required", "required");
                                    
                                    $("#card_Details3").addClass("d-none");
                                    // $("#bill_address_section").show();
                                    if ($("#bill_address1").prop("checked")) {
                                        document.getElementById('bill_address1').checked = false;
                                        document.getElementById("bill_address_section").style.display="none";
                                        $("#bill_address_section").addClass("d-none");
                                        document.getElementById("bill_address").value='';
                                        document.getElementById("bill_city").value='';
                                        document.getElementById("bill_state").value='';
                                        document.getElementById("bill_zipCode").value='';
                                    //   document.getElementById("exampleTextarea1").value="Same as Customer";
                                        
                                    } else {
                                        $("#bill_address_section").addClass("d-none");
                                        document.getElementById("bill_address_section").style.display="";
                                    }
                                    
                                    document.getElementById("bill_address").removeAttribute("required");
                                    document.getElementById("bill_city").removeAttribute("required");
                                    document.getElementById("bill_state").removeAttribute("required");
                                    document.getElementById("bill_zipCode").removeAttribute("required");
                                    
                                    
                                }
                                
                            });
                    
                            $('#cancel_userAction').on('click', function() {
                                // Close the modal
                                $('#userConfirmationModal').modal('hide');
                                // Execute action after cancelling
                                // alert("discount_p:"+discount_p);
                                // alert("No button clicked");
                               
                                // Add your action here after No button is clicked
                            });
                            
                            // $('#new_package_name').html(data.emp_id);
                            // $('#new_package_name').text(response2.description);
                            // // Open the confirmation modal
                            // $('#upgradeModalStep1').modal('show');  //check after package credit card details required to enter or not
                            
                            
                        }else{ 
                            //hide new package msg
                            $('#pkg_msg').hide();
                            $('#new_package_name').text('new package');
                            
                            // for same new & old package
                            // alert("package will not change");
                            document.getElementById('msg_userAction').innerHTML  =  'Are you sure want to add new user?';
                            $("#userConfirmationModal").modal('show');
                
                             // Remove any previously attached event handler to avoid multiple calls
                            $('#confirm_userAction').off('click');
                            $('#cancel_userAction').off('click');
                            
                            $('#confirm_userAction').on('click', function() {
                                // Close the modal
                                $('#userConfirmationModal').modal('hide');
                                // Execute action after confirming
                                // $('#contactinfoRow_' + rowId).remove();
                                // alert("Yes button clicked");
                                rowCount++;  // Increment the counter for each new row
                        
                                var html = '';
                                html += '<div class="form-row" id="contactinfoRow_' + rowCount + '">';
                                html += '<div class="form-group col-md-2">';
                                html += '<input type="text" class="d-none" name="existUser[]" id="existUser' + rowCount + '"value="0" >';
                                html += '<label for="firstName_' + rowCount + '">First Name <span style="color:red;">*</span></label>';
                                html += '<input type="text" class="form-control" id="firstName_' + rowCount + '" name="firstName[]" placeholder="Enter first name" autocomplete="off" oninput="allow_alphabets(this)" >';
                                html += '</div>';
                            
                                html += '<div class="form-group col-md-2">';
                                html += '<label for="lastName_' + rowCount + '">Last Name <span style="color:red;">*</span></label>';
                                html += '<input type="text" class="form-control" id="lastName_' + rowCount + '" name="lastName[]" placeholder="Enter last name" autocomplete="off" oninput="allow_alphabets(this)" >';
                                html += '</div>';
                            
                                html += '<div class="form-group col-md-2">';
                                html += '<label for="phoneNumber_' + rowCount + '">Phone Number <span style="color:red;">*</span></label>';
                                html += '<input type="tel" class="form-control" id="phoneNumber_' + rowCount + '" name="phoneNumber[]" placeholder="Enter phone number" maxlength="10" minlength="10" oninput="check_for_numbers(this)">';
                                html += '</div>';
                                
                                html += '<div class="form-group col-md-3">';
                                html += '<label for="userEmail_' + rowCount + '">Email <span style="color:red;">*</span></label>';
                                html += '<input type="email" class="form-control" id="userEmail_' + rowCount + '" name="userEmail[]" placeholder="Enter email" value="" autocomplete="off">';
                                html += '</div>';
                                
                                html += '<div class="form-group col-md-2">';
                                html += '<label for="role_' + rowCount + '">Role <span style="color:red;">*</span></label>';
                                html += '<select class="form-control" id="role_' + rowCount + '" name="role[]">';
                                html += '<option value="0" disabled> Select role</option>';
                                html += '<option value="2">Owner</option>';
                                html += '<option value="3">Supervisor</option>';
                                // html += '<option value="2">Supervisor</option>';
                                // html += '<option value="3">Employee</option>';
                                html += '</select>';
                                html += '</div>';
                            
                                html += '<div class="form-group col-md-1">';
                                html += '<button id="removecontactinfoRow_' + rowCount + '" type="button" class="btn btn-danger mt-4" onclick="removeRow(' + rowCount + ')"><i class="fa fa-times" aria-hidden="true"></i></button>';
                                html += '</div>';
                                html += '</div>';
                            
                                $('#newcontactinfoRow').append(html);
                                // Add your action here after Yes button is clicked
                                //change active emp/user count
                                $('#new_Active_emp_flag').val(''+parseInt(new_active_emp)); 
                                
                                //change temperory new_plan_package_flag
                                // $('#new_plan_package_flag').val(''+parseInt(response2.new_plan_package));
                                
                                // if(existing_package > 1){
                                //     alert("Show credit card details");
                                // }else{
                                //     alert("Hide credit card details");
                                // }
                                
                            });
                    
                            $('#cancel_userAction').on('click', function() {
                                // Close the modal
                                $('#userConfirmationModal').modal('hide');
                                // Execute action after cancelling
                                // alert("discount_p:"+discount_p);
                                // alert("No button clicked");
                                // Add your action here after No button is clicked
                            });
                            
                            
                            
                        }
                        
                        
                    },
                    error: function(xhr, status, error) {
                        console.error("Error in second request:", error);
                    }
                });
             
                
                /*document.getElementById('msg_userAction').innerHTML  =  'Are you sure want to add new user?';
                $("#userConfirmationModal").modal('show');
                
                 // Remove any previously attached event handler to avoid multiple calls
                $('#confirm_userAction').off('click');
                $('#cancel_userAction').off('click');
                
                $('#confirm_userAction').on('click', function() {
                    // Close the modal
                    $('#userConfirmationModal').modal('hide');
                    // Execute action after confirming
                    // $('#contactinfoRow_' + rowId).remove();
                    // alert("Yes button clicked");
                    rowCount++;  // Increment the counter for each new row
            
                    var html = '';
                    html += '<div class="form-row" id="contactinfoRow_' + rowCount + '">';
                    html += '<div class="form-group col-md-2">';
                    html += '<input type="text" class="d-none" name="existUser[]" id="existUser' + rowCount + '"value="0" >';
                    html += '<label for="firstName_' + rowCount + '">First Name <span style="color:red;">*</span></label>';
                    html += '<input type="text" class="form-control" id="firstName_' + rowCount + '" name="firstName[]" placeholder="Enter first name" autocomplete="off" oninput="allow_alphabets(this)" >';
                    html += '</div>';
                
                    html += '<div class="form-group col-md-2">';
                    html += '<label for="lastName_' + rowCount + '">Last Name <span style="color:red;">*</span></label>';
                    html += '<input type="text" class="form-control" id="lastName_' + rowCount + '" name="lastName[]" placeholder="Enter last name" autocomplete="off" oninput="allow_alphabets(this)" >';
                    html += '</div>';
                
                    html += '<div class="form-group col-md-2">';
                    html += '<label for="phoneNumber_' + rowCount + '">Phone Number <span style="color:red;">*</span></label>';
                    html += '<input type="tel" class="form-control" id="phoneNumber_' + rowCount + '" name="phoneNumber[]" placeholder="Enter phone number" maxlength="10" minlength="10" oninput="check_for_numbers(this)">';
                    html += '</div>';
                    
                    html += '<div class="form-group col-md-3">';
                    html += '<label for="userEmail_' + rowCount + '">Email <span style="color:red;">*</span></label>';
                    html += '<input type="email" class="form-control" id="userEmail_' + rowCount + '" name="userEmail[]" placeholder="Enter email" value="" autocomplete="off">';
                    html += '</div>';
                    
                    html += '<div class="form-group col-md-2">';
                    html += '<label for="role_' + rowCount + '">Role <span style="color:red;">*</span></label>';
                    html += '<select class="form-control" id="role_' + rowCount + '" name="role[]">';
                    html += '<option value="0" disabled> Select role</option>';
                    html += '<option value="2">Owner</option>';
                    html += '<option value="3">Supervisor</option>';
                    // html += '<option value="2">Supervisor</option>';
                    // html += '<option value="3">Employee</option>';
                    html += '</select>';
                    html += '</div>';
                
                    html += '<div class="form-group col-md-1">';
                    html += '<button id="removecontactinfoRow_' + rowCount + '" type="button" class="btn btn-danger mt-4" onclick="removeRow(' + rowCount + ')"><i class="fa fa-times" aria-hidden="true"></i></button>';
                    html += '</div>';
                    html += '</div>';
                
                    $('#newcontactinfoRow').append(html);
                    // Add your action here after Yes button is clicked
                });
        
                $('#cancel_userAction').on('click', function() {
                    // Close the modal
                    $('#userConfirmationModal').modal('hide');
                    // Execute action after cancelling
                    // alert("discount_p:"+discount_p);
                    // alert("No button clicked");
                   
                    // Add your action here after No button is clicked
                });
                */
                
            }
            else{
                
                alert("You cannot add more than 3 users."); 
            }
            
            // alert("userRowCount2:"+userRowCount);
        });
        
        //Delete Emp
    
        // $(document).on('click','.delete_modal',function(){
        //         var staff_id= $(this).attr('id');
        
        //      $('#delete_staff_id').val(staff_id);
        //     //  $("#exampleModal1").modal('show'); // newly comment
            
        //     packageValidation(2); // to check package upgrade for delete
        
        // });

        // Function to remove the specific row
        function removeRow(rowId) {
            var userRowCount = $('input[name="phoneNumber[]"]').length;
            // alert("userRowCount:"+userRowCount+" || rowId:"+rowId);
            var existUser= "existUser";
            if(rowId==0){
               existUser= "existUser"; 
            }else{
               existUser= "existUser"+rowId; 
            }
            
            // confirmationModal
            // alert("existUser:"+existUser);
            
            // existUser
            if(userRowCount==1){
                alert("You cannot delete this row.");
            }else{
                // $('#contactinfoRow_' + rowId).remove();
              /*  document.getElementById('msg_userAction').innerHTML  =  'Are you sure want to remove user?';
                $("#userConfirmationModal").modal('show');
                
                 // Remove any previously attached event handler to avoid multiple calls
                $('#confirm_userAction').off('click');
                $('#cancel_userAction').off('click');
                
                $('#confirm_userAction').on('click', function() {
                    // Close the modal
                    $('#userConfirmationModal').modal('hide');
                    // Execute action after confirming
                    $('#contactinfoRow_' + rowId).remove();
                    // alert("Yes button clicked");
                    // Add your action here after Yes button is clicked
                });
        
                $('#cancel_userAction').on('click', function() {
                    // Close the modal
                    $('#userConfirmationModal').modal('hide');
                    // Execute action after cancelling
                    // alert("discount_p:"+discount_p);
                    // alert("No button clicked");
                   
                    // Add your action here after No button is clicked
                });
               */ 
               
               var tenant_id= $('#tenant_id').val();
                // new_Active_emp_flag
                var new_Active_emp_flag= $('#new_Active_emp_flag').val();
                var temp_new_plan_package_flag= $('#new_plan_package_flag').val();
                var existing_package= $('#new_plan_package_flag').val();
                // alert("tenant_id:"+tenant_id+" flag:"+flag);
                // $active_emp  $plan_package_new
                // var current_active_emp= <php echo $active_emp;?>;
                // var current_active_emp1 = <php echo json_encode($active_emp); ?>;
                
                //old data start
                //existing active user/emp
                var current_active_emp = <?php echo json_encode(!empty($active_emp) ? $active_emp : 0); ?>;
                //existing plan package
                // var existing_package = <php echo json_encode(!empty($plan_package_new) ? $plan_package_new : 1); ?>;
                
                //existing users
                var existing_user = <?php echo json_encode(!empty($num_contact_rows) ? $num_contact_rows : 0); ?>;
                 
                //old data end
        
                // var 
                // alert("tenant_id:"+tenant_id+" || current_active_emp:"+current_active_emp+" || current_active_emp1:"+current_active_emp1);
                // alert("tenant_id:"+tenant_id+" || new_Active_emp_flag:"+new_Active_emp_flag+" || current_active_emp:"+current_active_emp+" || existing_package:"+existing_package+" || existing_user:"+existing_user);
                var new_active_emp = parseInt(new_Active_emp_flag) - 1;
                   
                   $.ajax({
                        url: 'getPackageDetail_Admin.php',
                        type: 'POST',
                        data:{
                            tenant_id:tenant_id,
                            new_active_emp: new_active_emp
                        },
                        dataType:"json",
                        success: function(response2) {
                            // Process the response from the second request
                            // console.log("Second request successful:", response2);
                            // new_plan_package  description
                            // alert("existing_package:"+existing_package+" || new_plan_package: "+response2.new_plan_package);
                            // alert("existing_package:"+existing_package+" || old_db_package: "+response2.old_db_package+" || new_plan_package: "+response2.new_plan_package);
                            // old_db_package -- > from db
                            if(existing_package != response2.new_plan_package){
                                
                                //show new package msg
                                $('#pkg_msg').show();
                                $('#new_package_name').text(response2.description);
                                document.getElementById('msg_userAction').innerHTML  =  'Are you sure want to remove this user?';
                                
                                // alert("package will change");
                                $("#userConfirmationModal").modal('show');
                    
                                 // Remove any previously attached event handler to avoid multiple calls
                                $('#confirm_userAction').off('click');
                                $('#cancel_userAction').off('click');
                                
                                $('#confirm_userAction').on('click', function() {
                                    // Close the modal
                                    // $('#userConfirmationModal').modal('hide');
                                    // Execute action after confirming
                                    // $('#contactinfoRow_' + rowId).remove();
                                    // alert("Yes button clicked");
                                    
                                    //add code here
                                    // Close the modal
                                    $('#userConfirmationModal').modal('hide');
                                    // Execute action after confirming
                                    $('#contactinfoRow_' + rowId).remove();
                                    
                                    // Add your action here after Yes button is clicked
                                    //change active emp/user count
                                    $('#new_Active_emp_flag').val(''+parseInt(new_active_emp)); 
                                    
                                    //change temperory new_plan_package_flag
                                    $('#new_plan_package_flag').val(''+parseInt(response2.new_plan_package)); 
                                    
                                    // new_plan_package_flag
                                    if(parseInt(response2.new_plan_package) > 1){
                                        // alert("show credit card details1");
                                        // To show the element (remove 'd-none' class)
                                        // $("#card_Details1").removeClass("d-none");
                                        
                                        // To hide the element (add 'd-none' class)
                                        // $("#card_Details1").addClass("d-none");
                                        $("#card_Details1").removeClass("d-none");
                                        document.getElementById("creditcardnumber1").removeAttribute("required", "required");
                                        document.getElementById("creditcardnumber").removeAttribute("required", "required");
                                        document.getElementById("credit_expiry_date1").removeAttribute("required", "required");
                                        document.getElementById("credit_expiry_date").removeAttribute("required", "required");
                                        document.getElementById("credit_cvv1").removeAttribute("required", "required");
                                        document.getElementById("credit_cvv").removeAttribute("required", "required");
                                        $("#card_Details2").removeClass("d-none");
                                        $("#card_Details3").removeClass("d-none");
                                        
                                        // $("#bill_address_section").show();
                                        if ($("#bill_address1").prop("checked")) {
                                            document.getElementById("bill_address_section").style.display="none";
                                            $("#bill_address_section").addClass("d-none");
                                            document.getElementById("bill_address").value='';
                                            document.getElementById("bill_city").value='';
                                            document.getElementById("bill_state").value='';
                                            document.getElementById("bill_zipCode").value='';
                                        //   document.getElementById("exampleTextarea1").value="Same as Customer";
                                            document.getElementById("bill_address").removeAttribute("required", "required");
                                            document.getElementById("bill_city").removeAttribute("required", "required");
                                            document.getElementById("bill_state").removeAttribute("required", "required");
                                            document.getElementById("bill_zipCode").removeAttribute("required", "required");
                                            
                                        } else {
                                            $("#bill_address_section").removeClass("d-none");
                                            document.getElementById("bill_address_section").style.display="";
                                            document.getElementById("bill_address").setAttribute("required", "required");
                                            document.getElementById("bill_city").setAttribute("required", "required");
                                            document.getElementById("bill_state").setAttribute("required", "required");
                                            document.getElementById("bill_zipCode").setAttribute("required", "required");
                                        }
                                        
                                    }
                                    else{
                                        // alert("hide credit card details1");
                                        // To show the element (remove 'd-none' class)
                                        // $("#card_Details1").removeClass("d-none");
                                        
                                        // To hide the element (add 'd-none' class)
                                        // $("#card_Details1").addClass("d-none");
                                        $("#card_Details1").addClass("d-none");
                                        $("#card_Details2").addClass("d-none");
                                        document.getElementById("creditcardnumber1").setAttribute("required", "required");
                                        document.getElementById("creditcardnumber").setAttribute("required", "required");
                                        document.getElementById("credit_expiry_date1").setAttribute("required", "required");
                                        document.getElementById("credit_expiry_date").setAttribute("required", "required");
                                        document.getElementById("credit_cvv1").setAttribute("required", "required");
                                        document.getElementById("credit_cvv").setAttribute("required", "required");
                                        
                                        $("#card_Details3").addClass("d-none");
                                        // $("#bill_address_section").show();
                                        if ($("#bill_address1").prop("checked")) {
                                            document.getElementById('bill_address1').checked = false;
                                            document.getElementById("bill_address_section").style.display="none";
                                            $("#bill_address_section").addClass("d-none");
                                            document.getElementById("bill_address").value='';
                                            document.getElementById("bill_city").value='';
                                            document.getElementById("bill_state").value='';
                                            document.getElementById("bill_zipCode").value='';
                                        //   document.getElementById("exampleTextarea1").value="Same as Customer";
                                            
                                        } else {
                                            $("#bill_address_section").addClass("d-none");
                                            document.getElementById("bill_address_section").style.display="";
                                        }
                                        
                                        document.getElementById("bill_address").removeAttribute("required");
                                        document.getElementById("bill_city").removeAttribute("required");
                                        document.getElementById("bill_state").removeAttribute("required");
                                        document.getElementById("bill_zipCode").removeAttribute("required");
                                        
                                        
                                    }
                                    
                                });
                        
                                $('#cancel_userAction').on('click', function() {
                                    // Close the modal
                                    $('#userConfirmationModal').modal('hide');
                                    // Execute action after cancelling
                                    // alert("discount_p:"+discount_p);
                                    // alert("No button clicked");
                                   
                                    // Add your action here after No button is clicked
                                });
                                
                                // $('#new_package_name').html(data.emp_id);
                                // $('#new_package_name').text(response2.description);
                                // // Open the confirmation modal
                                // $('#upgradeModalStep1').modal('show');  //check after package credit card details required to enter or not
                                
                                
                            }else{ 
                                //hide new package msg
                                $('#pkg_msg').hide();
                                $('#new_package_name').text('new package');
                                
                                // for same new & old package
                                // alert("package will not change");
                                document.getElementById('msg_userAction').innerHTML  =  'Are you sure want to remover this user?';
                                $("#userConfirmationModal").modal('show');
                    
                                 // Remove any previously attached event handler to avoid multiple calls
                                $('#confirm_userAction').off('click');
                                $('#cancel_userAction').off('click');
                                
                                $('#confirm_userAction').on('click', function() {
                                    // Close the modal
                                    $('#userConfirmationModal').modal('hide');
                                    // Execute action after confirming
                                    // $('#contactinfoRow_' + rowId).remove();
                                    // alert("Yes button clicked");
                                    // Add your action here after Yes button is clicked
                                    //change active emp/user count
                                    $('#new_Active_emp_flag').val(''+parseInt(new_active_emp)); 
                                    
                                    //change temperory new_plan_package_flag
                                    // $('#new_plan_package_flag').val(''+parseInt(response2.new_plan_package)); 
                                    // if(existing_package > 1){
                                    //     alert("Show credit card details");
                                    // }else{
                                    //     alert("Hide credit card details");
                                    // }
                                    
                                });
                        
                                $('#cancel_userAction').on('click', function() {
                                    // Close the modal
                                    $('#userConfirmationModal').modal('hide');
                                    // Execute action after cancelling
                                    // alert("discount_p:"+discount_p);
                                    // alert("No button clicked");
                                    // Add your action here after No button is clicked
                                });
                                
                                
                                
                            }
                            
                            
                        },
                        error: function(xhr, status, error) {
                            console.error("Error in second request:", error);
                        }
                    });
                         
                // document.getElementById('modelbarcode').innerHTML  =  'Are you sure want to remove user?';
                // $("#confirmationModal").modal('show');
            }
        }
        // Function to remove the specific row
        function removeRow1(rowId) {
            $('#contactinfoRow_' + rowId).remove();
        }
        
      /*  $('#userConfirmationModal').modal('show');
            // Remove any previously attached event handler to avoid multiple calls
            $('#confirm_userAction').off('click');
            $('#cancel_userAction').off('click');
            
            $('#confirm_userAction').on('click', function() {
                // Close the modal
                $('#userConfirmationModal').modal('hide');
                // Execute action after confirming
                // alert("Yes button clicked");
                document.getElementById(discount).onchange();
                // Add your action here after Yes button is clicked
            });
    
            $('#cancel_userAction').on('click', function() {
                // Close the modal
                $('#userConfirmationModal').modal('hide');
                // Execute action after cancelling
                // alert("discount_p:"+discount_p);
                // alert("No button clicked");
                // alert("field_name1:"+field_name)
                // morediscount_flag=1;
                // alert("field1:"+field);
                if(morediscount_flag==1){
                    // alert("row:"+row);
                    // alert("main_row:"+main_row);
                    // alert("morediscount_flag:"+morediscount_flag);
                    morediscount_flag=0;
                    
                    let row_number = field.substring(10);
                    document.getElementById("discount_p"+ row_number).value=0; 
                    document.getElementById("discount"+ row_number).onchange();
                    document.getElementById("discount_p"+ row_number).focus();
                }
                // alert("morediscount_flag:"+morediscount_flag);
                // document.getElementById(discount_p).value=0; field_name
                // document.getElementById(discount).onchange();
                //  document.getElementById("discount_p"+ row).value=0; 
                // document.getElementById("discount"+ row).onchange();
                // document.getElementById("discount_p"+ row).focus();
                // Add your action here after No button is clicked
            });
            
         */     
        
        
/*         
function confirmBarcode(flag){
     let statusValue = $('#uactiveStatus').val();
    //  alert(statusValue);
     var sts;
    if(statusValue ==0)
    {
        sts="Inactive";
        
    }
    else{
        sts="Active";
        
    }
    var active;
     if (flag =="1")
          {
              
              if(statusValue == 0){
                  active=1;
              }
              else{
                  active=0;
              }
          } 
          else {
            active = statusValue;
            
          }
       
     
      $('#uactiveStatus').val(active);
       
    
       if(active == 0){
         $('#uactiveStatus').prop('checked',true);
       }
       else{
         $('#uactiveStatus').prop('checked',false);
       }
     
     $("#confirmationModal").modal('hide');
     
    //  uactiveStatus_old
     var old_status = $('#uactiveStatus_old').val();
     if(old_status != active){
        packageValidation(1); // to check package upgrade for edit 
     }
    
}
*/
        
    /*$(document).ready(function() {
        $("#businessType").on('change', function() {
            var countryid = $(this).val();
    
            $.ajax({
                method: "POST",
                url: "response.php",
                data: {
                    id: countryid
                },
                datatype: "html",
                success: function(data) {
                    $("#subservices").html(data);
                    // $("#city").html('<option value="">Select city</option');
    
                }
            });
        });
       
    });
*/
//create emp validation
function create_validation(){
    //check existing username
    // usernameArray();
//     var ur= uname[0];
// alert("Array: "+ur);
  

  
      var first_name = document.getElementById("firstName").value;
      var last_name = document.getElementById("lastName").value;
      var emial_id = document.getElementById("email").value;
    var phone_1_input_length = document.getElementById("phoneNumber").value.length;
     var address_input = document.getElementById("address").value;
     var city = document.getElementById("city").value;
     var zipCode = document.getElementById("zipCode").value;
    // alert("username: "+username);
     
    // var phone_2_input_length = document.getElementById("phone_2").value.length;
     var profession = document.getElementById("profession").value;
    //  alert(profession);
  var subservices = document.getElementById("subservices").value;
   var qualifications = document.getElementById("qualifications").value;
 
   if(first_name == ""  ){
        //  alert(checkBox);
        alert("Please Enter First Name");
        document.getElementById("firstName").focus();
        // phone_2.style.border = "solid 3px red";
        return false;
    }
     if(last_name == ""  ){
        //  alert(checkBox);
        alert("Please Enter Last Name");
        document.getElementById("lastName").focus();
        // phone_2.style.border = "solid 3px red";
        return false;
    }
    if( phone_1_input_length != 10 ){
        //  alert(checkBox);
        alert("Please Enter Valid Number ");
        document.getElementById("phoneNumber").focus();
        // phone_1.style.border = "solid 3px red";
        return false;
    }
     
    if(address_input == ""  ){
        //  alert(checkBox);
        alert("Please enter address");
        document.getElementById("address").focus();
        // phone_2.style.border = "solid 3px red";
        return false;
    }
    // dept
    if(city == ""  ){
        //  alert(checkBox);
        alert("Please enter city");
        document.getElementById("city").focus();
        // phone_2.style.border = "solid 3px red";
        return false;
    }
  
   
   else if(zipCode == "") {
        alert("Please Enter zipCode.");
        document.getElementById("zipCode").focus();
        return false;
    }
   
   
/*
    else if(profession == "0"  ){
        //  alert(checkBox);
        alert("Please select service");
        document.getElementById("profession").focus();
        // phone_2.style.border = "solid 3px red";
        return false;
    }
   else if(subservices == "0"  ){
        //  alert(checkBox);
        alert("Please select sub services");
        document.getElementById("subservices").focus();
        // phone_2.style.border = "solid 3px red";
        return false;
    }
     else if(qualifications == "0"  ){
        //  alert(checkBox);
        alert("Please enter qualifications");
        document.getElementById("qualifications").focus();
        // phone_2.style.border = "solid 3px red";
        return false;
    }
    */
}
    
    // check unique phone
    /*function checkPhoneNumberUnique(phoneNumber) {
        return fetch('checkPhoneNumber.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ phoneNumber: phoneNumber })
        })
        .then(response => response.json())
        .then(data => data.isUnique);
    }
    */
    
    //remove whitespace for text
    /*$(function(){
        $('input[type="text"]').change(function(){
            this.value = $.trim(this.value);
        });
    });*/
    
    //remove whitespace for inputs
    $(function(){
        $('input').change(function(){
            // this.value = $.trim(this.value);
             this.value = this.value.trim();
        });
    });
    
    // check number only
//Numbers input validation without ()
  function check_for_numbers(element){
        let textInput = element.value;
        let pattern = /[0-9]+/gm;
        // if(pattern.test(textInput)){
        //     console.log("String contains Numbers.");
        // }else{
        //     console.log("String doesnot contain Numbers.");
        // }
        textInput = textInput.replace(/[^0-9]*$/gm, ""); 
        element.value = textInput;
    }
//check text only
 function allow_alphabets(element){
        let textInput = element.value;
        textInput = textInput.replace(/[^A-Za-z ']*$/gm, ""); 
        element.value = textInput;
    }
    function allow_alphabets_ws(element){
        let textInput = element.value;
        textInput = textInput.replace(/[^A-Za-z']*$/gm, ""); 
        element.value = textInput;
    }
    document.getElementById('businessForm').addEventListener('submit', function(e) {
        e.preventDefault(); // Prevent the default form submission
    
        // Create a FormData object from the form
        let formData = new FormData(this);
    
        // Check if the phone number is unique before submitting the form
        let phoneNumber = document.getElementById('businessPhoneNumber').value;
        let tenant_id = document.getElementById('tenant_id').value;
        checkPhoneNumberUnique(phoneNumber,tenant_id).then(isUnique => {
            if (isUnique) {
                // Phone number is unique, proceed with form submission
                submitForm(formData);
            } else {
                alert('Phone number already exists. Please use a different phone number.');
            }
        });
    });
    
    function checkPhoneNumberUnique(phoneNumber,tenant_id) {
        return fetch('update_checkPhoneNumber.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ phoneNumber: phoneNumber, tenant_id:tenant_id })
        })
        .then(response => response.json())
        .then(data => data.isUnique);
    }
    
    function submitForm(formData) {
        fetch('updateBusinessdata.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // alert('Data updated successfully!');
                alert('Data updated successfully! Your login credentials for new users will be sent to the registered email.');
                if (data.notification) {
                    alert(data.notification);
                }else{
                    // alert("No pacakge update");
                }
                window.location.href='business_summary.php';
                // Optionally, redirect or clear the form
            } else {
                alert('Failed to update data.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }

    </script>
    <script>
      let arrow = document.querySelectorAll(".arrow");
      for (var i = 0; i < arrow.length; i++) {
        arrow[i].addEventListener("click", (e)=>{
       let arrowParent = e.target.parentElement.parentElement;//selecting main parent of arrow
       arrowParent.classList.toggle("showMenu");
        });
      }
      let sidebar = document.querySelector(".sidebar");
      let sidebarBtn = document.querySelector(".bx-menu");
    //   console.log(sidebarBtn);
      sidebarBtn.addEventListener("click", ()=>{
        sidebar.classList.toggle("close");
      });
      
    //   script for darkLight
    /*const body = document.querySelector("body");
    const darkLight = document.querySelector("#darkLight");
    // const sidebar = document.querySelector(".sidebar");
    // const submenuItems = document.querySelectorAll(".submenu_item");
    // const sidebarOpen = document.querySelector("#sidebarOpen");
    // const sidebarClose = document.querySelector(".collapse_sidebar");
    // const sidebarExpand = document.querySelector(".expand_sidebar");
      darkLight.addEventListener("click", () => {
          body.classList.toggle("dark");
          if (body.classList.contains("dark")) {
            document.setI;
            darkLight.classList.replace("bx-sun", "bx-moon");
          } else {
            darkLight.classList.replace("bx-moon", "bx-sun");
          }
        });
        */
        
        //for color picker code start
        
        //for theme color
        const colorPicker = document.getElementById('colorPicker');
        const colorCode = document.getElementById('colorCode');
        // const error = document.getElementById('error');

        // When color is selected via the color picker
        colorPicker.addEventListener('input', function() {
            colorCode.value = colorPicker.value;
            updateMenuPreview();// get preview 
            // clearValidation();  // Clear validation when color is picked
        });

        // When color code is typed into the input field
        // colorCode.addEventListener('input', function() {
        colorCode.addEventListener('change', function() {
            const code = colorCode.value.trim();
            validateColorCode(code);
        });

        // Function to validate the color code
        function validateColorCode(code) {
            // Check if the code is a valid hex color code
            if (/^#[0-9A-F]{6}$/i.test(code)) {
                colorPicker.value = code;
                updateMenuPreview();// get preview 
                // clearValidation();
            } else {
                alert("Please set valid color code.");
                colorCode.value ='';
                colorPicker.focus();
            }
        }
        
        
        //for menu highlighter
        //for theme color
        const colorPicker1 = document.getElementById('colorPicker1');
        const colorCode1 = document.getElementById('colorCode1');
        // const error = document.getElementById('error');

        // When color is selected via the color picker
        colorPicker1.addEventListener('input', function() {
            colorCode1.value = colorPicker1.value;
            updateMenuPreview();// get preview 
            // clearValidation();  // Clear validation when color is picked
        });

        // When color code is typed into the input field
        // colorCode.addEventListener('input', function() {
        colorCode1.addEventListener('change', function() {
            const code1 = colorCode1.value.trim();
            validateColorCode1(code1);
        });

        // Function to validate the color code
        function validateColorCode1(code1) {
            // Check if the code is a valid hex color code
            if (/^#[0-9A-F]{6}$/i.test(code1)) {
                colorPicker1.value = code1;
                updateMenuPreview();// get preview 
                // clearValidation();
            } else {
                alert("Please set valid color code.");
                colorCode1.value ='';
                colorPicker1.focus();
            }
        }
        
        updateMenuPreview();   // get preview of theme
        
        function updateMenuPreview() {
            const themeColor = document.getElementById('colorCode').value;  //theme color
            const highlightColor = document.getElementById('colorCode1').value; //highlight color

            // Apply theme color to the side menu background
            document.getElementById('menuPreview').style.backgroundColor = themeColor;

            // Get all menu items and apply the highlight color to the active item
            const menuItems = document.querySelectorAll('.menu-item');
            menuItems.forEach(item => {
                item.style.backgroundColor = themeColor;
                item.style.color = getSuitableTextColor(themeColor);
            });

            // Apply the highlight color to the active menu item
            const activeItem = document.querySelector('.active-item');
            activeItem.style.backgroundColor = highlightColor;
            activeItem.style.color = getSuitableTextColor(highlightColor);
        }
        

        function getSuitableTextColor(backgroundColor) {
            const rgb = hexToRgb(backgroundColor);
            const brightness = (rgb.r * 0.299 + rgb.g * 0.587 + rgb.b * 0.114) / 255;

            // If brightness is less than 0.5, use white text; otherwise, use black text
            return brightness < 0.5 ? 'white' : 'black';
        }

        function hexToRgb(hex) {
            const bigint = parseInt(hex.slice(1), 16);
            return {
                r: (bigint >> 16) & 255,
                g: (bigint >> 8) & 255,
                b: bigint & 255
            };
        }

        // Event listeners for the color inputs
        // document.getElementById('themeColor').addEventListener('input', updateMenuPreview);
        // document.getElementById('highlightColor').addEventListener('input', updateMenuPreview);

        // Initial load
        // updateMenuPreview();
        //for color picker code end
        
        // card details code start
        // $("#credit_expiry_date, #credit_expiry_date").on("keyup", function() {
        /*$("#credit_expiry_date").on("keyup", function() {
            var inputValue = $(this).val().replace(/\D/g, ""); // Remove non-digit characters
            var formattedValue = "";
        
            for (var i = 0; i < inputValue.length; i++) {
              if (i === 2 || i === 2) {
                formattedValue += "/" + inputValue[i];
              } else {
                formattedValue += inputValue[i];
              }
            }
        
            $(this).val(formattedValue);
            
            // $(this).val(formattedValue);

            // Validation for MM/YY
            if (formattedValue.length === 5) { // Only validate when full MM/YY is entered
                var parts = formattedValue.split("/");
                var month = parseInt(parts[0], 10);
                var year = parseInt(parts[1], 10);
        
                // Get current month and year
                var currentDate = new Date();
                var currentMonth = currentDate.getMonth() + 1; // Months are 0-based in JS
                var currentYear = currentDate.getFullYear() % 100; // Get last two digits of year
        
                // Check if month and year are valid
                if (month < 1 || month > 12) {
                    alert("Invalid month! Please enter a month between 01 and 12.");
                    $(this).val(""); // Optionally clear the input
                    return;
                }
        
                if (year < currentYear || (year === currentYear && month < currentMonth)) {
                    alert("The expiration date must be greater than or equal to the current date.");
                    $(this).val(""); // Optionally clear the input
                    return;
                }
            }
            
        });
        */
        // for billing address
        $('#bill_address1').click(function(){
            if ($("#bill_address1").prop("checked")) {
            //   alert("Checkbox is checked.");
                document.getElementById("bill_address_section").style.display="none";
                $("#bill_address_section").addClass("d-none");
                document.getElementById("bill_address").value='';
                document.getElementById("bill_city").value='';
                document.getElementById("bill_state").value='';
                document.getElementById("bill_zipCode").value='';
            //   document.getElementById("exampleTextarea1").value="Same as Customer";
            } else {
            //   alert("Checkbox is not checked.");
              document.getElementById("bill_address_section").style.display="";
                $("#bill_address_section").removeClass("d-none");
            }
        });
        // card details code end
        
        // Trigger the function on page load if there’s existing data
            // window.onload = function() {
            //     var creditCardInput = document.getElementById('creditcardnumber');
            //     if (creditCardInput.value) {
            //         validateNumber(creditCardInput);
            //     }
            // };
        
        
        /*function maskCreditCard(input) {
            alert("maskCreditCard called");
            let value = input.value.replace(/\D/g, ''); // Remove any non-digit characters
            if (value.length >= 4) {
                input.value = '**** **** **** ' + value.slice(-4);
            }
            
            alert("input.value:"+input.value);
        }*/
        
        //for credit card number
            $('#creditcardnumber1').on('input', function() {
                let originalValue = $(this).val().replace(/\D/g, ''); // Remove non-digit characters
                // if (originalValue.length > 4) {
                //     // Mask the digits except the last four
                //     $(this).val('*'.repeat(originalValue.length - 4) + originalValue.slice(-4));
                // }
                $('#creditcardnumber').val(originalValue); //original Store unmasked value in hidden field
            });

            $('#creditcardnumber1').on('focus', function() {
                // Show the full number on focus, if needed
                let fullValue = $(this).data('originalValue') || $(this).val().replace(/\D/g, '');
                $(this).val(fullValue);
            });

            $('#creditcardnumber1').on('blur', function() {
                // Mask the number again on blur
                let originalValue = $(this).val().replace(/\D/g, '');
                $(this).data('originalValue', originalValue);
                if (originalValue.length > 4) {
                    $(this).val('*'.repeat(originalValue.length - 4) + originalValue.slice(-4));
                }
            });
            
        //for credit card expiry date
         // Format input as MM/YY on each keyup/input event
            
            $('#credit_expiry_date1').on('input', function() {
                let inputValue = $(this).val().replace(/\D/g, ''); // Remove non-digit characters
                let formattedValue = "";
            
                if (inputValue.length >= 2) {
                    formattedValue = inputValue.substring(0, 2) + '/';
                    if (inputValue.length > 2) {
                        formattedValue += inputValue.substring(2, 4);
                    }
                } else {
                    formattedValue = inputValue;
                }
            
                $(this).val(formattedValue);
                $('#credit_expiry_date').val(formattedValue); //original Store unmasked value in hidden field
                
            });
            
            
            $('#credit_expiry_date1').on('focus', function() {
                // Show the original full value on focus if it's stored
                let originalValue = $(this).data('originalValue');
                if (originalValue) {
                    $(this).val(originalValue);
                }
            }).on('blur', function() {
                let inputValue = $(this).val();
                if (inputValue.length === 5) { // Check if MM/YY format is complete
                    let parts = inputValue.split('/');
                    let month = parseInt(parts[0], 10);
                    let year = parseInt(parts[1], 10);
            
                    let currentDate = new Date();
                    let currentMonth = currentDate.getMonth() + 1; // Months are 0-based in JS
                    let currentYear = parseInt(currentDate.getFullYear().toString().substr(-2)); // Last two digits of year
            
                    // Validate month and year
                    if (month < 1 || month > 12) {
                        alert("Invalid month! Please enter a month between 01 and 12.");
                        $(this).val(""); // Clear the input
                    } else if (year < currentYear || (year === currentYear && month < currentMonth)) {
                        alert("The expiration date must be in the future.");
                        $(this).val(""); // Clear the input
                    } else {
                        // Store the full original value before masking
                        $(this).data('originalValue', inputValue);
                        // Mask the `yy` part
                        $(this).val(inputValue.slice(0, 2) + '/**');
                    }
                } else {
                    // Clear if format is incorrect
                    $(this).val("");
                    alert("Please enter a valid expiration date in MM/YY format.");
                }
            });

        // for credit card cvv
        // For the CVV field
        $('#credit_cvv1').on('input', function() {
            let originalValue = $(this).val().replace(/\D/g, ''); // Remove non-digit characters
            $('#credit_cvv').val(originalValue); // Store unmasked value in hidden field
        });
        
        $('#credit_cvv1').on('focus', function() {
            // Show the full number on focus
            let fullValue = $(this).data('originalValue') || $(this).val().replace(/\D/g, '');
            $(this).val(fullValue);
        });
        
        $('#credit_cvv1').on('blur', function() {
            // Mask all but the last digit
            let originalValue = $(this).val().replace(/\D/g, '');
            $(this).data('originalValue', originalValue); // Store original value for reference
            if (originalValue.length === 3) {
                // $(this).val('**' + originalValue.slice(-1)); // Mask first two digits
                 $(this).val('***');  // Mask all 3 digits
            }
        });

        // for credit card no./ expiry dat/ CVV - Trigger the blur event programmatically if the condition is met
        <?php if ($plan_package_new > 1): ?>
            $('#creditcardnumber1').blur(); // This triggers the blur event manually
            $('#credit_expiry_date1').blur(); // This triggers the blur event manually
            $('#credit_cvv1').blur(); // This triggers the blur event manually
        <?php endif; ?>
        
        // change package related code start
         // upgrade plan related code start
    
        // change package related code end
        
        
        
  </script>

</body>
</html>
