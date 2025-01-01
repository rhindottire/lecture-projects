#include "Binary.h"
#include "Binary.cpp"
#include <iostream>

using namespace std;

int main()
{
    cout << "Hello Binary Tree!" << endl;

    Node *node = createNode(5,"Lima");
    BinaryTree bt;
    bt.insertNode(node);
    node=createNode(2,"Dua");
    bt.insertNode(node);
    node=createNode(7,"Tujuh");
    bt.insertNode(node);
    node=createNode(1,"Satu");
    bt.insertNode(node);
    node=createNode(4,"Empat");
    bt.insertNode(node);
    node=createNode(8,"Delapan");
    bt.insertNode(node);
    node=createNode(6,"Enam");
    bt.insertNode(node);

    printf("\n Inorder:");
    bt.printInOrder(bt.getRoot());
    printf("\n Preorder:");
    bt.printPreOrder(bt.getRoot());
    printf("\n Postorder:");
    bt.printPostOrder(bt.getRoot());

    printf("\n Recursive:");
    node=createNode(10,"Sepuluh");
    bt.insertNodeRec(bt.getRoot(),node);
    node=createNode(9,"Sembilan");
    bt.insertNodeRec(bt.getRoot(),node);


    printf("\n Inorder:");
    bt.printInOrder(bt.getRoot());
    printf("\n Preorder:");
    bt.printPreOrder(bt.getRoot());
    printf("\n Postorder:");
    bt.printPostOrder(bt.getRoot());
    bt.deleteNode(bt.getRoot(),1);
    bt.deleteNode(bt.getRoot(),10);
    printf("\n Inorder:");
    bt.printInOrder(bt.getRoot());



    return 0;
}
