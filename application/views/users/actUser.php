<script type="text/javascript">
	var tb_user;
	getUserEdit()

	$(document).ready(function() {
		tb_user = $('#table-user').DataTable({
			'ajax': '<?php echo site_url('users/getAll') ?>',
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

	function reloadUser() {
		tb_user.ajax.reload(null, false);
	}

	function getUserEdit() {
		var user_id = $('#id_user').val()
		$.ajax({
			url: "<?php echo site_url('users/get_users_edit'); ?>",
			type: "POST",
			data: {
				user_id: user_id
			},
			async: true,
			dataType: 'json',
			success: function(data) {
				$.each(data, function(i, item) {
					$('[name="username"]').val(data[i].value)
					$('[name="name"]').val(data[i].name)
					$('[name="level"]').val(data[i].level).change()
					if (data[i].isactive === 'Y') {
						$('[name=isuser]').attr('checked', true)
					} else {
						$('[name=isuser]').attr('checked', false)
					}
				})
			}
		})
	}

	function deleteUsers(id) {
		if (confirm("Apakah data akan dihapus ?")) {
			$.ajax({
				url: '<?php echo site_url('users/actDelete/') ?>' + id,
				type: 'POST',
				dataType: 'JSON',
				success: function(data) {
					var success_message = '<h4><i class="icon fa fa-info"></i> Sukses!</h4> Data berhasil dihapus !';
					$.bootstrapGrowl(success_message, {
						type: 'success',
						width: 'auto',
						align: 'center'
					});
					reloadUser()
				}
			})
		}
	}
</script>