## Description
This is an application that calls an external
API service to get information about books & also Create, Read, Update and Delete data from a local MYSQL database about books

## Steps to setup the aplication
Set up the .env file with your database authentication credentials.

1) Install dependencies by running 
```shell
composer install
```

2) Generate migration with 
```shell
php artisan migrate
```

3) To run the application use 
```shell
php artisan serve
```

## Features
<div>

<h3>Requirement 1 Features </h3>
<ol> 
<li> To get a book from the External API,  send a GET request to http://localhost:8000/api/external-books?name=:nameOfABook  where <b>:nameOfABook</b> is a variable. Example value for <b>:nameOfABook</b> can be “A Game Of
Thrones”</li>
</ol>
</div>


<h3>Requirement 2 Features </h3>
<ol> 

<!-- 1 -->
<li> To create a book, send a POST request to http://localhost:8000/api/v1/books
with the following data
    <ul>
        <li> name </li>
        <li> isbn </li>
        <li> authors </li>
        <li> country </li>
        <li> number_of_pages </li>
        <li> publisher </li>
        <li> release_date </li>
     </ul>
</li>


<!-- 2 -->
<li>
To get a read a book, send a GET request to http://localhost:8000/api/v1/books
</li>

<!-- 3 -->
<li>
To get a update a book, send a PATCH request to http://localhost:8000/api/v1/books/:id where :id is  a placeholder variable for an integer (for example 1) with the following data
    <ul>
        <li> name </li>
        <li> isbn </li>
        <li> authors </li>
        <li> country </li>
        <li> number_of_pages </li>
        <li> publisher </li>
        <li> release_date </li>
     </ul>
</li>


<!-- 4 -->
<li>
To get  delete a book send a DELETE request to http://localhost:8000/api/v1/books/:id.

An  alternative way to delete a book is to send a POST request to http://localhost:8000/api/v1/books/:id/delete
</li>

<li>
To fetch a book, send a GET request to http://localhost:8000/api/v1/books/:id.
</li>
</ol>


<!-- 5 -->
<li> To search for a book,  send a GET request to http://localhost:8000/api/v1/books?q=:searchQuery  where <b>:searchQuery</b> is a variable. <b>:searchQuery</b> can by name , country, publisher
 and release date
</ol>


<h5>Tests</h5>
Unit Tests are provided
</div>
