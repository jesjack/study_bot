const URL = 'localhost:3001';

// Example: login('Angel', '12345');
function login(user, password, callback) {
	if(!callback) callback = function(error, response) {
		if(error) console.log(error);
		else {
			user_id = response.login['id']
			user = response.login['user']
		}
	}
	request('POST', '/login', {
		name: user,
		password
	}, callback);
}

// Example: createUser('Angel', '12345');
function createUser(user, password, callback) {
	if(!callback) callback = function(error, response) {
		if(error) console.log(error);
		else {
			let { name, password } = response.user;
			login(name, password);
		}
	};
	request('POST', '/users', {
		name: user, password
	}, callback);
}

// Example: getUsers(1, function(error, users) {});
function getUsers(id, callback) {
	if(!callback) callback = function(error, users) {
		if(error) console.log(error);
		else console.log(users);
	}
	request('GET', '/users' + (id ? ('/' + id) : ''), {}, callback);
}

// Example: sendMessage('Hola, yo soy Angel.', function(error, response) {});
function sendMessage(message, callback) {
	if(!callback) callback = function(error, response) {
		if(error) console.log(error);
		else console.log(response);
	}
	request('POST', '/messages/send/25', { message }, callback);
}

// Example: getMessages(function(error, users) {});
function getMessages(callback) {
	if(!callback) callback = function(error, messages) {
		if(error) console.log(error);
		else console.log(messages);
	}
	request('GET', '/messages' + (user_id ? ('/' + user_id) : ''), {}, callback);
}

// Crear consultas de todo tipo al servidor principal
// Example: request('POST', '/', {}, function(error, response) {});
function request(method, url, data, callback) {
	$.ajax({
		url: URL + url,
		data: data,
		method: method,
		type: 'json',
		success: function(response) {
			callback(undefined, response);
		},
		error: function(error) {
			callback(error, undefined);
		}
	});
}