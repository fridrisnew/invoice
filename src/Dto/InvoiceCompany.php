<?php
namespace Fridris\Invoice\Dto;
use Barryvdh\DomPDF\Facade\Pdf;
use Fridris\Invoice\Models\Invoice as InvoiceModel;
use Illuminate\Support\Carbon;

class InvoiceCompany extends InvoiceData
{
    public function __construct()
    {
        $this->extra = new InvoiceExtra();
        $this->address = new InvoiceAddress();
    }

    public string $companyName;
    public InvoiceExtra $extra;
    public InvoiceAddress $address;
    public string $NIP;
}



