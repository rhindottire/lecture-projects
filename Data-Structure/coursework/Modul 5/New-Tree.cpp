#include <iostream>
#include <string>
#include <chrono>
#include <cstdlib>
#include <ctime>

using namespace std;
using namespace std::chrono;

// Definisikan struktur Node
struct Node {
    int data;
    Node* left;
    Node* right;
};

// Definisikan ADT Binary Tree
class BinaryTree {
private:
    Node* root;

    Node* insertNodeRec(Node* root, int data) {
        if (root == nullptr) {
            root = new Node;
            root->data = data;
            root->left = root->right = nullptr;
        } else if (data < root->data) {
            root->left = insertNodeRec(root->left, data);
        } else {
            root->right = insertNodeRec(root->right, data);
        }
        return root;
    }

    bool searchNodeRec(Node* node, int value) {
        if (node == nullptr) {
            return false;
        }

        if (node->data == value) {
            return true;
        } else if (value < node->data) {
            return searchNodeRec(node->left, value);
        } else {
            return searchNodeRec(node->right, value);
        }
    }

    void printInOrderRec(Node* root) {
        if (root != nullptr) {
            printInOrderRec(root->left);
            cout << root->data << " ";
            printInOrderRec(root->right);
        }
    }

    Node* deleteNode(Node* root, int data) {
        if (root == nullptr) {
            return root;
        }
        if (data < root->data) {
            root->left = deleteNode(root->left, data);
            return root;
        } else if (data > root->data) {
            root->right = deleteNode(root->right, data);
            return root;
        } else {
            if (root->left == nullptr && root->right == nullptr) {
                cout<<root->data<<" telah di hapus"<<endl;
                delete root;
                return nullptr;
            } else if (root->left == nullptr){
                Node* temp = root->right;
                cout<<root->data<<" telah di hapus"<<endl;
                delete root;
                return temp;
            } else if (root->right == nullptr) {
                Node* temp = root->left;
                cout<<root->data<<" telah di hapus"<<endl;
                delete root;
                return temp;
            } else {
                Node* temp = root->right;
                while (temp->left != nullptr){
                    temp = temp->left;
                }
                int swap = root->data;
                root->data = temp->data;
                temp->data = swap;
                root->right = deleteNode(root->right, temp->data);
            }
        }
        return root;
    }

public:
    BinaryTree() {
        root = nullptr;
    }

    void insertNode(int data) {
        root = insertNodeRec(root, data);
        cout << data << " telah di tambahkan"<<endl;
    }

    void wrapperSearchNode(int key){
            bool temp = searchNodeRec(root, key);
            if (temp) {
                cout<< to_string(key)<<" telah di temukan"<<endl;
            } else {
                cout<< to_string(key)<<" tidak di temukan"<<endl ;
            }
        }

    void printInOrder() {
        cout<<"in order { ";
        printInOrderRec(root);
        cout<<" }" << endl;
    }

    void wrapperDelNode(int key){
        root = deleteNode(root, key);
    }
};

int main() {
    BinaryTree tree;

    tree.insertNode(17);
    tree.insertNode(11);
    tree.insertNode(20);
    tree.insertNode(04);

    tree.printInOrder();

    tree.wrapperDelNode(11);

    tree.printInOrder();

    tree.wrapperSearchNode(20);
    tree.wrapperSearchNode(500);

    // seed random = menghasilkan urutan angka acak yang berbeda setiap kali program dijalankan.
    srand(time(0));

    // Mendefinisikan ukuran array sebesar 10.000 elemen
    const int size = 10000;
    // Menghasilkan nilai pencarian acak antara 9000 dan 10000
    const int SEARCH_VALUE = (rand() % (size - 9000 + 1)) + 9000;
    int arrayitem[size];
    BinaryTree Newtree;

    for (int i = 0; i < size; i++) {
        // Menghasilkan nilai acak antara 0 dan 9999
        int data = rand() % size;
        Newtree.insertNode(data);
        arrayitem[i] = data;
    }
    cout << endl;

    // Mengambil waktu saat ini sebelum memulai pencarian node dalam pohon biner
    auto start = high_resolution_clock::now();
    // Mencari node dengan nilai tertentu dalam pohon biner
    Newtree.wrapperSearchNode(SEARCH_VALUE);

    auto end = high_resolution_clock::now();
    auto duration = duration_cast<microseconds>(end - start);
    cout << "Waktu eksekusi binary Tree: " << duration.count() << " mikrosecond" << endl;
    start = high_resolution_clock::now();

    bool found = false;
    for (int i = 0; i < size; i++) {
        if (arrayitem[i] == SEARCH_VALUE) {
            found = true;
            break;
        }
    }

    if (found) {
        cout<<to_string(SEARCH_VALUE) + " telah di temukan"<<endl;
    } else {
        cout<<to_string(SEARCH_VALUE) + " tidak di temukan"<<endl;
    }
    end = high_resolution_clock::now();
    duration = duration_cast<microseconds>(end - start);
    cout << "Waktu eksekusi array: " << duration.count() << " mikrodetik" << endl;
    return 0;
}