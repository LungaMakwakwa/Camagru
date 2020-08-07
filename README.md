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
- [Testing](#Testing)
- [Security](#Security)
- [FAQ](#FAQ)
---

## Requirements

- Have `XAMPP` or `MAMP` installed.
- PHP 7.0 or above.

## Installation

- Clone the repo
- Place the `camagru` directory in the `htdocs` directory of the `MAMP` or `XAMPP` application.
- Run the `XAMPP` or `MAMP` you can edit the port number but the defualt port is usually `80` or `8080`.
- To build the database run the setup.php file. => http://localhost:8080/camagru/config/setup.php (Replace the 8080 with the port number on your XAMMP or MAMP Application)
- Then run http://localhost:8080/camagru/ to open access the site. (Replace the 8080 with the port number on your XAMMP or MAMP Application)

## Testing

## Security

- Store plain or unencrypted passwords in the database.
- Offer the ability to inject HTML or “user” JavaScript in badly protected variables.
- Offer the ability to upload unwanted content on the server.
- Offer the possibility of altering an SQL query. (Sql Injections) 
- Use an extern form to manipulate so-called private data

---

## FAQ

- How do I change the port of the XAMMP or MAMP application 
    - XAMPP: https://stackoverflow.com/questions/11294812/how-to-change-xampp-apache-server-port
    - MAMP: https://documentation.mamp.info/en/MAMP-Mac/Preferences/Ports/
