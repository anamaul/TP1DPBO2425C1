<?php
class ProdukElektronik
{
  private $id;
  private $nama;
  private $watt;
  private $harga;
  private $gambar;

  public function __construct($id = "", $nama = "", $watt = "", $harga = "", $gambar = "")
  {
    $this->id = $id;
    $this->nama = $nama;
    $this->watt = $watt;
    $this->harga = $harga;
    $this->gambar = $gambar;
  }

  public function getId()
  {
    return $this->id;
  }
  public function getNama()
  {
    return $this->nama;
  }
  public function getWatt()
  {
    return $this->watt;
  }
  public function getHarga()
  {
    return $this->harga;
  }
  public function getGambar()
  {
    return $this->gambar;
  }

  public function setNama($v)
  {
    $this->nama = $v;
  }
  public function setWatt($v)
  {
    $this->watt = $v;
  }
  public function setHarga($v)
  {
    $this->harga = $v;
  }
  public function setGambar($v)
  {
    $this->gambar = $v;
  }
}
