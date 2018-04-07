# RESTful API Design Scheme


## Allowed HTTPs requests:

- __HEAD__    : Get resource without message-body response
- __OPTIONS__ : Get options/requirements for resource without server side action.
- __GET__     : Get resource
- __POST__    : Create resource
- __PUT__     : Update resource
- __DELETE__  : Delete resource


## Description Of Usual Server Responses:

- 200 __OK__ - the request was successful (some API calls may return 201 instead).
- 201 __Created__ - the request was successful and a resource was created.
- 204 __No Content__ - the request was successful but there is no representation to return (i.e. the response is empty).
- 400 __Bad Request__ - the request could not be understood or was missing required parameters.
- 401 __Unauthorized__ - authentication failed or user doesn't have permissions for requested operation.
- 403 __Forbidden__ - access denied.
- 404 __Not Found__ - resource was not found.
- 405 __Method Not Allowed__ - requested method is not supported for resource.


## Resource Naming

* users
  - id (int) : unique identifier
  - name (string) : Username

* libraries
  - id (int) : unique identifier
  - user_id (int) :
  - title (string) : movie title
  - director (string) : movie director
  - rating (int) : ranking
  - viewed (tinyint) : check view flag
  - url (string) : streaming location
  - tags (text) : extra label
  - notes (text) : annotation

* categories
  - id (int) : unique identifier
  - name (string) : category name

## Methods and response status codes

### GET /{nouns}

* Returns the whole collection
* Status codes - 200 (OK), 400 (invalid query params)

### GET /{nouns}/{id}

* Returns a single record
* Status codes - 200, 404

### GET /{nouns}/{id}/{nouns}

* Return the whole collection of {id}
* Status Codes - 200, 404

### POST /{nouns}

* Creates a new record
* Returns the created record with its ID
* Status codes - 201 (Created), 400 (data validation error)

### PUT /{nouns}/{id}

* Modifies existing record
* PUT method must be idempotent
* Returns the modified record
* Status codes - 200, 404, 400, 301 (moved permanently in case of ID change)

### DELETE /{nouns}/{id}

* Delete the record
* Status codes - 204, 404


