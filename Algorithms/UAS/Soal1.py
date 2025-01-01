nim = input("Masukkan NIM Anda: ")

# Ambil digit terakhir dari NIM
angkaTerakhir = nim[-1]
hasil = ""

for i in nim[:-1]:
    if i != angkaTerakhir:
        hasil += i

print("NIM tanpa digit terakhir:", hasil)
