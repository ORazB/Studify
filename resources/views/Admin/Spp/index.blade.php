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

    <title>Studify | Admin Panel - SPP Management</title>

    <style>
        .title {
            border-bottom: 1px solid black;
        }

        .spp-card {
            transition: all 0.3s ease;
        }

        .spp-card:hover {
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
                        class="border-b-2 font-medium cursor-pointer px-2 pb-3 border-[#7AE2CF]">Spp</a>
                    <a href={{ route('admin.payments.index') }}
                        class="font-normal text-gray-700 cursor-pointer px-2 pb-3">Payments</a>
                </div>
            </div>

            <!-- Header Section -->
            <div class="ml-8 mb-6 flex justify-between items-center">
                <div class="flex items-center gap-8">
                    <h1 class="text-3xl font-bold text-gray-800">SPP Management</h1>
                    <div class="flex gap-4">
                        <div class="bg-teal-100 px-4 py-2 rounded-lg">
                            <span class="text-teal-700 font-medium">Total Students: {{ count($students) }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Class Filter -->
            <div class="ml-8 mb-8 flex gap-3">
                <a href="{{ route('admin.spp.index', ['class_id' => 'all']) }}"
                    class="px-4 py-2 rounded-lg text-sm font-medium {{ request('class_id') == 'all' || !request('class_id') ? 'bg-teal-700 text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }} transition-colors">
                    All Classes
                </a>

                @foreach ($classes as $id => $name)
                    <a href="{{ route('admin.spp.index', ['class_id' => $id]) }}"
                        class="px-4 py-2 rounded-lg text-sm font-medium {{ request('class_id') == $id ? 'bg-teal-700 text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }} transition-colors">
                        {{ $name }}
                    </a>
                @endforeach
            </div>

            <!-- Students SPP Cards -->
            <div class="ml-8 mr-8 grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-6">
                @foreach ($students as $student)
                    <div class="spp-card bg-white rounded-xl shadow-md overflow-hidden">
                        <!-- Student Header -->
                        <div class="bg-gradient-to-r from-teal-500 to-teal-600 p-4 text-white">
                            <div class="flex items-center gap-4">
                                <img src="{{ $student->foto ? asset('storage/' . $student->foto) : 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=80&h=80&fit=crop&crop=face&auto=format' }}"
                                    class="w-16 h-16 rounded-full object-cover border-2 border-white">
                                <div class="flex-1">
                                    <h3 class="font-bold text-lg">{{ $student->name }}</h3>
                                    <p class="text-teal-100">{{ $classes[$student->class_id] ?? 'Unknown' }}</p>
                                    <p class="text-teal-100 text-sm">{{ $student->phone_number }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="p-6">
                            @if ($student->spp)
                                <div class="mb-4">
                                    <div class="flex items-center justify-between mb-3">
                                        <span class="text-sm font-medium text-gray-600">SPP Record</span>
                                    </div>

                                    <!-- SPP Info -->
                                    <div class="bg-gray-50 rounded-lg p-3 mb-3">
                                        <h4 class="font-medium text-gray-800 mb-2">SPP Details</h4>
                                        <div class="grid grid-cols-2 gap-2 text-sm">
                                            <div>
                                                <span class="text-gray-600">Period:</span>
                                                <span class="font-medium">{{ $student->spp->month }}
                                                    {{ $student->spp->year }}</span>
                                            </div>
                                            <div>
                                                <span class="text-gray-600">Amount:</span>
                                                <span class="font-medium text-green-600">Rp
                                                    {{ number_format($student->spp->nominal, 0, ',', '.') }}</span>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Actions -->
                                    <div class="flex gap-2">
                                        <a href="{{ route('admin.spp.edit', $student->spp) }}"
                                            class="bg-teal-100 text-teal-700 py-2 px-3 rounded-lg text-sm font-medium hover:bg-teal-200 transition-colors">
                                            Edit SPP
                                        </a>
                                        <form action="{{ route('spp.destroy', $student->spp) }}"method="POST"
                                            onsubmit="return confirm('Delete this SPP record?')">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" name="student" value="{{ $student->student_id }}">

                                            <button type="submit"
                                                class="bg-red-100 text-red-700 py-2 px-3 rounded-lg text-sm font-medium hover:bg-red-200 transition-colors">
                                                Delete SPP
                                            </button>
                                        </form>

                                    </div>
                                </div>
                            @else
                                <div class="text-center py-8">
                                    <div class="text-gray-400 mb-4">
                                        <i class='bx bx-receipt text-6xl'></i>
                                    </div>
                                    <h4 class="text-gray-600 font-medium mb-2">No SPP Record</h4>
                                    <p class="text-gray-500 text-sm mb-4">This student doesn't have an SPP record yet.
                                    </p>
                                    <a href="{{ route('admin.spp.create', ['student_id' => $student->id]) }}"
                                        class="bg-teal-700 text-white py-2 px-4 rounded-lg text-sm font-medium hover:bg-teal-800 transition-colors inline-flex text-center items-center">
                                        <i class='bx bx-plus'></i> Create SPP
                                    </a>
                                </div>
                            @endif
                        </div>

                    </div>
                @endforeach
            </div>

            @if ($students->isEmpty())
                <div class="ml-8 mr-8 text-center py-16">
                    <div class="text-gray-400 mb-4">
                        <i class='bx bx-user-x text-8xl'></i>
                    </div>
                    <h3 class="text-xl font-medium text-gray-600 mb-2">No Students Found</h3>
                    <p class="text-gray-500">No students match the current filter criteria.</p>
                </div>
            @endif
        </div>

    </section>

    <script>
        function toggleSppDetails(studentId) {
            const detailsDiv = document.getElementById('spp-details-' + studentId);
            if (detailsDiv.classList.contains('hidden')) {
                detailsDiv.classList.remove('hidden');
            } else {
                detailsDiv.classList.add('hidden');
            }
        }
    </script>

</body>

</html>
