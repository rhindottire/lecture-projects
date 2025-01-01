/********************************************************************************
** Form generated from reading UI file 'calculator.ui'
**
** Created by: Qt User Interface Compiler version 6.6.2
**
** WARNING! All changes made in this file will be lost when recompiling UI file!
********************************************************************************/

#ifndef UI_CALCULATOR_H
#define UI_CALCULATOR_H

#include <QtCore/QVariant>
#include <QtWidgets/QApplication>
#include <QtWidgets/QGridLayout>
#include <QtWidgets/QLineEdit>
#include <QtWidgets/QMainWindow>
#include <QtWidgets/QMenuBar>
#include <QtWidgets/QPushButton>
#include <QtWidgets/QStatusBar>
#include <QtWidgets/QWidget>

QT_BEGIN_NAMESPACE

class Ui_Calculator
{
public:
    QWidget *centralwidget;
    QGridLayout *gridLayout;
    QPushButton *pushButton_16;
    QPushButton *pushButton;
    QPushButton *pushButton_10;
    QPushButton *pushButton_5;
    QPushButton *pushButton_8;
    QPushButton *pushButton_15;
    QPushButton *pushButton_4;
    QPushButton *pushButton_7;
    QPushButton *pushButton_9;
    QPushButton *pushButton_2;
    QPushButton *pushButton_17;
    QPushButton *pushButton_3;
    QPushButton *pushButton_12;
    QPushButton *pushButton_14;
    QPushButton *pushButton_11;
    QPushButton *pushButton_13;
    QPushButton *pushButton_6;
    QLineEdit *Display;
    QMenuBar *menubar;
    QStatusBar *statusbar;

    void setupUi(QMainWindow *Calculator)
    {
        if (Calculator->objectName().isEmpty())
            Calculator->setObjectName("Calculator");
        Calculator->resize(415, 485);
        centralwidget = new QWidget(Calculator);
        centralwidget->setObjectName("centralwidget");
        gridLayout = new QGridLayout(centralwidget);
        gridLayout->setObjectName("gridLayout");
        pushButton_16 = new QPushButton(centralwidget);
        pushButton_16->setObjectName("pushButton_16");

        gridLayout->addWidget(pushButton_16, 6, 0, 1, 4);

        pushButton = new QPushButton(centralwidget);
        pushButton->setObjectName("pushButton");

        gridLayout->addWidget(pushButton, 1, 0, 1, 1);

        pushButton_10 = new QPushButton(centralwidget);
        pushButton_10->setObjectName("pushButton_10");

        gridLayout->addWidget(pushButton_10, 4, 1, 1, 1);

        pushButton_5 = new QPushButton(centralwidget);
        pushButton_5->setObjectName("pushButton_5");

        gridLayout->addWidget(pushButton_5, 3, 0, 1, 1);

        pushButton_8 = new QPushButton(centralwidget);
        pushButton_8->setObjectName("pushButton_8");

        gridLayout->addWidget(pushButton_8, 3, 3, 1, 1);

        pushButton_15 = new QPushButton(centralwidget);
        pushButton_15->setObjectName("pushButton_15");

        gridLayout->addWidget(pushButton_15, 5, 2, 1, 1);

        pushButton_4 = new QPushButton(centralwidget);
        pushButton_4->setObjectName("pushButton_4");

        gridLayout->addWidget(pushButton_4, 1, 3, 1, 1);

        pushButton_7 = new QPushButton(centralwidget);
        pushButton_7->setObjectName("pushButton_7");

        gridLayout->addWidget(pushButton_7, 3, 2, 1, 1);

        pushButton_9 = new QPushButton(centralwidget);
        pushButton_9->setObjectName("pushButton_9");

        gridLayout->addWidget(pushButton_9, 4, 0, 1, 1);

        pushButton_2 = new QPushButton(centralwidget);
        pushButton_2->setObjectName("pushButton_2");

        gridLayout->addWidget(pushButton_2, 1, 1, 1, 1);

        pushButton_17 = new QPushButton(centralwidget);
        pushButton_17->setObjectName("pushButton_17");

        gridLayout->addWidget(pushButton_17, 5, 3, 1, 1);

        pushButton_3 = new QPushButton(centralwidget);
        pushButton_3->setObjectName("pushButton_3");

        gridLayout->addWidget(pushButton_3, 1, 2, 1, 1);

        pushButton_12 = new QPushButton(centralwidget);
        pushButton_12->setObjectName("pushButton_12");

        gridLayout->addWidget(pushButton_12, 4, 3, 1, 1);

        pushButton_14 = new QPushButton(centralwidget);
        pushButton_14->setObjectName("pushButton_14");

        gridLayout->addWidget(pushButton_14, 5, 1, 1, 1);

        pushButton_11 = new QPushButton(centralwidget);
        pushButton_11->setObjectName("pushButton_11");

        gridLayout->addWidget(pushButton_11, 4, 2, 1, 1);

        pushButton_13 = new QPushButton(centralwidget);
        pushButton_13->setObjectName("pushButton_13");

        gridLayout->addWidget(pushButton_13, 5, 0, 1, 1);

        pushButton_6 = new QPushButton(centralwidget);
        pushButton_6->setObjectName("pushButton_6");

        gridLayout->addWidget(pushButton_6, 3, 1, 1, 1);

        Display = new QLineEdit(centralwidget);
        Display->setObjectName("Display");
        QSizePolicy sizePolicy(QSizePolicy::Policy::Preferred, QSizePolicy::Policy::Expanding);
        sizePolicy.setHorizontalStretch(0);
        sizePolicy.setVerticalStretch(0);
        sizePolicy.setHeightForWidth(Display->sizePolicy().hasHeightForWidth());
        Display->setSizePolicy(sizePolicy);
        QFont font;
        font.setPointSize(20);
        Display->setFont(font);

        gridLayout->addWidget(Display, 0, 0, 1, 4);

        Calculator->setCentralWidget(centralwidget);
        menubar = new QMenuBar(Calculator);
        menubar->setObjectName("menubar");
        menubar->setGeometry(QRect(0, 0, 415, 26));
        Calculator->setMenuBar(menubar);
        statusbar = new QStatusBar(Calculator);
        statusbar->setObjectName("statusbar");
        Calculator->setStatusBar(statusbar);

        retranslateUi(Calculator);

        QMetaObject::connectSlotsByName(Calculator);
    } // setupUi

    void retranslateUi(QMainWindow *Calculator)
    {
        Calculator->setWindowTitle(QCoreApplication::translate("Calculator", "Calculator", nullptr));
        pushButton_16->setText(QCoreApplication::translate("Calculator", "ENTER", nullptr));
        pushButton->setText(QCoreApplication::translate("Calculator", "1", nullptr));
        pushButton_10->setText(QCoreApplication::translate("Calculator", "8", nullptr));
        pushButton_5->setText(QCoreApplication::translate("Calculator", "4", nullptr));
        pushButton_8->setText(QCoreApplication::translate("Calculator", "-", nullptr));
        pushButton_15->setText(QCoreApplication::translate("Calculator", "c", nullptr));
        pushButton_4->setText(QCoreApplication::translate("Calculator", "+", nullptr));
        pushButton_7->setText(QCoreApplication::translate("Calculator", "6", nullptr));
        pushButton_9->setText(QCoreApplication::translate("Calculator", "7", nullptr));
        pushButton_2->setText(QCoreApplication::translate("Calculator", "2", nullptr));
        pushButton_17->setText(QCoreApplication::translate("Calculator", "/", nullptr));
        pushButton_3->setText(QCoreApplication::translate("Calculator", "3", nullptr));
        pushButton_12->setText(QCoreApplication::translate("Calculator", "x", nullptr));
        pushButton_14->setText(QCoreApplication::translate("Calculator", "0", nullptr));
        pushButton_11->setText(QCoreApplication::translate("Calculator", "9", nullptr));
        pushButton_13->setText(QCoreApplication::translate("Calculator", "AC", nullptr));
        pushButton_6->setText(QCoreApplication::translate("Calculator", "5", nullptr));
        Display->setText(QString());
    } // retranslateUi

};

namespace Ui {
    class Calculator: public Ui_Calculator {};
} // namespace Ui

QT_END_NAMESPACE

#endif // UI_CALCULATOR_H
