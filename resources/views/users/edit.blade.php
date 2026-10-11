<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Edit Pengguna
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow-sm sm:rounded-lg">

                @if ($errors->any())
                    <div class="mb-4 text-red-600">
                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                @endif

                <form action="{{ route('users.update', $user->id_user) }}"
                      method="POST">
                    @csrf
                    @method('PUT')

                    <label class="block mb-1">Nama lengkap</label>
                    <input type="text" name="nama"
                           value="{{ old('nama', $user->nama) }}"
                           class="w-full border-gray-300 rounded mb-4"
                           required>

                    <label class="block mb-1">Username</label>
                    <input type="text" name="username"
                           value="{{ old('username', $user->username) }}"
                           class="w-full border-gray-300 rounded mb-4"
                           required>

                    <label class="block mb-1">Email</label>
                    <input type="email" name="email"
                           value="{{ old('email', $user->email) }}"
                           class="w-full border-gray-300 rounded mb-4"
                           required>

                    <label class="block mb-1">Password baru (opsional)</label>
                    <input type="password" name="password"
                           class="w-full border-gray-300 rounded mb-4">

                    <label class="block mb-1">Konfirmasi password baru</label>
                    <input type="password" name="password_confirmation"
                           class="w-full border-gray-300 rounded mb-4">

                    <label class="block mb-1">Role</label>
                    <select name="role"
                            class="w-full border-gray-300 rounded mb-4"
                            required>
                        <option value="pelanggan"
                            @selected($user->role === 'pelanggan')>
                            Pelanggan
                        </option>
                        <option value="mekanik"
                            @selected($user->role === 'mekanik')>
                            Mekanik
                        </option>
                        <option value="admin"
                            @selected($user->role === 'admin')>
                            Admin
                        </option>
                    </select>

                    <button type="submit"
                            class="px-4 py-2 bg-blue-600 text-white rounded">
                        Simpan Perubahan
                    </button>

                    <a href="{{ route('users.index') }}"
                       class="ml-2 text-gray-600 underline">
                        Kembali
                    </a>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>

