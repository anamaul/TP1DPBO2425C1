#include <iostream> // Untuk input-output
#include <string>   // Untuk tipe data string
using namespace std;

// Membuat class ProdukElektronik
class ProdukElektronik
{
private:
    string id;    // ID produk
    string nama;  // Nama produk
    string watt;  // Daya (Watt) produk
    string harga; // Harga produk

public:
    ProdukElektronik() {} // Constructor default

    // Constructor dengan parameter
    ProdukElektronik(string id, string nama, string watt, string harga)
    {
        this->id = id;
        this->nama = nama;
        this->watt = watt;
        this->harga = harga;
    }

    // Getter & Setter
    void setId(string id) { this->id = id; }
    string getId() { return id; }

    void setNama(string nama) { this->nama = nama; }
    string getNama() { return nama; }

    void setWatt(string watt) { this->watt = watt; }
    string getWatt() { return watt; }

    void setHarga(string harga) { this->harga = harga; }
    string getHarga() { return harga; }

    // Method untuk menampilkan informasi produk
    void tampilkanInfo()
    {
        cout << "ID: " << id
             << "\nNama: " << nama
             << "\nWatt: " << watt
             << "\nHarga: " << harga << endl;
        cout << "=====================" << endl;
    }

    ~ProdukElektronik() {} // Destructor
};
