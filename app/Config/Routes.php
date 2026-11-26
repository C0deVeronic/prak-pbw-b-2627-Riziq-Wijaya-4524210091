<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Route Modul Mahasiswa
$routes->get('/', 'Mahasiswa::index');
$routes->get('mahasiswa', 'Mahasiswa::index');
$routes->get('mahasiswa/tambah', 'Mahasiswa::tambah');
$routes->post('mahasiswa/simpan', 'Mahasiswa::simpan');
$routes->get('mahasiswa/ubah/(:segment)', 'Mahasiswa::ubah/$1');
$routes->post('mahasiswa/update/(:segment)', 'Mahasiswa::update/$1');
$routes->get('mahasiswa/hapus/(:segment)', 'Mahasiswa::hapus/$1');
