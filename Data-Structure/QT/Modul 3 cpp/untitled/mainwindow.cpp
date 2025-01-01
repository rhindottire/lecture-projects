#include "mainwindow.h"
#include "./ui_mainwindow.h"

MainWindow::MainWindow(QWidget *parent)
    : QMainWindow(parent)
    , ui(new Ui::MainWindow)
{
    ui->setupUi(this);
}

MainWindow::~MainWindow()
{
    delete ui;
}

void MainWindow::on_pushButton_clicked()
{
    Student Mahasiswa;
    Mahasiswa.id = ui->ID_Mahasiswa->text();
    Mahasiswa.nama = ui->Nama_Mahasiswa->text();
    ui->List_Mahasiswa->addItem("NIM : " + Mahasiswa.id + "\n" + "NAMA : " + Mahasiswa.nama);
    List_Mahasiswa.append(Mahasiswa);
}

void MainWindow::on_pushButton_2_clicked()
{
    Classroom Kelas;
    Kelas.id = ui->ID_Kelas->text();
    Kelas.nama = ui->Kelas->text();

    Departement Jurusan;
    Jurusan.id = ui->ID_Jurusan->text();
    Jurusan.nama = ui->Nama_Jurusan->text();

    Lecture Dosen;
    Dosen.id = ui->ID_Dosen->text();
    Dosen.nama = ui->Nama_Dosen->text();

    QString Cetak_String;
    Cetak_String += "Departement\n";
    Cetak_String += Jurusan.id + ", " + Jurusan.nama;
    Cetak_String += "\nKelas\n";
    Cetak_String += Kelas.id + ", " + Kelas.nama;
    Cetak_String += "\nDosen\n";
    Cetak_String += Dosen.id + ", " + Dosen.nama;
    Cetak_String += "\nMahasiswa\n";

    for(const Student &i:List_Mahasiswa){
        Cetak_String += i.id + " " + i.nama + "\n";
    }
    ui->List_Information->addItem(Cetak_String);
}
