<?php


    if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $password_hash = md5($password);

    if (!empty($username)&&!empty($password)) {
        $query = "SELECT id FROM users WHERE username = '{$username}' AND password = '{$password_hash}'";
        if ($query_run = mysqli_query($connection,$query)){
            $query_num_rows = mysqli_num_rows($query_run);
            if ($query_num_rows == 0){
                echo '<div id=\'message\'>Invalid username/password combination.</div>';
            } else if($query_num_rows ==1) {
                    $id = $query_run->fetch_assoc()['id'];
                    $_SESSION['user_id'] = $id;
//                $_SESSION['expire'] = time() + 60;
                redirect_to('/');
//                require $router->redirect($uri);
                }

        }

    } else {
        echo "Please enter a username and password";
    }
}

?>

<link href="public/stylesheets/login.css" media="all" rel="stylesheet" type="text/css" />

<form id="login" action="#" method="POST">

    <div id="login_logo"></div>
    <input type="text" name="username" placeholder="Username" autocomplete="off" required/>
    <input type="password" name="password" placeholder="Password" autocomplete="off" required/>
    <input type="submit" value="LOGIN">

</form>

</body>
</html>