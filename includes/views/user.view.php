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
//        $roles = user_role($pdo);

        if (isset($_POST['addUser'])) {

            $user_name = strtoupper($_POST['username']);
            $password = strtoupper($_POST['password']);
            $name = strtoupper($_POST['name']);
            $surname = strtoupper($_POST['surname']);
            $role = strtoupper($_POST['role']);

            $safe_password = md5($password);


            $query  = "INSERT INTO users (";
            $query .= "  username, password, name, surname, role";
            $query .= ") VALUES (";
            $query .= "  '{$user_name}', '{$safe_password}', '{$name}', '{$surname}', '{$role}'";
            $query .= ")";
            $result = mysqli_query($connection, $query);

            if ($result) {
                // Success
                redirect_to("user?id=".mysqli_insert_id($connection));
            } else {
                // Failure
                echo 'Failed';
                die("Subject update failed.".mysqli_error($connection));
            }
        }
        if (isset($_POST['editUser'])) {

            $user_name = strtoupper($_POST['username']);
            $password = $_POST['password'];
            $name = strtoupper($_POST['name']);
            $surname = strtoupper($_POST['surname']);
            $role = strtoupper($_POST['role']);
            $post_id = $_POST['id'];
            $safe_password = md5($password);


            $update_query  = "UPDATE users SET ";
            $update_query .= "username = '{$user_name}', ";
            $update_query .= "password = '{$safe_password}', ";
            $update_query .= "name = '{$name}', ";
            $update_query .= "surname = '{$surname}', ";
            $update_query .= "role = '{$role}' ";
            $update_query .= "WHERE id = '{$post_id}' ";
            $update_query .= "LIMIT 1";
            $result = mysqli_query($connection,$update_query);
            if ($result && mysqli_affected_rows($connection) >= 0) {
                // Success
                redirect_to("user?id=".$post_id);
            } else {
                die("Subject update failed.".mysqli_error($connection));

            }
        }

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


