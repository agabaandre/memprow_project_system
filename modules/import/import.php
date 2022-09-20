<div class="col-md-12">
  <div class="nav-tabs-custom">
    <ul class="nav nav-tabs">
      <li class="active"><a href="dashboard.php?action=import">Import Employee Records</a></li>
      <li class=""><a href="dashboard.php?action=register">Register New Employee</a></li>
      <li class=""><a href="dashboard.php?action=passport">Add Passport size Photo</a></li>

    </ul>
  </div>

  <div class="box-header with-border">
    <h3 class="box-title">Import Multiple Employee Records</h3>
  </div>
  <div class="col-md-6">
    <style type="text/css">
      #importFrm {
        margin-bottom: 0px;
        display: none;
      }

      #importFrm input[type=file] {
        display: inline;
      }
    </style>

    <p> Supported file Format .csv</p>
    <div class="panel panel-default">
      <div class="panel-heading">
        <label>The file has Headers</label><input type="checkbox" class="btn btn-primary" name="fileheaders" checked>
        <a href="javascript:void(0);" class="btn btn-default" onclick="$('#importFrm').slideToggle();">Import Employees</a>
      </div>
      <div class="panel-body">
        <form action="modules/import/importData.php" method="post" enctype="multipart/form-data" id="importFrm">
          <input type="file" name="file" />
          <input type="submit" class="btn btn-primary" name="importSubmit" value="IMPORT">

        </form>
      </div>
    </div>
  </div>
  <div class="col-md-6">
  </div>