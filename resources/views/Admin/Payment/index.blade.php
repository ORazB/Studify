<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script src="https://unpkg.com/boxicons@2.1.3/dist/boxicons.js"></script>

    <title>Studify | Admin Panel - Payment Management</title>

    <style>
        .title {
            border-bottom: 1px solid black;
        }

        .payment-card {
            transition: all 0.3s ease;
        }

        .payment-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body>

    <x-header />

    <section class="flex min-h-screen">

        <!-- Sidebar -->
        <div class="w-64 bg-white shadow-lg flex flex-col">
            <!-- Logo/Brand -->
            <div class="p-6 border-b border-gray-200">
                <h1 class="text-xl font-bold text-gray-800">Admin Portal</h1>
            </div>

            <!-- Navigation -->
            <nav class="flex-1 p-4">
                <ul class="space-y-2">
                    <li>
                        <a href="{{ route('students.index') }}"
                            class="flex items-center px-4 py-3 text-white bg-gray-800 rounded-lg font-medium transition-colors">
                            <i class='bx bx-home text-xl mr-3'></i>
                            Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('users.edit', session('user_id')) }}"
                            class="flex items-center px-4 py-3 text-gray-600 hover:bg-gray-100 rounded-lg font-medium transition-colors">
                            <i class='bx bx-user text-xl mr-3'></i>
                            Profile
                        </a>
                    </li>
                </ul>
            </nav>

            <!-- Logout -->
            <div class="p-4 border-t border-gray-200">
                <a href="./logout"
                    class="flex items-center px-4 py-3 text-red-600 hover:bg-red-50 rounded-lg font-medium transition-colors">
                    <i class='bx bx-log-out text-xl mr-3'></i>
                    Keluar
                </a>
            </div>
        </div>

        <div class="main-dashboard bg-[#f5f5f5] mx-auto w-full">
            <div class="p-8">
                <div class="bg-white w-fit px-4 pt-3 gap-6 rounded-xl shadow flex">
                    <a href={{ route('users.index') }}
                        class="font-normal text-gray-700 cursor-pointer px-2 pb-3">Users</a>
                    <a href={{ route('admin.students.index') }}
                        class="font-normal text-gray-700 cursor-pointer px-2 pb-3">Students</a>
                    <a href={{ route('admin.spp.index') }}
                        class="font-normal text-gray-700 cursor-pointer px-2 pb-3">Spp</a>
                    <a href={{ route('admin.payments.index') }}
                        class="border-b-2 font-medium cursor-pointer px-2 pb-3 border-[#7AE2CF]">Payments</a>
                </div>
            </div>

            <!-- Header Section -->
            <div class="ml-8 mb-6 flex justify-between items-center">
                <div class="flex items-center gap-8">
                    <h1 class="text-3xl font-bold text-gray-800">Payment Management</h1>
                    <div class="flex gap-4">
                        <div class="bg-teal-100 px-4 py-2 rounded-lg">
                            <span class="text-teal-700 font-medium">Total Payments:
                                {{ $payments->filter(fn($p) => trim(strtolower($p->status)) != 'paid')->count() }}</span>
                        </div>
                        <div class="bg-green-100 px-4 py-2 rounded-lg">
                            <span class="text-green-700 font-medium">Total Revenue: Rp
                                {{ number_format(
                                    $payments->filter(fn($p) => trim(strtolower($p->status)) != 'disapproved')->sum('amount_paid'),
                                    0,
                                    ',',
                                    '.',
                                ) }}
                            </span>
                        </div>
                    </div>
                </div>
                {{-- <a href={{ route('admin.payments.create') }}
                    class="bg-teal-700 hover:bg-teal-800 cursor-pointer py-3 px-6 text-white font-medium rounded-lg transition-colors flex items-center gap-2">
                    <i class='bx bx-plus text-xl'></i>
                    Add New Payment
                </a> --}}
            </div>

            <!-- Students Payment Cards (Grouped by Student) -->
            <div class="ml-8 mr-8 grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-6">
                @php
                    $classes = [
                        1 => 'PPLG',
                        2 => 'TJKT',
                        3 => 'Akuntansi',
                        4 => 'DKV',
                    ];
                @endphp

                @foreach ($payments as $payment)
                    @if ($payment->status != 'disapproved' && $payment->status != 'paid')
                        @php $student = $studentMap[$payment->student_id]; @endphp
                        <div class="payment-card bg-white rounded-xl shadow-md overflow-hidden">
                            <!-- Student Header -->
                            <div class="bg-gradient-to-r from-teal-500 to-teal-600 p-4 text-white">
                                <div class="flex items-center gap-4">
                                    <img src="{{ asset('storage/' . $student->foto) }}"
                                        class="w-16 h-16 rounded-full object-cover border-2 border-white">
                                    <div class="flex-1">
                                        <h3 class="font-bold text-lg">{{ $student->name ?? 'Unknown Student' }}</h3>
                                        <p class="text-green-100">
                                            {{ $classes[$student->class_id ?? 0] ?? 'Unknown Class' }}</p>
                                        <p class="text-green-100 text-sm">{{ $student->phone_number ?? 'No Phone' }}
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <!-- Payment Information -->
                            <div class="px-6">
                                <div class="mb-4">

                                    <!-- Latest Payment -->
                                    @php $latestPayment = $payments->sortByDesc('payment_date')->first(); @endphp
                                    <div class="bg-gray-50 rounded-lg p-3 mb-3">
                                        <h4 class="font-medium text-gray-800 mb-2">Latest Payment</h4>
                                        <div class="grid grid-cols-2 gap-2 text-sm">
                                            <div>
                                                <span class="text-gray-600">Date:</span>
                                                <span
                                                    class="font-medium">{{ \Carbon\Carbon::parse($latestPayment->payment_date)->format('d M Y') }}</span>
                                            </div>
                                            <div>
                                                <span class="text-gray-600">Amount:</span>
                                                <span class="font-medium text-green-600">Rp
                                                    {{ number_format($payment->amount_paid, 0, ',', '.') }}</span>
                                            </div>
                                        </div>
                                        @if ($latestPayment->spp)
                                            <div class="mt-2">
                                                <span class="text-gray-600 text-xs">For SPP:</span>
                                                <span class="font-medium text-xs">{{ $latestPayment->spp->month }}
                                                    {{ $latestPayment->spp->year }}</span>
                                            </div>
                                        @endif
                                    </div>

                                    <!-- Payment Statistics -->
                                    <div class="grid grid-cols-2 gap-2 mb-3 place-items-center">
                                        <div class="bg-blue-50 rounded-lg p-3">
                                            <div class="text-center">
                                                <span
                                                    class="text-blue-700 font-bold text-lg">{{ $payments->where('status', '!=', 'disapproved')->count() }}
                                                </span>
                                                <p class="text-blue-600 text-xs">Total Payments</p>
                                            </div>
                                        </div>
                                        <div class="bg-green-50 rounded-lg p-3">
                                            <div class="text-center">
                                                <span class="text-green-700 font-bold text-sm">Rp
                                                    {{ number_format($payment->amount_paid) }}</span>
                                                <p class="text-green-600 text-xs">Total Amount</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="text-center mt-4">
                                        <a target="_blank" href={{asset('storage/' . $payment->image)}} class="bg-teal-600 hover:bg-teal-700 text-white font-medium py-2 px-4 rounded-lg transition-colors inline-block">
                                            View Bukti Pembayaran
                                        </a>
                                    </div>

                                    <!-- Actions -->
                                    <div class="flex justify-center items-center gap-2">
                                        <form action="{{ route('payments.update', $payment) }}" method="POST">
                                            @csrf
                                            @method('PUT')

                                            <button type="submit" name="status" value="approved"
                                                class="bg-green-500 text-white py-2 mt-3 px-3 rounded-lg text-sm font-medium hover:bg-green-800 transition-colors">
                                                Approve
                                            </button>

                                            <button type="submit" name="status" value="disapproved"
                                                class="bg-red-500 text-white py-2 mt-3 px-3 rounded-lg text-sm font-medium hover:bg-red-800 transition-colors">
                                                Disapprove
                                            </button>
                                        </form>



                                    </div>
                                </div>


                            </div>
                        </div>
                    @endif
                @endforeach
            </div>

            @if ($payments->where('status', 'paid')->count() == $payments->count())
                <div class="ml-8 mr-8 text-center py-16">
                    <div class="text-gray-400 mb-4">
                        <i class='bx bx-credit-card text-8xl'></i>
                    </div>
                    <h3 class="text-xl font-medium text-gray-600 mb-2">No Payment Records</h3>
                    <p class="text-gray-500">No payment records can be managed.</p>
                    {{-- <a href="{{ route('admin.payments.create') }}"
                        class="mt-4 inline-flex items-center gap-2 bg-teal-600 text-white py-2 px-4 rounded-lg font-medium hover:bg-green-800 transition-colors">
                        <i class='bx bx-plus'></i>
                        Create Payment
                    </a> --}}
                </div>
            @endif
        </div>

    </section>

    <script>
        function togglePaymentDetails(studentId) {
            const detailsDiv = document.getElementById('payment-details-' + studentId);
            if (detailsDiv.classList.contains('hidden')) {
                detailsDiv.classList.remove('hidden');
            } else {
                detailsDiv.classList.add('hidden');
            }
        }
    </script>

</body>

</html>
