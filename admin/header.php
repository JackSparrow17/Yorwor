
?>
<!-- Callout -->
<div class="Callout Wide">
    <div class="Brand">
        Admin Dashboard
    </div>

    <div class="Extras">
        <div class="Open Menu-Btn">
           <i class="fa fa-bars"></i>
        </div>

        <div class="Close Menu-Btn">
            <i class="fa fa-window-close"></i>
        </div>
    </div>
</div>

<!-- Navigation -->
<div class="Navigation">
    <div class="Inner">
        <a href="addAdmin.php"><div class="List"> Add Admin </div></a>
        <a href="removeAdmin.php"><div class="List"> Remove Admin </div></a>
        <a href="addSeller.php"><div class="List"> Add Seller </div></a>
        <a href="removeSeller.php"><div class="List"> Remove Seller </div></a>
        <a href="uploadProduct.php"><div class="List"> Upload </div></a>
        <a href="system.php"><div class="List"> System </div></a>
        <a href="orders.php"><div class="List"> Orders </div></a>
        <a href="admindashboard.php?logout=true"><div class="List"> Logout </div></a>
    </div>
</div>
<script src="../JS/nav.js"></script>

<?php
                    if(isset($_GET['logout'])){
                        mysqli_close($conn);
                        unset($_SESSION['userid']);
                        unset($_GET['logout']);
                        session_destroy();
                        header("location: index.php");      
                    }
?>