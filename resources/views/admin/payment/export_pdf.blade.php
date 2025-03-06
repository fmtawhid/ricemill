<!DOCTYPE html>
<html>

<head>
    <title>Students Report</title>
    <style>
        /* Add any custom styles for the PDF here */
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <h2>Talimul Islam School and Madrashah</h2>
    <h2>Payments Report</h2>
    <p>From Date: {{ $fromDate ?? 'N/A' }}</p>
    <p>To Date: {{ $toDate ?? 'N/A' }}</p>
    <table>
        <thead>
            <tr>
                <th>Serial No</th>
                <th>Receipt No</th>
                <th>Date</th>
                <th>Name</th>
                <th>Roll Number</th>
                <th>Address</th>
                <th>Purpose</th>
                <th>Amount</th>
                <th>Amount in Words</th>
                <th>Class</th>
                <th>Bibhag</th>
                <th>Created At</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($payments as $index => $payment)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $payment->reciept_no }}</td>
                    <td>{{ $payment->date }}</td>
                    <td>{{ $payment->name }}</td>
                    <td>{{ $payment->dhakila_number }}</td>
                    <td>{{ $payment->address }}</td>
                    <td>{{ $payment->purpose->purpose_name }}</td>
                    <td>{{ $payment->amount }} TK</td>
                    <td>{{ $payment->amount_in_words }}</td>
                    <td>{{ $payment->sreni->name }}</td>
                    <td>{{ $payment->bibag->name }}</td>
                    <td>{{ $payment->created_at->format('Y-m-d') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
