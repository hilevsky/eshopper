
<footer id="footer"><!--Footer-->
    <div class="footer-bottom">
        <div class="container">
            <div class="row">
                <p class="pull-left">Copyright © 2018</p>
                <p class="pull-right">Учебный магазин на PHP</p>
            </div>
        </div>
    </div>
</footer><!--/Footer-->

<script src="/template/js/jquery.js"></script>
<!-- Slider -->
<script src="/template/js/jquery.cycle2.min.js"></script>
<script src="/template/js/jquery.cycle2.carousel.min.js"></script>
<!-- Slider -->


<!--
<script src="/template/js/jquery.js"></script>
<script>
    $(document).ready(function(){
        $(".add-to-cart").click(function(){
            var id = $(this).attr("data-id");
            $.post("/cart/addAjax/"+id, {}, function(data){
                $("#cart-count").html(data);
            });
            return false;
        });
    });
</script>-->



</body>
</html>