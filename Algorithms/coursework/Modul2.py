# Percabangan if, elif, else
# if (condition):
#     (execution)
# elif (condition):
#     (execution)
# else:
#     (execution)

a = int(input("1-100 : "))
if a <= 10:
    print("great")
elif a <= 100:
    print("good")
else:
    print("put numbers 1-100")

uang_belanja = int(input('Masukan uang belanja anda : '))
print('-'*10 + 'Pilih barang yang belanja' + '-'*10)
print('|         1. Pakaian                        |')
print('|         2. Makanan                        |')
print('|         3. Perabotan                      |')
print('-'*45)
opsi = int(input('Pilih menu : '))

if opsi == 1:
      print('Harga paket 1 : 200000')
      print('Harga paket 2 : 599999')
      print('Harga paket 3 : 1999999')
      paket = int(input('Pilih paket : '))
      if paket == 1:
            if uang_belanja >= 200000:
                  kembalian = uang_belanja - 200000
                  print('Selamat anda berhasil membeli paket!')
                  print('Kembalian : ' + str(kembalian))
            else:
                  print('Uang anda kurang!')
      elif paket == 2:
            if uang_belanja >= 599999:
                  kembalian = uang_belanja - 599999
                  print('Selamat anda berhasil membeli paket!')
                  print('Kembalian : ' + str(kembalian))
            else:
                  print('Uang anda kurang!')
      elif paket == 3:
            if uang_belanja >= 1999999:
                  kembalian = uang_belanja - 1999999
                  print('Selamat anda berhasil membeli paket!')
                  print('Kembalian : ' + str(kembalian))
            else:
                  print('Uang anda kurang!')
      else:
            print('Maaf pilihan anda tidak ada di menu!')

elif opsi == 2:
      print('Harga paket 1 : 25000')
      print('Harga paket 2 : 64000')
      print('Harga paket 3 : 125000')
      paket = int(input('Pilih paket : '))
      if paket == 1:
            if uang_belanja >= 25000:
                  kembalian = uang_belanja - 25000
                  print('Selamat anda berhasil membeli paket!')
                  print('Kembalian : ' + str(kembalian))
            else:
                  print('Uang anda kurang!')
      elif paket == 2:
            if uang_belanja >= 64000:
                  kembalian = uang_belanja - 64000
                  print('Selamat anda berhasil membeli paket!')
                  print('Kembalian : ' + str(kembalian))
            else:
                  print('Uang anda kurang!')
      elif paket == 3:
            if uang_belanja >= 125000:
                  kembalian = uang_belanja - 125000
                  print('Selamat anda berhasil membeli paket!')
                  print('Kembalian : ' + str(kembalian))
            else:
                  print('Uang anda kurang!')
      else:
            print('Maaf pilihan anda tidak ada di menu!')

elif opsi == 3:
      print('Maaf paket dalam menu ini masih kosong')

else:
      print('Silahkan masukan angka yang ada di dalam Menu!')

nilai = int(input('Masukan nilai anda : '))
if nilai > 100:
    print('Nilai tidak terdaftar')
elif nilai >= 91:
    print('Nilai anda A')
    print('Selamat anda lulus')
elif nilai >= 81:
    print('Nilai anda B')
    print('Selamat anda lulus')
elif nilai >= 71:
    print('Nilai anda C')
    print('Selamat anda lulus')
elif nilai >= 0:
    print('Nilai anda D')
    print('Anda tidak lulus')
else:
    print('Nilai tidak terdaftar')

alpro = int(input("Masukkan nilai Alpro : "))
pti = int(input("Masukkan nilai PTI : "))
mtk = int(input("Masukkan nilai Matematika : "))
inggris = int(input("Masukkan nilai bahasa Inggris : "))
etika = int(input("Masukkan nilai Etika : "))

hasil = (alpro+pti+mtk+inggris+etika) / 5 / 20 - 1
print("nilai akademik anda:",hasil)
kehadiran = int(input("Masukkan persentase kehadiran (0-100): "))
ukm = input("Apakah anda aktif dalam ekstrakurikuler (ya/tidak): ")

if hasil > 3.0 and kehadiran > 80 and ukm == "ya":
    print("Anda layak mendapatkan beasiswa karena telah memenuhi semua persyaratan")
else:
    print('')
    print('Hasil:')
    if hasil < 3.0:
        print("Maaf, anda tidak layak menerima beasiswa karena nilai rata-rata anda kurang dari 3.0")
    elif kehadiran < 80:
        print("Maaf, anda tidak layak menerima beasiswa karena tingkat kehadiran anda kurang dari 80%")
    else:
        ukm != "ya"
        print("Maaf, anda tidak layak menerima beasiswa karena tidak aktif dalam setidaknya satu kegiatan UKM yang terdaftar di universitas.")

a1 = int(input('Masukkan angka pertama : '))
a2 = int(input('Masukkan angka kedua : '))
a3 = int(input('Masukkan angka ketiga : '))

if a1 > a2 and a1 > a3:
    if a2 > a3:
        print(f'Bilangan terbesar ke terkecil = {a1}, {a2} dan {a3}')
    else:
        print(f'Bilangan terbesar ke terkecil = {a1}, {a3} dan {a2}')

elif a2 > a1 and a2 > a3:
    if a1 > a3:
        print(f'Bilangan terbesar ke terkecil = {a2}, {a1} dan {a3}')
    else:
        print(f'Bilangan terbesar ke terkecil = {a2}, {a3} dan {a1}')

elif a3 > a2 and a3 > a2:
    if a1 > a2:
        print(f'Bilangan terbesar ke terkecil = {a3}, {a1} dan {a2}')
    else:
        print(f'B3ilangan terbesar ke terkecil = {a3}, {a2} dan {a1}')