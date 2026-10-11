<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800">
                Manajemen Pengguna
            </h2>

            <a href="{{ route('dashboard') }}"
               class="text-sm text-blue-600 underline">
                Kembali ke Dashboard
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow-sm sm:rounded-lg">

                @if (session('success'))
                    <div class="mb-4 rounded bg-green-100 p-3 text-green-800">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="mb-4 rounded bg-red-100 p-3 text-red-800">
                        {{ session('error') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="mb-4 rounded bg-red-100 p-3 text-red-800">
                        <ul class="list-disc pl-5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="mb-5 flex flex-wrap items-center justify-between gap-3">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800">
                            Daftar Pengguna
                        </h3>
                        <p class="text-sm text-gray-500">
                            Kelola akun admin, mekanik, dan pelanggan.
                        </p>
                    </div>

                    <a href="{{ route('users.create') }}"
                       class="rounded bg-blue-600 px-4 py-2 text-white hover:bg-blue-700">
                        + Tambah Pengguna
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full border-collapse border border-gray-300 text-sm">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="border p-3">No.</th>
                                <th class="border p-3 text-left">Nama</th>
                                <th class="border p-3 text-left">Username</th>
                                <th class="border p-3 text-left">Email</th>
                                <th class="border p-3">Role</th>
                                <th class="border p-3">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($users as $user)
                                <tr class="hover:bg-gray-50">
                                    <td class="border p-3 text-center">
                                        {{ $users->firstItem() + $loop->index }}
                                    </td>

                                    <td class="border p-3">
                                        {{ $user->nama }}
                                    </td>

                                    <td class="border p-3">
                                        {{ $user->username }}
                                    </td>

                                    <td class="border p-3">
                                        {{ $user->email ?? '-' }}
                                    </td>

                                    <td class="border p-3 text-center">
                                        <span class="rounded bg-gray-100 px-2 py-1">
                                            {{ ucfirst($user->role) }}
                                        </span>
                                    </td>

                                    <td class="border p-3 text-center whitespace-nowrap">
                                        <a href="{{ route('users.edit', $user->id_user) }}"
                                           class="text-blue-600 underline">
                                            Edit
                                        </a>

                                        <form action="{{ route('users.destroy', $user->id_user) }}"
                                              method="POST"
                                              class="inline"
                                              onsubmit="return confirm('Yakin ingin menghapus pengguna ini?')">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                    class="ml-2 text-red-600 underline">
                                                Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="border p-5 text-center text-gray-500">
                                        Belum ada pengguna.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-5">
                    {{ $users->links() }}
                </div>

            </div>
        </div>
    </div>
</x-app-layout>