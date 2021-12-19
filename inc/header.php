<?php
    require_once 'init.php';
    $all = new All();
    $exam = new Exam();
    $common = new Common();
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Baloo+Da+2:wght@400;500;600;700&display=swap" rel="stylesheet">
	<meta charset="utf-8" />
	<link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
	<link rel="manifest" href="/site.webmanifest">
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-5574856121862841"
		crossorigin="anonymous"></script>
	<title>When Medical is the dream - MediEXAM Doctor</title><meta name="title" content="When Medical is the dream - MediEXAM Doctor" data-svelte="svelte-1k5zbig"><meta name="description" content="Try Hard to Achive Your Goal" data-svelte="svelte-1k5zbig"><meta name="robots" content="index, follow" data-svelte="svelte-1k5zbig"><meta http-equiv="Content-Type" content="text/html; charset=utf-8" data-svelte="svelte-1k5zbig"><meta property="og:title" content="When Medical is the dream - MediEXAM Doctor" data-svelte="svelte-1k5zbig"><meta property="og:description" content="Try Hard to Achive Your Goal" data-svelte="svelte-1k5zbig"><meta property="og:image" content="https://cdn.sanity.io/images/e5mb4tjm/production/7990dd2612b45bed3832e19f5a69228f48819227-1080x1085.jpg" data-svelte="svelte-1k5zbig">

		

		<link rel="modulepreload" href="css/app/client.js">
		<link rel="modulepreload" href="css/app/layout.js">
		<link rel="modulepreload" href="css/app/sevelte.js">
		<link rel="modulepreload" href="css/app/strat.js">
		<link rel="modulepreload" href="css/app/vendor.js">
		<link rel="stylesheet" href="css/page.css">
		<link rel="stylesheet" href="css/start.css">

		<script type="module">
			import { start } from "/_app/start-ff3eebe4.js";
			start({
				target: document.querySelector("#svelte"),
				paths: {"base":"","assets":""},
				session: {},
				host: "mediexam.netlify.app",
				route: true,
				spa: false,
				trailing_slash: "never",
				hydrate: {
					status: 200,
					error: null,
					nodes: [
						import("css/app/layout.js"),
						import("css/app/sevelte.js")
					],
					page: {
						host: "mediexam.netlify.app", // TODO this is redundant
						path: "/",
						query: new URLSearchParams("fbclid=IwAR1clQliqBxVdyg5wTYOJG5C1WLpTe02IhLXnwmFMDriNdR9xF92Z8jVE6U"),
						params: {}
					}
				}
			});
		</script>
</head>

<body>
	<div id="svelte">






<div class="flex flex-col min-h-screen"><header class="text-gray-600"><div class="container mx-auto flex flex-wrap p-5 flex-col md:flex-row items-center"><a class="flex font-medium items-center text-gray-900 mb-2 md:mb-0" href="/"><svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-10 h-10 text-white p-2 bg-primary-500 rounded-full" viewBox="0 0 15 15"><path d="M5.5,7C4.1193,7,3,5.8807,3,4.5l0,0v-2C3,2.2239,3.2239,2,3.5,2H4c0.2761,0,0.5-0.2239,0.5-0.5S4.2761,1,4,1H3.5 	C2.6716,1,2,1.6716,2,2.5v2c0.0013,1.1466,0.5658,2.2195,1.51,2.87l0,0C4.4131,8.1662,4.9514,9.297,5,10.5C5,12.433,6.567,14,8.5,14 	s3.5-1.567,3.5-3.5V9.93c1.0695-0.2761,1.7126-1.367,1.4365-2.4365C13.1603,6.424,12.0695,5.7809,11,6.057 	C9.9305,6.3332,9.2874,7.424,9.5635,8.4935C9.7454,9.198,10.2955,9.7481,11,9.93v0.57c0,1.3807-1.1193,2.5-2.5,2.5S6,11.8807,6,10.5 	c0.0511-1.2045,0.5932-2.3356,1.5-3.13l0,0C8.4404,6.7172,9.001,5.6448,9,4.5v-2C9,1.6716,8.3284,1,7.5,1H7 	C6.7239,1,6.5,1.2239,6.5,1.5S6.7239,2,7,2h0.5C7.7761,2,8,2.2239,8,2.5v2l0,0C8,5.8807,6.8807,7,5.5,7 M11.5,9 	c-0.5523,0-1-0.4477-1-1s0.4477-1,1-1s1,0.4477,1,1S12.0523,9,11.5,9z"></path></svg>
	<span class="ml-3 text-xl">MediEXAM Doctor</span></a>
<nav class="md:mr-auto md:ml-4 md:py-1 md:pl-4 md:border-l md:border-gray-400	flex flex-wrap items-center text-base justify-center space-x-5"><a class="hover:text-gray-900" href="/blog">Blog</a>
	<a class="hover:text-gray-900" href="batch.php">Exams</a>
	<a class="hover:text-gray-900" href="/about">About</a>
	</nav>
	<div class="d-flex justify-content-end">
	<a class="hover:text-gray-900 mx-2" href="signin.php">Login</a>
	<a class="hover:text-gray-900 mx-2" href="batch.php">||</a>
	<a class="hover:text-gray-900" href="student-register.php">Register</a>	
	</div>
	</div>
	</header>
	<div class="flex-1 flex flex-col items-center justify-center md:container md:mx-auto">