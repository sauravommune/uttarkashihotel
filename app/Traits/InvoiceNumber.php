<?php
namespace App\Traits;

use App\Models\AdminSettings;
use App\Models\Invoice;
use App\Models\InvoiceNumberGenerate;
use Carbon\Carbon;

trait InvoiceNumber {

    public function generateInvoiceNumber() 
    {
        $adminSettings = AdminSettings::select('invoice_settings')->first();
        $format = isset($adminSettings->invoice_settings['invoice_number_format']['format']) ? $adminSettings->invoice_settings['invoice_number_format']['format'] : 'monthly';

        switch($format) {
            case 'monthly':
                return $this->getMonthlyInvoiceNumber();
                break;
            case 'random_number':
                return $this->getRandomInvoiceNumber($adminSettings->invoice_settings['invoice_number_format']??[]);
                break;
            case 'random_string':
                return $this->getRandomStringInvoiceNumber($adminSettings->invoice_settings['invoice_number_format']??[]);
                break;
            default:
                return $this->getCustomInvoiceNumber($adminSettings->invoice_settings['invoice_number_format']??[]);
                break;
        }
    }

    private function getMonthlyInvoiceNumber()
    {
        $currentMonth = Carbon::now()->format('mY');
        $invoiceNumber = InvoiceNumberGenerate::firstOrCreate(
            ['format' => $currentMonth],
            ['number' => 0]
        );
        $invoiceNumber->increment('number');
        $formattedNumber = str_pad($invoiceNumber->number, 5, '0', STR_PAD_LEFT);
        return "{$invoiceNumber->format}-{$formattedNumber}";
    }

    public function getRandomInvoiceNumber($invoiceSettings) {
        $digits = $invoiceSettings['number_length'];
        do {
            $number = rand(pow(10, $digits - 1), pow(10, $digits) - 1);
        } while (Invoice::where('invoice_number', $number)->exists());
        return $number;
    }

    public function getRandomStringInvoiceNumber($invoiceSettings) {
        $digits = $invoiceSettings['str_length'];
        do {
            $string = random_str($digits);
        } while (Invoice::where('invoice_number', $string)->exists());
        return $string;
    }

    public function getCustomInvoiceNumber($invoiceSettings)
    {
        $strNumber = $invoiceSettings['str_number'];
        $incrementBy = (int) $invoiceSettings['str_number_increment'];

        if (preg_match("/\d+$/", $strNumber, $matches)) {
            $numberPart = $matches[0]; // Extract numeric part
            $prefix = rtrim($strNumber, $numberPart); // Extract prefix

            // Determine the latest invoice number based on the prefix
            $latestInvoice = Invoice::when($prefix, function ($query) use ($prefix) {
                $query->where('invoice_number', 'like', $prefix . '%');
            }, function ($query) use ($numberPart) {
                $query->where('invoice_number', $numberPart);
            })->orderBy('id', 'desc')->first();

            if (!$latestInvoice) {
                // If no previous invoice found, return the initial number
                return $strNumber;
            }

            // Extract the numeric part of the latest invoice
            preg_match("/\d+$/", $latestInvoice->invoice_number, $latestMatches);
            $latestNumber = isset($latestMatches[0]) ? (int) $latestMatches[0] : (int) $numberPart;

            // Generate the next invoice number
            do {
                $latestNumber += $incrementBy;
                $formattedNumber = sprintf("%0" . strlen($numberPart) . "d", $latestNumber);
                $newInvoiceNumber = $prefix . $formattedNumber;
            } while (Invoice::where('invoice_number', $newInvoiceNumber)->exists());

            return $newInvoiceNumber;
        }

        // Return the original string if no numeric part is found
        return $strNumber;
    }

}