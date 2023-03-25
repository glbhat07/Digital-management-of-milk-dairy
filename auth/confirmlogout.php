
<script>
  if (confirm("Do you want to logout?") == true) {
    location.assign("logout.php");
    // location.assign("../../../index.php");

  } else {
    history.back();
  }
</script>