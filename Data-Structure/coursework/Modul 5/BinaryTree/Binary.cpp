#include <Binary.h>

Node* createNode(int id, char* data)
{
    Node* temp = new Node;
    temp->id = id;
    temp->data= data;
    temp->parent=NULL;
    temp->left = NULL;
    temp->right = NULL;

    return temp;
}

BinaryTree::BinaryTree(){
    this->root=NULL;
}

void BinaryTree::insertNode(Node* node){
    if(this->root==NULL){
        setRoot(node);
         printf("\n Set Root:%d",root->id);
    }
    else{
        printf("\n Root:%d",root->id);
        char sign;
        Node* suc = root;
        Node* pre = root;
        while(suc!=NULL){
            if(node->id<suc->id){
                pre=suc;
                suc=suc->left;
                sign='l';
            }
            else
            if(node->id>suc->id){
                pre=suc;
                suc=suc->right;
                sign='r';
            }
        }
        suc=node;
        node->parent=pre;
        if(sign=='l'){
            pre->left=node;
        }
        else{
            pre->right=node;
        }
        printf("Data is Set%d:%d",pre->id,suc->id);
    }
}

Node* BinaryTree::insertNodeRec(Node* root, Node* node){
    if(root==NULL){
        return node;
    }
    else{
        if(node->id<root->id){
           root->left=insertNodeRec(root->left,node);
        }
        else if(node->id>root->id){
           root->right=insertNodeRec(root->right,node);
        }
    }

        return root;
}

void BinaryTree::printInOrder(Node* node)
{
    if (node == NULL)
        return;
    else{
    printInOrder(node->left);
    printf("%d,",node->id);
    printInOrder(node->right);
    }
}

void BinaryTree::printPreOrder(Node* node)
{
    if (node == NULL)
        return;

    else{
    printf("%d,",node->id);
    printPreOrder(node->left);
    printPreOrder(node->right);
    }
}

void BinaryTree::printPostOrder(Node* node)
{
    if (node == NULL)
        return;

    else{
    printPreOrder(node->left);
    printPreOrder(node->right);
    printf("%d,",node->id);
    }
}

Node* BinaryTree::deleteNode(Node* root, int key)
{
    // Base case
    if (root == NULL)
        return root;

    // If the key to be deleted is smaller than the root's key,
    // then it lies in the left subtree
    if (key < root->id) {
        root->left = deleteNode(root->left, key);
        return root;
    }
    // If the key to be deleted is greater than the root's key,
    // then it lies in the right subtree
    else if (key > root->id) {
        root->right = deleteNode(root->right, key);
        return root;
    }

    if (root->left == NULL) {
        Node* temp = root->right;
        delete root;
        return temp;
    }
    else if (root->right == NULL) {
        Node* temp = root->left;
        delete root;
        return temp;
    }

    // Node with two children: Get the inorder successor (smallest
    // in the right subtree)
    Node* succParent = root;
    Node* succ = root->right;
    while (succ->left != NULL) {
        succParent = succ;
        succ = succ->left;
    }

    // Copy the inorder successor's content to this node
    root->id = succ->id;

    // Delete the inorder successor
    if (succParent->left == succ)
        succParent->left = succ->right;
    else
        succParent->right = succ->right;

    delete succ;
    return root;
}

// kenapa di binary tree node baru (3)  dicarikan tempat yang baru supaya bisa di tambahkan,
// kenapa node left yg 2 tdk di geser saja?
// jadi dari parent 5 dan left rightnya itu adalah left 4 right 6?
// jadi pada saat deleted node itu tidak perlu banyak kondisi