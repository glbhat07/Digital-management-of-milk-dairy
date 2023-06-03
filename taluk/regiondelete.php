
<?php
$regcode = $_GET['regcode'];
?>
<script>
    if (confirm("Do you want to delete?") == true) {
        location.assign("confirmregdelete.php?regcode=<?php echo $regcode?>");
    }
   else {
    history.back();
  }
</script>
<?php include '../incl/footer.incl.php'; ?>