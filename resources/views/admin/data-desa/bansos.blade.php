@extends('layouts.admin')

@section('title', 'Data Bantuan Sosial')

@section('content')
    <div class="mb-6 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Data Bantuan Sosial</h1>
            <p class="text-gray-600">Kelola data penerima bantuan sosial desa</p>
        </div>
        <div>
            <button type="button" onclick="openModal()"
                class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                <i class="fas fa-plus mr-2"></i>Tambah Penerima
            </button>
        </div>
    </div>

    <!-- Summary Cards -->
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4 mb-8">
        @php
            $jenisBansos = [
                'bpjs' => ['label' => 'BPJS PBI', 'color' => 'blue', 'icon' => 'fa-id-card'],
                'pkh' => ['label' => 'PKH', 'color' => 'green', 'icon' => 'fa-hand-holding-heart'],
                'bpnt' => ['label' => 'BPNT', 'color' => 'yellow', 'icon' => 'fa-shopping-basket'],
                'blt' => ['label' => 'BLT', 'color' => 'purple', 'icon' => 'fa-money-bill'],
                'bst' => ['label' => 'BST', 'color' => 'red', 'icon' => 'fa-hands-helping'],
                'pstn' => ['label' => 'PSTN', 'color' => 'indigo', 'icon' => 'fa-users'],
            ];
        @endphp

        @foreach ($jenisBansos as $kode => $info)
            <div class="bg-white rounded-xl shadow-sm p-4">
                <div class="flex items-center justify-between mb-2">
                    <div class="w-10 h-10 bg-{{ $info['color'] }}-100 rounded-lg flex items-center justify-center">
                        <i class="fas {{ $info['icon'] }} text-{{ $info['color'] }}-600"></i>
                    </div>
                </div>
                <div class="text-2xl font-bold text-gray-800">{{ $counts[$kode] ?? 0 }}</div>
                <div class="text-sm text-gray-500">{{ $info['label'] }}</div>
            </div>
        @endforeach
    </div>

    <!-- Filter & Search -->
    <div class="bg-white rounded-xl shadow-sm p-6 mb-6">
        <form action="" method="GET" class="flex flex-col md:flex-row gap-4">
            <div class="flex-1">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama atau NIK..."
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500">
            </div>
            <div>
                <select name="jenis"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500">
                    <option value="">Semua Jenis</option>
                    @foreach ($jenisBansos as $kode => $info)
                        <option value="{{ $kode }}" {{ request('jenis') == $kode ? 'selected' : '' }}>
                            {{ $info['label'] }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <select name="tahun"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500">
                    <option value="">Semua Tahun</option>
                    @for ($y = date('Y'); $y >= 2020; $y--)
                        <option value="{{ $y }}" {{ request('tahun') == $y ? 'selected' : '' }}>
                            {{ $y }}</option>
                    @endfor
                </select>
            </div>
            <div class="flex gap-2">
                <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                    <i class="fas fa-search mr-2"></i>Cari
                </button>
                <a href="{{ route('admin.data.bansos') }}"
                    class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400">
                    Reset
                </a>
            </div>
        </form>
    </div>

    <!-- Data Table -->
    <div class="bg-white rounded-xl shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">NIK</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Alamat
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jenis
                            Bansos</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tahun
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($penerimaBansos ?? [] as $index => $penerima)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ ($penerimaBansos->currentPage() - 1) * $penerimaBansos->perPage() + $index + 1 }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800">
                                {{ $penerima->nik }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">
                                {{ $penerima->nama }}
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-600">
                                {{ Str::limit($penerima->alamat, 30) }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="px-2 py-1 text-xs font-medium rounded-full bg-{{ $jenisBansos[$penerima->jenis_bansos]['color'] ?? 'gray' }}-100 text-{{ $jenisBansos[$penerima->jenis_bansos]['color'] ?? 'gray' }}-800">
                                    {{ $jenisBansos[$penerima->jenis_bansos]['label'] ?? $penerima->jenis_bansos }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                {{ $penerima->tahun }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if ($penerima->is_active)
                                    <span
                                        class="px-2 py-1 text-xs font-medium rounded-full bg-green-100 text-green-800">Aktif</span>
                                @else
                                    <span
                                        class="px-2 py-1 text-xs font-medium rounded-full bg-red-100 text-red-800">Nonaktif</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex items-center gap-2">
                                    <button onclick="editPenerima({{ $penerima->id }})"
                                        class="text-blue-600 hover:text-blue-800">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <form action="{{ route('admin.data.bansos.destroy', $penerima) }}" method="POST"
                                        class="inline" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-6 py-12 text-center text-gray-500">
                                <div class="flex flex-col items-center">
                                    <i class="fas fa-inbox text-4xl text-gray-300 mb-4"></i>
                                    <p>Belum ada data penerima bansos</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if (isset($penerimaBansos) && $penerimaBansos->hasPages())
            <div class="px-6 py-4 border-t border-gray-200">
                {{ $penerimaBansos->links() }}
            </div>
        @endif
    </div>

    <!-- Import Section -->
    <div class="bg-white rounded-xl shadow-sm p-6 mt-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Import Data</h3>
        <form action="{{ route('admin.data.bansos.import') }}" method="POST" enctype="multipart/form-data"
            class="flex flex-col md:flex-row gap-4">
            @csrf
            <div class="flex-1">
                <input type="file" name="file" accept=".xlsx,.xls,.csv" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500">
                <p class="text-xs text-gray-500 mt-1">Format: Excel (.xlsx, .xls) atau CSV</p>
            </div>
            <div>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                    <i class="fas fa-upload mr-2"></i>Import
                </button>
            </div>
            <div>
                <a href="#"
                    class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 inline-block">
                    <i class="fas fa-download mr-2"></i>Template
                </a>
            </div>
        </form>
    </div>

    <!-- Modal -->
    <div id="modal" class="fixed inset-0 bg-black/50 z-50 hidden items-center justify-center">
        <div class="bg-white rounded-xl shadow-xl max-w-lg w-full mx-4 max-h-[90vh] overflow-y-auto">
            <div class="p-6 border-b border-gray-200">
                <h3 class="text-xl font-semibold text-gray-800" id="modalTitle">Tambah Penerima Bansos</h3>
            </div>
            <form id="bansosForm" method="POST" class="p-6">
                @csrf
                <div id="methodField"></div>

                <div class="grid gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">NIK <span
                                class="text-red-500">*</span></label>
                        <input type="text" name="nik" id="nik" required maxlength="16"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nama <span
                                class="text-red-500">*</span></label>
                        <input type="text" name="nama" id="nama" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Alamat</label>
                        <textarea name="alamat" id="alamat" rows="2"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500"></textarea>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Jenis Bansos <span
                                    class="text-red-500">*</span></label>
                            <select name="jenis_bansos" id="jenis_bansos" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500">
                                @foreach ($jenisBansos as $kode => $info)
                                    <option value="{{ $kode }}">{{ $info['label'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Tahun <span
                                    class="text-red-500">*</span></label>
                            <select name="tahun" id="tahun" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500">
                                @for ($y = date('Y'); $y >= 2020; $y--)
                                    <option value="{{ $y }}">{{ $y }}</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                    <div>
                        <label class="flex items-center">
                            <input type="checkbox" name="is_active" id="is_active" value="1" checked
                                class="rounded border-gray-300 text-green-600 focus:ring-green-500 mr-2">
                            <span class="text-sm text-gray-700">Status Aktif</span>
                        </label>
                    </div>
                </div>

                <div class="flex justify-end gap-4 mt-6 pt-6 border-t border-gray-200">
                    <button type="button" onclick="closeModal()"
                        class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50">
                        Batal
                    </button>
                    <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function openModal() {
            document.getElementById('modal').classList.remove('hidden');
            document.getElementById('modal').classList.add('flex');
            document.getElementById('modalTitle').textContent = 'Tambah Penerima Bansos';
            document.getElementById('bansosForm').action = '{{ route('admin.data.bansos.store') }}';
            document.getElementById('methodField').innerHTML = '';
            document.getElementById('bansosForm').reset();
        }

        function closeModal() {
            document.getElementById('modal').classList.add('hidden');
            document.getElementById('modal').classList.remove('flex');
        }

        function editPenerima(id) {
            // Fetch data and populate form
            fetch('/admin/data/bansos/' + id + '/edit')
                .then(response => response.json())
                .then(data => {
                    document.getElementById('modal').classList.remove('hidden');
                    document.getElementById('modal').classList.add('flex');
                    document.getElementById('modalTitle').textContent = 'Edit Penerima Bansos';
                    document.getElementById('bansosForm').action = '/admin/data/bansos/' + id;
                    document.getElementById('methodField').innerHTML = '@method('PUT')';

                    document.getElementById('nik').value = data.nik;
                    document.getElementById('nama').value = data.nama;
                    document.getElementById('alamat').value = data.alamat || '';
                    document.getElementById('jenis_bansos').value = data.jenis_bansos;
                    document.getElementById('tahun').value = data.tahun;
                    document.getElementById('is_active').checked = data.is_active;
                });
        }

        // Close modal when clicking outside
        document.getElementById('modal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeModal();
            }
        });
    </script>
@endpush
