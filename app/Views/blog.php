<div class="container">
  <div class="row">
    <div class="col-12">
      <h1 class="blog-title"><?= $blog['title'] ?></h1>
    </div>
  </div>

  <div class="row mt-4">
    <div class="col-12">
      <img src="<?= base_url('uploads/' . $blog['image']) ?>" class="img-fluid blog-image" alt="Blog Image">
    </div>
  </div>

  <div class="row mt-4">
    <div class="col-12 text-center">
      <div class="blog-content-container">
        <p class="blog-content"><?= $blog['content'] ?></p>
        <p><?= $blog['created_at'] ?></p>
      </div>
    </div>
  </div>
</div>

<style>
  .blog-title {
    font-size: 36px;
    font-family: 'Arial', sans-serif;
    color: #fff;
    text-align: center;
    margin-top: 40px;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
    font-weight: bold;
  }

  .blog-image {
    border: 2px solid #fff;
    border-radius: 5px;
    max-width: 100%;
    display: block;
    margin: 0 auto;
  }

  .blog-content-container {
    border: 2px solid #fff;
    border-radius: 5px;
    background-color: #fff;
    padding: 20px;
  }

  .blog-content {
    font-family: 'Arial', sans-serif;
    color: #333;
    text-align: justify;
  }

  .blog-page {
    margin: 20px;
  }
</style>
