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
	1. To install this project you will have node installed. I will describe it using `npm`. You can install this project two ways
		- Download the zip file from the repository and extract it on your pc

		- clone the project using git and the command is `git clone git@github.com:zrshishir/product-frontend.git`. 

![git clone](/screenshots/1.png)

	2. Go to the project's root directory and run the command `npm install`

![go to root directory](/screenshots/2.png)

![npm install](/screenshots/3.png)

	3. Go to the `/src/api` directory and edit the `product-frontend.js`. Assign your domain name with `ROOT_URL`. 
			`const ROOT_URL = 'your-domain-name/api'`

![root url setting](/screenshots/root_url.png)

	4. Go to your root direcotory and run `npm run serve`

![run the project](/screenshots/npm-run-serve.png)

### Some screenshots of the project
	1. Home page 

![home page](/screenshots/4.png)

	2. Sign up or Registration page

![sign up](/screenshots/5.png)

![sign up validation page](/screenshots/6.png)

	3. Login or Sign in page

![sign in page](/screenshots/7.png)

	4. Registration or login message on home page with log out button and product menu

![message home page](/screenshots/8.png)

	5. Product page

![product page](/screenshots/9.png)

	6. Product creation page

![product creation page](/screenshots/10.png)

	7. Product edit page

![product edit page](/screenshots/11.png)

	8. Product delete page

![product delete](/screenshots/12.png)

	9. Log out message					

![log out message on home page](/screenshots/13.png)

