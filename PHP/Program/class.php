<?php
// Definisi class ProdukElektronik untuk merepresentasikan produk elektronik
class ProdukElektronik
{
  // Deklarasi properti private untuk enkapsulasi data
  private $id;      // ID unik produk
  private $nama;    // Nama produk elektronik
  private $watt;    // Konsumsi daya produk (dalam watt)
  private $harga;   // Harga produk
  private $gambar;  // Nama file gambar produk

  // Constructor untuk inisialisasi objek dengan parameter default kosong
  public function __construct($id = "", $nama = "", $watt = "", $harga = "", $gambar = "")
  {
    // Inisialisasi semua properti dengan nilai yang diberikan
    $this->id = $id;
    $this->nama = $nama;
    $this->watt = $watt;
    $this->harga = $harga;
    $this->gambar = $gambar;
  }

  // Getter method untuk mengambil nilai ID
  public function getId()
  {
    return $this->id;
  }

  // Getter method untuk mengambil nilai nama
  public function getNama()
  {
    return $this->nama;
  }

  // Getter method untuk mengambil nilai watt
  public function getWatt()
  {
    return $this->watt;
  }

  // Getter method untuk mengambil nilai harga
  public function getHarga()
  {
    return $this->harga;
  }

  // Getter method untuk mengambil nama file gambar
  public function getGambar()
  {
    return $this->gambar;
  }

  // Setter method untuk mengubah nilai nama
  public function setNama($v)
  {
    $this->nama = $v;
  }

  // Setter method untuk mengubah nilai watt
  public function setWatt($v)
  {
    $this->watt = $v;
  }

  // Setter method untuk mengubah nilai harga
  public function setHarga($v)
  {
    $this->harga = $v;
  }

  // Setter method untuk mengubah nama file gambar
  public function setGambar($v)
  {
    $this->gambar = $v;
  }
}