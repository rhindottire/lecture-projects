/********************************************************************************
** Form generated from reading UI file 'mainwindow.ui'
**
** Created by: Qt User Interface Compiler version 6.6.2
**
** WARNING! All changes made in this file will be lost when recompiling UI file!
********************************************************************************/

#ifndef UI_MAINWINDOW_H
#define UI_MAINWINDOW_H

#include <QtCore/QVariant>
#include <QtWidgets/QApplication>
#include <QtWidgets/QGridLayout>
#include <QtWidgets/QLabel>
#include <QtWidgets/QLineEdit>
#include <QtWidgets/QListWidget>
#include <QtWidgets/QMainWindow>
#include <QtWidgets/QMenuBar>
#include <QtWidgets/QPushButton>
#include <QtWidgets/QStatusBar>
#include <QtWidgets/QVBoxLayout>
#include <QtWidgets/QWidget>

QT_BEGIN_NAMESPACE

class Ui_MainWindow
{
public:
    QWidget *centralwidget;
    QWidget *gridLayoutWidget;
    QGridLayout *gridLayout;
    QLabel *label_2;
    QLineEdit *Nama_Jurusan;
    QLabel *label;
    QLineEdit *ID_Jurusan;
    QLabel *label_5;
    QWidget *gridLayoutWidget_2;
    QGridLayout *gridLayout_2;
    QLabel *label_3;
    QLineEdit *Nama_Dosen;
    QLabel *label_4;
    QLineEdit *ID_Dosen;
    QLabel *label_6;
    QWidget *gridLayoutWidget_3;
    QGridLayout *gridLayout_3;
    QLabel *label_7;
    QLineEdit *Nama_Mahasiswa;
    QLabel *label_8;
    QLineEdit *ID_Mahasiswa;
    QLabel *label_9;
    QWidget *gridLayoutWidget_4;
    QGridLayout *gridLayout_4;
    QLabel *label_11;
    QLineEdit *ID_Kelas;
    QLabel *label_12;
    QLabel *label_10;
    QLineEdit *Kelas;
    QWidget *verticalLayoutWidget;
    QVBoxLayout *verticalLayout;
    QLabel *label_14;
    QListWidget *List_Mahasiswa;
    QPushButton *pushButton;
    QWidget *verticalLayoutWidget_2;
    QVBoxLayout *verticalLayout_2;
    QLabel *label_13;
    QListWidget *List_Information;
    QPushButton *pushButton_2;
    QMenuBar *menubar;
    QStatusBar *statusbar;

    void setupUi(QMainWindow *MainWindow)
    {
        if (MainWindow->objectName().isEmpty())
            MainWindow->setObjectName("MainWindow");
        MainWindow->resize(849, 600);
        centralwidget = new QWidget(MainWindow);
        centralwidget->setObjectName("centralwidget");
        gridLayoutWidget = new QWidget(centralwidget);
        gridLayoutWidget->setObjectName("gridLayoutWidget");
        gridLayoutWidget->setGeometry(QRect(20, 10, 251, 146));
        gridLayout = new QGridLayout(gridLayoutWidget);
        gridLayout->setObjectName("gridLayout");
        gridLayout->setContentsMargins(0, 0, 0, 0);
        label_2 = new QLabel(gridLayoutWidget);
        label_2->setObjectName("label_2");

        gridLayout->addWidget(label_2, 3, 0, 1, 1);

        Nama_Jurusan = new QLineEdit(gridLayoutWidget);
        Nama_Jurusan->setObjectName("Nama_Jurusan");

        gridLayout->addWidget(Nama_Jurusan, 6, 0, 1, 1);

        label = new QLabel(gridLayoutWidget);
        label->setObjectName("label");

        gridLayout->addWidget(label, 1, 0, 1, 1);

        ID_Jurusan = new QLineEdit(gridLayoutWidget);
        ID_Jurusan->setObjectName("ID_Jurusan");

        gridLayout->addWidget(ID_Jurusan, 2, 0, 1, 1);

        label_5 = new QLabel(gridLayoutWidget);
        label_5->setObjectName("label_5");

        gridLayout->addWidget(label_5, 0, 0, 1, 1, Qt::AlignHCenter);

        gridLayoutWidget_2 = new QWidget(centralwidget);
        gridLayoutWidget_2->setObjectName("gridLayoutWidget_2");
        gridLayoutWidget_2->setGeometry(QRect(20, 170, 251, 146));
        gridLayout_2 = new QGridLayout(gridLayoutWidget_2);
        gridLayout_2->setObjectName("gridLayout_2");
        gridLayout_2->setContentsMargins(0, 0, 0, 0);
        label_3 = new QLabel(gridLayoutWidget_2);
        label_3->setObjectName("label_3");

        gridLayout_2->addWidget(label_3, 3, 0, 1, 1);

        Nama_Dosen = new QLineEdit(gridLayoutWidget_2);
        Nama_Dosen->setObjectName("Nama_Dosen");

        gridLayout_2->addWidget(Nama_Dosen, 6, 0, 1, 1);

        label_4 = new QLabel(gridLayoutWidget_2);
        label_4->setObjectName("label_4");

        gridLayout_2->addWidget(label_4, 1, 0, 1, 1);

        ID_Dosen = new QLineEdit(gridLayoutWidget_2);
        ID_Dosen->setObjectName("ID_Dosen");

        gridLayout_2->addWidget(ID_Dosen, 2, 0, 1, 1);

        label_6 = new QLabel(gridLayoutWidget_2);
        label_6->setObjectName("label_6");

        gridLayout_2->addWidget(label_6, 0, 0, 1, 1, Qt::AlignHCenter);

        gridLayoutWidget_3 = new QWidget(centralwidget);
        gridLayoutWidget_3->setObjectName("gridLayoutWidget_3");
        gridLayoutWidget_3->setGeometry(QRect(280, 170, 251, 146));
        gridLayout_3 = new QGridLayout(gridLayoutWidget_3);
        gridLayout_3->setObjectName("gridLayout_3");
        gridLayout_3->setContentsMargins(0, 0, 0, 0);
        label_7 = new QLabel(gridLayoutWidget_3);
        label_7->setObjectName("label_7");

        gridLayout_3->addWidget(label_7, 3, 0, 1, 1);

        Nama_Mahasiswa = new QLineEdit(gridLayoutWidget_3);
        Nama_Mahasiswa->setObjectName("Nama_Mahasiswa");

        gridLayout_3->addWidget(Nama_Mahasiswa, 6, 0, 1, 1);

        label_8 = new QLabel(gridLayoutWidget_3);
        label_8->setObjectName("label_8");

        gridLayout_3->addWidget(label_8, 1, 0, 1, 1);

        ID_Mahasiswa = new QLineEdit(gridLayoutWidget_3);
        ID_Mahasiswa->setObjectName("ID_Mahasiswa");

        gridLayout_3->addWidget(ID_Mahasiswa, 2, 0, 1, 1);

        label_9 = new QLabel(gridLayoutWidget_3);
        label_9->setObjectName("label_9");

        gridLayout_3->addWidget(label_9, 0, 0, 1, 1, Qt::AlignHCenter);

        gridLayoutWidget_4 = new QWidget(centralwidget);
        gridLayoutWidget_4->setObjectName("gridLayoutWidget_4");
        gridLayoutWidget_4->setGeometry(QRect(280, 10, 251, 146));
        gridLayout_4 = new QGridLayout(gridLayoutWidget_4);
        gridLayout_4->setObjectName("gridLayout_4");
        gridLayout_4->setContentsMargins(0, 0, 0, 0);
        label_11 = new QLabel(gridLayoutWidget_4);
        label_11->setObjectName("label_11");

        gridLayout_4->addWidget(label_11, 1, 0, 1, 1);

        ID_Kelas = new QLineEdit(gridLayoutWidget_4);
        ID_Kelas->setObjectName("ID_Kelas");

        gridLayout_4->addWidget(ID_Kelas, 2, 0, 1, 1);

        label_12 = new QLabel(gridLayoutWidget_4);
        label_12->setObjectName("label_12");

        gridLayout_4->addWidget(label_12, 0, 0, 1, 1, Qt::AlignHCenter);

        label_10 = new QLabel(gridLayoutWidget_4);
        label_10->setObjectName("label_10");

        gridLayout_4->addWidget(label_10, 3, 0, 1, 1);

        Kelas = new QLineEdit(gridLayoutWidget_4);
        Kelas->setObjectName("Kelas");

        gridLayout_4->addWidget(Kelas, 4, 0, 1, 1);

        verticalLayoutWidget = new QWidget(centralwidget);
        verticalLayoutWidget->setObjectName("verticalLayoutWidget");
        verticalLayoutWidget->setGeometry(QRect(550, 10, 281, 531));
        verticalLayout = new QVBoxLayout(verticalLayoutWidget);
        verticalLayout->setObjectName("verticalLayout");
        verticalLayout->setContentsMargins(0, 0, 0, 0);
        label_14 = new QLabel(verticalLayoutWidget);
        label_14->setObjectName("label_14");

        verticalLayout->addWidget(label_14, 0, Qt::AlignHCenter);

        List_Mahasiswa = new QListWidget(verticalLayoutWidget);
        List_Mahasiswa->setObjectName("List_Mahasiswa");

        verticalLayout->addWidget(List_Mahasiswa);

        pushButton = new QPushButton(verticalLayoutWidget);
        pushButton->setObjectName("pushButton");

        verticalLayout->addWidget(pushButton);

        verticalLayoutWidget_2 = new QWidget(centralwidget);
        verticalLayoutWidget_2->setObjectName("verticalLayoutWidget_2");
        verticalLayoutWidget_2->setGeometry(QRect(20, 330, 511, 211));
        verticalLayout_2 = new QVBoxLayout(verticalLayoutWidget_2);
        verticalLayout_2->setObjectName("verticalLayout_2");
        verticalLayout_2->setContentsMargins(0, 0, 0, 0);
        label_13 = new QLabel(verticalLayoutWidget_2);
        label_13->setObjectName("label_13");

        verticalLayout_2->addWidget(label_13, 0, Qt::AlignHCenter);

        List_Information = new QListWidget(verticalLayoutWidget_2);
        List_Information->setObjectName("List_Information");

        verticalLayout_2->addWidget(List_Information);

        pushButton_2 = new QPushButton(verticalLayoutWidget_2);
        pushButton_2->setObjectName("pushButton_2");

        verticalLayout_2->addWidget(pushButton_2);

        MainWindow->setCentralWidget(centralwidget);
        menubar = new QMenuBar(MainWindow);
        menubar->setObjectName("menubar");
        menubar->setGeometry(QRect(0, 0, 849, 25));
        MainWindow->setMenuBar(menubar);
        statusbar = new QStatusBar(MainWindow);
        statusbar->setObjectName("statusbar");
        MainWindow->setStatusBar(statusbar);

        retranslateUi(MainWindow);

        QMetaObject::connectSlotsByName(MainWindow);
    } // setupUi

    void retranslateUi(QMainWindow *MainWindow)
    {
        MainWindow->setWindowTitle(QCoreApplication::translate("MainWindow", "MainWindow", nullptr));
        label_2->setText(QCoreApplication::translate("MainWindow", "Nama Jurusan :", nullptr));
        label->setText(QCoreApplication::translate("MainWindow", "Nama Fakultas :", nullptr));
#if QT_CONFIG(tooltip)
        label_5->setToolTip(QCoreApplication::translate("MainWindow", "<html><head/><body><p align=\"center\">DEPARTEMEN</p></body></html>", nullptr));
#endif // QT_CONFIG(tooltip)
        label_5->setText(QCoreApplication::translate("MainWindow", "DEPARTEMENT", nullptr));
        label_3->setText(QCoreApplication::translate("MainWindow", "Nama Dosen :", nullptr));
        label_4->setText(QCoreApplication::translate("MainWindow", "NIP :", nullptr));
#if QT_CONFIG(tooltip)
        label_6->setToolTip(QCoreApplication::translate("MainWindow", "<html><head/><body><p align=\"center\">DEPARTEMEN</p></body></html>", nullptr));
#endif // QT_CONFIG(tooltip)
        label_6->setText(QCoreApplication::translate("MainWindow", "LECTURE", nullptr));
        label_7->setText(QCoreApplication::translate("MainWindow", "Nama Mahasiswa :", nullptr));
        label_8->setText(QCoreApplication::translate("MainWindow", "NIM :", nullptr));
#if QT_CONFIG(tooltip)
        label_9->setToolTip(QCoreApplication::translate("MainWindow", "<html><head/><body><p align=\"center\">DEPARTEMEN</p></body></html>", nullptr));
#endif // QT_CONFIG(tooltip)
        label_9->setText(QCoreApplication::translate("MainWindow", "STUDENT", nullptr));
        label_11->setText(QCoreApplication::translate("MainWindow", "Mata Kuliah :", nullptr));
#if QT_CONFIG(tooltip)
        label_12->setToolTip(QCoreApplication::translate("MainWindow", "<html><head/><body><p align=\"center\">DEPARTEMEN</p></body></html>", nullptr));
#endif // QT_CONFIG(tooltip)
        label_12->setText(QCoreApplication::translate("MainWindow", "CLASSROOM", nullptr));
        label_10->setText(QCoreApplication::translate("MainWindow", "Kelas :", nullptr));
        label_14->setText(QCoreApplication::translate("MainWindow", "List Mahasiswa :", nullptr));
        pushButton->setText(QCoreApplication::translate("MainWindow", "Print", nullptr));
        label_13->setText(QCoreApplication::translate("MainWindow", "Data Information", nullptr));
        pushButton_2->setText(QCoreApplication::translate("MainWindow", "Print", nullptr));
    } // retranslateUi

};

namespace Ui {
    class MainWindow: public Ui_MainWindow {};
} // namespace Ui

QT_END_NAMESPACE

#endif // UI_MAINWINDOW_H
