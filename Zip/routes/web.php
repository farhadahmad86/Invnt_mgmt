<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    // return view('auth.login');
    return redirect('login');
});

Route::get('/thermal', function () {
    return view('thermal_printing');
});

//Route::get('/register', function () {
//
//    // return view('auth.login');
//    return redirect('login');
//});

//Route::get('/', function () {
//////    $snappy = App::make('snappy.pdf');
//////    $pdf = App::make('snappy.pdf.wrapper');
//////    $pdf->loadHTML('<h1>Test</h1>');
//////    return $pdf->inline();
////
////
////    $items = DB::table('purchase_invoice_items')
////        ->leftJoin('parts', 'parts.par_id','=', 'purchase_invoice_items.pii_part_name')
//////            ->where('pii_pi_id', $id)
////        ->get();
////
////
////
////    $pdf = PDF::loadView('modal_views.purchase_invoice_modal',compact('items'));
//////    $pdf = PDF::loadView('modal_views.purchase_invoice_modal');
//////    $pdf = PDF::loadView('pdf.invoice');
////
////    return $pdf->stream();
//////    return $pdf->download('invoice.pdf');
//
//    return view('welcome');
//});

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    //Route::group(['middleware' => ['admin']], function (){
    Route::get('/admin_home', [App\Http\Controllers\HomeController::class, 'admin_dashboard'])->name('admin_dashboard');
    Route::get('/time_report', [App\Http\Controllers\ReportsController::class, 'index'])->name('technician_job_info_report');
    Route::get('/warranty_vendor_report', [App\Http\Controllers\ReportsController::class, 'warranty_vendor_report'])->name('warranty_vendor_report');
    Route::get('/Job_Info_Job_Issue_Parts_Items_Report', [App\Http\Controllers\PartsIssueToJobItemsJobInfoReport::class, 'index'])->name('Job_Info_Job_Issue_Parts_Items_Report');
    Route::get('/Profit_Report', [App\Http\Controllers\ProfitReportController::class, 'index'])->name('Profit_Report');
    Route::get('/technician_lab_report', [App\Http\Controllers\LabTechnicianReportController::class, 'index'])->name('technician_lab_report');

    ////////////////////////////////////////////  Category Routes //////////////////////////////////////////////////////////
    Route::get('/edit_category/{id}', [App\Http\Controllers\CategoryController::class, 'edit_category'])->name('edit_category');
    Route::post('/update_category/{id}', [App\Http\Controllers\CategoryController::class, 'update_category'])->name('update_category');
    //Route::get('/delete_category/{id}', [App\Http\Controllers\CategoryController::class, 'delete_category'])->name('delete_category');

    ////////////////////////////////////////////  Brand Routes //////////////////////////////////////////////////////////
    Route::get('/edit_brand/{id}', [App\Http\Controllers\BrandController::class, 'edit_brand'])->name('edit_brand');
    Route::post('/update_brand/{id}', [App\Http\Controllers\BrandController::class, 'update_brand'])->name('update_brand');
    //Route::get('/delete_brand/{id}', [App\Http\Controllers\BrandController::class, 'delete_brand'])->name('delete_brand');

    ////////////////////////////////////////////  Technician Routes //////////////////////////////////////////////////////////
    Route::get('/add_technician', [App\Http\Controllers\TechnicianController::class, 'add_technician'])->name('add_technician');
    Route::post('/store_technician', [App\Http\Controllers\TechnicianController::class, 'store_technician'])->name('store_technician');
    Route::get('/technician_list', [App\Http\Controllers\TechnicianController::class, 'technician_list'])->name('technician_list');
    Route::get('/edit_technician/{id}', [App\Http\Controllers\TechnicianController::class, 'edit_technician'])->name('edit_technician');
    Route::post('/update_technician/{id}', [App\Http\Controllers\TechnicianController::class, 'update_technician'])->name('update_technician');

    ////////////////////////////////////////////  Job Hold Reason Routes //////////////////////////////////////////////////////////
    Route::get('/edit_job_hold_reason/{id}', [App\Http\Controllers\JobHoldReasonController::class, 'edit_job_hold_reason'])->name('edit_job_hold_reason');
    Route::post('/update_job_hold_reason/{id}', [App\Http\Controllers\JobHoldReasonController::class, 'update_job_hold_reason'])->name('update_job_hold_reason');

    ////////////////////////////////////////////  ModelController Routes //////////////////////////////////////////////////////////
    Route::get('/edit_model/{id}', [App\Http\Controllers\ModelController::class, 'edit_model'])->name('edit_model');
    Route::post('/update_model/{id}', [App\Http\Controllers\ModelController::class, 'update_model'])->name('update_model');

    ///////////////////////////////////////////  Edit Client Routes //////////////////////////////////////////////////////////
    Route::resource('/edit_client', App\Http\Controllers\EditClientController::class);

    ///////////////////////////////////////////  CashAccountController Routes //////////////////////////////////////////////////////////
    Route::resource('/cash_account', App\Http\Controllers\CashAccountController::class);

    ///////////////////////////////////////////  Employee Registration Routes //////////////////////////////////////////////////////////
    Route::resource('/employee_registration', App\Http\Controllers\EmployeeRegistrationController::class);

    ///////////////////////////////////////////  PartRegistrationController Routes //////////////////////////////////////////////////////////
    Route::resource('/part_registration', App\Http\Controllers\PartRegistrationController::class);

    ///////////////////////////////////////////  Role Routes //////////////////////////////////////////////////////////
    Route::resource('/roles', App\Http\Controllers\RoleController::class);

    ////////////////////////////////////////////  Vendor Routes //////////////////////////////////////////////////////////
    Route::get('/add_vendor', [App\Http\Controllers\VendorController::class, 'add_vendor'])->name('add_vendor');
    Route::post('/store_vendor', [App\Http\Controllers\VendorController::class, 'store_vendor'])->name('store_vendor');
    Route::get('/vendor_list', [App\Http\Controllers\VendorController::class, 'vendor_list'])->name('vendor_list');
    Route::get('/edit_vendor/{id}', [App\Http\Controllers\VendorController::class, 'edit_vendor'])->name('edit_vendor');
    Route::post('/update_vendor/{id}', [App\Http\Controllers\VendorController::class, 'update_vendor'])->name('update_vendor');

    //});

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    ////////////////////////////////////////////  Category Routes //////////////////////////////////////////////////////////
    Route::get('/add_category', [App\Http\Controllers\CategoryController::class, 'add_category'])->name('add_category');
    Route::post('/store_category', [App\Http\Controllers\CategoryController::class, 'store_category'])->name('store_category');
    Route::get('/category_list', [App\Http\Controllers\CategoryController::class, 'category_list'])->name('category_list');

    ////////////////////////////////////////////  Brand Routes //////////////////////////////////////////////////////////
    Route::get('/add_brand', [App\Http\Controllers\BrandController::class, 'add_brand'])->name('add_brand');
    Route::post('/store_brand', [App\Http\Controllers\BrandController::class, 'store_brand'])->name('store_brand');
    Route::get('/brand_list', [App\Http\Controllers\BrandController::class, 'brand_list'])->name('brand_list');

    ////////////////////////////////////////////  Party Routes //////////////////////////////////////////////////////////
    Route::get('/add_party', [App\Http\Controllers\PartyController::class, 'add_party'])->name('add_party');
    Route::post('/store_party', [App\Http\Controllers\PartyController::class, 'store_party'])->name('store_party');
    Route::get('/party_list', [App\Http\Controllers\PartyController::class, 'party_list'])->name('party_list');
    Route::get('/edit_party/{id}', [App\Http\Controllers\PartyController::class, 'edit_party'])->name('edit_party');
    Route::post('/update_party/{id}', [App\Http\Controllers\PartyController::class, 'update_party'])->name('update_party');

    ////////////////////////////////////////////  Job Hold Reason Routes //////////////////////////////////////////////////////////
    Route::get('/add_job_hold_reason', [App\Http\Controllers\JobHoldReasonController::class, 'add_job_hold_reason'])->name('add_job_hold_reason');
    Route::post('/store_job_hold_reason', [App\Http\Controllers\JobHoldReasonController::class, 'store_job_hold_reason'])->name('store_job_hold_reason');
    Route::get('/job_hold_reason_list', [App\Http\Controllers\JobHoldReasonController::class, 'job_hold_reason_list'])->name('job_hold_reason_list');

    //////////////////////////////////////////////  Job Close ReasonController Routes //////////////////////////////////////////////////////////
    //Route::get('/job_close_reason', [App\Http\Controllers\JobCloseReasonController::class, 'job_close_reason'])->name('job_close_reason');
    //Route::post('/store_job_close_reason', [App\Http\Controllers\JobCloseReasonController::class, 'store_job_close_reason'])->name('store_job_close_reason');
    //Route::get('/job_close_reason_list', [App\Http\Controllers\JobCloseReasonController::class, 'job_close_reason_list'])->name('job_close_reason_list');

    ////////////////////////////////////////////  ModelController Routes //////////////////////////////////////////////////////////
    Route::get('/add_model', [App\Http\Controllers\ModelController::class, 'add_model'])->name('add_model');
    Route::post('/store_model', [App\Http\Controllers\ModelController::class, 'store_model'])->name('store_model');
    Route::get('/model_list', [App\Http\Controllers\ModelController::class, 'model_list'])->name('model_list');

    ////////////////////////////////////////////  CreditSaleController Routes //////////////////////////////////////////////////////////
    Route::get('/add_credit_sale/{id}', [App\Http\Controllers\CreditSaleController::class, 'add_credit_sale'])->name('add_credit_sale');
    Route::post('/store_credit_sale', [App\Http\Controllers\CreditSaleController::class, 'store_credit_sale'])->name('store_credit_sale');
    Route::get('/credit_sale_list', [App\Http\Controllers\CreditSaleController::class, 'credit_sale_list'])->name('credit_sale_list');

    Route::get('/credit_sale_modal_view_details', [App\Http\Controllers\CreditSaleController::class, 'credit_sale_modal_view_details'])->name('credit_sale_modal_view_details');
    Route::get('/credit_sale_modal_view_details/view/{id}', [App\Http\Controllers\CreditSaleController::class, 'credit_sale_modal_view_details_SH'])->name('credit_sale_modal_view_details_sh');
    Route::get('/credit_sale_modal_view_details/view/pdf/{id}/{array?}/{str?}', [App\Http\Controllers\CreditSaleController::class, 'credit_sale_modal_view_details_pdf_SH'])->name('credit_sale_modal_view_details_pdf_sh');

    ////////////////////////////////////////////  CreditPurchaseController Routes //////////////////////////////////////////////////////////
    Route::get('/add_credit_purchase/{id}', [App\Http\Controllers\CreditPurchaseController::class, 'add_credit_purchase'])->name('add_credit_purchase');
    Route::post('/store_credit_purchase', [App\Http\Controllers\CreditPurchaseController::class, 'store_credit_purchase'])->name('store_credit_purchase');
    Route::get('/credit_purchase_list', [App\Http\Controllers\CreditPurchaseController::class, 'credit_purchase_list'])->name('credit_purchase_list');

    Route::get('/credit_purchase_modal_view_details', [App\Http\Controllers\CreditPurchaseController::class, 'credit_purchase_modal_view_details'])->name('credit_purchase_modal_view_details');
    Route::get('/credit_purchase_modal_view_details/view/{id}', [App\Http\Controllers\CreditPurchaseController::class, 'credit_purchase_modal_view_details_SH'])->name('credit_purchase_modal_view_details_sh');
    Route::get('/credit_purchase_modal_view_details/view/pdf/{id}/{array?}/{str?}', [App\Http\Controllers\CreditPurchaseController::class, 'credit_purchase_modal_view_details_pdf_SH'])->name('credit_purchase_modal_view_details_pdf_sh');

    ////////////////////////////////////////////  JobCloseController Routes //////////////////////////////////////////////////////////
    //Route::get('/add_job_close', [App\Http\Controllers\JobCloseController::class, 'add_job_close'])->name('add_job_close');
    //Route::post('/store_job_close', [App\Http\Controllers\JobCloseController::class, 'store_job_close'])->name('store_job_close');
    //Route::get('/job_close_list', [App\Http\Controllers\JobCloseController::class, 'job_close_list'])->name('job_close_list');

    ///////////////////////////////////////////  JobIssueToTechnicianController Routes //////////////////////////////////////////////////////////
    Route::resource('/job_issue_to_technician', App\Http\Controllers\JobIssueToTechnicianController::class);

    ///////////////////////////////////////////  JobHoldController Routes //////////////////////////////////////////////////////////
    Route::resource('/job_hold', App\Http\Controllers\JobHoldController::class);
//    Route::get('/job_hold_status/{id}', [App\Http\Controllers\JobTrackController::class, 'job_hold_status'])->name('job_hold_status');

    ///////////////////////////////////////////  JobReOpenController Routes //////////////////////////////////////////////////////////
    Route::resource('/job_re_open', App\Http\Controllers\JobReOpenController::class);

    ///////////////////////////////////////////  ProductLossController Routes //////////////////////////////////////////////////////////
    Route::resource('/product_loss', App\Http\Controllers\ProductLossController::class);

    ///////////////////////////////////////////  ProductRecoverController Routes //////////////////////////////////////////////////////////

    Route::resource('/product_recover', App\Http\Controllers\ProductRecoverController::class);

    ///////////////////////////////////////////  JobTransferController Routes //////////////////////////////////////////////////////////
    Route::resource('/job_transfer', App\Http\Controllers\JobTransferController::class);

    ///////////////////////////////////////////  EstimateVersionsController Routes //////////////////////////////////////////////////////////
    Route::resource('/estimate_versions', App\Http\Controllers\EstimateVersionsController::class);

    ///////////////////////////////////////////  CashReceiptVoucherController Routes //////////////////////////////////////////////////////////
    Route::resource('/cash_receipt_voucher', App\Http\Controllers\CashReceiptVoucherController::class);

    ///////////////////////////////////////////  CashPaymentVoucherController Routes //////////////////////////////////////////////////////////
    Route::resource('/cash_payment_voucher', App\Http\Controllers\CashPaymentVoucherController::class);

    ///////////////////////////////////////////  OpeningStockController Routes //////////////////////////////////////////////////////////
    Route::resource('/opening_stock', App\Http\Controllers\OpeningStockController::class);

    ///////////////////////////////////////////  IssuePartsToJobController Routes //////////////////////////////////////////////////////////
    Route::resource('/issue_parts_to_job', App\Http\Controllers\IssuePartsToJobController::class);

    ///////////////////////////////////////////  JobPartsReturnController Routes //////////////////////////////////////////////////////////
    Route::resource('/job_parts_return', App\Http\Controllers\JobPartsReturnController::class);

    ///////////////////////////////////////////  SaleInvoiceController Routes //////////////////////////////////////////////////////////
    Route::resource('/sale_invoice', App\Http\Controllers\SaleInvoiceController::class);

    ///////////////////////////////////////////  PurchaseInvoiceController Routes //////////////////////////////////////////////////////////
    Route::resource('/purchase_invoice', App\Http\Controllers\PurchaseInvoiceController::class);

    ///////////////////////////////////////////  \App\Http\Controllers\SaleInvoiceForJobsController Routes //////////////////////////////////////////////////////////
    Route::resource('/sale_invoice_for_jobs', App\Http\Controllers\SaleInvoiceForJobsController::class);

    //new list

    Route::get('/add_job_info_list', [App\Http\Controllers\JobInfoListController::class, 'add_job_info_list'])->name('add_job_info_list');
    // farhad
    Route::get('/track_job', [App\Http\Controllers\JobTrackController::class, 'track_job'])->name('track_job');
    Route::get('/track_job_find', [App\Http\Controllers\JobTrackController::class, 'track_job_find'])->name('track_job_find');
    Route::get('/job_assign_to_technician_edit/{id}', [App\Http\Controllers\JobTrackController::class, 'job_assign_to_technician_edit'])->name('job_assign_to_technician_edit');
    Route::get('/job_hold_status/{id}', [App\Http\Controllers\JobTrackController::class, 'job_hold_status'])->name('job_hold_status');
    Route::get('/job_transfer_edit/{id}', [App\Http\Controllers\JobTrackController::class, 'job_transfer_edit'])->name('job_transfer_edit');
    Route::get('/job_hold_edit/{id}', [App\Http\Controllers\JobTrackController::class, 'job_hold_edit'])->name('job_hold_edit');
    Route::get('/job_reopen_edit/{id}', [App\Http\Controllers\JobTrackController::class, 'job_reopen_edit'])->name('job_reopen_edit');
    Route::get('/job_close_edit/{id}', [App\Http\Controllers\JobTrackController::class, 'job_close_edit'])->name('job_close_edit');
    Route::get('/job_invoice_edit/{id}', [App\Http\Controllers\JobTrackController::class, 'job_invoice_edit'])->name('job_invoice_edit');
    Route::get('/job_delivery_edits/{id}', [App\Http\Controllers\JobTrackController::class, 'job_delivery_edit'])->name('job_delivery_edits');
    Route::get('/job_part_issue_edit/{id}', [App\Http\Controllers\JobTrackController::class, 'job_part_issue_edit'])->name('job_part_issue_edit');
    Route::get('/job_part_return_edit/{id}', [App\Http\Controllers\JobTrackController::class, 'job_part_return_edit'])->name('job_part_return_edit');
    Route::get('/job_estimate_versions_edit/{id}', [App\Http\Controllers\JobTrackController::class, 'job_estimate_versions_edit'])->name('job_estimate_versions_edit');
    Route::get('/estimate_history/{id}', [App\Http\Controllers\CustomController::class, 'estimate_history'])->name('estimate_history');
    Route::get('/get_parts', [App\Http\Controllers\JobPartsReturnController::class, 'get_parts'])->name('get_parts');
    Route::get('/job_delivery', [App\Http\Controllers\JobInformationController::class, 'job_delivery'])->name('job_delivery');
    Route::post('/job_delivery_save', [App\Http\Controllers\JobInformationController::class, 'job_delivery_save'])->name('job_delivery_save');
    Route::get('/job_delivery_edit/{id}', [App\Http\Controllers\JobInformationController::class, 'job_delivery_edit'])->name('job_delivery_edit');
    Route::get('/get_sale_job_inv/{id}', [App\Http\Controllers\JobInformationController::class, 'get_sale_job_inv'])->name('get_sale_job_inv');
    Route::post('/job_delivery_update', [App\Http\Controllers\JobInformationController::class, 'job_delivery_update'])->name('job_delivery_update');
    Route::get('/stock_report', [App\Http\Controllers\OpeningStockController::class, 'stock_smmary_report'])->name('stock_report');

    Route::get('/remaining_balance', [App\Http\Controllers\JobInformationController::class, 'remaining_balance'])->name('remaining_balance');

    //nabeel panga
    Route::resource('/job_info', App\Http\Controllers\JobInformationController::class);
    Route::resource('/add_job_info_list', App\Http\Controllers\JobInfoListController::class);

    ///////////////////////////////////////////  \App\Http\Controllers\ChangePasswordController //////////////////////////////////////////////////////////
    Route::resource('/settings', App\Http\Controllers\ChangePasswordController::class);
    //Route::post('/set_updati/{id}', App\Http\Controllers\Controller::class,'set_update')->name('set_update');

    Route::resource('/job_close', App\Http\Controllers\JobCloseController::class);
    //Route::resource('/job_close', App\Http\Controllers\JobCloseController::class);

    Route::resource('/job_close_reason', App\Http\Controllers\JobCloseReasonController::class);

    //Route::get('/client_exist', [App\Http\Controllers\CategoryController::class, 'client_exist'])->name('client_exist');

    Route::get('/cash_book_list', [App\Http\Controllers\CashBookController::class, 'cash_book_list'])->name('cash_book_list');

    //custom ajax

    Route::get('/client_exist', [App\Http\Controllers\CategoryController::class, 'client_exist'])->name('client_exist');

    Route::get('/get_estimate', [App\Http\Controllers\CustomController::class, 'get_estimate'])->name('get_estimate');

    Route::get('/get_rate', [App\Http\Controllers\CustomController::class, 'get_rate'])->name('get_rate');

    Route::get('/get_stock_qty', [App\Http\Controllers\CustomController::class, 'get_stock_qty'])->name('get_stock_qty');

    Route::get('/get_data_job_info', [App\Http\Controllers\CustomController::class, 'get_data_job_info'])->name('get_data_job_info');

    Route::get('/get_estimate_for_sale', [App\Http\Controllers\CustomController::class, 'get_estimate_for_sale'])->name('get_estimate_for_sale');

    Route::get('/get_account_total', [App\Http\Controllers\CustomController::class, 'get_account_total'])->name('get_account_total');

    Route::get('/get_category', [App\Http\Controllers\ModelController::class, 'get_category'])->name('get_category');
    Route::get('/get_model', [App\Http\Controllers\ModelController::class, 'get_model'])->name('get_model');
    Route::get('/get_old_technision', [App\Http\Controllers\ModelController::class, 'get_old_technision'])->name('get_old_technision');

    Route::get('/get_technision', [App\Http\Controllers\CustomController::class, 'get_technision'])->name('get_technision');

    Route::get('/get_brand', [App\Http\Controllers\CustomController::class, 'get_brand'])->name('get_brand');
    //Route::get('/get_category', [App\Http\Controllers\CustomController::class, 'get_category'])->name('get_category');

    Route::view('/openning_stock', 'open_stock/openning_stock');

    ////////////////////////////////////////////  Openning Routes //////////////////////////////////////////////////////////
    Route::get('/add_openning', [App\Http\Controllers\OpenningController::class, 'add_openning'])->name('add_openning');
    Route::post('/store_openning', [App\Http\Controllers\OpenningController::class, 'store_openning'])->name('store_openning');
    Route::get('/openning_list', [App\Http\Controllers\OpenningController::class, 'openning_list'])->name('openning_list');

    //modal views
    Route::get('/parts_issue_modal_view_details', [App\Http\Controllers\CustomController::class, 'parts_issue_modal_view_details'])->name('parts_issue_modal_view_details');

    Route::get('/parts_issue_modal_view_details/view/{id}', [App\Http\Controllers\CustomController::class, 'parts_issue_modal_view_details_SH'])->name('parts_issue_modal_view_details_sh');

    Route::get('/parts_issue_modal_view_details/view/pdf/{id}/{array?}/{str?}', [App\Http\Controllers\CustomController::class, 'parts_issue_modal_view_details_pdf_SH'])->name('parts_issue_modal_view_details_pdf_sh');

    Route::get('/parts_return_modal_view_details', [App\Http\Controllers\CustomController::class, 'parts_return_modal_view_details'])->name('parts_return_modal_view_details');

    Route::get('/parts_return_modal_view_details/view/{id}', [App\Http\Controllers\CustomController::class, 'parts_return_modal_view_details_SH'])->name('parts_return_modal_view_details_sh');

    Route::get('/parts_return_modal_view_details/view/pdf/{id}/{array?}/{str?}', [App\Http\Controllers\CustomController::class, 'parts_return_modal_view_details_pdf_SH'])->name('parts_return_modal_view_details_pdf_sh');

    // product loss
    Route::get('/product_loss_modal_view_details/view/{id}', [App\Http\Controllers\CustomController::class, 'product_loss_modal_view_details_SH'])->name('product_loss_modal_view_details_sh');
    Route::get('/product_loss_modal_view_details/view/pdf/{id}/{array?}/{str?}', [App\Http\Controllers\CustomController::class, 'product_loss_modal_view_details_pdf_SH'])->name('product_loss_modal_view_details_pdf_sh');

    // cash payment
    Route::get('/cash_payment_modal_view_details/view/{id}', [App\Http\Controllers\CustomController::class, 'cash_payment_modal_view_details_SH'])->name('cash_payment_modal_view_details_sh');
    // cash receipt
    Route::get('/cash_receipt_modal_view_details/view/{id}', [App\Http\Controllers\CustomController::class, 'cash_receipt_modal_view_details_SH'])->name('cash_receipt_modal_view_details_sh');
    // Part Return
    Route::get('/part_return_modal_view_details/view/{id}', [App\Http\Controllers\CustomController::class, 'part_return_modal_view_details_SH'])->name('part_return_modal_view_details_sh');
    Route::get('/part_return_modal_view_details/view/pdf/{id}/{array?}/{str?}', [App\Http\Controllers\CustomController::class, 'part_return_modal_view_details_pdf_SH'])->name('part_return_modal_view_details_pdf_sh');

    // Part Issue
    Route::get('/part_issue_modal_view_details/view/{id}', [App\Http\Controllers\CustomController::class, 'part_issue_modal_view_details_SH'])->name('part_issue_modal_view_details_sh');
    Route::get('/part_issue_modal_view_details/view/pdf/{id}/{array?}/{str?}', [App\Http\Controllers\CustomController::class, 'part_issue_modal_view_details_pdf_SH'])->name('part_issue_modal_view_details_pdf_sh');

    // Part Recover
    Route::get('/part_recover_modal_view_details/view/{id}', [App\Http\Controllers\CustomController::class, 'part_recover_modal_view_details_SH'])->name('part_recover_modal_view_details_sh');
    Route::get('/part_recover_modal_view_details/view/pdf/{id}/{array?}/{str?}', [App\Http\Controllers\CustomController::class, 'part_recover_modal_view_details_pdf_SH'])->name('part_recover_modal_view_details_pdf_sh');
    //sale invoice views
    Route::get('/sale_invoice_modal_view_details', [App\Http\Controllers\CustomController::class, 'sale_invoice_modal_view_details'])->name('sale_invoice_modal_view_details');

    Route::get('/sale_invoice_modal_view_details/view/{id}', [App\Http\Controllers\CustomController::class, 'sale_invoice_modal_view_details_SH'])->name('sale_invoice_modal_view_details_sh');

    Route::get('/sale_invoice_modal_view_details/view/pdf/{id}/{array?}/{str?}', [App\Http\Controllers\CustomController::class, 'sale_invoice_modal_view_details_pdf_SH'])->name('sale_invoice_modal_view_details_pdf_sh');

    //purchase invoice views
    Route::get('/purchase_invoice_modal_view_details', [App\Http\Controllers\CustomController::class, 'purchase_invoice_modal_view_details'])->name('purchase_invoice_modal_view_details');

    Route::get('/purchase_invoice_modal_view_details/view/{id}', [App\Http\Controllers\CustomController::class, 'purchase_invoice_modal_view_details_SH'])->name('purchase_invoice_modal_view_details_sh');

    Route::get('/purchase_invoice_modal_view_details/view/pdf/{id}/{array?}/{str?}', [App\Http\Controllers\CustomController::class, 'purchase_invoice_modal_view_details_pdf_SH'])->name('purchase_invoice_modal_view_details_pdf_sh');

    //Job Sale invoice views
    Route::get('/sale_job_invoice_modal_view_details', [App\Http\Controllers\CustomController::class, 'sale_job_invoice_modal_view_details'])->name('sale_job_invoice_modal_view_details');

    Route::get('/sale_job_invoice_modal_view_details/view/{id}', [App\Http\Controllers\CustomController::class, 'sale_job_invoice_modal_view_details_SH'])->name('sale_job_invoice_modal_view_details_sh');

    Route::get('/sale_job_invoice_modal_view_details/view/pdf/{id}/{array?}/{str?}', [App\Http\Controllers\CustomController::class, 'sale_job_invoice_modal_view_details_pdf_SH'])->name('sale_job_invoice_modal_view_details_pdf_sh');

    //Job Information
    Route::get('/job_info_modal_view_details', [App\Http\Controllers\CustomController::class, 'job_info_modal_view_details'])->name('job_info_modal_view_details');

    Route::get('/job_info_modal_view_details/view/{id}', [App\Http\Controllers\CustomController::class, 'job_info_modal_view_details_SH'])->name('job_info_modal_view_details_sh');
    Route::get('/job_info_thermal_modal_view_details/view/{id}', [App\Http\Controllers\CustomController::class, 'job_info_thermal_modal_view_details_SH'])->name('job_info_thermal_modal_view_details_sh');
    Route::get('/job_info/job_info_thermal_modal_view_details/view/{id}', [App\Http\Controllers\CustomController::class, 'job_info_thermal_modal_view_details_SH'])->name('job_info_thermal_modal_view_details_sh');

    Route::get('/job_info_modal_view_details/view/pdf/{id}/{array?}/{str?}', [App\Http\Controllers\CustomController::class, 'job_info_modal_view_details_pdf_SH'])->name('job_info_modal_view_details_pdf_sh');
    // company profile
    Route::get('/company_profile', [App\Http\Controllers\CompanyProfileController::class, 'company_profile'])->name('company_profile');
    Route::post('/update_company_profile', [App\Http\Controllers\CompanyProfileController::class, 'update_company_profile'])->name('update_company_profile');
    //Route::post('/update_company_profile\{id}', [App\Http\Controllers\CompanyProfileController::class, 'update_company_profile'])->name('update_company_profile');

    // farhad add
    Route::get('/load-more-data', [App\Http\Controllers\JobInformationController::class, 'load'])->name('load.more.data');
});
Route::middleware(['checkUserId'])->group(function () {
    Route::get('/add_company', [App\Http\Controllers\CompanyController::class, 'create'])->name('add_company');
    Route::post('/store_company', [App\Http\Controllers\CompanyController::class, 'store'])->name('store_company');
    Route::get('/company_list', [App\Http\Controllers\CompanyController::class, 'company_list'])->name('company_list');
});
