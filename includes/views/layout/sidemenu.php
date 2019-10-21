<?php ?>
<div class="row">
<div id="sidemenu" class="col-sm-1">
<nav class="navbar">
            <ul class="nav navbar-nav">
                <li class="active"><a href="/"><i class="glyphicon glyphicon-home"></i>Home</a> </li>
                <li><a href="customer"><i class="glyphicon glyphicon-thumbs-up"></i>Customer</a> </li>
                <li><a href="manifest"><i class="glyphicon glyphicon-list-alt"></i>Manifest</a></li>
                <li><a href="waybill"><i class="glyphicon glyphicon-file"></i>Waybill</a></li>
                <li><a href="pod"><i class="glyphicon glyphicon-road"></i>POD</a></li>
<!--                <li><a href="tracking">Tracking</a></li>-->
                <?php
                if (getuserfield('role') == 'ADMIN'){
                    echo '<li><a href="reports"><i class="glyphicon glyphicon-print"></i>Reports</a></li>';
                   // echo '<li><a href="costing"><i class="glyphicon glyphicon-usd"></i>Rates</a></li>';
                    echo '<li><a href="user"><i class="glyphicon glyphicon-user"></i>User</a></li>';
                }
                ?>
</ul>
</nav>
</div>
<!--</div>-->
