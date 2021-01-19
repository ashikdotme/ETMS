 </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>&copy; 2020 ETMS - Develop by  Coder IT Solution</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
<?php 

if(isset($_COOKIE['rememberUser'])){
    $user_id = $_COOKIE['rememberUser'];
}else{
    $user_id = $_SESSION['em_user'][0]['u_id'];
}


 ?> 
    <!-- Bootstrap core JavaScript-->
    <script src="assets/vendor/jquery/jquery.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="assets/js/sb-admin-2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="assets/js/date-time.js"></script>

    <script src="assets/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="admin/assets/bundles/summernote/summernote-bs4.js"></script>  
    <script>
        $(document).ready(function() {
          $('#dataTable').DataTable();
        });

        if (jQuery().summernote) {
            $("#work_details").summernote({
              dialogsInBody: true,
              minHeight: 250,
               toolbar: [
                ["style", ["bold", "italic", "underline", "clear"]],
                ["font", ["strikethrough"]],
                ['para', ['ul', 'ol', 'paragraph']],
                ['insert', ['link']],
                 ['color', ['color']],
              ]
            });
        }

        function taskNotifications(count0){
            var user_id = '<?php echo $user_id; ?>';
            var count0 = count0;
            var post_type = 'Notification';
            $.ajax({
                type:'POST',
                url:'ajaxRequest.php',
                dataType:'JSON',
                data:{
                    Notification:post_type,
                    noti_user_id:user_id,
                    count0:count0
                },
                success:function(response){
                    if(response.noticount != null){
                        if(response.noticount == 0){
                            $('#noti_count').hide();
                        }else{
                            $('#noti_count').text(response.noticount);
                        }
                    }
                }
            });
        }


        $('#alertsDropdown').click(function(){
            taskNotifications(count0 = 0);
            setTimeout(function(){
                taskNotifications(count0=1);
            },1000);
        });

        taskNotifications(count0=1); 
    </script>   
</body>

</html>