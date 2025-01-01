#include <iostream>
#include <string>
using namespace std;

struct Node {
    int id;
    string data;
    Node *next;
    Node *prev;
};

Node *createNode(int id, string data) {
    Node *temp = new Node();
    temp->id = id;
    temp->data = data;
    temp->next = NULL;

    return temp;
}

class linkedlist {
private:
    Node *head;
    Node *tail;

public:
    linkedlist() {
        head = NULL;
        tail = NULL;
    }

    void setHead(Node *node) {
        head = node;
    }

    void setTail(Node *node) {
        tail = node;
    }

    Node *getHead() {
        return head;
    }

    Node *getTail() {
        return tail;
    }

    void addFront(Node *node) {
        if (getHead() == NULL) {
            setHead(node);
            setTail(node);
        }
        else {
            node->next = getHead();
            setHead(node);
        }
    }

    void addRear(Node *node) {
        if (getTail() == NULL) {
            setHead(node);
            setTail(node);
        }
        else {
            getTail()->next = node;
            setTail(node);
        }
    }

    void removeFront() {
        if (getHead() != NULL) {
            if (getHead() == getTail()) {
                setHead(NULL);
                setTail(NULL);
            }
            else {
                Node *temp = getHead();
                setHead(temp->next);
                temp->next = NULL;
            }
        }
    }

    void removeRear() {
        if (getTail() != NULL) {
            if (getHead() == getTail()) {
                setHead(NULL);
                setTail(NULL);
            }
            else {
                Node *current = getHead();
                while (current->next != getTail()) {
                    current = current->next;
                }
                current->next = NULL;
                setTail(current);
            }
        }
    }

    void show() {
        Node *current = getHead();
        while (current != NULL) {
            cout << "ID: " << current->id << " Data: " << current->data << endl;
            current = current->next;
        }
    }
};

int main() {
    linkedlist list;
    Node *node1 = createNode(1, "satu");
    Node *node2 = createNode(2, "dua");
    Node *node3 = createNode(3, "tiga");
    Node *node4 = createNode(4, "empat");

    list.addFront(node1);
    list.addFront(node2);
    list.addRear(node3);
    list.addRear(node4);
    list.addFront(node4);

    list.show();

    cin.get();
    return 0;
}