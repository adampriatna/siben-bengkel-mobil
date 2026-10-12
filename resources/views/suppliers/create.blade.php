<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Tambah Supplier
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">

                @if ($errors->any())
                    <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
                        <ul class="list-disc pl-5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('suppliers.store') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label for="nama_supplier" class="block font-medium mb-1">
                            Nama Supplier *
                        </label>
                        <input type="text" id="nama_supplier" name="nama_supplier"
                               value="{{ old('nama_supplier') }}" required maxlength="150"
                               class="w-full border-gray-300 rounded-md shadow-sm">
                    </div>

                    <div class="mb-4">
                        <label for="kontak" class="block font-medium mb-1">
                            Kontak
                        </label>
                        <input type="text" id="kontak" name="kontak"
                               value="{{ old('kontak') }}" maxlength="255"
                               class="w-full border-gray-300 rounded-md shadow-sm">
                    </div>

                    <div class="mb-4">
                        <label for="alamat" class="block font-medium mb-1">
                            Alamat
                        </label>
                        <textarea id="alamat" name="alamat" rows="3" maxlength="1000"
                                  class="w-full border-gray-300 rounded-md shadow-sm">{{ old('alamat') }}</textarea>
                    </div>

                    <div class="flex gap-2">
                        <button type="submit"
                                class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                            Simpan
                        </button>

                        <a href="{{ route('suppliers.index') }}"
                           class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">
                            Kembali
                        </a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>