#include <iostream>
#include <string>

using namespace std;

struct Node {
    int id;
    string data;
    Node* next;
};

Node* createNode(int id, string data) {
    Node* temp = new Node();
    temp->id = id;
    temp->data = data;
    temp->next = nullptr;

    return temp;
}

class Queue {
private:
    Node* front;
    Node* rear;

public:
    Queue() {
        front = nullptr;
        rear = nullptr;
    }

    void enqueue(int id, string data) {
        Node* newNode = createNode(id, data);
        if (rear == nullptr) {
            front = newNode;
            rear = newNode;
        } else {
            rear->next = newNode;
            rear = newNode;
        }
        cout << "Data " << data << " berhasil ditambahkan ke antrian.\n";
    }

    void dequeue() {
        if (front == nullptr) {
            cout << "Antrian kosong, tidak dapat menghapus elemen.\n";
        } else {
            Node* temp = front;
            front = front->next;
            delete temp;
            cout << "Elemen pertama dari antrian dihapus.\n";
        }
    }

    void display() {
        if (front == nullptr) {
            cout << "Antrian kosong.\n";
        } else {
            cout << "Isi antrian:\n";
            Node* current = front;
            while (current != nullptr) {
                cout << "ID: " << current->id << " Data: " << current->data << endl;
                current = current->next;
            }
        }
    }
};

int main() {
    Queue q;
    q.enqueue(1, "satu");
    q.enqueue(2, "dua");
    q.enqueue(3, "tiga");
    q.enqueue(4, "empat");
    q.enqueue(5, "lima");

    q.display();

    q.dequeue();
    q.dequeue();

    q.display();

    return 0;
}