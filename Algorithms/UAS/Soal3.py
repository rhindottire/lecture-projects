huruf = "ABCDEFGHIJKLMNOPQRSTUVWXYZ"
size = int(input("Masukkan ukuran : "))
pe = 1

if size > 13:
    print("Ukuran abnormal!")
else:
    print(" "*(size-1) + "A")
    for i in range(size-2):
        print(" "*(size-i-2) + "A" + " "*pe + "B")
        pe += 2
    for i in range((size*2)-1):
        print(huruf[i],end="")