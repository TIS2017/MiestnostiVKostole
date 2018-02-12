window.onload = draw;

const COLORS = {
	"non-reservable": "#E2DADA",
	"reserved": "#552200",
	"free": "#FFCCA9",
	"outline": "#956E54"
};

function Building(name, text, x, y, width, height, color, reservable) {
	this.name = name;
	this.text = text;
	this.x = x;
	this.y = y;
	this.width = width;
	this.height = height;
	this.color = color;
	this.reservable = reservable;
	
	this.plot = function(context, hover) {
		this.clear(context);

		context.fillStyle = this.color;
		context.fillRect(this.x, this.y, this.width, this.height);
		
		context.strokeStyle = COLORS["outline"];
		context.strokeRect(this.x, this.y, this.width, this.height);
		
		let text_width = context.measureText(text).width;
		context.fillStyle = (this.color == COLORS["reserved"]) ? "white" : "black";
		context.font = "1em Arial, Helvetica, sans-serif";
		context.textAlign = "center";
		context.fillText(this.text, this.x+(this.width/2), this.y+(this.height/2));
		
		if(reservable && hover){
			let buffer = 4;
			context.strokeStyle = context.fillStyle;
			context.beginPath();
			context.moveTo(this.x+(this.width/2)-(text_width/2), this.y+(this.height/2)+buffer);
			context.lineTo(this.x+(this.width/2)+(text_width/2), this.y+(this.height/2)+buffer);
			context.stroke();
		}
	};
	
	this.clear = function(context) {
		context.clearRect(this.x, this.y, this.width, this.height);	
	};
	
	this.contains = function(mouseX, mouseY) {
		return (this.x <= mouseX && mouseX <= (this.x + this.width)
			&& this.y <= mouseY && mouseY <= (this.y + this.height)
		)
	};
	
	this.adjust = function(canvasWidth, canvasHeight) {		
		const maxWidth = 920;
		const maxHeight = 440;
		
		let widthRatio = this.width / maxWidth;
		let heightRatio = this.height / maxHeight;
		
		this.width = canvasWidth * widthRatio;
		this.height = canvasHeight * heightRatio;
		
		let ratioX = this.x / maxWidth;
		let ratioY = this.y / maxHeight;
		
		this.x = canvasWidth * ratioX;
		this.y = canvasHeight * ratioY;
	};
}

function initBuildings(resources) {
	let buildings = new Array(
		new Building(resources[0]['name'], resources[0]['abbreviation'],   		9,   9,   91,  102, 	COLORS["reserved"],			true),
		new Building(resources[1]['name'], resources[1]['abbreviation'], 		99,  9,   142, 102, 	COLORS["non-reservable"],	false),
		new Building(resources[2]['name'], resources[2]['abbreviation'], 	 	319, 9,   62,  62,	 	COLORS["non-reservable"],	false),
		new Building(resources[3]['name'], resources[3]['abbreviation'], 	 	459, 9,   92,  112, 	COLORS["reserved"],			true),
		new Building(resources[4]['name'], resources[4]['abbreviation'], 	 	549, 9,   92,  112, 	COLORS["reserved"],			true),
		new Building(resources[5]['name'], resources[5]['abbreviation'], 	 	639, 9,   112, 112, 	COLORS["free"],				true),
		new Building(resources[6]['name'], resources[6]['abbreviation'],		749, 9,   162, 132,		COLORS["reserved"],			true),
		new Building(resources[7]['name'], resources[7]['abbreviation'],		9, 139,   122,  82,		COLORS["non-reservable"],	false),
		new Building(resources[8]['name'], resources[8]['abbreviation'], 	 	9, 219,   122,  82,		COLORS["non-reservable"],	false),
		new Building(resources[9]['name'], resources[9]['abbreviation'], 		759, 169, 152, 132, 	COLORS["reserved"],			true),
		new Building(resources[10]['name'], resources[10]['abbreviation'],	 	9, 329,   122, 102,		COLORS["reserved"],			true),
		new Building(resources[11]['name'], resources[11]['abbreviation'],		129, 329, 272, 102, 	COLORS["free"],				true),
		new Building(resources[12]['name'], resources[12]['abbreviation'],		399, 329, 62,  102,		COLORS["non-reservable"],	false),
		new Building(resources[13]['name'], resources[13]['abbreviation'],		459, 329, 192, 102, 	COLORS["reserved"],			true),
		new Building(resources[14]['name'], resources[14]['abbreviation'],		739, 329, 172, 102, 	COLORS["free"],				true)
	);
	
	return buildings;
}

//-----------------------------------------------------------
//-----------------------------------------------------------

const buildings = initBuildings(rooms);

function setMeetings(buildings, meetings) {	
	buildings.forEach(function(room) {
		if(room.reservable)
			room.color = COLORS["free"];
	});
	
	for(let key in meetings){
		buildings.forEach(function(room) {
			if(room.name == meetings[key]['name'])
				room.color = COLORS["reserved"];
		});
	};
}

function drawYard(context, canvas, x, y) {
	const maxWidth = 920;
	const maxHeight = 440;
	
	let widthRatio = yard.width / maxWidth;
	let heightRatio = yard.height / maxHeight;
	
	let width = canvas.width * widthRatio;
	let height = canvas.height * heightRatio;
	
	let ratioX = x / maxWidth;
	let ratioY = y / maxHeight;
	
	x = canvas.width * ratioX;
	y = canvas.height * ratioY; 
	
	context.drawImage(yard, x, y, width, height);
}

function adjust(buildings) {
	let clientWidth = document.body.clientWidth;
	/*let clientHeight = document.body.clientHeight;	
	
	let div1 = document.getElementsByClassName("container-fluid section-filtracia")[0];
	let div2 = document.getElementsByClassName("content")[0];
	if(div1 != undefined && div2 != undefined)
		clientHeight -= (div1.clientHeight + div2.clientHeight);*/
	
	const canvasWidth = 0.64;
	const canvasHeight = 0.36;
	
	let canvas = document.getElementById("canvas");
	canvas.width = clientWidth * canvasWidth;
	canvas.height = clientWidth * canvasHeight;
	canvas.style.cssText = "border:1px solid #7B685F";	
	
	buildings.forEach(function(building) {
		building.adjust(canvas.width, canvas.height);
	});
}

function draw() {	
	var canvas = document.getElementById("canvas");
	var ctx = canvas.getContext("2d");
	
	setMeetings(buildings, meetings);
	
	ctx.clearRect(0, 0, canvas.width, canvas.height);
	
	ctx.fillStyle = "white";
	ctx.fillRect(0, 0, canvas.width, canvas.height);

	buildings.forEach(function(building) {
		building.plot(ctx, false);
	});
	
	drawYard(ctx, canvas, 269, 159);

	//hover map
	canvas.addEventListener('mousemove', function(e) {
		let mouseX = parseInt(e.clientX - canvas.getBoundingClientRect().left);
		let mouseY = parseInt(e.clientY - canvas.getBoundingClientRect().top);
		
		buildings.forEach(function(building) {
			building.plot(ctx, building.contains(mouseX, mouseY));
		});
	});
	
	//click map
	canvas.addEventListener('click', function(e) {
		let mouseX = parseInt(e.clientX - canvas.getBoundingClientRect().left);
		let mouseY = parseInt(e.clientY - canvas.getBoundingClientRect().top);
		
		buildings.forEach(function(building){
			if(building.contains(mouseX, mouseY) && building.reservable){
				window.location = '/miestnost/filter/' + building.name;
			}
		});
	});
}

adjust(buildings);
setInterval(draw, 60000);