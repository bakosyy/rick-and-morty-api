## About Rick and Morty API

Project: Rick and Morty Introduction: This is an api for "Rick and Morty" project. The project will contain deep
informations about characters, locations of characters, images of characters, locations and episodes. This entities will
have a relationship between themselves. Project was written in Laravel framework version 8.0 and compatible with php
versions above 7.3

Purpose: Create a backend API for "Rick and Morty" project that makes CRUD actions which contains validation, correct
architectural layers (controller, services, models, presenter, repository)
Some parts of the project can be not completed according to SOLID principles. Because the project is made for
educational purposes and some functionalities are implemented using simple approach

Topics used in current project:

- Seperate Controllers that inherits Controller class
- Controller class that has methods to output result of every actions in json format
- Abstract layers (controllers, services, repositories)
- Request validation classes for each actions in different models
- Indexes for searchable lines in database tables
- Enumerations in database
- Eloquent: Api Resources (class that displays data in json format)
- Relationships
- Polymorphic Relationships (single database table is used to store datas of many other database tables)
- Soft deletes in database
- File storage
- Laravel Sanctum authentication by token

All the routes you can see in directory "routes/api.php" or you can write in console "php artisan route:list" to see all
available routes. For testing application you may use Postman

    Here is a brief introduction to characters entity. Check out "routes/api.php" file to see other routes
        // List of characters
        GET - http://rick-and-morty-backend/api/v1/characters

        // Character
        GET - http://rick-and-morty-backend/api/v1/characters/1

        // Create
        POST - http://rick-and-morty-backend/api/v1/characters

        // Update
        PUT - http://rick-and-morty-backend/api/v1/characters/1
        
        // Delete
        DELETE - http://rick-and-morty-backend/api/v1/characters/2

        // Episode lists of character
        GET - http://rick-and-morty-backend/api/v1/characters/3/episodes
        
        // Add image
        POST - http://rick-and-morty-backend/api/v1/character/set-image

        // Delete image
        DELETE - http://rick-and-morty-backend/api/v1/character/delete-image

Tables content

    Characters table
		- name
		- status (alive, dead)
		- gender (male, female)
		- race (human, alien, robot, humanoid, animal)
		- description
		- birth_location_id
		- current_location_id

	Locations table
		- name
		- type (universe, planet, sector, base, microuniverse)
		- dimension (c-137, substituted, 5-126)
		- description

	Episodes table
		- name
		- season
		- series
		- premiere
		- description

	Images table (polymorphic)
		- path
		- imageable_id
		- imageable_type

	Users table
		- name
		- phone
		- password
		- locked (0, 1)
		Users table is interconnected with table "personal_access_tokens" for using Laravel Sanctum authentication (auth by token)

	Personal_access_tokens table
		- tokenable_type
		- tokenable_id
		- name
		- token
		- abilities
		- last_used_at

Table Relationships

    character - image
	character - location (birth location)
	character - location (current location)
	character - episodes

	episode - image
	episode - characters

	location - image
	location - characters (birth location characters)
	location - characters (current location characters)

