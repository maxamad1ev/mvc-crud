<?php
require_once 'models/Post.php';

class PostController
{
    private $model;

    public function __construct()
    {
        $this->model = new Post();
        session_start();
    }

    public function index()
    {
        $posts = $this->model->all();
        require 'views/posts/index.php';
    }

    public function create()
    {
        require 'views/posts/create.php';
    }

    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            require 'views/utilities/404.php';
            return;
        }

        $title = $_POST['title'];
        $content = $_POST['content'];
        $author_name = $_SESSION['user']['name'];
        $image = $_FILES['image']['name'];

        if (empty($title) || empty($content)) {
            $_SESSION['message'] = 'Заголовок и Содержание не могут быть пустыми';
            require 'views/posts/create.php';
            return;
        }

        if ($image) {
            $target_dir = "uploads/";
            $target_file = $target_dir . basename($image);
            move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
        }

        $data = [
            'title' => $title,
            'content' => $content,
            'image' => $image,
            'author_name' => $author_name
        ];

        if ($this->model->create($data)) {
            $_SESSION['message'] = 'Пост успешно создан';
            header('Location: /posts');
        }
    }

    public function show()
    {
        $id = $_GET['id'];
        $post = $this->model->find($id);

        if (!$post) {
            require 'views/utilities/404.php';
            return;
        }

        require 'views/posts/show.php';
    }

    public function edit()
    {
        $id = $_GET['id'];
        $post = $this->model->find($id);

        if (!$post) {
            require 'views/utilities/404.php';
            return;
        }

        require 'views/posts/edit.php';
    }

    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            require 'views/utilities/404.php';
            return;
        }

        $id = $_GET['id'];
        $post = $this->model->find($id);

        if (!$post) {
            require 'views/utilities/404.php';
            return;
        }

        $title = $_POST['title'];
        $content = $_POST['content'];
        $newImage = $_FILES['image']['name'];

        if (empty($title) || empty($content)) {
            $_SESSION['message'] = 'Заголовок и Содержание не могут быть пустыми';
            require 'views/posts/edit.php';
            return;
        }

        $image = $post['image'];
        if ($newImage) {
            $target_dir = "uploads/";
            $target_file = $target_dir . basename($newImage);

            if (!empty($post['image']) && file_exists($target_dir . $post['image'])) {
                unlink($target_dir . $post['image']);
            }

            move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
            $image = $newImage;
        }

        $data = [
            'title' => $title,
            'content' => $content,
            'image' => $image,
        ];

        if ($this->model->update($id, $data)) {
            $_SESSION['message'] = 'Пост успешно обновлен';
            header('Location: /posts');
        }
    }

    public function delete()
    {
        $id = $_GET['id'];
        $post = $this->model->find($id);

        if (!$post) {
            require 'views/utilities/404.php';
            return;
        }

        $imagePath = 'uploads/' . $post['image'];
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }

        if ($this->model->delete($id)) {
            $_SESSION['message'] = 'Пост и связанное изображение успешно удалены';
            header('Location: /posts');
        } else {
            $_SESSION['message'] = 'Не удалось удалить пост';
            header('Location: /posts');
        }
        exit();
    }
}
?>
