<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            List Category
            <a href="<?= base_url('category/create'); ?>" class="btn btn-primary float-right">Tambah</a>
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

            <div class="table-responsive">
              <table class="table table-bordered table-hovered">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($categories as $key => $row) : ?>
                    <tr>
                      <td><?php echo $key + 1; ?></td>
                      <td><?php echo $row['category_name']; ?></td>
                      <td><?php echo $row['category_status']; ?></td>
                      <td>
                        <div class="btn-group">
                          <a href="<?= base_url('category/edit/' . $row['category_id']); ?>" class="btn btn-sm btn-success">
                            <i class="fa fa-edit"></i>
                          </a>
                          <a href="<?= base_url('category/delete/' . $row['category_id']); ?>" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus kategori ini?');">
                            <i class="fa fa-trash-alt"></i>
                          </a>
                        </div>
                      </td>
                    </tr>
                  <?php endforeach ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?= $this->endSection() ?>