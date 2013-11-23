

## Server

### Ping

Erfordert keine besonderen Rechte

##### Request

```
GET /
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

### Benutzer erstellen

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