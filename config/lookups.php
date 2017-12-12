<?php
/**
 * Created by PhpStorm.
 * User: gitzj
 * Date: 11/9/2017
 * Time: 4:21 PM
 */
return [
    'STATUS' => [
        'ACTIVE' => 'STATUS.ACTIVE',
        'INACTIVE' => 'STATUS.INACTIVE',
    ],
    'YESNOSELECT' => [
        'YES' => 'YESNOSELECT.YES',
        'NO' => 'YESNOSELECT.NO',
    ],
    'CURRENCY' => [
        'IDR' => 'CURRENCY.IDR',
        'USD' => 'CURRENCY.USD',
    ],
    'LANGUAGE' => [
        'INDONESIA' => 'LANGUAGE.IN',
        'ENGLISH' => 'LANGUAGE.EN',
    ],
    'TRUCK_TYPE' => [
        'OIL_8T' => 'TRUCKTYPE.OIL_8T',
        'CARGO_8T' => 'TRUCKTYPE.CARGO_8T',
        'CARGO_25T' => 'TRUCKTYPE.CARGO_25T',
    ],
    'PO_STATUS' => [
        'DRAFT' => 'POSTATUS.D',
        'WAITING_ARRIVAL' => 'POSTATUS.WA',
        'WAITING_PAYMENT' => 'POSTATUS.WP',
        'CLOSED' => 'POSTATUS.C',
    ],
    'PO_TYPE' => [
        'STANDARD' => 'POTYPE.S'
    ],
    'CUSTOMER_TYPE' => [
        'REGISTERED' => 'CUSTOMERTYPE.R',
        'WALK_IN' => 'CUSTOMERTYPE.WI',
    ],
    'SUPPLIER_TYPE' => [
        'REGISTERED' => 'CUSTOMERTYPE.R',
        'WALK_IN' => 'CUSTOMERTYPE.WI',
    ],
    'SO_TYPE' => [
        'STANDARD' => 'SOTYPE.S',
        'SERVICE' => 'SOTYPE.SVC',
        'AUTO_CASH' => 'SOTYPE.AC',
    ],
    'SO_STATUS' => [
        'DRAFT' => 'SOSTATUS.D',
        'WAITING_DELIVERY' => 'SOSTATUS.WD',
        'WAITING_CUST_CONFIRMATION' => 'SOSTATUS.WCC',
        'WAITING_APPROVAL' => 'SOSTATUS.WAPPV',
        'WAITING_PAYMENT' => 'SOSTATUS.WP',
        'CLOSED' => 'SOSTATUS.C',
        'REJECTED' => 'SOSTATUS.RJT',
    ],
    'PAYMENT_TYPE' => [
        'CASH' => 'PAYMENTTYPE.C',
        'TRANSFER' => 'PAYMENTTYPE.T',
        'GIRO' => 'PAYMENTTYPE.G',
    ],
    'CASH_PAYMENT_STATUS' => [
        'CONFIRMED' => 'CASHPAYMENTSTATUS.C',
    ],
    'TRF_PAYMENT_STATUS' => [
        'UNCONFIRMED' => 'TRFPAYMENTSTATUS.UNCONFIRMED',
        'CONFIRMED' => 'TRFPAYMENTSTATUS.CONFIRMED',
    ],
    'GIRO_PAYMENT_STATUS' => [
        'WAITING_EFFECTIVE_DATE' => 'GIROPAYMENTSTATUS.WE',
        'FAILED_RETURNED' => 'PAYMENTTYPE.FR',
    ],
    'TRUCK_MTC_TYPE' => [
        'REGULAR_CHECKUP' => 'TRUCKMTCTYPE.R',
        'TIRE_CHANGE' => 'TRUCKMTCTYPE.TR',
        'SPAREPART_CHANGE' => 'TRUCKMTCTYPE.SPC',
        'OIL_CHANGE' => 'TRUCKMTCTYPE.OC',
    ],
    'USER_TYPE' => [
        'ADMIN' => 'USERTYPE.A',
        'OWNER' => 'USERTYPE.O',
        'USER' => 'USERTYPE.U',
        'DRIVER' => 'USERTYPE.DR',
        'FRONTDESK' => 'USERTYPE.FD',
        'FINANCE' => 'USERTYPE.FIN',
        'CUSTOMER' => 'USERTYPE.C',
        'SUPPLIER' => 'USERTYPE.S',
    ],
    'PRICELEVEL_TYPE' => [
        'INCREMENT_VALUE' => 'PRICELEVELTYPE.INC',
        'PERCENTAGE_VALUE' => 'PRICELEVELTYPE.PCT',
    ],
    'GIRO_STATUS' => [
        'NEW' => 'GIROSTATUS.N',
        'USED_FOR_PAYMENT' => 'GIROSTATUS.UP',
        'RETURNED' => 'GIROSTATUS.R',
    ],
    'ACC_CASH' => [
        'CASH_ON_HAND' => 'ACCCASH.COH',
        'CASH_ON_BANK' => 'ACCCASH.COB',
    ],
    'EXPENSE_TYPE' => [
        'ADD' => 'EXPENSETYPE.ADD',
        'SUBTRACT' => 'EXPENSETYPE.SUB',
    ],
    'BANK_UPLOAD' => [
        'BCA' => 'BANKUPLOAD.BCA',
    ],
    'EMP_SALARY_ACTION' => [
        'SALARY' => 'EMPSALARYACTION.SALARY',
        'SALARY_PAYMENT' => 'EMPSALARYACTION.SALARY_PAYMENT',
        'BONUS' => 'EMPSALARYACTION.BONUS',
        'REIMBURSE' => 'EMPSALARYACTION.REIMBURSE',
        'SALARY_PAY_UPFRONT' => 'EMPSALARYACTION.SALARY_PAY_UPFRONT',
    ],
    'STOCK_MERGE_TYPE' => [
        'FIFO' => 'STOCKMERGETYPE.FIFO',
        'LIFO' => 'STOCKMERGETYPE.LIFO',
        'AVG' => 'STOCKMERGETYPE.AVG',
    ],
];