# Polish Invoices

### Install
    
    composer require fridris/invoice-pl

### Example

    Route::get('/test', function (Faker $faker) {
        $invdet = new \Fridris\Invoice\Dto\InvoiceDetails();
        $invdet->seller->NIP = '90998909809';
        $invdet->seller->companyName = 'Comapny 1';
        $invdet->seller->address->city = "Warszawa";
        $invdet->seller->address->postCode = "09-123";
        $invdet->seller->address->street = "Wysoka 23";
        $invdet->seller->extra->Email = 'test@test.pl';
        $invdet->seller->extra->Phone = '791990824';
    
        $invdet->buyer->NIP = '123123123';
        $invdet->buyer->companyName = 'TestComapny';
        $invdet->buyer->address->city = "Sopot";
        $invdet->buyer->address->postCode = "01-123";
        $invdet->buyer->address->street = "Niska 32";
        $invdet->buyer->extra->Email = 'testowa@test.pl';
        $invdet->buyer->extra->Phone = '791990822';
        $invdet->paymentMethod = 'Bramka Płatnicza';
    
        $invdet->paymentDueToDate = \Carbon\Carbon::now()->addDays(30)->format('m-d-y');
        for($i=0;$i<10;$i++){
            $item = new \Fridris\Invoice\Dto\InvoiceItem();
            $item->quantity = rand(0,100);
            $item->taxPercentage = 0.23;
            $item->totalAmount = rand(0,100);;
            $item->totalTaxAmount = $item->totalAmount * $item->taxPercentage;
            $item->totalNetAmount = $item->totalAmount -  $item->totalAmount * $item->taxPercentage;
            $item->unitName = "szt";
            $item->unitNetPrice = 1;
            $item->description = $faker->firstName();
    
            $invdet->items[] = $item;
        }
        $invdet->bankIban = $faker->iban();
        $invdet->logo = resource_path().(DIRECTORY_SEPARATOR.'photo'.DIRECTORY_SEPARATOR.'logo_mini_new.png');
        return Invoice::create($invdet)->getStream();
    });
