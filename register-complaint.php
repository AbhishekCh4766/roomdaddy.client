<?php
	include "header.php";
	$db=new DBManager();
?>
<style>
input[type=checkbox]
{
  -webkit-appearance:checkbox;
}
</style>
<!---Time Picker Library-->
<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.js"></script>
<script type="text/javascript" src="timepicker/src/wickedpicker.js"></script>
<!---Time Picker Library-->
        <div class="content container-fluid">
         <div class="row row-broken">
            <div class="col-md-12">
              <ol class="breadcrumb">
                <li><a href="index.html"><i class="fa fa-home"></i></a></li>
                <li>Ui Kits</li>
                <li class="active">Inputs</li>
              </ol>
            </div>
          </div>

			
		  
		  <form method="post" action="process/register-complaint-process.php" enctype="multipart/form-data">
            <div class="row decor-primary">
                <div class="col-sm-12">
                    <div class="input-title">Raise a complaint</div>
                </div>
				
				<?php
				$getComplaintType=$db->GetAllComplaintType();
				foreach($getComplaintType as $complainttype)
				{
					?>
					
						<div class="col-sm-3">
							<span class="input input--minoru">
								<label class="input__label input__label--minoru" for="complaint-type<?=$complainttype['fld_id']?>[]">
								<input type="checkbox" id="complaint-type<?=$complainttype['fld_id']?>[]" name="complaint-type[]" value="<?=$complainttype['fld_complaint_type']?>"> <span style="color:white;"><?=$complainttype['fld_complaint_type']?></span>
								<input type="hidden" name="tanent" value="<?=base64_encode($_SESSION[ADMIN_SESSION_NAME]['tanentid'])?>" />
								</label>
							</span>
						</div>
					<?php
				}
				?>
                <div class="col-sm-12">
                    <span class="input input--minoru">
						<input class="input__field input__field--minoru" type="text" name="complaint-description" id="complaint-description" />
                        <label class="input__label input__label--minoru" for="complaint-description">
                            <span class="input__label-content input__label-content--minoru">Complaint Description</span>
                        </label>
                    </span>
                </div>
                <div class="col-sm-12">
                    <span class="input input--minoru">
                        <input class="input__field input__field--minoru" type="time" id="prefer-time" name="prefer-time"/>
						<!--<input type="text" name="timepicker" class="timepicker"/>-->
                        <label class="input__label input__label--minoru" for="prefer-time">
                            <span class="input__label-content input__label-content--minoru">Prefer Time</span>
                        </label>
                    </span>
                </div>
                <div class="col-sm-12">
                    <span class="input input--minoru">
                        <input class="input__field input__field--minoru" type="date" id="prefer-date" name="prefer-date"/>
						<!--<input type="text" name="timepicker" class="timepicker"/>-->
                        <label class="input__label input__label--minoru" for="prefer-date">
						
                            <span class="input__label-content input__label-content--minoru">Prefer date</span>
                        </label>
                    </span>
                </div>
                <div class="col-sm-12">
                    <span class="input input--minoru minoru_input_fild">
                        <!--<input class="input__field input__field--minoru" type="file" id="image1" name="image1"/>-->
						
						<input id="uploadFile1" placeholder="Choose File" disabled="disabled" />
						<div class="fileUpload btn btn-primary">
							<span>Upload</span>
							<input id="image1" type="file" class="upload" name="image1"/>
						</div>
						
						<!--<input type="text" name="timepicker" class="timepicker"/>-->
                        <label class="input__label input__label--minoru" for="attachment1">
						
                            <!--<span class="input__label-content input__label-content--minoru">Attachment</span>-->
                        </label>
                    </span>
                </div>
                <div class="col-sm-12">
                    <span class="input input--minoru minoru_input_fild">
					
						<input id="uploadFile2" placeholder="Choose File" disabled="disabled" />
						<div class="fileUpload btn btn-primary">
							<span>Upload</span>
							<input id="image2" type="file" class="upload" name="image2"/>
						</div>
					
					<!--
                        <input class="input__field input__field--minoru" type="file" id="image2" name="image2"/>
						
                        <label class="input__label input__label--minoru" for="attachment2">
						
                            <span class="input__label-content input__label-content--minoru">Attachment</span>
                        </label>-->
                    </span>
                </div>
                <div class="col-sm-12">
                    <span class="input input--minoru minoru_input_fild">
                        
						
						<input id="uploadFile3" placeholder="Choose File" disabled="disabled" />
						<div class="fileUpload btn btn-primary">
							<span>Upload</span>
							<input id="image3" type="file" class="upload" name="image3"/>
						</div>
						<!--<input class="input__field input__field--minoru" type="file" id="image3" name="image3"/>-->
                        <label class="input__label input__label--minoru" for="attachment3">
						
                        </label>
                    </span>
                </div>
				
				
                <div class="col-sm-12">
                    <span class="input input--minoru">
					 <input type="submit" value="Send" class="btn btn-success btn-round" />
                    </span>
                </div>
				
            </div>
            </form>
        </div>
        <div class="footer">
            © 2015 Copyright.
        </div>
    </div>

    <?php
	include "sidebar.php";
	?>

<div id="overlay" class="overlay"></div>

<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 28 28" style="display: none;" xml:space="preserve">
  <g id="icon-close">
    <line x1="2" y1="2" x2="26" y2="26" />
    <line x1="2" y1="26" x2="26" y2="2" />
  </g>
</svg>
<script>
document.getElementById("image1").onchange = function () {
    document.getElementById("uploadFile1").value = this.value;
};
</script>
<script>
document.getElementById("image2").onchange = function () {
    document.getElementById("uploadFile2").value = this.value;
};
</script>
<script>
document.getElementById("image3").onchange = function () {
    document.getElementById("uploadFile3").value = this.value;
};
</script>
<style>
.fileUpload {
    position: relative;
    overflow: hidden;
    margin: 10px;
}
.fileUpload input.upload {
    position: absolute;
    top: 0;
    right: 0;
    margin: 0;
    padding: 0;
    font-size: 20px;
    cursor: pointer;
    opacity: 0;
    filter: alpha(opacity=0);
}
</style>

        <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.nicescroll.min.js"></script>
    <script src="js/classie.js"></script>
    <script src="js/ui.js"></script>
    <script src="js/search.js"></script>
    <script src="js/sweetalert.min.js"></script>



    </body>

<!-- Mirrored from 91.234.35.26/iwiki-admin/v1.2.1/admin/input.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 18 Mar 2018 13:17:07 GMT -->
</html>

