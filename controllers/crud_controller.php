<?php

    $call = $_POST['call'];
    $call();
  
    $con = new mysqli("localhost", "root", "", "ajax_crud");

    // $hostname = 'localhost';
    // $username = 'root';
    // $password = '';
    // $dbname = 'ajax_crud';

    // $con = mysqli_connect('$hostname','$username','$password','$dbname');

    // data insert method here 
    function insert(){
        $name = $_POST['name'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $status = $_POST['status'];
       

        if($name === ""){
            echo '
            <div class="alert alert-info" role="alert">
                <strong>Name Field Is Required</strong> 
            </div>
            ';
        }
        if($phone === ""){
            echo '
            <div class="alert alert-info" role="alert">
                <strong>Phone Field Is Required</strong> 
            </div>
            ';
        }
        
        if($status === ""){
            echo '
            <div class="alert alert-info" role="alert">
                <strong>Status Field Is Required</strong> 
            </div>
            ';
        }
        if($email === ""){
            echo '
            <div class="alert alert-info" role="alert">
                <strong>Email Field Is Required</strong> 
            </div>
            ';
        }
        else{
            $con = new mysqli("localhost", "root", "", "ajax_crud");
            $sql = "INSERT INTO students(name,phone,email,status)VALUES('$name', '$phone', '$email', '$status')";
            $insert = $con->query($sql);
            // $insert = mysqli_query( $con, $sql );
            // $insert = mysqli_query($db_connect, "INSERT INTO `students`(`name`, `phone`, `email`, `status`) VALUES ('$name','$phone','$email','$status')");

            if($insert){
                    echo '  <div class="alert alert-info" role="alert">
                                <strong>Student Register Successfully</strong> 
                            </div>
                        ';
            }else{
                echo '  <div class="alert alert-info" role="alert">
                                <strong>Something Is Wrong</strong> 
                            </div>
                        ';
            }
        }
        

    };

    // data show method here 
    function show(){
        $con = new mysqli("localhost", "root", "", "ajax_crud");
        $sql = "SELECT * FROM `students`";
        $allData = $con->query($sql);
        
        if($allData){
           while ($singleData = $allData->fetch_assoc()) {
                if($singleData['status'] == 1){
                    $status = '<button type="Submit" value= "'.$singleData['id'].'" class="inactive btn btn-dark btn-sm" id="statusBtn" name = "statusBtn" >Inactive</button>';
                }else{
                    $status = '<button type="Submit" class="btn btn-dark btn-sm" id="statusBtn" name = "statusBtn" >Active</button>';

                }

            echo '
                    <tr class="table-primary" >    
                        <td>'.$singleData['id'].'</td>
                        <td>'.$singleData['name'].'</td>
                        <td>'.$singleData['phone'].'</td>
                        <td>'.$singleData['email'].'</td>
                        <td>'.$status.'</td>
                        <td>
                            <button type="Submit" class="btn btn-info btn-sm edit"><i class="fa fa-edit"></i></button>
                            <button type="Submit" class="btn btn-danger btn-sm delete"><i class="fa fa-trash"></i></button>
                        </td>
                    </tr>
                ';
           }
        }else{
            echo '
                <tr>
                    <td colspan="6" class="bg-white text-danger text-center">No Data To Show</td>
                </tr>
            ';
        }


    };
?>