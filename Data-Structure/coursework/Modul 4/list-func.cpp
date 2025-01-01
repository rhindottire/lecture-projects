#include <iostream>

using namespace std;

struct Node {
    int data;
    Node* next;
};

Node* head = nullptr; // Inisialisasi linked list

void insertSorted(int newData) {
    Node* newNode = new Node;
    newNode->data = newData;
    newNode->next = nullptr;

    if (head == nullptr || head->data >= newData) {
        newNode->next = head;
        head = newNode;
    } else {
        Node* current = head;
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

void SearchDeleted(int Data) {
    Node* current = head;
    Node* prev = nullptr;

    while (current != nullptr && current->data != Data) {
        prev = current;
        current = current->next;
    }

    if (current == nullptr) {
        std::cout << "Data " << Data << " not found in the list.\n";
        return;
    }

    if (prev == nullptr) {
        head = current->next;
    } else {
        prev->next = current->next;
    }

    delete current;
    std::cout << "Data " << Data << " deleted successfully.\n";
}

int main() {
    insertSorted(9);
    insertSorted(2);
    insertSorted(4);
    insertSorted(6);
    insertSorted(3);
    insertSorted(8);
    insertSorted(5);
    insertSorted(7);
    insertSorted(1);

    std::cout << "Linked List: ";
    displayList();

    int Data;
    cout << "Enter the numbers you want to delete: ";
    cin >> Data;
    SearchDeleted(Data);
    std::cout << "Linked List after deletion: ";
    displayList();

    return 0;
}