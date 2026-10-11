<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSparepartRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check()
            && auth()->user()->role === 'admin';
    }

    public function rules(): array
    {
        return [
            'kode_sparepart' => 'required|string|max:255|unique:spareparts,kode_sparepart',
            'nama_sparepart' => 'required|string|max:255',
            'id_kategori' => 'required|exists:kategoris,id_kategori',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
        ];
    }

    public function messages(): array
    {
        return [
            'kode_sparepart.required' => 'Kode sparepart wajib diisi.',
            'kode_sparepart.unique' => 'Kode sparepart sudah digunakan.',
            'nama_sparepart.required' => 'Nama sparepart wajib diisi.',
            'id_kategori.required' => 'Kategori wajib dipilih.',
            'id_kategori.exists' => 'Kategori tidak ditemukan.',
            'harga.required' => 'Harga wajib diisi.',
            'harga.numeric' => 'Harga harus berupa angka.',
            'harga.min' => 'Harga tidak boleh negatif.',
            'stok.required' => 'Stok wajib diisi.',
            'stok.integer' => 'Stok harus berupa bilangan bulat.',
            'stok.min' => 'Stok tidak boleh negatif.',
        ];
    }
}