#include <iostream>
#include <string>
#include <vector>
#include "ProdukElektronik.cpp" // Include file class ProdukElektronik
using namespace std;

// ------------------ GLOBAL DATA ------------------
vector<ProdukElektronik> daftarProduk; // List produk

// ------------------ FUNCTION CRUD ------------------

// Tampilkan semua produk
void tampilkanProduk()
{
  if (daftarProduk.empty())
  {
    cout << "Belum ada produk.\n";
    return;
  }
  cout << "\n=== Daftar Produk ===\n";
  for (auto &p : daftarProduk)
  {
    p.tampilkanInfo();
  }
}

// Cari index produk berdasarkan ID
int cariProduk(string id)
{
  for (int i = 0; i < daftarProduk.size(); i++)
  {
    if (daftarProduk[i].getId() == id)
      return i;
  }
  return -1;
}

// Tambah data produk
void tambahProduk()
{
  string id, nama, watt, harga;
  cout << "Masukkan ID produk: ";
  cin >> id;
  cin.ignore();

  // 🔍 Cek apakah ID sudah ada
  if (cariProduk(id) != -1)
  {
    cout << "Produk dengan ID '" << id << "' sudah ada!\n";
    return; // Stop tambah produk
  }

  cout << "Masukkan Nama produk: ";
  getline(cin, nama);
  cout << "Masukkan Watt produk: ";
  getline(cin, watt);
  cout << "Masukkan Harga produk: ";
  getline(cin, harga);

  daftarProduk.push_back(ProdukElektronik(id, nama, watt, harga));
  cout << "Produk berhasil ditambahkan!\n";
}

// Update data produk
void updateProduk()
{
  string id;
  cout << "Masukkan ID produk yang akan diupdate: ";
  cin >> id;
  cin.ignore();
  int idx = cariProduk(id);
  if (idx == -1)
  {
    cout << "Produk tidak ditemukan!\n";
    return;
  }

  string nama, watt, harga;
  cout << "Masukkan Nama baru: ";
  getline(cin, nama);
  cout << "Masukkan Watt baru: ";
  getline(cin, watt);
  cout << "Masukkan Harga baru: ";
  getline(cin, harga);

  daftarProduk[idx].setNama(nama);
  daftarProduk[idx].setWatt(watt);
  daftarProduk[idx].setHarga(harga);

  cout << "Produk berhasil diupdate!\n";
}

// Hapus produk
void hapusProduk()
{
  string id;
  cout << "Masukkan ID produk yang akan dihapus: ";
  cin >> id;
  int idx = cariProduk(id);
  if (idx == -1)
  {
    cout << "Produk tidak ditemukan!\n";
    return;
  }

  daftarProduk.erase(daftarProduk.begin() + idx);
  cout << "Produk berhasil dihapus!\n";
}

// Cari dan tampilkan produk
void cariProdukMenu()
{
  string id;
  cout << "Masukkan ID produk: ";
  cin >> id;
  int idx = cariProduk(id);
  if (idx == -1)
  {
    cout << "Produk tidak ditemukan!\n";
    return;
  }
  daftarProduk[idx].tampilkanInfo();
}

// ------------------ MAIN MENU ------------------
int main()
{
  int pilihan;
  do
  {
    cout << "\n=== MENU TOKO ELEKTRONIK ===\n";
    cout << "1. Tambah Produk\n";
    cout << "2. Tampilkan Semua Produk\n";
    cout << "3. Update Produk\n";
    cout << "4. Hapus Produk\n";
    cout << "5. Cari Produk\n";
    cout << "0. Keluar\n";
    cout << "Pilih menu: ";
    cin >> pilihan;
    cin.ignore();

    switch (pilihan)
    {
    case 1:
      tambahProduk();
      break;
    case 2:
      tampilkanProduk();
      break;
    case 3:
      updateProduk();
      break;
    case 4:
      hapusProduk();
      break;
    case 5:
      cariProdukMenu();
      break;
    case 0:
      cout << "Keluar program...\n";
      break;
    default:
      cout << "Pilihan tidak valid!\n";
    }
  } while (pilihan != 0);

  return 0;
}
