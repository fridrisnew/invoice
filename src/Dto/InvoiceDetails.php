<?php
namespace Fridris\Invoice\Dto;
use Barryvdh\DomPDF\Facade\Pdf;
use Fridris\Invoice\Models\Invoice as InvoiceModel;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
class InvoiceDetails extends InvoiceData
{
    public function __construct()
    {
        $this->seller = new InvoiceCompany();
        $this->buyer = new InvoiceCompany();
    }

    public string $dateOfIssue;
    public string $dateOfSell;
    public string $placeOfIssue;
    public string $logo;
    public InvoiceCompany $seller;
    public InvoiceCompany $buyer;
    //InvoiceItem
    /**
     * @use \Fridris\Invoice\InvoiceItem
     */
    public array $items;

    public string $paymentMethod;
    public string $paymentDueToDate;
    public string $bankIban;
    public string $bankName;
}
