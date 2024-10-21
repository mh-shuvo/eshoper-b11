# E-Shoper (B11)
An elegant single vendor E-Commerce solution for bangladeshi people.
## Installation Guide

* Go your desired directory in root directory of local server stack like htdocs, www or etc.
* Open terminal from the root directory
* RUN `git clone https://github.com/mh-shuvo/eshoper-b11.git`
* RUN `cd eshoper-b11`
* RUN `composer install`
* Open `app/Support/constants.php` file using code editor
    - Replace `URLROOT` as per your directory structure.
    - Assume that the project clone into the `projects` directory under the `C://xampp/htdocs`
    - So my `URLROOT` is `http://localhost/project/eshoper-b11`
* Open `public/.htaccess` file using editor
    - Replace the `RewriteBase`. As per the above assumption our `RewriteBase` is `eshoper-b11`
* Update the `DB Credentials` in `config/database.php`
* Now you are done. You can visit the application from browser using the `URLROOT`

