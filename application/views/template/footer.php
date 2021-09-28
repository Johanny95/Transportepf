    <footer class="main-footer">
        <div class="pull-right hidden-xs">
         <strong>Desarrollado por: <a href="">Productos Fernandez. </a></strong>
     </div>
     <strong>Copyright &copy; 2017 <a href="">PF Alimentos</a>.</strong> Todos los derechos reservados.
 </footer>


 <script>


    function dinamicMenu() {
        var url = window.location;
        var aux = url.href.split('/');
        var path = url.href;
        if($.isNumeric(aux[aux.length-1]))
        {
            var aux_url = path.substring(0, path.length-1);
            path = aux_url+"1";
        }
        $('.sidebar-menu li a[href="' + path + '"]').parent().addClass('active');
        $('.treeview-menu li a[href="' + path + '"]').parent().addClass('active');
        $('.treeview-menu li a').filter(function() {
            return this.href == path;
        }).parent().parent().parent().addClass('active');
    }

    $(function() {
        dinamicMenu();
    });
</script>
<script type="text/javascript">
    var intervalo = <?php echo $this->config->item('pf_ajax_timeout') ?>;
    setInterval(checkSession, intervalo*60*1000);
    function checkSession() {
        $.ajax({
            url: "<?php echo site_url('check') ?>",
            dataType: 'json',
            error: function(){
                window.location = '<?php echo site_url('login') ?>';
            }
        });
    }
</script>
</body>
</html>