# Definisi class ProdukElektronik untuk merepresentasikan produk elektronik
class ProdukElektronik:
    # Constructor untuk inisialisasi objek dengan parameter default kosong
    def __init__(self, id="", nama="", watt="", harga=""):
        # Inisialisasi atribut instance dengan nilai yang diberikan
        self.id = id        # ID unik produk
        self.nama = nama    # Nama produk elektronik
        self.watt = watt    # Konsumsi daya produk (dalam watt)
        self.harga = harga  # Harga produk

    # Setter method untuk mengubah nilai ID
    def set_id(self, id):
        self.id = id

    # Getter method untuk mengambil nilai ID
    def get_id(self):
        return self.id

    # Setter method untuk mengubah nilai nama
    def set_nama(self, nama):
        self.nama = nama

    # Getter method untuk mengambil nilai nama
    def get_nama(self):
        return self.nama

    # Setter method untuk mengubah nilai watt
    def set_watt(self, watt):
        self.watt = watt

    # Getter method untuk mengambil nilai watt
    def get_watt(self):
        return self.watt

    # Setter method untuk mengubah nilai harga
    def set_harga(self, harga):
        self.harga = harga

    # Getter method untuk mengambil nilai harga
    def get_harga(self):
        return self.harga

    # Method untuk menampilkan informasi lengkap produk
    def tampilkan_info(self):
        print(f"ID: {self.id}")
        print(f"Nama: {self.nama}")
        print(f"Watt: {self.watt}")
        print(f"Harga: {self.harga}")
        print("=====================")  # Pemisah antar produk