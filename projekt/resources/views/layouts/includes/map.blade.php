<center id="parent">
	<canvas class="mapa" id="canvas" width="920" height="440" style="border:1px solid #7B685F"></canvas>
</center>
	
<?php 
	use App\Http\Controllers\MapController;
	use Illuminate\Support\Facades\Artisan;	
	use Illuminate\Support\Facades\URL;	
	
	$GLOBALS['rooms'] = MapController::getRooms();
	$GLOBALS['meetings'] = MapController::getMeetings();
	
	function refresh() { 
		$GLOBALS['meetings'] = MapController::getMeetings(); 
	}
?>

<script type="text/javascript">
	//load image
	var yard = new Image();
	yard.src = "../../../img/dvor.png";
	
	//load rooms and meetings
	var rooms = <?php echo json_encode($GLOBALS['rooms']) ?>;
	var meetings = <?php echo json_encode($GLOBALS['meetings']) ?>;
	
	function refreshMeetings() {
		<?php refresh() ?>
		meetings = <?php echo json_encode($GLOBALS['meetings']) ?>;
	}
	
	setInterval(refreshMeetings, 1000);
</script>

<script type="text/javascript" src="/js/map.js"></script>