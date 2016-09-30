<html>
<head>
<title>ini</title>
</head>
<body>
<div class="row">
  
  <div class="col-lg-12">
    <!-- Default box -->
    <div class="box">
      <div class="box-body">
        <table id="example1" class="table table-bordered table-hover">
          <thead>
            <tr>
              <th>No.</th>
              <th>id_pengujiansungai</th>
              <th>nama_sungai</th>
              <th>waktu_pengujian</th>
              <th>periode_uji</th>
              
            </tr>
          </thead>
          <tbody>
            <?php
            if($listview->num_rows()>0) {
              $no = 1;
              foreach ($listview->result() as $rows) {
            ?> 
            <tr>
              <td><?php echo $no; ?></td>
             
              <td><?php echo $rows->pengujian_sungai_id ?></td>
              <td><?php echo $rows->nama_sungai ?></td>
              <td><?php echo $rows->waktu_pengujian ?></td>
              <td><?php echo $rows->periode_uji ?></td>
              
            </tr>
            <?php
              $no++;
              }
            }
            ?>
          </tbody>
        </table>
       
      </div><!-- /.box-body -->
    </div><!-- /.box -->
  </div>
</div>
</body>
</html>