<?php

return [

    /*
     * id -> incerement number
     * dd-> day
     * mm -> mounth
     * yyyy -> year
     */
    'format' => '{id}/{dd}/{mm}/FT/{yyyy}',
    'lang' => 'pl',
    'currency' => 'PLN',
    'require' => [
        'dateOfIssue',
        'dateOfSell',
        'seller.companyName',
        'seller.address',
        'seller.NIP',
        'buyer.companyName',
        'buyer.address',
        'buyer.NIP',
        'item.quantity',
       // 'item.description',
        'item.unitName',
        'item.unitNetPrice',
        'item.taxPercentage',
        'item.totalNetAmount',
        'item.totalTaxAmount',
        'item.totalAmount',
        'paymentMethod',
        'paymentDueToDate',
   //     'bankName',
   //     'bankIban',
        //totalNetAmount
    ],

];
