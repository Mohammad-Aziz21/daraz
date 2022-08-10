<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link  rel="stylesheet" href="/css/main.css">
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="/js/main.js"></script>

<!------ Include the above in your HEAD tag ---------->

<!--Author      : @arboshiki-->
<div id="invoice">

    <div class="toolbar hidden-print">
        <div class="text-right">
            <button id="printInvoice" class="btn btn-info"><i class="fa fa-print"></i> Print</button>
            <button class="btn btn-info"><i class="fa fa-file-pdf-o"></i> Export as PDF</button>
        </div>
        <hr>
    </div>
    <div class="invoice overflow-auto">
        <div style="min-width: 600px">
            <header>
                <div class="row">
                    <div class="col">
                        <a target="_blank" href="https://lobianijs.com">
                            <img src="/img/webcloud1.png" data-holder-rendered="true" />
                        </a>
                    </div>
                    <div class="col company-details">
                        <h2 class="name">
                            <a target="_blank" href="https://lobianijs.com">
                                Webcloud Daraz
                            </a>
                        </h2>
                        <div>10461 SW 48th Street Miami, FL 33165, USA</div>
                        <div>+923333253887</div>
                        <div>info@webcloudsoft.com</div>
                    </div>
                </div>
            </header>
            <main>
                <div class="row contacts">
                    <div class="col invoice-to">
                        <div class="text-gray-light">INVOICE TO:</div>
                        <h2 class="to">{{$OrderReturn[0]->CustomerFirstName}}</h2>
                        <br>
                        <div class="address"> <b>Shipping Address:</b> {{$OrderReturn[0]->shipping_Address1}}</div>
                        <div class="address"> <b>Billing Address:</b> {{$OrderReturn[0]->billing_Address1}}</div>
                        <div class="address"> <b>Shipping Name:</b> {{$OrderReturn[0]->	shipping_FirstName}}</div>
                        <div class="address"> <b>Billing Name:</b> {{$OrderReturn[0]->billing_FirstName}}</div>
                        <div class="email"><a href="mailto:john@example.com">{{$OrderReturn[0]->account_email}}</a></div>

                    </div>
                    <div class="col invoice-details">
                        <div class="text-gray-light">Billing Phone:</div>
                        <h2 class="invoice-id">{{$OrderReturn[0]->billing_Phone}}</h2>
                        <div class="date"><b>CreatedAt:</b> {{$OrderReturn[0]->CreatedAt}}</div>
                        <div class="date"><b>UpdatedAt:</b> {{$OrderReturn[0]->UpdatedAt}}</div>

                    </div>
                </div>
                <table border="0" cellspacing="0" cellpadding="0">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th class="text-left">Name</th>
                        <th class="text-right">Count</th>
                        <th class="text-right">Price</th>
                        <th class="text-right">Current Procurement</th>
                        <th class="text-right">Procurement</th>
                        <th class="text-right">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($OrderReturn as $value2)
                    <tr>
                        <td class="no">01</td>
                        <td class="text-left"><h3>{{$value2 -> Name}}</h3></td>
                        <td class="unit">{{$value2 -> ItemsCount}}</td>
                        <td class="total">{{$value2 -> ItemPrice}}</td>
                        <td class="total">{{$value2 -> OrderProcurement }}</td>

                        <td class="unit">
                            <form action="/insert" method="post">
                                <input name="procurement">

                                <input type="hidden" name="OrderId" value="{{$value2 -> OrderId}}"><br>
                        <td class=""><button type="submit">
                                {{ csrf_field() }}
                                Insert</button>
                        </td>
                        </form>
                        </td>





                    </tr>

                    @endforeach

                    </tbody>
                    <tfoot>
{{--                    <tr>--}}
{{--                        <td colspan="2"></td>--}}
{{--                        <td colspan="2">SUBTOTAL</td>--}}
{{--                        <td>$5,200.00</td>--}}
{{--                    </tr>--}}
{{--                    <tr>--}}
{{--                        <td colspan="2"></td>--}}
{{--                        <td colspan="2">TAX 25%</td>--}}
{{--                        <td>$1,300.00</td>--}}
{{--                    </tr>--}}
                    <tr>
                        <td colspan="2"></td>
                        <td colspan="2">GRAND TOTAL</td>
                        <td>{{$OrderReturn[0]->Price}}</td>
                    </tr>
                    </tfoot>
                </table>
            </main>

        </div>
        <!--DO NOT DELETE THIS div. IT is responsible for showing footer always at the bottom-->
        <div></div>
    </div>
</div>
