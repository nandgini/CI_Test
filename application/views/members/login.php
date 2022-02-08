<div  style="text-align: center; margin: 20px;"><?php 
    echo $this->session->flashdata('success_msg');
?>
</div>

<span style="background-color:red;">
  <div class="container"><!-- container class is used to centered  the body of the browser with some decent width-->
      <div class="row"><!-- row class is used for grid system in Bootstrap-->
          <div class="col-md-4 col-md-offset-4"><!--col-md-4 is used to create the no of colums in the grid also use for medimum and large devices-->
              <div class="login-panel panel panel-success">
                  <div class="panel-heading">
                      <h3 class="panel-title">Sign In</h3>
                  </div>
                  <div class="panel-body">

                  <?php
                  $error_msg=$this->session->flashdata('error_msg');
                  if($error_msg){
                    echo $error_msg;
                  }
                   ?>

                      <form role="form" method="post" action="<?php echo base_url('user/login_user'); ?>">
                          <fieldset>
                              <div class="form-group">
                                  <input class="form-control"   name="email" type="text" autofocus>
                              </div>

                              <div class="form-group">
                                  <input class="form-control"  name="password" type="password" autofocus>
                              </div>
                              

                              <input class="btn btn-lg btn-success btn-block" type="submit" value="login" name="Login" >

                          </fieldset>
                      </form>
                      <center><b>You dont have account ?</b> <br></b><a href="<?php echo base_url('user/index'); ?>"> Please Register</a></center><!--for centered text-->
                  </div>
              </div>
          </div>
      </div>
  </div>





</span>