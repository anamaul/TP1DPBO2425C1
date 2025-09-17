class ProdukElektronik:
    def __init__(self, id="", nama="", watt="", harga=""):
        self.id = id
        self.nama = nama
        self.watt = watt
        self.harga = harga

    def set_id(self, id):
        self.id = id

    def get_id(self):
        return self.id

    def set_nama(self, nama):
        self.nama = nama

    def get_nama(self):
        return self.nama

    def set_watt(self, watt):
        self.watt = watt

    def get_watt(self):
        return self.watt

    def set_harga(self, harga):
        self.harga = harga

    def get_harga(self):
        return self.harga

    def tampilkan_info(self):
        print(f"ID: {self.id}")
        print(f"Nama: {self.nama}")
        print(f"Watt: {self.watt}")
        print(f"Harga: {self.harga}")
        print("=====================")
