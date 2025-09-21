<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Riwayat Pembayaran</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-bold mb-4">Riwayat Pembayaran</h1>

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white rounded-lg shadow-md">
                <thead class="bg-gray-200 text-gray-700">
                    <tr>
                        <th class="py-2 px-4">ID</th>
                        <th class="py-2 px-4">Amount</th>
                        <th class="py-2 px-4">Date</th>
                        <th class="py-2 px-4">Status</th>
                        <th class="py-2 px-4">Proof</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700">
                    <tr class="border-b hover:bg-gray-50">
                        <td class="py-2 px-4">{{ $payment->id }}</td>
                        <td class="py-2 px-4">{{ number_format($payment->amount_paid) }}</td>
                        <td class="py-2 px-4">{{ $payment->payment_date }}</td>
                        <td class="py-2 px-4">
                            @if ($payment->status == 'disapproved')
                                <span class="text-red-500 text-center w-full font-semibold">Disapproved</span>
                            @elseif($payment->status == 'pending')
                                <span class="text-yellow-500 text-center w-full font-semibold">Pending</span>
                            @else
                                <span class="text-green-500 text-center w-full font-semibold">Approved</span>
                            @endif
                        </td>
                        <td class="py-2 px-4">
                            @if ($payment->image)
                                <img src="{{ asset('storage/' . $payment->image) }}" alt="proof"
                                    class="w-16 h-16 object-cover rounded">
                            @else
                                N/A
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        {{-- <a href="{{ url()->previous() }}" class="text-white bg-teal-400 p-4 rounde hover:underline">Kembali</a> --}}
    </div>
</body>

</html>
