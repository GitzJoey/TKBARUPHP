<?php

/**
 * Created by PhpStorm.
 * User: Sugito
 * Date: 9/10/2016
 * Time: 11:28 AM
 */

return [
    'SESSION' => [
        'USER_SO_LIST' => 'userSOs',
    ],

    'RANDOMSTRINGRANGE' => [
        'ALPHABET' => ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'J', 'K', 'M', 'N', 'O', 'P', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z'],
        'NUMERIC' => [3,4,7,9],
    ],

    'TRXCODE' => [
        'LENGTH' => 6,
    ],

    'DATETIME_FORMAT' => [
        'PHP_DATE' => 'd M Y',
        'PHP_TIME' => 'G:H A',
        'PHP_DATETIME' => 'd M Y G:H A',
        'DATABASE_DATETIME' => 'Y-m-d H:i:s',
        'JS_DATETIME' => 'YYYY-MM-DD hh:mm A'
    ],
        
    'DIGIT_GROUP_SEPARATOR' => ',',

    'DECIMAL_SEPARATOR' => '.',

    'DECIMAL_DIGIT' => 2,

    'PAGINATION' => 10,

    'LOOKUP_CATEGORY' => [
        'STATUS' => 'STATUS',
        'YESNOSELECT' => 'YESNOSELECT',
        'CURRENCY' => 'CURRENCY',
        'LANGUAGE' => 'LANGUAGE',
        'TRUCK_TYPE' => 'TRUCKTYPE',
        'PO_STATUS' => 'POSTATUS',
        'PO_TYPE' => 'POTYPE',
        'CUSTOMER_TYPE' => 'CUSTOMERTYPE',
        'SUPPLIER_TYPE' => 'CUSTOMERTYPE',
        'SO_STATUS' => 'SOSTATUS',
        'PAYMENT_TYPE' => 'PAYMENTTYPE',
        'CASH_PAYMENT_STATUS' => 'CASHPAYMENTSTATUS',
        'TRF_PAYMENT_STATUS' => 'TRFPAYMENTSTATUS',
        'GIRO_PAYMENT_STATUS' => 'GIROPAYMENTSTATUS',
        'TRUCK_MTC_TYPE' => 'TRUCKMTCTYPE',
        'USER_TYPE' => 'USERTYPE',
        'PRICELEVEL_TYPE' => 'PRICELEVELTYPE',
        'GIRO_STATUS' => 'GIROSTATUS',
        'ACC_CASH' => 'ACCCASH',
        'EXPENSE_TYPE' => 'EXPENSETYPE',
        'EMP_SALARY_ACTION' => 'EMPSALARYACTION',
        'STOCK_MERGE_TYPE' => 'STOCKMERGETYPE',
    ],

    'SETTING_KEY' => [

    ],
];