<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\MahasiswaModel;
use CodeIgniter\Exceptions\PageNotFoundException;
use CodeIgniter\HTTP\ResponseInterface;

class MahasiswaController extends BaseController
{
    public function index()
    {
        $model = new MahasiswaModel();
        $mahasiswa = $model->findAll();
        $prodi = array_unique(array_filter(array_map(
            static fn (array $row): string => trim((string) ($row['prodi'] ?? '')),
            $mahasiswa
        )));
        $data = [
            'mahasiswa' => $mahasiswa,
            'jumlahMahasiswa' => count($mahasiswa),
            'jumlahProdi' => count($prodi),
        ];

        return view('mahasiswa/index', $data);
    }

    public function create()
    {
        return view('mahasiswa/create');
    }

    public function edit(string $nim)
    {
        $mahasiswa = (new MahasiswaModel())->find($nim);
        if ($mahasiswa === null) {
            throw PageNotFoundException::forPageNotFound();
        }

        return view('mahasiswa/edit', ['mahasiswa' => $mahasiswa]);
    }

    public function store()
    {
        $model = new MahasiswaModel();
        $data = [
            'nim'   => $this->request->getPost('nim'),
            'nama'  => $this->request->getPost('nama'),
            'email' => $this->request->getPost('email'),
            'prodi' => $this->request->getPost('prodi'),
            'angkatan' => $this->request->getPost('angkatan'),
            'ipk'   => $this->request->getPost('ipk'),
        ];
        $model->insert($data);
        return redirect()->to('/mahasiswa');
    }

    public function update(string $nim)
    {
        $model = new MahasiswaModel();
        if ($model->find($nim) === null) {
            throw PageNotFoundException::forPageNotFound();
        }

        $data = [
            'nim'      => $this->request->getPost('nim'),
            'nama'     => $this->request->getPost('nama'),
            'email'    => $this->request->getPost('email'),
            'prodi'    => $this->request->getPost('prodi'),
            'angkatan' => $this->request->getPost('angkatan'),
            'ipk'      => $this->request->getPost('ipk'),
        ];
        $model->update($nim, $data);

        return redirect()->to('/mahasiswa');
    }

    public function delete(string $nim)
    {
        $model = new MahasiswaModel();
        if ($model->find($nim) === null) {
            throw PageNotFoundException::forPageNotFound();
        }

        $model->delete($nim);

        return redirect()->to('/mahasiswa');
    }
}