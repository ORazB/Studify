<!DOCTYPE html>
<html lang="en">

@if (!session('role') == 'admin')
    <script>
        window.location.href = '/login';
        alert('Access denied. Admins only.');
    </script>
@endif

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
            box-shadow: 0 8px 25px rgba(0,0,0,0.1);
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
                            <span class="text-teal-700 font-medium">Total Payments: {{ count($payments) }}</span>
                        </div>
                        <div class="bg-green-100 px-4 py-2 rounded-lg">
                            <span class="text-green-700 font-medium">Total Revenue: Rp {{ number_format($payments->sum('amount_paid'), 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>
                <a href={{ route('admin.payments.create') }}
                    class="bg-teal-700 hover:bg-teal-800 cursor-pointer py-3 px-6 text-white font-medium rounded-lg transition-colors flex items-center gap-2">
                    <i class='bx bx-plus text-xl'></i>
                    Add New Payment
                </a>
            </div>

            <!-- Students Payment Cards (Grouped by Student) -->
            <div class="ml-8 mr-8 grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-6">
                @php 
                    $groupedPayments = $payments->groupBy('student_id');
                    $classes = [
                        1 => 'PPLG',
                        2 => 'TJKT', 
                        3 => 'Akuntansi',
                        4 => 'DKV',
                    ];
                @endphp

                @foreach ($groupedPayments as $studentId => $studentPayments)
                    @php $student = $studentPayments->first()->student; @endphp
                    <div class="payment-card bg-white rounded-xl shadow-md overflow-hidden">
                        <!-- Student Header -->
                        <div class="bg-gradient-to-r from-green-500 to-green-600 p-4 text-white">
                            <div class="flex items-center gap-4">
                                <img src="{{ $student->foto ?? 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=80&h=80&fit=crop&crop=face&auto=format' }}" 
                                     class="w-16 h-16 rounded-full object-cover border-2 border-white">
                                <div class="flex-1">
                                    <h3 class="font-bold text-lg">{{ $student->name ?? 'Unknown Student' }}</h3>
                                    <p class="text-green-100">{{ $classes[$student->class_id ?? 0] ?? 'Unknown Class' }}</p>
                                    <p class="text-green-100 text-sm">{{ $student->phone_number ?? 'No Phone' }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Payment Information -->
                        <div class="p-6">
                            <div class="mb-4">
                                <div class="flex items-center justify-between mb-3">
                                    <span class="text-sm font-medium text-gray-600">Payment Records</span>
                                    <span class="bg-green-100 text-green-700 px-2 py-1 rounded-full text-xs font-medium">
                                        {{ $studentPayments->count() }} Payments
                                    </span>
                                </div>

                                <!-- Latest Payment -->
                                @php $latestPayment = $studentPayments->sortByDesc('payment_date')->first(); @endphp
                                <div class="bg-gray-50 rounded-lg p-3 mb-3">
                                    <h4 class="font-medium text-gray-800 mb-2">Latest Payment</h4>
                                    <div class="grid grid-cols-2 gap-2 text-sm">
                                        <div>
                                            <span class="text-gray-600">Date:</span>
                                            <span class="font-medium">{{ \Carbon\Carbon::parse($latestPayment->payment_date)->format('d M Y') }}</span>
                                        </div>
                                        <div>
                                            <span class="text-gray-600">Amount:</span>
                                            <span class="font-medium text-green-600">Rp {{ number_format($latestPayment->amount_paid, 0, ',', '.') }}</span>
                                        </div>
                                    </div>
                                    @if($latestPayment->spp)
                                        <div class="mt-2">
                                            <span class="text-gray-600 text-xs">For SPP:</span>
                                            <span class="font-medium text-xs">{{ $latestPayment->spp->month }} {{ $latestPayment->spp->year }}</span>
                                        </div>
                                    @endif
                                </div>

                                <!-- Payment Statistics -->
                                <div class="grid grid-cols-2 gap-2 mb-3">
                                    <div class="bg-blue-50 rounded-lg p-3">
                                        <div class="text-center">
                                            <span class="text-blue-700 font-bold text-lg">{{ $studentPayments->count() }}</span>
                                            <p class="text-blue-600 text-xs">Total Payments</p>
                                        </div>
                                    </div>
                                    <div class="bg-green-50 rounded-lg p-3">
                                        <div class="text-center">
                                            <span class="text-green-700 font-bold text-sm">Rp {{ number_format($studentPayments->sum('amount_paid'), 0, ',', '.') }}</span>
                                            <p class="text-green-600 text-xs">Total Amount</p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Average Payment -->
                                <div class="bg-purple-50 rounded-lg p-3 mb-3">
                                    <div class="flex justify-between items-center">
                                        <span class="text-purple-700 font-medium text-sm">Average Payment:</span>
                                        <span class="text-purple-800 font-bold text-sm">Rp {{ number_format($studentPayments->avg('amount_paid'), 0, ',', '.') }}</span>
                                    </div>
                                </div>

                                <!-- Actions -->
                                <div class="flex gap-2">
                                    <button onclick="togglePaymentDetails('{{ $studentId }}')" 
                                            class="flex-1 bg-green-100 text-green-700 py-2 px-3 rounded-lg text-sm font-medium hover:bg-green-200 transition-colors">
                                        View All Payments
                                    </button>
                                    <a href="{{ route('admin.payments.create', ['student_id' => $studentId]) }}" 
                                       class="bg-green-700 text-white py-2 px-3 rounded-lg text-sm font-medium hover:bg-green-800 transition-colors">
                                        Add Payment
                                    </a>
                                </div>
                            </div>

                            <!-- Hidden Payment Details -->
                            <div id="payment-details-{{ $studentId }}" class="hidden mt-4 border-t pt-4">
                                <h5 class="font-medium text-gray-800 mb-3">All Payment Records</h5>
                                <div class="space-y-2 max-h-40 overflow-y-auto">
                                    @foreach($studentPayments->sortByDesc('payment_date') as $payment)
                                        <div class="flex justify-between items-center p-2 bg-gray-50 rounded">
                                            <div>
                                                <div class="font-medium text-sm">{{ \Carbon\Carbon::parse($payment->payment_date)->format('d M Y') }}</div>
                                                @if($payment->spp)
                                                    <div class="text-xs text-gray-600">SPP: {{ $payment->spp->month }} {{ $payment->spp->year }}</div>
                                                @endif
                                            </div>
                                            <div class="flex items-center gap-2">
                                                <span class="text-green-600 font-medium text-sm">Rp {{ number_format($payment->amount_paid, 0, ',', '.') }}</span>
                                                <div class="flex gap-1">
                                                    <a href="{{ route('admin.payments.edit', $payment) }}" class="p-1">
                                                        <box-icon type="regular" color="#077A7D" name="edit" size="16px"></box-icon>
                                                    </a>
                                                    <form action="{{ route('admin.payments.destroy', $payment) }}" method="POST" 
                                                          onsubmit="return confirm('Delete this payment record?')" class="inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="p-1">
                                                            <box-icon type="regular" color="#dc2626" name="trash" size="16px"></box-icon>
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            @if($payments->isEmpty())
                <div class="ml-8 mr-8 text-center py-16">
                    <div class="text-gray-400 mb-4">
                        <i class='bx bx-credit-card text-8xl'></i>
                    </div>
                    <h3 class="text-xl font-medium text-gray-600 mb-2">No Payment Records</h3>
                    <p class="text-gray-500">No payment records have been created yet.</p>
                    <a href="{{ route('admin.payments.create') }}" 
                       class="mt-4 inline-flex items-center gap-2 bg-green-700 text-white py-2 px-4 rounded-lg font-medium hover:bg-green-800 transition-colors">
                        <i class='bx bx-plus'></i>
                        Create First Payment
                    </a>
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