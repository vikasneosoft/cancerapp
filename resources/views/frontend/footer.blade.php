</div>
</div>
</div>
<div id="copyright">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 mb-2 mb-lg-0">
                <p class="text-center text-lg-left">©2019 Your name goes here.</p>
            </div>
            <div class="col-lg-6">
                <p class="text-center text-lg-right">Template design by <a
                        href="https://bootstrapious.com/">Bootstrapious</a>
                    <!-- If you want to remove this backlink, pls purchase an Attribution-free License @ https://bootstrapious.com/p/obaju-e-commerce-template. Big thanks!-->
                </p>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('public/admin/js/jquery.min.js') }}" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function() {
        setTimeout(function() {
            $('.alert-success').fadeOut('fast');
            $('.alert-danger').fadeOut('slow');
        }, 5000);

        setTimeout(function() {
            $('.flashMessage').fadeOut('slow');
        }, 3000);
    });

</script>

@yield('frontend-js')
</body>

</html>
