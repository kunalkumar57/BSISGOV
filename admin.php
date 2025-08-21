<?php
include 'cms/config.php';
$current_time = date('Y-m-d H:i:s');
$sql = "SELECT * FROM news_articles WHERE status = 'published' AND (publication_date IS NULL OR publication_date <= ?) ORDER BY publication_date DESC LIMIT 3";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $current_time);
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Website - News</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <a class="navbar-brand" href="index.html">My Website</a>
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="index.html">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="news.php">News</a></li>
                </ul>
            </div>
        </nav>
    </header>
    <main class="container my-5">
        <h1>Latest News</h1>
        <div class="row">
            <?php while($row = $result->fetch_assoc()): ?>
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <?php if (!empty($row['image_path'])): ?>
                    <img src="<?php echo $row['image_path']; ?>" class="card-img-top" alt="<?php echo htmlspecialchars($row['alt_text']); ?>">
                    <?php endif; ?>
                    <div class="card-body">
                        <h5 class="card-title"><?php echo htmlspecialchars($row['headline']); ?></h5>
                        <p class="card-text"><?php echo substr(nl2br(htmlspecialchars($row['content'])), 0, 150) . '...'; ?></p>
                        <p class="card-text"><small class="text-muted">Published on: <?php echo $row['publication_date']; ?></small></p>
                    </div>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
    </main>
    <footer class="bg-dark text-white text-center py-3">
        <p>&copy; <?php echo date('Y'); ?> My Website. All rights reserved.</p>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php
$stmt->close();
$conn->close();
?>