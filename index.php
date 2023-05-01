<?php
ob_start();
    require_once  'upload.php';
    require_once 'config/database.php';
    $belgesor=$db->prepare("select * from pdf");
    $belgesor->execute();



?>
<!doctype html>
<html lang="tr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <title>File Upload-Download-Preview</title>
  </head>
  <body>
  	<div class="container">
  		<div class="card-body">
        <div class="row">
  			<div class="col-12"><h1>File Upload-Download-Preview</h1></div>
        <div class="col-6"></div>
  			<div class="col-8">
  				<form action="" method="post" enctype="multipart/form-data">
  					<div class="form-group">
  						<label>Dosya Seçiniz</label>
  						<input type="file" name="dosya" class="form-control-file" required />
  					</div>
  					<div class="form-group">
  						<button type="submit" class="btn btn-primary" name="yukle">Upload</button>
  					</div>
          
  				</form>
  			</div>
        
        <div class="col-md-6">

            

              <form method="POST" action="download.php" enctype="multipart/form-data">
          
              <input type="submit" value="Download" class="btn btn-primary">
          </form>
          </div>



           </p>



                              </div>
            </div>

  		</div>
      <?php
        if ($_FILES) {
        if($_FILES['dosya']['error']==0){
          if(isset($_POST["yukle"])){
          $dosya= new Upload($_FILES['dosya']);
          $geciciad=$_FILES['dosya']['name'];
                if($dosya->yukle("upload/")){
          $belgesor=$db->prepare('INSERT INTO pdf set dosya =:dosya');
          $belgesor->execute(array("dosya"=>$geciciad));
            echo '<div class="alert alert-success">Yükleme Başarılı!</div>';
          }
          else {
            echo '<div class="alert alert-danger">Yükleme Başarısız!</div>';
          }
        }
      }
    }


        ?>

  	</div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

  </body>
</html>
