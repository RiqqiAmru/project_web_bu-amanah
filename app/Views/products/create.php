<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <form enctype="multipart/form-data" action="<?php echo base_url('product/store'); ?>" method="post">
          <div class="card">
            <div class="card-body">
              <input type="hidden" name="product_id" id="" value="">
              <div class="form-group">
                <label for="">Category Product</label>
                <select name="category_id" id="" class="form-control <?= ($validation->hasError('category_id')) ? 'is-invalid' : ''; ?>">
                  <option value="">Choose Product Category</option>
                  <?php foreach ($category as $e) :  ?>
                    <option <?= old('category_id') == $e['category_id'] ? 'selected' : '' ?> value="<?= $e['category_id']; ?>"><?= $e['category_name']; ?></option>
                  <?php endforeach ?>
                </select>
                <div class="invalid-feedback">
                  <?= $validation->getError('category_id'); ?>
                </div>
              </div>
              <div class="form-group">
                <label for="">Name</label>
                <input type="text" class="form-control <?= ($validation->hasError('product_name')) ? 'is-invalid' : ''; ?>" name="product_name" placeholder="Enter Product name" value="<?= old('product_name'); ?>">
                <div class="invalid-feedback">
                  <?= $validation->getError('product_name'); ?>
                </div>
              </div>
              <div class="form-group">
                <label for="">Price</label>
                <input type="number" class="form-control <?= ($validation->hasError('product_price')) ? 'is-invalid' : ''; ?>" name="product_price" placeholder="Enter Product Price" value="<?= old('product_price'); ?>">
                <div class="invalid-feedback">
                  <?= $validation->getError('product_price'); ?>
                </div>
              </div>
              <div class="form-group">
                <label for="">SKU</label>
                <input type="text" class="form-control <?= ($validation->hasError('product_sku')) ? 'is-invalid' : ''; ?>" name="product_sku" placeholder="Enter Product SKU" value="<?= old('product_sku'); ?>">
                <div class="invalid-feedback">
                  <?= $validation->getError('product_sku'); ?>
                </div>
              </div>
              <div class="form-group">
                <label for="">Status</label>
                <select name="product_status" id="" class="form-control <?= ($validation->hasError('product_status')) ? 'is-invalid' : ''; ?>">
                  <option value="">Choose Product Status</option>
                  <option <?= old('product_status') == 'Active' ? 'selected' : '' ?> value="Active">Active</option>
                  <option <?= old('product_status') == 'Inactive' ? 'selected' : '' ?> value="Inactive">Inactive</option>
                </select>
                <div class="invalid-feedback">
                  <?= $validation->getError('product_status'); ?>
                </div>
              </div>
              <label for="gambar-produk">Product Image</label>
              <div class="form-group row">
                <div class="col-sm-2">
                  <img src="/img/default-150x150.png" alt="gambar terupload" class="img-thumbnail img-preview">
                </div>
                <div class="col-sm-10">
                  <div class="custom-file mb-3">
                    <input type="file" class="custom-file-input <?= ($validation->hasError('product_image')) ? 'is-invalid' : ''; ?>" id="gambar-produk" name="product_image" onchange="previewImg()">
                    <label class="custom-file-label" for="product_image">Choose file</label>
                    <div class="invalid-feedback">
                      <?= $validation->getError('product_image'); ?>
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label for="" class="form-label">Descripton</label>
                <textarea class="form-control <?= ($validation->hasError('product_description')) ? 'is-invalid' : ''; ?>" name="product_description" rows="3" placeholder="Enter Product Description"><?= old('product_description'); ?></textarea>
                <div class="invalid-feedback">
                  <?= $validation->getError('product_description'); ?>
                </div>
              </div>
            </div>
            <div class="card-footer">
              <a href="<?= base_url('product'); ?>" class="btn btn-outline-info">Back</a>
              <button type="submit" class="btn btn-primary float-right">Simpan</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<?= $this->endSection() ?>