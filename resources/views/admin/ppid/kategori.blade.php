@extends('layouts.admin')

@section('title', 'Kategori PPID')

@section('content')
    <div class="space-y-6">
        <!-- Header -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Kategori PPID</h1>
                <p class="text-gray-600">Kelola kategori dokumen PPID</p>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('admin.ppid.index') }}"
                    class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium rounded-lg transition flex items-center gap-2">
                    <i class="fas fa-arrow-left"></i>
                    <span>Kembali</span>
                </a>
                <button type="button" onclick="openModal('addModal')"
                    class="px-4 py-2 bg-primary-600 hover:bg-primary-700 text-white font-medium rounded-lg transition flex items-center gap-2">
                    <i class="fas fa-plus"></i>
                    <span>Tambah Kategori</span>
                </button>
            </div>
        </div>

        @if (session('success'))
            <div class="p-4 bg-green-100 border border-green-200 text-green-700 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="p-4 bg-red-100 border border-red-200 text-red-700 rounded-lg">
                {{ session('error') }}
            </div>
        @endif

        <!-- Table -->
        <div class="bg-white rounded-xl shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Urutan</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Nama Kategori</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Jenis Informasi</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Jumlah Dokumen</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Status</th>
                            <th class="px-6 py-3 text-right text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse($kategoris as $kategori)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 text-gray-600">{{ $kategori->urutan ?? '-' }}</td>
                                <td class="px-6 py-4">
                                    <div>
                                        <span class="font-medium text-gray-800">{{ $kategori->nama }}</span>
                                        @if ($kategori->deskripsi)
                                            <p class="text-sm text-gray-500 line-clamp-1">{{ $kategori->deskripsi }}</p>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    @php
                                        $jenisLabels = [
                                            'berkala' => ['label' => 'Berkala', 'class' => 'bg-blue-100 text-blue-700'],
                                            'serta_merta' => [
                                                'label' => 'Serta Merta',
                                                'class' => 'bg-orange-100 text-orange-700',
                                            ],
                                            'setiap_saat' => [
                                                'label' => 'Setiap Saat',
                                                'class' => 'bg-green-100 text-green-700',
                                            ],
                                        ];
                                        $jenis = $jenisLabels[$kategori->jenis] ?? [
                                            'label' => '-',
                                            'class' => 'bg-gray-100 text-gray-700',
                                        ];
                                    @endphp
                                    <span class="px-3 py-1 rounded-full text-sm {{ $jenis['class'] }}">
                                        {{ $jenis['label'] }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="px-3 py-1 bg-primary-100 text-primary-700 rounded-full text-sm">
                                        {{ $kategori->dokumen_count ?? 0 }} dokumen
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    @if ($kategori->is_active)
                                        <span
                                            class="inline-flex items-center gap-1 px-3 py-1 bg-green-100 text-green-700 rounded-full text-sm">
                                            <i class="fas fa-check-circle text-xs"></i>
                                            Aktif
                                        </span>
                                    @else
                                        <span
                                            class="inline-flex items-center gap-1 px-3 py-1 bg-gray-100 text-gray-600 rounded-full text-sm">
                                            <i class="fas fa-times-circle text-xs"></i>
                                            Nonaktif
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        <button type="button" onclick="openEditModal({{ json_encode($kategori) }})"
                                            class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <form action="{{ route('admin.ppid.kategori.destroy', $kategori) }}" method="POST"
                                            class="inline"
                                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus kategori ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition"
                                                title="Hapus">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                                    <div class="flex flex-col items-center">
                                        <i class="fas fa-folder-open text-4xl text-gray-300 mb-3"></i>
                                        <p>Belum ada kategori PPID</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if ($kategoris->hasPages())
                <div class="px-6 py-4 border-t border-gray-200">
                    {{ $kategoris->links() }}
                </div>
            @endif
        </div>
    </div>

    <!-- Add Modal -->
    <div id="addModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center">
        <div class="bg-white rounded-xl shadow-xl w-full max-w-lg mx-4">
            <div class="p-6 border-b border-gray-200">
                <h3 class="text-lg font-bold text-gray-800">Tambah Kategori PPID</h3>
            </div>
            <form action="{{ route('admin.ppid.kategori.store') }}" method="POST">
                @csrf
                <div class="p-6 space-y-4">
                    <div>
                        <label for="nama" class="block text-sm font-medium text-gray-700 mb-2">Nama Kategori <span
                                class="text-red-500">*</span></label>
                        <input type="text" id="nama" name="nama" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                            placeholder="Masukkan nama kategori">
                    </div>
                    <div>
                        <label for="jenis" class="block text-sm font-medium text-gray-700 mb-2">Jenis Informasi <span
                                class="text-red-500">*</span></label>
                        <select id="jenis" name="jenis" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                            <option value="">Pilih Jenis</option>
                            <option value="berkala">Informasi Berkala</option>
                            <option value="serta_merta">Informasi Serta Merta</option>
                            <option value="setiap_saat">Informasi Setiap Saat</option>
                        </select>
                    </div>
                    <div>
                        <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
                        <textarea id="deskripsi" name="deskripsi" rows="3"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                            placeholder="Deskripsi kategori (opsional)"></textarea>
                    </div>
                    <div>
                        <label for="urutan" class="block text-sm font-medium text-gray-700 mb-2">Urutan</label>
                        <input type="number" id="urutan" name="urutan" min="0"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                            placeholder="Urutan tampilan">
                    </div>
                    <div>
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" name="is_active" value="1" checked
                                class="w-4 h-4 text-primary-600 border-gray-300 rounded focus:ring-primary-500">
                            <span class="text-sm text-gray-700">Aktif</span>
                        </label>
                    </div>
                </div>
                <div
                    class="px-6 py-4 bg-gray-50 border-t border-gray-200 rounded-b-xl flex items-center justify-end gap-3">
                    <button type="button" onclick="closeModal('addModal')"
                        class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium rounded-lg transition">
                        Batal
                    </button>
                    <button type="submit"
                        class="px-6 py-2 bg-primary-600 hover:bg-primary-700 text-white font-medium rounded-lg transition">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Modal -->
    <div id="editModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center">
        <div class="bg-white rounded-xl shadow-xl w-full max-w-lg mx-4">
            <div class="p-6 border-b border-gray-200">
                <h3 class="text-lg font-bold text-gray-800">Edit Kategori PPID</h3>
            </div>
            <form id="editForm" method="POST">
                @csrf
                @method('PUT')
                <div class="p-6 space-y-4">
                    <div>
                        <label for="edit_nama" class="block text-sm font-medium text-gray-700 mb-2">Nama Kategori <span
                                class="text-red-500">*</span></label>
                        <input type="text" id="edit_nama" name="nama" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                            placeholder="Masukkan nama kategori">
                    </div>
                    <div>
                        <label for="edit_jenis" class="block text-sm font-medium text-gray-700 mb-2">Jenis Informasi <span
                                class="text-red-500">*</span></label>
                        <select id="edit_jenis" name="jenis" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                            <option value="">Pilih Jenis</option>
                            <option value="berkala">Informasi Berkala</option>
                            <option value="serta_merta">Informasi Serta Merta</option>
                            <option value="setiap_saat">Informasi Setiap Saat</option>
                        </select>
                    </div>
                    <div>
                        <label for="edit_deskripsi" class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
                        <textarea id="edit_deskripsi" name="deskripsi" rows="3"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                            placeholder="Deskripsi kategori (opsional)"></textarea>
                    </div>
                    <div>
                        <label for="edit_urutan" class="block text-sm font-medium text-gray-700 mb-2">Urutan</label>
                        <input type="number" id="edit_urutan" name="urutan" min="0"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                            placeholder="Urutan tampilan">
                    </div>
                    <div>
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" id="edit_is_active" name="is_active" value="1"
                                class="w-4 h-4 text-primary-600 border-gray-300 rounded focus:ring-primary-500">
                            <span class="text-sm text-gray-700">Aktif</span>
                        </label>
                    </div>
                </div>
                <div
                    class="px-6 py-4 bg-gray-50 border-t border-gray-200 rounded-b-xl flex items-center justify-end gap-3">
                    <button type="button" onclick="closeModal('editModal')"
                        class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium rounded-lg transition">
                        Batal
                    </button>
                    <button type="submit"
                        class="px-6 py-2 bg-primary-600 hover:bg-primary-700 text-white font-medium rounded-lg transition">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openModal(id) {
            document.getElementById(id).classList.remove('hidden');
        }

        function closeModal(id) {
            document.getElementById(id).classList.add('hidden');
        }

        function openEditModal(kategori) {
            document.getElementById('edit_nama').value = kategori.nama;
            document.getElementById('edit_jenis').value = kategori.jenis;
            document.getElementById('edit_deskripsi').value = kategori.deskripsi || '';
            document.getElementById('edit_urutan').value = kategori.urutan || '';
            document.getElementById('edit_is_active').checked = kategori.is_active;
            document.getElementById('editForm').action = '{{ url('admin/ppid/kategori') }}/' + kategori.id;
            openModal('editModal');
        }

        // Close modal when clicking outside
        document.querySelectorAll('#addModal, #editModal').forEach(modal => {
            modal.addEventListener('click', function(e) {
                if (e.target === this) {
                    closeModal(this.id);
                }
            });
        });
    </script>
@endsection
