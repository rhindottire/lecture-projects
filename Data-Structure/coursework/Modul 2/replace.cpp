#include <iostream>
#include <string>
using namespace std;

void replace(char* c, std::string text) {
    // Fungsi untuk mengganti karakter pada pointer c
    // dengan karakter 'M' pada index pertama dan 'i' pada index kedua
    *c = 'M';
    *(c+1) = 'i';
}

int main() {
    string teks = "Hello World";

    // Mendapatkan pointer ke karakter pertama dari string teks
    char* c = &teks.at(0);

    replace(c, teks);

    cout<<"print:"<<teks<<endl;

    return 0;
}