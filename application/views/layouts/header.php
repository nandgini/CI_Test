<!DOCTYPE html>
<html>
  <head>
    <style>
      #logout {
        margin-left: 220px;
        padding: 30px;
      }
    </style>
    <?php if($this->session->userdata('userEmail')){ ?>
      <div id="logout">
        <a href="<?php echo base_url('user/user_logout');?>" >
          <button type="button" class="btn-primary">Logout</button>
        </a>
      </div>
    <?php  } ?>
    <title>Login Registration</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
  </head>
  <body>



