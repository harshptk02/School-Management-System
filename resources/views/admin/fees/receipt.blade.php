<html>
<head>
    <style>
        body { font-family: DejaVu Sans, sans-serif; }
        .receipt-box {
            border: 2px solid #333;
            border-radius: 12px;
            padding: 24px 32px;
            max-width: 600px;
            margin: 0 auto;
        }
        .header {
            text-align: center;
            margin-bottom: 10px;
        }
        .logo {
            width: 60px;
            height: 60px;
            object-fit: contain;
            margin-bottom: 8px;
        }
        .school-title {
            font-size: 1.7em;
            font-weight: bold;
            letter-spacing: 1px;
        }
        .school-slogan {
            font-size: 1em;
            font-weight: 500;
            margin-bottom: 2px;
        }
        .school-contact {
            font-size: 0.95em;
            margin-bottom: 10px;
        }
        .row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 8px;
        }
        .label {
            font-weight: bold;
        }
        .amount-box {
            border: 2px solid #333;
            border-radius: 6px;
            padding: 8px 18px;
            font-size: 1.2em;
            font-weight: bold;
            display: inline-block;
            margin-right: 10px;
        }
        .footer {
            margin-top: 30px;
            font-size: 0.95em;
        }
        .signature {
            float: right;
            margin-top: 30px;
            font-size: 1em;
        }
        .receipt-title {
            font-size: 1.2em;
            font-weight: bold;
            margin-top: 10px;
            margin-bottom: 10px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="receipt-box">
        <div class="header">
            {{-- Logo (replace src with your logo path if available) --}}
            <img src="{{ public_path('logo.png') }}" class="logo" alt="School Logo" onerror="this.style.display='none'">
            <div class="school-title">ABC ACADEMY</div>
            <div class="school-slogan">YOUR SLOGAN HERE</div>
            <div class="school-contact">
                445 A, Adam William Road, New City, Auckland | Contact No.: 12345-67890, E-mail: abcacademy@gmail.com
            </div>
        </div>
        <div class="receipt-title">RECEIPT FOR PAYMENT</div>
        <div class="row">
            <div><span class="label">S.N.</span> {{ $fee->id }}</div>
            <div><span class="label">Date :</span> {{ $fee->payment_date ? $fee->payment_date->format('d/m/Y') : 'N/A' }}</div>
        </div>
        <div class="row">
            <div><span class="label">Name :</span> {{ $student->name }}</div>
        </div>
        <div class="row">
            <div><span class="label">Class :</span> {{ $profile->class ?? 'N/A' }}</div>
            
        </div>
        
        <div class="row">
            <div><span class="label">Fee for the month of Rs.</span> {{ $fee->month }} {{ $fee->year }}</div>
        </div>
        <div class="row">
            <div><span class="label">Late Fee Rs.</span> ____________________</div>
        </div>
        <div class="row" style="margin-top: 18px; align-items: center;">
            <div class="amount-box">Rs. {{ number_format($fee->amount, 2) }}</div>
            <div style="font-weight: bold; font-size: 1.1em;">RECEIPT FOR PAYMENT</div>
        </div>
        <div class="footer">
            Note: Late fee will be charged Rupees 50/-<br>
            <span class="signature">Signature</span>
        </div>
    </div>
</body>
</html> 