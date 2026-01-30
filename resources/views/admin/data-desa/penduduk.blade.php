@extends('layouts.admin')

@section('title', 'Data Penduduk')

@section('content')
    <div class="space-y-6">
        <!-- Header -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Data Penduduk</h1>
                <p class="text-gray-600">Kelola data statistik kependudukan desa</p>
            </div>
            <button type="button" onclick="document.getElementById('import-modal').classList.remove('hidden')"
                class="inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white font-medium rounded-lg transition">
                <i class="fas fa-file-excel mr-2"></i>
                Import Data
            </button>
        </div>

        <!-- Statistics Cards -->
        <div class="grid md:grid-cols-4 gap-6">
            <div class="bg-white rounded-xl shadow-sm p-6">
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-primary-100 rounded-lg flex items-center justify-center mr-4">
                        <i class="fas fa-users text-xl text-primary-600"></i>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Total Penduduk</p>
                        <p class="text-2xl font-bold text-gray-800">{{ number_format($statistik['total'] ?? 0) }}</p>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-xl shadow-sm p-6">
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mr-4">
                        <i class="fas fa-male text-xl text-blue-600"></i>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Laki-laki</p>
                        <p class="text-2xl font-bold text-gray-800">{{ number_format($statistik['laki_laki'] ?? 0) }}</p>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-xl shadow-sm p-6">
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-pink-100 rounded-lg flex items-center justify-center mr-4">
                        <i class="fas fa-female text-xl text-pink-600"></i>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Perempuan</p>
                        <p class="text-2xl font-bold text-gray-800">{{ number_format($statistik['perempuan'] ?? 0) }}</p>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-xl shadow-sm p-6">
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center mr-4">
                        <i class="fas fa-home text-xl text-orange-600"></i>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Kepala Keluarga</p>
                        <p class="text-2xl font-bold text-gray-800">{{ number_format($statistik['kk'] ?? 0) }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Form Update -->
        <form action="{{ route('admin.data-desa.penduduk.update') }}" method="POST">
            @csrf
            @method('PUT')

            @if (session('success'))
                <div class="p-4 bg-green-100 border border-green-200 text-green-700 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Tabs -->
            <div x-data="{ activeTab: 'gender' }">
                <div class="bg-white rounded-xl shadow-sm">
                    <!-- Tab Navigation -->
                    <div class="border-b border-gray-200">
                        <nav class="flex overflow-x-auto">
                            <button type="button" @click="activeTab = 'gender'"
                                :class="activeTab === 'gender' ? 'border-primary-500 text-primary-600' :
                                    'border-transparent text-gray-500 hover:text-gray-700'"
                                class="px-6 py-4 text-sm font-medium border-b-2 whitespace-nowrap transition">
                                <i class="fas fa-venus-mars mr-2"></i> Jenis Kelamin
                            </button>
                            <button type="button" @click="activeTab = 'age'"
                                :class="activeTab === 'age' ? 'border-primary-500 text-primary-600' :
                                    'border-transparent text-gray-500 hover:text-gray-700'"
                                class="px-6 py-4 text-sm font-medium border-b-2 whitespace-nowrap transition">
                                <i class="fas fa-birthday-cake mr-2"></i> Kelompok Usia
                            </button>
                            <button type="button" @click="activeTab = 'education'"
                                :class="activeTab === 'education' ? 'border-primary-500 text-primary-600' :
                                    'border-transparent text-gray-500 hover:text-gray-700'"
                                class="px-6 py-4 text-sm font-medium border-b-2 whitespace-nowrap transition">
                                <i class="fas fa-graduation-cap mr-2"></i> Pendidikan
                            </button>
                            <button type="button" @click="activeTab = 'occupation'"
                                :class="activeTab === 'occupation' ? 'border-primary-500 text-primary-600' :
                                    'border-transparent text-gray-500 hover:text-gray-700'"
                                class="px-6 py-4 text-sm font-medium border-b-2 whitespace-nowrap transition">
                                <i class="fas fa-briefcase mr-2"></i> Pekerjaan
                            </button>
                            <button type="button" @click="activeTab = 'religion'"
                                :class="activeTab === 'religion' ? 'border-primary-500 text-primary-600' :
                                    'border-transparent text-gray-500 hover:text-gray-700'"
                                class="px-6 py-4 text-sm font-medium border-b-2 whitespace-nowrap transition">
                                <i class="fas fa-mosque mr-2"></i> Agama
                            </button>
                        </nav>
                    </div>

                    <!-- Tab Content -->
                    <div class="p-6">
                        <!-- Gender -->
                        <div x-show="activeTab === 'gender'">
                            <div class="grid md:grid-cols-3 gap-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Laki-laki</label>
                                    <input type="number" name="gender[laki_laki]"
                                        value="{{ old('gender.laki_laki', $data['gender']['laki_laki'] ?? 0) }}"
                                        min="0"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Perempuan</label>
                                    <input type="number" name="gender[perempuan]"
                                        value="{{ old('gender.perempuan', $data['gender']['perempuan'] ?? 0) }}"
                                        min="0"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Kepala Keluarga</label>
                                    <input type="number" name="gender[kk]"
                                        value="{{ old('gender.kk', $data['gender']['kk'] ?? 0) }}" min="0"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                                </div>
                            </div>
                        </div>

                        <!-- Age -->
                        <div x-show="activeTab === 'age'">
                            <div class="grid md:grid-cols-3 gap-6">
                                @php
                                    $ageGroups = [
                                        '0-4',
                                        '5-9',
                                        '10-14',
                                        '15-19',
                                        '20-24',
                                        '25-29',
                                        '30-34',
                                        '35-39',
                                        '40-44',
                                        '45-49',
                                        '50-54',
                                        '55-59',
                                        '60-64',
                                        '65+',
                                    ];
                                @endphp
                                @foreach ($ageGroups as $group)
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">{{ $group }}
                                            Tahun</label>
                                        <input type="number" name="age[{{ $group }}]"
                                            value="{{ old('age.' . $group, $data['age'][$group] ?? 0) }}" min="0"
                                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Education -->
                        <div x-show="activeTab === 'education'">
                            <div class="grid md:grid-cols-3 gap-6">
                                @php
                                    $educations = [
                                        'Tidak/Belum Sekolah',
                                        'Tidak Tamat SD',
                                        'Tamat SD',
                                        'SLTP/SMP',
                                        'SLTA/SMA',
                                        'D1/D2',
                                        'D3',
                                        'S1',
                                        'S2',
                                        'S3',
                                    ];
                                @endphp
                                @foreach ($educations as $edu)
                                    <div>
                                        <label
                                            class="block text-sm font-medium text-gray-700 mb-1">{{ $edu }}</label>
                                        <input type="number" name="education[{{ $edu }}]"
                                            value="{{ old('education.' . $edu, $data['education'][$edu] ?? 0) }}"
                                            min="0"
                                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Occupation -->
                        <div x-show="activeTab === 'occupation'">
                            <div class="grid md:grid-cols-3 gap-6">
                                @php
                                    $occupations = [
                                        'Petani',
                                        'Nelayan',
                                        'Buruh',
                                        'PNS',
                                        'TNI/Polri',
                                        'Pedagang',
                                        'Wiraswasta',
                                        'Karyawan Swasta',
                                        'Guru/Dosen',
                                        'Ibu Rumah Tangga',
                                        'Pelajar/Mahasiswa',
                                        'Tidak/Belum Bekerja',
                                        'Lainnya',
                                    ];
                                @endphp
                                @foreach ($occupations as $occ)
                                    <div>
                                        <label
                                            class="block text-sm font-medium text-gray-700 mb-1">{{ $occ }}</label>
                                        <input type="number" name="occupation[{{ $occ }}]"
                                            value="{{ old('occupation.' . $occ, $data['occupation'][$occ] ?? 0) }}"
                                            min="0"
                                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Religion -->
                        <div x-show="activeTab === 'religion'">
                            <div class="grid md:grid-cols-3 gap-6">
                                @php
                                    $religions = [
                                        'Islam',
                                        'Kristen',
                                        'Katolik',
                                        'Hindu',
                                        'Buddha',
                                        'Konghucu',
                                        'Lainnya',
                                    ];
                                @endphp
                                @foreach ($religions as $rel)
                                    <div>
                                        <label
                                            class="block text-sm font-medium text-gray-700 mb-1">{{ $rel }}</label>
                                        <input type="number" name="religion[{{ $rel }}]"
                                            value="{{ old('religion.' . $rel, $data['religion'][$rel] ?? 0) }}"
                                            min="0"
                                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- Footer -->
                    <div
                        class="px-6 py-4 bg-gray-50 border-t border-gray-200 rounded-b-xl flex items-center justify-between">
                        <p class="text-sm text-gray-500">
                            <i class="fas fa-info-circle mr-1"></i>
                            Terakhir diupdate: {{ $lastUpdated ?? '-' }}
                        </p>
                        <button type="submit"
                            class="px-6 py-2 bg-primary-600 hover:bg-primary-700 text-white font-medium rounded-lg transition">
                            <i class="fas fa-save mr-2"></i>
                            Simpan Data
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- Import Modal -->
    <div id="import-modal" class="fixed inset-0 z-50 hidden" x-data>
        <div class="absolute inset-0 bg-black/50"
            onclick="document.getElementById('import-modal').classList.add('hidden')"></div>
        <div class="absolute inset-0 flex items-center justify-center p-4">
            <div class="bg-white rounded-xl shadow-xl max-w-md w-full">
                <div class="p-6">
                    <h3 class="text-lg font-bold text-gray-800 mb-4">Import Data Penduduk</h3>
                    <form action="{{ route('admin.data-desa.penduduk.import') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">File Excel</label>
                            <input type="file" name="file" accept=".xlsx,.xls,.csv" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                            <p class="text-sm text-gray-500 mt-1">Format: .xlsx, .xls, .csv</p>
                        </div>
                        <div class="flex justify-end gap-3">
                            <button type="button"
                                onclick="document.getElementById('import-modal').classList.add('hidden')"
                                class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 font-medium rounded-lg transition">
                                Batal
                            </button>
                            <button type="submit"
                                class="px-4 py-2 bg-primary-600 hover:bg-primary-700 text-white font-medium rounded-lg transition">
                                <i class="fas fa-upload mr-1"></i> Import
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
