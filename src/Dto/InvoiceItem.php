<?php
namespace Fridris\Invoice\Dto;
use Barryvdh\DomPDF\Facade\Pdf;
use Fridris\Invoice\Models\Invoice as InvoiceModel;
use Illuminate\Support\Carbon;

class InvoiceItem extends InvoiceData
{
    public string $quantity;
    public string $unitName;
    public string $unitNetPrice;
    public string $totalNetAmount;
    public string $taxPercentage;
    public string $totalTaxAmount;
    public string $totalAmount;
    public string $description;
}
