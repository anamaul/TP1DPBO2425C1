#include <iostream> // Untuk operasi input-output (cout, endl)
#include <string>   // Untuk tipe data string
using namespace std;

// Mendefinisikan class ProdukElektronik
class ProdukElektronik
{
private:
    string id;    // Menyimpan ID produk
    string nama;  // Menyimpan nama produk
    string watt;  // Menyimpan daya (watt) produk
    string harga; // Menyimpan harga produk

public:
    ProdukElektronik() {} // Constructor default (tanpa parameter)

    // Constructor dengan parameter untuk inisialisasi atribut
    ProdukElektronik(string id, string nama, string watt, string harga)
    {
        this->id = id;
        this->nama = nama;
        this->watt = watt;
        this->harga = harga;
    }

    // ----------- Getter & Setter -----------
    void setId(string id) { this->id = id; }     // Mengatur ID
    string getId() { return id; }                // Mengambil ID

    void setNama(string nama) { this->nama = nama; } // Mengatur nama
    string getNama() { return nama; }                // Mengambil nama

    void setWatt(string watt) { this->watt = watt; } // Mengatur watt
    string getWatt() { return watt; }                // Mengambil watt

    void setHarga(string harga) { this->harga = harga; } // Mengatur harga
    string getHarga() { return harga; }                  // Mengambil harga

    // Method untuk menampilkan semua informasi produk
    void tampilkanInfo()
    {
        cout << "ID: " << id
             << "\nNama: " << nama
             << "\nWatt: " << watt
             << "\nHarga: " << harga << endl;
        cout << "=====================" << endl;
    }

    ~ProdukElektronik() {} // Destructor (kosong, hanya formalitas)
};
