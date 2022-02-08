<style>
.main-content {
    margin-left: 220px;
    padding: 30px;
}
</style>
<div class="main-content">
    <div class="profile">dashboard</div>

    <?php 
        echo $this->session->flashdata('success_msg');
    ?>
</div>