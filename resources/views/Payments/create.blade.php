<!DOCTYPE html>
<html lang="en">

{{-- @if (session('role') != 'admin')
    <script>
        window.location.href = '/logout';
        alert('Access denied. Admins only.');
    </script>
@endif --}}

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Create Data</title>
</head>

<body>

    <section
        class="create bg-gradient-to-br from-teal-100 to-gray-100 flex items-center justify-center min-h-screen p-4">
        <div
            class="container bg-white p-8 rounded-2xl shadow-lg w-full max-w-md transition-all duration-300 hover:shadow-xl">
            <h1 class="text-3xl font-bold text-gray-800 mb-3 text-center">Payment Request</h1>
            <div class="line w-20 h-1 bg-teal-500 mx-auto mb-6 rounded-full"></div>

            <form action="{{ route('payments.store', $studentId) }}" method="POST" class="space-y-6" enctype="multipart/form-data">
                @csrf
                <div>
                    <label for="username" class="block text-sm font-semibold text-gray-700 mb-1">Spp</label>
                    <input disabled type="text" id="username" name="username"
                        value="Spp ID: {{ $sppId }} || Nominal: {{ $sppNominal }}"
                        class="w-full border border-gray-300 rounded-lg px-4 py-3 text-gray-700 focus:outline-none focus:ring-2 focus:ring-teal-400 focus:border-transparent transition duration-200" />
                </div>
                <input type="hidden" name="student_id" value={{$studentId}}>
                <input type="hidden" name="spp_id" value={{$sppId}}>
                <input type="hidden" name="amount_paid" value="{{$sppNominal}}">
                <input type="hidden" name="payment_date" value="{{ now()->format('Y-m-d H:i') }}">
                <div>
                    <label for="foto" class="block text-sm font-semibold text-gray-700 mb-1">Bukti
                        Pembayaran</label>
                    <input type="file" id="foto" name="foto" accept="image/*"
                        class="w-full border border-gray-300 rounded-lg px-4 py-3 text-gray-700 focus:outline-none focus:ring-2 focus:ring-teal-400 focus:border-transparent transition duration-200">
                    @error('foto')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-center space-x-4 pt-6">
                    <button type="submit"
                        class="bg-teal-600 text-white font-semibold px-6 py-3 rounded-lg">Send</button>
                    <a href="{{ url()->previous() }}" type="button"
                        class="bg-gray-500 text-white font-semibold px-6 py-3 rounded-lg">Back</a>
                </div>
            </form>
        </div>
    </section>

</body>

</html>
