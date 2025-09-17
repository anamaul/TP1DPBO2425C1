#include <iostream>
#include <string>
#include <vector>
#include "ProdukElektronik.cpp" // Meng-include file class ProdukElektronik
using namespace std;

// ------------------ GLOBAL DATA ------------------
vector<ProdukElektronik> daftarProduk; // Menyimpan daftar semua produk

// ------------------ FUNCTION CRUD ------------------

// Menampilkan semua produk yang tersimpan
void tampilkanProduk()
{
  if (daftarProduk.empty()) // Jika daftar kosong
  {
    cout << "Belum ada produk.\n";
    return;
  }
  cout << "\n=== Daftar Produk ===\n";
  for (auto &p : daftarProduk) // Loop untuk setiap produk
  {
    p.tampilkanInfo(); // Panggil method tampilkanInfo
  }
}

// Mencari index produk berdasarkan ID
int cariProduk(string id)
{
  for (int i = 0; i < daftarProduk.size(); i++)
  {
    if (daftarProduk[i].getId() == id) // Jika ID cocok
      return i;
  }
  return -1; // Tidak ditemukan
}

// Menambahkan produk baru
void tambahProduk()
{
  string id, nama, watt, harga;
  cout << "Masukkan ID produk: ";
  cin >> id;
  cin.ignore(); // Mengabaikan karakter newline

  // 🔍 Periksa apakah ID sudah digunakan
  if (cariProduk(id) != -1)
  {
    cout << "Produk dengan ID '" << id << "' sudah ada!\n";
    return;
  }

  cout << "Masukkan Nama produk: ";
  getline(cin, nama);
  cout << "Masukkan Watt produk: ";
  getline(cin, watt);
  cout << "Masukkan Harga produk: ";
  getline(cin, harga);

  // Tambahkan objek ProdukElektronik ke daftar
  daftarProduk.push_back(ProdukElektronik(id, nama, watt, harga));
  cout << "Produk berhasil ditambahkan!\n";
}

// Mengupdate data produk berdasarkan ID
void updateProduk()
{
  string id;
  cout << "Masukkan ID produk yang akan diupdate: ";
  cin >> id;
  cin.ignore();
  int idx = cariProduk(id); // Cari index produk
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

  // Set nilai baru ke objek produk
  daftarProduk[idx].setNama(nama);
  daftarProduk[idx].setWatt(watt);
  daftarProduk[idx].setHarga(harga);

  cout << "Produk berhasil diupdate!\n";
}

// Menghapus produk berdasarkan ID
void hapusProduk()
{
  string id;
  cout << "Masukkan ID produk yang akan dihapus: ";
  cin >> id;
  int idx = cariProduk(id); // Cari index produk
  if (idx == -1)
  {
    cout << "Produk tidak ditemukan!\n";
    return;
  }

  // Hapus produk dari vector
  daftarProduk.erase(daftarProduk.begin() + idx);
  cout << "Produk berhasil dihapus!\n";
}

// Menampilkan produk tertentu berdasarkan ID
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
    // Menampilkan menu utama
    cout << "\n=== MENU TOKO ELEKTRONIK ===\n";
    cout << "1. Tambah Produk\n";
    cout << "2. Tampilkan Semua Produk\n";
    cout << "3. Update Produk\n";
    cout << "4. Hapus Produk\n";
    cout << "5. Cari Produk\n";
    cout << "0. Keluar\n";
    cout << "Pilih menu: ";
    cin >> pilihan;
    cin.ignore(); // Buang newline

    // Pilih aksi sesuai input user
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
  } while (pilihan != 0); // Ulang selama pilihan bukan 0

  return 0;
}
