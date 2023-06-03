
<?php
$empid = $_GET['emp_id'];
?>
<script>
    if (confirm("Do you want to delete?") == true) {
        location.assign("employdelete.php?emp_id=<?php echo $empid?>");
    }
   else {
    history.back();
  }
</script>
<?php include '../incl/footer.incl.php'; ?>