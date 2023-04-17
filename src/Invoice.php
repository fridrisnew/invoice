<?php

namespace Fridris\Invoice;

use Barryvdh\DomPDF\Facade\Pdf;
use Dompdf\Exception;
use Fridris\Invoice\Dto\InvoiceDetails;
use Fridris\Invoice\Dto\InvoiceItem;
use Fridris\Invoice\Models\Invoice as InvoiceModel;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class Invoice
{
    private $details = [];
    private $errors = [];

    public function __construct()
    {
    }

    public function create(InvoiceDetails $details): object|bool
    {
        DB::beginTransaction();
        try {
            $invoiceModel = InvoiceModel::create();
            $this->details = $details->toArray();

            $this->details['currency'] = config('invoice.currency', 'PLN');
            $this->details['invoiceReference'] = $this->_prepareId($invoiceModel->id);
            if (empty($this->details['dateOfIssue'])) {
                $this->details['dateOfIssue'] = Carbon::now()->format('m-d-y');
            }
            if (empty($this->details['dateOfSell'])) {
                $this->details['dateOfSell'] = Carbon::now()->format('m-d-y');
            }

            if ($this->_checkData()) {
                $invoiceModel->details = $this->details;
                $invoiceModel->save();
                DB::commit();
                return $this;
            } else {
                throw new \Exception("Errors in invoice:\n" . print_r($this->errors, true));
            }
        } catch (\Exception $ex) {
            DB::rollBack();
            throw  $ex;
        }
    }

    private function _prepareId($id)
    {
        $format = config('invoice.format');
        $format = str_replace('{id}', $id, $format);
        $format = str_replace('{yyyy}', Carbon::now()->format('Y'), $format);
        $format = str_replace('{mm}', Carbon::now()->format('m'), $format);
        $format = str_replace('{dd}', Carbon::now()->format('d'), $format);
        return $format;
    }

    private function _checkData()
    {
        $required = config('invoice.require');

        $this->errors = [];
        $itemsRequired = [];

        if (\Arr::has($this->details, 'logo')) {
            if (file_exists($this->details['logo'])) {
                $this->details['logo'] = $this->_imageTobase64($this->details['logo']);
            } else {
                $this->errors[] = 'logo';
            }
        }

        foreach ($required as $k => $r) {
            if (\Str::startsWith($r, 'item.')) {
                $r = \Str::replace('item.', '', $r);
                $itemsRequired[] = $r;
                continue;
            }

            if (!\Arr::has($this->details, $r)) {
                $this->errors[] = $r;
            }
        }
        if (!\Arr::has($this->details, 'items') && count($this->details) <= 0) {
            $this->errors[] = 'items';
        }

        //items
        foreach ($itemsRequired as $k => $r) {
            foreach ($this->details['items'] as $itemId => $item) {
                if (!\Arr::has($item, $r)) {
                    $this->errors[] = 'item.' . $itemId . '.' . $r;
                }
            }
        }


        return !(count($this->errors) > 0);
    }

    private function _imageTobase64($file_path)
    {
        return "data:image/png;base64," . base64_encode(file_get_contents($file_path));
    }

    public function getStream()
    {
        $html = view('invoice::' . config('invoice.lang', 'pl'))->with($this->details);
        $pdf = Pdf::loadHTML($html);//Pdf::loadView('pdf.invoice');
        return $pdf->stream();
    }

    private function _calcTotal()
    {
        /**
         * @var $item InvoiceItem
         */
        foreach ($this->details['items'] as $item) {
            $item->quantity;
        }
    }


}
