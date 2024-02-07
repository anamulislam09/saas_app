<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title></title>
</head>

<body>
    <div class="container">
        <div class="header">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="logo">
                        <img src="" alt="">
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="header-text">
                        <h1>{{ $customer->name }}</h1>
                        <p>{{ $custDetails->address }}</p>
                        <p>{{ $custDetails->phone }}</p>
                        <p>{{ $customer->email }}</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="status">
                        <button class="btn btn-primary">Click</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="body">
            <h1>{{ $date }}</h1>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Expense Name</th>
                        <th>Expense Amount</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $exp->name }}</td>
                        <td>{{ $exp->amount }}</td>
                    </tr>
                </tbody>
            </table>


        </div>
        <div class="footer">
            <div class="row">
                <div class="col-lg-4 col-md-4"> Prepared by</div>
                <div class="col-lg-4 col-md-4"> Approved by</div>
                <div class="col-lg-4 col-md-4"> Recipient Signature</div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
