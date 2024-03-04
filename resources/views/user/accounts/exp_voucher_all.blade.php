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
            <p>Total Expense month of the<strong><span>
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
                        <th>SL#</th>
                        <th colspan="2">Payment Info</th>
                        <th>Amount</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($inv as $key => $item)
                        @php
                            $exp_name = App\Models\Category::where('id', $item->cat_id)->first();
                            $user = App\Models\User::where('user_id', Auth::user()->user_id)->first();
                            $amount = App\Models\Exp_detail::where('customer_id', $user->customer_id)
                                ->where('month', $item->month)
                                ->where('year', $item->year)
                                ->where('cat_id', $item->cat_id)
                                ->sum('amount');
                        @endphp
                        <tr>
                            <td style="text-align: center">{{ $key + 1 }}</td>
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

            @php
            // Function which returns number to words
            function numberToWord($num = '')
            {
                $num = (string) ((int) $num);

                if ((int) $num && ctype_digit($num)) {
                    $words = [];

                    $num = str_replace([',', ' '], '', trim($num));

                    $list1 = [
                        '',
                        'one',
                        'two',
                        'three',
                        'four',
                        'five',
                        'six',
                        'seven',
                        'eight',
                        'nine',
                        'ten',
                        'eleven',
                        'twelve',
                        'thirteen',
                        'fourteen',
                        'fifteen',
                        'sixteen',
                        'seventeen',
                        'eighteen',
                        'nineteen',
                    ];

                    $list2 = [
                        '',
                        'ten',
                        'twenty',
                        'thirty',
                        'forty',
                        'fifty',
                        'sixty',
                        'seventy',
                        'eighty',
                        'ninety',
                        'hundred',
                    ];

                    $list3 = [
                        '',
                        'thousand',
                        'million',
                        'billion',
                        'trillion',
                        'quadrillion',
                        'quintillion',
                        'sextillion',
                        'septillion',
                        'octillion',
                        'nonillion',
                        'decillion',
                        'undecillion',
                        'duodecillion',
                        'tredecillion',
                        'quattuordecillion',
                        'quindecillion',
                        'sexdecillion',
                        'septendecillion',
                        'octodecillion',
                        'novemdecillion',
                        'vigintillion',
                    ];

                    $num_length = strlen($num);
                    $levels = (int) (($num_length + 2) / 3);
                    $max_length = $levels * 3;
                    $num = substr('00' . $num, -$max_length);
                    $num_levels = str_split($num, 3);

                    foreach ($num_levels as $num_part) {
                        $levels--;
                        $hundreds = (int) ($num_part / 100);
                        $hundreds = $hundreds
                            ? ' ' . $list1[$hundreds] . ' Hundred' . ($hundreds == 1 ? '' : 's') . ' '
                            : '';
                        $tens = (int) ($num_part % 100);
                        $singles = '';

                        if ($tens < 20) {
                            $tens = $tens ? ' ' . $list1[$tens] . ' ' : '';
                        } else {
                            $tens = (int) ($tens / 10);
                            $tens = ' ' . $list2[$tens] . ' ';
                            $singles = (int) ($num_part % 10);
                            $singles = ' ' . $list1[$singles] . ' ';
                        }
                        $words[] =
                            $hundreds .
                            $tens .
                            $singles .
                            ($levels && (int) $num_part ? ' ' . $list3[$levels] . ' ' : '');
                    }
                    $commas = count($words);
                    if ($commas > 1) {
                        $commas = $commas - 1;
                    }

                    $words = implode(', ', $words);

                    $words = trim(str_replace(' ,', ',', ucwords($words)), ', ');
                    if ($commas) {
                        $words = str_replace(',', ' and', $words);
                    }

                    return $words;
                } elseif (!((int) $num)) {
                    return 'Zero';
                }
                return '';
            }

            $word = numberToWord($total);
           
        @endphp

            <div class="textAmount">
                <h3>In Word: {{$word}}</h3>
            </div>
        </div>
        <div class="footer">
            <div class="Prepared">
                <p style="padding-bottom: -10px; margin-bottom:-20px; padding-left:25px">{{ Auth::user()->name }}</p>
                <h4>Prepared by</h4>
            </div>
            <div class="Approved">
                <p></p>
                <h4>Approved by</h4>
            </div>
            <div class="Recipient">
                <p></p>
                <h4>Recipient Signature</h4>
            </div>
        </div>
    </div>
</body>

</html>
