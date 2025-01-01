def hitung_vokal_konsonan(string):
    vokal = "aeiouAEIOU"
    konsonan = "bcdfghjklmnpqrstvwxyzBCDFGHJKLMNPQRSTVWXYZ"

    jumlah_vokal = 0
    jumlah_konsonan = 0
    
    for i in string:
        if i in vokal:
            jumlah_vokal += 1
        elif i in konsonan:
            jumlah_konsonan += 1
    return jumlah_vokal, jumlah_konsonan

input_string = input("Masukkan sebuah string: ")
vokal, konsonan = hitung_vokal_konsonan(input_string)

print("Jumlah huruf vokal:", vokal)
print("Jumlah huruf konsonan:", konsonan)
