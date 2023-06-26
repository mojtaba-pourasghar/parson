<?php

namespace App\Http\Controllers;

use App\City;
use Illuminate\Http\Request;
use Shetabit\Multipay\Invoice;
use Shetabit\Multipay\Payment;

class IdpayController extends Controller
{
    public function payment()
    {
        /*
        # create new invoice
        $invoice = (new Invoice)->amount(1000);
        # purchase the given invoice
        Payment::addPayListener($invoice, function ($driver, $transactionId) {
            // we can store $transactionId in database
        });

        # purchase method accepts a callback function
        Payment::purchase($invoice, function ($driver, $transactionId) {
            // we can store $transactionId in database
        });
        # you can specify callbackUrl
        Payment::callbackUrl('http://127.0.0.1:8000/verify')->purchase(
            $invoice,
            function ($driver, $transactionId) {
                // we can store $transactionId in database
            }
        );*/
    }
}
