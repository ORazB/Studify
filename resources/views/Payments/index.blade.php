<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Riwayat Pembayaran</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">

  <div class="max-w-4xl mx-auto bg-white shadow-md rounded-lg p-6">
    <h1 class="text-2xl font-bold mb-4">Riwayat Pembayaran</h1>

    <table class="min-w-full divide-y divide-gray-200">
      <thead class="bg-gray-50">
        <tr>
          <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
          <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
          <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah</th>
          <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
          <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
        </tr>
      </thead>
      <tbody class="bg-white divide-y divide-gray-200">
        @foreach($payments as $index => $payment)
        <tr>
          <td class="px-6 py-4 whitespace-nowrap">{{ $index + 1 }}</td>
          <td class="px-6 py-4 whitespace-nowrap">{{ $payment->created_at->format('d-m-Y') }}</td>
          <td class="px-6 py-4 whitespace-nowrap">Rp {{ number_format($payment->amount_paid, 0, ',', '.') }}</td>
          <td class="px-6 py-4 whitespace-nowrap">
            @if(strtolower(trim($payment->status)) == 'paid')
              <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Paid</span>
            @elseif (strtolower(trim($payment->status)) == 'disapproved')
              <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Disapproved</span>
            @else
              <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-orange-100 text-yellow-400">Pending</span>
            @endif
          </td>
         <td class="px-6 py-4 whitespace-nowrap">
            <div class="flex items-center">
            <a href={{route('payments.show', $payment)}} class="bg-teal-500 cursor-pointer text-white font-semibold py-2 px-4 rounded shadow transition duration-150">View</a>
            </div>
         </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>

</body>
</html>
