<?php
include "config.php";
if($_POST['type'] =='csv'){
    $filename = 'users.csv';
    $export_data = unserialize($_POST['export_data']);
// file creation
    $file = fopen($filename,"w");
    foreach ($export_data as $line){
        fputcsv($file,$line);
    }
    fclose($file);
// download
    header("Content-Description: File Transfer");
    header("Content-Disposition: attachment; filename=".$filename);
    header("Content-Type: application/csv; ");
    readfile($filename);
// deleting file
    unlink($filename);
    exit();
}else{
    $output='';
    $query = "SELECT * FROM users ORDER BY id asc";
    $result = mysqli_query($con,$query);
    if(mysqli_num_rows($result) > 0)
    {
        $output .= '<table border="1" style="border-collapse:collapse;">
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Name</th>
                    <th>Gender</th>
                    <th>Email</th>
                </tr>';
        while($row = mysqli_fetch_array($result)){
            $output .= '<tr>  
                         <td>'.$row["id"].'</td>  
                         <td>'.$row["username"].'</td>  
                         <td>'.$row["name"].'</td>  
                         <td>'.$row["gender"].'</td>  
                         <td>'.$row["email"].'</td>  
                    </tr>';
        }
        $output .= '</table>';
        header('Content-Type: application/xls');
        header('Content-Disposition: attachment; filename=download.xls');
        echo $output;
    }
}


