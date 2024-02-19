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
            /* margin-bottom: 16px */
            width: 100%;
            /* background: #fb5200; */
        }

        .left-text {
            width: 70%;
            float: left;
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
                <h2>Payment Voucher</h2>
            </div>
        </div>
        <div class="bodyInfo">
            <div class="left-text">
                <p>Name : </p>
                <p>Address : </p>
            </div>
            <div class="right-text">
                <p>Voucher No : {{ rand(999, 9999) }}</p>
                <p>Voucher Date :{{ $date }}</p>
            </div>
        </div>

        <div class="body">
            <table>
                <thead>
                    <tr>
                        <th>SL#</th>
                        <th colspan="2">Payment Info</th>
                        <th>Amount</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td colspan="2">{{ $exp_name->name }}</td>
                        <td style="text-align: center">{{ $exp->sub_total }}</td>
                    </tr>
                    <tr>
                        <td colspan="2">Payment Method :</td>
                        <td style="text-align: center">Total Amount</td>
                        <td style="text-align: center">{{ $exp->sub_total }}</td>
                    </tr>
                </tbody>
            </table>
            <div class="textAmount">
                <h3>In Word :</h3>
            </div>
        </div>
        <div class="footer">
            <div class="Prepared">
                <h4>Prepared by</h4>
            </div>
            <div class="Approved">
                <h4>Approved by</h4>
            </div>
            <div class="Recipient">
                <h4>Recipient Signature</h4>
            </div>
        </div>
    </div>
</body>

</html>
