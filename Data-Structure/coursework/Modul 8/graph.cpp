#include <iostream>
#include <fstream>
#include <map>
#include <list>
#include <queue>
#include <vector>
#include <climits>
#include <string>

using namespace std;

class Graph {
public:
    map<int, list<pair<int, int>>> adjList;

    void tambahTepi(int u, int v, int berat) {
        adjList[u].push_back(make_pair(v, berat));
        adjList[v].push_back(make_pair(u, berat)); // Jika graf tidak berarah
    }

    void tampilkanGraf() {
        for (auto const& pasangan : adjList) {
            cout << pasangan.first << " -> ";
            for (auto const& nilai : pasangan.second) {
                cout << "(" << nilai.first << ", " << nilai.second << ") ";
            }
            cout << endl;
        }
    }

    void generateDotFile(const string &filename) {
        ofstream file;
        file.open(filename);
        if (!file) {
            cerr << "Error: Tidak dapat membuka file " << filename << endl;
            return;
        }
        file << "graph G {\n";
        map<pair<int, int>, bool> dikunjungi;
        for (auto const& pasangan : adjList) {
            for (auto const& nilai : pasangan.second) {
                if (!dikunjungi[{pasangan.first, nilai.first}] && !dikunjungi[{nilai.first, pasangan.first}]) {
                    file << "    " << pasangan.first << " -- " << nilai.first << " [label=" << nilai.second << "];\n";
                    dikunjungi[{pasangan.first, nilai.first}] = true;
                }
            }
        }
        file << "}\n";
        file.close();
        if (!file.good()) {
            cerr << "Error: Gagal menulis ke file " << filename << endl;
        }
    }

    void dijkstra(int mulai, int tujuan) {
        map<int, int> jarak;
        map<int, int> sebelumnya;
        for (auto const& pasangan : adjList) {
            jarak[pasangan.first] = INT_MAX;
            sebelumnya[pasangan.first] = -1;
        }
        jarak[mulai] = 0;

        auto compare = [&jarak](int kiri, int kanan) {
            return jarak[kiri] > jarak[kanan];
        };
        priority_queue<int, vector<int>, decltype(compare)> pq(compare);
        pq.push(mulai);

        while (!pq.empty()) {
            int saatIni = pq.top();
            pq.pop();

            for (auto const& tetangga : adjList[saatIni]) {
                int nodeTetangga = tetangga.first;
                int berat = tetangga.second;
                int jarakBaru = jarak[saatIni] + berat;

                if (jarakBaru < jarak[nodeTetangga]) {
                    jarak[nodeTetangga] = jarakBaru;
                    sebelumnya[nodeTetangga] = saatIni;
                    pq.push(nodeTetangga);
                    cout << "Node yang dikunjungi " << nodeTetangga << " dengan bobot " << jarakBaru << endl;
                }
            }
        }

        if (jarak[tujuan] == INT_MAX) {
            cout << "Tidak ada jalur dari " << mulai << " ke " << tujuan << "." << endl;
        } else {
            cout << "Jalur terpendek dari " << mulai << " ke " << tujuan << " adalah " << jarak[tujuan] << " dengan jalur: ";
            vector<int> jalur;
            for (int at = tujuan; at != -1; at = sebelumnya[at]) {
                jalur.push_back(at);
            }
            for (auto it = jalur.rbegin(); it != jalur.rend(); ++it) {
                cout << *it << " ";
            }
            cout << endl;
        }
    }

    vector<Graph> konversiKeForestTree() {
        vector<Graph> hutan;
        map<int, bool> dikunjungi;
        for (auto const& pasangan : adjList) {
            int node = pasangan.first;
            if (!dikunjungi[node]) {
                Graph pohon;
                dfs(node, pohon, dikunjungi);
                hutan.push_back(pohon);
            }
        }
        return hutan;
    }

private:
    void dfs(int node, Graph& pohon, map<int, bool>& dikunjungi) {
        dikunjungi[node] = true;
        for (const auto& tetangga : adjList[node]) {
            int nodeTetangga = tetangga.first;
            int berat = tetangga.second;
            if (!dikunjungi[nodeTetangga]) {
                pohon.tambahTepi(node, nodeTetangga, berat);
                dfs(nodeTetangga, pohon, dikunjungi);
            }
        }
    }
};

int main() {
    Graph g;
    g.tambahTepi(0, 1, 4);
    g.tambahTepi(0, 4, 1);
    g.tambahTepi(1, 2, 2);
    g.tambahTepi(1, 3, 5);
    g.tambahTepi(1, 4, 3);
    g.tambahTepi(2, 3, 1);
    g.tambahTepi(3, 4, 2);
    
    g.dijkstra(0, 3);

    vector<Graph> hutan = g.konversiKeForestTree();

    cout << "\nForest Tree setelah konversi:" << endl;
    for (int i = 0; i < hutan.size(); ++i) {
        cout << "Forest Tree " << i + 1 << ":" << endl;
        hutan[i].tampilkanGraf();
        cout << endl;
    }
    g.generateDotFile("graph.dot");

    cout << "DOT file 'graph.dot' berhasil dibuat. Gunakan Graphviz untuk memvisualisasikannya." << endl;
    return 0;
}