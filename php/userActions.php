<?php
/**
 * Created by PhpStorm.
 * User: www
 * Date: 12.07.2018
 * Time: 16:42
 */
session_start();

if (!isset($_SESSION['u_login'])) {
    echo '  <ul>
                <li><a href="index.php">Home</a></li>
            </ul>

            <div class="nav-login" id="nav-login">
                <form action="includes/login.inc.php" method="post">
                    <input type="text" name="login" placeholder="Login/Email">
                    <input type="password" name="pwd" placeholder="Password">
                    <button type="submit" name="submit">Login</button>
                </form>
                <a href="signup.php">Sign Up</a>
            </div>';
} else {
    echo '  <ul>
                <li><a href="index.php">Home</a></li>
            </ul>

            <div class="nav-login" id="nav-login">
                <form action="includes/logout.inc.php" method="post">
                    <button type="submit" name="submit">Logout</button>
                </form>
            </div>';
}
