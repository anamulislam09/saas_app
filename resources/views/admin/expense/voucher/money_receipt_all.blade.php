<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />

    <style>
        .container {
            width: 90%;
            margin: auto;
        }

        .header-section {
            width: 100%;
            height: 100px;
        }

        .logo {
            width: 25%;
            float: left;
        }

        .header-text {
            width: 40%;
            float: left;
            text-align: center;
        }

        .status {
            width: 35%;
            float: right;
            text-align: end;

        }

        .header-text h1 {
            font-family: arial;
            margin-bottom: -6Px;
        }


        .header-text p {
            margin: 0px 10px;
        }

        .status h2 {
            padding: 10px 0px;
            background: #5ac1e0;
            text-align: center;
            width: 100%;
        }

        /* table style start here  */
        table,
        td,
        th {
            border: 1px solid;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        .body {
            padding: 10px 0px;
        }

        /* table style ends here  */

        .Prepared {
            width: 33.33%;
            float: left;
        }

        .Prepared h4 {
            border-top: 2px solid black;
            width: 45%;
            text-align: center;
        }

        .Approved {
            width: 33.33%;
            float: left;
            text-align: -webkit-center;
        }

        .Approved h4 {
            border-top: 2px solid black;
            width: 45%;
            text-align: center;
        }

        .Recipient {
            width: 33.33%;
            float: left;
            text-align: -webkit-right;
        }

        .Recipient h4 {
            border-top: 2px solid black;
            width: 70%;
            text-align: center;
        }

        /* body text start here  */
        .bodyInfo {
            display: flex;
            justify-content: space-between;
            display: block;
            padding: 15px 0px;
            padding-bottom: 25px width: 100%;
            /* background: #fb5200; */
        }

        .left-text {
            width: 70%;
            float: left;
            line-height: 10px;
        }

        .righrightt-text {
            width: 30%;
            float: left;
        }

        /* body text ends here  */
    </style>
</head>

<body>
    <div class="container">
        <div class="header-section">
            <div class="logo">
                <h3>{{ $customer->name }}</h3>
                {{-- <img src="" alt="$customer->name "> --}}
            </div>

            <div class="header-text">
                <h1>{{ $customer->name }}</h1>
                <p>{{ $custDetails->address }}</p>
                <p>{{ $custDetails->phone }}</p>
                <p>{{ $customer->email }}</p>
            </div>

            <div class="status">
                <h2>Money Receipt</h2>
            </div>
        </div>

        <div class="bodyInfo">
            {{-- <div class="left-text">
                <p>Mr No : {{ rand(999, 99999) }}</p>
                <p>name : {{ $user->name }}</p>
                <p>Flat_name : {{ $inv->flat_name }}</p>
            </div>
            <div class="right-text">
                <p>Barcode</p>
                <p>Date :{{ date('m/d/y') }}</p>
            </div> --}}
        </div>
        <div class="body">
            <p>Total collection month of the<strong><span>
                        @if ($month->month == 1)
                            January
                        @elseif ($month->month == 2)
                            February
                        @elseif ($month->month == 3)
                            March
                        @elseif ($month->month == 4)
                            April
                        @elseif ($month->month == 5)
                            May
                        @elseif ($month->month == 6)
                            June
                        @elseif ($month->month == 7)
                            July
                        @elseif ($month->month == 8)
                            August
                        @elseif ($month->month == 9)
                            September
                        @elseif ($month->month == 10)
                            October
                        @elseif ($month->month == 11)
                            November
                        @elseif ($month->month == 12)
                            December
                        @endif {{ $month->year }}
                    </span> <strong>
            </p>
            <table>
                <thead>
                    <tr>
                        <th width="10%">SL#</th>
                        <th width="25%"> Flat Name</th>
                        <th width="30%"> User Name</th>
                        <th width="30%">Collection Info</th>
                        <th width = "15%" style="text-align:right">Payble</th>
                        <th width = "20%" style="text-align:right">Paid Amount</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($inv as $key => $item)
                        @php
                            // $amount = App\Models\Income::where('customer_id', Auth::guard('admin')->user()->id)
                            //     ->where('month', $item->month)
                            //     ->where('year', $item->year)
                            //     ->where('cat_id', $item->cat_id)
                            //     ->sum('amount');

                            $paid_total = App\Models\Income::where('customer_id', Auth::guard('admin')->user()->id)
                                ->where('month', $item->month)
                                ->where('year', $item->year)
                                ->where('status', '!=', 0)
                                ->SUM('paid');

                            $due_total = App\Models\Income::where('customer_id', Auth::guard('admin')->user()->id)
                                ->where('month', $item->month)
                                ->where('year', $item->year)
                                ->where('status', '!=', 0)
                                ->SUM('due');

                            $user = App\Models\User::where('customer_id', Auth::guard('admin')->user()->id)
                                ->where('flat_id', $item->flat_id)
                                ->first();
                        @endphp
                        <tr>
                            <td style="text-align: center">{{ $key + 1 }}</td>
                            <td>{{ $item->flat_name }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $item->charge }}</td>
                            <td>{{ $item->paid + $item->due }}</td>
                            <td>{{ $item->paid }}</td>
                        </tr>
                    @endforeach

                    <tr>
                        <td colspan="2">Payment Method :</td>
                        <td colspan="2" style="text-align: right">Total Amount</td>
                        <td style="text-align: right">{{ $paid_total + $due_total}}</td>
                        <td style="text-align: right">{{ $paid_total }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="footer">
            <div class="Prepared">
                <h4>Prepared by</h4>
            </div>
            <div class="Recipient">
                <h4>Recipient Signature</h4>
            </div>
        </div>
    </div>
</body>

</html>
