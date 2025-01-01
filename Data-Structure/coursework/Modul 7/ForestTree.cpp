#include <iostream>
#include <list>
#include <vector>
#include <queue>
#include <string>
#include <algorithm>
using namespace std;

struct TreeNode {
    string data;
    TreeNode* parent;
    list<TreeNode*> children;
    bool isRoot;
};

TreeNode* createNode(string key) {
    TreeNode* temp = new TreeNode;
    temp->data = key;
    temp->parent = nullptr;
    temp->children.clear();
    temp->isRoot = true;
    return temp;
}

class ForestTree {
private:
    vector<TreeNode*> forest;

public:
    ForestTree() {
        this->forest.clear();
    }

    void setForestTree(const string& parent, TreeNode* tree) {
        TreeNode* temp = isFound(parent);
        if (temp == nullptr) {
            this->forest.push_back(tree);
        } else {
            temp->children.push_back(tree);
            tree->parent = temp;
            tree->isRoot = false;
        }
    }

    TreeNode* isFound(const string& key) {
        for (TreeNode* t : forest) {
            TreeNode* result = findNode(t, key);
            if (result != nullptr)
                return result;
        }
        return nullptr;
    }

    TreeNode* findNode(TreeNode* root, const string& key) {
        if (root == nullptr) return nullptr;
        if (root->data == key) return root;
        for (TreeNode* child : root->children) {
            TreeNode* result = findNode(child, key);
            if (result != nullptr) return result;
        }
        return nullptr;
    }

    void preOrder(TreeNode* root, list<TreeNode*>& dfsList) {
        if (root == nullptr) return;
        dfsList.push_back(root); // preorder
        for (TreeNode* child : root->children) {
            preOrder(child, dfsList);
        }
    }

    void postOrder(TreeNode* root, list<TreeNode*>& dfsList) {
        if (root == nullptr) return;
        for (TreeNode* child : root->children) {
            postOrder(child, dfsList);
        }
        dfsList.push_back(root); // postorder
    }

    void bfsIteratif(TreeNode* root, list<TreeNode*>& bfsList) {
        if (root == nullptr) return;
        queue<TreeNode*> q;
        q.push(root);
        while (!q.empty()) {
            TreeNode* node = q.front();
            q.pop();
            bfsList.push_back(node);
            for (TreeNode* child : node->children) {
                q.push(child);
            }
        }
    }

    list<TreeNode*> getDFSPreOrderList() {
        list<TreeNode*> dfsList;
        for (TreeNode* root : forest) {
            preOrder(root, dfsList);
        }
        return dfsList;
    }

    list<TreeNode*> getDFSPostOrderList() {
        list<TreeNode*> dfsList;
        for (TreeNode* root : forest) {
            postOrder(root, dfsList);
        }
        return dfsList;
    }

    list<TreeNode*> getBFSList() {
        list<TreeNode*> bfsList;
        for (TreeNode* root : forest) {
            bfsIteratif(root, bfsList);
        }
        return bfsList;
    }

    void deleteNode(const string& key) {
        TreeNode* nodeToDelete = isFound(key);
        if (nodeToDelete == nullptr) {
            cout << "Node not found" << endl;
            return;
        }
        if (nodeToDelete->isRoot) {
            auto it = find(forest.begin(), forest.end(), nodeToDelete);
            if (it != forest.end()) {
                forest.erase(it);
            }
        } else {
            TreeNode* parent = nodeToDelete->parent;
            if (parent) {
                parent->children.remove(nodeToDelete);
            }
        }
        cout << "Menghapus node: " << nodeToDelete->data << endl;
        deleteSubTree(nodeToDelete);
    }

    void deleteSubTree(TreeNode* node) {
        if (node == nullptr) return;
        for (TreeNode* child : node->children) {
            deleteSubTree(child);
        }
        delete node;
    }
};

int main() {
    ForestTree forestTree;

    while (true) {
        string parent, data;
        cout << "Masukkan parent (atau kosong untuk node root): ";
        getline(cin, parent);
        cout << "Masukkan data node: ";
        getline(cin, data);
        TreeNode* newNode = createNode(data);
        forestTree.setForestTree(parent, newNode);

        char lanjut;
        cout << "Apakah ingin menambah node lagi? (y/n): ";
        cin >> lanjut;
        cin.ignore(); // untuk membersihkan newline karakter dari buffer
        if (lanjut == 'n' || lanjut == 'N') {
            break;
        }
    }

    // Tampilkan tree dengan DFS PreOrder
    list<TreeNode*> dfsPreOrderList = forestTree.getDFSPreOrderList();
    cout << "DFS PreOrder: ";
    for (TreeNode* node : dfsPreOrderList) {
        cout << node->data << " ";
    }
    cout << endl;

    // Tampilkan tree dengan DFS PostOrder
    list<TreeNode*> dfsPostOrderList = forestTree.getDFSPostOrderList();
    cout << "DFS PostOrder: ";
    for (TreeNode* node : dfsPostOrderList) {
        cout << node->data << " ";
    }
    cout << endl;

    // Tampilkan tree dengan BFS
    list<TreeNode*> bfsList = forestTree.getBFSList();
    cout << "BFS: ";
    for (TreeNode* node : bfsList) {
        cout << node->data << " ";
    }
    cout << endl;

    // Penghapusan node
    while (true) {
        string key;
        cout << "Masukkan node yang ingin dihapus: ";
        getline(cin, key);

        forestTree.deleteNode(key);

        // Tampilkan tree setelah penghapusan dengan DFS PreOrder
        dfsPreOrderList = forestTree.getDFSPreOrderList();
        cout << "DFS PreOrder setelah penghapusan: ";
        for (TreeNode* node : dfsPreOrderList) {
            cout << node->data << " ";
        }
        cout << endl;

        char lanjut;
        cout << "Apakah ingin menghapus node lagi? (y/n): ";
        cin >> lanjut;
        cin.ignore(); // untuk membersihkan newline karakter dari buffer
        if (lanjut == 'n' || lanjut == 'N') {
            break;
        }
    }
    return 0;
}