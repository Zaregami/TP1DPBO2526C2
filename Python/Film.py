# class film untuk data film
class Film:
    # atribut film
    # konstruktor dengan parameter
    def __init__(self, id="", judul="", genre="", durasi=0, hargaTiket=0):
        self.__id = id
        self.__judul = judul
        self.__genre = genre
        self.__durasi = durasi
        self.__hargaTiket = hargaTiket

    # getter dan setter id
    def getId(self):
        return self.__id

    def setId(self, id):
        self.__id = id

    # getter dan setter judul
    def getJudul(self):
        return self.__judul

    def setJudul(self, judul):
        self.__judul = judul

    # getter dan setter genre
    def getGenre(self):
        return self.__genre

    def setGenre(self, genre):
        self.__genre = genre

    # getter dan setter durasi
    def getDurasi(self):
        return self.__durasi

    def setDurasi(self, durasi):
        self.__durasi = durasi

    # getter dan setter harga tiket
    def getHargaTiket(self):
        return self.__hargaTiket

    def setHargaTiket(self, hargaTiket):
        self.__hargaTiket = hargaTiket
