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
      height: 150px;
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
      padding-bottom: 25px;
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

    {{-- <div class="bodyInfo">
      <div class="left-text">
        <p>Name : {{ $inv->name }}</p>
        <p>Phone : {{ $inv->phone }}</p>
        <p>Address : {{ $inv->address }}</p>
      </div>
      <div class="right-text">
        <p>Voucher No : {{ $inv->voucher_id }}</p>
        <p>Voucher Date :{{ $inv->date }}</p>
      </div>
    </div> --}}
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
            @foreach ($inv as $key => $item)
            @php
                $exp_name = App\Models\Category::where('id', $item->cat_id)->first();
                $amount = App\Models\Exp_detail::where('customer_id', Auth::guard('admin')->user()->id)
                              ->where('month', $item->month)
                              ->where('year', $item->year)
                              ->where('cat_id', $item->cat_id)
                              ->sum('amount');
            @endphp
            <tr>
                <td style="text-align: center">{{$key+1}}</td>
                <td colspan="2">{{ $exp_name->name }}</td>
                <td style="text-align: center">{{ $amount }}</td>
              </tr>
            @endforeach
         
          <tr>
            <td colspan="2">Payment Method :</td>
            <td style="text-align: center">Total Amount</td>
            <td style="text-align: center">{{ $total }}</td>
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
