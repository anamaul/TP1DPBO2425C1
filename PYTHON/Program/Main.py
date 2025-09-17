# Import class ProdukElektronik dari file ProdukElektronik.py
from ProdukElektronik import ProdukElektronik

# List untuk menyimpan semua produk elektronik
daftar_produk = []


# Fungsi untuk mencari produk berdasarkan ID
# Mengembalikan index produk jika ditemukan, atau -1 jika tidak ditemukan
def cari_produk(id):
    # Loop melalui semua produk dengan enumerate untuk mendapatkan index
    for i, p in enumerate(daftar_produk):
        # Jika ID produk cocok dengan ID yang dicari
        if p.get_id() == id:
            return i  # Kembalikan index produk
    return -1  # Kembalikan -1 jika produk tidak ditemukan


# Fungsi untuk menampilkan semua produk
def tampilkan_produk():
    # Cek apakah daftar produk kosong
    if not daftar_produk:
        print("Belum ada produk.")
        return
    print("\n=== Daftar Produk ===")
    # Loop melalui semua produk dan tampilkan informasinya
    for p in daftar_produk:
        p.tampilkan_info()


# Fungsi untuk menambah produk baru
def tambah_produk():
    # Input ID produk dan hapus spasi di awal/akhir
    id = input("Masukkan ID produk: ").strip()
    # Cek apakah ID produk sudah ada
    if cari_produk(id) != -1:
        print(f"Produk dengan ID '{id}' sudah ada!")
        return
    # Input data produk baru
    nama = input("Masukkan Nama produk: ")
    watt = input("Masukkan Watt produk: ")
    harga = input("Masukkan Harga produk: ")
    # Tambahkan produk baru ke dalam list
    daftar_produk.append(ProdukElektronik(id, nama, watt, harga))
    print("Produk berhasil ditambahkan!")


# Fungsi untuk mengupdate data produk
def update_produk():
    # Input ID produk yang akan diupdate
    id = input("Masukkan ID produk yang akan diupdate: ").strip()
    idx = cari_produk(id)  # Cari index produk
    # Cek apakah produk ditemukan
    if idx == -1:
        print("Produk tidak ditemukan!")
        return
    # Input data baru untuk produk
    nama = input("Masukkan Nama baru: ")
    watt = input("Masukkan Watt baru: ")
    harga = input("Masukkan Harga baru: ")
    # Update data produk menggunakan setter methods
    daftar_produk[idx].set_nama(nama)
    daftar_produk[idx].set_watt(watt)
    daftar_produk[idx].set_harga(harga)
    print("Produk berhasil diupdate!")


# Fungsi untuk menghapus produk
def hapus_produk():
    # Input ID produk yang akan dihapus
    id = input("Masukkan ID produk yang akan dihapus: ").strip()
    idx = cari_produk(id)  # Cari index produk
    # Cek apakah produk ditemukan
    if idx == -1:
        print("Produk tidak ditemukan!")
        return
    # Hapus produk dari list menggunakan pop()
    daftar_produk.pop(idx)
    print("Produk berhasil dihapus!")


# Fungsi untuk mencari dan menampilkan produk berdasarkan ID
def cari_produk_menu():
    # Input ID produk yang akan dicari
    id = input("Masukkan ID produk: ").strip()
    idx = cari_produk(id)  # Cari index produk
    # Cek apakah produk ditemukan
    if idx == -1:
        print("Produk tidak ditemukan!")
        return
    # Tampilkan informasi produk yang ditemukan
    daftar_produk[idx].tampilkan_info()


# Fungsi utama program
def main():
    # Loop utama program
    while True:
        # Tampilkan menu utama
        print("\n=== MENU TOKO ELEKTRONIK ===")
        print("1. Tambah Produk")
        print("2. Tampilkan Semua Produk")
        print("3. Update Produk")
        print("4. Hapus Produk")
        print("5. Cari Produk")
        print("0. Keluar")
        # Input pilihan user
        pilihan = input("Pilih menu: ")
        
        # Proses pilihan user menggunakan if-elif-else
        if pilihan == "1":
            tambah_produk()     # Panggil fungsi tambah produk
        elif pilihan == "2":
            tampilkan_produk()  # Panggil fungsi tampilkan produk
        elif pilihan == "3":
            update_produk()     # Panggil fungsi update produk
        elif pilihan == "4":
            hapus_produk()      # Panggil fungsi hapus produk
        elif pilihan == "5":
            cari_produk_menu()  # Panggil fungsi cari produk
        elif pilihan == "0":
            print("Keluar program...")
            break               # Keluar dari loop (mengakhiri program)
        else:
            print("Pilihan tidak valid!")  # Pesan error untuk pilihan tidak valid


# Entry point program - jalankan fungsi main() jika file dijalankan langsung
if __name__ == "__main__":
    main()