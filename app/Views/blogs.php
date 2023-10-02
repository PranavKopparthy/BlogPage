<?php
// Function to limit the number of words in a string
function limitWords($content, $limit)
{
    $words = explode(' ', $content);
    if (count($words) > $limit) {
        $limitedContent = implode(' ', array_slice($words, 0, $limit));
        return $limitedContent . '...';
    }
    return $content;
}
?>

<div class="container">
  <h1 class="blog-title">All Blogs</h1>

  <form method="post" action="<?= base_url('users/filterBlogs') ?>">
    <div class="mb-3">
      <label for="tag" class="form-label">Filter by Tag</label>
      <select class="form-select" id="tag" name="tag">
        <option value="all" <?= ($selectedTag == 'all') ? 'selected' : '' ?>>All</option>
        <?php foreach ($tags as $tag): ?>
          <option value="<?= $tag['id'] ?>" <?= ($tag['id'] == $selectedTag) ? 'selected' : '' ?>>
            <?= $tag['name'] ?>
          </option>
        <?php endforeach; ?>
      </select>
      <button type="submit" class="btn btn-primary">Filter</button>
    </div>
  </form>

  <div class="row">
    <?php foreach ($blogs as $blog): ?>
      <div class="col-md-4">
        <div class="card blog-card">
          <img src="<?= base_url('uploads/' . $blog['image']) ?>" class="card-img-top" alt="Blog Image">
          <div class="card-body">
            <h5 class="card-title text-black"><?= $blog['title'] ?></h5>
            <p class="card-text blog-content"><?= limitWords($blog['content'], 20) ?></p>
            <p class="card-text"><?= $blog['created_at'] ?></p>
            <a href="<?= route_to('users_show_blog', $blog['id']) ?>" class="btn btn-primary">Show Blog</a>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
   <div class="pagination-links">
    <?= $pager->links() ?>
  </div>
</div>

	
  <style>
  body {
    background-color: #fff;
  }

  .blog-title {
    font-size: 36px;
    font-family: 'Arial', sans-serif;
    color: #000;
    text-align: center;
    margin-top: 40px;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
    font-weight: bold;
  }

  .blog-image {
    border: 2px solid #000;
    border-radius: 5px;
    max-width: 100%;
    display: block;
    margin: 0 auto;
  }

  .blog-content-container {
    border: 2px solid #000;
    border-radius: 5px;
    background-color: #fff;
    padding: 20px;
  }

  .blog-content {
    font-family: 'Arial', sans-serif;
    color: #fff;
    text-align: justify;
  }

  .blog-page {
    margin: 20px;
  }

  .blog-card {
    margin-bottom: 20px;
    border: 4px solid #000;
    background: linear-gradient(to bottom right, #000, #000);
  }
    .pagination-links {
    display: flex;
    justify-content: center;
    gap: 10px; /* Adjust the value to increase or decrease the spacing */
    margin-top: 20px;

  }

    .pagination-links a {
    margin: 0 10px; /* Adjust the value to increase or decrease the spacing */
  }


</style>


