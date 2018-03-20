var SEPARATION = 100, AMOUNTX = 50, AMOUNTY = 50;
	var container, stats;
	var camera, scene, renderer;

	var particles, particle, count = 0;

	var mouseX = 0, mouseY = 0;
	var container = document.getElementById( 'container' );
	var windowHalfX = window.innerWidth / 2;
	var windowHalfY = parseInt(container.style.height) / 2;

	init();
	animate();

	function init() {

		container = document.getElementById( 'container' );


		//document.body.appendChild( container );

		camera = new THREE.PerspectiveCamera( 80, window.innerWidth / parseInt(container.style.height),30, 10000 ); //摄像头 距离 频率 视野
		camera.position.y = 500;
		camera.position.z = 1000;


		scene = new THREE.Scene();

		particles = new Array();

		var PI2 = Math.PI * 2;
		var material = new THREE.SpriteCanvasMaterial( {

			color: 16777215,
			opacity:0.9,
			program: function ( context ) {

				context.beginPath();
				context.arc( 0, 0, 0.3, 0, PI2, true ); 
				context.fill();

			}

		} );

		var i = 0;

		for ( var ix = 0; ix < AMOUNTX; ix ++ ) {

			for ( var iy = 0; iy < AMOUNTY; iy ++ ) {

				particle = particles[ i ++ ] = new THREE.Sprite( material );
				particle.position.x = ix * SEPARATION - ( ( AMOUNTX * SEPARATION ) / 2 );
				particle.position.z = iy * SEPARATION - ( ( AMOUNTY * SEPARATION ) / 2 );
				scene.add( particle );

			}

		}

		renderer = new THREE.CanvasRenderer({
			alpha:true,
			antialias:true,
			preserveDrawingBuffer:true
		})

		renderer.setPixelRatio( window.devicePixelRatio );
		renderer.setSize( window.innerWidth, parseInt(container.style.height) );
		container.appendChild( renderer.domElement );

		
		//stats = new Stats();  
		//stats.domElement.style.position = 'absolute';
		//stats.domElement.style.top = '0px';
		//container.appendChild( stats.domElement );

		container.addEventListener( 'mousemove', onDocumentMouseMove, false );
		container.addEventListener( 'touchstart', onDocumentTouchStart, false );
		container.addEventListener( 'touchmove', onDocumentTouchMove, false );

		//

		window.addEventListener( 'resize', onWindowResize, false );

	}

	function onWindowResize() {

		windowHalfX = window.innerWidth / 2;
		windowHalfY = parseInt(container.style.height) / 2;
		camera.aspect = window.innerWidth / parseInt(container.style.height);
		camera.updateProjectionMatrix();
		renderer.setSize( window.innerWidth, 750 );

	}

	//

	function onDocumentMouseMove( event ) {

		mouseX = event.clientX - windowHalfX;
		//mouseY = event.clientY - windowHalfY;  去掉Y轴移动
	}

	function onDocumentTouchStart( event ) {

		if ( event.touches.length === 1 ) {

			event.preventDefault();

			mouseX = event.touches[ 0 ].pageX - windowHalfX;
			//mouseY = event.touches[ 0 ].pageY - windowHalfY; 去掉Y轴移动

		}

	}

	function onDocumentTouchMove( event ) {

		if ( event.touches.length === 1 ) {

			event.preventDefault();

			mouseX = event.touches[ 0 ].pageX - windowHalfX;
			//mouseY = event.touches[ 0 ].pageY - windowHalfY; 去掉Y轴移动

		}

	}

	//

	function animate() {

		requestAnimationFrame( animate );

		render();
		//stats.update();
		
	}

	function render() {

		camera.position.x += ( mouseX - camera.position.x ) * .05;
		camera.position.y += ( - mouseY - camera.position.y + 200 ) * .05;
		camera.lookAt( scene.position );



		var i = 0;

		for ( var ix = 0; ix < AMOUNTX; ix ++ ) {

			for ( var iy = 0; iy < AMOUNTY; iy ++ ) {

				particle = particles[ i++ ];
				particle.position.y = ( Math.sin( ( ix + count ) * 0.3 ) * 50 ) +
					( Math.sin( ( iy + count ) * 0.5 ) * 50 );
				particle.scale.x = particle.scale.y = ( Math.sin( ( ix + count ) * 0.3 ) + 1 ) * 4 +
					( Math.sin( ( iy + count ) * 0.5 ) + 1 ) * 4;

			}

		}

		renderer.render( scene, camera );

		count += 0.1;

	}



	window.onscroll = function(e){
		var e =e || window.event;
		var scrolltop=document.documentElement.scrollTop||document.body.scrollTop;
		var height = $('.i-intro').height();
		if(scrolltop>=height){
			AMOUNTX=0
			
		}else{
			AMOUNTX=50;
		}
	}
		
