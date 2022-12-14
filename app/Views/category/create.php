<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <form action="<?php echo base_url('category/store'); ?>" method="post">
          <div class="card">
            <div class="card-body">
              <?php
              $input = [
                'category_status' => '',
                'category_name' => ''
              ];
              if (!empty(session()->getFlashdata('input'))) {
                $input = session()->getFlashdata('input');
              }
              $error = session()->getFlashdata('errors');
              if (!empty($error)) :  ?>
                <div class="alert alert-danger" role="alert">
                  Whoops! Ada kesalahan saat input data, yaitu:

                  <ul>
                    <?php foreach ($error as $e) :  ?>
                      <li><?= esc($e) ?></li>
                    <?php endforeach ?>
                  </ul>
                </div>
              <?php endif ?>
              <div class="form-group">
                <label for="">Name</label>
                <input type="text" class="form-control" name="category_name" placeholder="Enter category name" value="<?php echo $input['category_name']; ?>">
              </div>
              <div class="form-group">
                <label for="">Status</label>
                <select name="category_status" id="" class="form-control">
                  <option value="">Pilih Kategori</option>
                  <option <?= $input['category_status'] == 'Active' ? 'selected' : '' ?> value="Active">Active</option>
                  <option <?= $input['category_status'] == 'Inactive' ? 'selected' : '' ?> value="Inactive">Inactive</option>
                </select>
              </div>
            </div>
            <div class="card-footer">
              <a href="<?= base_url('category'); ?>" class="btn btn-outline-info">Back</a>
              <button type="submit" class="btn btn-primary float-right">Simpan</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<?= $this->endSection() ?>