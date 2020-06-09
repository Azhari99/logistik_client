<script type="text/javascript">
	var tb_product_in;
	// resetProductIn()

	$(document).ready(function () {
		$('#code_in').attr('readonly', true)
		$('#amount_in').autoNumeric('init') //inisialisasi currency rupiah

		tb_product_in = $('#table-product-in').DataTable({
			'ajax': '<?php echo site_url('productin/getAll') ?>',
    		'processing': true,
	        'language': {
	          'processing': '<i class="fa fa-spinner fa-spin fa-10x fa-fw"></i><span> Processing...</span>'
	        },
    		'orders': [],
    		'columnDefs': [
    			{
    				'targets': -1, //last column
    				'orderable': false, //set not orderable
    			},
    		]
		})
	})
	
	function reloadProductIn() {
  		tb_product_in.ajax.reload(null, false);
  	}

	function resetProductIn() {
		$('#resetProductIn').click(function() {
			$('.select2').val(null).trigger('change')
			$('input[name=qty_in]').val('')
			$('textarea').val('')
			$('input[name=amount_in]').val('')
			$('#datetrx_in').datepicker('setDate', new Date($.now()))
		})
	}
</script>