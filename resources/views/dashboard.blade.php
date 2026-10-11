<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Dashboard {{ $roleTitle ?? 'Pengguna' }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-2xl font-bold mb-4">
                        Selamat Datang!
                    </h3>

                    <p class="mb-2">
                        Nama: {{ auth()->user()->nama }}
                    </p>

                    <p class="mb-2">
                        Email: {{ auth()->user()->email }}
                    </p>

                    <p class="mb-4">
                        Role:
                        <span class="font-bold uppercase">
                            {{ auth()->user()->role }}
                        </span>
                    </p>

                    @if (auth()->user()->role === 'admin')
                        <div class="mt-6">
                            <h4 class="text-lg font-bold">
                                Menu Administrator
                            </h4>
                            <p class="mt-2">
                                Kelola data pengguna dan hak akses.
                            </p>
                            <a href="{{ route('users.index') }}"
                               class="inline-block mt-3 px-4 py-2 bg-blue-600 text-white rounded">
                                Manajemen Pengguna
                            </a>
                        </div>
                    @elseif (auth()->user()->role === 'mekanik')
                        <p class="mt-4">
                            Anda masuk sebagai mekanik.
                        </p>
                    @elseif (auth()->user()->role === 'pelanggan')
                        <p class="mt-4">
                            Anda masuk sebagai pelanggan.
                        </p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>