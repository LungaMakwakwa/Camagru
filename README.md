# Camagru

> A small web application allowing you to make basic photo and video editing using your webcam and some predefined images.

> App’s users should be able to select an image in a list of superposable images (for instance a picture frame, or other “we don’t wanna know what you are using this for” objects), take a picture with his/her webcam and admire the result that should be mixing both pictures. All captured images should be public, likeables and commentable. </br>


**Badges**

- Build
- Issues
- Forks
- Stars
- Licence

[![Build Status](http://img.shields.io/travis/badges/badgerbadgerbadger.svg?style=flat-square)](https://travis-ci.org/badges/badgerbadgerbadger)
<a href="https://github.com/The-only-blue/Camagru/issues"><img alt="GitHub issues" src="https://img.shields.io/github/issues/The-only-blue/Camagru"></a>
<a href="https://github.com/The-only-blue/Camagru/network"><img alt="GitHub forks" src="https://img.shields.io/github/forks/The-only-blue/Camagru"></a>
<a href="https://github.com/The-only-blue/Camagru/stargazers"><img alt="GitHub stars" src="https://img.shields.io/github/stars/The-only-blue/Camagru"></a>
<a href="https://github.com/The-only-blue/Camagru"><img alt="GitHub license" src="https://img.shields.io/github/license/The-only-blue/Camagru"></a>


---
## Table of Contents

- [Requirements](#requirements)
- [Installation](#installation)
- [Testing](#testing)
- [Security](#security)
- [FAQ](#faq)
---

## Requirements

- Have `XAMPP` or `MAMP` installed.
- PHP 7.0 or above.
- Apache 2 or above.

## Installation

- Clone the repo
- Place the `camagru` directory in the `htdocs` directory of the `MAMP` or `XAMPP` application.
- Run the `XAMPP` or `MAMP` you can edit the port number but the defualt port is usually `80` or `8080`.
- To build the database run the setup.php file. => http://localhost:8080/camagru/config/setup.php (Replace the 8080 with the port number on your XAMMP or MAMP Application)
- Then run http://localhost:8080/camagru/ to open access the site. (Replace the 8080 with the port number on your XAMMP or MAMP Application)

## Security

- Does not Store plain or unencrypted passwords in the database.
- Does not Offer the ability to inject HTML or “user” JavaScript in badly protected variables.
- Does not Offer the ability to upload unwanted content on the server.
- Does not Offer the possibility of altering an SQL query. (Sql Injections) 
- Does not Use an extern form to manipulate so-called private data

---
## Testing

- [x] The database connection must be done using the PDO interface

- [x] Input forms and upload forms have correct validations

- [x] No SQL injection is possible

- [x] User must be able to sign up, by providing at least an email, a username and a password (secured, a usual current word must not be accepted as a password for instance).

- [x] Subscription must be completed by a confirmation email.

- [x] User must be able to connect using they username and must be able to receive an email to reset his password on demand.

- [x] User disconnection must be possible from anywhere on the site.

- [x] The main page must have a decent presentation : at least a header, a main section and a footer.

- [x] Must be on the editing page, the preview of the webcam, the list of superposable images, the button to take the picture and the history of previously edited images as thumbnails.

- [x] The button to take a picture is clickable only if a superposable image is selected.

- [x] It must be possible to upload an image instead of capturing it with the webcam.

- [x] The gallery displays all images of all site members ordered by creation date. The list of images is paginated.

- [x] Each image must be likeable and commentable.

- [x] When an image receives a comment, the author of the commented image must receive a notification by email.

- [x] A user cen delete only his own creations.

- [x] The editing page is not accessable unles the usser is logged in.

- [x] The gallery is public but only a logged in user can like and comment the pictures.

---
## FAQ

- How do I change the port of the XAMMP or MAMP application 
    - XAMPP: https://stackoverflow.com/questions/11294812/how-to-change-xampp-apache-server-port
    - MAMP: https://documentation.mamp.info/en/MAMP-Mac/Preferences/Ports/
