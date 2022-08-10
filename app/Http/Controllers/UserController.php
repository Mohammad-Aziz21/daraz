<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Post;
use DateTime;
use mysql_xdevapi\Table;

class UserController extends Controller
{

    public function myorderfetch()
    {
        $orderdata = DB::table('items')->select('Name','Status','CreatedAt','productMainImage','OrderId')->orderByDesc('CreatedAt')->get();
        $final_data = json_decode($orderdata , true);
//        echo '<pre>';
//        print_r($final_data);
//        echo '</pre>';

        foreach ($final_data as $arzam)
        {
            echo "<br>";
            echo "Name:  " , $arzam['Name'];
            echo "<br>";
            echo "Status:  " , $arzam['Status'];
            echo "<br>";

            $quantity = DB::Table('orders')->select('CustomerFirstName','ItemsCount','OrderId','account_email')->where('OrderId',$arzam['OrderId'])->orderByDesc('CreatedAt')->get();
            $quantity2 = json_decode($quantity , true);
            foreach ($quantity2 as $arzam2)
            {
                echo "Customer Name:  " ,$arzam2['CustomerFirstName'];
                echo "<br>";
                echo "Quantity:  " ,$arzam2['ItemsCount'];
                echo "<br>";
                echo "Account Name:  ",$arzam2['account_email'];
                echo "<br>";

            }
            echo "Date:  " , $arzam['CreatedAt'];
            echo "<br>";


            ?>
            <html>
            <body>

                <img src=' <?php echo $arzam['productMainImage']; ?>' width="150" height="150" >
                </body>
                </html>

                <?php
            echo "<br>";
            echo "<br>";

        }


    }

   public function get_payout($id){

          ini_set('max_execution_time', -1);
        $procounter = 0;
        $MyAccountID = $id;
        $credential = DB::table('accounts')->select('api_key', 'account_email', 'account_name', 'account_id')->where('account_id', $MyAccountID)->get();
        $resp2 = json_decode($credential, true);
       // echo '<pre>';
       // print_r($resp2);
       // echo '</pre>';

         //date_default_timezone_set("UTC");
        $now = new DateTime();
        $parameters = array(
            // The ID of the user making the call.
            'UserID' => $resp2[0]['account_email'],
            // The API version. Currently must be 1.0
            'Version' => '1.0',
            // The API method to call.
            'Action' => 'GetPayoutStatus',
            // The format of the result.
            'Format' => 'JSON',

             //'startTime'=>'2020-08-01',

             'CreatedAfter'=>'2020-08-01',

            // 'transType'=>13,
            //'Limit' => '50',
//            'Offset' => '40',
           // The current time in ISO8601 format
 'Timestamp' => $now->format(DateTime::ISO8601)


        );
// Sort parameters by name.
        ksort($parameters);
// URL encode the parameters.
        $encoded = array();
        foreach ($parameters as $name => $value) {
            $encoded[] = rawurlencode($name) . '=' . rawurlencode($value);
        }
// Concatenate the sorted and URL encoded parameters into a string.
        $concatenated = implode('&', $encoded);
// The API key for the user as generated in the Seller Center GUI.
// Must be an API key associated with the UserID parameter.
        $api_key = $resp2[0]['api_key'];
// Compute signature and add it to the parameters.
        $parameters['Signature'] =
            rawurlencode(hash_hmac('sha256', $concatenated, $api_key, false));

// Replace with the URL of your API host.
        $url = "https://api.sellercenter.daraz.pk/?";
// Build Query String
        $queryString = http_build_query($parameters, '', '&',
            PHP_QUERY_RFC3986);

// Open cURL connection
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url . $queryString);
// Save response to the variable $data
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        $data = curl_exec($ch);
// Close Curl connection
        curl_close($ch);
        $resp = json_decode($data, true);

               echo '<pre>';
       print_r($resp);
       echo '</pre>';

       //echo $url . $queryString;


    }

    public function get_transaction($id){

          ini_set('max_execution_time', -1);
        $procounter = 0;
        $MyAccountID = $id;
        $credential = DB::table('accounts')->select('api_key', 'account_email', 'account_name', 'account_id')->where('account_id', $MyAccountID)->get();
        $resp2 = json_decode($credential, true);
       // echo '<pre>';
       // print_r($resp2);
       // echo '</pre>';

         //date_default_timezone_set("UTC");
        $now = new DateTime();
        $parameters = array(
            // The ID of the user making the call.
            'UserID' => $resp2[0]['account_email'],
            // The API version. Currently must be 1.0
            'Version' => '1.0',
            // The API method to call.
            'Action' => 'GetTransactionDetails',
            // The format of the result.
            'Format' => 'JSON',

            'startTime'=>'2020-08-01',

            'endTime'=>'2020-08-14',

            'transType'=>13,
            //'Limit' => '50',
//            'Offset' => '40',
           // The current time in ISO8601 format
 'Timestamp' => $now->format(DateTime::ISO8601)


        );
// Sort parameters by name.
        ksort($parameters);
// URL encode the parameters.
        $encoded = array();
        foreach ($parameters as $name => $value) {
            $encoded[] = rawurlencode($name) . '=' . rawurlencode($value);
        }
// Concatenate the sorted and URL encoded parameters into a string.
        $concatenated = implode('&', $encoded);
// The API key for the user as generated in the Seller Center GUI.
// Must be an API key associated with the UserID parameter.
        $api_key = $resp2[0]['api_key'];
// Compute signature and add it to the parameters.
        $parameters['Signature'] =
            rawurlencode(hash_hmac('sha256', $concatenated, $api_key, false));

// Replace with the URL of your API host.
        $url = "https://api.sellercenter.daraz.pk/?";
// Build Query String
        $queryString = http_build_query($parameters, '', '&',
            PHP_QUERY_RFC3986);

// Open cURL connection
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url . $queryString);
// Save response to the variable $data
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        $data = curl_exec($ch);
// Close Curl connection
        curl_close($ch);
        $resp = json_decode($data, true);

               echo '<pre>';
       print_r($resp);
       echo '</pre>';

       //echo $url . $queryString;


    }


    public function products($id)
    {
        ini_set('max_execution_time', -1);
        $procounter = 0;
        $MyAccountID = $id;
        $credential = DB::table('accounts')->select('api_key', 'account_email', 'account_name', 'account_id')->where('account_id', $MyAccountID)->get();
        $resp2 = json_decode($credential, true);
//        echo '<pre>';
//        print_r($resp2);
//        echo '</pre>';

        date_default_timezone_set("UTC");
        $now = new DateTime();
        $parameters = array(
            // The ID of the user making the call.
            'UserID' => $resp2[0]['account_email'],
            // The API version. Currently must be 1.0
            'Version' => '1.0',
            // The API method to call.
            'Action' => 'GetProducts',
            // The format of the result.
            'Format' => 'JSON',
            //'Limit' => '50',
//            'Offset' => '40',
            // The current time in ISO8601 format
            'Timestamp' => $now->format(DateTime::ISO8601)

        );
// Sort parameters by name.
        ksort($parameters);
// URL encode the parameters.
        $encoded = array();
        foreach ($parameters as $name => $value) {
            $encoded[] = rawurlencode($name) . '=' . rawurlencode($value);
        }
// Concatenate the sorted and URL encoded parameters into a string.
        $concatenated = implode('&', $encoded);
// The API key for the user as generated in the Seller Center GUI.
// Must be an API key associated with the UserID parameter.
        $api_key = $resp2[0]['api_key'];
// Compute signature and add it to the parameters.
        $parameters['Signature'] =
            rawurlencode(hash_hmac('sha256', $concatenated, $api_key, false));

// Replace with the URL of your API host.
        $url = "https://api.sellercenter.daraz.pk/?";
// Build Query String
        $queryString = http_build_query($parameters, '', '&',
            PHP_QUERY_RFC3986);

// Open cURL connection
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url . $queryString);
// Save response to the variable $data
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        $data = curl_exec($ch);
// Close Curl connection
        curl_close($ch);
        $resp = json_decode($data, true);
        $totalproducts = $resp['SuccessResponse']['Body']['TotalProducts'];
        $apiproducts = $resp['SuccessResponse']['Body']['Products'];

        echo $totalproducts;
//        echo '<pre>';
//        print_r($resp);
//        echo '</pre>';
//
        //exit();

        //$page=0;

        while (!empty($apiproducts)) {
            sleep(2);
            //echo $procounter;

            $parameters = array(
                // The ID of the user making the call.
                'UserID' => $resp2[0]['account_email'],
                // The API version. Currently must be 1.0
                'Version' => '1.0',
                // The API method to call.
                'Action' => 'GetProducts',
                // The format of the result.
                'Format' => 'JSON',
                'Limit' => '50',
                'Offset' => $procounter,
                // The current time in ISO8601 format
                'Timestamp' => $now->format(DateTime::ISO8601)

            );
// Sort parameters by name.
            ksort($parameters);
// URL encode the parameters.
            $encoded = array();
            foreach ($parameters as $name => $value) {
                $encoded[] = rawurlencode($name) . '=' . rawurlencode($value);
            }
// Concatenate the sorted and URL encoded parameters into a string.
            $concatenated = implode('&', $encoded);
// The API key for the user as generated in the Seller Center GUI.
// Must be an API key associated with the UserID parameter.
            $api_key = $resp2[0]['api_key'];
// Compute signature and add it to the parameters.
            $parameters['Signature'] =
                rawurlencode(hash_hmac('sha256', $concatenated, $api_key, false));

// Replace with the URL of your API host.
            $url = "https://api.sellercenter.daraz.pk/?";
// Build Query String
            $queryString = http_build_query($parameters, '', '&',
                PHP_QUERY_RFC3986);
// Open cURL connection
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url . $queryString);
// Save response to the variable $data
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            $data = curl_exec($ch);
// Close Curl connection
            curl_close($ch);


//            if($page==3){echo 'extraa';echo $data;exit();}

            $resp = json_decode($data, true);
            $apiproducts = $resp['SuccessResponse']['Body']['Products'];
            echo "<br>";
            echo '<div><span style="margin-top: 10px; margin-bottom: 10px; font-size: 20px; color: #000; font-weight: bold; margin-left: 150px;">Account Name : ' . $resp2[0]['account_name'] . ' </span> </div>';
            echo "<br>";
            echo '<div><span style="margin-top: 10px; margin-bottom: 10px; font-size: 20px; color: #000; font-weight: bold; margin-left: 150px;">Total Number of Products : ' . $totalproducts . ' </span> </div>';
            echo "<br>";
       //     if($page==4){
       //      echo $procounter;
       //      echo '<pre>';
       //     print_r($resp);
       //     echo '</pre>';exit();
       // }


            //exit();

            foreach ($apiproducts as $products) {
                //echo 'inhere';
                $procounter++;
                $productst = array(
                    'primary_category' => $products['PrimaryCategory'],
                    'item_id' => $products['ItemId'],
                    'name' => $products['Attributes']['name'],
                    'short_description' => $products['Attributes']['short_description'],
                    'description' => $products['Attributes']['description'],
                    'brand' => $products['Attributes']['brand'],
                    'description_en' => $products['Attributes']['description_en'],

                    'Status' => $products['Skus'][0]['Status'],
                    'quantity' => $products['Skus'][0]['quantity'],
                    'image0' => $products['Skus'][0]['Images']['0'],
                    'image1' => $products['Skus'][0]['Images']['1'],
                    'image2' => $products['Skus'][0]['Images']['2'],
                    'image3' => $products['Skus'][0]['Images']['3'],
                    'image4' => $products['Skus'][0]['Images']['4'],
                    'SellerSku' => $products['Skus'][0]['SellerSku'],
                    'ShopSku' => $products['Skus'][0]['ShopSku'],
//                    'package_content' => $products['Skus'][0]['package_content'],
                    'Url' => $products['Skus'][0]['Url'],
                    'package_width' => $products['Skus'][0]['package_width'],

                    'package_height' => $products['Skus'][0]['package_height'],
                    'special_price' => $products['Skus'][0]['special_price'],
                    'price' => $products['Skus'][0]['price'],
                    'package_length' => $products['Skus'][0]['package_length'],
//                 'special_from_date' => $products['Skus'][0]['special_from_date'],
//                 'special_from_time' => $products['Skus'][0]['special_from_time'],
//                 'special_time_format' => $products['Skus'][0]['special_time_format'],
                    'package_weight' => $products['Skus'][0]['package_weight'],
                    'Available' => $products['Skus'][0]['Available'],
                    'SkuId' => $products['Skus'][0]['SkuId'],
//                 'special_to_date' => $products['Skus'][0]['special_to_date'],
//                 'special_to_time' => $products['Skus'][0]['special_to_time'],
                    'account_email_id' => $parameters['UserID'],
                );

                if (array_key_exists('warranty_type', $products['Attributes'])) {
                    $productst['warranty_type'] = $products['Attributes']['warranty_type'];
                } else {
                    $productst['warranty_type'] = 'No Warranty Exists';
                }

                if (array_key_exists('color_family', $products['Skus'][0])) {
                    $productst['color_family'] = $products['Skus'][0]['color_family'];

                } else {
                    $productst['color_family'] = 'None';
                }
                if (array_key_exists('special_from_date', $products['Skus'][0])) {
                    $productst['special_from_date'] = $products['Skus'][0]['special_from_date'];

                } else {
                    $productst['special_from_date'] = 'None';
                }
                if (array_key_exists('special_from_time', $products['Skus'][0])) {
                    $productst['special_from_time'] = $products['Skus'][0]['special_from_time'];

                } else {
                    $productst['special_from_time'] = 'None';
                }
                if (array_key_exists('special_time_format', $products['Skus'][0])) {
                    $productst['special_time_format'] = $products['Skus'][0]['special_time_format'];

                } else {
                    $productst['special_time_format'] = 'None';
                }
                if (array_key_exists('special_to_date', $products['Skus'][0])) {
                    $productst['special_to_date'] = $products['Skus'][0]['special_to_date'];

                } else {
                    $productst['special_to_date'] = 'None';
                }
                if (array_key_exists('special_to_date', $products['Skus'][0])) {
                    $productst['special_to_time'] = $products['Skus'][0]['special_to_time'];

                } else {
                    $productst['special_to_time'] = 'None';
                }

                if (array_key_exists('package_content', $products['Skus'][0])) {
                    $productst['package_content'] = $products['Skus'][0]['package_content'];
                } else {
                    $productst['package_content'] = 'None';
                }


//
//                echo '<pre>';
//                print_r($productst);
//                echo '</pre>';

                $verify = DB::table('products')->where('item_id', $products['ItemId'])->select('item_id')->get();
                $final_verify = json_decode($verify, true);

                if ($final_verify != Null) {
                    DB::table('products')->where('item_id', $products['ItemId'])->update($productst);
                    $fetched_AccountID = DB::table('accounts')->select('account_id')->where('account_email', $parameters['UserID'])->get();
                    $fetched_ProductID = DB::table('products')->select('product_id')->where('item_id', $products['ItemId'])->get();
                    DB::table('accounts_products')->update(['account_id' => $fetched_AccountID[0]->account_id, 'product_id' => $fetched_ProductID[0]->product_id]);
                } else {
                    DB::table('products')->insert($productst);
                    $fetched_AccountID = DB::table('accounts')->select('account_id')->where('account_email', $parameters['UserID'])->get();
                    $fetched_ProductID = DB::table('products')->select('product_id')->where('item_id', $products['ItemId'])->get();
                    DB::table('accounts_products')->insert(['account_id' => $fetched_AccountID[0]->account_id, 'product_id' => $fetched_ProductID[0]->product_id]);
                }

            }
            //$page++;
            //if($page>1){echo $procounter;exit();}
        }
        
    }

    public function orders($id)
    {
ini_set('max_execution_time', -1);
        $ordercounter = 0;
        $MyAccountID = $id;
        $credential = DB::table('accounts')->select('api_key', 'account_email', 'account_name', 'account_id')->where('account_id', $MyAccountID)->get();
        $resp2 = json_decode($credential, true);
//        echo '<pre>';
//        print_r($resp2);
//        echo '</pre>';

// It's only needed if timezone in php.ini is not set correctly.
        date_default_timezone_set("UTC");
// The current time. Needed to create the Timestamp parameter below.
        $now = new DateTime();
// The parameters for the GET request. These will get signed.
        $parameters = array(
            // The ID of the user making the call.
            'UserID' => $resp2[0]['account_email'],
            // The API version. Currently must be 1.0
            'Version' => '1.0',
            // The API method to call.
            'Action' => 'GetOrders',
            // The format of the result.
            'Format' => 'JSON',
            'Limit' => '50',
            //'Offset' => '1',
            // The current time in ISO8601 format
            'Timestamp' => $now->format(DateTime::ISO8601)

        );
// Sort parameters by name.
        ksort($parameters);
// URL encode the parameters.
        $encoded = array();
        foreach ($parameters as $name => $value) {
            $encoded[] = rawurlencode($name) . '=' . rawurlencode($value);
        }
// Concatenate the sorted and URL encoded parameters into a string.
        $concatenated = implode('&', $encoded);
// The API key for the user as generated in the Seller Center GUI.
// Must be an API key associated with the UserID parameter.
        $api_key = $resp2[0]['api_key'];
// Compute signature and add it to the parameters.
        $parameters['Signature'] =
            rawurlencode(hash_hmac('sha256', $concatenated, $api_key, false));

// Replace with the URL of your API host.
        $url = "https://api.sellercenter.daraz.pk/?";
// Build Query String
        $queryString = http_build_query($parameters, '', '&',
            PHP_QUERY_RFC3986);
// Open cURL connection
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url . $queryString);
// Save response to the variable $data
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        $data = curl_exec($ch);
// Close Curl connection
        curl_close($ch);


        $resp = json_decode($data, true);
        $totalorders = $resp['SuccessResponse']['Head']['TotalCount'];

        while ($ordercounter != $totalorders) {
//            sleep(2);

            date_default_timezone_set("UTC");
// The current time. Needed to create the Timestamp parameter below.
            $now = new DateTime();
// The parameters for the GET request. These will get signed.
            $parameters = array(
                // The ID of the user making the call.
                'UserID' => $resp2[0]['account_email'],
                // The API version. Currently must be 1.0
                'Version' => '1.0',
                // The API method to call.
                'Action' => 'GetOrders',
                // The format of the result.
                'Format' => 'JSON',
                'Limit' => '50',
                'Offset' => $ordercounter ,
                // The current time in ISO8601 format
                'Timestamp' => $now->format(DateTime::ISO8601)

            );
// Sort parameters by name.
            ksort($parameters);
// URL encode the parameters.
            $encoded = array();
            foreach ($parameters as $name => $value) {
                $encoded[] = rawurlencode($name) . '=' . rawurlencode($value);
            }
// Concatenate the sorted and URL encoded parameters into a string.
            $concatenated = implode('&', $encoded);
// The API key for the user as generated in the Seller Center GUI.
// Must be an API key associated with the UserID parameter.
            $api_key = $resp2[0]['api_key'];
// Compute signature and add it to the parameters.
            $parameters['Signature'] =
                rawurlencode(hash_hmac('sha256', $concatenated, $api_key, false));

// Replace with the URL of your API host.
            $url = "https://api.sellercenter.daraz.pk/?";
// Build Query String
            $queryString = http_build_query($parameters, '', '&',
                PHP_QUERY_RFC3986);
// Open cURL connection
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url . $queryString);
// Save response to the variable $data
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            $data = curl_exec($ch);
// Close Curl connection
            curl_close($ch);

            $apiorders = $resp['SuccessResponse']['Body']['Orders'];

            echo "<br>";
            echo '<div><span style="margin-top: 10px; margin-bottom: 10px; font-size: 20px; color: #000; font-weight: bold; margin-left: 150px;">Account Name : ' . $resp2[0]['account_name'] . ' </span> </div>';
            echo "<br>";
            echo '<div><span style="margin-top: 10px; margin-bottom: 10px; font-size: 20px; color: #000; font-weight: bold; margin-left: 150px;">Total Number of Orders : ' . sizeof($apiorders) . ' </span> </div>';
            echo "<br>";

//        echo '<pre>';
//        print_r($apiorders);
//        echo '</pre>';

            //echo sizeof($apiorders);

            foreach ($apiorders as $orders) {
                $ordercounter++;
                $orders = array(

                    'OrderId' => $orders['OrderId'],
                    'account_email' => $parameters['UserID'],
                    'CustomerFirstName' => $orders['CustomerFirstName'],
                    'CustomerLastName' => $orders['CustomerLastName'],
                    'OrderNumber' => $orders['OrderNumber'],
                    'PaymentMethod' => $orders['PaymentMethod'],
                    'Remarks' => $orders['Remarks'],
                    'DeliveryInfo' => $orders['DeliveryInfo'],
                    'Price' => $orders['Price'],
                    'GiftOption' => $orders['GiftOption'],
                    'GiftMessage' => $orders['GiftMessage'],
                    'VoucherCode' => $orders['VoucherCode'],
                    'CreatedAt' => $orders['CreatedAt'],
                    'UpdatedAt' => $orders['UpdatedAt'],
                    'shipping_FirstName' => $orders['AddressShipping']['FirstName'],
                    'shipping_LastName' => $orders['AddressShipping']['LastName'],
                    'shipping_Phone' => $orders['AddressShipping']['Phone'],
                    'shipping_Phone2' => $orders['AddressShipping']['Phone2'],
                    'shipping_Address1' => $orders['AddressShipping']['Address1'],
                    'shipping_Address2' => $orders['AddressShipping']['Address2'],
                    'shipping_Address3' => $orders['AddressShipping']['Address3'],
                    'shipping_Address4' => $orders['AddressShipping']['Address4'],
                    'shipping_Address5' => $orders['AddressShipping']['Address5'],
                    'shipping_CustomerEmail' => $orders['AddressShipping']['CustomerEmail'],
                    'shipping_City' => $orders['AddressShipping']['City'],
                    'shipping_PostCode' => $orders['AddressShipping']['PostCode'],
                    'shipping_Country' => $orders['AddressShipping']['Country'],
                    'shipping_TreeAddressId' => $orders['AddressShipping']['TreeAddressId'],
                    'billing_FirstName' => $orders['AddressBilling']['FirstName'],
                    'billing_LastName' => $orders['AddressBilling']['LastName'],
                    'billing_Phone' => $orders['AddressBilling']['Phone'],
                    'billing_Phone2' => $orders['AddressBilling']['Phone2'],
                    'billing_Address1' => $orders['AddressBilling']['Address1'],
                    'billing_Address2' => $orders['AddressBilling']['Address2'],
                    'billing_Address3' => $orders['AddressBilling']['Address3'],
                    'billing_Address4' => $orders['AddressBilling']['Address4'],
                    'billing_Address5' => $orders['AddressBilling']['Address5'],
                    'billing_CustomerEmail' => $orders['AddressBilling']['CustomerEmail'],
                    'billing_City' => $orders['AddressBilling']['City'],
                    'billing_PostCode' => $orders['AddressBilling']['PostCode'],
                    'billing_Country' => $orders['AddressBilling']['Country'],
                    'billing_TreeAddressId' => $orders['AddressBilling']['TreeAddressId'],
                    'NationalRegistrationNumber' => $orders['NationalRegistrationNumber'],
                    'ItemsCount' => $orders['ItemsCount'],
                    'PromisedShippingTimes' => $orders['PromisedShippingTimes'],
                    'ExtraAttributes' => $orders['ExtraAttributes'],
                    'Statuses' => $orders['Statuses']['0'],
                    'Voucher' => $orders['Voucher'],
                    'ShippingFee' => $orders['ShippingFee'],
                    'TaxCode' => $orders['TaxCode'],
                    'BranchNumber' => $orders['BranchNumber'],
                );

                echo '<pre>';
                echo 'Order Id: ';
                print_r($orders['OrderId']);
                echo "<br>";
                echo 'Customer Name: ';
                print_r($orders['shipping_FirstName']);


                echo '</pre>';


                sleep(1);


// It's only needed if timezone in php.ini is not set correctly.
                date_default_timezone_set("UTC");
// The current time. Needed to create the Timestamp parameter below.
                $now = new DateTime();
// The parameters for the GET request. These will get signed.
                $parameters = array(
                    // The ID of the user making the call.
                    'UserID' => $resp2[0]['account_email'],
                    // The API version. Currently must be 1.0
                    'Version' => '1.0',
                    // The API method to call.
                    'Action' => 'GetOrderItems',
                    'OrderId' => $orders['OrderId'],
                    // The format of the result.
                    'Format' => 'JSON',
                    'Limit' => '50',

                    // The current time in ISO8601 format
                    'Timestamp' => $now->format(DateTime::ISO8601)

                );
// Sort parameters by name.
                ksort($parameters);
// URL encode the parameters.
                $encoded = array();
                foreach ($parameters as $name => $value) {
                    $encoded[] = rawurlencode($name) . '=' . rawurlencode($value);
                }
// Concatenate the sorted and URL encoded parameters into a string.
                $concatenated = implode('&', $encoded);
// The API key for the user as generated in the Seller Center GUI.
// Must be an API key associated with the UserID parameter.
                $api_key = $resp2[0]['api_key'];
// Compute signature and add it to the parameters.
                $parameters['Signature'] =
                    rawurlencode(hash_hmac('sha256', $concatenated, $api_key, false));

// Replace with the URL of your API host.
                $url = "https://api.sellercenter.daraz.pk/?";
// Build Query String
                $queryString = http_build_query($parameters, '', '&',
                    PHP_QUERY_RFC3986);
// Open cURL connection
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url . $queryString);
// Save response to the variable $data
                curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
                $data2 = curl_exec($ch);
// Close Curl connection
                curl_close($ch);

                sleep(1);


                $resp_orderitem = json_decode($data2, true);
                $resp_orderitem = $resp_orderitem['SuccessResponse']['Body']['OrderItems'];

//            echo '<pre>';
//            print_r($resp_orderitem);
//            echo '</pre>';


                foreach ($resp_orderitem as $orderitems) {

                    $orderitems = array(

                        'OrderItemId' => $orderitems['OrderItemId'],
                        'ShopId' => $orderitems['ShopId'],
                        'OrderId' => $orderitems['OrderId'],
                        'Name' => $orderitems['Name'],
                        'Sku' => $orderitems['Sku'],
                        'ShopSku' => $orderitems['ShopSku'],
                        'ShippingType' => $orderitems['ShippingType'],
                        'ItemPrice' => $orderitems['ItemPrice'],
                        'PaidPrice' => $orderitems['PaidPrice'],
                        'Currency' => $orderitems['Currency'],
                        'TaxAmount' => $orderitems['TaxAmount'],
                        'ShippingAmount' => $orderitems['ShippingAmount'],
                        'ShippingServiceCost' => $orderitems['ShippingServiceCost'],
                        'VoucherAmount' => $orderitems['VoucherAmount'],
                        'VoucherCode' => $orderitems['VoucherCode'],
                        'Status' => $orderitems['Status'],
                        'ShipmentProvider' => $orderitems['ShipmentProvider'],
                        'IsDigital' => $orderitems['IsDigital'],
                        'DigitalDeliveryInfo' => $orderitems['DigitalDeliveryInfo'],
                        'TrackingCode' => $orderitems['TrackingCode'],
                        'TrackingCodePre' => $orderitems['TrackingCodePre'],
                        'Reason' => $orderitems['Reason'],
                        'ReasonDetail' => $orderitems['ReasonDetail'],
                        'PurchaseOrderId' => $orderitems['PurchaseOrderId'],
                        'PurchaseOrderNumber' => $orderitems['PurchaseOrderNumber'],
                        'PackageId' => $orderitems['PackageId'],
                        'PromisedShippingTime' => $orderitems['PromisedShippingTime'],
                        'ExtraAttributes' => $orderitems['ExtraAttributes'],
                        'ShippingProviderType' => $orderitems['ShippingProviderType'],
                        'CreatedAt' => $orderitems['CreatedAt'],
                        'UpdatedAt' => $orderitems['UpdatedAt'],
                        'ReturnStatus' => $orderitems['ReturnStatus'],
                        'productMainImage' => $orderitems['productMainImage'],
                        'Variation' => $orderitems['Variation'],
                        'ProductDetailUrl' => $orderitems['ProductDetailUrl'],
                        'invoiceNumber' => $orderitems['invoiceNumber'],

                    );

//            echo '<pre>';
//            print_r($orderitems);
//            echo '</pre>';
                }


                $verify = DB::table('orders')->where('OrderId', $orders['OrderId'])->select('OrderId')->get();
                $final_verify = json_decode($verify, true);
//            echo '<pre>';
//            print_r($final_verify);
//            echo '<pre>';
//

                if ($final_verify != Null) {
                    DB::table('orders')->where('OrderId', $final_verify)->update($orders);
                } else {
                    DB::table('orders')->insert($orders);
                    DB::table('items')->insert($orderitems);
                }


                //Our Monitoring Stuff

                $orderitemid = DB::table('items')->where('OrderId', $orderitems['OrderId'])->select('item_id', 'Name', 'ItemPrice', 'CreatedAt', 'productMainImage')->get();
                echo '<pre>';
                echo "Item ID: ";
                print_r($orderitemid[0]->item_id);
                echo "<br>";
                echo "Product Name: ";
                print_r($orderitemid[0]->Name);
                echo "<br>";
                echo "Price: ";
                print_r($orderitemid[0]->ItemPrice);
                echo "<br>";
                echo "DATE: ";
                print_r($orderitemid[0]->CreatedAt);
                echo "<br>";
                $orderimage = $orderitemid[0]->productMainImage;
                echo '</pre>';
                echo "<br>";
                echo "<br>";
                ?>
                <html>
                <body>

                <img src='<?php echo $orderimage; ?>'>
                </body>
                </html>

                <?php

            }


        }
//        echo $ordercounter;

    } 
}
?>


