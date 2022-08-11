# Microservice User

## API endpoint

* /user
  * POST - create a new user
    * POST[account_name, password, first_name (optional), last_name (optional), email (optional), etc.]
    * Response: token
  * GET - get info about current user
      * Header[token]
      * Response: JSON (account_name, first_name, last_name, email, etc.)
  * PUT, PATCH - update user info (PUT - all fields, PATCH - exact fields)
      * Header[token]
      * POST[account_name, first_name, last_name, email, etc.]
  * POST /login - login with account_name and password
    * POST[account_name, password]
    * Response: token
  * /oauth2 - login with 3d party sites
    * GET /google, GET /facebook, GET /microsoft, etc.
      * GET[external_user_id, external_token]
      * Response: token

## DB

### user

* id,
* account_name
* password
* first_name,
* last_name,
* email,
* token,
* etc.

### user_oauth2

* id,
* user_id,
* type (google, facebook, microsoft, etc.),
* external_user_id
