# While

i = int(input('Masukkan angka : '))

while i <= 10:
    print(i)
    i += 1 # counter for stop

# j = int(input('Masukkan angka : '))

# while j > 0:
#     print(j, end=" ") # menghapus enter
#     j -= 1
    
# For

for i in range (1,10+1):
    print(i)

awal = int(input('Masukkan angka awal: '))
akhir = int(input('Masukkan angka akhir: '))
prima = 0 # digunakan untuk menghitung jumlah bilangan prima dalam rentang yang ditentukan.

for i in range (awal,akhir +1):
    f=0 # deklarasi variabel
    for j in range(1,i+1): # program mencoba untuk memeriksa apakah i adalah bilangan prima atau bukan
        if i%j == 0: # memeriksa berapa banyak faktor yang dapat membagi i. Jika hanya ada dua faktor (yaitu 1 dan i itu sendiri), maka i adalah bilangan prima, dan variabel f akan menjadi 2.
            f+=1 # jika teridentifikasi faktor dari i%j ==0
    if f==2: # jika bilangan terdapat 2 faktor maka termasuk prima
        prima += 1 # menghitung jumlah bilangan prima & akan ditambahkan 1.
print(f'Jumlah prima antara {awal}-{akhir} adalah {prima}')

# Deret Fibonacci adalah himpunan bilangan yang terus bertambah dimana setiap bilangan sama dengan jumlah dua bilangan sebelumnya.

i = 0 # nilai awal deret Fibonacci (0 dan 1)
j = 1
k = 0 # digunakan untuk menghitung berapa banyak angka yang telah dihasilkan dalam deret Fibonacci.

Fibonacci = int(input('Masukkan jumlah angka dalam deret Fibonacci: '))
print(f'deret fibonacci dari 0 sebanyak {Fibonacci} =')

while k < Fibonacci:
    print(i,end=" ")
    hasil = i + j # Menghitung nilai berikutnya dalam deret Fibonacci dengan menjumlahkan i dan j
    i = j # Memindahkan nilai j menjadi i untuk langkah berikutnya.
    j = hasil # Memindahkan nilai hasil menjadi j
    k += 1 # menghitung berapa banyak angka yang telah dihasilkan dalam deret

user = int(input('Masukkan batas perkalian: '))
for i in range(1,user+1):
    for j in range(1,10+1):
        hasil = i*j
        print(f'{i} x {j} = {hasil}')
    print()

user = int(input('Masukkan angka: '))

for i in range(1, user+1):
    for j in range(user, i, -1):
        print(" ", end=" ") # membuat pyramid

    for k in range(i, 0, -1):
        print(k, end=" ") # left side

    for l in range(2, i+1):
        print(l, end=" ") # right side
    print(end='\n')