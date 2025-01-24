<?php
// Requires the "PHPMailer" library
require_once 'PHPMailer-master/src/PHPMailer.php';
require_once 'PHPMailer-master/src/SMTP.php';
require_once 'PHPMailer-master/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function sendEmail($to, $subject, $body)
{
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->SMTPDebug = 2;
        $mail->Host = 'smtp.titan.email';
        $mail->Port = 587;
        $mail->SMTPDebug = 0;
        $mail->SMTPAuth = true;
         $mail->Username = 'sales@clique360.net';
         $mail->Password = 'Opened@000';
         $mail->SMTPSecure = 'tls';
        // Define the email address separately
        // $senderEmail = 'nomanpk@gmail.com';
        // $senderEmail = 'tax@ask-management-consultants.com';
        // Recipients
        $mail->setFrom('sales@clique360.net', 'Farhad Ahamd');
        // $mail->setFrom('sales@clique360.net', 'Aamer Sikandar');
        // $mail->addReplyTo('sales@clique360.net', 'Farhad Ahmad');
        // $mail->setFrom($senderEmail, 'Aamer Sikandar');
        // $mail->setFrom('nomanpk@gmail.com', 'Noman Ahmad');
        // $mail->setFrom('tax@ask-management-consultants.com', 'Aamer Sikandar');
        $mail->addAddress($to);
        // Add a recipient
    // $mail->addAddress('sales@clique360.net');

        // Content
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $body;

        $mail->send();
        return true;
    } catch (Exception $e) {
        return 'Mailer Error: ' . $mail->ErrorInfo;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ownerEmail = 'hilmandshah636@gmail.com'; // Replace with the owner's email address
    // $ownerEmail = 'nomanpk@gmail.com'; // Replace with the owner's email address
    // $ownerEmail = 'tax@ask-management-consultants.com'; // Replace with the owner's email address
    $visitorEmail = $_POST['visitorEmail'];
    $subject = 'Tax Computation Result';

    // Extract values from the JSON string (assuming JSON is sent in the 'message' field)
    $postData = json_decode($_POST['message'], true);

    // Assign values to variables
    $calType = $postData['calType'];
    $aYear = $postData['aYear'];
    $cName = $postData['cName'];
    $cEmail = $postData['cEmail'];
    $cMobile = $postData['cMobile'];
    $cCompany = $postData['cCompany'];

    // Add more variables as needed

    // HTML-formatted message with placeholders
    if ($calType === 'FreeZone') {
        $Qualifying_Income = $postData['Qualifying_Income'];
        $Taxable_Income_9 = $postData['Taxable_Income_9'];
        $Tax_Payable = $postData['Tax_Payable'];
        $message =
            '
        <div id=\'myPopupDiv\'>
        <div class=\'mainDiv\' style="position: relative;margin: 50px auto;width: 800px;min-height: 500px;background: white;">
                <div class="mainDivBG" style="padding: 20px 40px;background-size: 100%;background-position: right top;">
        
                <div style="text-align:center">
                    <img src="https://ask-management-consultants.com/wp-content/uploads/New_Logo-removebg-preview.png" alt="" style="width:200px;">
                </div>
                <br>
                <h4 id="greeting" style="color:gray; padding:10px 0 5px 0"> Dear ' .
            $cName .
            '
                </h4>
                <h6 style="color:gray; font-weight:100;text-align: justify; text-justify: inter-word;font-size: 12px;">
                    Thanks for using ASK management tax calculator. Please be reminded that the
                    calculator is for
                    informational purposes only and may not cover all the circumstances relevant to
                    you. You are
                    therefore
                    advised to obtain qualified opinion in respect of your tax liability. The use of
                    calculator does
                    not
                    create any liability on ASK management consultants or its employees.
                </h6>
                <br>
                <div style="display: flex; width: 100%;">
                <div style="width:50%">
                <h4 style="color: rgb(107, 168, 182);">Client Info.</h4>
                <p><strong>Name:</strong>' .
            $cName .
            '</p>
                <p><strong>Email:</strong>' .
            $cEmail .
            '</p>
                <p><strong>Mobile:</strong>' .
            $cMobile .
            '</p>
                <p><strong>Company:</strong>' .
            $cCompany .
            '</p>
            </div>
                <div style="width:50%">
                <h4 style="color: rgb(107, 168, 182);">Company Info.</h4>
                <p><strong>Company:</strong>ASK Management Consultants LLC-FZ</p>
                <p><strong>Email:</strong>info@ask-management-consultants.com</p>
            </div>
            </div>
        
                <h3 style="padding: 10px 20px; text-align: center; color: rgb(107, 168, 182);"> Tax
                    Computation
                </h3>
        
                <h5 id="taxYear" style="color:rgb(56, 162, 143); padding: 0px 0 0px 0;font-size: small;">
                    Your
                    Tax year 
                    is:' .
            $aYear .
            ' </h5>
                <h5 id="returnDate" style="color:rgb(56, 162, 143); padding: 0px 0 10px 0;font-size: small;">
                    Your
                    first
                    Tax return is due on: 31-12-' .
            $aYear .
            ' </h5>
        
                <div class="calWorking" style="overflow: hidden; font-weight: bold;border-bottom: 1px gray dotted;font-size: 14px;padding: 3px 9px 3px 9px; font-weight: bold; background:rgb(164, 218, 221); margin-bottom:10px; border-bottom: 2px double;">
                    <p style="float: left; width: 50%;">Description </p>
                    <p style="float: right;width: 45%;text-align: end; "> A m o u n t </p>
                </div>
        
                <div class="calWorking" style="overflow: hidden; font-weight: bold;border-bottom: 1px gray dotted;font-size: 14px;font-weight: bold;">
                    <p style="float: left; width: 50%;">Qualifying Income </p>
                    <p id="a1" style="float: right;width: 45%;text-align: end; ">' .
            $Qualifying_Income .
            '</p>
                </div>
                <div class="calWorking" style="overflow: hidden; font-weight: bold;border-bottom: 1px gray dotted;font-size: 14px;background:#a4d4dd;">
                    <p style="float: left; width: 50%;padding:5px 0; font-weight:bold;">Taxable Income @ 9%</p>
                    <p id="i1" style="float: right;width: 45%;text-align: end; padding: 3px 0 3px 10px; font-weight: bold; border-bottom: 2px double; ">
                        ' .
            $Taxable_Income_9 .
            ' </p>
                </div>
                <div class="calWorking" style="overflow: hidden; font-weight: bold;border-bottom: 1px gray dotted;font-size: 14px;background:#a4d4dd;">
                    <p style="float: left; width: 50%;padding:5px 0; font-weight:bold;">Tax Payable</p>
                    <p id="i2" style="float: right;width: 45%;text-align: end; padding: 3px 0 3px 10px; font-weight: bold; border-bottom: 2px double; ">
                        ' .
            $Tax_Payable .
            ' </p>
                </div>
        
        
        
        
        
                <h4 style="color:gray; padding: 30px 0 10px 0;"> Other Matters </h4>
                <h5 style="color:gray; padding: 00px 0 10px 0;"> You may elect below (where
                    relevant to you): </h5>
        
                <ol class="textOM" style="list-style-type: decimal;">
                    <li style="font-size: 10px;margin-bottom: 5px;margin-left: 15px;padding-left: 10px;color: gray;">Benefit from small business relief if your annual turnover is below AED
                        3,000,000 in current
                        year
                        and previous years </li>
                    <li style="font-size: 10px;margin-bottom: 5px;margin-left: 15px;padding-left: 10px;color: gray;">Exempt Foreign permanat establishmnet Income </li>
                    <li style="font-size: 10px;margin-bottom: 5px;margin-left: 15px;padding-left: 10px;color: gray;">Account for gain and losses on realisation basis </li>
                    <li style="font-size: 10px;margin-bottom: 5px;margin-left: 15px;padding-left: 10px;color: gray;">Be subject to Corporate tax if you are a Qualifying Free Zone person </li>
                    <li style="font-size: 10px;margin-bottom: 5px;margin-left: 15px;padding-left: 10px;color: gray;">Apply relief in relation to transfer of qualifying assets </li>
                    <li style="font-size: 10px;margin-bottom: 5px;margin-left: 15px;padding-left: 10px;color: gray;"> Apply busines restructuring relief </li>
                    <li style="font-size: 10px;margin-bottom: 5px;margin-left: 15px;padding-left: 10px;color: gray;">Apply transitionla relief </li>
                </ol>
                <br>
        
                <h5 style="color:gray; padding: 00px 0 10px 0;"> You may make below applications to
                    FTA </h5>
                <ol class="textOM" style="list-style-type: decimal;">
                    <li style="font-size: 10px;margin-bottom: 5px;margin-left: 15px;padding-left: 10px;color: gray;">To be exempt from Corporate Tax, if the Person is a public pension fund or a
                        public social
                        security
                        fund, a private pension fund or a private social security fund that meet the
                        relevant
                        conditions, or
                        a Qualifying Investment Fund </li>
                    <li style="font-size: 10px;margin-bottom: 5px;margin-left: 15px;padding-left: 10px;color: gray;">To be exempt from Corporate Tax, if they are a juridical person that is
                        wholly owned and
                        controlled
                        by certain types of Exempt Persons387 and meet the relevant condition (e.g.
                        used exclusively
                        for
                        holding assets or investing funds for the benefit of the Exempt Person)
                    </li>
                    <li style="font-size: 10px;margin-bottom: 5px;margin-left: 15px;padding-left: 10px;color: gray;">To continue to be exempt from Corporate Tax if the Person temporarily fails
                        to meet the
                        conditions
                        of exemption; </li>
                    <li style="font-size: 10px;margin-bottom: 5px;margin-left: 15px;padding-left: 10px;color: gray;">To treat a Government Entity’s taxable Businesses as a single Taxable
                        Person; </li>
                    <li style="font-size: 10px;margin-bottom: 5px;margin-left: 15px;padding-left: 10px;color: gray;">To treat an Unincorporated Partnership as a single Taxable Person </li>
                    <li style="font-size: 10px;margin-bottom: 5px;margin-left: 15px;padding-left: 10px;color: gray;">To treat a Family Foundation as an Unincorporated Partnership </li>
                    <li style="font-size: 10px;margin-bottom: 5px;margin-left: 15px;padding-left: 10px;color: gray;">To request a clarification from the FTA </li>
                    <li style="font-size: 10px;margin-bottom: 5px;margin-left: 15px;padding-left: 10px;color: gray;">To request a refund from the FTA </li>
                    <li style="font-size: 10px;margin-bottom: 5px;margin-left: 15px;padding-left: 10px;color: gray;">To adjust Taxable Income following an adjustment by a foreign tax authority
                    </li>
                    <li style="font-size: 10px;margin-bottom: 5px;margin-left: 15px;padding-left: 10px;color: gray;">To move from the Cash Basis of Accounting to Accrual Basis of Accounting
                    </li>
                    <li style="font-size: 10px;margin-bottom: 5px;margin-left: 15px;padding-left: 10px;color: gray;">To form, join or leave a Tax Group, replace a Parent Company in a Tax Group,
                        or cease to be
                        a Tax
                        Group </li>
                    <li style="font-size: 10px;margin-bottom: 5px;margin-left: 15px;padding-left: 10px;color: gray;">To deregister for Corporate Tax </li>
                    <li style="font-size: 10px;margin-bottom: 5px;margin-left: 15px;padding-left: 10px;color: gray;">To change their Tax Period </li>
                </ol>
                <br>
                <h5 style="color:rgb(203, 98, 98); padding: 0px 0 15px 0;">
                Click <a href="mailto:tax@ask-management-consultants.com">Communicate Error</a> found in Tax Calculations.
                </h5>
        
                <h5 style="color:rgb(203, 98, 98); padding: 00px 0 10px 0;">
                Choose <a href="mailto:info@ask-management-consultants.com">Contact US</a> to address your Specific needs.</h5>
            </div>
            </div>
        </div>
        ';
    } else {
        $Accounting_Income = $postData['Accounting_Income'];
        $calProInc = $postData['calProInc'];
        $Amount_of_unrealized_gains = $postData['Amount_of_unrealized_gains'];
        $expenses_for_business = $postData['expenses_for_business'];
        $Exempt_capital = $postData['Exempt_capital'];
        $Domestic_dividends = $postData['Domestic_dividends'];
        $surplus_interest_expense = $postData['surplus_interest_expense'];
        $Entertainment_Expenditure = $postData['Entertainment_Expenditure'];
        $Not_wholy_or_fully_Business_expense = $postData['Not_wholy_or_fully_Business_expense'];
        $Transfer_pricing_adjustment = $postData['Transfer_pricing_adjustment'];
        $Adjusted_Profit = $postData['Adjusted_Profit'];
        $unincorporated_Partnership = $postData['unincorporated_Partnership'];
        $calCarLoss = $postData['calCarLoss'];
        $Taxable_Income = $postData['Taxable_Income'];
        $First_375000_Exempt = $postData['First_375000_Exempt'];
        $Tax_Payable_9 = $postData['Tax_Payable_9'];
        $tax_credit_foreign_income = $postData['tax_credit_foreign_income'];
        $Tax_Liability = $postData['Tax_Liability'];
        $message =
            '
        <div id=\'myPopupDiv\'>
        <div class=\'mainDiv\' style="position: relative;margin: 50px auto;width: 800px;min-height: 500px;background: white;">
                <div class="mainDivBG" style="padding: 20px 40px;background-size: 100%;background-position: right top;">
        
                <div style="text-align:center">
                    <img src="https://ask-management-consultants.com/wp-content/uploads/New_Logo-removebg-preview.png" alt="" style="width:200px;">
                </div>
                <br>
                <h4 id="greeting" style="color:gray; padding:10px 0 5px 0"> Dear ' .
            $cName .
            ',
                </h4>
                <h6 style="color:gray; font-weight:100; text-align: justify; text-justify: inter-word;font-size: 12px;">
                    Thanks for using ASK management tax calculator. Please be reminded that the
                    calculator is for
                    informational purposes only and may not cover all the circumstances relevant to
                    you. You are
                    therefore
                    advised to obtain qualified opinion in respect of your tax liability. The use of
                    calculator does
                    not
                    create any liability on ASK management consultants or its employees.
                </h6>
                <br>
                <div style="display: flex; width: 100%;">
                <div style="width:50%">
                <h4 style="color: rgb(107, 168, 182);">Client Info.</h4>
                <p><strong>Name:</strong>' .
            $cName .
            '</p>
                <p><strong>Email:</strong>' .
            $cEmail .
            '</p>
                <p><strong>Mobile:</strong>' .
            $cMobile .
            '</p>
                <p><strong>Company:</strong>' .
            $cCompany .
            '</p>
            </div>
                <div style="width:50%">
                <h4 style="color: rgb(107, 168, 182);">Company Info.</h4>
                <p><strong>Company:</strong>ASK Management Consultants LLC-FZ</p>
                <p><strong>Email:</strong>info@ask-management-consultants.com</p>
            </div>
            </div>
        
                <h3 style="padding: 10px 20px; text-align: center; color: rgb(107, 168, 182);"> Tax
                    Computation
                </h3>
        
                <h5 id="taxYear" style="color:rgb(56, 162, 143); padding: 0px 0 0px 0;font-size: small;">
                    Your
                    Tax year 
                    is:' .
            $aYear .
            ' </h5>
                <h5 id="returnDate" style="color:rgb(56, 162, 143); padding: 0px 0 10px 0;font-size: small;">
                    Your
                    first
                    Tax return is due on: 31-12-' .
            $aYear .
            ' </h5>
        
                <div class="calWorking" style="overflow: hidden; font-weight: bold; border-bottom: 1px gray dotted; font-size: 14px; padding: 3px 4.5%; font-weight: bold; background: rgb(164, 218, 221); margin-bottom: 10px; border-bottom: 2px double;">
                    <p style="float: left; width: 50%;">Description </p>
                    <p style="float: right; width: 45%;text-align: end;"> A m o u n t </p>
                </div>
        
                <div class="calWorking" style="overflow: hidden; font-weight: bold; border-bottom: 1px gray dotted; font-size: 14px; font-weight: bold;">
                    <p style="float: left; width: 50%;">Total Accounting Income </p>
                    <p id="a1" style="float: right; width: 45%;text-align: end;">' .
            $Accounting_Income .
            '</p>
                </div>
        
                <h4 style="padding-top:10px;"> Adjustments: </h4>
                <div class="calWorking" style="overflow: hidden; font-weight: bold;border-bottom: 1px gray dotted;font-size: 14px;">
                    <p style="float: left; width: 50%;"> Commercial FreeZone Property Income waiver </p>
                    <p id="b1" style="float: right; width: 45%;text-align: end;"> ' .
            $calProInc .
            ' </p>
                </div>
                <div class="calWorking" style="overflow: hidden; font-weight: bold;border-bottom: 1px gray dotted;font-size: 14px;">
                    <p style="float: left; width: 50%;"> Add back unrealized gains for elections made </p>
                    <p id="b2" style="float: right; width: 45%;text-align: end;"> ' .
            $Amount_of_unrealized_gains .
            ' </p>
                </div>
        
                <div class="calWorking" style="overflow: hidden; font-weight: bold;border-bottom: 1px gray dotted;font-size: 14px;">
                    <p style="float: left; width: 50%;">Add back not wholly expenses for business </p>
                    <p id="b3" style="float: right; width: 45%;text-align: end;"> ' .
            $expenses_for_business .
            ' </p>
                </div>
        
                <div class="calWorking" style="overflow: hidden; font-weight: bold;border-bottom: 1px gray dotted;font-size: 14px;">
                    <p style="float: left; width: 50%;">Exempt capital gains or foreign income</p>
                    <p id="b4" style="float: right; width: 45%;text-align: end;"> ' .
            $Exempt_capital .
            ' </p>
                </div>
        
                <div class="calWorking" style="overflow: hidden; font-weight: bold;border-bottom: 1px gray dotted;font-size: 14px;">
                    <p style="float: left; width: 50%;">Domestic dividends</p>
                    <p id="b5" style="float: right; width: 45%;text-align: end;"> ' .
            $Domestic_dividends .
            ' </p>
                </div>
        
                <div class="calWorking" style="overflow: hidden; font-weight: bold;border-bottom: 1px gray dotted;font-size: 14px;">
                    <p style="float: left; width: 50%;">Add back surplus interest expense</p>
                    <p id="b6" style="float: right; width: 45%;text-align: end;"> ' .
            $surplus_interest_expense .
            ' </p>
                </div>
                <div class="calWorking" style="overflow: hidden; font-weight: bold;border-bottom: 1px gray dotted;font-size: 14px;">
                    <p style="float: left; width: 50%;">Entertainment Expenditure</p>
                    <p id="b7" style="float: right; width: 45%;text-align: end;"> ' .
            $Entertainment_Expenditure .
            ' </p>
                </div>
                <div class="calWorking" style="overflow: hidden; font-weight: bold;border-bottom: 1px gray dotted;font-size: 14px;">
                    <p style="float: left; width: 50%;">Not wholly or fully Business expense</p>
                    <p id="b8" style="float: right; width: 45%;text-align: end;"> ' .
            $Not_wholy_or_fully_Business_expense .
            ' </p>
                </div>
                <div class="calWorking" style="overflow: hidden; font-weight: bold;border-bottom: 1px gray dotted;font-size: 14px;">
                    <p style="float: left; width: 50%;">Transfer pricing adjustment</p>
                    <p id="b9" style="float: right; width: 45%;text-align: end;"> ' .
            $Transfer_pricing_adjustment .
            ' </p>
                </div>
                <div class="calWorking" style="overflow: hidden; font-weight: bold;border-bottom: 1px gray dotted;font-size: 14px;">
                    <p style="padding-top:10px; font-weight:bold;float: left; width: 50%;">Adjusted Profit</p>
                    <p id="c1" style="float: right;width: 45%;padding: 5px 0 5px 10px; font-weight: bold; border-top: 1px double;text-align: end">
                        ' .
            $Adjusted_Profit .
            ' </p>
                </div>
                <div class="calWorking" style="overflow: hidden; font-weight: bold;border-bottom: 1px gray dotted;font-size: 14px;">
                    <p style="float: left; width: 50%;">Unincorporated Partnership</p>
                    <p id="d1" style="float: right; width: 45%;text-align: end;"> ' .
            $unincorporated_Partnership .
            ' </p>
                </div>
                <div class="calWorking" style="overflow: hidden; font-weight: bold;border-bottom: 1px gray dotted;font-size: 14px;">
                    <p style="float: left; width: 50%;">Less Carry forward tax loss</p>
                    <p id="e1" style="float: right; width: 45%;text-align: end;"> ' .
            $calCarLoss .
            ' </p>
                </div>
        
                <div class="calWorking" style="overflow: hidden; font-weight: bold;border-bottom: 1px gray dotted;font-size: 14px;">
                    <p style="padding-top:10px; font-weight:bold;float: left; width: 50%;">Taxable Income</p>
                    <p id="f1" style="float: right;width: 45%;padding: 5px 0 5px 10px; font-weight: bold; border-top: 1px double;text-align: end">
                        ' .
            $Taxable_Income .
            ' </p>
                </div>
        
                <div class="calWorking" style="overflow: hidden; font-weight: bold;border-bottom: 1px gray dotted;font-size: 14px;">
                    <p style="float: left; width: 50%;">First 375000 Exempt </p>
                    <p id="g1" style="float: right; width: 45%;text-align: end;"> ' .
            $First_375000_Exempt .
            ' </p>
                </div>
                <div class="calWorking" style="overflow: hidden; font-weight: bold;border-bottom: 1px gray dotted;font-size: 14px;background:#a4d4dd;">
                    <p style="float: left; width: 50%;padding:5px 0; font-weight:bold;">Tax Liability @9%</p>
                    <p id="i1" style="float: right; width: 45%;padding: 3px 0 3px 10px; font-weight: bold; border-bottom: 2px double;text-align: end">
                        ' .
            $Tax_Payable_9 .
            ' </p>
                </div>
                <div class="calWorking" style="overflow: hidden; font-weight: bold;border-bottom: 1px gray dotted;font-size: 14px;">
                    <p style="float: left; width: 50%;">Tax credit Foreign Income</p>
                    <p id="h1" style="float: right; width: 45%;text-align: end;"> ' .
            $tax_credit_foreign_income .
            ' </p>
                </div>
                <div class="calWorking" style="overflow: hidden; font-weight: bold;border-bottom: 1px gray dotted;font-size: 14px;background:#a4d4dd;">
                    <p style="float: left; width: 50%;padding:5px 0; font-weight:bold;">Tax Liability</p>
                    <p id="i2" style="float: right; width: 45%;padding: 3px 0 3px 10px; font-weight: bold; border-bottom: 2px double;text-align: end">
                        ' .
            $Tax_Liability .
            ' </p>
                </div>
        
        
        
        
        
                <h4 style="color:gray; padding: 30px 0 10px 0;"> Other Matters </h4>
                <h5 style="color:gray; padding: 00px 0 10px 0;"> You may elect below (where
                    relevant to you): </h5>
        
                <ol class="textOM" style="list-style-type: decimal;">
                    <li style="font-size: 10px;margin-bottom: 5px;margin-left: 15px;padding-left: 10px;color: gray;">Benefit from small business relief if your annual turnover is below AED
                        3,000,000 in current
                        year
                        and previous years </li>
                    <li style="font-size: 10px;margin-bottom: 5px;margin-left: 15px;padding-left: 10px;color: gray;">Exempt Foreign permanat establishmnet Income </li>
                    <li style="font-size: 10px;margin-bottom: 5px;margin-left: 15px;padding-left: 10px;color: gray;">Account for gain and losses on realisation basis </li>
                    <li style="font-size: 10px;margin-bottom: 5px;margin-left: 15px;padding-left: 10px;color: gray;">Be subject to Corporate tax if you are a Qualifying Free Zone person </li>
                    <li style="font-size: 10px;margin-bottom: 5px;margin-left: 15px;padding-left: 10px;color: gray;">Apply relief in relation to transfer of qualifying assets </li>
                    <li style="font-size: 10px;margin-bottom: 5px;margin-left: 15px;padding-left: 10px;color: gray;"> Apply busines restructuring relief </li>
                    <li style="font-size: 10px;margin-bottom: 5px;margin-left: 15px;padding-left: 10px;color: gray;">Apply transitionla relief </li>
                </ol>
                <br>
        
                <h5 style="color:gray; padding: 00px 0 10px 0;"> You may make below applications to
                    FTA </h5>
                <ol class="textOM" style="list-style-type: decimal;">
                    <li style="font-size: 10px;margin-bottom: 5px;margin-left: 15px;padding-left: 10px;color: gray;">To be exempt from Corporate Tax, if the Person is a public pension fund or a
                        public social
                        security
                        fund, a private pension fund or a private social security fund that meet the
                        relevant
                        conditions, or
                        a Qualifying Investment Fund </li>
                    <li style="font-size: 10px;margin-bottom: 5px;margin-left: 15px;padding-left: 10px;color: gray;">To be exempt from Corporate Tax, if they are a juridical person that is
                        wholly owned and
                        controlled
                        by certain types of Exempt Persons387 and meet the relevant condition (e.g.
                        used exclusively
                        for
                        holding assets or investing funds for the benefit of the Exempt Person)
                    </li>
                    <li style="font-size: 10px;margin-bottom: 5px;margin-left: 15px;padding-left: 10px;color: gray;">To continue to be exempt from Corporate Tax if the Person temporarily fails
                        to meet the
                        conditions
                        of exemption; </li>
                    <li style="font-size: 10px;margin-bottom: 5px;margin-left: 15px;padding-left: 10px;color: gray;">To treat a Government Entity’s taxable Businesses as a single Taxable
                        Person; </li>
                    <li style="font-size: 10px;margin-bottom: 5px;margin-left: 15px;padding-left: 10px;color: gray;">To treat an Unincorporated Partnership as a single Taxable Person </li>
                    <li style="font-size: 10px;margin-bottom: 5px;margin-left: 15px;padding-left: 10px;color: gray;">To treat a Family Foundation as an Unincorporated Partnership </li>
                    <li style="font-size: 10px;margin-bottom: 5px;margin-left: 15px;padding-left: 10px;color: gray;">To request a clarification from the FTA </li>
                    <li style="font-size: 10px;margin-bottom: 5px;margin-left: 15px;padding-left: 10px;color: gray;">To request a refund from the FTA </li>
                    <li style="font-size: 10px;margin-bottom: 5px;margin-left: 15px;padding-left: 10px;color: gray;">To adjust Taxable Income following an adjustment by a foreign tax authority
                    </li>
                    <li style="font-size: 10px;margin-bottom: 5px;margin-left: 15px;padding-left: 10px;color: gray;">To move from the Cash Basis of Accounting to Accrual Basis of Accounting
                    </li>
                    <li style="font-size: 10px;margin-bottom: 5px;margin-left: 15px;padding-left: 10px;color: gray;">To form, join or leave a Tax Group, replace a Parent Company in a Tax Group,
                        or cease to be
                        a Tax
                        Group </li>
                    <li style="font-size: 10px;margin-bottom: 5px;margin-left: 15px;padding-left: 10px;color: gray;">To deregister for Corporate Tax </li>
                    <li style="font-size: 10px;margin-bottom: 5px;margin-left: 15px;padding-left: 10px;color: gray;">To change their Tax Period </li>
                </ol>
                <br>
                <h5 style="color:rgb(203, 98, 98); padding: 0px 0 15px 0;">
                Click <a href="mailto:tax@ask-management-consultants.com">Communicate Error</a> found in Tax Calculations.
                </h5>
        
                <h5 style="color:rgb(203, 98, 98); padding: 00px 0 10px 0;">
                Choose <a href="mailto:info@ask-management-consultants.com">Contact US</a> to address your Specific needs.</h5>
            </div>
            </div>
        </div>
        ';
    }
    // Send email to owner
    sendEmail($ownerEmail, $subject, $message);

    // Send email to visitor
    $sendResult = sendEmail($visitorEmail, $subject, $message);

    if ($sendResult === true) {
        echo 'Emails sent successfully.';
    } else {
        http_response_code(500); // Internal Server Error
        echo 'Error sending email: ' . $sendResult;
    }
} else {
    http_response_code(405); // Method Not Allowed
    echo 'Invalid request method.';
}
?>
