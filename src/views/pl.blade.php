<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<style>
    * {
        font-family: DejaVu Sans;
        font-size: 10px;
    }

    @page {
        margin: 120px 50px 80px 50px;
    }

    html, body {
    width: 94%;
    height: 100%;
    margin: 0 auto;
    padding: 0;
    background: #fff;
    color: #000;
    font-family: sans-serif;
    font-size: 12px;
}

strong { font-size: 1.5em; }

.left { float: left; }
.right { float: right; }

.text-left { text-align: left !important; }
.text-right { text-align: right !important; }
.text-center { text-align: center !important; }

.col50 { width: 50%; }
.col33 { width: 33%; }

.header {
    text-align: right;
    padding-top: 4em;
}

.footer {
    font-size: 0.75em;
    margin-top: 3em;
}

table {
    width: 100%;
    border-collapse: collapse;
}
table th {
    font-weight: normal;
}

table.grid th, table.grid td {
    border: 1px solid #000;
    vertical-align: text-top;
}
table.grid th {
    text-align: left;
    background: #eee;
}

table.contractors {
    font-size: 1.2em;
    margin-top: 6em;
}
table.contractors td, table.contractors th {
    padding: 5px;
}
table.contractors td p {
    line-height: 1.5em;
    padding: 0.2em;
    margin: 0;
}
table.contractors td p b {
    font-size: 1.2em;
}

table.items {
    font-size: 0.95em;
    margin-top: 6em;
}
table.items td, table.items th {
    padding: 6px;
}

table.details {
    margin-top: 6em;
}
table.details td {
    padding: 0.2em 1.5em;
}

table.signs {
    margin-top: 9em;
}
.page-break {
    page-break-after: always;
}
</style>
</head>
<body>

<div class="header">
    @isset($logo)
        <img src="{{$logo ?? '' }}" style="float: left; width:20%" />
    @endisset
    Faktura VAT nr. / VAT Invoice no: <strong>{{$invoiceReference ?? '' }}</strong><br />
    Oryginał / Original<br />
    Miejscowość / Place: <b>{{$placeOfIssue ?? '' }}</b><br />
    Data wystawienia / Date of issue: <b>{{$dateOfIssue ?? '' }}</b><br />
    Data sprzedaży / Date of sell: <b>{{$dateOfSell ?? '' }}</b><br />
</div>

<table class="grid contractors">
    <thead>
        <tr>
            <th class="col50"><b>Sprzedawca</b> (Seller)</th>
            <th class="col50"><b>Nabywca</b> (Buyer)</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>
                <p>
                    <b>{{$seller['companyName'] ?? '' }}</b><br />
                    {{$seller['address']['street'] ?? '' }}<br />
                    {{$seller['address']['city'] ?? '' }} {{$seller['address']['postCode'] ?? '' }}<br />
                    NIP {{$seller['NIP'] ?? '' }}<br />
                    {{$seller['extra']['Phone'] ?? '' }}<br />
                    {{$seller['extra']['Email'] ?? '' }}<br />
                    {{$seller['extra']['WWW'] ?? '' }}<br />
                </p>
            </td>
            <td>
                <p>
                    <b>{{$buyer['companyName'] ?? '' }}</b><br />
                    {{$buyer['address']['street'] ?? '' }}<br />
                    {{$buyer['address']['city'] ?? '' }} {{$buyer['address']['postCode'] ?? '' }}<br />
                    NIP {{$buyer['NIP'] ?? '' }}<br />
                    REGON {{$buyer['extra']['REGON'] ?? '' }}<br />
                    KRS {{$buyer['extra']['KRS'] ?? '' }}<br />
                    {{$buyer['extra']['Phone'] ?? '' }}<br />
                </p>
            </td>
        </tr>
    </tbody>
</table>

<table class="grid items">
    <thead>
        <tr>
            <th><b>L.p.</b><br />No</th>
            <th><b>Nazwa towaru lub usługi</b><br />Description</th>
            <th class="text-right"><b>Ilość</b><br />Quantity</th>
            <th class="text-right"><b>J.m.</b><br />Unit</th>
            <th class="text-right"><b>Cena netto</b><br />Net price</th>
            <th class="text-right"><b>Wartość netto</b><br />Net amount</th>
            <th class="text-right"><b>Stawka VAT</b><br />VAT Tax</th>
            <th class="text-right"><b>Kwota VAT</b><br>VAT amount</th>
            <th class="text-right"><b>Wartość brutto</b><br>Total amount</th>
        </tr>
    </thead>
    <tbody>
        @isset($items)
        @foreach ($items as $item)
            <tr>
                <td class="text-right">{{$loop->iteration ?? '' }}</td>
                <td>{{$item['description'] ?? '' }}</td>
                <td class="text-right">{{$item['quantity'] ?? '' }}</td>
                <td class="text-right">{{$item['unitName'] ?? '' }}</td>
                <td class="text-right">{{$item['unitNetPrice'] ?? '' }}</td>
                <td class="text-right">{{$item['totalNetAmount'] ?? '' }}</td>
                <td class="text-right">{{$item['taxPercentage'] ?? '' }}</td>
                <td class="text-right">{{$item['totalTaxAmount'] ?? '' }}</td>
                <td class="text-right">{{$item['totalAmount'] ?? '' }}</td>
            </tr>
        @endforeach
        @endisset
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td class="text-right"><b>Razem</b><br />Total</td>
            <td class="text-right">{{($totalNetAmount) ?? '' }}</td>
            <td></td>
            <td class="text-right">{{($totalNetAmount) ?? '' }}</td>
            <td class="text-right"><b>{{($totalAmount) ?? '' }}</b></td>
        </tr>
    </tbody>
</table>

<table class="details">
    <tbody>
        <tr>
            <td class="col33 text-right"><strong>Razem do zapłaty:</strong></td>
            <td><strong><strong>{{($totalAmount) ?? '' }} {{$currency ?? '' }}</strong></strong></td>
        </tr>
        <tr>
            <td class="col33 text-right">Sposób zapłaty:</td>
            <td>{{$paymentMethod ?? '' }}</td>
        </tr>
        <tr>
            <td class="col33 text-right">Termin zapłaty:</td>
            <td>{{($paymentDueToDate) ?? '' }}</td>
        </tr>
        <tr>
            <td class="col33 text-right">Numer rachunku:</td>
            <td>{{$bankIban ?? '' }} {{$bankName ?? '' }}</td>
        </tr>
    </tbody>
</table>

@if(!empty($issuedBy) || !empty($issuedBy))
<table class="details signs">
    <tbody>
        <tr>
            <td class="col50 text-center">..............................................................................</td>
            <td class="col50 text-center">..............................................................................</td>
        </tr>
        <tr>
            <td class="col50 text-center">Wystawił(a): {{$issuedBy ?? '' }}</td>
            <td class="col50 text-center">Odebrał(a): {{$signedBy ?? '' }}</td>
        </tr>
    </tbody>
</table>
@endif
</body>
</html>
