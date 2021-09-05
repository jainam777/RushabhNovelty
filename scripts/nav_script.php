<script>
        $(document).ready(function () {
            $('.sidenav').sidenav();
            $('.tabs').tabs();
            $('.carousel.carousel-slider').carousel({
                indicators: true,
                duration: 300,
                fullWidth: true,
            });
            $('#show').click(function() {
                $('.menu').toggle("slide");
            });
            $('#show-dropdown').click(function(){
                $('.drop-content').toggle("slide");
            });
            $('.parallax').parallax();
            $('.tooltipped').tooltip();
            $('select').formSelect();
            $('.scrollspy').scrollSpy();
            $('.materialboxed').materialbox();
            $('select').formSelect();
            $('.collapsible').collapsible({
                accordion: false
            });
            setInterval(() => {
                $('.carousel').carousel('next');
            }, 5000);
            $(document).ready(function() {
                M.updateTextFields();
            });
  });

</script>