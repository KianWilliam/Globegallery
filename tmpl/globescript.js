 let chosenone ;
 let img;
 let firstTimeout;
 

// Get the canvas element from the DOM
const canvas = document.querySelector('#scene');
canvas.width = canvaswidth;
canvas.height = canvasheight;
// Store the 2D context
const ctx = canvas.getContext('2d');

if (window.devicePixelRatio > 1) {
  canvas.width = canvas.clientWidth * 2;
  canvas.height = canvas.clientHeight * 2;
  ctx.scale(2, 2);
}

/* ====================== */
/* ====== VARIABLES ===== */
/* ====================== */
let width = canvaswidth; // Width of the canvas
let height = canvasheight; // Height of the canvas
let rotation = 0; // Rotation of the globe
let dots = []; // Every dots in an array

/* ====================== */
/* ====== CONSTANTS ===== */
/* ====================== */
/* Some of those constants may change if the user resizes their screen but I still strongly believe they belong to the Constants part of the variables */
const DOTS_AMOUNT = pointnums; // Amount of dots on the screen

let GLOBE_RADIUS = width * 0.8; // Radius of the globe

let GLOBE_CENTER_Z = -GLOBE_RADIUS; // Z value of the globe center
let PROJECTION_CENTER_X = width / 2; // X center of the canvas HTML
let PROJECTION_CENTER_Y = height / 2; // Y center of the canvas HTML
let FIELD_OF_VIEW = width * 0.8;

class Dot {
  constructor(x, y, z) {
    this.x = x;
    this.y = y;
    this.z = z;
    
    this.xProject = 0;
    this.yProject = 0;
    this.sizeProjection = 0;
  }
  // Do some math to project the 3D position into the 2D canvas
  project(sin, cos) {
   const rotX =  cos * this.x  +  sin * (this.z - GLOBE_CENTER_Z);
    const rotZ = -sin * this.x +  cos * (this.z - GLOBE_CENTER_Z) + GLOBE_CENTER_Z;
	
	
	
    this.sizeProjection = FIELD_OF_VIEW / (FIELD_OF_VIEW - rotZ);
    this.xProject = (rotX * this.sizeProjection) + PROJECTION_CENTER_X;
    this.yProject = (this.y * this.sizeProjection) + PROJECTION_CENTER_Y;
	
  }
  // Draw the dot on the canvas
  draw(sin, cos) {
    this.project(sin, cos);
    ctx.beginPath();
    chosenone = Math.random()*imagenums;

			 
	 img = document.getElementById("image"+parseInt(chosenone));

			
   
  	ctx.drawImage(img, this.xProject, this.yProject, imagewidth, imageheight);
    ctx.closePath();
    ctx.fill();
  }
}

function createDots() {
  // Empty the array of dots
  dots.length = 0;
  
  // Create a new dot based on the amount needed
  for (let i = 0; i < DOTS_AMOUNT; i++) {

    const theta = Math.random() * 2 * Math.PI; // Random value between [0, 2PI]
    const phi = Math.acos((Math.random() * 2) - 1); // Random value between [-1, 1]
    
    // Calculate the [x, y, z] coordinates of the dot along the globe
    const x = GLOBE_RADIUS * Math.sin(phi) * Math.cos(theta);
    const y = GLOBE_RADIUS * Math.sin(phi) * Math.sin(theta);
    const z = (GLOBE_RADIUS * Math.cos(phi)) + GLOBE_CENTER_Z;
    dots.push(new Dot(x, y, z));
  }
}

/* ====================== */
/* ======== RENDER ====== */
/* ====================== */

function render(a) {
	
  // Clear the scene
  ctx.clearRect(0, 0, width, height);
  // Increase the globe rotation
  rotation = a * rotationspeed;
		



  const sineRotation = Math.sin(rotation); // Sine of the rotation
  const cosineRotation = Math.cos(rotation); // Cosine of the rotation
  //keeps the rotation between -1 and +1
  // Loop through the dots array and draw every dot
 // console.log(sineRotation + "-" + cosineRotation);
  for (let i = 0; i < dots.length; i++) {

    dots[i].draw(sineRotation, cosineRotation);
	for(let j=0; j<cis; j++);
	

  
 }
 raf = window.requestAnimationFrame(render);
}

// Function called after the user resized its screen
function afterResize () {
  width = canvas.offsetWidth;
  height = canvas.offsetHeight;
  if (window.devicePixelRatio > 1) {
    canvas.width = canvas.clientWidth * 2;
    canvas.height = canvas.clientHeight * 2;
    ctx.scale(2, 2);
  } else {
    canvas.width = width;
    canvas.height = height;
  }
  GLOBE_RADIUS = width * 0.7;
  GLOBE_CENTER_Z = -GLOBE_RADIUS;
  PROJECTION_CENTER_X = width / 2;
  PROJECTION_CENTER_Y = height / 2;
  FIELD_OF_VIEW = width * 0.8;
  
  createDots(); // Reset all dots
}

// Variable used to store a timeout when user resized its screen

// Function called right after user resized its screen
function onResize () {
  // Clear the timeout variable
  resizetimeout = window.clearTimeout(resizetimeout);
  // Store a new timeout to avoid calling afterResize for every resize event
    resizetimeout = window.setTimeout(afterResize, resizetimeout);

}
window.addEventListener('resize', onResize);


// Populate the dots array with random dots
//createDots();

// Render the scene
//window.requestAnimationFrame(render);