# product front end crud project

## Tech Specifications
	- "php": "^7.3|^8.0".
    - "laravel/framework": "^8.12".


### Features
	1. JWT Token
		- token validation checking and responses through middleware
	2. Database migration
	3. Authentication
		- Validation for registration 
		- all possible responses 
		- jwt token generation
		- Validation for login
		- all possible responses for invalid login
		- jwt token generation
	4. Product Crud
		- index functionality for getting all data
		- prepare all responses for getting data
		- storing api and it's responses and validations
		- updating api, it's responses and validation
		- deleting api, it's responss and validation
		- image uploading and storing on public path

## Attachment
	- Json file of postman api collection in the root directory named `product backend.postman_collection.json

## Project setup
	Project setup details are described below step by step: The front end project for this project is [here](https://github.com/zrshishir/product-frontend). First, follow these steps then front end [project](git@github.com:zrshishir/product-frontend) steps
		1. Download or clone the project from [Product Backend](git@github.com:zrshishir/product-backend.git). 
		2. Go to the project's root directory and run the command `composer install` or `composer update`
		3. After successfully composer updation set up your database credentials on .env file
		4. Run the command `php artisan migrate`
		5. Run the command `php artisan storage:link`
		6. If you are using LEMP stack then follow proper steps [here](https://www.digitalocean.com/community/tutorials/how-to-install-linux-nginx-mysql-php-lemp-stack-ubuntu-18-04) and if you are using other then run the command `php artisan serve` to get the domain name or service url that will have to be assigned in the [frontend code](git@github.com:zrshishir/product-frontend) `/src/api/product-frontend.js` ROOT_URL const.


### screenshots of working procedure details
	The working procedure is described below with screenshots:
	1. To install this project you will have composer installed. You can install this project two ways
		- Download the zip file from the repository and extract it on your pc

		- clone the project using git and the command is `git clone git@github.com:zrshishir/product-frontend.git`. 

![git clone](/screenshots/terminal_1.png)

	2. Go to the project's root directory 

![git clone](/screenshots/terminal_2.png)

	3. run the command `composer update` or `composer install`

![go to root directory](/screenshots/terminal_3.png)

	3. Database credential set up

![db set up](/screenshots/terminal_7.png)

	5. Run the command `php artisan migrate`

![migration](/screenshots/terminal_4.png)

	6. Run the command `php artisan storage:link`

![storage link](/screenshots/terminal_5.png)

	7. Run the command `php artisan serve` and use this link on the postman url
![To run the project](/screenshots/terminal_6.png)

### Some screenshots of the project postman api: As i use LEMP stack for my local server environment, I have used domain name in the url

	1. Registration api and it's responses

![Registration](/screenshots/1.png)

	2. Login api details and it's responses

![Login](/screenshots/2.png)

	3. Product Data index api details and it's resposnes

![getting product](/screenshots/3.png)

	4. Product storing api details and it's resposnes

![Product storing](/screenshots/4.png)

	5. Product updating api details and it's resposnes

![product updating](/screenshots/5.png)

	6. Product deleting api details and it's resposnes

![product deleting](/screenshots/6.png)


