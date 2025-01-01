user = input('Silahkan masukkan nama anda : ')
line = "=" * 50

def main_menu():
    print(f"""{line}
Selamat datang di Modul 4 {user}.
    
Pilih contoh soal yang ingin anda pelajari!

1. Jelakan minimal 1 paragraf dan berikan contoh jika ada mengenai
    a. Pengertian Flow Control
    b. Perbedan Continue dan Break
    c. Pengertian Array dalam Bahasa pemograman
    d. List dalam python dan macam-macam operasinya
    e. Cara mengakses List

2. Dengan python Buatkan sebuah list “iniGenap” dan “iniGanjil” ,
    buatkan perulangan dari 1-100 , masukkan bilangan genap ke list iniGenap, dan
    masukkan bilangan ganjil ke iniGanjil, TAMPILKAN HASILNYA!

3. Buatlah proggram untuk memasukkan inputan user ke variable x untuk menentukan
    jumlah kategori, dan tiap-tiap kategori mempunyai daftar nama-nama berjumlah y yang
    juga merupakan inputan user. Semua daftar nama harus ada di dalam list dan punya
    output bernomor untuk setiap kategori dan daftarnyaSeperti contoh:

4. Dengan menggunakan menu berikut :
    Menu Makanan:
    1. Nasi Goreng - Rp15000
    2. Mie Ayam - Rp12000
    3. Soto Ayam - Rp13000
    4. Ayam Goreng - Rp14000

    Semua menu diatas harus ada pada 1 list Bernama “myMenu”
    Dengan menggunakan perulangan, tampikan list myMenu dengan format nomor seperti diatas,
    Minta inputan dari user untuk Uang yang dibayar
    Minta user memilih menu
    Jika user memilih selain menu diatas maka program akan menampilkan “MASUKAN SALAH”
        dan program AKAN TERUS MEMINTA INPUTAN DARI USER SAMPAI DIA MEMASUKKAN MENU YANG TERTERA
    Jika input sudah benar Buat kalkulasi menu dari uang seperti pada modul percabangan dan tampilkan sisa uang !

5. Buatlah code untuk menjumlahkan dua buah list, dengan ketentuan sebagai berikut :
    • Banyaknya anggota dan anggota dari masing-masing adalah inputan dari list
    • Inputan ini setelah kata -in-, dimana baris pertama adalah banyaknya anggota dari list, kemudian
        baris berikutnya adalah anggota atau nilai dari list tersebut
    • Output yang diinginkan ditampilkan setelah kata -out-
    • Terdapat tiga buah skenario penjumlahan,
        yaitu ketika banyaknya anggota adalah sama,
        banyaknya anggota list pertama lebih banyak dari pada list kedua,
        dan banyaknya anggota list kedua lebih banyak dari pada list pertama.

0. Keluar dari menu
{line}""")
    
    while True:
        opsi = int(input("Pilih nomor soal (1/2/3/4/5/0): "))

        if opsi == 1:
            while True:
                pilih = input("Pilih (a/b/c/d/e) : ")

                if pilih == "a":
                    print("""
        a. Pengertian Flow Control:
            Flow control adalah cara bagi komputer untuk mengikuti instruksi-instruksi dalam program secara tertib.
            Pada saat menemui instruksi tertentu,
            km harus membuat keputusan apa ingin mengikuti langkah berikutnya/melewatkannya.
            Contohnya, Ketika berkendara, kamu memutuskan apakah akan berbelok kanan atau kiri di persimpangan.
            Dalam pemrograman, kondisi ini menggunakan "if" untuk membuat keputusan.
            Misalnya, jika kita ingin membuat program yang mengatakan "Jika cuaca cerah,
            pergi ke taman," kita akan menggunakan flow control untuk mengatur program tersebut""")
                    soal_1a()

                elif pilih == "b":
                    print("""
        b. Perbedaan Continue dan Break:
            Perbedaan antara continue dan break adalah dalam cara mereka memengaruhi loop.""")
                    pilih2 = input("Penjelasan Continue or Break? (C/B) : ")
                    if pilih2 == "c":
                        print("""
        - Continue digunakan untuk melanjutkan loop ke iterasi berikutnya tanpa menghentikannya.
            Misalnya, dalam loop, jika ingin mengabaikan angka ganjil,
            kita dapat menggunakan continue untuk melompati angka-angka tersebut
            dan melanjutkan dengan angka genap berikutnya.""")
                    elif pilih2 == "B":
                        print("""
        - Break digunakan untuk menghentikan loop secara paksa ketika kondisi tertentu terpenuhi.
            Misalnya, dalam pencarian dalam list,
            kita dapat menggunakan break untuk menghentikan pencarian ketika item yang dicari ditemukan.""")
                    else:
                        print(f"Maaf opsi {pilih2} tidak ada!")

                elif pilih == "c":
                    print("""
        Array adalah cara untuk mengelompokkan beberapa nilai serupa/data dalam satu variabel.
            Cara kerjanya seperti tas di mana kita bisa menaruh bbrp barang di dalamnya,
            di array kita bisa untuk menyimpan beberapa angka & text untuk menyimpan daftar kata.
            Array memungkinkan kita untuk MENGATUR dan MENGAKSES data dengan lebih mudah.
            Contoh, jika memiliki array nama-nama teman,
                disini kita bisa mengakses nama-nama mereka dengan nomor indeks,           
                seperti "teman[0]" untuk nama pertama,
                "teman[1]" untuk nama kedua, dan seterusnya.""")
                    soal_1c

                elif pilih == "d" or pilih == "e":
                    print("""
        List dalam Python adalah kumpulan dataa berupa nilai atau text yg disusun dalam satu variabel.
            Cara membuat list yaitu dengan tanda kurung siku [ ]
            dan memasukkan elemen di dalamnya, trus dipisah pake koma.
                - macam operasi yg dpt dilakukan, seperti mengakses elemen berdasarkan indeks,
                menambahkan elemen, mengetahui panjang list,
                dan menghapus elemen menggunakan metode remove( ).""")
                    soal_1d_and_e

                elif opsi == "0":
                    print(f"Terima kasih sudah mampir {user}.")
                    break

                else:
                    print(f"    # Maaf opsi {pilih} tidak valid")
        
        elif opsi == 2:
            soal_2
        elif opsi == 3:
            soal_3
        elif opsi == 4:
            soal_4
        elif opsi == 5:
            soal_5                  
        elif opsi == 0:
                print(f"Terima kasih sudah mampir {user}.")
                break
        else:
            print(f'    # Maaf opsi "{opsi}" tidak ada di menu!')

def soal_1a():
    cuaca = input("Apakah cuaca hari ini cerah? (ya/tidak) ")
    if cuaca == "ya":
        print("Pergi ke taman")
    elif cuaca == "tidak":
        print("Pulang ke rumah")
    else:
        print("Silahkan dijawab (ya/tidak)")

def soal_1b_continue():
    user = int(input('Masukan batas angka : '))
    for i in range(1, user+1):
        if i % 2 == 1:
            continue
        print(f'{i} adalah angka genap')

def soal_1b_break():
    buah_berry = ["Strawberry", "Blueberry", "Blackberry", "Raspberry"]
    for buah_berry in buah_berry:
        if buah_berry == "Blackberry":
            break  # menghentikan pencarian setelah menemukan Blackberry
        print(buah_berry)

def soal_1c():
    teman = ["Asep", "Udin", "Joko", "Budi"]
    print("Nama teman pertama : " + teman[0])
    print("Nama teman kedua : " + teman[1])

def soal_1d_and_e():
    my_list = [18, 46.7, "aseli cuy!", 'mang eak?'] # membuat list
    print(f'ini adalah list saya : {my_list}')  # mengeksekusi list

    my_list.append("ini bapak budi") # menambahkan elemen
    print(f'saya menambahkan satu elemen lagi pada list : {my_list}')

    length = len(my_list) # mengetahui panjang list
    print(f'ini adalah banyak elemen dalam list saya : {length}')

    my_list.remove(46.7) # menghapus elemen
    print(f'saya menghapus 46.7 dalam list saya : {my_list}')

    first_element = my_list[0] # mengakses elemen pertama
    print(f'ini adalah elemen pertama dalam list : {first_element}')
    last_element = my_list[-1] # mengakses elemen terakhir
    print(f'ini adalah elemen terakhir dalam list : {last_element}')

def soal_2():
    iniGenap = []
    iniGanjil = []

    for i in range(1, 100+1):
        if i % 2 == 0:
            iniGenap.append(i)
        else:
            iniGanjil.append(i)

    print (f'Bilangan Genap : {iniGenap}')
    print (f'Bilangan Ganjil : {iniGanjil}')

def soal_3():
    x = int(input("Masukkan jumlah kategori: "))
    kategori_list = []  # Membuat list kosong untuk menyimpan kategori
    daftar = 0  # Inisialisasi variabel daftar

    # Loop untuk mengambil jumlah daftar dalam setiap kategori
    for i in range(x):
        y = int(input(f"masukkan jumlah daftar ke-{daftar+1}: "))  # Mengambil jumlah daftar
        daftar += 1  # Menambahkan nomor daftar
        nama_list = []  # Membuat list kosong untuk menyimpan nama dalam kategori

        # Loop untuk mengambil nama dalam setiap daftar
        for j in range(y):
            nama = input(f"masukkan kategori ke-{i+1} daftar ke-{j+1}: ")  # Mengambil nama
            nama_list.append(nama)  # Menambahkan nama ke list nama dalam kategori
        kategori_list.append((y, nama_list))  # Menambahkan jumlah daftar dan list nama ke list kategori

    nomor_kategori = 1  # Inisialisasi nomor kategori

    # Loop untuk mencetak kategori dan daftar-daftar yang ada dalamnya
    for kategori, nama_list in kategori_list:
        print(f"Kategori ke {nomor_kategori}")  # Mencetak nomor kategori
        nomor_kategori += 1  # Menambahkan nomor kategori
        nomor_nama = 1  # Inisialisasi nomor nama

        # Loop untuk mencetak nama-nama dalam kategori
        for nama in nama_list:
            print(f"  {nomor_nama}. {nama}")  # Mencetak nomor dan nama
            nomor_nama += 1  # Menambahkan nomor nama

def soal_4():
    print("Menu Makanan: ")
    myMenu = ["Nasi Goreng - Rp15000",
              "Mie Ayam - Rp12000",
              "Soto Ayam - Rp13000",
              "Ayam Goreng - Rp14000"]
    j = 0

    for i in myMenu:
        j += 1 # mencetak angka setiap perulangan
        print(f"{j}.{i}")
    uang = int(input("Masukkan uang yang dibayar: Rp"))

    while True: # ketika salah akan terus melakukan loop
        user = int(input("Pilih Menu: "))

        if user == 1:
            if user == 1 and uang >= 15000:
                sisa_uang = uang - 15000
                print(f"sisa uang Rp{sisa_uang}")
            else:
                print("Uang yang di bayar kurang!")
                break # Menghentikan loop

        elif user == 2:
            if user == 2 and uang >= 12000:
                sisa_uang = uang - 12000
                print(f"sisa uang = Rp{sisa_uang}")
            else:
                print("Uang yang di bayar kurang!")
            break

        elif user == 3:
            if user == 3 and uang >= 13000:
                sisa_uang = uang - 13000
                print(f"sisa uang = Rp{sisa_uang}")
            else:
                print("Uang yang di bayar kurang!")
            break

        elif user == 4:
            if user == 4 and uang >= 14000:
                sisa_uang = uang - 14000
                print(f"sisa uang = Rp{sisa_uang}")
            else:
                print("Uang yang di bayar kurang!")
            break

        else:
            print("MASUKAN SALAH")

def soal_5():
    print("-in-")

    user1 = int(input(""))
    data1 = [] # list kosong untuk menyimpan elemen user1

    # Perulangan data1 = nilai dri user1
    for i in range(user1):
        # Meminta user1 untuk memasukkan nilai, lalu menyimpannya dalam data1
        nilai = int(input("   ")) # memberi spasi dibawah data1
        data1.append(nilai) # menambahkan elemen data1

    user2 = int(input(""))
    data2 = []
    for i in range(user2):
        nilai = int(input("   "))
        data2.append(nilai)

    # Menghitung jumlah elemen data1 & data2
    kolomList1 = len(data1)
    kolomList2 = len(data2)
    total = [] # menyimpan hasil penjumlahan

    print("-out-")
    print(data1)
    print(data2)

    if kolomList1 == kolomList2:
        # Jika sama, menjumlahkan elemen-elemen data1 dan data2, dan menyimpan hasilnya dalam total
        for i in range(len(data1)):
            hasil = (data1[i] + data2[i])
            total.append(hasil)
        # Menampilkan hasil penjumlahan
        print(total)

    elif kolomList1 > kolomList2:
        # Loop untuk menjumlahkan elemen-elemen data1 dan data2, dan menambahkan elemen 0 ke data2 agar panjangnya sama
        for i in range(len(data1)):
            hasil = (data1[i] + data2[i])
            data2 += [0]
            total.append(hasil)
        print(total)

    else:
        # Loop untuk menjumlahkan elemen-elemen data1 dan data2, dan menambahkan elemen 0 ke data1 agar panjangnya sama
        for i in range(len(data2)):
            hasil = (data1[i] + data2[i])
            data1 += [0]
            total.append(hasil)
        print(total)

main_menu()