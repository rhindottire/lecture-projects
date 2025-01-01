NIM = int(input("Input NIM : "))
def kalikanNIM(NIM):
    NIM_str = str(NIM)
    hasil = 1
    for digit in NIM_str:
        if digit == '0':
            digit = '9'
        hasil *= int(digit) 
    return hasil
# def kalikanNIM(NIM):
#     hasil = 1
#     for digit in str(NIM):
#         hasil *= int(digit.replace('0', '9'))
#     return hasil

hasil = kalikanNIM(NIM)
print(f"Hasil perkalian dari nim {NIM} adalah {hasil}")