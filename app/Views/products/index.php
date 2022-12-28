<?= $this->extend('layout') ?>
<?= $this->section('content') ?>


<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            List Product
            <a href="<?= base_url('product/create'); ?>" class="btn btn-primary float-right">Tambah</a>

          </div>
          <div class="card-body">

            <?php if (!empty(session()->getFlashdata('success'))) : ?>
            <div class="alert alert-success">
              <?= session()->getFlashdata('success') ?>
            </div>
            <?php endif ?>

            <?php if (!empty(session()->getFlashdata('info'))) : ?>
            <div class="alert alert-info">
              <?= session()->getFlashdata('info') ?>
            </div>
            <?php endif ?>

            <?php if (!empty(session()->getFlashdata('warning'))) : ?>
            <div class="alert alert-warning">
              <?= session()->getFlashdata('warning') ?>
            </div>
            <?php endif ?>

            <div class="row">
              <div class="col-md-6">
                <?php
                // echo form_label('Category');
                // echo form_dropdown('category', $categories, $category, ['class' => 'form-control', 'id' => 'category']) 
                ?>

                <!-- <label for="">Category Product</label>
                <select name="category_id" id="" class="form-control ">
                  <option value="">Choose Product Category</option>
                  <?php foreach ($categories as $e) :  ?>
                  <option value="<?= $e['category_id']; ?>"><?= $e['category_name']; ?></option>
                  <?php endforeach ?>
                </select> -->
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <?php
                  echo form_label('Search');
                  $formKeyword = [
                    'type'  => 'text',
                    'name'  => 'keyword',
                    'id'  => 'keyword',
                    'value' => $keyword,
                    'class' => 'form-control',
                    'placeholder' => 'Enter Keyword.'
                  ];
                  echo form_input($formKeyword);
                  ?>
                </div>
              </div>
            </div>

            <div class="table-responsive">
              <table class="table table-bordered table-hovered">
                <thead>
                  <tr align="center">
                    <th>No</th>
                    <th>Thumbnail</th>
                    <th>SKU</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($product as $key => $row) : ?>
                  <tr>
                    <td><?php echo $key + 1; ?></td>
                    <td><img class="img-thumbnail" src="<?= base_url('img/' . $row['product_image'])  ?>" width=100px
                        alt="<?= $row['product_image']; ?>"></td>
                    <td><?php echo $row['product_sku']; ?></td>
                    <td><?php echo $row['product_name']; ?></td>
                    <td><?php echo $row['category_status']; ?></td>
                    <td><?php echo 'Rp.' . number_format($row['product_price'], 2, ',', '.'); ?></td>
                    <td><?php echo $row['product_status']; ?></td>
                    <td>
                      <div class="btn-group">
                        <a href="<?= base_url('product/show/' . $row['product_id']); ?>" class="btn btn-sm btn-info">
                          <i class="fa fa-eye"></i>
                        </a>
                        <a href="<?= base_url('product/edit/' . $row['product_id']); ?>" class="btn btn-sm btn-success">
                          <i class="fa fa-edit"></i>
                        </a>
                        <a href="<?= base_url('product/delete/' . $row['product_id']); ?>" class="btn btn-sm btn-danger"
                          onclick="return confirm('Apakah Anda yakin ingin menghapus kategori ini?');">
                          <i class="fa fa-trash-alt"></i>
                        </a>
                      </div>
                    </td>
                  </tr>
                  <?php endforeach ?>
                </tbody>
              </table>

            </div>
            <div class="row-mt-3 float-right">
              <div class="col-md">
                <?= $pager->links('default', 'bootstrap_pagination') ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?= $this->endSection() ?>