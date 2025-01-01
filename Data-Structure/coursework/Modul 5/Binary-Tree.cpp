#include <iostream>
#include <string>

using namespace std;

struct Node {
    int data;
    Node* left;
    Node* right;
};

class BinaryTree {
private:
    Node* root;
    string printString;

    Node* InsertNodeRec(Node* root, int data) {
        if (root == nullptr) {
            root = new Node;
            root->data = data;
            root->left = root->right = nullptr;
        } else if (data < root->data) {
            root->left = InsertNodeRec(root->left, data);
        } else {
            root->right = InsertNodeRec(root->right, data);
        }
        return root;
    }

    void PrintNodeRec(Node* root) {
        if (root != nullptr) {
            PrintNodeRec(root->left);
            printString += to_string(root->data) + " ";
            PrintNodeRec(root->right);
        }
    }

    Node* searchNode(Node* root, int key) {
        if (root == nullptr || root->data == key) {
            return root;
        } else if (key < root->data) {
            return searchNode(root->left, key);
        } else {
            return searchNode(root->right, key);
        }
    }

    Node* deleteNode(Node* root, int key) {
        if (root == nullptr) {
            return root;
        }
        if (key < root->data) {
            root->left = deleteNode(root->left, key);
        } else if (key > root->data) {
            root->right = deleteNode(root->right, key);
        } else {
            if (root->left == nullptr && root->right == nullptr) {
                delete root;
                return nullptr;
            } else if (root->left == nullptr) {
                Node* temp = root->right;
                delete root;
                return temp;
            } else if (root->right == nullptr) {
                Node* temp = root->left;
                delete root;
                return temp;
            } else {
                Node* temp = root->right;
                while (temp && temp->left != nullptr) {
                    temp = temp->left;
                }
                root->data = temp->data;
                root->right = deleteNode(root->right, temp->data);
            }
        }
        return root;
    }

public:
    BinaryTree() {
        root = nullptr;
    }

    void InsertNode(int data) {
        root = InsertNodeRec(root, data);
    }

    string PrintNode() {
        printString = "";
        PrintNodeRec(root);
        return "{ " + printString + "}";
    }

    string SearchNode(int key) {
        Node* temp = searchNode(root, key);
        if (temp != nullptr && temp->data == key) {
            return to_string(key) + " ditemukan";
        } else {
            return to_string(key) + " tidak ditemukan";
        }
    }
    void DeleteNode(int key) {
        root = deleteNode(root, key);
    }
};

int main() {
    BinaryTree tree;
    tree.InsertNode(1);
    tree.InsertNode(7);
    tree.InsertNode(2);
    tree.InsertNode(4);
    tree.InsertNode(0);

    cout << tree.PrintNode() << endl;

    cout << tree.SearchNode(2) << endl;
    cout << tree.SearchNode(10) << endl;

    tree.DeleteNode(4);
    cout << tree.PrintNode() << endl;

    return 0;
}