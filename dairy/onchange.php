<!DOCTYPE html>
<html>
<body>

<p>Select a new car from the list.</p>

<input type="" id="mySelect" onchange="myFunction()">
 

<p>When you select a new car, a function is triggered which outputs the value of the selected car.</p>

<p id="demo"></p>

<script>
function myFunction() {
  var x = document.getElementById("mySelect").value;
  document.getElementById("demo").innerHTML = "You selected: " + x;
}
</script>

</body>
</html>

