<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <title>REGISTRATION PORTAL</title>
      <link rel="stylesheet type="text/css" href="style.css">
   </head>
   <body id="container">
      <div>
         <img src="images/reg.png" width="400pt" height="200pt"><br>
         <?php
            $db=mysqli_connect("localhost","root","","registration");
            if(isset($_POST["loged"]))
            session_start();
            
            if(!isset($_SESSION)){
            	$id=$_POST["id"];
            	$password=$_POST["pass"];
            if($_POST["loginType"]=="std")
            $q="select * from loginPassword where student_id='$id' and password='$password'";
            	elseif($_POST["loginType"]=="reg")
            $q="select * from registers where reg_login='$id' and reg_password='$password'";
            $result=mysqli_query($db,$q);
            	$info=mysqli_fetch_row($result);
            	if(mysqli_num_rows($result)>0){
            session_start();
            $_SESSION["auth"]=true;
            		$_SESSION["id"]=$id;
            		$_SESSION["loginType"]=$_POST["loginType"];
            if($_POST["loginType"]=="std")
            $_SESSION["name"]=explode(" ",$info[1])[0];
            elseif($_POST["loginType"]=="reg")
            $_SESSION["name"]=explode(" ",$info[0])[0];
            
            
            
            }
            	else {
            		print('<b>Id or Password Incorrect. </b><br>
            		
            <form method="post" action="logout.php">
            	<hr><span><input type="submit" value="Back"></span></td></tr><hr>
            </form>
            ');
            	}
            }
            
            if(isset($_SESSION)){
            if(isset($_SESSION["auth"])){
            
			
			
            ##################student##################
			
			
			
            if($_SESSION["loginType"]=="std" AND $_SESSION["auth"]==true)
            {
            print('
            		<b>Welcome '.$_SESSION["name"].' </b>
            		<hr><details>
            		<summary>Registerd Courses</summary>
            			');
		    	$id=$_SESSION["id"];
            		$q1="select * from student where student_id='$id'";
            		$result1=mysqli_query($db,$q1);
            		print('<table class="c" border="1">
            		<tr><th>Course name</th><th>Course id</th><th>Course credit</th></tr>
            		');
            		while($r1=mysqli_fetch_row($result1)){
            			$q2="select * from courses where course_id='".$r1[1]."'";
            			$result2=mysqli_query($db,$q2);
            			    $r2=mysqli_fetch_row($result2);
            				print("<tr>");
            				foreach ($r2 as $v)
            				print("<td>$v</th>");
            				print("</tr>");
            
            		}
            		print('</table>');
            		print('</details><hr>
            		
            		<details>
            		<summary>Add Course</summary>
            			<form method="post" action="std.php">
            				<table>
            					<tr><td>Course id</td>
            						<td><input type="text"  name="course_id" required autocomplete="off"></td></tr>
            					<tr><td colspan="2"><span><input type="submit" value="Add"></span></td></tr>
            					<input type="hidden" value="std_add" name="queryType">
            					<input type="hidden" value='.$_SESSION["id"].' name="id">
            				</table>
            			</form>
            		</details><hr>
            		
            		
            		<details>
            		<summary>Remove Course</summary>
            			<form method="post" action="std.php">
            				<table>
            					<tr><td>Course id</td>
            						<td><input type="text"  name="course_id" required autocomplete="off"></td></tr>
            					<tr><td colspan="2"><span><input type="submit" value="Remove"></span></td></tr>
            					<input type="hidden" value="std_rm" name="queryType">
            					<input type="hidden" value='.$_SESSION["id"].' name="id">
            				</table>
            			</form>
            		</details><hr>
            		
            		<details>
            		<summary>Chanage Password</summary>
            			<form method="post" action="std.php">
            				<table>
            					<tr><td>Currnet Password</td>
            						<td><input type="text"  name="old_pass" required autocomplete="off"></td></tr>
            					<tr><td>New Password</td>
            						<td><input type="text"  name="new_pass" required autocomplete="off"></td></tr>
            					<tr><td colspan="2"><span><input type="submit" value="Chanage"></span></td></tr>
            					<input type="hidden" value="ch_pass" name="queryType">
            					<input type="hidden" value='.$_SESSION["id"].' name="id">
            				</table>
            			</form>
            		</details><hr>
            		
            		<script src="s.js"></script>
            		
            		<form method="post" action="logout.php">
            		<span><input type="submit" value="Logout"></span></td></tr>
            		</form><hr>
            		');
            }
            	
            	
            
            
            
            ##################register#####################
            
            	
            	
            
            elseif($_SESSION["loginType"]=="reg" AND $_SESSION["auth"]==true)
            {
            		print('
            		<b>Welcome '.$_SESSION["name"].' </b>
            		<hr><details class="sf">
            		<summary>Add New Student</summary>
            			<form method="post" action="reg.php">
            				<table>
            					<tr><td>Student id</td>
            						<td><input type="text"  name="student_id" required autocomplete="off"></td></tr>
            					<tr><td>Student Name</td>
            						<td><input type="text"  name="student_name" required autocomplete="off"></td></tr>
            					<tr><td>Student Major</td>
            						<td><input type="text"  name="student_major" required autocomplete="off"></td></tr>
            					<tr><td>Student Password</td>
            						<td><input type="text"  name="student_password" required autocomplete="off"></td></tr>
            					<tr><td colspan="2"><span><input type="submit" value="Add"></span></td></tr>
            					<input type="hidden" value="reg_add_std" name="queryType">
            				</table>
            			</form>
            		</details><hr>
            		
            		<details class="sf">
            		<summary>Add New Course</summary>
            			<form method="post" action="reg.php">
            				<table>
            					<tr><td>Course id</td>
            						<td><input type="text"  name="course_id" required autocomplete="off"></td></tr>
            					<tr><td>Course Name</td>
            						<td><input type="text"  name="course_name" required autocomplete="off"></td></tr>
            					<tr><td>Course Credit</td>
            						<td><input type="number" min="1" value="3" name="course_credit" required autocomplete="off"></td></tr>
            					<tr><td colspan="2"><span><input type="submit" value="Add"></span></td></tr>
            					<input type="hidden" value="reg_add_crs" name="queryType">
            				</table>
            			</form>
            		</details><hr>
            		
            		<details class="sf">
            		<summary>Update Course</summary>
            			<form method="post" action="reg.php">
            				<table>
            					<tr><td>Course id</td>
            						<td><input type="text"  name="course_id" required autocomplete="off"></td></tr>
            					<tr><td>New Name</td>
            						<td><input type="text"  name="course_new_name" required autocomplete="off"></td></tr>
            					<tr><td>New Credit</td>
            						<td><input type="number" min="1" name="course_new_credit" required autocomplete="off"></td></tr>
            					<tr><td colspan="2"><span><input type="submit" value="Update"></span></td></tr>
            					<input type="hidden" value="reg_update_crs" name="queryType">
            				</table>
            			</form>
            		</details><hr>
            		
            		<details>
            		<summary>Remove Student</summary>
            			<form method="post" action="reg.php">
            				<table>
            					<tr><td>Student id</td>
            						<td><input type="text"  name="student_id" required autocomplete="off"></td></tr>
            					<tr><td colspan="2"><span><input type="submit" value="Remove"></span></td></tr>
            					<input type="hidden" value="reg_rm_std" name="queryType">
            				</table>
            			</form>
            		</details><hr>
            		
            		<details>
            		<summary>Remove Course</summary>
            			<form method="post" action="reg.php">
            				<table>
            					<tr><td>Course id</td>
            						<td><input type="text"  name="course_id" required autocomplete="off"></td></tr>
            					<tr><td colspan="2"><span><input type="submit" value="Remove"></span></td></tr>
            					<input type="hidden" value="reg_rm_crs" name="queryType">
            				</table>
            			</form>
            		</details><hr>
            		
            		<details>
            		<summary>Chanage Password</summary>
            			<form method="post" action="reg.php">
            				<table>
            					<tr><td>Currnet Password</td>
            						<td><input type="text"  name="old_pass" required autocomplete="off"></td></tr>
            					<tr><td>New Password</td>
            						<td><input type="text"  name="new_pass" required autocomplete="off"></td></tr>
            					<tr><td colspan="2"><span><input type="submit" value="Chanage"></span></td></tr>
            					<input type="hidden" value="ch_pass" name="queryType">
            					<input type="hidden" value='.$_SESSION["id"].' name="id">
            				</table>
            			</form>
            		</details><hr>
            		
            		<script src="s.js"></script>
            		
            		<form method="post" action="logout.php">
            		<span><input type="submit" value="Logout"></span></td></tr>
            		</form><hr>
            
            		');
            }
            }
            else{
            print('
            <form method="post" action="register.html">
            	<hr><span><input type="submit" value="Back"></span></td></tr><hr>
            </form>
            
            
            ');
            }
            }
            mysqli_close($db);
            ?>
      </div>
   </body>
</html>
