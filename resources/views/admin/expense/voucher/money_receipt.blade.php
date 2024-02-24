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
            <div class="left-text">
                <p>Mr No : {{ rand(999, 99999) }}</p>
               @isset($user->name)
               <p>name : {{ $user->name }}</p>
                @endisset
               
                <p>name : ..........</p>
                <p>Flat_name : {{ $inv->flat_name }}</p>
            </div>
            <div class="right-text">
                <p>Barcode</p>
                <p>Date :{{ date('m/d/y') }}</p>
            </div>
        </div>
        <div class="body">
            <p>Amount <strong><span style="border-bottom: 2px dotted #000; padding:0px 30px">{{ $inv->paid }}</span></strong> in word
                ................ of the month of <strong><span style="border-bottom: 2px dotted #000; padding:0px 30px">
                    @if ($inv->month == 1)
                        January
                    @elseif ($inv->month == 2)
                        February
                    @elseif ($inv->month == 3)
                        March
                    @elseif ($inv->month == 4)
                        April
                    @elseif ($inv->month == 5)
                        May
                    @elseif ($inv->month == 6)
                        June
                    @elseif ($inv->month == 7)
                        July
                    @elseif ($inv->month == 8)
                        August
                    @elseif ($inv->month == 9)
                        September
                    @elseif ($inv->month == 10)
                        October
                    @elseif ($inv->month == 11)
                        November
                    @elseif ($inv->month == 12)
                        December
                    @endif {{ $inv->year }}
                </span> <strong>
            </p>
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
