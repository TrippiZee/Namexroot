<?php
//include "modals.php";
?>
<!--<script src="scripts/jquery-3.1.1.min.js"></script>-->
<script src="public/scripts/jquery.min.js"></script>
<script src="public/scripts/bootstrap.min.js"></script>
<script src="public/scripts/dataTables.bootstrap.min.js"></script>
<script src="public/scripts/jquery.dataTables.min.js"></script>
<script src="public/scripts/dataTables.editor.min.js"></script>
<script src="public/scripts/jquery-ui-1.12.1/jquery-ui.min.js"></script>
<script src="public/scripts/jquery-ui-timepicker-addon.js"></script>
<script src="public/scripts/functions.js"></script>

<script type="text/javascript">
    $(document).ready(function(){
        $('table.default').dataTable({
            bStateSave: true,
            stateSave:true,
            sPaginationType: "full_numbers"
        });

    });
</script>
</div>
</div>

</body>
</html>
