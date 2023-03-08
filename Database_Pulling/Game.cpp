/**Copyright 2022
*Author: Evan Williams
*Purpose: to finish the methods to read from the film sql database
*/
#define MYSQLPP_MYSQL_HEADERS_BURIED
#include <mysql++/mysql++.h>
#include <string>
#include <iostream>
#include <iomanip>
#include <map>
#include "Game.h"

using std::cerr;
using std::cout;
using std::cin;
using std::endl;

/**
 * @brief gets game names
 */
void Film::getGameName() {
    std::map<std::string, std::string> Get;
    std::string film;
    cout << "What is the game name or name part you would like to search for? (must be a character or character sequence)" << endl;
    cin >> film;
    cout << "Here is  the result" << endl;
    cout << "" << endl;
    // Connect to database with: database, server, userID, password
    mysqlpp::Connection conn;
    if (conn.connect("cse278F2022", "localhost", "cse278F2022", "raspberrySeltzer")) {

        // Create a query
        mysqlpp::Query query = conn.query();
        query << "SELECT  film_id, title FROM film WHERE title LIKE \"%" << film << "%\";";
        query.parse();
        mysqlpp::StoreQueryResult result = query.store();

        if (result.num_rows() > 0) {
            // display result in table
            // Display headers 
            cout << std::left << std::setw(10) << "Film ID" << std::left << std::setw(10) << "Title" << endl;

            // Get each row in result set, and print its contents
            for (int i = 0; i < result.num_rows(); ++i) {
                cout << std::left << std::setw(5) << result[i]["film_id"] << std::left << std::setw(10) << result[i]["title"] << endl;
            }
            cout << "" << endl;
        }
        else {
            cout << "Query does not return any records" << query.error() << "" << endl;
        }
        return;
    }
    else {
        cout << " Connection failed: " << conn.error() << "" << endl;
        return;
    }
}

/**
 * @brief gets all games in a year
 * 
 */
void Film::getGameYear() {
    std::map<std::string, std::string> Get;
    std::string firstName;
    std::string lastName;
    cout << "What is the release year of the Game you would like to search for? (must be a character sequence)" << endl;
    cin >> firstName;
    cout << "Here is  the result" << endl;
    cout << "" << endl;
    // Connect to database with: database, server, userID, password
    mysqlpp::Connection conn;
    if (conn.connect("cse278F2022", "localhost", "cse278F2022", "raspberrySeltzer")) {

        // Create a query
        mysqlpp::Query query = conn.query();
        //query << "Select first_name, last_name, title From actor, film, film_actor WHERE first_name = \"" << firstName << "\" AND last_name = \"" << lastName << "\" AND actor.actor_id = film_actor.actor_id AND film.film_id = film_actor.film_id;";
        query.parse();
        mysqlpp::StoreQueryResult result = query.store();

        if (result.num_rows() > 0) {
            // Display headers 
            cout << std::left << std::setw(15) << "First Name" << std::left << std::setw(15) << "Last Name" << std::left << std::setw(20) << "Title" << endl;

            // Get each row in result set, and print its contents
            for (int i = 0; i < result.num_rows(); ++i) {
                cout << std::left << std::setw(15) << result[i]["first_name"] << std::left << std::setw(15) << result[i]["last_name"] << std::left << std::setw(20) << result[i]["title"] << endl;
            }
            cout << "" << endl;
        }
        else {
            cout << "Query does not return any records" << query.error() << "" << endl;
        }
        return;
    }
    else {
        cout << " Connection failed: " << conn.error() << "" << endl;
        return;
    }
}

/**
 * @brief This method will go forth into the database for films and search and grab all the genres
 * and total up how many movies are in each genre
 * Then prints it out in a table in the console to show output
 */
void Film::getGameGenres() {
    std::map<std::string, std::string> Get;
    cout << "Here is the result of all the Genre types" << endl;
    cout << "" << endl;
    // Connect to database with: database, server, userID, password
    mysqlpp::Connection conn;
    if (conn.connect("cse278F2022", "localhost", "cse278F2022", "raspberrySeltzer")) {

        // Create a query
        mysqlpp::Query query = conn.query();
        query << "Select Distinct Name, COUNT(*) as count From category, film_category Where category.category_id = film_category.category_id Group By Name Order By Count DESC;";
        query.parse();
        mysqlpp::StoreQueryResult result = query.store();

       if (result.num_rows() > 0) {
            // Display headers 
            cout << std::left << std::setw(15) << "Genre" << std::left << std::setw(15) << "Count" << endl;

            // Get each row in result set, and print its contents
            for (int i = 0; i < result.num_rows(); ++i) {
                cout << std::left << std::setw(15) << result[i]["Name"] << std::left << std::setw(15) << result[i]["count"] << endl;
            }
            cout << "" << endl;
        }
        else {
            cout << "Query does not return any records" << query.error() << "" << endl;
        }
        return;
    }
    else {
        cout << " Connection failed: " << conn.error() << "" << endl;
        return;
    }
}

/**
 * @brief if logged in, gets user favorites
 * 
 */
void Film::getFavorites(){
    std::map<std::string, std::string> Get;
    std::string firstName;
    std::string lastName;
    cout << "Here are your favorited games:" << endl;
    cout << "" << endl;

    // Connect to database with: database, server, userID, password
    mysqlpp::Connection conn;
    if (conn.connect("cse278F2022", "localhost", "cse278F2022", "raspberrySeltzer")) {
        // Create a query
        mysqlpp::Query query = conn.query();
        query << "Select Distinct rating, Count(*) as count From film, film_actor, actor WHERE film.film_id = film_actor.film_id AND actor.actor_id = film_actor.actor_id AND actor.first_name = \"" << firstName << "\" AND actor.last_name = \"" << lastName << "\" Group By rating Order By count DESC;";
        query.parse();
        mysqlpp::StoreQueryResult result = query.store();

        

        if (result.num_rows() > 0) {
            // Display result in table
            // Display headers 
            //cout << "Ratings for " << firstName << " " << lastName << "." << endl;
            cout << std::left << std::setw(15) << "Rating" << std::left << std::setw(15) << "Count" << endl;

            // Get each row in result set, and print its contents
            for (int i = 0; i < result.num_rows(); ++i) {
                cout << std::left << std::setw(15) << result[i]["rating"] << std::left << std::setw(15) << result[i]["count"] << endl;
            }
            cout << "" << endl;
        }
        else {
            cout << "Query does not return any records" << query.error() << "" << endl;
        }
        return;
    }
    else {
        cout << " Connection failed: " << conn.error() << "" << endl;
        return;
    }
}
