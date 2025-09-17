
import java.util.ArrayList;
import java.util.Scanner;

public class Main {

    static ArrayList<ProdukElektronik> daftarProduk = new ArrayList<>();
    static Scanner input = new Scanner(System.in);

    static int cariProduk(String id) {
        for (int i = 0; i < daftarProduk.size(); i++) {
            if (daftarProduk.get(i).getId().equals(id)) {
                return i;
            }
        }
        return -1;
    }

    static void tampilkanProduk() {
        if (daftarProduk.isEmpty()) {
            System.out.println("Belum ada produk.");
            return;
        }
        System.out.println("\n=== Daftar Produk ===");
        for (ProdukElektronik p : daftarProduk) {
            p.tampilkanInfo();
        }
    }

    static void tambahProduk() {
        System.out.print("Masukkan ID produk: ");
        String id = input.nextLine();
        if (cariProduk(id) != -1) {
            System.out.println("Produk dengan ID '" + id + "' sudah ada!");
            return;
        }
        System.out.print("Masukkan Nama produk: ");
        String nama = input.nextLine();
        System.out.print("Masukkan Watt produk: ");
        String watt = input.nextLine();
        System.out.print("Masukkan Harga produk: ");
        String harga = input.nextLine();
        daftarProduk.add(new ProdukElektronik(id, nama, watt, harga));
        System.out.println("Produk berhasil ditambahkan!");
    }

    static void updateProduk() {
        System.out.print("Masukkan ID produk yang akan diupdate: ");
        String id = input.nextLine();
        int idx = cariProduk(id);
        if (idx == -1) {
            System.out.println("Produk tidak ditemukan!");
            return;
        }
        System.out.print("Masukkan Nama baru: ");
        String nama = input.nextLine();
        System.out.print("Masukkan Watt baru: ");
        String watt = input.nextLine();
        System.out.print("Masukkan Harga baru: ");
        String harga = input.nextLine();
        ProdukElektronik p = daftarProduk.get(idx);
        p.setNama(nama);
        p.setWatt(watt);
        p.setHarga(harga);
        System.out.println("Produk berhasil diupdate!");
    }

    static void hapusProduk() {
        System.out.print("Masukkan ID produk yang akan dihapus: ");
        String id = input.nextLine();
        int idx = cariProduk(id);
        if (idx == -1) {
            System.out.println("Produk tidak ditemukan!");
            return;
        }
        daftarProduk.remove(idx);
        System.out.println("Produk berhasil dihapus!");
    }

    static void cariProdukMenu() {
        System.out.print("Masukkan ID produk: ");
        String id = input.nextLine();
        int idx = cariProduk(id);
        if (idx == -1) {
            System.out.println("Produk tidak ditemukan!");
            return;
        }
        daftarProduk.get(idx).tampilkanInfo();
    }

    public static void main(String[] args) {
        int pilihan;
        do {
            System.out.println("\n=== MENU TOKO ELEKTRONIK ===");
            System.out.println("1. Tambah Produk");
            System.out.println("2. Tampilkan Semua Produk");
            System.out.println("3. Update Produk");
            System.out.println("4. Hapus Produk");
            System.out.println("5. Cari Produk");
            System.out.println("0. Keluar");
            System.out.print("Pilih menu: ");
            pilihan = Integer.parseInt(input.nextLine());
            switch (pilihan) {
                case 1 ->
                    tambahProduk();
                case 2 ->
                    tampilkanProduk();
                case 3 ->
                    updateProduk();
                case 4 ->
                    hapusProduk();
                case 5 ->
                    cariProdukMenu();
                case 0 ->
                    System.out.println("Keluar program...");
                default ->
                    System.out.println("Pilihan tidak valid!");
            }
        } while (pilihan != 0);
    }
}
