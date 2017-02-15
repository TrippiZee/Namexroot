<?php

?>
<!----------------------------------------------------------USER------------------------------------------------------>
<div id="addUser" class="modal" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add New User</h4>
            </div>
            <div class="modal-body">
                <form action="#" method="post">

                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">Username</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="username" value=" ">
                        </div>
                        <label for="password" class="col-sm-2 col-form-label">Password</label>
                        <div class="col-sm-4">
                            <input type="password" class="form-control" name="password" >
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="name" >
                        </div>
                        <label for="surname" class="col-sm-2 col-form-label">Surname</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="surname" >
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="role" class="col-sm-2 col-form-label">Role</label>
                        <div class="col-sm-4">
<!--                            <input type="text" class="form-control" name="role" >-->
                                <select name="role">
                                    <option selected disabled value="">Select a role</option>
                                    <?php foreach($roles as $key => $value){?>
                                        <option value="<?php echo $value->role;?>"><?php echo $value->role;?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                        </div>
                    </div>
            </div>

            <div class="modal-footer">
                <div class="form-group row">
                    <input type="submit" name="addUser" value="Add" />
                    <input Type="button" VALUE="Cancel" data-dismiss="modal">

                </div>
            </div>
            </form>

        </div>
    </div>
</div>


<div id="editUser" class="modal" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Edit User</h4>
            </div>
            <div class="modal-body">
                <form action="#" method="post">

                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">Username</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="username" value="<?php echo htmlentities($user['username'])?>">
                        </div>
                        <label for="password" class="col-sm-2 col-form-label">Password</label>
                        <div class="col-sm-4">
                            <input type="password" class="form-control" name="password" value="<?php echo htmlentities($user['password'])?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="name" value="<?php echo htmlentities($user['name'])?>">
                        </div>
                        <label for="surname" class="col-sm-2 col-form-label">Surname</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="surname" value="<?php echo htmlentities($user['surname'])?>">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="role" class="col-sm-2 col-form-label">Role</label>
                        <div class="col-sm-4">
                            <select name="role">
                                <option selected disabled value="<?php echo htmlentities($user['role'])?>"><?php echo htmlentities($user['role'])?></option>
                                <?php foreach($roles as $key => $value){?>
                                    <option value="<?php echo $value->role;?>"><?php echo $value->role;?></option>
                                    <?php
                                }
                                ?>
                            </select>
<!--                            <input type="text" class="form-control" name="role" value="--><?php //echo htmlentities($user['role'])?><!--">-->
                            <input type="hidden" class="form-control" id="id" name="id" value="<?php echo htmlentities($user['id'])?>">
                        </div>
                    </div>
            </div>

            <div class="modal-footer">
                <div class="form-group row">
                    <input type="submit" name="editUser" value="Edit" />
                    <input Type="button" VALUE="Cancel" data-dismiss="modal">

                </div>
            </div>
            </form>

        </div>
    </div>
</div>
