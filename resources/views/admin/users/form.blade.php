@extends('layouts.admin')

@section('title', isset($user) ? 'Edit Pengguna' : 'Tambah Pengguna')

@section('content')
    <div class="space-y-6">
        <!-- Header -->
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">{{ isset($user) ? 'Edit Pengguna' : 'Tambah Pengguna' }}</h1>
                <p class="text-gray-600">{{ isset($user) ? 'Perbarui data pengguna' : 'Buat akun administrator baru' }}</p>
            </div>
            <a href="{{ route('admin.users.index') }}"
                class="inline-flex items-center px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 font-medium rounded-lg transition">
                <i class="fas fa-arrow-left mr-2"></i>
                Kembali
            </a>
        </div>

        <!-- Form -->
        <div class="bg-white rounded-xl shadow-sm">
            <form action="{{ isset($user) ? route('admin.users.update', $user->id) : route('admin.users.store') }}"
                method="POST" enctype="multipart/form-data">
                @csrf
                @if (isset($user))
                    @method('PUT')
                @endif

                <div class="p-6 space-y-6">
                    <!-- Avatar -->
                    <div class="flex items-center gap-6" x-data="{ preview: '{{ isset($user) && $user->avatar ? Storage::url($user->avatar) : '' }}' }">
                        <div
                            class="w-24 h-24 rounded-full overflow-hidden bg-primary-100 flex items-center justify-center flex-shrink-0">
                            <template x-if="preview">
                                <img :src="preview" class="w-full h-full object-cover">
                            </template>
                            <template x-if="!preview">
                                <i class="fas fa-user text-4xl text-primary-300"></i>
                            </template>
                        </div>
                        <div>
                            <label for="avatar"
                                class="inline-flex items-center px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium rounded-lg transition cursor-pointer">
                                <i class="fas fa-camera mr-2"></i>
                                Ganti Foto
                            </label>
                            <input type="file" name="avatar" id="avatar" accept="image/*" class="hidden"
                                @change="preview = URL.createObjectURL($event.target.files[0])">
                            <p class="text-sm text-gray-500 mt-2">JPG, PNG, WebP (Maks. 2MB)</p>
                            @error('avatar')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <hr class="border-gray-200">

                    <div class="grid md:grid-cols-2 gap-6">
                        <!-- Nama -->
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap
                                *</label>
                            <input type="text" name="name" id="name" value="{{ old('name', $user->name ?? '') }}"
                                required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 @error('name') border-red-500 @enderror"
                                placeholder="Masukkan nama lengkap">
                            @error('name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email *</label>
                            <input type="email" name="email" id="email"
                                value="{{ old('email', $user->email ?? '') }}" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 @error('email') border-red-500 @enderror"
                                placeholder="email@example.com">
                            @error('email')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="grid md:grid-cols-2 gap-6">
                        <!-- Role -->
                        <div>
                            <label for="role" class="block text-sm font-medium text-gray-700 mb-1">Role *</label>
                            <select name="role" id="role" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 @error('role') border-red-500 @enderror">
                                <option value="">Pilih Role</option>
                                <option value="super_admin"
                                    {{ old('role', $user->role ?? '') == 'super_admin' ? 'selected' : '' }}>Super Admin
                                </option>
                                <option value="admin_desa"
                                    {{ old('role', $user->role ?? '') == 'admin_desa' ? 'selected' : '' }}>Admin Desa
                                </option>
                                <option value="operator"
                                    {{ old('role', $user->role ?? '') == 'operator' ? 'selected' : '' }}>Operator</option>
                            </select>
                            @error('role')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <p class="mt-1 text-sm text-gray-500">
                                <strong>Super Admin:</strong> Akses penuh |
                                <strong>Admin Desa:</strong> Kelola konten |
                                <strong>Operator:</strong> Akses terbatas
                            </p>
                        </div>

                        <!-- Phone -->
                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">No. Telepon</label>
                            <input type="tel" name="phone" id="phone"
                                value="{{ old('phone', $user->phone ?? '') }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                                placeholder="08xxxxxxxxxx">
                        </div>
                    </div>

                    <hr class="border-gray-200">

                    <div class="grid md:grid-cols-2 gap-6">
                        <!-- Password -->
                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700 mb-1">
                                Password {{ isset($user) ? '' : '*' }}
                            </label>
                            <div class="relative" x-data="{ show: false }">
                                <input :type="show ? 'text' : 'password'" name="password" id="password"
                                    {{ isset($user) ? '' : 'required' }}
                                    class="w-full px-4 py-2 pr-10 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 @error('password') border-red-500 @enderror"
                                    placeholder="{{ isset($user) ? 'Kosongkan jika tidak diubah' : 'Minimal 8 karakter' }}">
                                <button type="button" @click="show = !show"
                                    class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600">
                                    <i class="fas" :class="show ? 'fa-eye-slash' : 'fa-eye'"></i>
                                </button>
                            </div>
                            @error('password')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Password Confirmation -->
                        <div>
                            <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">
                                Konfirmasi Password {{ isset($user) ? '' : '*' }}
                            </label>
                            <div class="relative" x-data="{ show: false }">
                                <input :type="show ? 'text' : 'password'" name="password_confirmation"
                                    id="password_confirmation" {{ isset($user) ? '' : 'required' }}
                                    class="w-full px-4 py-2 pr-10 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                                    placeholder="Ulangi password">
                                <button type="button" @click="show = !show"
                                    class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600">
                                    <i class="fas" :class="show ? 'fa-eye-slash' : 'fa-eye'"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Status -->
                    <div>
                        <label class="flex items-center">
                            <input type="checkbox" name="is_active" value="1"
                                {{ old('is_active', $user->is_active ?? true) ? 'checked' : '' }}
                                class="w-4 h-4 text-primary-600 border-gray-300 rounded focus:ring-primary-500">
                            <span class="ml-2 text-gray-700">Aktif (Pengguna dapat login)</span>
                        </label>
                    </div>
                </div>

                <!-- Footer -->
                <div
                    class="px-6 py-4 bg-gray-50 border-t border-gray-200 rounded-b-xl flex items-center justify-end gap-3">
                    <a href="{{ route('admin.users.index') }}"
                        class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 font-medium rounded-lg transition">
                        Batal
                    </a>
                    <button type="submit"
                        class="px-6 py-2 bg-primary-600 hover:bg-primary-700 text-white font-medium rounded-lg transition">
                        <i class="fas fa-save mr-2"></i>
                        {{ isset($user) ? 'Update' : 'Simpan' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
