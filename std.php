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
            $id=$_POST["id"];
            $db=mysqli_connect("localhost","root","","registration");
            $queryType=$_POST["queryType"];
            $check=false;
            
            
            #################add course##################
            if($queryType=="std_add"){
            	$crs=$_POST["course_id"];
            	$q1="select SUM(course_credit) from student where student_id='$id'";
            	$q2="select * from courses where course_id='$crs'";
            	$result1=mysqli_query($db,$q1);
            	$result2=mysqli_query($db,$q2);
            	$info1=mysqli_fetch_row($result1);
            	$info2=mysqli_fetch_row($result2);
            	$q3="select course from student where course='$crs' and student_id='$id'";
            	$result3=mysqli_query($db,$q3);
                if(mysqli_num_rows($result2)<1){
            		print("This course does not exist.");
            	}
            	elseif(mysqli_num_rows($result3)>0){
            		print("You are already registered in this course.");
            	}
            	elseif($info1[0]+$info2[2]>18){
            		print("The maximum limit for register credit is 18.<br> your register credit are ".$info1[0]).".";
            	}
            	else{
            		$q="insert into student (student_id, course, course_credit) VALUES ($id, $crs,". $info2[2]." )";
            		if(mysqli_query($db,$q))
            			print("Added Successfully.");
            		
            	}
            }
            ##################remove course#################
            elseif($queryType=="std_rm"){
            	$crs=$_POST["course_id"];
            	$q1="select * from student where course='$crs' And student_id='$id'";
            	$result1=mysqli_query($db,$q1);
            	if(mysqli_num_rows($result1)<1){
            		print("You are not registered in this course.");
            	}
            	else{
            		$q="delete from student where course='$crs' And student_id='$id'";
            		if(mysqli_query($db,$q))
            			print("Removed Successfully.");
            	}
            }
            ##################Chanage Password#################
            elseif($queryType=="ch_pass"){
            	$id=$_POST["id"];
            	$password=$_POST["old_pass"];
            	$npassword=$_POST["new_pass"];
            	$q="select * from loginPassword where student_id='$id' and password='$password'";
            	$result=mysqli_query($db,$q);
            	$info=mysqli_fetch_row($result);
            	if(mysqli_num_rows($result)>0){
            		$q="update loginPassword set password='$npassword' where student_id='$id'";
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