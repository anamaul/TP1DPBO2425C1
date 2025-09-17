
import java.util.ArrayList;
import java.util.Scanner;

public class Main {

    // Deklarasi ArrayList untuk menyimpan daftar produk elektronik
    static ArrayList<ProdukElektronik> daftarProduk = new ArrayList<>();
    // Deklarasi Scanner untuk membaca input dari user
    static Scanner input = new Scanner(System.in);

    // Method untuk mencari produk berdasarkan ID
    // Mengembalikan index produk jika ditemukan, atau -1 jika tidak ditemukan
    static int cariProduk(String id) {
        // Loop melalui semua produk dalam daftar
        for (int i = 0; i < daftarProduk.size(); i++) {
            // Jika ID produk cocok dengan ID yang dicari
            if (daftarProduk.get(i).getId().equals(id)) {
                return i; // Kembalikan index produk
            }
        }
        return -1; // Kembalikan -1 jika produk tidak ditemukan
    }

    // Method untuk menampilkan semua produk
    static void tampilkanProduk() {
        // Cek apakah daftar produk kosong
        if (daftarProduk.isEmpty()) {
            System.out.println("Belum ada produk.");
            return;
        }
        System.out.println("\n=== Daftar Produk ===");
        // Loop melalui semua produk dan tampilkan informasinya
        for (ProdukElektronik p : daftarProduk) {
            p.tampilkanInfo();
        }
    }

    // Method untuk menambah produk baru
    static void tambahProduk() {
        System.out.print("Masukkan ID produk: ");
        String id = input.nextLine();
        // Cek apakah ID produk sudah ada
        if (cariProduk(id) != -1) {
            System.out.println("Produk dengan ID '" + id + "' sudah ada!");
            return;
        }
        // Input data produk baru
        System.out.print("Masukkan Nama produk: ");
        String nama = input.nextLine();
        System.out.print("Masukkan Watt produk: ");
        String watt = input.nextLine();
        System.out.print("Masukkan Harga produk: ");
        String harga = input.nextLine();
        // Tambahkan produk baru ke dalam daftar
        daftarProduk.add(new ProdukElektronik(id, nama, watt, harga));
        System.out.println("Produk berhasil ditambahkan!");
    }

    // Method untuk mengupdate data produk
    static void updateProduk() {
        System.out.print("Masukkan ID produk yang akan diupdate: ");
        String id = input.nextLine();
        int idx = cariProduk(id); // Cari index produk
        // Cek apakah produk ditemukan
        if (idx == -1) {
            System.out.println("Produk tidak ditemukan!");
            return;
        }
        // Input data baru untuk produk
        System.out.print("Masukkan Nama baru: ");
        String nama = input.nextLine();
        System.out.print("Masukkan Watt baru: ");
        String watt = input.nextLine();
        System.out.print("Masukkan Harga baru: ");
        String harga = input.nextLine();
        // Update data produk
        ProdukElektronik p = daftarProduk.get(idx);
        p.setNama(nama);
        p.setWatt(watt);
        p.setHarga(harga);
        System.out.println("Produk berhasil diupdate!");
    }

    // Method untuk menghapus produk
    static void hapusProduk() {
        System.out.print("Masukkan ID produk yang akan dihapus: ");
        String id = input.nextLine();
        int idx = cariProduk(id); // Cari index produk
        // Cek apakah produk ditemukan
        if (idx == -1) {
            System.out.println("Produk tidak ditemukan!");
            return;
        }
        // Hapus produk dari daftar
        daftarProduk.remove(idx);
        System.out.println("Produk berhasil dihapus!");
    }

    // Method untuk mencari dan menampilkan produk berdasarkan ID
    static void cariProdukMenu() {
        System.out.print("Masukkan ID produk: ");
        String id = input.nextLine();
        int idx = cariProduk(id); // Cari index produk
        // Cek apakah produk ditemukan
        if (idx == -1) {
            System.out.println("Produk tidak ditemukan!");
            return;
        }
        // Tampilkan informasi produk
        daftarProduk.get(idx).tampilkanInfo();
    }

    // Method main - titik awal program
    public static void main(String[] args) {
        int pilihan;
        // Loop utama program
        do {
            // Tampilkan menu utama
            System.out.println("\n=== MENU TOKO ELEKTRONIK ===");
            System.out.println("1. Tambah Produk");
            System.out.println("2. Tampilkan Semua Produk");
            System.out.println("3. Update Produk");
            System.out.println("4. Hapus Produk");
            System.out.println("5. Cari Produk");
            System.out.println("0. Keluar");
            System.out.print("Pilih menu: ");
            // Baca pilihan user dan konversi ke integer
            pilihan = Integer.parseInt(input.nextLine());
            // Switch case untuk menjalankan fungsi sesuai pilihan user
            switch (pilihan) {
                case 1 ->
                    tambahProduk(); // Panggil method tambah produk
                case 2 ->
                    tampilkanProduk(); // Panggil method tampilkan produk
                case 3 ->
                    updateProduk(); // Panggil method update produk
                case 4 ->
                    hapusProduk(); // Panggil method hapus produk
                case 5 ->
                    cariProdukMenu(); // Panggil method cari produk
                case 0 ->
                    System.out.println("Keluar program..."); // Keluar program
                default ->
                    System.out.println("Pilihan tidak valid!"); // Pesan error untuk pilihan tidak valid
            }
        } while (pilihan != 0); // Loop berlanjut sampai user memilih 0 (keluar)
    }
}
