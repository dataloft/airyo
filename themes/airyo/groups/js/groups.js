/**
 * Редактирование имени группы
 *
 * @param iId
 * @param bEdit
 *
 * @author N.Kulchinskiy
 */
function editNameGroup(iId, bEdit){
	if(bEdit) {
		$('.view-name-' + iId).hide();
		$('.edit-name-' + iId).show();
	} else {
		$('.edit-name-' + iId).hide();
		$('.view-name-' + iId).show();
	}
}

/**
 * Редактирование описания группы
 *
 * @param iId
 * @param bEdit
 *
 * @author N.Kulchinskiy
 */
function editDescriptionGroup(iId, bEdit){
	if(bEdit) {
		$('.view-description-' + iId).hide();
		$('.edit-description-' + iId).show();
	} else {
		$('.edit-description-' + iId).hide();
		$('.view-description-' + iId).show();
	}
}

/**
 * Сохранение имени группы
 *
 * @param iId
 * @param sName
 * @returns {boolean}
 *
 * @author N.Kulchinskiy
 */
function saveNameGroup(iId, sName){
	if(sName.length !== ''){
		$.ajax({
			type: "POST",
			url: "/admin/groups/edit/" + iId,
			data: { id: iId, name: sName }
		}).done(function( msg ) {
			console.log(msg);
		});
	} else {
		console.log('sads');

		return false;
	}
}


function saveDescriptionGroup(iId, sDescription){

}

function removeUserFromGroup(oUser, iUserId) {
	$(oUser).parent('li').remove();
}
