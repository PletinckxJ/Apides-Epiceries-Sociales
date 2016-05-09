<?php
/**
 * Created by PhpStorm.
 * User: Julien
 * Date: 09/05/2016
 * Time: 15:17
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<title>Contact-Pop - Implementation Example</title>

    <meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />

<link rel="stylesheet" type="text/css" href="Contact-Pop/css/contact-pop.css" />

<!-- include jQuery and Contact-Pop scripts -->
<script type="text/javascript" src="Contact-Pop/js/jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="Contact-Pop/js/contact-pop.js"></script>

<!-- these styles are just to make this page look better and have nothing to do with the overlay -->
<style type="text/css">
    body {
    background: #CCC;
}

/* the body padding has to be 0 for contact-pop to work, so we are using a #main div here to add padding */
#main {
    padding: 20px;
    width: 800px;
    margin: 0 auto;
    background: #FFF;
}
</style>

</head>

<body>

<!-- Make sure you include this somewhere that PHP is enabled, this page doesn't need PHP but the contact script does - you can always rewrite this in another language if you need it -->

<div id="main">

<h1>
Contact-Pop for jQuery - Example
</h1>

<p>
Contact-Pop replaces the links to your contact page with a poééép-up form.
</p>

<p>
By default it pulls in any links that point to "/contact.php".  Along with other options, this can be changed in contact-pop.js.
</p>

<p>
<a href="/contact.php">Click me to see Contact-Pop in action</a>
</p>

<p>
However be careful with your paths, because Contact-Pop pulls in the href value, not the actual url, so "/contact.php", "contact.php" and "http://yoururl.com/contact.php" are all different.
</p>

<p>
<a href="http://jonraasch.com/blog/contact-pop-jquery-plugin">Check out the original post for more info</a>
</p>

<h2>
Troubleshooting
</h2>

<p><strong>The overlay pops up, but the form doesn't load</strong></p>

<p>
Make sure you are including this somewhere with PHP enabled, and that you have the correct path to contact-pop.php (this is set in contact-pop.js)
</p>

<p><strong>The overlay doesn't show</strong></p>

<p>
Make sure you are including the Javascript files correctly: Contact-Pop needs contact-pop.js as well as jquery.js (jquery-1.3.2.min.js works as well)
</p>

<p><strong>The overlay doesn't cover the entire page</strong></p>

<p>
Make sure that the margin/padding on your body and html tags are set to 0
</p>

<p><strong>Contact-Pop is removing the margin / padding from my page</strong></p>

<p>
Contact-Pop sets the margin and padding of the body and html elements to 0.  If you need margin or padding, try assigning it to a wrapper.
</p>

</div>

</body>
</html>