#ifndef CALCULATOR_H
#define CALCULATOR_H

#include <QMainWindow>

QT_BEGIN_NAMESPACE
namespace Ui {
class Calculator;
}
QT_END_NAMESPACE

class Calculator : public QMainWindow
{
Q_OBJECT

public:
Calculator(QWidget *parent = nullptr);
~Calculator();

private slots:
void on_pushButton_clicked();

void on_pushButton_2_clicked();

void on_pushButton_3_clicked();

void on_pushButton_5_clicked();

void on_pushButton_6_clicked();

void on_pushButton_7_clicked();

void on_pushButton_9_clicked();

void on_pushButton_10_clicked();

void on_pushButton_11_clicked();

void on_pushButton_14_clicked();

void on_pushButton_4_clicked();

void on_pushButton_13_clicked();

void on_pushButton_15_clicked();

void on_pushButton_16_clicked();

void on_pushButton_8_clicked();

void on_pushButton_12_clicked();

void on_pushButton_17_clicked();

private:
Ui::Calculator *ui;
QString inputString;

};
#endif // CALCULATOR_H