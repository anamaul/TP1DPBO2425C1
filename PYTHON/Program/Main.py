from ProdukElektronik import ProdukElektronik

daftar_produk = []


def cari_produk(id):
    for i, p in enumerate(daftar_produk):
        if p.get_id() == id:
            return i
    return -1


def tampilkan_produk():
    if not daftar_produk:
        print("Belum ada produk.")
        return
    print("\n=== Daftar Produk ===")
    for p in daftar_produk:
        p.tampilkan_info()


def tambah_produk():
    id = input("Masukkan ID produk: ").strip()
    if cari_produk(id) != -1:
        print(f"Produk dengan ID '{id}' sudah ada!")
        return
    nama = input("Masukkan Nama produk: ")
    watt = input("Masukkan Watt produk: ")
    harga = input("Masukkan Harga produk: ")
    daftar_produk.append(ProdukElektronik(id, nama, watt, harga))
    print("Produk berhasil ditambahkan!")


def update_produk():
    id = input("Masukkan ID produk yang akan diupdate: ").strip()
    idx = cari_produk(id)
    if idx == -1:
        print("Produk tidak ditemukan!")
        return
    nama = input("Masukkan Nama baru: ")
    watt = input("Masukkan Watt baru: ")
    harga = input("Masukkan Harga baru: ")
    daftar_produk[idx].set_nama(nama)
    daftar_produk[idx].set_watt(watt)
    daftar_produk[idx].set_harga(harga)
    print("Produk berhasil diupdate!")


def hapus_produk():
    id = input("Masukkan ID produk yang akan dihapus: ").strip()
    idx = cari_produk(id)
    if idx == -1:
        print("Produk tidak ditemukan!")
        return
    daftar_produk.pop(idx)
    print("Produk berhasil dihapus!")


def cari_produk_menu():
    id = input("Masukkan ID produk: ").strip()
    idx = cari_produk(id)
    if idx == -1:
        print("Produk tidak ditemukan!")
        return
    daftar_produk[idx].tampilkan_info()


def main():
    while True:
        print("\n=== MENU TOKO ELEKTRONIK ===")
        print("1. Tambah Produk")
        print("2. Tampilkan Semua Produk")
        print("3. Update Produk")
        print("4. Hapus Produk")
        print("5. Cari Produk")
        print("0. Keluar")
        pilihan = input("Pilih menu: ")
        if pilihan == "1":
            tambah_produk()
        elif pilihan == "2":
            tampilkan_produk()
        elif pilihan == "3":
            update_produk()
        elif pilihan == "4":
            hapus_produk()
        elif pilihan == "5":
            cari_produk_menu()
        elif pilihan == "0":
            print("Keluar program...")
            break
        else:
            print("Pilihan tidak valid!")


if __name__ == "__main__":
    main()
