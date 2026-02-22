<footer class="main-footer">
    <div class="float-right d-none d-sm-block">
        <b>Version</b> 1.0.0
    </div>
    <strong>Copyright &copy; {{date('Y')}} <a href="#">Deck-Er</a>.</strong> All rights reserved.
</footer>

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{asset('back/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('back/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

<!-- AdminLTE App -->
<script src="{{asset('back/dist/js/adminlte.min.js')}}"></script>

<!-- Toastr -->
<script src="{{asset('back/plugins/toastr/toastr.min.js')}}"></script>
@if(session()->has('success'))
    <script>
        toastr.success("{{session()->get('success')}}")
    </script>
@endif
<!-- Page specific script -->
@stack('js')

</body>
</html>
