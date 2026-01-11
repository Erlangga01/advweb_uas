<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Invoice #{{ $transaction->id }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            color: #333;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h1 {
            margin: 0;
            font-size: 24px;
        }

        .header p {
            margin: 5px 0;
        }

        .info-table {
            width: 100%;
            margin-bottom: 20px;
        }

        .info-table td {
            padding: 5px;
        }

        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .items-table th,
        .items-table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        .items-table th {
            background-color: #f2f2f2;
        }

        .text-right {
            text-align: right;
        }

        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 10px;
            color: #777;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>axl elektronik</h1>
        <p>ketapang ngusikan jombang</p>
        <p>no telp +6285231806510</p>
    </div>
    
    <hr>

    <table class="info-table" style="width: 100%; border-collapse: collapse;">
        <tr>
            <td style="width: 100px;">No</td>
            <td>: {{ $transaction->id }}</td>
        </tr>
        <tr>
            <td>Tanggal</td>
            <td>: {{ \Carbon\Carbon::parse($transaction->transaction_date)->format('d-m-Y') }} {{ $transaction->created_at->format('H:i') }}</td>
        </tr>
        <tr>
            <td>Pelanggan</td>
            <td>: {{ $transaction->customer_name }}</td>
        </tr>
        <tr>
            <td>Kasir</td>
            <td>: Admin</td>
        </tr>
    </table>

    <hr>

    <table class="items-table" style="width: 100%; margin-top: 10px;">
        <tbody>
            @foreach($transaction->details as $detail)
                <tr>
                    <td colspan="4">{{ $detail->product->name }}</td>
                </tr>
                <tr>
                    <td style="padding-left: 10px;">{{ $detail->quantity }} x {{ number_format($detail->price, 0, ',', '.') }}</td>
                    <td class="text-right" colspan="3">Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="4"><hr></td>
            </tr>
            <tr>
                <td colspan="3" class="text-right"><strong>Total :</strong></td>
                <td class="text-right"><strong>Rp {{ number_format($transaction->total_amount, 0, ',', '.') }}</strong></td>
            </tr>
        </tfoot>
    </table>

    <hr>
    
    <div class="footer">
        <p>Terima kasih atas kepercayaan Anda</p>
    </div>
</body>

</html>