<script type="text/javascript">
	var tb_product;

	$(document).ready(function () {
		$('#code').attr('readonly', true)
		$('#qty').attr('readonly', true)

		tb_product = $('#table-product').DataTable({
			'ajax': '<?php echo site_url('product/getAll') ?>',
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
	
	function reloadProduct() {
  		tb_product.ajax.reload(null, false);
  	}
</script>