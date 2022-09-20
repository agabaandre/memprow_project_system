			
<?php 
if(isset($_POST['training'])){
$training=($_POST['training']);
$m1=($_POST['m1']);
$m2=($_POST['m2']);
$m3=($_POST['m3']);
$m4=($_POST['m4']);
$m5=($_POST['m5']);
$m6=($_POST['m6']);
?>
<script>
window.location.href = '../../dashboard.php?action=evaluate&training=<?php echo $training; ?>&m1=<?php echo $m1; ?>&m2=<?php echo $m2; ?>&m3=<?php echo $m3;?>&m4=<?php echo $m4;?>&m5=<?php echo $m5;?>&m6=<?php echo $m6;?>'; 
</script>	
<?php
}
?>