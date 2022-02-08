<style>
.main-content {
    margin-left: 220px;
    padding: 30px;
}
</style>
<div class="main-content">
    <div class="row mb-4 ml-2"> 
        <?php 
        echo $this->session->flashdata('success_msg');
        ?>
    </div>

    <div class="text-primary ml-2 mb-2">Verified & Active User Count : <?php echo $activeAndVerifiedUserCount; ?></div>
    <div class="text-primary ml-2"> Active and Verified Users count who have attached active products : <?php echo $activeAndVerifiedUserCountWithActiveProduct; ?></div>
    <div class="text-primary ml-2"> Count of all active products  : <?php echo $activeProduct; ?></div>
    <div class="text-primary ml-2"> Count of active products which don't belong to any user. : <?php echo $getProductNotAssociatedWithUser; ?></div>
    <div class="text-primary ml-2"> Amount of all active attached products : <?php echo $getProductAmountOfActiveProduct[0]['quantity']; ?></div>
    <div class="text-primary ml-2"> Price of all active attached products : <?php echo $getProductPriceOfActiveProduct[0]['price']; ?></div>
</div>