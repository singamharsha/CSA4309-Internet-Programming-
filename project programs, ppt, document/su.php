<?php
$name = filter_input(INPUT_POST, 'name');
$username = filter_input(INPUT_POST, 'username');
$password = filter_input(INPUT_POST, 'password');
$confirm_password = filter_input(INPUT_POST, 'confirm-password');
$bloodgroup = filter_input(INPUT_POST, 'bloodgroup');

if (!empty($username)) 
{
    if (!empty($bloodgroup)) 
{
        if (!empty($password)) 
{
            if (!empty($name)) 
{
                if ($password === $confirm_password) 
                { 
                    $host = "localhost";
                    $dbusername = "root";
                    $dbpassword = "";
                    $dbname = "travel";

                    $conn = new mysqli($host, $dbusername, $dbpassword, $dbname);

                    if ($conn->connect_error) 
                    {
                        die("Connection failed: " . $conn->connect_error);
                    } 
                     else 
                    {
                        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                        $stmt = $conn->prepare("INSERT INTO users1 (name, username, password, bloodgroup) VALUES (?, ?, ?, ?)");
                        $stmt->bind_param("ssss", $name, $username, $hashed_password, $bloodgroup);

                        if ($stmt->execute()) 
                        {
                            echo "New record inserted successfully";
                            header("refresh:3; url=login.html");
                        } 
                        else 
                        {
                            echo "Error: " . $stmt->error;
                        }

                        $stmt->close();
                        $conn->close();
                    }
                } 
                else 
                {
                    echo "Passwords do not match";
                }
            } 
            else 
            {
                echo "Name should not be empty";
            }
        } 
        else 
        {
            echo "Password should not be empty";
        }
    } 
    else 
   {
        echo "Blood group should not be empty";  
    }
} 
else 
{
    echo "Username should not be empty";
}
?>
