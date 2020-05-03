<!-- jQuery -->
<script src="<?php echo base_url('assets/vendors/jquery/dist/jquery.min.js') ?>"></script>
<!-- Bootstrap -->
<script src="<?php echo base_url('assets/vendors/bootstrap/dist/js/bootstrap.min.js') ?>"></script>
<!-- Datatables -->
<script src="<?php echo base_url('assets/vendors/datatables.net/js/jquery.dataTables.min.js') ?>"></script>
<script src="<?php echo base_url('assets/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js') ?>"></script>
<!-- Select2 -->
<script src="<?php echo base_url('assets/vendors/select2/js/select2.full.min.js') ?>"></script>
<!-- Bootstrap-Growl -->
<script src="<?php echo base_url('assets/vendors/bootstrap-growl/js/jquery.bootstrap-growl.min.js') ?>"></script>
<!-- Custom Theme Scripts -->
<script src="<?php echo base_url('assets/build/js/custom.min.js') ?>"></script>
<!-- bootstrap-datepicker -->	
<script src="<?php echo base_url('assets/vendors/bootstrap-datepicker/js/bootstrap-datepicker.min.js') ?>"></script>
<!-- autoNumeric -->
<script src="<?php echo base_url('assets/vendors/auto-numeric/autoNumeric.js') ?>"></script>
<script type="text/javascript">
$(document).ready(function () {
	$('.select2').select2()

	$('.datepicker').datepicker({
		format: 'dd/mm/yyyy',
		todayHighlight: true,
		todayBtn: true,
		orientation: "bottom auto",
		autoclose: true
	})
})

function numberMin() {
	$('input[type="number"]').on('input', function () {
	  var value = $(this).val();
	  if ((value !== '')) {
	    $(this).val(Math.max(value, 0));
	  } else if ((value == '')){
	    $(this).val(0);
	  }
	});
}

function formatDate(date) {
		var d = new Date(date),
			month = '' + (d.getMonth() + 1),
			day = '' + d.getDate(),
			year = d.getFullYear();

		if (month.length < 2) month = '0' + month;
		if (day.length < 2) day = '0' + day;

		return [day, month, year].join('/');
	}

</script>