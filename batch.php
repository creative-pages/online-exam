<?php include('inc/header.php'); ?>

<section class="px-5 w-full"><h1 class="text-3xl font-medium text-gray-700 text-center my-2">Select your batch</h1>
	<div class="flex flex-wrap justify-center mt-10 gap-3">
        <a class="flex items-center justify-center font-semibold text-primary-500 rounded-lg border-2 text-lg h-14 w-60 border-primary transition duration-300 ease-in-out hover:bg-primary-500 hover:text-primary-50" href="/exams/practice-session">Practice Session
	</a>
    <?php
    	if(isset($_GET['free'])) {
    		$type = 'free';
    	} else {
    		$type = 'paid';
    	}

        $batch = $common->select("`add_branch`", "`type` = '$type' ORDER BY `id` DESC");
        if($batch){
            while($raw = mysqli_fetch_assoc($batch)){
           
    ?>
    <a class="flex items-center justify-center font-semibold text-primary-500 rounded-lg border-2 text-lg h-14 w-60 border-primary transition duration-300 ease-in-out hover:bg-primary-500 hover:text-primary-50" href="class.php?cls=<?=$raw['id'];?>"><?=$raw['branch_name'];?> 
	</a>
    <?php }}?>
    </div></section></div>
	<footer class="text-gray-600 body-font"><div class="container px-5 py-8 mx-auto flex items-center sm:flex-row flex-col"><p class="text-sm text-gray-500_ sm:py-2 sm:mt-0 mt-4">© 2021 MediExam Doctor —
	<a href="/about" class="text-gray-600 ml-1">Hasebul Hasan Santo</a></p>
<span class="inline-flex sm:ml-auto sm:mt-0 mt-4 justify-center sm:justify-start"><a class="text-gray-500" href="/"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-facebook" viewBox="0 0 16 16"><path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z"></path></svg></a>
	<a class="ml-3 text-gray-500" href="mailto:mediexaminfo@gmail.com"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope-fill" viewBox="0 0 16 16"><path d="M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414.05 3.555zM0 4.697v7.104l5.803-3.558L0 4.697zM6.761 8.83l-6.57 4.027A2 2 0 0 0 2 14h12a2 2 0 0 0 1.808-1.144l-6.57-4.027L8 9.586l-1.239-.757zm3.436-.586L16 11.801V4.697l-5.803 3.546z"></path></svg></a></span></div></footer></div>



	
</div>
</body>

</html>