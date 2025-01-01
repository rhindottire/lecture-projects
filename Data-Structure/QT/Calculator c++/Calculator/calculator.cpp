#include "calculator.h"
#include "ui_calculator.h"

Calculator::Calculator(QWidget *parent)
: QMainWindow(parent)
, ui(new Ui::Calculator)
{
ui->setupUi(this);
}

Calculator::~Calculator()
{
delete ui;
}

void Calculator::on_pushButton_clicked()
{
inputString += "1";
ui->Display->setText(inputString);
}

void Calculator::on_pushButton_2_clicked()

{
inputString += "2";
ui->Display->setText(inputString);
}

void Calculator::on_pushButton_3_clicked()
{
inputString += "3";
ui->Display->setText(inputString);
}

void Calculator::on_pushButton_5_clicked()
{
inputString += "4";
ui->Display->setText(inputString);
}

void Calculator::on_pushButton_6_clicked()
{
inputString += "5";
ui->Display->setText(inputString);
}

void Calculator::on_pushButton_7_clicked()
{

inputString += "6";
ui->Display->setText(inputString);
}

void Calculator::on_pushButton_9_clicked()
{
inputString += "7";
ui->Display->setText(inputString);
}

void Calculator::on_pushButton_10_clicked()
{
inputString += "8";
ui->Display->setText(inputString);
}

void Calculator::on_pushButton_11_clicked()
{
inputString += "9";
ui->Display->setText(inputString);
}

void Calculator::on_pushButton_14_clicked()
{
inputString += "0";

ui->Display->setText(inputString);
}

void Calculator::on_pushButton_4_clicked()
{
if (!inputString.isEmpty() && inputString.at(inputString.length() - 1).isDigit())
inputString += "+";
ui->Display->setText(inputString);
}

void Calculator::on_pushButton_13_clicked()
{
inputString="";
ui->Display->setText("");
}

void Calculator::on_pushButton_15_clicked()
{
inputString = inputString.chopped(1);
// Mendapatkan teks yang sudah ada di dalam QLineEdit
QString currentText = ui->Display->text();

// Menghapus karakter terakhir dari teks
currentText = currentText.chopped(1);

// Mengatur teks yang sudah dimodifikasi kembali ke dalam QLineEdit
ui->Display->setText(currentText);
}

void Calculator::on_pushButton_16_clicked()
{
inputString="";
// Dapatkan input string dari lineEdit
QString inputString = ui->Display->text();
QVector<double> numbers; // Menyimpan angka
QVector<QChar> ops; // Menyimpan operator

QString tempNum = ""; // Untuk menyimpan sementara angka yang sedang
dibaca
for(int i = 0; i < inputString.length(); ++i) {
QChar c = inputString[i];
if(c.isDigit() || c == '.') {
tempNum += c;
} else if(c == '+' || c == '-' || c == '*' || c == '/') {
numbers.push_back(tempNum.toDouble());
ops.push_back(c);
tempNum = "";
}
}
if(!tempNum.isEmpty()) numbers.push_back(tempNum.toDouble());

// Evaluasi * dan / terlebih dahulu
for(int i = 0; i < ops.size(); ) {
if(ops[i] == '*' || ops[i] == '/') {

double result = ops[i] == '*' ? numbers[i] * numbers[i+1] : numbers[i] /
numbers[i+1];
numbers[i] = result;
numbers.removeAt(i + 1);
ops.removeAt(i);
} else {
++i;
}
}

// Evaluasi + dan -
double result = numbers[0];
for(int i = 0; i < ops.size(); ++i) {
if(ops[i] == '+') {
result += numbers[i + 1];
} else if(ops[i] == '-') {
result -= numbers[i + 1];
}
}

// Tampilkan hasil
ui->Display->setText(QString::number(result));
}

void Calculator::on_pushButton_8_clicked()
{
if (!inputString.isEmpty() && inputString.at(inputString.length() - 1).isDigit())
inputString += "-";
ui->Display->setText(inputString);

}

void Calculator::on_pushButton_12_clicked()
{
if (!inputString.isEmpty() && inputString.at(inputString.length() - 1).isDigit())
inputString += "*";
ui->Display->setText(inputString);
}

void Calculator::on_pushButton_17_clicked()
{
if (!inputString.isEmpty() && inputString.at(inputString.length() - 1).isDigit())
inputString += "/";
ui->Display->setText(inputString);
}