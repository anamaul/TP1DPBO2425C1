
public class ProdukElektronik {

    // Deklarasi atribut private untuk enkapsulasi data
    private String id;      // ID unik produk
    private String nama;    // Nama produk elektronik
    private String watt;    // Konsumsi daya produk (dalam watt)
    private String harga;   // Harga produk

    // Constructor default (tanpa parameter)
    public ProdukElektronik() {
    }

    // Constructor dengan parameter untuk inisialisasi objek
    public ProdukElektronik(String id, String nama, String watt, String harga) {
        this.id = id;
        this.nama = nama;
        this.watt = watt;
        this.harga = harga;
    }

    // Getter method untuk mengambil nilai ID
    public String getId() {
        return id;
    }

    // Setter method untuk mengubah nilai ID
    public void setId(String id) {
        this.id = id;
    }

    // Getter method untuk mengambil nilai nama
    public String getNama() {
        return nama;
    }

    // Setter method untuk mengubah nilai nama
    public void setNama(String nama) {
        this.nama = nama;
    }

    // Getter method untuk mengambil nilai watt
    public String getWatt() {
        return watt;
    }

    // Setter method untuk mengubah nilai watt
    public void setWatt(String watt) {
        this.watt = watt;
    }

    // Getter method untuk mengambil nilai harga
    public String getHarga() {
        return harga;
    }

    // Setter method untuk mengubah nilai harga
    public void setHarga(String harga) {
        this.harga = harga;
    }

    // Method untuk menampilkan informasi lengkap produk
    public void tampilkanInfo() {
        System.out.println("ID: " + id);
        System.out.println("Nama: " + nama);
        System.out.println("Watt: " + watt);
        System.out.println("Harga: " + harga);
        System.out.println("====================="); // Pemisah antar produk
    }
}
