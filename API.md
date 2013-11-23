

## Server

### Default (redirect to ping)

Erfordert keine besonderen Rechte

##### Request

```
GET /
```
	
##### Response

```
303 See Other
Content-Type: application/json
Location: /ping
```



### Ping

Erfordert keine besonderen Rechte

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
		"self": { "href": "/" }
	},
	"message": "pong"
}
```
	

## User

### Create User

Erfordert keine besonderen Rechter

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
* `password` must be hashed by SHA-256

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
	"apikey": "f30d2f04433f0db4265ddc7d39eeeb5440e65fa5"
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
	* 1: `username` is not in request
	* 2: `username` already exists in database
	* 3: `email` is not in request
	* 4: `password` is not in request
	* 5: `password` is not hashed
* `message`: description of `code`


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

