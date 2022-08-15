<!-- DRUPAL & SPOTIFY LOGO -->
<br />
<p align="center">
  <a>
    <img src="https://www.drupal.org/files/cta/graphic/Wordmark2_white_RGB.svg" alt="Logo" width="300" height="200">
  </a>
  <a>
    <img src="https://www.freepnglogos.com/uploads/spotify-logo-png/spotify-icon-marilyn-scott-0.png" alt="Logo" width="200" height="200">
  </a>

  <h3 align="center">Jobsity Drupal Challenge</h3>

  <p align="center">
    <a href="https://github.com/ferox/jobsity-drupal-challenge/issues">Report a bug</a>
    ·
    <a href="https://github.com/ferox/jobsity-drupal-challenge/issues">Improvements</a>
  </p>
</p>

<!--ÍNDICE -->
<details open="open">
  <summary>Index</summary>
  <ol>
    <li>
      <a href="#about-the-challenge">About the Challenge</a>
      <ul>
        <li><a href="#technologies">Technologies</a></li>
      </ul>
    </li>
    <li>
      <a href="#kickstart">Kickstart</a>
      <ul>
        <li><a href="#requirements">Requirements</a></li>
      </ul>
    </li>
    <li>
      <a href="#step-by-step">Step-by-step</a>
      <ul>
        <li><a href="#create-the-landos-containers">Create the Lando's containers</a></li>
        <li><a href="#install-the-project-with-composer">Install the project with composer</a></li>
        <li><a href="#import-the-database-with-lando">Import the database with Lando</a></li>
        <li><a href="#access-the-app-from-the-browser">Access the app from the browser</a></li>
      </ul>
    </li>
    <li><a href="#license">License</a></li>
  </ol>
</details>

<!-- ABOUT -->
## About the Challenge

The objective of this challenge is to implement a mini site using Drupal 8 or 9. The site should contain information about ​​music.

### Technologies

* [PHP](https://www.php.net/)
* [Bootstrap 5](https://getbootstrap.com/docs/5.0/getting-started/introduction/)
* [JQuery (Drupal built-in)](https://jquery.com)
* [Drupal 9](https://www.drupal.org/about/9)
* [Twig 2](https://twig.symfony.com/doc/2.x/)
* [Apache 2](https://www.apache.org/)
* [Lando](https://lando.dev/)


<!-- KICKSTART -->
## Kickstart

First of all install all the requirements techs from below. After that you need to clone the repo.

### Requirements

Make sure you have the same version of Docker + Lando:
* Docker - 20.10.17, build 100c701
  ```sh
  docker -v
  ```
* Lando - v3.6.4
  ```sh
  lando version
  ```
## Step-by-Step

### Create the Lando's containers

* Clone the repo
  ```sh
  git clone https://github.com/ferox/jobsity-drupal-challenge.git
  ```
* Make sure you are on the correct directory - ~/your_home_dir/jobsity-drupal-challenge
  ```sh
  pwd
  ```
* Create/Start the containers
  ```sh
  lando start
  ```
### Install the project with composer

* Composer install running by Lando
  ```sh
  lando composer install
  ```
### Import the database with Lando

* Download the kickstart database here: [https://drive.google.com/file/d/1KhmWy6y_9upUoTR1tH4cHJQmgjUnp6fx/view](https://drive.google.com/file/d/1KhmWy6y_9upUoTR1tH4cHJQmgjUnp6fx/view)
* Place the compressed file on the root of the project directory - ~/your_home_dir/jobsity-drupal-challenge
  ```sh
  pwd
  ```
* Import the database
  ```sh
  lando db-import kickstart-spotify-client-app.sql.gz
  ```
### Access the app from the browser

[https://jobsity-drupal-challenge.lndo.site/](https://jobsity-drupal-challenge.lndo.site/)

## License

[GNU General Public License v3](https://www.gnu.org/licenses/gpl-3.0.en.html)
