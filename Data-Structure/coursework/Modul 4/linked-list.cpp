#include <iostream>
#include <string>
using namespace std;

struct Node {
    int data;
    Node* next;
};

Node* head = nullptr; // Inisialisasi linked list

// Fungsi untuk menyisipkan data baru secara terurut dalam linked list
void insertSorted(int newData) {
    Node* newNode = new Node;
    newNode->data = newData;
    newNode->next = nullptr;

    // Jika linked list kosong atau data baru lebih kecil atau sama dengan data pada node pertama
    if (head == nullptr || head->data >= newData) {
        newNode->next = head;
        head = newNode;
    } else {
        Node* current = head;
        // Melakukan iterasi melalui linked list sampai mencapai node terakhir untuk menyisipkan data baru
        while (current->next != nullptr && current->next->data < newData) {
            current = current->next;
        }
        newNode->next = current->next;
        current->next = newNode;
    }
}

void displayList() {
    Node* current = head;
    while (current != nullptr) {
        std::cout << current->data << " ";
        current = current->next;
    }
    std::cout << std::endl;
}

int main() {
    string A;
    while (true) {
        cout << "Masukkan angka: ";
        cin >> A;
        insertSorted(stoi(A));
        cout << A << " Berhasil di tambahkan. " << endl;
        cout << "Apakah ingin menambahkan angka lagi? (Yes/No): ";
        cin >> A;
        if (A != "Yes") { 
            break;
        }
    }
    std::cout << "Linked List: ";
    displayList();
    return 0;
}