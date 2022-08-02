<?php
/**
 * Layout header
 *
 * @var Controller $this
 * @link https://getbootstrap.com/docs/3.3.7/components/#navbar
 */

use mvc\Controller;

?>

<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">Logo</a>
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li><a href="/">Home page</a></li>
                <li><a href="#">Login</a></li>
                <li><a href="#">Add entry</a></li>
                <li><a href="#">Logout</a></li>
            </ul>
        </div>
    </div>
</nav>
