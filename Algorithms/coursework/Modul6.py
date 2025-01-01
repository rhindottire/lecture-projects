user = input("Masukkan string: ")

def reverse_str(input_str):
    return input_str[::-1] # slicing

reversed_str = reverse_str(user)
print(f'String terbalik "{reversed_str}"')

user = input("Masukkan sebuah string: ")
def cek_alfabet(string):
    alfabet = "abcdefghijklmnopqrstuvwxyz"

    # Mengiterasi melalui setiap huruf dalam 'alfabet'.
    for huruf in alfabet:
        # Pemeriksaan apakah 'huruf' saat ini tidak ada dalam 'string' input.
        if huruf not in string:
            # Jika ada setidaknya satu huruf yang tidak ada dalam 'string'
            # maka fungsi akan mengembalikan False (string tidak mengandung seluruh alfabet)
            return False
    # fungsi mengembalikan True jika string terdapat seluruh huruf alfabet
    return True

print(cek_alfabet(user))

celsius = int(input("Masukkan suhu dalam Celcius: "))

def celsius_to_fahrenheit(celsius):
    fahrenheit = celsius * 9/5 + 32 # (1 °C × 9/5) + 32 = 33.8 °F
    return fahrenheit

def celsius_to_kelvin(celsius):
    kelvin = celsius + 273.15 # 1 °C + 273,15 = 274.15 K
    return kelvin

def celsius_to_reamur(celsius):
    reamur = celsius * 4/5 # (1 °C) × 4/5 = 0.8°R
    return reamur

fahrenheit = celsius_to_fahrenheit(celsius)
kelvin = celsius_to_kelvin(celsius)
reamur = celsius_to_reamur(celsius)

print(f'''
{celsius}°C = {fahrenheit}°F
{celsius}°C = {kelvin} K
{celsius}°C = {reamur}°R
''')

angka = int(input("Masukkan angka: "))

def cek_ganjil_genap(angka):
    if angka % 2 == 1:
        return "ganjil"
    else:
        return "genap"

# Fungsi 'cek_prima' menerima satu parameter 'angka', yang merupakan bilangan bulat.
def cek_prima(angka):
    if angka < 2:
        # Jika 'angka' kurang dari 2, maka langsung mengembalikan string "bukan prima",
        # karena bilangan kurang dari 2 secara konvensi dianggap bukan bilangan prima.
        return "bukan prima"

    # Iterasi melalui semua angka dari 2 hingga 'angka - 1' untuk memeriksa apakah 'angka' dapat dibagi oleh angka-angka tersebut.
    for i in range(2, angka):
        if angka % i == 0:
            # Jika 'angka' dapat dibagi oleh 'i' tanpa sisa, maka langsung mengembalikan string "bukan prima",
            # karena telah ditemukan pembagi selain 1 dan dirinya sendiri.
            return "bukan prima"

    # angka = tidak dapat dibagi oleh angka lainnya selain 1 dan dirinya sendiri,
    # angka = prima, fungsi mengembalikan string "prima".
    return "prima"

tipe_angka = cek_ganjil_genap(angka)
status_prima = cek_prima(angka)

print(f"Angka {angka} adalah bilangan {tipe_angka}.")
print(f"{angka} juga adalah bilangan {tipe_angka} {status_prima}.")

print('Kalkulator Sederhana')
num1 = int(input('Masukkan angka pertama: '))
num2 = int(input('Masukkan angka kedua: '))

print('''Pilih operasi:
1. Penjumlahan
2. Pengurangan
3. Perkalian
4. Pembagian
5. Pangkat
6. Keluar''')

opsi = int(input('Pilihan (1/2/3/4/5/6): '))

def penjumlahan(x, y):
    total = x + y
    return total

def pengurangan(x, y):
    total = x - y
    return total

def perkalian(x, y):
    total = x * y
    return total

def pembagian(x, y):
    if y != 0:
        total = x / y
        return total
    else:
        return "Pembagian oleh nol tidak valid"

def pangkat(x, y):
    total = x ** y
    return total

if opsi == 1:
    print(f'Hasil penjumlahan dari {num1} dan {num2} adalah {penjumlahan(num1, num2)}')
elif opsi == 2:
    print(f'Hasil pengurangan dari {num1} dan {num2} adalah {pengurangan(num1, num2)}')
elif opsi == 3:
    print(f'Hasil perkalian dari {num1} dan {num2} adalah {perkalian(num1, num2)}')
elif opsi == 4:
    print(f'Hasil pembagian dari {num1} dan {num2} adalah {pembagian(num1, num2)}')
elif opsi == 5:
    print(f'Hasil dari {num1} pangkat {num2} adalah {pangkat(num1, num2)}')
elif opsi == 6:
    print('Terima Kasih')
else:
    print("Opsi tidak ditemukan")