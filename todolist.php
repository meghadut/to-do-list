<?php
$server="localhost";
$username="root";
$password="";
$database="todolist";

$connection=mysqli_connect($server,$username,$password,$database)
or die("couldnt connect to server");


//creating an todo item
if(isset($_POST['add'])){
    $item=$_POST['item'];
    if(!empty($item)){
        $query="INSERT INTO tolist_table (name) VALUES ('$item')";
        if(mysqli_query($connection,$query)){
            echo '
                  <center>
                   <div class="alert alert-success" role="alert" >
                        task added succesfully  !    
                    </div>
                  </center>  
                ';
        }
    }

}

//marking as done
if(isset($_GET['action'])){
    $itemid=$_GET['item'];
    if($_GET['action']=='done'){
        $set_query="UPDATE tolist_table SET status=1 WHERE id='$itemid' ";
        if(mysqli_query($connection,$set_query)){
            echo '
                <center>
                <div class="alert alert-info" role="alert" >
                        task completed !
                    </div>
                </center>
            ';
        }
    }elseif($_GET['action']=='delete'){
        $delete_query="DELETE FROM tolist_table WHERE id='$itemid'";
        if(mysqli_query($connection,$delete_query)){
            echo '
                <center>
                  <div class="alert alert-danger" role="alert" >
                        task deleted succesfully !
                    </div>
                </center>
            ';
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>todo list</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Major+Mono+Display&family=Roboto+Slab:wght@100..900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <style>
       
         #lol{
            display: flex; 
            align-items: center;
            justify-content: center;

            
        }


* {
  font-family: "Roboto Slab", serif;
  font-optical-sizing: auto;
  font-weight: weight;
  font-style: normal;
  font-size: large;
}
        #so{
            width:600px;
        }
        .hello{
            display: flex;
            gap:10px;
        }
        .done{
            text-decoration:line-through;
        }
        .card-header{
            background-color: rgb(5, 39, 12);
        }
        .card-header p{
            color: white;
        }
        .card-body{
            background-color: rgb(209, 238, 238);
        }
        @media (max-width:650px){
            #so{
                width:100%;
            }

        }
       
    </style>
</head>
<body>
 
    <main>
         <div class="conatiner pt-5" id="lol" >
            <div class="card" id="so">
                <div class="card-header">
                    <p>to-do list</p>
                </div>
                <div class="card-body">
                    
                    <form method="post" action="<?=$_SERVER['PHP_SELF']?>">
                       <div class="hello"><input type="text" class="form-control mt-3 " name="item" placeholder="add a task">
                       
                        <input type="submit" class="btn btn-dark mt-3" name="add" value="+">
                        
                        </div> 
                                   
                        </form>

                        <div class="mt-5 mb-5">
                          
                          <?php
                            $query="SELECT * FROM tolist_table";
                            $result=mysqli_query($connection,$query);
                            if($result->num_rows>0){
                                $i=1;
                              
                                while($row=$result->fetch_assoc()){
                                    $done= $row['status']==1 ? "done" :"";
                                echo '  <div class="row mt-4">
                                        <div class="col-sm-12 col-md-1"><h5>'.$i.'</h5></div>
                                        <div class="col-sm-12 col-md-5"><h5 class="'.$done.'">'.$row["name"].'</h5></div>
                                        <div class="col-sm-12 col-md-6">
                                            <a href="?action=done&&item='.$row['id'].'" class="btn btn-outline-dark">mark as done</a>
                                            <a href="?action=delete&&item='.$row['id'].'" class="btn btn-outline-danger">delete</a>
                                            </div> 
                                            </div>';
                                            $i++;
                                            
                            }
                        }
                            else{
                                echo '  <center>
                                            <img src="./download.png" alt="folder" width="80" ><br><span>the list is empty </span>
                                        </center>';

                            }
                          ?>
                       
                            
                          
                        </div>
                </div>
            </div>
        </div>

    </main>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function(){
            $(".alert").fadeTo(5000,500).slideUp(500,function(){
                $('.alert').slideUp(500);
            })
        })
    </script>
</body>
</html>