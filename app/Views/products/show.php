<?= $this->extend('layout') ?>
<?= $this->section('content') ?>


<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-body row">
            <div class="col-md-4">
              <img src="/img/<?= $product['product_image'] ?>" class="img-fluid" alt="<?= $product['product_image']; ?>">
            </div>
            <div class="col-md-8 ">
              <dl class="row">
                <dt class="col-sm-4 ">SKU / Kode Produk</dt>
                <dd class="col-sm-8"><?= $product['product_sku']; ?></dd>
                <dt class="col-sm-4 ">Kategori Produk</dt>
                <dd class="col-sm-8"><?= $product['category_name']; ?></dd>
                <dt class="col-sm-4 ">Nama Produk</dt>
                <dd class="col-sm-8"><?= $product['product_name']; ?></dd>
                <dt class="col-sm-4 ">Harga Produk</dt>
                <dd class="col-sm-8">Rp.<?= number_format($product['product_price'], 2, ',', '.'); ?></dd>
                <dt class="col-sm-4 ">Status Produk</dt>
                <dd class="col-sm-8"><?= $product['product_status']; ?></dd>
                <dt class="col-sm-4 ">DeskripsiProduk</dt>
                <dd class="col-sm-8"><?= $product['product_description']; ?></dd>
              </dl>
            </div>
          </div>
          <div class="card-footer">
            <a href="/product" class="btn btn-outline-info float-right">Back</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?= $this->endSection() ?>