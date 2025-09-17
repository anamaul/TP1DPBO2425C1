
public class ProdukElektronik {

    private String id;
    private String nama;
    private String watt;
    private String harga;

    public ProdukElektronik() {
    }

    public ProdukElektronik(String id, String nama, String watt, String harga) {
        this.id = id;
        this.nama = nama;
        this.watt = watt;
        this.harga = harga;
    }

    public String getId() {
        return id;
    }

    public void setId(String id) {
        this.id = id;
    }

    public String getNama() {
        return nama;
    }

    public void setNama(String nama) {
        this.nama = nama;
    }

    public String getWatt() {
        return watt;
    }

    public void setWatt(String watt) {
        this.watt = watt;
    }

    public String getHarga() {
        return harga;
    }

    public void setHarga(String harga) {
        this.harga = harga;
    }

    public void tampilkanInfo() {
        System.out.println("ID: " + id);
        System.out.println("Nama: " + nama);
        System.out.println("Watt: " + watt);
        System.out.println("Harga: " + harga);
        System.out.println("=====================");
    }
}
