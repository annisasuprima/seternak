<?php
    session_start();
    require('function-user.php');
    $obj = new Db_Class();

    $users = $obj->getUsers();
    if(isset($_POST['update'])){
        $user = $obj->getUserById();
        $_SESSION['user'] = pg_fetch_object($user);
        header('location:update-user.php');
    }
    if(isset($_POST['delete'])){
       $ret_val = $obj->deleteuser();
       if($ret_val==1){
           
          echo "<script language='javascript'>";
          echo "alert('Record Deleted Successfully'){
              window.location.reload();
          }";
          echo "</script>";
      }
    }
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <!-- Add icon library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <title>Tambah User</title>
  </head>
  <body>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
    
    <?php
    include('layout/admin-navbar.php');
    ?>
    
    <div class="container"style="padding-top:100px;padding-bottom:5%;"> 
        <div class="card text-center">
            <div class="card-header">
                <ul class="nav nav-tabs card-header-tabs">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="true" href="read-user.php">User</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="read-partner.php">Partner</a>
                </li>
                </ul>
            </div>
            <div class="card-body">
                <!-- <h5 class="card-title">Ini User</h5> -->
                <a class="btn btn-success" style="float:right;margin-bottom:2%;" href="create-user.php" ><i class="fa fa-plus"></i> Tambah</a>

                <table class="table table-hover" >
                    <thead>
                        <tr>
                            <th class="table-light">Name</th>
                            <th class="table-light">Email</th>
                            <th class="table-light">Role</th>
                            <th class="table-light">City</th>
                            <th class="table-light">Action</th>
                        </tr>
                    </thead>
                                       
                    <tbody>
                        <?php while($user = pg_fetch_object($users)): ?>
                        <tr align="center">
                            <td><?=$user->username?></td>
                            <td><?=$user->email?></td>
                            <td>
                            <?php
                                    $role = $user->role;
                                    if($role == 1){
                                        echo'User';
                                    }else{
                                        echo'Partner';
                                    }
                                ?>
                            </td>

                            <td><?=$user->kota?></td>
                            <td>
                            <form method="post">
                                <input type="submit" class="btn btn-success" name= "update" value="Update">   
                                <input type="submit" onClick="return confirm('Please confirm deletion');" class="btn btn-danger" name= "delete" value="Delete">
                                <input type="hidden" value="<?=$user->username?>" name="id">
                            </form>
                            </td>
                        </tr>
                        <?php endwhile; ?>   
                    </tbody>
                
                </table>

            </div>
        </div>
    </div> 


    <?php
    include('layout/admin-footer.php');
    ?>
</html>