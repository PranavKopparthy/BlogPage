<!-- <div class="container blog-container">
  <div class="row">
    <div class="col-12">
      <h1 class="header-title">Hello, <?= session()->get('firstname') ?></h1>
    </div>
  </div>

  <div class="row mt-4">
    <?php if (!empty($blogs)): ?>
      <?php foreach ($blogs as $blog): ?>
        <div class="col-md-4 mb-4">
          <div class="card blog-gradient-background">
            <div class="card-body">
              <h5 class="card-title"><?= $blog['title']; ?></h5>
              <p class="card-text"><?= $blog['content']; ?></p>
              <p class="card-text">Date: <?= $blog['created_at']; ?></p>
              <a href="<?= route_to('users_show_blog', $blog['id']) ?>" class="btn btn-primary show-blog-btn">Show Blog</a>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    <?php else: ?>
      <div class="col-12">
        <p>No blogs found.</p>
      </div>
    <?php endif; ?>
  </div>
</div>

<style>
  .blog-container {
    padding: 20px;
    max-width: 800px;
    margin: 0 auto;
  }

  .blog-gradient-background {
    background: linear-gradient(to bottom, #007bff, #0056b3); /* Blue gradient colors */
    border: 1px solid #ccc;
    border-radius: 10px;
  }
  .header-title {
    text-align: center;
    font-size: 28px;
    font-family: 'Arial', sans-serif;
    color: #fff;
    margin-bottom: 20px;
  }

  .show-blog-btn {
    background-color: #007bff;
    color: #fff;
    padding: 8px 16px;
    border: none;
    cursor: pointer;
    text-decoration: none;
  }
</style>

 -->
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

<div class="container blog-container">
  <div class="row">
    <div class="col-12">
      <h1 class="header-title">Top Blogs</h1>
    </div>
  </div>

  <div class="row mt-4">
    <?php if (!empty($blogs)): ?>
      <?php foreach ($blogs as $blog): ?>
        <div class="col-md-4 mb-4">
          <div class="card blog-gradient-background">
            <div class="card-body">
              <h5 class="card-title"><?= $blog['title']; ?></h5>
              <p class="card-text"><?= limitWords($blog['content'], 20); ?></p>
              <p class="card-text"><small>Date: <?= $blog['created_at']; ?></small></p>
              <a href="<?= route_to('users_show_blog', $blog['id']) ?>" class="btn btn-primary show-blog-btn">Show Blog</a>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    <?php else: ?>
      <div class="col-12">
        <p>No blogs found.</p>
      </div>
    <?php endif; ?>
  </div>
</div>

<style>
  .blog-container {
    padding: 20px;
    max-width: 800px;
    margin: 0 auto;
  }

  .blog-gradient-background {
    background: linear-gradient(to bottom, #007bff, #0056b3);
    border: none;
    border-radius: 10px;
    box-shadow: 0px 3px 6px rgba(0, 0, 0, 0.16);
    color: #fff;
  }

  .header-title {
    text-align: center;
    font-size: 28px;
    font-family: 'Arial', sans-serif;
    margin-bottom: 20px;
  }

  .card-title {
    font-size: 18px;
    font-weight: bold;
    margin-bottom: 10px;
  }

  .card-text {
    margin-bottom: 10px;
  }

  .show-blog-btn {
    background-color: #007bff;
    color: #fff;
    padding: 8px 16px;
    border: none;
    cursor: pointer;
    text-decoration: none;
  }
</style>
