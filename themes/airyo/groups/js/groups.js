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
 * @returns {boolean}
 *
 * @author N.Kulchinskiy
 */
function saveNameGroup(iId){
	var sName = $('input[name$="name-' + iId + '"]').val();
	if(sName.length !== ''){
		$.ajax({
			type: "POST",
			url: "/admin/groups/edit/" + iId,
			data: { id: iId, name: sName, type: 'name_group'}
		}).done(function( msg ) {
			console.log(msg);
		});
	} else {
		console.log('error name');
		return false;
	}
}

/**
 * Сохранение описания группы
 *
 * @param iId
 * @returns {boolean}
 *
 * @author N.Kulchinskiy
 */
function saveDescriptionGroup(iId){
	var sDescription = $('input[name$="description-' + iId + '"]').val();
	if(sDescription.length !== ''){
		$.ajax({
			type: "POST",
			url: "/admin/groups/edit/" + iId,
			data: { id: iId, name: sDescription, type: 'description_group'}
		}).done(function( msg ) {
			console.log(msg);
		});
	} else {
		console.log('error description');
		return false;
	}
}

/**
 * Добавление пользователя в группу
 *
 * @param oElement
 * @param iGroupId
 * @param iUserId
 *
 * @author N.Kulchinskiy
 */
function addUserToGroup(oElement, iGroupId, iUserId) {
	var sNewName = $('input[name$="add-user-' + iGroupId + '"]').val();
	if(sNewName.length !== '') {
		$.ajax({
			type: "POST",
			url: "/admin/groups/edit/" + iGroupId,
			data: {id: iGroupId, user_id: iUserId, name: sNewName, type: 'add_user'}
		}).done(function (msg) {
			$(oElement).parents('td').find('ul').append('<li class="list-group-item">' +
			'(<a href="/admin/users/edit/">' + sNewName + '</a>)' +
			'<a href="#" onclick="removeUserFromGroup(this, ' + iGroupId + ', ' + iUserId + '); return false;" class="badge pull-right"><i class="glyphicon glyphicon-remove"></i></a>' +
			'</li>');
			console.log(msg);
		});
	}
}

var substringMatcher = function(strs) {
	return function findMatches(q, cb) {
		var matches, substrRegex;

		// an array that will be populated with substring matches
		matches = [];

		// regex used to determine if a string contains the substring `q`
		substrRegex = new RegExp(q, 'i');

		// iterate through the pool of strings and for any string that
		// contains the substring `q`, add it to the `matches` array
		$.each(strs, function(i, str) {
			if (substrRegex.test(str)) {
				// the typeahead jQuery plugin expects suggestions to a
				// JavaScript object, refer to typeahead docs for more info
				matches.push({ value: str });
			}
		});

		cb(matches);
	};
};

var states = ['Alabama', 'Alaska', 'Arizona', 'Arkansas', 'California',
	'Colorado', 'Connecticut', 'Delaware', 'Florida', 'Georgia', 'Hawaii',
	'Idaho', 'Illinois', 'Indiana', 'Iowa', 'Kansas', 'Kentucky', 'Louisiana',
	'Maine', 'Maryland', 'Massachusetts', 'Michigan', 'Minnesota',
	'Mississippi', 'Missouri', 'Montana', 'Nebraska', 'Nevada', 'New Hampshire',
	'New Jersey', 'New Mexico', 'New York', 'North Carolina', 'North Dakota',
	'Ohio', 'Oklahoma', 'Oregon', 'Pennsylvania', 'Rhode Island',
	'South Carolina', 'South Dakota', 'Tennessee', 'Texas', 'Utah', 'Vermont',
	'Virginia', 'Washington', 'West Virginia', 'Wisconsin', 'Wyoming'
];

$('.type').typeahead({
		hint: true,
		highlight: true,
		minLength: 1
	},
	{
		name: 'states',
		displayKey: 'value',
		source: substringMatcher(states)
	});

/**
 * Удаление пользователя из группы
 *
 * @param oElement
 * @param iGroupId
 * @param iUserId
 *
 * @author N.Kulchinskiy
 */
function removeUserFromGroup(oElement, iGroupId, iUserId) {
	$(oElement).parent('li').remove();
	$.ajax({
		type: "POST",
		url: "/admin/groups/edit/" + iGroupId,
		data: { id: iGroupId, user_id: iUserId, type: 'remove_user'}
	}).done(function( msg ) {
		$(oElement).parent('li').remove();
		console.log(msg);
	});
}