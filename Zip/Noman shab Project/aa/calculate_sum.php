 <?php

// Read the raw POST data
$jsonData = file_get_contents('php://input');

// Decode the JSON data
$data = json_decode($jsonData, true);

// Access the individual values
$cCompany = $data['cCompany'];
$cEmail = $data['cEmail'];
$cMobile = $data['cMobile'];
$cName = $data['cName'];
$startDate = $data['startDate'];
$stdTax = (float) str_replace(',', '', $data['stdTax']); // Your income from Qualifying transactions with free zone entities D41
$stdTaxNCP = (float) str_replace(',', '', $data['stdTaxNCP']); //Your Income from transactions with non freezone persons for Qualifying Activities D42
$stdTaxCP = (float) str_replace(',', '', $data['stdTaxCP']); // Your other income- Excluded/Non Qualifying income D43
$salOthFZ = (float) str_replace(',', '', $data['salOthFZ']); //Non commercial property Income D44
$nonFZper = (float) str_replace(',', '', $data['nonFZper']); //Commercial proprty income in FreeZone D45
$deminins = (float) str_replace(',', '', $data['deminins']);
$incFrom = (float) str_replace(',', '', $data['incFrom']);
$calIncome = (float) str_replace(',', '', $data['calIncome']);
$calCos = (float) str_replace(',', '', $data['calCos']);
$calExp = (float) str_replace(',', '', $data['calExp']);
$calAccInc = (float) str_replace(',', '', $data['calAccInc']);
$calRelGain = (float) str_replace(',', '', $data['calRelGain']);
$calProInc = (float) str_replace(',', '', $data['calProInc']);
$calCapGain = (float) str_replace(',', '', $data['calCapGain']);
$calDomDiv = (float) str_replace(',', '', $data['calDomDiv']);
$calForDiv = (float) str_replace(',', '', $data['calForDiv']);
$calReaBaseS = $data['calReaBaseS'];
$calIntExp = (float) str_replace(',', '', $data['calIntExp']);
$calDepAmot = (float) str_replace(',', '', $data['calDepAmot']);
$calEntExp = (float) str_replace(',', '', $data['calEntExp']);
$calBusExp = (float) str_replace(',', '', $data['calBusExp']);
$calTraPri = (float) str_replace(',', '', $data['calTraPri']);
$calUnInoPart = (float) str_replace(',', '', $data['calUnInoPart']);
$calCarLoss = (float) str_replace(',', '', $data['calCarLoss']);
$calType = $data['calType'];
$fruits = (float) str_replace(',', '', $data['fruits']);
$expenses_for_business = (float) str_replace(',', '', $data['expenses_for_business']);
$tax_credit_foreign_income = (float) str_replace(',', '', $data['tax_credit_foreign_income']);

// ... and so on for other values

$dateParts = explode('-', $startDate);
$aYear = $dateParts[0];

if ($calType == 'FreeZone') {
    $Total_Income = $stdTax + $stdTaxNCP + $stdTaxCP + $salOthFZ;
    $Other_Income = $stdTaxCP;
    $Deminis_Limit_1 = 5000000;
    // =(D44+D43)/SUM(D41:D44)
    $formattedResult = ($salOthFZ + $stdTaxCP) / $Total_Income;

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
    $Taxable_Income_9 = $Total_Income - $Qualifying_Income;

    $D49 = 0;
    $Tax_Payable = ($Taxable_Income_9 - $D49) * 0.09;

    // Create an array with all variables
    $response = [
        'aYear' => $aYear,
        'cCompany' => $cCompany,
        'cEmail' => $cEmail,
        'cMobile' => $cMobile,
        'cName' => $cName,
        'calType' => $calType,
        'Tax_Payable' => $Tax_Payable,
        'Taxable_Income_9' => $Taxable_Income_9,
        'Qualifying_Income' => $Qualifying_Income,
        'Deminins_tests_Result' => $Deminins_tests_Result,
        'Deminis_Limit_2' => $Deminis_Limit_2,
    ];
    // Output the result
    echo json_encode($response);
} else {
    // Tax Calculation

    // Net Interest Computation

    $EBITDA = ($calAccInc + $calIntExp + $calDepAmot) * 0.3;

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
    $Exempt_capital = $calCapGain + $calForDiv;
    $Domestic_dividends = $calDomDiv;
    $surplus_interest_expense = $calIntExp - $Allowed_Limit;
    $Entertainment_Expenditure = $calEntExp * 0.5;
    $Not_wholy_or_fully_Business_expense = $calBusExp;
    $Transfer_pricing_adjustment = $calTraPri;

    // All Sum of Calculations
    $Adjusted_Profit = $Accounting_Income + $Property_Income + $Amount_of_unrealized_gains + $expenses_for_business + $Exempt_capital + $Domestic_dividends + $surplus_interest_expense + $Entertainment_Expenditure + $Not_wholy_or_fully_Business_expense + $Transfer_pricing_adjustment;

    if ($calType == 'Unincorporated Partner Ship') {
        // $calUnInoPart = 20;
        $unincorporated_Partnership = ($Adjusted_Profit * $calUnInoPart) / 100;
    } else {
        $unincorporated_Partnership = 0;
    }

    if ($calUnInoPart > 0.1 && $calType == 'Unincorporated Partner Ship') {
        $Taxable_Income = $unincorporated_Partnership + $calCarLoss;
    } else {
        $Taxable_Income = $Adjusted_Profit + $calCarLoss;
    }

    $First_375000_Exempt = $Taxable_Income > 375000 ? 375000 : $Taxable_Income;
    $Tax_Payable_9 = ($Taxable_Income - $First_375000_Exempt) * 0.09;

    $tax_credit_foreign_income = $tax_credit_foreign_income;

    $Tax_Liability = $Tax_Payable_9 + $tax_credit_foreign_income;
    // Convert numerical values to actual numbers

    // Create an array with all variables
    $response = [
        'aYear' => $aYear,
        'cCompany' => $cCompany,
        'cEmail' => $cEmail,
        'cMobile' => $cMobile,
        'cName' => $cName,
        'calProInc' => $calProInc,
        'calType' => $calType,
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
        'calCarLoss' => $calCarLoss,
        'Taxable_Income' => $Taxable_Income,
        'First_375000_Exempt' => $First_375000_Exempt,
        'Tax_Payable_9' => $Tax_Payable_9,
        'tax_credit_foreign_income' => $tax_credit_foreign_income,
        'Tax_Liability' => $Tax_Liability,
        'EBITDA' => $EBITDA,
        'Max_Limit' => $Max_Limit,
        'Allowed_Limit' => $Allowed_Limit,
        // ... and so on for other variables
    ];

    // Create an array with all variables
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
        'tax_credit_foreign_income' => $tax_credit_foreign_income,
        // ... and so on for other variables
    ];

    // Encode the array as JSON and echo it
    echo json_encode($response);
}
?>
