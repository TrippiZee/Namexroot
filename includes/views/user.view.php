<?php
include "layout/header.php";

?>
<div class="col-sm-11 main">
    <div class="row">
        <div class="col-sm-3">
            <br>
            <button data-toggle="modal" data-target="#addUser" class="btn btn-success col-xs-12 btn-narrow">Add New User</button>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-sm-12">

        <?php
        $id = '';
        if (isset($_GET['id'])){
            $id=$_GET['id'];

            $query_result = user($id);
            $user = mysqli_fetch_array($query_result);

            echo '<h2>Details:</h2>';
            echo '<table class="table dataTable default">';
            echo "<tr><th>Username</th><th>Name</th><th>Surname</th><th>Role</th></tr>";
            echo '<tr><td>'. $user['username']. '</td>';
//            echo '<td>'.$user['password'].'</td>';
            echo '<td>'.$user['name'].'</td>';
            echo '<td>'.$user['surname'].'</td>';
            echo '<td>'.$user['role'].'</td></tr>';
            echo '<tr><td class="edit"><button data-toggle="modal" data-target="#editUser" class="btn btn-success col-xs-12 btn-narrow">Edit User</button></td>';
//            echo '<tr><td class="edit"><a href="../../edit_user.php?id=' .$user['id'].'"><input type="button" value="Edit"/></a></td>';
                echo '<td class="edit"><a href="del_user?id=' .$user['id'].'" onclick="return confirm(\'Really Delete?\');"><input type="button" class="btn btn-success col-xs-12 btn-narrow" value="Delete"/></a></td>';
            echo "</tr>";
            echo "</table>";
        }
        else {

            echo '<h2>All Users:</h2>';
            echo '<table class="table table-striped dataTable users">
                    <thead>
                    <tr><th>Username</th><th>Name</th><th>Surname</th><th>Role</th></tr>
                    </thead></table>';

//            $users = getAllUsers($pdo);
//            echo '<h2>All Users:</h2>';
//            echo '<table class="table table-striped dataTable default">
//                    <thead>
//                    <tr><th>Username</th><th>Name</th><th>Surname</th><th>Role</th></tr>
//                    </thead>
//                    <tbody>';
//            foreach($users as $user) {
//                echo '<tr><td class="edit"><a href="user?id='.$user->id.'">' . $user->username . '</a></td>';
////                echo '<td>'.$user->password.'</td>';
//                echo '<td>'.$user->name.'</td>';
//                echo '<td>'.$user->surname.'</td>';
//                echo '<td>'.$user->role.'</td></tr>';
//            }
//            echo '</tbody></table>';
        }

        require 'modals/user.modal.php';
        ?>

    </div>
</div>
</div>
<?php
include "layout/footer.php";
?>


