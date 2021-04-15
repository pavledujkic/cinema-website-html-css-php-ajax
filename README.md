Application description

This application is a website that is used to work with movies and actors. The application enables CRUD operations on films and actors, as well as their linking and unlinking.

The site consists of four pages:
- Index.html - home page, contains nothing
- filmovi.html - used to view, edit and delete movies and link and unlink actors and movies. When the page loads, a GET request is sent for all movies in the database. When the data arrives from the server, it is displayed in the form of cards. Each movie has a delete (POST request to delete) and edit button. Clicking on the edit button opens a modal form with filled data from the movie. On the right side there is a list of actors in the film as well as a drop down menu with all the actors and add and delete buttons that invite the server to do the mentioned actions. Clicking the edit button sends a POST request to update the movie.
- glumci.html - used to display, add, change actors in the database. It contains a table of all actors and a form for entering a new actor. All CRUDs are executed in the same way as in the previous case.
- addFilm.html - contains a form for entering a new movie. When loading, a GET request for all genres is sent, and by clicking on the button, a POST request is sent to add a new movie to the database.

AJAX technologies implemented in jQuery are used to connect to the server.

We have five files on the server, as follows:
- broker.php - used to connect to the database.
- filmovi.php - is used to process requests related to movies. When processing the GET request, the broker is invited to return the data from the database, which is then packed in JSON and sent to the client as such. When processing the UPDATE request, the data is first validated, and only then, if the data is good, the broker is called, and in response, a message is sent about whether the operation was successfully performed.
- glumci.php - is used to process requests related to actors. The work process itself is almost identical to the movies.php file.
- zanrovi.php - processes only the GET request for all genres from the database that it sends in JSON format.
- addFilm.php - accepts movie data, downloads the image, validates the data (same conditions as for UPDATE) and invites the broker to remember it.
