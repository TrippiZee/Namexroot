<?php

$router->get('','DashboardController@dashboard');
$router->get('customer','CustomerController@allCustomers');
$router->get('manifest','ManifestController@allManifests');
$router->get('waybill','WaybillController@allWaybills');
$router->get('pod','PodController@allPods');
//$router->get('tracking','CustomerController@allCustomers');
$router->get('costing','CustomerController@costingMain');
$router->get('reports','ReportsController@reportDashboard');
$router->get('user','UserController@allUsers');
$router->get('logout','SystemController@logout');
$router->get('print_manifest','ManifestController@printManifest');
$router->get('print_invoice','WaybillController@printInvoice');

$router->get('del_customer','CustomerController@delCustomer');
$router->get('del_manifest','ManifestController@delManifest');
$router->get('del_waybill','WaybillController@delWaybill');
$router->get('del_pod','PodController@delPod');
$router->get('del_user','UserController@delUser');

$router->post('customer','CustomerController@addEditCustomer');
$router->post('manifest','ManifestController@addEditManifest');
$router->post('','ManifestController@addEditManifest');
$router->post('waybill','WaybillController@addEditWaybill');
$router->post('waybillDash','DashboardController@addEditWaybill');
$router->post('pod','PodController@addEditPod');
$router->post('tracking','CustomerController@allCustomers');
$router->post('costing','CustomerController@allCustomers');
$router->post('reports','CustomerController@allCustomers');
$router->post('user','UserController@addEditUser');
$router->post('checkUser','SystemController@checkUser');

$router->get('dashboardManifestWaybills','WaybillController@getManifestWaybillsDashboard');

$router->post('updateLocation','WaybillController@updateLocation');
$router->post('finalise','ManifestController@finalise');

$router->post('ajaxCustomer','CustomerController@filterCustomers');
$router->post('ajaxManifest','ManifestController@filterManifests');
$router->post('ajaxPods','PodController@filterPods');
$router->post('ajaxWaybills','WaybillController@filterWaybills');
$router->post('ajaxUsers','UserController@filterUsers');
