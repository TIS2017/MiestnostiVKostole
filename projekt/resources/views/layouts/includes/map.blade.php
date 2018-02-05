<?php use App\Http\Controllers\MapController; ?>
<?php use Illuminate\Support\Facades\URL; ?>

<script>
	function load_js() {
		var head= document.getElementsByTagName('head')[0];
		var script= document.createElement('script');
		script.type= 'text/javascript';
		script.src= 'map.js';
		head.appendChild(script);
	}

	function refresh(){
			$('#center').load('map.blade.php',function () {
			$(this).unwrap();
		});
		load_js();
	}

	refresh();
	setInterval(function(){ refresh() }, 1000);
</script>
	
<center>
	<canvas id="canvas" width="920" height="440" class="mapka" style="border: 1px solid #7B685F"></canvas>
	
	<?php
		$array = MapController::getMeetings();
		$meetings = $array[0];
		$rooms = $array[1]; ?>
	
	<script>
		const meetings = <?php echo $meetings ?>;
		const rooms = <?php echo $rooms ?>;
	</script>
	
	<script type="text/javascript" id="#map">
		window.onload = draw;

		var i = 0;

		const COLORS = {
				"non-reservable": "#E2DADA",
				"reserved": "#552200",
				"free": "#FFCCA9",
				"outline": "#956E54"
		};

		function Building(text, x, y, width, height, color, reservable) {
			this.text = text;
			this.x = x;
			this.y = y;
			this.width = width;
			this.height = height;
			this.color = color;
			this.reservable = reservable;
			
			this.plot = function(context) {
				this.clear(context);
				
				context.fillStyle = this.color;
				context.strokeStyle = COLORS["outline"];
				
				context.fillRect(x, y, this.width, this.height);
				context.strokeRect(x, y, this.width, this.height);
				
				context.fillStyle = (this.color == COLORS["reserved"]) ? "white" : "black";
				context.font = "1em Georgia";
				context.textAlign = "center";
				context.fillText(this.text, this.x+(this.width/2), this.y+(this.height/2));
			};
			
			this.clear = function(context) {
				context.clearRect(x, y, this.width, this.height);	
			}
		}

		function initBuildings(resources) {
			let properties = new Array(
				new Building(resources[0]['abbreviation'],   	9,   9,   91,  102, 	COLORS["non-reservable"],	false),
				new Building(resources[1]['abbreviation'], 		99,  9,   142, 102, 	COLORS["reserved"],			true),
				new Building(resources[2]['abbreviation'], 	 	319, 9,   62,  62,	 	COLORS["non-reservable"],	false),
				new Building(resources[3]['abbreviation'], 	 	459, 9,   92,  112, 	COLORS["non-reservable"],	false),
				new Building(resources[4]['abbreviation'], 	 	549, 9,   92,  112, 	COLORS["reserved"],			true),
				new Building(resources[5]['abbreviation'], 	 	639, 9,   112, 112, 	COLORS["free"],				true),
				new Building(resources[6]['abbreviation'],		749, 9,   162, 132,		COLORS["reserved"],			true),
				new Building(resources[7]['abbreviation'],		9, 139,   122,  82,		COLORS["free"],				true),
				new Building(resources[8]['abbreviation'], 	 	9, 219,   122,  82,		COLORS["non-reservable"],	false),
				new Building(resources[9]['abbreviation'], 		759, 169, 152, 132, 	COLORS["reserved"],			true),
				new Building(resources[10]['abbreviation'],	 	9, 329,   122, 102,		COLORS["reserved"],			true),
				new Building(resources[11]['abbreviation'],		129, 329, 272, 102, 	COLORS["free"],				true),
				new Building(resources[12]['abbreviation'],		399, 329, 62,  102,		COLORS["non-reservable"],	false),
				new Building(resources[13]['abbreviation'],		459, 329, 192, 102, 	COLORS["reserved"],			true),
				new Building(resources[14]['abbreviation'],		739, 329, 172, 102, 	COLORS["free"],				true)
			);

			let buildings = {};
			for(let i=0; i<properties.length; i++){
				buildings[resources[i]['name']] = properties[i];
			}
			
			return buildings;
		}

		function draw() {	
			console.log();
			var ctx = document.getElementById("canvas").getContext("2d");
			var buildings = initBuildings(rooms);
			
			ctx.clearRect(0, 0, canvas.width, canvas.height);
			
			ctx.fillStyle = "white";
			ctx.fillRect(0, 0, canvas.width, canvas.height);

			for(let name in buildings){
				buildings[name].plot(ctx);
			}
			
			let yard = new Image();
			yard.src = "../../../../img/dvor.png";

			yard.onload = function() {
				ctx.drawImage(yard, 269, 159);
			}
		}
	</script>
</center>