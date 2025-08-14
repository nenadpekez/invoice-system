<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<script src="<?php echo base_url(); ?>assets/js/jquery.min.js?ver=<?php echo time();?>"></script>
<script src="<?php echo base_url(); ?>assets/js/bootstrap.js?ver=<?php echo time();?>"></script>
<script src="<?php echo base_url(); ?>assets/ality/js/prism.js?ver=<?php echo time();?>"></script>
<script src="<?php echo base_url(); ?>assets/ality/js/app.min.js?ver=<?php echo time();?>"></script>
<script src="<?php echo base_url(); ?>assets/ality/js/admin.js?ver=<?php echo time();?>"></script>

<!-- JS Libraies -->
<script src="<?php echo base_url(); ?>assets/bundles/chartjs/chart.min.js"></script>
<script src="<?php echo base_url(); ?>assets/bundles/apexcharts/apexcharts.min.js"></script>

<script src="<?php echo base_url(); ?>assets/ality/js/scripts.js?ver=<?php echo time();?>"></script>
<script src="<?php echo base_url(); ?>assets/ality/js/custom.js?ver=<?php echo time();?>"></script>
<script src="<?php echo base_url(); ?>assets/js/main.js?ver=<?php echo time();?>"></script>
<script src="<?php echo base_url(); ?>assets/js/account.js?ver=<?php echo time();?>"></script>
<script src="<?php echo base_url(); ?>assets/js/holder.js?ver=<?php echo time();?>"></script>
<script src="<?php echo base_url(); ?>alertify/alertify.js?ver=<?php echo time();?>"></script>

<script>
function f() {
    alertify
        .alert("This is an alert dialog.", function() {
            alertify.message('OK');
        });
}
</script>


<script>
$(document).on('keyup', '#search', function(e) {

    var code = e.which; // recommended to use e.which, it's normalized across browsers
    if (code == 13) {
        e.preventDefault();
        var search = $('#search').val();
        var page_num = 1;
        //var page=$('#page').val();		
        //var id_predavanje=$('#id_predavanje').val();

        var page = 'orgJed/ajax';
        /*
        page=page+'/ajax';
        
        if($('#page').val()==='predavanja_slusaoci') { 		 
        	page='predavanja/ajax_slusaoci';
        }
        
        if($('#page').val()==='predavanja_prisustvo') { 		 
        	page='predavanja/ajax_prisustvo';
        }
        */
        $.ajax({
            url: '<?php echo base_url(); ?>' + page,
            type: "POST",
            data: {
                search: search,
                page_num: page_num,
                //id_predavanje: id_predavanje
            },
            //dataType: 'json',
            success: function(data) {
                $('#result').replaceWith(data);
                console.log('ajax ok');
            },
            error: function() {
                console.log('ajax not ok');
            }
        });
    }
});
</script>

<script>
$(document).ready(function() {
    // Add smooth scrolling to all links
    $("a").on('click', function(event) {

        // Make sure this.hash has a value before overriding default behavior
        if (this.hash !== "") {
            // Prevent default anchor click behavior
            event.preventDefault();

            // Store hash
            var hash = this.hash;

            // Using jQuery's animate() method to add smooth page scroll
            // The optional number (800) specifies the number of milliseconds it takes to scroll to the specified area
            $('html, body').animate({
                scrollTop: $(hash).offset().top
            }, 800, function() {

                // Add hash (#) to URL when done scrolling (default click behavior)
                window.location.hash = hash;
            });
        } // End if
    });
});
</script>