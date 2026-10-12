<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Manajemen Supplier
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">

                @if (session('success'))
                    <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">
                        {{ session('success') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="mb-4 p-3 bg-red-100 text-red-800 rounded">
                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                @endif

                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-lg font-semibold">Daftar Supplier</h3>

                    <a href="{{ route('suppliers.create') }}"
                       class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                        + Tambah Supplier
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full border-collapse border border-gray-300">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="border p-3 text-left">No</th>
                                <th class="border p-3 text-left">Nama Supplier</th>
                                <th class="border p-3 text-left">Kontak</th>
                                <th class="border p-3 text-left">Alamat</th>
                                <th class="border p-3 text-center">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($suppliers as $supplier)
                                <tr>
                                    <td class="border p-3">
                                        {{ $suppliers->firstItem() + $loop->index }}
                                    </td>

                                    <td class="border p-3">
                                        {{ $supplier->nama_supplier }}
                                    </td>

                                    <td class="border p-3">
                                        {{ $supplier->kontak ?? '-' }}
                                    </td>

                                    <td class="border p-3">
                                        {{ $supplier->alamat ?? '-' }}
                                    </td>

                                    <td class="border p-3">
                                        <div class="flex flex-wrap justify-center items-center gap-2">
                                            <a href="{{ route('suppliers.edit', ['supplier' => $supplier->id_supplier ?? $supplier->getKey()]) }}"
                                            style="display: inline-block; padding: 6px 12px; background-color: #eab308; color: #ffffff; border-radius: 5px; text-decoration: none;">
                                                Edit
                                            </a>

                                            <form action="{{ route('suppliers.destroy', $supplier) }}"
                                                method="POST"
                                                onsubmit="return confirm('Yakin ingin menghapus supplier ini?')">
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit"
                                                        style="padding: 6px 12px; background-color: #dc2626; color: #ffffff; border: none; border-radius: 5px; cursor: pointer;">
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5"
                                        class="border p-4 text-center text-gray-500">
                                        Belum ada data supplier.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    {{ $suppliers->links() }}
                </div>

            </div>
        </div>
    </div>
</x-app-layout>