<?php

// Read the raw POST data
// $jsonData = file_get_contents('php://input');

// Decode the JSON data
// $data = json_decode($jsonData, true);

// Access the individual values
$stdTax = '7000000'; // Your income from Qualifying transactions with free zone entities D41
$stdTaxNCP = '5000'; //Your Income from transactions with non freezone persons for Qualifying Activities D42
$stdTaxCP = '5000000'; // Your other income- Excluded/Non Qualifying income D43
$salOthFZ = '200000'; //Non commercial property Income D44
$nonFZper = ''; //Commercial proprty income in FreeZone D45
$deminins = '';
$incFrom = '';
$calIncome = 8000000;
$calCos = -4000000;
$calExp = -1000000;
$calAccInc = 3000000;
$calRelGain = 50000;
$calProInc = '';
$calCapGain = '';
$calDomDiv = '';
$calForDiv = '';
$calReaBaseS = 'Yes';
$calIntExp = -50000;
$calDepAmot = 300000;
$calEntExp = 50000;
$calBusExp = 300000;
$calTraPri = '';
$calUnInoPart = '';
$calCarLoss = '';
$calType = 'FreeZone';
$fruits = '';
$expenses_for_business = '';
$Tax_credit_Foreign_Income = '';
// ... and so on for other values

// FreeZone Calculation

if ($calType == 'FreeZone') {
    $Total_Income = floatval($stdTax) + floatval($stdTaxNCP) + floatval($stdTaxCP) + floatval($salOthFZ) + floatval($nonFZper);
    $Other_Income = $stdTaxCP;
    $Deminis_Limit_1 = 5000000;
    // =(D44+D43)/SUM(D41:D44)
    $formattedResult = (floatval($salOthFZ) + floatval($stdTaxCP)) / floatval($Total_Income);

    // Format the result as a percentage with two decimal places
    $Deminis_Limit_2 = number_format($formattedResult * 100, 2);

    // Assuming you have the following variables defined

    // Check conditions and calculate result
    if ($Deminis_Limit_2 < 0.05 && $stdTaxCP + $salOthFZ < $Deminis_Limit_1) {
        $Deminins_tests_Result = array_sum([$stdTax, $stdTaxNCP, $stdTaxCP, $salOthFZ]);
    } else {
        $Deminins_tests_Result = $stdTax + $stdTaxNCP;
    }
    $Qualifying_Income = $Deminins_tests_Result;
    $Taxable_Income_9 = floatval($Total_Income) - floatval($Qualifying_Income);

    $D49 = 0;
    $Tax_Payable = ($Taxable_Income_9 - $D49)*0.09;
    // Output the result
    echo $Tax_Payable . '<br>';
    echo $Taxable_Income_9 . '<br>';
    echo $Qualifying_Income . '<br>';
    echo $Deminins_tests_Result . '<br>';
    // Output the formatted result
    echo $Deminis_Limit_2 . '<br>';

    echo $Total_Income;
    // echo 'freezone';
} else {
    // Geneal  Tax Calculation

    // Net Interest Computation

    $EBITDA = (floatval($calAccInc) + floatval($calIntExp) + floatval($calDepAmot)) * 0.3;

    if ($calIntExp > 12000000) {
        $Max_Limit = max($EBITDA, 12000000);
    } else {
        $Max_Limit = $calIntExp;
    }

    if ($calIntExp < 12000000) {
        $Allowed_Limit = $calIntExp;
    } else {
        $Allowed_Limit = 12000000;
    }

    $Accounting_Income = $calAccInc;
    $Property_Income = $calProInc;
    if ($calReaBaseS == 'Yes') {
        $Amount_of_unrealized_gains = $calRelGain;
    } else {
        $Amount_of_unrealized_gains = 0;
    }
    $expenses_for_business = $expenses_for_business;
    $Exempt_capital = floatval($calCapGain) + floatval($calForDiv);
    $Domestic_dividends = $calDomDiv;
    $surplus_interest_expense = $calIntExp - $Allowed_Limit;
    $Entertainment_Expenditure = $calEntExp * 0.5;
    $Not_wholy_or_fully_Business_expense = $calBusExp;
    $Transfer_pricing_adjustment = $calTraPri;

    // All Sum of Calculations
    // $calUnInoPart = 0.2;
    $Adjusted_Profit = floatval($Accounting_Income) + floatval($Property_Income) + floatval($Amount_of_unrealized_gains) + floatval($expenses_for_business) + floatval($Exempt_capital) + floatval($Domestic_dividends) + floatval($surplus_interest_expense) + floatval($Entertainment_Expenditure) + floatval($Not_wholy_or_fully_Business_expense) + floatval($Transfer_pricing_adjustment);

    if ($calType == 'unincorporated Partner ship') {
        $unincorporated_Partnership = $Adjusted_Profit * $calUnInoPart;
    } else {
        $unincorporated_Partnership = 0;
    }

    if ($calUnInoPart > 0.1 && $calType == 'unincorporated Partner ship') {
        $Taxable_Income = floatval($unincorporated_Partnership) + floatval($calCarLoss);
    } else {
        $Taxable_Income = floatval($Adjusted_Profit) + floatval($calCarLoss);
    }

    $First_375000_Exempt = $Taxable_Income > 375000 ? 375000 : $Taxable_Income;
    $Tax_Payable_9 = (floatval($Taxable_Income) - floatval($First_375000_Exempt)) * 0.09;

    $Tax_Liability = floatval($Tax_Payable_9) + floatval($Tax_credit_Foreign_Income);

    // Create an array with all variables
    $response = [
        'Accounting_Income' => $Accounting_Income,
        'Property_Income' => $Property_Income,
        'Amount_of_unrealized_gains' => $Amount_of_unrealized_gains,
        'expenses_for_business' => $expenses_for_business,
        'Exempt_capital' => $Exempt_capital,
        'Domestic_dividends' => $Domestic_dividends,
        'surplus_interest_expense' => $surplus_interest_expense,
        'Entertainment_Expenditure' => $Entertainment_Expenditure,
        'Not_wholy_or_fully_Business_expense' => $Not_wholy_or_fully_Business_expense,
        'Transfer_pricing_adjustment' => $Transfer_pricing_adjustment,
        'Adjusted_Profit' => $Adjusted_Profit,
        'unincorporated_Partnership' => $unincorporated_Partnership,
        'Taxable_Income' => $Taxable_Income,
        'First_375000_Exempt' => $First_375000_Exempt,
        'Tax_Payable_9' => $Tax_Payable_9,
        'Tax_Liability' => $Tax_Liability,
        'EBITDA' => $EBITDA,
        'Max_Limit' => $Max_Limit,
        'Allowed_Limit' => $Allowed_Limit,
        // ... and so on for other variables
    ];
    $responses = [
        'stdTax' => $stdTax,
        'stdTaxNCP' => $stdTaxNCP,
        'stdTaxCP' => $stdTaxCP,
        'salOthFZ' => $salOthFZ,
        'nonFZper' => $nonFZper,
        'deminins' => $deminins,
        'incFrom' => $incFrom,
        'calIncome' => $calIncome,
        'calCos' => $calCos,
        'calExp' => $calExp,
        'calAccInc' => $calAccInc,
        'calRelGain' => $calRelGain,
        'calProInc' => $calProInc,
        'calCapGain' => $calCapGain,
        'calDomDiv' => $calDomDiv,
        'calForDiv' => $calForDiv,
        'calReaBaseS' => $calReaBaseS,
        'calIntExp' => $calIntExp,
        'calDepAmot' => $calDepAmot,
        'calEntExp' => $calEntExp,
        'calBusExp' => $calBusExp,
        'calTraPri' => $calTraPri,
        'calUnInoPart' => $calUnInoPart,
        'calCarLoss' => $calCarLoss,
        'calType' => $calType,
        'fruits' => $fruits,
        'expenses_for_business' => $expenses_for_business,
        // '$Adjusted_Profit' => $$Adjusted_Profit,
        // ... and so on for other variables
    ];

    // Encode the array as JSON and echo it
    echo json_encode($response);
    echo json_encode($responses);
}
?>
