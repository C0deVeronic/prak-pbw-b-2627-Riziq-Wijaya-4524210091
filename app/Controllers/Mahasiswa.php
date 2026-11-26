<?php

namespace App\Controllers;

use App\Models\MahasiswaModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class Mahasiswa extends BaseController
{
    protected $mahasiswaModel;

    public function __construct()
    {
        $this->mahasiswaModel = new MahasiswaModel();
    }

    /**
     * Menampilkan daftar data mahasiswa
     */
    public function index()
    {
        $keyword = $this->request->getGet('keyword');
        if ($keyword) {
            $mahasiswa = $this->mahasiswaModel
                ->like('nim', $keyword)
                ->orLike('nama', $keyword)
                ->orLike('email', $keyword)
                ->orLike('prodi', $keyword)
                ->orLike('angkatan', $keyword)
                ->findAll();
        } else {
            $mahasiswa = $this->mahasiswaModel->orderBy('nim', 'ASC')->findAll();
        }

        $data = [
            'title'     => 'Daftar Mahasiswa - Modul Akademik',
            'mahasiswa' => $mahasiswa,
            'keyword'   => $keyword,
        ];

        return view('mahasiswa/index', $data);
    }

    /**
     * Menampilkan form tambah data mahasiswa
     */
    public function tambah()
    {
        $data = [
            'title'      => 'Tambah Data Mahasiswa',
            'validation' => \Config\Services::validation(),
        ];

        return view('mahasiswa/tambah', $data);
    }

    /**
     * Menyimpan data mahasiswa baru dengan validasi CI4
     */
    public function simpan()
    {
        $rules = [
            'nim' => [
                'rules'  => 'required|numeric|min_length[5]|max_length[20]|is_unique[mahasiswa.nim]',
                'errors' => [
                    'required'   => 'NIM wajib diisi.',
                    'numeric'    => 'NIM harus berupa angka.',
                    'min_length' => 'NIM minimal {param} karakter.',
                    'max_length' => 'NIM maksimal {param} karakter.',
                    'is_unique'  => 'NIM sudah terdaftar di sistem. Silakan gunakan NIM lain.',
                ],
            ],
            'nama' => [
                'rules'  => 'required|min_length[3]|max_length[100]',
                'errors' => [
                    'required'   => 'Nama mahasiswa wajib diisi.',
                    'min_length' => 'Nama minimal {param} karakter.',
                    'max_length' => 'Nama maksimal {param} karakter.',
                ],
            ],
            'email' => [
                'rules'  => 'required|valid_email|max_length[100]',
                'errors' => [
                    'required'    => 'Email wajib diisi.',
                    'valid_email' => 'Format email tidak valid (contoh: user@domain.com).',
                    'max_length'  => 'Email maksimal {param} karakter.',
                ],
            ],
            'prodi' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Program studi wajib dipilih.',
                ],
            ],
            'angkatan' => [
                'rules'  => 'required|numeric|exact_length[4]|greater_than_equal_to[2000]|less_than_equal_to[2030]',
                'errors' => [
                    'required'              => 'Tahun angkatan wajib diisi.',
                    'numeric'               => 'Tahun angkatan harus berupa 4 digit angka.',
                    'exact_length'          => 'Tahun angkatan harus tepat 4 digit.',
                    'greater_than_equal_to' => 'Tahun angkatan minimal tahun 2000.',
                    'less_than_equal_to'    => 'Tahun angkatan maksimal tahun 2030.',
                ],
            ],
            'ipk' => [
                'rules'  => 'required|numeric|greater_than_equal_to[0.00]|less_than_equal_to[4.00]',
                'errors' => [
                    'required'              => 'IPK wajib diisi.',
                    'numeric'               => 'IPK harus berupa angka atau format desimal.',
                    'greater_than_equal_to' => 'IPK minimal adalah 0.00.',
                    'less_than_equal_to'    => 'IPK maksimal adalah 4.00.',
                ],
            ],
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $this->mahasiswaModel->insert([
            'nim'      => $this->request->getPost('nim'),
            'nama'     => $this->request->getPost('nama'),
            'email'    => $this->request->getPost('email'),
            'prodi'    => $this->request->getPost('prodi'),
            'angkatan' => (int) $this->request->getPost('angkatan'),
            'ipk'      => (float) $this->request->getPost('ipk'),
        ]);

        return redirect()->to(base_url('mahasiswa'))
            ->with('success', 'Data mahasiswa berhasil ditambahkan.');
    }

    /**
     * Menampilkan form ubah data mahasiswa
     */
    public function ubah($nim)
    {
        $mahasiswa = $this->mahasiswaModel->find($nim);

        if (! $mahasiswa) {
            throw PageNotFoundException::forPageNotFound("Mahasiswa dengan NIM $nim tidak ditemukan.");
        }

        $data = [
            'title'      => 'Ubah Data Mahasiswa',
            'mahasiswa'  => $mahasiswa,
            'validation' => \Config\Services::validation(),
        ];

        return view('mahasiswa/ubah', $data);
    }

    /**
     * Memperbarui data mahasiswa dengan validasi CI4
     */
    public function update($nim)
    {
        $mahasiswa = $this->mahasiswaModel->find($nim);

        if (! $mahasiswa) {
            throw PageNotFoundException::forPageNotFound("Mahasiswa dengan NIM $nim tidak ditemukan.");
        }

        $inputNim = $this->request->getPost('nim');

        $rules = [
            'nim' => [
                'rules'  => "required|numeric|min_length[5]|max_length[20]|is_unique[mahasiswa.nim,nim,{$nim}]",
                'errors' => [
                    'required'   => 'NIM wajib diisi.',
                    'numeric'    => 'NIM harus berupa angka.',
                    'min_length' => 'NIM minimal {param} karakter.',
                    'max_length' => 'NIM maksimal {param} karakter.',
                    'is_unique'  => 'NIM sudah terdaftar untuk mahasiswa lain.',
                ],
            ],
            'nama' => [
                'rules'  => 'required|min_length[3]|max_length[100]',
                'errors' => [
                    'required'   => 'Nama mahasiswa wajib diisi.',
                    'min_length' => 'Nama minimal {param} karakter.',
                    'max_length' => 'Nama maksimal {param} karakter.',
                ],
            ],
            'email' => [
                'rules'  => 'required|valid_email|max_length[100]',
                'errors' => [
                    'required'    => 'Email wajib diisi.',
                    'valid_email' => 'Format email tidak valid (contoh: user@domain.com).',
                    'max_length'  => 'Email maksimal {param} karakter.',
                ],
            ],
            'prodi' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Program studi wajib dipilih.',
                ],
            ],
            'angkatan' => [
                'rules'  => 'required|numeric|exact_length[4]|greater_than_equal_to[2000]|less_than_equal_to[2030]',
                'errors' => [
                    'required'              => 'Tahun angkatan wajib diisi.',
                    'numeric'               => 'Tahun angkatan harus berupa 4 digit angka.',
                    'exact_length'          => 'Tahun angkatan harus tepat 4 digit.',
                    'greater_than_equal_to' => 'Tahun angkatan minimal tahun 2000.',
                    'less_than_equal_to'    => 'Tahun angkatan maksimal tahun 2030.',
                ],
            ],
            'ipk' => [
                'rules'  => 'required|numeric|greater_than_equal_to[0.00]|less_than_equal_to[4.00]',
                'errors' => [
                    'required'              => 'IPK wajib diisi.',
                    'numeric'               => 'IPK harus berupa angka atau format desimal.',
                    'greater_than_equal_to' => 'IPK minimal adalah 0.00.',
                    'less_than_equal_to'    => 'IPK maksimal adalah 4.00.',
                ],
            ],
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $updateData = [
            'nim'      => $inputNim,
            'nama'     => $this->request->getPost('nama'),
            'email'    => $this->request->getPost('email'),
            'prodi'    => $this->request->getPost('prodi'),
            'angkatan' => (int) $this->request->getPost('angkatan'),
            'ipk'      => (float) $this->request->getPost('ipk'),
        ];

        $this->mahasiswaModel->update($nim, $updateData);

        return redirect()->to(base_url('mahasiswa'))
            ->with('success', "Data mahasiswa NIM $nim berhasil diperbarui.");
    }

    /**
     * Menghapus data mahasiswa
     */
    public function hapus($nim)
    {
        $mahasiswa = $this->mahasiswaModel->find($nim);

        if (! $mahasiswa) {
            return redirect()->to(base_url('mahasiswa'))
                ->with('error', "Data mahasiswa dengan NIM $nim tidak ditemukan.");
        }

        $this->mahasiswaModel->delete($nim);

        return redirect()->to(base_url('mahasiswa'))
            ->with('success', "Data mahasiswa dengan NIM $nim ({$mahasiswa['nama']}) berhasil dihapus.");
    }
}
