<?php
/**
 * Created by PhpStorm.
 * User: Hamza
 * Date: 16-Dec-18
 * Time: 10:56 AM
 */


// server name or root
$server_name = env('APP_URL');
$server_http_request = env('APP_URL');
$domainStorageFolderName = env('APP_PUBLIC_STORAGE');


return [

    //////////////////////////////// server name or root ///////////////////////////////////
    'server_name' => $server_name,
    'server_http_request' => $server_http_request,

    /////////////////////////////////// Day end links /////////////////////////////////////
    'execute_day_end' => $server_http_request . '/public/_api/day_end/execute_day_end.php',
    'day_end_report' => $server_http_request . '/public/_api/day_end/day_end_report.php',

    ///////////////////////////////// Site Configurations Links //////////////////////////////////////////////////
    'password_change_path' => $server_http_request . 'change_forgotten_password/',
    'common_path' => $server_http_request . 'storage/app/',
    // 'common_path' => $server_http_request . '/',

    'storage_folder_name' => $domainStorageFolderName . '/app/',
    'excel_storage_folder_name' => $domainStorageFolderName . '/',
    'default_image_path' => $server_http_request . '/public/src/default_profile.png',
    'website_path' => $server_http_request . '',
    'company_logo' => '/public/company_logo',
    'product_path' => '/public/company_logo',



];
