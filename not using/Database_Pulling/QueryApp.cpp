/* Copyright 2022 will1310
 * This program will be how we will grab data from the game info database
 * Author: Evan Williams
 */
#define MYSQLPP_MYSQL_HEADERS_BURIED
#include <mysql++/mysql++.h>
#include <string>
#include <iostream>
#include <iomanip>
#include "Game.h"

using std::cerr;
using std::cout;
using std::cin;
using std::endl;

/**
 * @brief This main method will run the program that contains the methods to grab queries from the 
 * SQL database that has been provided to us
 * @param argc 
 * @param argv 
 * @return int 
 */
int main(int argc, char *argv[]) {
    Game gameSQL;
    bool running = true;
    //This loop runs the method to keep the menu reappearing.
    while (running) {
        int choice = 0;
        cout << "A Query Application for Game Data" << endl;
        cout << "1. Get Games by Name" << endl;
        cout << "2. Get All Games by Release Year" << endl;
        cout << "3. List How Many Games are in a Genre" << endl;
        cout << "4. List Your Favorited Games" << endl;
        cout << "5. Exit" << endl;
        cout << "" << endl;
        cout << "Enter a menu number" << endl;
        cin >> choice;

        if (choice == 1) {
            //If the choice is choice one it runs the method getGameName
            gameSQL.getGameName()();
        }
        else if (choice == 2) {
            //If the choice is choice two it runs the method getGameYear
            gameSQL.getGameYear();
        }
        else if (choice == 3) {
            //If the choice is choice three it runs the method getGameGenres
            gameSQL.getGameGenres();
        }
        else if (choice == 4) {
            //If the choice is choice four it runs the method getFavorites
            gameSQL.getFavorites();
        }
        else if (choice == 5) {
            //If the choice is choice five it exits the program and says thank you
            cout << "Now exiting, Thank you!" << endl;
            running = false;
        }
        else {
            //If the choice was not any of the given choices it tells the user they
            //need to give a correct choice and redisplayes the choices
            cout << "That is not a valid menu option try again." << endl;
            cout << "" << endl;
        }
    }
}