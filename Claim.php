<?php
 // getting the value of post parameter from the form

 $room=$_POST['room'];
    
 // checking the length of input name of the room
if(strlen($room)>20 or strlen($room)<2) 
{
       $message = "Please choose a name between 2 to 20 characters";
        echo '<script language="javascript">';
        echo 'alert("'.$message.'");';
        echo 'window.location="http://localhost/chatroom";';
        echo '</script>';
}


  // checking whether the room name is aplhanumer or not
else if(!ctype_alnum($room)) 
{
        $message = "Please enter the Alpha-Numeric Room Name";
        echo '<script language="javascript">';
        echo 'alert("'.$message.'");';
        echo 'window.location="http://localhost/chatroom";';
        echo '</script>';
}

else 
{
     // connecting to database
        include 'db_connect.php';
}

$sql = "SELECT * FROM 'rooms' WHERE roomname = '$room'";
$result = mysqli_query($conn, #sql);
if($result)
{
        if(mysqul_num_rows($result) > 0)
        {
                $message = "Please choose different room name. This room is already claimed";    
                echo '<script language="javascript">';
                echo 'alert("'.$message.'");';
                echo 'window.location="http://localhost/chatroom";';
                echo '</script>';  
       }

       else
       {
            $sql = "INSERT INTO `rooms` ( `roomname`, `stime`) VALUES ( '$room', current_timestamp());";
            if (mysqli_query($conn, $sql))
           {
            
                $message = "your room is ready and you can chat now.";
                echo '<script language="javascript">';
                echo 'alert("'.$message.'");';
                echo 'window.location="http://localhost/chatroom/rooms.php?roomname=' .$room. '";';
                echo '</script>';  
            }
        }
}


