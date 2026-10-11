<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Tambah Pengguna
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow-sm sm:rounded-lg">

                @if ($errors->any())
                    <div class="mb-4 rounded bg-red-100 p-3 text-red-800">
                        <ul class="list-disc pl-5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('users.store') }}" method="POST">
                    @csrf

                    <label class="block mb-1 font-medium">Nama lengkap</label>
                    <input type="text" name="nama"
                           value="{{ old('nama') }}"
                           class="w-full rounded border-gray-300 mb-4"
                           required>

                    <label class="block mb-1 font-medium">Username</label>
                    <input type="text" name="username"
                           value="{{ old('username') }}"
                           class="w-full rounded border-gray-300 mb-4"
                           required>

                    <label class="block mb-1 font-medium">Email</label>
                    <input type="email" name="email"
                           value="{{ old('email') }}"
                           class="w-full rounded border-gray-300 mb-4"
                           required>

                    <label class="block mb-1 font-medium">Password</label>
                    <input type="password" name="password"
                           class="w-full rounded border-gray-300 mb-4"
                           required>

                    <label class="block mb-1 font-medium">Konfirmasi password</label>
                    <input type="password" name="password_confirmation"
                           class="w-full rounded border-gray-300 mb-4"
                           required>

                    <label class="block mb-1 font-medium">Role pengguna</label>
                    <select name="role"
                            class="w-full rounded border-gray-300 mb-5"
                            required>
                        <option value="pelanggan">Pelanggan</option>
                        <option value="mekanik">Mekanik</option>
                        <option value="admin">Admin</option>
                    </select>

                    <button type="submit"
                            class="rounded bg-blue-600 px-4 py-2 text-white hover:bg-blue-700">
                        Simpan Pengguna
                    </button>

                    <a href="{{ route('users.index') }}"
                       class="ml-3 text-gray-600 underline">
                        Kembali
                    </a>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>