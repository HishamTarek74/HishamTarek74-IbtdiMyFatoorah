# Laravel Myfatoorah
laravel myfatoorah is a php package written by [Hisham Tarek](https://github.com/HishamTarek74) with laravel to handle myfatoorah functionality by making it's api more easy .

## Features
- Creating invoices
- Returning payments
- Check that payment is success or not
- Change the token on the fly

# Installation Guide
At laravel project install package using composer
```
composer require hesham.tarek/ibtdi-myfatoorah
```
The package is compatible with laravel ^6.0|^7.0|^8.0|^9.0 so you don't need to set providers or aliases for the package

## Configuration
To publish config run
```
php artisan vendor:publish --provider="HishamTarek\IbtdiMyFatoorah\IbtdiMyFatoorahServiceProvider"
```
and modify the config file with your own information. File is located in `/config/ibtdimyfatoorah.php`

## Get Your Credentials From Myfatoorah
- Go to [My fatorah](https://www.myfatoorah.com/)
- You will get access token
- Go to your .env file and paste your credentials to be like this

 ```
IBTDI_MYFATOORAH_MODE=test
IBTDI_MYFATOORAH_TOKEN=token
 ```
or you can add it using `setAccessToken($token?)->setMode($mode?)`

You are now ready to use the package

### Test cards page
You can get test cards from [DOCS](https://myfatoorah.readme.io/docs/test-cards)

### Usage examples

Create payment page
 ```
Route::get('payment', [\App\Http\Controllers\MyFatoorahController::class, 'index']);
Route::get('payment/callback', [\App\Http\Controllers\MyFatoorahController::class, 'callback']);
Route::get('payment/error', [\App\Http\Controllers\MyFatoorahController::class, 'error']);
 ```
At the controller, you can get the data from payment page at [DOCS](https://myfatoorah.readme.io/docs)
 ```
 use AymanElmalah\MyFatoorah\Facades\MyFatoorah;
 
 public function index() {
      $data = [
        'CustomerName' => 'New user',
        'NotificationOption' => 'all',
        'MobileCountryCode' => '+966',
        'CustomerMobile' => '0000000000',
        'DisplayCurrencyIso' => 'SAR',
        'CustomerEmail' => 'test@test.test',
        'InvoiceValue' => '100',
        'Language' => 'en',
        'CallBackUrl' => 'https://yourdomain.test/callback',
        'ErrorUrl' => 'https://yourdomain.test/error',
    ];

// If you want to set the credentials and the mode manually.
//    $myfatoorah = IbtdiMyFatoorah::setAccessToken($token)->setMode('test')->createInvoice($data);

// And this one if you need to access token from config
    $myfatoorah = IbtdiMyFatoorah::createInvoice($data);

  // when you got a response from myFatoorah API, you can redirect the user to the myfatoorah portal 
  return response()->json($myfatoorah);
}
 ```
## Get callback to check if success payment
  ```
  public function callback(Request $request) {
     $myfatoorah = IbtdiMyFatoorah::payment($request->paymentId);

     // It will check that payment is success or not
     // return response()->json($myfatoorah->isSuccess());
     
     // It will return payment response with all data
     return response()->json($myfatoorah->get());
  }
  ```

## Authors

- [Hisham Tarek](https://github.com/HishamTarek74)

## License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details

## Note

* If yo have any questions, issues or PRs feel free to contact me.
