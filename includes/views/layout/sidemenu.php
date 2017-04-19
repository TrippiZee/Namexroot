<?php ?>
<div class="row">
<div id="sidemenu" class="col-sm-1">
<nav class="navbar">
            <ul class="nav navbar-nav">
                <li class="active"><a href="/">Home</a> </li>
                <li><a href="customer">Customer</a> </li>
                <li><a href="manifest">Manifest</a></li>
                <li><a href="waybill">Waybill</a></li>
                <li><a href="pod">POD</a></li>
                <li><a href="tracking">Tracking</a></li>
                <?php
                if (getuserfield('role') == 'ADMIN'){
                    echo '<li><a href="reports">Reports</a></li>';
                    echo '<li><a href="costing">Costing</a></li>';
                    echo '<li><a href="user">User</a></li>';
                }
                ?>
</ul>
</nav>
</div>
<!--</div>-->
