<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script src="https://unpkg.com/boxicons@2.1.3/dist/boxicons.js"></script>

    <title>Studify | Admin Panel - Spp</title>

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
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h4>Tambah SPP Baru</h4>
                    </div>
                    <div class="card-body">

                        <form action="{{ route('spp.store') }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label for="year" class="form-label">Tahun</label>
                                <input type="number" class="form-control @error('year') is-invalid @enderror"
                                    id="year" name="year" value="{{ old('year') }}" min="2020"
                                    max="2030" required>
                                @error('year')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="month" class="form-label">Bulan</label>
                                <select class="form-control @error('month') is-invalid @enderror" id="month"
                                    name="month" required>
                                    <option value="">Pilih Bulan</option>
                                    @php
                                        $months = [
                                            'January' => 'Januari',
                                            'February' => 'Februari',
                                            'March' => 'Maret',
                                            'April' => 'April',
                                            'May' => 'Mei',
                                            'June' => 'Juni',
                                            'July' => 'Juli',
                                            'August' => 'Agustus',
                                            'September' => 'September',
                                            'October' => 'Oktober',
                                            'November' => 'November',
                                            'December' => 'Desember',
                                        ];
                                    @endphp
                                    @foreach ($months as $value => $label)
                                        <option value="{{ $value }}"
                                            {{ old('month') == $value ? 'selected' : '' }}>
                                            {{ $label }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('month')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="student" class="form-label">Select Student</label>
                                <select name="student" id="student" class="form-control" required>
                                    <option value="" disabled selected>-- Choose a student --</option>
                                    @foreach ($students as $student)
                                        <option value="{{ $student->student_id }}">{{ $student->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="nominal" class="form-label">Nominal (Rp)</label>
                                <input type="number" class="form-control @error('nominal') is-invalid @enderror"
                                    id="nominal" name="nominal" value="{{ old('nominal') }}" min="0"
                                    step="1000" placeholder="Contoh: 150000" required>
                                @error('nominal')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-flex justify-content-between">
                                <a href="{{ route('spp.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left"></i> Kembali
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save"></i> Simpan SPP
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
