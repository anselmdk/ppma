
## TOC

* Server
	* Default  (`/`) (redirect to ping)
	* Ping  (`/ping`)
* User
	* Create User (`/users`)
	* Update User  (`/users/<username>`)
	* Delete User  (`/users/<username>`) [not implemented atm]
	* Get Groups  (`/users/<username>/groups`) [not implemented atm]
* Auth
	* Get Key / Login (`/users/<username>/auth/<password>`)
	* Create new key (`/users/<username>/auth`)
* Group
	* Create Group (`/groups`) [not implemented atm]
	* Update Group (`/groups/<name>`) [not implemented atm]
	* Delete Group (`/groups/<name>`) [not implemented atm]
	* Get all Users of a Group (`/groups/<name>/users`) [not implemented atm]
	* Get all Group (`/groups`) [not implemented atm]
* Entry
	* Create Entry (`/group/<group-slug>/entries`) [not implemented atm]
	* Update Entry (`/group/<group-slug>/entries/<entry-slug>`) [not implemented atm]
	* Delete Entry (`/group/<group-slug>/entries/<entry-slug>`) [not implemented atm]
* Category
* Tag



## Server

### Default (redirect to ping)

Erfordert keine besonderen Rechte

##### Request

```
GET /
```
	
##### Response

```
301 Moved Permanently
Content-Type: application/json
Location: /ping
```


### Ping

##### Request

```
GET /ping
```
	
##### Response

```
200 OK
Content-Type: application/hal+json
```
```
{
	"_links": {
		"self": { "href": "/ping" }
	},
	"message": "pong"
}
```
	

## User

### Create User

#### Request

```
POST /users
```
```
{
	"username":	"janedoe",
	"email": 	"jane@doe.com",
	"password"	"5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d8",
}
```

* all fields are required
* `password` must be hashed by SHA-1

#### Response (OK)

```
201 Created
Content-Type: application/hal+json
Location: /users/janedoe
```
```
{
	"_links": {
		"self": "/users",
		"user": "/users/janedoe"
	},
	"authkey": "f30d2f04433f0db4265ddc7d39eeeb5440e65fa5"
}
```

#### Response (Error)

```
400 Bad Request
Content-Type: application/hal+json
```
```
{
	"_links": {
		"self": "/users"
	},
	"code":   <code>,
	"message" <message>"
}
```

* `code`: error code
	* 1: `username` is required
	* 2: `username` already exists in database
	* 3: `email` is required
	* 4: `password` is required
	* 5: `password` is not hashed
* `message`: description of `code`


### Update User

#### Request

```
PUT /users/janedoe
X-Authkey: f30d2f04433f0db4265ddc7d39eeeb5440e65fa5
```
```
{
	"email": "jane@doe.org",
	"password": "5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d8""
}
```

All values are optional

#### Response

```
200 OK
```

### Delete User

#### Request

```
DELETE /users/janedoe
X-Authkey: f30d2f04433f0db4265ddc7d39eeeb5440e65fa5
```

#### Response
```
204 No Content
```



## Auth


### Get Key / Login

Erfordert keine besonderen Rechter

#### Request

```
GET /users/janedoe/auth/
5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8
```

#### Response (OK)

```
200 OK
Content-Type: application/json
```
```
{
	"key": "f30d2f04433f0db4265ddc7d39eeeb5440e65fa5"
}
```

#### Response (Error)

```
400 Bad Request
```
```
{
	"code":    <code>,
	"message": <message>
}
```

* `code`: error code
	* 1: authentication failed
* `message`: description of `code`


### Create new key

#### Request

```
POST /users/janedoe/auth
X-Authkey: f30d2f04433f0db4265ddc7d39eeeb5440e65fa5
```

#### Response

```
200 OK
Content-Type: application/hal+json
```
```
{
	"key": "e500fe5aaa59109a1d81eb11cf4360ee9c2be304"
}
```

## Groups

### Create a Group

#### Request

```
POST /groups
X-Authkey: f30d2f04433f0db4265ddc7d39eeeb5440e65fa5
```
```
{
	"name": "new group"
}
```

#### Response (OK)

```
201 Created
Content-Type: application/hal+json
Location: /groups/new-group
```
```
{
	"_links": {
		"self": { "href": "/groups" },
		"group": { "href": "/groups/new-group" }
	},
	"slug": "new-group"
}
```

#### Response (Error)

```
400 Created
Content-Type: application/hal+json
```
```
{
	"_links": {
		"self": { "href": "/groups" }
	},
	"code": <code>,
	"message": <message>
}
```

* `code`: error code
	* 1: name is required
* `message`: description of `code`