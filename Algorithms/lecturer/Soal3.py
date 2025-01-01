# dok1 = input("Masukkan dokumen 1: ")
# dok2 = input("Masukkan dokumen 2: ")
# Q = input("Masukkan Query: ")

dok1 = "Saya anak sehat, suka makan sayuran"
dok2 = "Anak pintar semangat belajar dan makan makanan sehat"
Q = "makan sehat"

def hitungQuery(dok, Q):
    kata = dok.split() # Split the document into words
    kemiripan = 0
    for i in kata:
        if i == Q:
            kemiripan += 1
    return kemiripan

D1 = hitungQuery(dok1, Q)
D2 = hitungQuery(dok2, Q)

if D1 > D2:
    print("dok1 paling dekat dengan Query")
elif D1 < D2:
    print("dok2 paling dekat dengan Query")
else:
    print("Kedua dok memiliki kemiripan yang sama dengan Q")