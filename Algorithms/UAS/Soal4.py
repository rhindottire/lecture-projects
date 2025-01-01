abjad = "ABCDEFGHIJKLMNOPQRSTUVWXYZ"
nilai = int(input("Masukkan jumlah dinamis : "))

if nilai > 13 :
    print("Maaf jumlah dinamis out of range!")
else:
    for a in range(nilai-1, 0, -1):
        for b in range(nilai-a,1,-1):
            print(" ",end="")
        for b in range(a*2+1):
            print(abjad[b],end="")
        print()

    for a in range(nilai):
        for b in range(nilai-a,1,-1):
            print(end=" ")
        for b in range(a*2+1):
            print(abjad[b],end="")
        print()