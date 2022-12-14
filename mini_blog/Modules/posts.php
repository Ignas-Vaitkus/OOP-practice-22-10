<?php

//Possible to make the class itself make the connection and then close the connection with a destructor

class Posts
{
    public static function getPosts(mysqli $conn): mysqli_result
    {
        $sql = 'SELECT * FROM blog_database.posts;';
        return mysqli_query($conn, $sql);
    }
    public static function getPost(mysqli $conn, int $id): mysqli_result
    {
        $sql = "SELECT * FROM blog_database.posts WHERE id = $id;";

        return mysqli_query($conn, $sql);
    }
    public static function getPostTitle(mysqli $conn, int $id): string
    {
        $sql = "SELECT title FROM blog_database.posts WHERE id = $id;";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        return $row['title'];
    }
    public static function getPostContent(mysqli $conn, int $id): string
    {
        $sql = "SELECT content FROM blog_database.posts WHERE id = $id;";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        return $row['content'];
    }
    public static function getPostImage(mysqli $conn, int $id): string
    {
        $sql = "SELECT image FROM blog_database.posts WHERE id = $id;";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        return $row['image'];
    }
    public static function getPostDate(mysqli $conn, int $id): string
    {
        $sql = "SELECT createdAt FROM blog_database.posts WHERE id = $id;";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        return $row['createdAt'];
    }
    public static function createPost(mysqli $conn, string $title, string $content, string $image = null): void
    {
        $titleLengthOK = strlen($title) <= 255;
        $imageLengthOK = strlen($image) <= 255;

        if (!$titleLengthOK) {
            throw new LengthException("Title is longer than 255 characters");
        }

        if (!$imageLengthOK) {
            throw new LengthException("Image URL is longer than 255 characters");
        }

        //Do not try to set if exceptions were thrown.

        if (!$titleLengthOK || !$imageLengthOK)
            return;

        $sql = "INSERT INTO blog_database.posts (title, content, image) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('sss', $title, $content, $image);
        $stmt->execute();
        $stmt->close();
    }

    public static function updatePost(mysqli $conn, int $id, string $field, string $value): void
    {

        if ($field == 'title' || $field = 'image') {

            $sql = "UPDATE blog_database.posts $field = ? WHERE id = $id";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('s', $value);
            $stmt->execute();
            $stmt->close();
        } elseif ($field == 'createdAt' || $field == 'id') {
            throw new InvalidArgumentException("Blog post $field field cannot be changed.");
        } else {
            throw new InvalidArgumentException("Blog post field does not exist.");
        }
    }

    public static function deletePost(mysqli $conn, int $id): void
    {
        $sql = "DELETE FROM blog_database.posts WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $stmt->close();
    }
}
