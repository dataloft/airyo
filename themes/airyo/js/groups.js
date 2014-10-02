/**
 * Удаление группы
 *
 * @param iId
 *
 * @author N.Kulchinskiy
 */
function removeGroup(iId) {
	if(confirm('Удалить запись?')) {
		$.ajax({
			type: 'post',
			url: '/admin/groups/delete',
			dataType: 'json',
			data: {id : iId},
			success: function(data, status) {
				console.log(data);
				if (data.error) {
					alert('Удалить запись не удалось');
				}
				if (data.success) {
					location.replace('/admin/groups');
				}
			},
			error: function (data,status, error) {
				alert(error);
			}
		});
	}
}