<?php

namespace app\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use App\Models\invoices;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
class InvoicesExport implements FromCollection, WithHeadingRow
{
    public function collection()
    {
        return invoices::all();
        //return invoices::select('invoice_number', 'invoice_Date', 'Due_date','Section', 'product', 'Amount_collection','Amount_Commission', 'Rate_VAT', 'Value_VAT','Total', 'Status', 'Payment_Date','note')->get();

    }
}