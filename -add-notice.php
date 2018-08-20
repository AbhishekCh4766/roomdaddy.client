<?php
include "header.php";
?>

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
            <div class="row decor-info">
                <div class="col-sm-12">
                    <div class="input-title">Isao</div>
                </div>
                <div class="col-sm-12">
                    <span class="input input--isao">
						<select class="input__field input__field--isao">
							<option>Cleaning</option>
							<option>Plumbing</option>
							<option>Electrical</option>
							<option>Internet</option>
						</select>
                        <label class="input__label input__label--isao" for="input-38" data-content="First Name">
                            <span class="input__label-content input__label-content--isao">Complaint Type</span>
                        </label>
                    </span>
                </div>
                <div class="col-sm-12">
                    <span class="input input--isao">
                        <select class="input__field input__field--isao">
							<?php
								for($i=1;$i<=12;$i++)
								{
									?>
									<option>
									<?php
									if($i<=9)
									{
										
										echo "0".$i;
									}
									else
									{
										echo $i;
									}
									?>
									</option>
									<?php
								}
							?>
						</select>
                        <select class="input__field input__field--isao">
							<?php
								for($i=00;$i<=59;$i++)
								{
									?>
									<option>
									<?php
									if($i<=9)
									{
										
										echo "0".$i;
									}
									else
									{
										echo $i;
									}
									?>
									</option>
									<?php
								}
							?>
						</select>
                        <label class="input__label input__label--isao" for="input-38" data-content="First Name">
                            <span class="input__label-content input__label-content--isao">Prefer Time</span>
                        </label>
                    </span>
                </div>
                <div class="col-sm-12">
                    <span class="input input--isao input--filled">
                       <!--<input class="input__field input__field--isao" type="text" id="input-39" />-->
						<textarea class="input__field input__field--isao" ></textarea>
                        <label class="input__label input__label--isao" for="input-39" data-content="Middle Name">
                            <span class="input__label-content input__label-content--isao">Description</span>
                        </label>
                    </span>
                </div>
            </div>
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

