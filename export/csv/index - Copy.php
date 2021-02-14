<?php 
include "config.php";
?>
<!doctype html>
<html>
    <head>
        <title>Makitweb - How to Export MySQL Table data as CSV file in PHP</title>
        <link href="style.css" rel="stylesheet" type="text/css">

    </head>
    <body>
        <div class="container">
           <div class="row">
		   <div class="col-lg-12">
		      <span>
		     <form method='post' action='download.php'>
			<input type="radio" id="csv" name="type" value="csv">
                 <label for="csv">CSV</label><br>
             <input type="radio" id="excel" name="type" value="excel">
             <label for="excel">Excel</label><br>
            <input type='submit' value='Export' name='Export CSV'>
		   </span>
		   <span>
		   </span>
		   </div>
          </div>		      
            <table border='1' style='border-collapse:collapse;'>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Name</th>
                    <th>Gender</th>
                    <th>Email</th>
                </tr>
            <?php 
            $query = "SELECT * FROM users ORDER BY id asc";
            $result = mysqli_query($con,$query);
            $user_arr = array();
            while($row = mysqli_fetch_array($result)){
                $id = $row['id'];
                $uname = $row['username'];
                $name = $row['name'];
                $gender = $row['gender'];
                $email = $row['email'];
                $user_arr[] = array($id,$uname,$name,$gender,$email);
            ?>
                <tr>
                    <td><?php echo $id; ?></td>
                    <td><?php echo $uname; ?></td>
                    <td><?php echo $name; ?></td>
                    <td><?php echo $gender; ?></td>
                    <td><?php echo $email; ?></td>
                </tr>
            <?php
            }
            ?>
            </table>
            <?php 
            $serialize_user_arr = serialize($user_arr);
            ?>
            <textarea name='export_data' style='display: none;'><?php echo $serialize_user_arr; ?></textarea>
            </form>
        </div>
    </body>
</html>

