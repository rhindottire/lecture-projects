#ifndef MAINWINDOW_H
#define MAINWINDOW_H

#include <QMainWindow>

QT_BEGIN_NAMESPACE
namespace Ui {
class MainWindow;
}
QT_END_NAMESPACE

class MainWindow : public QMainWindow
{
    Q_OBJECT

public:
    MainWindow(QWidget *parent = nullptr);
    ~MainWindow();

private slots:
    void on_pushButton_clicked();

    void on_pushButton_2_clicked();

private:
    Ui::MainWindow *ui;

    class Departement{
    public:
        QString id;
        QString nama;
    };

    class Classroom{
    public:
        QString id;
        QString nama;
    };

    struct Lecture{
        QString id;
        QString nama;
    };

    struct Student{
        QString id;
        QString nama;
    };

    QVector<Student> List_Mahasiswa;
};
#endif // MAINWINDOW_H
