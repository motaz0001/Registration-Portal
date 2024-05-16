<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <title>REGISTRATION PORTAL</title>
      <link rel="stylesheet type="text/css" href="style.css">
   </head>
   <body class="c">
      <div>
         <img src="images/reg.png" width="400pt" height="200"><br>
         <?php
            $db=mysqli_connect("localhost","root","","registration");
            $queryType=$_POST["queryType"];
            $check=false;
            
            #################add student##################
            if($queryType=="reg_add_std"){
            	
            	$q="select * from loginPassword where student_id='".$_POST["student_id"]."'";
            	$result=mysqli_query($db,$q);
            	if(mysqli_num_rows($result)>0){
            		print("This student already exist.");
            	}
            	else{
            		$id=$_POST['student_id'];
            		$name=$_POST['student_name'];
            		$major=$_POST['student_major'];
            		$password=$_POST['student_password'];
            		$q1="insert into loginPassword (student_id, name, major, password) VALUES ('$id','$name','$major','$password')";
            		if(mysqli_query($db,$q1))
            			print("Added Successfully.");
            		
            	}
            }
            ##################add course#################
            elseif($queryType=="reg_add_crs"){
            	$q="select * from courses where course_id='".$_POST["course_id"]."'";
            	$result=mysqli_query($db,$q);
            	if(mysqli_num_rows($result)>0){
            		print("This course already exist.");
            	}
            	else{
            		$id=$_POST['course_id'];
            		$name=$_POST['course_name'];
            		$credit=$_POST['course_credit'];
            		$q1="insert into courses (course_name, course_id, course_credit) VALUES ('$name','$id','$credit')";
            		if(mysqli_query($db,$q1))
            			print("Added Successfully.");
            		
            	}
            }
            ##################update course#################
            elseif($queryType=="reg_update_crs"){
            	$q="select * from courses where course_id='".$_POST["course_id"]."'";
            	$result=mysqli_query($db,$q);
            	if(mysqli_num_rows($result)<1){
            		print("This course does not exist.");
            	}
            	else{
            		$id=$_POST['course_id'];
            		$name=$_POST['course_new_name'];
            		$credit=$_POST['course_new_credit'];
            		$q1="update courses set course_name='$name',course_credit='$credit' where course_id='$id'";
            		$q2="update student set course_credit='$credit' where course='".$_POST["course_id"]."'";
            		if(mysqli_query($db,$q1) and mysqli_query($db,$q2))
            			print("Updated Successfully.");
            		
            	}
            }
            ##################remove student#################
            elseif($queryType=="reg_rm_std"){
            	$q="select * from loginPassword where student_id='".$_POST["student_id"]."'";
            	$result=mysqli_query($db,$q);
            	if(mysqli_num_rows($result)<1){
            		print("This student does not exist.");
            	}
            	else{
            		$q1="delete from loginPassword where student_id='".$_POST["student_id"]."'";
            		$q2="delete from student where student_id='".$_POST["student_id"]."'";
            	if(mysqli_query($db,$q1) and mysqli_query($db,$q2))
            			print("Removed Successfully.");
            	}
            }
            ##################remove course#################
            elseif($queryType=="reg_rm_crs"){
            	$q="select * from courses where course_id='".$_POST["course_id"]."'";
            	$result=mysqli_query($db,$q);
            	if(mysqli_num_rows($result)<1){
            		print("This course does not exist.");
            	}
            	else{
            		$q1="delete from courses where course_id='".$_POST["course_id"]."'";
            		$q2="delete from student where course='".$_POST["course_id"]."'";
            		if(mysqli_query($db,$q1) and mysqli_query($db,$q2))
            			print("Removed Successfully.");
            	}
            }
            ##################Chanage Password#################
            elseif($queryType=="ch_pass"){
            	$id=$_POST["id"];
            	$password=$_POST["old_pass"];
            	$npassword=$_POST["new_pass"];
            	$q="select * from registers where reg_login='$id' and reg_password='$password'";
            	$result=mysqli_query($db,$q);
            	$info=mysqli_fetch_row($result);
            	if(mysqli_num_rows($result)>0){
            		$q="update registers set reg_password='$npassword' where reg_login='$id'";
            		if(mysqli_query($db,$q)){
            			print("Chanaged Successfully.");
            			$check=true;
            		}
            	}
            	else{
            		print("The Entered Password Incorrect.");
            	}
            }
            mysqli_close($db);
            if($queryType=="ch_pass" and $check )
            	print('<form method="post" action="logout.php">
            	<hr><span><input type="submit" value="Login Again"></span></td></tr><hr>');
            else
            print('
            <form method="post" action="register.php">
            	<hr><span><input type="submit" value="Back"></span></td></tr><hr>
            	<input type="hidden" value="1" name="loged">
            </form>
            
            
            ');
            ?>
      </div>
   </body>
</html>