def segitiga_jam_pasir(tinggi):
    for i in range(tinggi):
        for j in range(tinggi - i -1):
            print(" ", end="")
        for k in range(i + 1):
            if k == 0 or k == i or i == tinggi :
                print("*", end=" ")
            else:
                print(" ", end=" ")
        print()

    for i in range(tinggi - 1, 0, -1):
        for j in range(tinggi - i):
            print(" ", end="")
        for k in range(1, i * 2):
            print("*", end="")
        print()

tinggi = int(input("Masukkan tinggi segitiga jam pasir: "))
segitiga_jam_pasir(tinggi)