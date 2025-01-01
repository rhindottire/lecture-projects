#include <iostream>
#include <vector>
#include <unordered_map>
#include <unordered_set>
#include <string>

// Struktur untuk merepresentasikan Transisi
struct Transisi {
    std::string nama;
    std::vector<std::string> tempat_masukan;
    std::vector<std::string> tempat_keluaran;
};

// Struktur untuk merepresentasikan Petri Net
class JaringanPetri {
public:
    void tambahTempat(const std::string& tempat) {
        tempat_tempat.insert(tempat);
    }

    void tambahTransisi(const std::string& nama, const std::vector<std::string>& tempat_masukan, const std::vector<std::string>& tempat_keluaran) {
        transisi.push_back({ nama, tempat_masukan, tempat_keluaran });
    }

    void simulasi(const std::unordered_map<std::string, int>& penanda_awal) {
        std::unordered_map<std::string, int> penanda = penanda_awal;
        std::cout << "Penanda Awal: ";
        cetakPenanda(penanda);

        for (const auto& transisi : transisi) {
            if (apakahAktif(transisi, penanda)) {
                std::cout << "Transisi Berjalan: " << transisi.nama << std::endl;
                jalankanTransisi(transisi, penanda);
                cetakPenanda(penanda);
            } else {
                std::cout << "Transisi " << transisi.nama << " tidak dapat berjalan." << std::endl;
            }
        }
    }

private:
    std::unordered_set<std::string> tempat_tempat;
    std::vector<Transisi> transisi;
    bool apakahAktif(const Transisi& transisi, const std::unordered_map<std::string, int>& penanda) {
        for (const auto& tempat : transisi.tempat_masukan) {
            if (penanda.at(tempat) == 0) {
                return false;
            }
        }
        return true;
    }

    void jalankanTransisi(const Transisi& transisi, std::unordered_map<std::string, int>& penanda) {
        for (const auto& tempat : transisi.tempat_masukan) {
            penanda[tempat]--;
        }
        for (const auto& tempat : transisi.tempat_keluaran) {
            penanda[tempat]++;
        }
    }

    void cetakPenanda(const std::unordered_map<std::string, int>& penanda) {
        std::cout << "{ ";
        for (const auto& [tempat, token] : penanda) {
            std::cout << tempat << ": " << token << " ";
        }
        std::cout << "}" << std::endl;
    }
};

std::vector<std::string> hasilkanLogKegiatan() {
    return { "A", "B", "C", "A", "C", "B", "A", "C" };
}

std::unordered_map<std::string, std::unordered_set<std::string>> analisisKausalitas(const std::vector<std::string>& log_kegiatan) {
    std::unordered_map<std::string, std::unordered_set<std::string>> kausalitas;
    for (size_t i = 0; i < log_kegiatan.size() - 1; ++i) {
        kausalitas[log_kegiatan[i]].insert(log_kegiatan[i + 1]);
    }
    return kausalitas;
}

JaringanPetri bangunJaringanPetri(const std::unordered_map<std::string, std::unordered_set<std::string>>& kausalitas) {
    JaringanPetri jaringan;
    for (const auto& [aktivitas, aktivitas_selanjutnya] : kausalitas) {
        jaringan.tambahTempat(aktivitas);
        for (const auto& selanjutnya : aktivitas_selanjutnya) {
            jaringan.tambahTempat(selanjutnya);
            jaringan.tambahTransisi(aktivitas + "->" + selanjutnya, { aktivitas }, { selanjutnya });
        }
    }
    return jaringan;
}

int main() {
    auto log_kegiatan = hasilkanLogKegiatan();
    auto kausalitas = analisisKausalitas(log_kegiatan);
    JaringanPetri jaringan = bangunJaringanPetri(kausalitas);

    std::unordered_map<std::string, int> penanda_awal;
    for (const auto& tempat : log_kegiatan) {
        penanda_awal[tempat] = 0;
    }
    penanda_awal[log_kegiatan[0]] = 1; // Menandai tempat awal
    jaringan.simulasi(penanda_awal);
    return 0;
}