<script type="text/javascript">
	var tb_request_out;
	resetProductOut()
	getProductOut()
	getQtyBudget()

	$(document).ready(function() {
		$('#code_out').attr('readonly', true);
		$('#institute_out').attr('readonly', true);
		$('#qtygroup_out').hide()
		$('#unitgroup_out').hide()
		$('#totalgroup_out').hide()
		$('#budgetgroup_out').hide()

		tb_request_out = $('#table-request-out').DataTable({
			'ajax': '<?php echo site_url('requestout/getAll') ?>',
			'processing': true,
			'language': {
				'processing': '<i class="fa fa-spinner fa-spin fa-10x fa-fw"></i><span> Processing...</span>'
			},
			'orders': [],
			'columnDefs': [{
				'targets': -1, //last column
				'orderable': false, //set not orderable
			}, ]
		})
	})

	function reloadProductOut() {
		tb_request_out.ajax.reload(null, false);
	}

	function getQtyBudget() {
		var pageUrl = window.location.href;
		var add = pageUrl.includes('add');
		var actAdd = pageUrl.includes('actAdd');

		$('#request_out').on('change', function() {
			var product_id = $(this).val()
			//alert(product_id);
			$.ajax({
				url: '<?php echo site_url('requestout/getProductType') ?>',
				type: 'POST',
				data: {
					id: product_id
				},
				dataType: 'JSON',
				success: function(data) {
					//console.log(data[0].jenis_id);
					if (data !== null) {
						//alert(data.jenis_id);
						if (data[0].jenis_id == 2) {
							$('#qtygroup_out').hide()
							$('#unitgroup_out').hide()
							$('#totalgroup_out').hide()
							$('#budgetgroup_out').show()
						} else {
							$('#qtygroup_out').show()
							$('#unitgroup_out').show()
							$('#totalgroup_out').show()
							$('#budgetgroup_out').hide()
							$('#total_out').attr('readonly', true)
							$('#unitprice_out').attr('readonly', true)
							if (add === true || actAdd === true) {
								$('[name=unitprice_out]').val(formatRupiah(data[0].unitprice))
								$('[name=qty_out]').val(0)
							} else {
								$('#request_out').on('change', function() {
									var id = $(this).val()
									$.ajax({
										url: '<?php echo site_url('requestout/getProductType') ?>',
										type: 'POST',
										data: {
											id: id
										},
										dataType: 'JSON',
										success: function(result) {
											$('[name=unitprice_out]').val(formatRupiah(result[0].unitprice))
										}
									})
								})
							}
						}

					} else {
						$('[name=qty_out]').val('')
						$('[name=unitprice_out]').val('')
						$('[name=total_out]').val('')
						$('[name=budget_out]').val('')
						$('#qtygroup_out').hide()
						$('#unitgroup_out').hide()
						$('#totalgroup_out').hide()
						$('#budgetgroup_out').hide()
						$('[name=unitprice_out]').val('')
						$('[name=total_out]').val('')
					}
					$('#qty_out').on('click keyup', function() {
						var qty = $(this).val()
						var total = (qty * data[0].unitprice)
						$('[name="total_out"]').val(formatRupiah(total))
					})
				}
			})
		})
	}

	function getProductOut() {
		var product_out_id = $('#id_barang_out').val()
		$.ajax({
			url: "<?php echo site_url('requestout/get_data_edit'); ?>",
			method: 'POST',
			data: {
				id: product_out_id
			},
			dataType: 'json',
			success: function(data) {
				$.each(data, function(i, item) {
					$('[name="code_out"]').val(data[i].documentno)
					$('[name="request_out"]').val(data[i].tbl_barang_id).change()
					$('[name="datetrx_out"]').val(formatDate(data[i].datetrx))
					$('[name="institute_out"]').val(data[i].tbl_instansi_id).change()
					$('[name="qty_out"]').val(data[i].qtyentered)
					$('[name="unitprice_out"]').val(formatRupiah(data[i].unitprice))
					$('[name="total_out"]').val(formatRupiah(data[i].amount))
					$('[name="budget_out"]').val(formatRupiah(data[i].amount))
					$('[name="desc_out"]').val(data[i].keterangan)
				})
			}
		})
	}

	function completeProductOut(id) {
		if (confirm("Apakah data akan di complete ?")) {
			$.ajax({
				url: '<?php echo site_url('requestout/actComplete/') ?>' + id,
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
						var error_msg = '<h4><i class="icon fa fa-ban"></i> Gagal !</h4> Data tidak dapat di complete,' + data.error;
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
				url: '<?php echo site_url('requestout/delete/') ?>' + id,
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