<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Post;
use DateTime;

class ViewController extends Controller
{
    public function homepage()
    {
        $names = DB::table('accounts')->select('api_key', 'account_email', 'account_name', 'account_id')->get();
        $order = DB::table('orders')
            ->select('orders.OrderId','orders.account_email','orders.OrderProcurement','orders.CustomerFirstName','orders.Price','orders.CreatedAt','orders.shipping_FirstName','orders.Statuses','items.Name')
            ->join('items','orders.OrderId','=','items.OrderId')
            ->orderByDesc('CreatedAt')
            ->get();
       //return view('home')->with('data',$names)->with('data2',$order);
         return view('home',['data'=>$names,'data2'=>$order]);

    }



    public function filteraccount($account_email,$status,Request $request)
    {

        $names2 = DB::table('accounts')->select('api_key', 'account_email', 'account_name', 'account_id')->get();

        if($status == 'all')
        {

                  if(count($request->all()) > 0) {

                      $fromdate = $request->input('fromdate');
                       $todate = $request->input('todate');

                      $order2 = DB::table('orders')
                          ->select('orders.OrderId','orders.account_email','orders.CustomerFirstName','orders.OrderProcurement','orders.Price','orders.CreatedAt','orders.shipping_FirstName','orders.Statuses','items.Name')
                          ->join('items','orders.OrderId','=','items.OrderId')
                          ->where('account_email', $account_email)
                          ->orderByDesc('orders.CreatedAt')
                          ->whereBetween('orders.CreatedAt', [$fromdate, $todate])
                          ->get();
                  }

            else {$order2 = DB::table('orders')
                ->select('orders.OrderId','orders.account_email','orders.CustomerFirstName','orders.OrderProcurement','orders.Price','orders.CreatedAt','orders.shipping_FirstName','orders.Statuses','items.Name')
                ->join('items','orders.OrderId','=','items.OrderId')
                ->where('orders.account_email', $account_email)
                ->orderByDesc('orders.CreatedAt')
                ->get();

        }}
        else
            {

                if(count($request->all()) > 0) {

                    $fromdate = $request->input('fromdate');
                    $todate = $request->input('todate');

                    $order2 = DB::table('orders')
                        ->select('orders.OrderId','orders.account_email','orders.OrderProcurement','orders.CustomerFirstName','orders.Price','orders.CreatedAt','orders.shipping_FirstName','orders.Statuses','items.Name','orders.ItemsCount')
                        ->join('items','orders.OrderId','=','items.OrderId')
                        ->where('orders.Statuses', $status)
                        ->where('orders.account_email', $account_email)
                        ->orderByDesc('orders.CreatedAt')
                        ->whereBetween('orders.CreatedAt', [$fromdate, $todate])
                        ->get();


                }

           else
               {

               $order2 = DB::table('orders')
                   ->select('orders.OrderId','orders.account_email','orders.OrderProcurement','orders.CustomerFirstName','orders.Price','orders.CreatedAt','orders.shipping_FirstName','orders.Statuses','items.Name','ItemsCount')
                   ->join('items','orders.OrderId','=','items.OrderId')
                   ->where('orders.Statuses', $status)
                   ->where('orders.account_email', $account_email)
                   ->orderByDesc('orders.CreatedAt')
                   ->get();


           }

        }
//        echo '<pre>';
//        print_r($order2);
//        echo '</pre>';
//        exit();

        return view('account')->with('data2',$names2)->with('data3',$order2)->with('arzam',$account_email)->with('status',$status);

    }

    public function procurement($OrderId)
    {

        $OrderReturn = DB::table('orders')
            ->select('orders.OrderId','orders.account_email','orders.CustomerFirstName','orders.shipping_Address1','orders.billing_Address1',
                'orders.billing_Phone','orders.shipping_FirstName','orders.billing_FirstName','orders.ItemsCount','orders.OrderProcurement',
                'orders.Price','orders.CreatedAt','orders.UpdatedAt','orders.shipping_FirstName','orders.Statuses','orders.ItemsCount',
                'items.Name','items.ItemPrice')
            ->join('items','orders.OrderId','=','items.OrderId')
            ->where('orders.OrderId', $OrderId)
            //->where('orders.account_email', $account_email)
            ->orderByDesc('orders.CreatedAt')
            ->get();
//        $OrderItem=DB::table('items')
//            ->select('items.Name','items.ItemPrice')
//            ->where('OrderId', $OrderId)
//            ->get();

//        echo '<pre>';
//        print_r($OrderReturn);
//        echo '</pre>';
//
//        echo '<pre>';
//        print_r($OrderItem);
//        echo '</pre>';

//        exit();


        return view('procurement')->with('OrderReturn',$OrderReturn);

    }

    public function storeprocurement(Request $request)
    {

        $pro = $request->input('procurement');
        $OrderId = $request->input('OrderId');
        $storing = DB::table('orders')->where('OrderId', $OrderId)->update(['OrderProcurement' => $pro]);
        return redirect('/procurement/'.$OrderId.'');

    }
    public function profit($account_email,Request $request)
    {

        $names2 = DB::table('accounts')->select('api_key', 'account_email', 'account_name', 'account_id')->get();

        if (count($request->all()) > 0) {
            $date = $request->input('date');

            ini_set('max_execution_time', -1);
//            $procounter = 0;
//            $MyAccountID = $id;
            $credential = DB::table('accounts')->select('api_key', 'account_email', 'account_name', 'account_id')->where('account_email', $account_email)->get();
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
                'CreatedAfter' => $date,
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
            $resp = $resp['SuccessResponse']['Body']['PayoutStatus']['Statement'];
//            echo '<pre>';
//            print_r($resp);
//            echo '</pre>';
            //echo $url . $queryString;


            foreach ($resp as $profititem) {


                    $StatementNumber = $profititem['StatementNumber'];
                    $CreatedAt = $profititem['CreatedAt'];
                    $ItemRevenue = $profititem['ItemRevenue'];
                    $Payout = $profititem['Payout'];
//                    echo "<br>";
//                    echo $StatementNumber;
//                    echo "<br>";
//                    echo $CreatedAt;
//                    echo "<br>";
//                    echo $ItemRevenue;
//                    echo "<br>";
//                    echo $Payout;
//                    echo "<br>";
//                    echo "<br>";

                $input = $CreatedAt;
                $date = strtotime($input);
                //echo date('d', $date);
                //echo date('Y-m', $date);
                if(date('d', $date)==15){
                    $start=date('Y-m', $date).'-01';
                    $end=date('Y-m', $date).'-14';
                    //echo $start.$end;
                }
                if(date('d', $date)==01){
                    $chk=date('Y-m', $date);
                    $chk2=date('Y-m-d', $date);
                    $start=date('Y-m', strtotime($chk. ' - 1 month')).'-16';
                    $end=date('Y-m-d', strtotime($chk2. ' - 1 days'));
                    //echo $start.$end;
                }

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
                    'startTime'=>$start,
                    'endTime'=>$end,
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
                $final_resp = json_decode($data, true);
                $final_resp = $final_resp['SuccessResponse']['Body']['TransactionDOs']['transactionDOs'];
//                echo '<pre>';
//                print_r($final_resp);
//                echo '</pre>';
                //echo $url . $queryString;

                $ProcurementSum = 0;

                foreach($final_resp as $final_resp2)
                {
                    $orderno = $final_resp2['Order No.'];
                    $OrderReturn = DB::table('orders')
                        ->select('OrderProcurement')->where('OrderId',$orderno)->get();

                    $OrderReturnn = json_decode($OrderReturn, true);
//                    echo'<pre>';
//                    print_r($OrderReturnn);
//                    echo'</pre>';
                    foreach ($OrderReturnn as $gando)
                    {
                        $ProcurementSum = $ProcurementSum + $gando['OrderProcurement'];
                    }

                }



                //echo $ProcurementSum;

                $Payout=str_replace(' PKR','',$Payout);

                //echo $Payout;

                $Profit = $Payout - $ProcurementSum;
                //echo '<br>'.$Profit.'<br>';


                $finalprofit=[

                    'statementno'=>$StatementNumber,
                    'createdat'=>$CreatedAt,
                    'itemrevenue'=>$ItemRevenue,
                    'payout'=>$Payout,
                    'procurementsum'=>$ProcurementSum,
                    'profit'=>$Profit,
                    'to'=>$end,
                    'from'=>$start

                ];


//print_r($finalprofit);

            }

            //exit();

            return view('profit')->with('data2', $names2)->with('arzam', $account_email)->with('finalprofit',$finalprofit);





        }
        return view('profit')->with('data2', $names2)->with('arzam', $account_email);


    }

}
?>


