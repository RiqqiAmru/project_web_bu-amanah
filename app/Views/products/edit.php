<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <form enctype="multipart/form-data" action="<?php echo base_url('product/update/' . $product[0]['product_id']); ?>" method="POST">
          <input type="hidden" name="product_id">
          <input type="hidden" name="gambar_lama" value="<?= $product[0]['product_image']; ?>">
          <div class="card">
            <div class="card-body">
              <div class="form-group">
                <label for="">Category Product</label>
                <select name="category_id" id="" class="form-control <?= ($validation->hasError('category_id')) ? 'is-invalid' : ''; ?>">
                  <?php (old('category_id')) ? $oldCat = old('category_id') : $oldCat = $product[0]['category_id'] ?>
                  <option value="">Choose Product Category</option>
                  <?php foreach ($category as $e) :  ?>
                    <option <?= $oldCat == $e['category_id'] ? 'selected' : '' ?> value="<?= $e['category_id']; ?>"><?= $e['category_name']; ?></option>
                  <?php endforeach ?>
                </select>
                <div class="invalid-feedback">
                  <?= $validation->getError('category_id'); ?>
                </div>
              </div>
              <div class="form-group">
                <label for="">Name</label>
                <input type="text" class="form-control <?= ($validation->hasError('product_name')) ? 'is-invalid' : ''; ?>" name="product_name" placeholder="Enter Product name" value="<?= (old('product_name')) ? old('product_name') : $product[0]['product_name']; ?>">
                <div class="invalid-feedback">
                  <?= $validation->getError('product_name'); ?>
                </div>
              </div>
              <div class="form-group">
                <label for="">Price</label>
                <input type="number" class="form-control <?= ($validation->hasError('product_price')) ? 'is-invalid' : ''; ?>" name="product_price" placeholder="Enter Product Price" value="<?= (old('product_price')) ? old('product_price') : $product[0]['product_price']; ?>">
                <div class="invalid-feedback">
                  <?= $validation->getError('product_price'); ?>
                </div>
              </div>
              <div class="form-group">
                <label for="">SKU</label>
                <input type="text" class="form-control <?= ($validation->hasError('product_sku')) ? 'is-invalid' : ''; ?>" name="product_sku" placeholder="Enter Product SKU" value="<?= (old('product_sku')) ? old('product_sku') : $product[0]['product_sku']; ?>">
                <div class="invalid-feedback">
                  <?= $validation->getError('product_sku'); ?>
                </div>
              </div>
              <div class="form-group">
                <label for="">Status</label>
                <select name="product_status" id="" class="form-control <?= ($validation->hasError('product_status')) ? 'is-invalid' : ''; ?>">
                  <?php (old('product_status')) ? $status = old('product_status') : $status = $product[0]['product_status'] ?>
                  <option value="">Choose Product Status</option>
                  <option <?= $status == 'Active' ? 'selected' : '' ?> value="Active">Active</option>
                  <option <?= $status == 'Inactive' ? 'selected' : '' ?> value="Inactive">Inactive</option>
                </select>
                <div class="invalid-feedback">
                  <?= $validation->getError('product_status'); ?>
                </div>
              </div>
              <label for="gambar-produk">Product Image</label>
              <div class="form-group row">
                <div class="col-sm-2">
                  <img src="/img/<?= $product[0]['product_image']; ?>" alt="gambar terupload" class="img-thumbnail img-preview">
                </div>
                <div class="col-sm-10">
                  <div class="custom-file mb-3">
                    <input type="file" class="custom-file-input <?= ($validation->hasError('product_image')) ? 'is-invalid' : ''; ?>" id="gambar-produk" name="product_image" onchange="previewImg()">
                    <label class="custom-file-label" for="product_image"><?= $product[0]['product_image']; ?></label>
                    <div class="invalid-feedback">
                      <?= $validation->getError('product_image'); ?>
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label for="">Descripton</label>
                <textarea class="form-control <?= ($validation->hasError('product_description')) ? 'is-invalid' : ''; ?>" name="product_description" rows="3" placeholder="Enter Product Description"><?= (old('product_description')) ? old('product_description') : $product[0]['product_description']; ?></textarea>
                <div class="invalid-feedback">
                  <?= $validation->getError('product_description'); ?>
                </div>
              </div>
            </div>
            <div class="card-footer">
              <a href="<?php echo base_url('product'); ?>" class="btn btn-outline-info">Back</a>
              <button type="submit" class="btn btn-primary float-right">Update</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>


<?= $this->endSection() ?>