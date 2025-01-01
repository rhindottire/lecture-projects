#include <iostream>
#include <vector>
#include <algorithm>
#include <ctime>
#include <cstdlib>

void quickSort(std::vector<int>& data, int left, int right) {
    if (left >= right) return;

    // Memilih pivot sebagai elemen tengah dari subarray.
    int pivot = data[(left + right) / 2];
    int i = left, j = right;

    while (i <= j) {
        // Mencari elemen di kiri pivot yang lebih besar atau sama dengan pivot.
        while (data[i] < pivot) i++;
        // Mencari elemen di kanan pivot yang lebih kecil atau sama dengan pivot.
        while (data[j] > pivot) j--;

        // Menukar elemen-elemen yang ditemukan dan memperbarui indeks.
        if (i <= j) {
            std::swap(data[i], data[j]);
            i++;
            j--;
        }
    }
    // Memanggil quickSort secara rekursif pada subarray kiri dan kanan.
    quickSort(data, left, j);
    quickSort(data, i, right);
}

// Fungsi untuk mengukur waktu eksekusi QuickSort
void testQuickSort(const std::vector<int>& input) {
    std::vector<int> data = input;
    clock_t start = clock();
    quickSort(data, 0, data.size() - 1);
    clock_t end = clock();
    std::cout << "Waktu QuickSort: " << double(end - start) / CLOCKS_PER_SEC << " detik\n";
}

// Struktur Node untuk AVL Tree
struct AVLNode {
    int key;
    AVLNode* left = nullptr;
    AVLNode* right = nullptr;
    int height = 1;
};

// Fungsi untuk mendapatkan tinggi node
int height(AVLNode* node) {
    return node ? node->height : 0;
}

// Fungsi untuk membuat node baru
AVLNode* newNode(int key) {
    return new AVLNode{key};
}

// Fungsi rotasi kanan
AVLNode* rightRotate(AVLNode* y) {
    AVLNode* x = y->left;
    y->left = x->right;
    x->right = y;
    y->height = std::max(height(y->left), height(y->right)) + 1;
    x->height = std::max(height(x->left), height(x->right)) + 1;
    return x;
}

// Fungsi rotasi kiri
AVLNode* leftRotate(AVLNode* x) {
    AVLNode* y = x->right;
    x->right = y->left;
    y->left = x;
    x->height = std::max(height(x->left), height(x->right)) + 1;
    y->height = std::max(height(y->left), height(y->right)) + 1;
    return y;
}

// Fungsi untuk mendapatkan faktor keseimbangan node
int getBalance(AVLNode* node) {
    return node ? height(node->left) - height(node->right) : 0;
    // Jika node tidak null, hitung dan kembalikan faktor keseimbangan (balance factor)
    if (node) {
        // Faktor keseimbangan dihitung sebagai selisih antara tinggi subtree kiri dan tinggi subtree kanan
        return height(node->left) - height(node->right);
    } else {
        return 0;
    }
}

// Fungsi untuk menyisipkan kunci ke AVL Tree
AVLNode* insert(AVLNode* node, int key) {
    if (!node) return newNode(key);

    if (key < node->key)
        node->left = insert(node->left, key);
    else if (key > node->key)
        node->right = insert(node->right, key);
    else
        return node;

    node->height = 1 + std::max(height(node->left), height(node->right));
    int balance = getBalance(node);

    // Rotasi untuk menjaga keseimbangan AVL Tree
    if (balance > 1 && key < node->left->key)
        return rightRotate(node);
    if (balance < -1 && key > node->right->key)
        return leftRotate(node);
    if (balance > 1 && key > node->left->key) {
        node->left = leftRotate(node->left);
        return rightRotate(node);
    }
    if (balance < -1 && key < node->right->key) {
        node->right = rightRotate(node->right);
        return leftRotate(node);
    }
    return node;
}

// Fungsi untuk traversal in-order AVL Tree
void inOrder(AVLNode* root) {
    if (root) {
        inOrder(root->left);
        std::cout << root->key << " ";
        inOrder(root->right);
    }
}

// Fungsi untuk mengukur waktu eksekusi penyisipan AVL Tree
void testAVLTree(const std::vector<int>& input) {
    AVLNode* root = nullptr;
    clock_t start = clock();
    for (int key : input) {
        root = insert(root, key);
    }
    clock_t end = clock();
    std::cout << "Waktu penyisipan AVL Tree: " << double(end - start) / CLOCKS_PER_SEC << " detik\n";
}

// Fungsi untuk menghasilkan vector bilangan acak
std::vector<int> generateRandomData(int size) {
    std::vector<int> data(size);
    for (int& num : data) {
        num = rand() % 10000;
    }
    return data;
}

// Fungsi utama untuk menguji QuickSort dan AVL Tree
int main() {
    srand(time(0));
    std::vector<int> sizes;
    
    std::cout << "Masukkan jumlah elemen yang ingin diuji (pisahkan dengan spasi, akhiri dengan enter): ";
    int size;
    while (std::cin >> size) {
        sizes.push_back(size);
        if (std::cin.peek() == '\n') break;
    }

    for (int size : sizes) {
        std::cout << "Menguji QuickSort dan AVLTree dengan " << size << " elemen:\n";
        std::vector<int> data = generateRandomData(size);
        testQuickSort(data);
        testAVLTree(data);
        std::cout << "\n";
    }
    return 0;
}