produk = []

while True:
    print('+' + '-' * 34 + '+')
    print("|           MENU UTAMA             |")
    print('+' + '-' * 34 + '+')
    print("| 1. Tambah produk                 |")
    print("| 2. Lihat daftar produk           |")
    print("| 3. Transaksi                     |")
    print("| 4. Keluar                        | ")
    print('+' + '-' * 34 + '+')

    opsi = input("=> Pilih menu (1/2/3/4): ")

    if opsi == "1":
        nama_produk = input('Nama produk: ')
        harga_produk = int(input('Harga produk: '))
        tambah_produk = {
        'Nama': nama_produk,
        'Harga': harga_produk,
    }
        produk.append(tambah_produk)
        print("!!! Produk-produk berhasil ditambahkan !!!")

    elif opsi == "2":
        print('+' + '-' * 34 + '+')
        print('|' + ' ' * 10 + 'DAFTAR PRODUK' + ' ' * 11 + '|')
        print('+' + '-' * 34 + '+')
        x = 1
        for i in produk:
            print(f'{x}. {i["Nama"]} - {i["Harga"]}')
            x += 1
        print('+' + '-' * 34 + '+')

    elif opsi == "3":
        print('+' + '-' * 34 + '+')
        print('|' + ' ' * 10 + 'DAFTAR PRODUK' + ' ' * 11 + '|')
        print('+' + '-' * 34 + '+')
        x = 1
        for i in produk:
            print(f'{x}. {i["Nama"]} - {i["Harga"]}')
            x += 1
        print('+' + '-' * 34 + '+')
        beli = input("=> Masukkan jumlah jenis produk yang akan di beli: ")
        barang = input("Nomor barang : ")
        jumlah = input("Jumlah barang : ")
        
        print('+' + '-' * 34 + '+')
        print('|' + ' ' * 7 + 'RINGKASAN TRANSAKSI' + ' ' * 8 + '|')
        print('+' + '-' * 34 + '+')

    elif opsi == "4":
        print("Terimakasih sudah berbelanja.")
        break
    else:
        print(f"Opsi '{opsi}' tidak ada dalam menu!")
        print("Silahkan dipilih lagi!")