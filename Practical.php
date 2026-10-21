<!DOCTYPE html>
<html>
<body>
    <form method="POST">
        <label for="title">Book Title:</label><br>
        <input type="text" id="title" name="title"><br><br>

        <label for="author">Author:</label><br>
        <input type="text" id="author" name="author"><br><br>

        <input type="submit" value="Submit">
    </form>

<?php
class Book {
    public $title;
    public $author;

    public function __construct($title, $author) {
        $this->title = $title;
        $this->author = $author;
    }

    public function displayInfo() {
        echo "Title: " . $this->title . "<br>";
        echo "Author: " . $this->author . "<br>";
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $author = $_POST['author'];

    $book = new Book($title, $author);
    $book->displayInfo();
}
?>

</body>
</html>
