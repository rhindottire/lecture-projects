# item = [
#     ("Kaos Putih : Rp 50,000"),
#     ("Celana Jeans: Rp 150,000"),
#     ("Dress hitam : Rp 120,000"),
# ]

# print("Daftar Item Toko baju:")
# for i in item:
#     print(f" - {i}")

# print("Daftar mata pelajaran: ")
# mapel = (
#     "Matematika",
#     "Bahasa Inggris",
#     "Sains",
#     "Sejarah",
#     "Seni"
# )

# for i in range(len(mapel)):
#     print(f"{i+1}. {mapel[i]}")
# print()

# user = int(input("Pilih mata pelajaran yang ingin anda pelajari (1-5): "))
# if 1 <= user <= len(mapel): # check apakah input dalam rentang yg valid (1-mapel)
#     opsi = mapel[user - 1] # - 1 dari user == indeks (0) yg sesuai mapel.
#     print(f'Anda akan mempelajari mata pelajaran "{opsi}".')
# else:
#     print(f"Opsi '{user}' tidak tersedia dalam daftar.")

# mahasiswa = []

# while True:
#     nama = input('Masukkan nama mahasiswa: ')
#     nilai = int(input('Masukkan nilai ujian: '))
#     opsi = input('Apakah ada mahasiswa lain? (ya/tidak): ')
#     print()
#     data = {
#         'nama': nama,
#         'nilai': nilai
#     }
#     mahasiswa.append(data)
#     if opsi != 'ya':
#         break

# print('Daftar Mahasiswa dan Nilai:')
# for i in mahasiswa:
#     print(f"- {i['nama']}: {i['nilai']}")

print('Selamat datang di Manajemen kontak!')
kontak = []

while True:
    menu = [
        'Menu:',
        '1. Tampilkan daftar kontak',
        '2. Tambah kontak baru',
        '3. Hapus kontak berdasarkan nama',
        '4. Keluar'
        ]
    for i in menu:
        print(i)

    print('')
    opsi = int(input('Pilihan (1/2/3/4): '))
    print('')

    if opsi == 2:
        nama = input('Masukkan nama kontak: ')
        nomor = input('Masukkan nomor telepon: ')
        email = input('Masukkan alamat email: ')
        list_kontak = {
            'Nama': nama,
            'Nomor': nomor,
            'Email': email
        }
        kontak.append(list_kontak)
        print(f'Kontak {nama} berhasil ditambahkan.')
        print('')
    
    elif opsi == 1:
        x = 1
        print('Daftar Kontak:')
        for j in kontak:
            print(f'{x}. Nama: {j["Nama"]}')
            print(f'   Nomor Telepon: {j["Nomor"]}')
            print(f'   Alamat Email: {j["Email"]}')
            print('')
            x += 1

    elif opsi == 3:
        hapus = input('Masukkan nama kontak yang ingin dihapus: ')
        for y in kontak:
            if y ['Nama'] == hapus:
                kontak.remove(y)
                print(f'Kontak {hapus} berhasil dihapus.')
                print('')
            else:
                print(f'kontak {hapus} tidak ditemukan.')
                print('')

    elif opsi == 4:
        print('Terima Kasih!')
        break