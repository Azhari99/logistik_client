<script type="text/javascript">
	var tb_product_in;
	resetProductIn()
	numberOnly()
	getDataEdit()

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


		$('#product_in').on('change', function() {
			var product_id = $(this).val()
			$.ajax({
				url: '<?php echo site_url('product/getProductType')?>',
				type: 'POST',
				data: {id:product_id},
				dataType: 'JSON',
				success: function(data) {
					if (data !== null) {
						if (data.type == 'Anggaran' || data.tbl_jenis_id == 2) {
							$('#qtygroup_in').hide() //hide field quantity
						} else {
							$('#qtygroup_in').show() //show field quantity
							$('#qty_in').attr('readonly', false)
						}
					} else {
						$('#qtygroup_in').show()
						$('#qty_in').attr('readonly', false)
					}
				}
			})
		})
	})
	
	function reloadProductIn() {
  		tb_product_in.ajax.reload(null, false);
  	}

  	function getDataEdit(){
        var product_in_id = $('#id_barang_in').val()
        $.ajax({
            url : "<?php echo site_url('productin/get_data_edit');?>",
            method : 'POST',
            data :{id :product_in_id},
            dataType : 'json',
            success : function(data){
                $.each(data, function(i, item){
                    $('[name="code_in"]').val(data[i].documentno)
                    $('[name="product_in"]').val(data[i].tbl_barang_id).change()
                    $('[name="datetrx_in"]').val(formatDate(data[i].datetrx))
                    $('[name="qty_in"]').val(data[i].qtyentered)
                    $('[name="desc_in"]').val(data[i].keterangan)
                    $('[name="amount_in"]').val(data[i].amount)
                })
            }
        })
    } 	

    function completeProductIn(id) {
		if (confirm("Apakah data akan di complete ?")) {
			$.ajax({
				url: '<?php echo site_url('productin/actComplete/') ?>'+id,
				type: 'POST',
				dataType: 'JSON',
				success: function(data) {
					var success_message = '<h4><i class="icon fa fa-info"></i> Sukses!</h4> Data berhasil di complete !';
			        $.bootstrapGrowl(success_message, {
			          type: 'success',
			          width: 'auto',
			          align: 'center'
			        });
					reloadProductIn()
				}
			})
		}
	}

	function deleteProductIn(id) {
		if (confirm("Apakah data akan dihapus ?")) {
			$.ajax({
				url: '<?php echo site_url('productin/delete/') ?>'+id,
				type: 'POST',
				dataType: 'JSON',
				success: function(data) {
					var success_message = '<h4><i class="icon fa fa-info"></i> Sukses!</h4> Data berhasil dihapus !';
			        $.bootstrapGrowl(success_message, {
			          type: 'success',
			          width: 'auto',
			          align: 'center'
			        })
					reloadProductIn()
				}
			})
		}
	}

	function numberOnly() {
		$('#amount_in').keypress(function (event){ //Required Number
		  var keycode = event.which;
		  if(!(event.shiftKey == false && (keycode == 46 || keycode == 8 || keycode == 37 || keycode == 39 || (keycode >= 48 && keycode <= 57 )))){
		    event.preventDefault();
		  }
		});
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