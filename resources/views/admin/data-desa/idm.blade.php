@extends('layouts.admin')

@section('title', 'Data IDM')

@section('content')
    <div class="space-y-6">
        <!-- Header -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Indeks Desa Membangun (IDM)</h1>
                <p class="text-gray-600">Kelola data IDM Desa</p>
            </div>
            <div class="flex items-center gap-3">
                <select id="tahun"
                    class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                    onchange="window.location.href='?tahun='+this.value">
                    @for ($y = date('Y'); $y >= 2020; $y--)
                        <option value="{{ $y }}" {{ request('tahun', date('Y')) == $y ? 'selected' : '' }}>
                            {{ $y }}</option>
                    @endfor
                </select>
            </div>
        </div>

        <!-- IDM Score Card -->
        <div class="bg-gradient-to-br from-primary-600 to-primary-700 rounded-2xl shadow-lg p-8 text-white">
            <div class="grid md:grid-cols-4 gap-6 items-center">
                <div class="text-center md:border-r md:border-white/20">
                    <p class="text-primary-200 text-sm">Skor IDM {{ request('tahun', date('Y')) }}</p>
                    <p class="text-5xl font-bold mt-2">{{ number_format($idm['skor'] ?? 0, 4) }}</p>
                    <p class="mt-2 px-3 py-1 bg-white/20 rounded-full inline-block text-sm font-medium">
                        {{ $idm['status'] ?? 'Belum Diisi' }}
                    </p>
                </div>
                <div class="text-center">
                    <div class="w-16 h-16 bg-white/20 rounded-xl flex items-center justify-center mx-auto mb-2">
                        <i class="fas fa-users text-2xl"></i>
                    </div>
                    <p class="text-3xl font-bold">{{ number_format($idm['iks'] ?? 0, 4) }}</p>
                    <p class="text-primary-200 text-sm">IKS (Sosial)</p>
                </div>
                <div class="text-center">
                    <div class="w-16 h-16 bg-white/20 rounded-xl flex items-center justify-center mx-auto mb-2">
                        <i class="fas fa-chart-line text-2xl"></i>
                    </div>
                    <p class="text-3xl font-bold">{{ number_format($idm['ike'] ?? 0, 4) }}</p>
                    <p class="text-primary-200 text-sm">IKE (Ekonomi)</p>
                </div>
                <div class="text-center">
                    <div class="w-16 h-16 bg-white/20 rounded-xl flex items-center justify-center mx-auto mb-2">
                        <i class="fas fa-leaf text-2xl"></i>
                    </div>
                    <p class="text-3xl font-bold">{{ number_format($idm['ikl'] ?? 0, 4) }}</p>
                    <p class="text-primary-200 text-sm">IKL (Lingkungan)</p>
                </div>
            </div>
        </div>

        <!-- Status Legend -->
        <div class="bg-white rounded-xl shadow-sm p-6">
            <h3 class="font-semibold text-gray-800 mb-4">Klasifikasi Status Desa</h3>
            <div class="grid grid-cols-2 md:grid-cols-5 gap-4">
                <div class="flex items-center gap-2">
                    <span class="w-4 h-4 rounded bg-red-500"></span>
                    <span class="text-sm text-gray-600">Sangat Tertinggal (&lt;0.491)</span>
                </div>
                <div class="flex items-center gap-2">
                    <span class="w-4 h-4 rounded bg-orange-500"></span>
                    <span class="text-sm text-gray-600">Tertinggal (0.491-0.599)</span>
                </div>
                <div class="flex items-center gap-2">
                    <span class="w-4 h-4 rounded bg-yellow-500"></span>
                    <span class="text-sm text-gray-600">Berkembang (0.599-0.707)</span>
                </div>
                <div class="flex items-center gap-2">
                    <span class="w-4 h-4 rounded bg-blue-500"></span>
                    <span class="text-sm text-gray-600">Maju (0.707-0.815)</span>
                </div>
                <div class="flex items-center gap-2">
                    <span class="w-4 h-4 rounded bg-green-500"></span>
                    <span class="text-sm text-gray-600">Mandiri (&gt;0.815)</span>
                </div>
            </div>
        </div>

        <!-- Form -->
        <form action="{{ route('admin.data.idm.update') }}" method="POST">
            @csrf
            @method('PUT')
            <input type="hidden" name="tahun" value="{{ request('tahun', date('Y')) }}">

            @if (session('success'))
                <div class="p-4 bg-green-100 border border-green-200 text-green-700 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Tabs -->
            <div x-data="{ activeTab: 'iks' }">
                <div class="bg-white rounded-xl shadow-sm">
                    <!-- Tab Navigation -->
                    <div class="border-b border-gray-200">
                        <nav class="flex overflow-x-auto">
                            <button type="button" @click="activeTab = 'iks'"
                                :class="activeTab === 'iks' ? 'border-primary-500 text-primary-600' :
                                    'border-transparent text-gray-500 hover:text-gray-700'"
                                class="px-6 py-4 text-sm font-medium border-b-2 whitespace-nowrap transition">
                                <i class="fas fa-users mr-2"></i> IKS (Ketahanan Sosial)
                            </button>
                            <button type="button" @click="activeTab = 'ike'"
                                :class="activeTab === 'ike' ? 'border-primary-500 text-primary-600' :
                                    'border-transparent text-gray-500 hover:text-gray-700'"
                                class="px-6 py-4 text-sm font-medium border-b-2 whitespace-nowrap transition">
                                <i class="fas fa-chart-line mr-2"></i> IKE (Ketahanan Ekonomi)
                            </button>
                            <button type="button" @click="activeTab = 'ikl'"
                                :class="activeTab === 'ikl' ? 'border-primary-500 text-primary-600' :
                                    'border-transparent text-gray-500 hover:text-gray-700'"
                                class="px-6 py-4 text-sm font-medium border-b-2 whitespace-nowrap transition">
                                <i class="fas fa-leaf mr-2"></i> IKL (Ketahanan Lingkungan)
                            </button>
                        </nav>
                    </div>

                    <!-- Tab Content -->
                    <div class="p-6">
                        <!-- IKS -->
                        <div x-show="activeTab === 'iks'" class="space-y-6">
                            <p class="text-sm text-gray-500 mb-4">Masukkan skor indikator (0-5 atau sesuai kriteria)</p>

                            <div class="bg-blue-50 rounded-lg p-4">
                                <h4 class="font-semibold text-blue-800 mb-4">Kesehatan</h4>
                                <div class="grid md:grid-cols-2 gap-4">
                                    @php $iksKesehatan = ['Akses ke Puskesmas', 'Akses ke RS', 'Akses ke Bidan/Mantri', 'Ketersediaan Dokter', 'Akses Jamkesmas']; @endphp
                                    @foreach ($iksKesehatan as $item)
                                        <div>
                                            <label class="block text-sm text-gray-600 mb-1">{{ $item }}</label>
                                            <input type="number" name="iks[kesehatan][{{ Str::slug($item) }}]"
                                                value="{{ old('iks.kesehatan.' . Str::slug($item), $data['iks']['kesehatan'][Str::slug($item)] ?? '') }}"
                                                min="0" max="5" step="0.01"
                                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                                                placeholder="0-5">
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <div class="bg-green-50 rounded-lg p-4">
                                <h4 class="font-semibold text-green-800 mb-4">Pendidikan</h4>
                                <div class="grid md:grid-cols-2 gap-4">
                                    @php $iksPendidikan = ['Akses ke TK/PAUD', 'Akses ke SD', 'Akses ke SMP', 'Akses ke SMA', 'Kegiatan Kejar Paket']; @endphp
                                    @foreach ($iksPendidikan as $item)
                                        <div>
                                            <label class="block text-sm text-gray-600 mb-1">{{ $item }}</label>
                                            <input type="number" name="iks[pendidikan][{{ Str::slug($item) }}]"
                                                value="{{ old('iks.pendidikan.' . Str::slug($item), $data['iks']['pendidikan'][Str::slug($item)] ?? '') }}"
                                                min="0" max="5" step="0.01"
                                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                                                placeholder="0-5">
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <div class="bg-purple-50 rounded-lg p-4">
                                <h4 class="font-semibold text-purple-800 mb-4">Modal Sosial</h4>
                                <div class="grid md:grid-cols-2 gap-4">
                                    @php $iksSosial = ['Keberagaman Etnis', 'Gotong Royong', 'Toleransi', 'Rasa Aman Penduduk', 'Kesejahteraan Sosial']; @endphp
                                    @foreach ($iksSosial as $item)
                                        <div>
                                            <label class="block text-sm text-gray-600 mb-1">{{ $item }}</label>
                                            <input type="number" name="iks[sosial][{{ Str::slug($item) }}]"
                                                value="{{ old('iks.sosial.' . Str::slug($item), $data['iks']['sosial'][Str::slug($item)] ?? '') }}"
                                                min="0" max="5" step="0.01"
                                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                                                placeholder="0-5">
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <div class="bg-orange-50 rounded-lg p-4">
                                <h4 class="font-semibold text-orange-800 mb-4">Permukiman</h4>
                                <div class="grid md:grid-cols-2 gap-4">
                                    @php $iksPermukiman = ['Akses Air Bersih', 'Akses Sanitasi', 'Akses Listrik', 'Akses Informasi/Komunikasi', 'Rumah Layak Huni']; @endphp
                                    @foreach ($iksPermukiman as $item)
                                        <div>
                                            <label class="block text-sm text-gray-600 mb-1">{{ $item }}</label>
                                            <input type="number" name="iks[permukiman][{{ Str::slug($item) }}]"
                                                value="{{ old('iks.permukiman.' . Str::slug($item), $data['iks']['permukiman'][Str::slug($item)] ?? '') }}"
                                                min="0" max="5" step="0.01"
                                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                                                placeholder="0-5">
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <!-- IKE -->
                        <div x-show="activeTab === 'ike'" class="space-y-6">
                            <p class="text-sm text-gray-500 mb-4">Masukkan skor indikator (0-5 atau sesuai kriteria)</p>

                            <div class="bg-emerald-50 rounded-lg p-4">
                                <h4 class="font-semibold text-emerald-800 mb-4">Keragaman Produksi</h4>
                                <div class="grid md:grid-cols-2 gap-4">
                                    @php $ikeProduski = ['Toko/Warung', 'Pasar', 'Restoran/Rumah Makan', 'Hotel/Penginapan', 'Industri Kecil/Kerajinan']; @endphp
                                    @foreach ($ikeProduski as $item)
                                        <div>
                                            <label class="block text-sm text-gray-600 mb-1">{{ $item }}</label>
                                            <input type="number" name="ike[produksi][{{ Str::slug($item) }}]"
                                                value="{{ old('ike.produksi.' . Str::slug($item), $data['ike']['produksi'][Str::slug($item)] ?? '') }}"
                                                min="0" max="5" step="0.01"
                                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                                                placeholder="0-5">
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <div class="bg-cyan-50 rounded-lg p-4">
                                <h4 class="font-semibold text-cyan-800 mb-4">Perdagangan</h4>
                                <div class="grid md:grid-cols-2 gap-4">
                                    @php $ikePerdagangan = ['Akses Kredit/Pinjaman', 'Lembaga Perbankan', 'BUMDes', 'Koperasi', 'Akses Logistik']; @endphp
                                    @foreach ($ikePerdagangan as $item)
                                        <div>
                                            <label class="block text-sm text-gray-600 mb-1">{{ $item }}</label>
                                            <input type="number" name="ike[perdagangan][{{ Str::slug($item) }}]"
                                                value="{{ old('ike.perdagangan.' . Str::slug($item), $data['ike']['perdagangan'][Str::slug($item)] ?? '') }}"
                                                min="0" max="5" step="0.01"
                                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                                                placeholder="0-5">
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <div class="bg-teal-50 rounded-lg p-4">
                                <h4 class="font-semibold text-teal-800 mb-4">Akses Distribusi/Logistik</h4>
                                <div class="grid md:grid-cols-2 gap-4">
                                    @php $ikeDistribusi = ['Kantor Pos', 'Jasa Pengiriman', 'Sarana Transportasi Umum']; @endphp
                                    @foreach ($ikeDistribusi as $item)
                                        <div>
                                            <label class="block text-sm text-gray-600 mb-1">{{ $item }}</label>
                                            <input type="number" name="ike[distribusi][{{ Str::slug($item) }}]"
                                                value="{{ old('ike.distribusi.' . Str::slug($item), $data['ike']['distribusi'][Str::slug($item)] ?? '') }}"
                                                min="0" max="5" step="0.01"
                                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                                                placeholder="0-5">
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <!-- IKL -->
                        <div x-show="activeTab === 'ikl'" class="space-y-6">
                            <p class="text-sm text-gray-500 mb-4">Masukkan skor indikator (0-5 atau sesuai kriteria)</p>

                            <div class="bg-lime-50 rounded-lg p-4">
                                <h4 class="font-semibold text-lime-800 mb-4">Kualitas Lingkungan</h4>
                                <div class="grid md:grid-cols-2 gap-4">
                                    @php $iklKualitas = ['Pencemaran Air', 'Pencemaran Tanah', 'Pencemaran Udara', 'Pengelolaan Sampah', 'Kawasan Kumuh']; @endphp
                                    @foreach ($iklKualitas as $item)
                                        <div>
                                            <label class="block text-sm text-gray-600 mb-1">{{ $item }}</label>
                                            <input type="number" name="ikl[kualitas][{{ Str::slug($item) }}]"
                                                value="{{ old('ikl.kualitas.' . Str::slug($item), $data['ikl']['kualitas'][Str::slug($item)] ?? '') }}"
                                                min="0" max="5" step="0.01"
                                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                                                placeholder="0-5">
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <div class="bg-amber-50 rounded-lg p-4">
                                <h4 class="font-semibold text-amber-800 mb-4">Potensi/Rawan Bencana</h4>
                                <div class="grid md:grid-cols-2 gap-4">
                                    @php $iklBencana = ['Tanah Longsor', 'Banjir', 'Kekeringan', 'Gempa Bumi', 'Kebakaran Hutan']; @endphp
                                    @foreach ($iklBencana as $item)
                                        <div>
                                            <label class="block text-sm text-gray-600 mb-1">{{ $item }}</label>
                                            <input type="number" name="ikl[bencana][{{ Str::slug($item) }}]"
                                                value="{{ old('ikl.bencana.' . Str::slug($item), $data['ikl']['bencana'][Str::slug($item)] ?? '') }}"
                                                min="0" max="5" step="0.01"
                                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                                                placeholder="0-5">
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <div class="bg-rose-50 rounded-lg p-4">
                                <h4 class="font-semibold text-rose-800 mb-4">Tanggap Bencana</h4>
                                <div class="grid md:grid-cols-2 gap-4">
                                    @php $iklTanggap = ['Peringatan Dini Bencana', 'Jalur Evakuasi', 'Penanggulangan Bencana']; @endphp
                                    @foreach ($iklTanggap as $item)
                                        <div>
                                            <label class="block text-sm text-gray-600 mb-1">{{ $item }}</label>
                                            <input type="number" name="ikl[tanggap][{{ Str::slug($item) }}]"
                                                value="{{ old('ikl.tanggap.' . Str::slug($item), $data['ikl']['tanggap'][Str::slug($item)] ?? '') }}"
                                                min="0" max="5" step="0.01"
                                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                                                placeholder="0-5">
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Footer -->
                    <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 rounded-b-xl flex items-center justify-end">
                        <button type="submit"
                            class="px-6 py-2 bg-primary-600 hover:bg-primary-700 text-white font-medium rounded-lg transition">
                            <i class="fas fa-save mr-2"></i>
                            Simpan & Hitung IDM
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
