<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Post</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <style>
        .container {
            margin-top: 40px;
        }
        h1 {
            margin-bottom: 20px;
        }
        .form-control, .btn {
            margin-bottom: 15px;
        }
        .img-thumbnail {
            margin-top: 10px;
            max-width: 200px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Edit Post</h1>
        <?php if (isset($_SESSION['message'])): ?>
            <div class="alert alert-info">
                <?php echo $_SESSION['message']; ?>
            </div>
            <?php unset($_SESSION['message']); ?>
        <?php endif; ?>
        <form action="/posts/update?id=<?php echo $post['id']; ?>" method="POST" enctype="multipart/form-data">
            <div>
                <label for="title">Title</label>
                <input type="text" id="title" name="title" class="form-control" value="<?php echo htmlspecialchars($post['title']); ?>" required>
            </div>
            <div>
                <label for="content">Content</label>
                <textarea id="content" name="content" class="form-control" rows="5" required><?php echo htmlspecialchars($post['content']); ?></textarea>
            </div>
            <div>
                <label for="image">Image</label>
                <input type="file" id="image" name="image" class="form-control">
                <?php if ($post['image']): ?>
                    <img src="uploads/<?php echo htmlspecialchars($post['image']); ?>" class="img-thumbnail" alt="Current Image">
                <?php endif; ?>
            </div>
            <div>
                <button type="submit" class="btn btn-primary">Update Post</button>
                <a href="/posts" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>
