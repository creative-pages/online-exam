<!-- footer -->
            <!-- -------------------------------------------------------------- -->
           
            <!-- -------------------------------------------------------------- -->
            <!-- End footer -->
            <!-- -------------------------------------------------------------- -->
        </div>
        <!-- -------------------------------------------------------------- -->
        <!-- End Page wrapper  -->
        <!-- -------------------------------------------------------------- -->
    
    <!-- -------------------------------------------------------------- -->
    <!-- End Wrapper -->
    <!-- -------------------------------------------------------------- -->
    <!-- -------------------------------------------------------------- -->
    <div class="chat-windows"></div>
    <!-- -------------------------------------------------------------- -->
    <!-- All Jquery -->
    <!-- -------------------------------------------------------------- -->
    <script src="../admin/assets/libs/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="../admin/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <!-- apps -->
    <script src="../admin/dist/js/app.min.js"></script>
    <script src="../admin/dist/js/app.init.js"></script>
    <script src="../admin/dist/js/app-style-switcher.js"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="../admin/assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
    <script src="../admin/assets/extra-libs/sparkline/sparkline.js"></script>
    <!--Wave Effects -->
    <script src="../admin/dist/js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="../admin/dist/js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
   <script src="../admin/dist/js/feather.min.js"></script>
    <script src="../admin/dist/js/custom.min.js"></script>
    <!-- This Page JS -->
    <script src="../admin/assets/extra-libs/prism/prism.js"></script>

    <!--This page plugins -->
    <script src="../admin/assets/extra-libs/datatables.net/js/jquery.dataTables.min.js"></script>
    <!-- start - This is for export functionality only -->
    <!-- <script src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.print.min.js"></script>
    <script src="dist/js/pages/datatable/datatable-advanced.init.js"></script> -->
    <script>
    $(document).ready(function() {
        $('#select_batch').on('change',function() {
            var id = $(this).val();
            if (id !== '') {
                $.ajax({
                    url: '../admin/ajax/ajax.php',
                    type: 'POST',
                    data: {type: 'select_exam', id: id},
                    success:function(data) {
                        $('#select_exam').html(data);
                    }
                });
            } else {
                $('#select_exam').html('<option value="">Choose exam</option>');
            }
            $('#all_exam').html('<h4 class="text-danger mb-0">Please select batch then select exam to see your result.</h4>');
        });
        $('#select_exam').on('change',function() {
            var id = $(this).val();
            if (id !== '') {
                $.ajax({
                    url: '../admin/ajax/ajax.php',
                    type: 'POST',
                    data: {type: 'select_results', exam_id: id},
                    success:function(data) {
                        $('#all_exam').html(data);
                    }
                });
            } else {
                $('#all_exam').html('<h4 class="text-danger mb-0">Please select batch then select exam to see your result.</h4>');
            }
        });
    });
    </script>
</body>
</html>