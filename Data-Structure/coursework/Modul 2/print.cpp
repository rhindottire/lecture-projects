#include <iostream>
// Mengimpor pustaka iostream untuk fungsi input-output.
using namespace std;
// Menggunakan namespace std untuk menggunakan objek dan fungsi standar.

void replace(string r) {
    r = "bello";
}

int main() {
    string teks = "Hello World";

    replace(teks);
    // Memanggil fungsi replace untuk mengganti nilai text

    cout << "print: " << teks << endl;

    return 0;
    // Mengembalikan nilai 0 sebagai tanda bahwa program selesai dijalankan dengan sukses.
}