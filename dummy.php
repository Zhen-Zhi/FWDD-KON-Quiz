<!DOCTYPE html>
<html>
    <head>
        <title>KON Quiz</title>
        <meta name="description" content="Our first page">
        <meta name="keywords" content="html tutorial template">
    </head>
    
    <body>
        <?php session_start();?>
        <h3>Login homepage test.</h3>
        <?php echo "This is the data of the user: ". $_SESSION['username'];?>
        <?php echo "<br>This is the data of the user: ". $_SESSION['email'];?>
    </body>
</html>