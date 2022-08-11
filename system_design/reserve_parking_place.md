# Reserve parking place

The task is from [https://www.youtube.com/watch?v=NtMvNh0WFVM](https://www.youtube.com/watch?v=NtMvNh0WFVM), but the solution is different.

## Backend API

### Microservice User

See details in [Microservice User](./microservice_user.md).

### Microservice Payment

See details in [Microservice Payment](./microservice_payment.md). Plus offline-payment in a terminal: by cash or by a bank card

### Microservice Parking place

* /garage
  * GET - list of all garages 
      * Response: JSON (id, name, address, latitude, longitude, etc.)

* /car_type
  * GET - list of all car types (compact, regular, large, etc.) 
      * Response: JSON (id, name)

* /spot - parking place
  * GET - list of all free sports
    * GET[garage_id, datetime_from (optional), datetime_to (optional), car_type_id (optional)]
    * Response: JSON (id, price)
  * POST /$garage_id - reserve a spot
    * Header[token]
    * POST[datetime_from (optional), datetime_to (optional), car_type_id]
  * PATCH /$garage_id/$spot_id - cancel the reservation of the spot
    * Header[token]

## DB

See details in [Microservice User](./microservice_user.md) and [Microservice Payment](./microservice_payment.md).

### car_type

* id,
* name (compact, regular, large, etc.)

### garage

* id,
* name,
* address,
* latitude, longitude,
* etc.

### spot

* id,
* garage_id,
* number,
* car_type_id,
* price

### sport_reservation

* id,
* sport_id,
* datetime_from,
* datetime_to,
* user_id,

## Frontend

### Mobile app, website

* List of all garages (GET /garage), show in a map
* Choose a garage, show availability and prices (GET /spot?garage_id=$garage_id)
* Login or create an account, receive a token (POST /user/login, GET /user/oauth2/..., POST /user)
* Reserve a spot (POST /$garage_id)
* Cancel (PATCH /$garage_id/$spot_id) and pay it (GET /payment, go to a payment gate, pay, POST /payment/...)

### Terminal

* A garage is already chosen. Show availability and prices (GET /spot?garage_id=$garage_id)
* User is created automatically, token is printed as a QR-code (POST /user)
* Reserve a spot (POST /$garage_id)
* Cancel (PATCH /$garage_id/$spot_id) and pay it with cash or a bank card in a terminal

## System design

* Frontend (several)
  * website,
  * mobile app (Android, iOS, Windows),
  * terminal
* Backend (several)
  * microservice User,
  * microservice Payment,
  * microservice Parking place
* DB
  * master (one), write only 
  * slave (several), read only
