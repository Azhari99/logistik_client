<script type="text/javascript">
	var tb_request_out;
	resetProductOut()
	numberOnlyOut()
	getProductOut()
	numberMin()
    
	$(document).ready(function () {
		$('#code_out').attr('readonly', true);
		$('#institute_out').attr('readonly', true);

		tb_request_out = $('#table-request-out').DataTable({
			'ajax': '<?php echo site_url('requestout/getAll') ?>',
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

		$('#request_out').on('change', function() {
			var product_id = $(this).val()
			//alert(product_id);
			$.ajax({
				url: '<?php echo site_url('requestout/getProductType')?>',
				type: 'POST',
				data: {id:product_id},
				dataType: 'JSON',
				success: function(data) {
					//console.log(data[0].jenis_id);
					if (data !== null) {
						//alert(data.jenis_id);
						if (data[0].jenis_id == 2) {
							$('#qty_out').attr('readonly', true)
							$('[name=qty_out]').val(0)
						} else {
							$('#qty_out').attr('readonly', false)
						}
					} else {
						$('#qty_out').attr('readonly', false)
					}
				}
			})
		})
	})
	
	function reloadProductOut() {
		tb_request_out.ajax.reload(null, false);
  	}

  	function getProductOut(){
        var product_out_id = $('#id_barang_out').val()
        $.ajax({
            url : "<?php echo site_url('requestout/get_data_edit');?>",
            method : 'POST',
            data :{id :product_out_id},
            dataType : 'json',
            success : function(data){
                $.each(data, function(i, item){
                    $('[name="code_out"]').val(data[i].documentno)
                    $('[name="request_out"]').val(data[i].tbl_barang_id).change()
                    $('[name="datetrx_out"]').val(formatDate(data[i].datetrx))
                    $('[name="institute_out"]').val(data[i].tbl_instansi_id).change()
                    $('[name="qty_out"]').val(data[i].qtyentered)
                    $('[name="desc_out"]').val(data[i].keterangan)
                })
            }
        })
    } 	

    function completeProductOut(id) {
		if (confirm("Apakah data akan di complete ?")) {
			$.ajax({
				url: '<?php echo site_url('requestout/actComplete/') ?>'+id,
				type: 'POST',
				dataType: 'JSON',
				success: function(data) {
					if (data.success) {
						var success_msg = '<h4><i class="icon fa fa-info"></i> Sukses !</h4> Data berhasil di complete !';
				        $.bootstrapGrowl(success_msg, {
				          type: 'success',
				          width: 'auto',
				          align: 'center'
				        })
				        reloadProductOut()
					} else {
						var error_msg = '<h4><i class="icon fa fa-ban"></i> Gagal !</h4> Data tidak dapat di complete,'+data.error;
				        $.bootstrapGrowl(error_msg, {
				          type: 'danger',
				          width: 'auto',
				          align: 'center'
				        })
					}
				}
			})
		}
	}

	function deleteProductOut(id) {
		if (confirm("Apakah data akan dihapus ?")) {
			$.ajax({
				url: '<?php echo site_url('requestout/delete/') ?>'+id,
				type: 'POST',
				dataType: 'JSON',
				success: function(data) {
					var success_message = '<h4><i class="icon fa fa-info"></i> Sukses!</h4> Data berhasil dihapus !';
			        $.bootstrapGrowl(success_message, {
			          type: 'success',
			          width: 'auto',
			          align: 'center'
			        });
					reloadProductOut()
				}
			})
		}
	}

	function numberOnlyOut() {
		$('#amount_out').keypress(function (event){ //Required Number
		  var keycode = event.which;
		  if(!(event.shiftKey == false && (keycode == 46 || keycode == 8 || keycode == 37 || keycode == 39 || (keycode >= 48 && keycode <= 57 )))){
		    event.preventDefault();
		  }
		});
	}

	function resetProductOut() {
		$('#resetProductOut').click(function() {
			$('.select2').val(null).trigger('change')
			$('input[name=qty_out]').val('')
			$('textarea').val('')
			$('input[name=amount]').val('')
			$('#datetrx').datepicker('setDate', new Date($.now()))
		})
	}
</script>