#ifndef BINARY_H
#define BINARY_H

#include <stdlib.h>
#include <iostream>
#include < QGraphicsView >
#include < qtextstream >
#include < qprocess >

using namespace std;


struct Node {
    int id;
    char* data;
    struct Node* parent;
    struct Node* left;
    struct Node* right;
};

class BinaryTree{
    Node *root;
    public:
    BinaryTree();
    void setRoot(Node *node){
        this->root=node;
    }

    Node* getRoot(){
        return this->root;
    }

    void insertNode(Node *node);
    Node* insertNodeRec(Node *root, Node *node);
    Node* searchNode(Node *node, int key);
    Node* deleteNode(Node *node, int key);
    void printInOrder(Node *node);
    void printPreOrder(Node *node);
    void printPostOrder(Node *node);

    void init(QGraphicsScene* scene, QGraphicsView* view);

};


#endif // BINARY_H
