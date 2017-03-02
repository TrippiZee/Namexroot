<?php
namespace Includes\Controllers;

use Includes\App;
use Includes\Models\Reports;

class ReportsController{

    public function reportDashboard(){
        return view('reports');
    }

}
